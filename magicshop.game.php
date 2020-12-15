<?php
 /**
  *------
  * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
  * magicshop implementation : © David Bond <David.CJ.Bond@gmail.com>
  * 
  * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
  * See http://en.boardgamearena.com/#!doc/Studio for more information.
  * -----
  * 
  * magicshop.game.php
  *
  * This is the main file for your game logic.
  *
  * In this PHP file, you are going to defines the rules of the game.
  *
  */


require_once( APP_GAMEMODULE_PATH.'module/table/table.game.php' );


class magicshop extends Table
{
    function __construct( )
    {
        // Your global variables labels:
        //  Here, you can assign labels to global variables you are using for this game.
        //  You can use any number of global variables with IDs between 10 and 99.
        //  If your game has options (variants), you also have to associate here a label to
        //  the corresponding ID in gameoptions.inc.php.
        // Note: afterwards, you can get/set the global variables with getGameStateValue/setGameStateInitialValue/setGameStateValue
        parent::__construct();
        
        self::initGameStateLabels( array( 
            //    "my_first_global_variable" => 10,
            //    "my_second_global_variable" => 11,
            //      ...
            //    "my_first_game_variant" => 100,
            //    "my_second_game_variant" => 101,
            //      ...
        ) );  

        //Deck init
        // $this->cardsBasic = self::getNew( "module.common.deck" );
        // $this->cardsBasic->init( "cardsBasic" );
        
        // $this->cardsAdvanced = self::getNew( "module.common.deck" );
        // $this->cardsAdvanced->init( "cardsAdvanced" );
        
        // $this->cardsItem = self::getNew( "module.common.deck" );
        // $this->cardsItem->init( "cardsItem" );
        

        $this->cardDeck = self::getNew("module.common.deck");
        $this->cardDeck->init("cardDeck");
        $this->cardDeck->autoreshuffle_custom = array('deckBasic' => 'discardBasic', 'deckAdvanced' => 'discardAdvanced');
        $this->cardDeck->autoreshuffle = true;
        
    }
    
    protected function getGameName( )
    {
        // Used for translations and stuff. Please do not modify.
        return "magicshop";
    }	

    /*
        setupNewGame:
        
        This method is called only once, when a new game is launched.
        In this method, you must setup the game according to the game rules, so that
        the game is ready to be played.
    */
    protected function setupNewGame( $players, $options = array() )
    {    
        // Set the colors of the players with HTML color code
        // The default below is red/green/blue/orange/brown
        // The number of colors defined here must correspond to the maximum number of players allowed for the gams
        $gameinfos = self::getGameinfos();
        $default_colors = $gameinfos['player_colors'];
 
        // Create players
        // Note: if you added some extra field on "player" table in the database (dbmodel.sql), you can initialize it there.
        $sql = "INSERT INTO player (player_id, player_color, player_canal, player_name, player_avatar) VALUES ";
        $values = array();
        foreach( $players as $player_id => $player )
        {
            $color = array_shift( $default_colors );
            $values[] = "('".$player_id."','$color','".$player['player_canal']."','".addslashes( $player['player_name'] )."','".addslashes( $player['player_avatar'] )."')";
        }
        $sql .= implode( $values, ',' );
        self::DbQuery( $sql );
        self::reattributeColorsBasedOnPreferences( $players, $gameinfos['player_colors'] );
        self::reloadPlayersBasicInfos();
        
        /************ Start the game initialization *****/

        // Init global values with their initial values
        //self::setGameStateInitialValue( 'my_first_global_variable', 0 );
        
        // Init game statistics
        // (note: statistics used in this file must be defined in your stats.inc.php file)
        //self::initStat( 'table', 'table_teststat1', 0 );    // Init a table statistics
        //self::initStat( 'player', 'player_teststat1', 0 );  // Init a player statistics (for all players)

        // TODO: setup the initial game situation here
       

        // Activate first player (which is in general a good idea :) )
        $this->activeNextPlayer();
        
        
        //Populate decks
        $basic = array();
        $advanced = array();
        $item = array();
        
        foreach( $this->cards as $cardTypeId => $cardDetail ) {
            //Basic
            if($cardDetail['type'] == 'basic'){
                $basic[] = array('type' => $cardTypeId, 'type_arg' => 0, 'nbr' => $cardDetail['count']);
                
            //Advanced
            } elseif ($cardDetail['type'] == 'advanced'){
                $advanced[] = array('type' => $cardTypeId, 'type_arg' => 1, 'nbr' => $cardDetail['count']);
                
            //Item
            } elseif ($cardDetail['type'] == 'item'){
                $item[] = array('type' => $cardTypeId, 'type_arg' => 2, 'nbr' => $cardDetail['count']);
            
            }
            
        }
        
        //$this->cardsBasic->createCards($basic, 'deck');
        //$this->cardsAdvanced->createCards($advanced, 'deck');
        //$this->cardsItem->createCards($item, 'deck');
        $this->cardDeck->createCards($basic, 'deckBasic');
        $this->cardDeck->createCards($advanced, 'deckAdvanced');
        $this->cardDeck->createCards($item, 'deckItem');
        // $this->cardsBasic->shuffle('deck');
        // $this->cardsAdvanced->shuffle('deck');
        $this->cardDeck->shuffle('deckBasic');
        $this->cardDeck->shuffle('deckAdvanced');

        //deal out starting hands
        foreach( $players as $player_id => $player ){
            //$cards = $this->cardsBasic->pickCards( 3, 'deck', $player_id );
            $cards = $this->cardDeck->pickCards( 3, 'deckBasic', $player_id );
           
            // Notify player about his cards
            self::notifyPlayer( $player_id, 'drawCards', '', array( 
                'cards' => $cards
            ) );
        }

        /************ End of the game initialization *****/
    }

    /*
        getAllDatas: 
        
        Gather all informations about current game situation (visible by the current player).
        
        The method is called each time the game interface is displayed to a player, ie:
        _ when the game starts
        _ when a player refreshes the game page (F5)
    */
    protected function getAllDatas()
    {
        $result = array();

        //send card information to client setup
        $result['cardInfo'] = $this->cards;

    
        $current_player_id = self::getCurrentPlayerId();    // !! We must only return informations visible by this player !!
    
        // Get information about players
        // Note: you can retrieve some extra field you added for "player" table in "dbmodel.sql" if you need it.
        $sql = "SELECT player_id id, player_score score FROM player ";
        $result['players'] = self::getCollectionFromDb( $sql );
  
        // TODO: Gather all information about current game situation (visible by player $current_player_id).
        // Cards in player hand      
        // $handBasic = $this->cardsBasic->getCardsInLocation( 'hand', $current_player_id );
        // $handAdvanced = $this->cardsAdvanced->getCardsInLocation( 'hand', $current_player_id );
        // $handItem = $this->cardsItem->getCardsInLocation( 'hand', $current_player_id );
        // $result['hand'] = array_merge($handBasic, $handAdvanced, $handItem);
        $result['hand'] = $this->cardDeck->getCardsInLocation('hand', $current_player_id);
        
        return $result;
    }

    /*
        getGameProgression:
        
        Compute and return the current game progression.
        The number returned must be an integer beween 0 (=the game just started) and
        100 (= the game is finished or almost finished).
    
        This method is called each time we are in a game state with the "updateGameProgression" property set to true 
        (see states.inc.php)
    */
    function getGameProgression()
    {
        // TODO: compute and return the game progression

        return 0;
    }


//////////////////////////////////////////////////////////////////////////////
//////////// Utility functions
////////////    

    /*
        In this space, you can put any utility methods useful for your game logic
    */
    
    /*
        Id conversion
        +0 basic
        +1 advanced
        +2 item
    */
    function comboToId($id){
        $typeOffset = $id % 3;
        $id -= $typeOffset;
        $id /= 3;
        if($typeOffset == 0){
            $type = 'basic';
        } elseif ($typeOffset == 1){
            $type = 'advanced';
        } elseif ($typeOffset == 2){
            $type = 'item';
        }
        return array('id' => $id, 'type' => $type);
    }

    function idToCombo($id, $type){
        $id *= 3;
        $id += $type;
        return $id;
    }

//////////////////////////////////////////////////////////////////////////////
//////////// Player actions
//////////// 

    /*
        Each time a player is doing some game action, one of the methods below is called.
        (note: each method below must match an input method in magicshop.action.php)
    */

    /*
    
    Example:

    function playCard( $card_id )
    {
        // Check that this is the player's turn and that it is a "possible action" at this game state (see states.inc.php)
        self::checkAction( 'playCard' ); 
        
        $player_id = self::getActivePlayerId();
        
        // Add your game logic to play a card there 
        ...
        
        // Notify all players about the card played
        self::notifyAllPlayers( "cardPlayed", clienttranslate( '${player_name} plays ${card_name}' ), array(
            'player_id' => $player_id,
            'player_name' => self::getActivePlayerName(),
            'card_name' => $card_name,
            'card_id' => $card_id
        ) );
          
    }
    
    */
     
     function activatePotion() {
     //todo
     //set potion active
         $this->gamestate->nextstate("playerTurn3");
     }
     
     //target: id of card to create
     //sources: array of id's of cards to be used to pay for the card
     function makePotionItem($targetId, $sourceIds) {
     //todo
     //stock shop with potion or item from hand
        self::checkAction('makePotionItem');
        //add cost, subtract resources, check each ingredient for <= 0

        if(!isset($this->cards[$target])){
            throw new BgaVisibleSystemException ( self::_("An error has occured (Error A3a) please refresh your page") );
        }
        $costGold = $this->cards[$target]['costGold'];
        $costRes = array('A' => 0, 'B' =>0, 'C' =>0, 'D' => 0, 'E' => 0);
        foreach($this->cards[$target]['costIngredients'] as $res){
            $costRes[$res]++;
        }
        
        foreach($sources as $source){
            if(!isset($this->cards[$source])){
                throw new BgaVisibleSystemException ( self::_("An error has occured (Error A3b) please refresh your page") );
            }
            if($this->cards[$source]['valueType'] == 'ingredient'){
                foreach($this->cards[$source]['valueIngredients'] as $res){
                    $costRes[$res]--;
                }
            } else {
                $costGold -= $this->cards[$source]['valueIngredients'];
            }
        }

        $paidRes = true;
        foreach($costRes as $key => $value){
            if($value > 0){
                $paidRes = false;
                break;
            }
        }

        //if all checks out perform the action
        if($paidRes || $costGold <= 0){
            //move target to shop

            //discard resources from hand

        }


        



         $this->gamestate->nextstate();
     
     }
     
     function pass() {
        $this->checkAction('pass');
        //move to next state
        $this->gamestate->nextstate();
     }
     
     function playCard() {
     
     }

     function actionDrawBasic(){
        $this->checkAction('drawBasic');

        $player_id = self::getActivePlayerId();

        $picked = $this->cardDeck->pickCards(2,'deckBasic', $player_id);
        $count = count($picked); 
        
        if($count == 0){
            //deck is empty
            throw new BgaUserException(self::_("You can't draw more basic potions, the deck is empty!"));
        }

        //Notify the reciving player the cards received
        self::notifyPlayer($player_id, 'cardDrawPersonal','', array(
            'cards' => $picked
        ) );


        // Notify all players that cards were drawn
        self::notifyAllPlayers( 'cardDraw', clienttranslate( '${player_name} draws ${count} basic potions' ), array(
            'player_id' => $player_id,
            'player_name' => self::getActivePlayerName(),
            'type' => 'basic',
            'count' => $count,
        ) );

        $this->gamestate->nextstate();
     }

     function actionDrawAdvanced(){
        $this->checkAction('drawAdvanced');

        $player_id = self::getActivePlayerId();

        if(countCardInLocation('shop', $player_id) < 3){
            throw new BgaUserException(self::_("You can not draw advanced potions, you do not have enough stock in your shop"));
        }

        $picked = $this->cardDeck->pickCards(1,'deckAdvanced', $player_id);
        $count = count($picked); 
        
        if($count == 0){
            //deck is empty
            throw new BgaUserException(self::_("You can not draw more advanced potions, the deck is empty!"));
        }

        //Notify the reciving player the cards received
        self::notifyPlayer($player_id, 'cardDrawPersonal','', array(
            'cards' => $picked
        ) );


        // Notify all players that cards were drawn
        self::notifyAllPlayers( 'cardDraw', clienttranslate( '${player_name} draws ${count} advanced potion' ), array(
            'player_id' => $player_id,
            'player_name' => self::getActivePlayerName(),
            'type' => 'advanced',
            'count' => $count,
        ) );

        $this->gamestate->nextstate();

     }

     function actionDrawItem($itemId){
        $this->checkAction('drawItem');

        $player_id = self::getActivePlayerId();

        $advancedCount = count($this->cardDeck->getCardsOfTypeInLocation( null, $type_arg=1, 'shop', $location_arg = $player_id ));
        self::dump('actionDrawItem advanced count', $advancedCount);

        if($advancedCount < 2){ //2 advanced cards
            throw new BgaUserException(self::_("You can not draw items, you do not have enough advanced potions in your shop"));
        }

        if($this->cardDeck->getCard($itemId)['location'] != 'deckItem'){
            throw new BgaUserException(self::_("You can not draw that item, it is not avalible in the deck"));
        }

        $this->cardDeck->moveCard($itemId, 'hand', $player_id);

        $this->gamestate->nextstate();
     }


     

    
//////////////////////////////////////////////////////////////////////////////
//////////// Game state arguments
////////////

    /*
        Here, you can create methods defined as "game state arguments" (see "args" property in states.inc.php).
        These methods function is to return some additional information that is specific to the current
        game state.
    */

    /*
    
    Example for game state "MyGameState":
    
    function argMyGameState()
    {
        // Get some values from the current game situation in database...
    
        // return values:
        return array(
            'variable1' => $value1,
            'variable2' => $value2,
            ...
        );
    }    
    */

//////////////////////////////////////////////////////////////////////////////
//////////// Game state actions
////////////

    /*
        Here, you can create methods defined as "game state actions" (see "action" property in states.inc.php).
        The action method of state X is called everytime the current game state is set to X.
    */
    
    /*
    
    Example for game state "MyGameState":

    function stMyGameState()
    {
        // Do some stuff ...
        
        // (very often) go to another gamestate
        $this->gamestate->nextState( 'some_gamestate_transition' );
    }    
    */


    function stRoundStart(){
     //todo
     //Select first player
        $this->gamestate->nextState();
    }

    function stPlayerTurnStart(){
        $this->gamestate->nextState();
    }
/*
    function stPlayerTurn1(){
     //todo
     //Check active potion and apply
     //Draw cards
        $this->gamestate->nextState();
    }
*/
    function stPlayerTurnEnd(){
        //todo
     //activate next player

    }

    function stRoundEnd(){
     //todo
     //check game end and move to next round
     /*
         if(gameend){
              $this->gamestate->nextState("gameEnd");
          } else {
              $this->gamestate->nextstate("roundStart");
          }
          */
    }

//////////////////////////////////////////////////////////////////////////////
//////////// Zombie
////////////

    /*
        zombieTurn:
        
        This method is called each time it is the turn of a player who has quit the game (= "zombie" player).
        You can do whatever you want in order to make sure the turn of this player ends appropriately
        (ex: pass).
        
        Important: your zombie code will be called when the player leaves the game. This action is triggered
        from the main site and propagated to the gameserver from a server, not from a browser.
        As a consequence, there is no current player associated to this action. In your zombieTurn function,
        you must _never_ use getCurrentPlayerId() or getCurrentPlayerName(), otherwise it will fail with a "Not logged" error message. 
    */

    function zombieTurn( $state, $active_player )
    {
        $statename = $state['name'];
        
        if ($state['type'] === "activeplayer") {
            switch ($statename) {
                default:
                    $this->gamestate->nextState( "zombiePass" );
                    break;
            }

            return;
        }

        if ($state['type'] === "multipleactiveplayer") {
            // Make sure player is in a non blocking status for role turn
            $this->gamestate->setPlayerNonMultiactive( $active_player, '' );
            
            return;
        }

        throw new feException( "Zombie mode not supported at this game state: ".$statename );
    }
    
///////////////////////////////////////////////////////////////////////////////////:
////////// DB upgrade
//////////

    /*
        upgradeTableDb:
        
        You don't have to care about this until your game has been published on BGA.
        Once your game is on BGA, this method is called everytime the system detects a game running with your old
        Database scheme.
        In this case, if you change your Database scheme, you just have to apply the needed changes in order to
        update the game database and allow the game to continue to run with your new version.
    
    */
    
    function upgradeTableDb( $from_version )
    {
        // $from_version is the current version of this game database, in numerical form.
        // For example, if the game was running with a release of your game named "140430-1345",
        // $from_version is equal to 1404301345
        
        // Example:
//        if( $from_version <= 1404301345 )
//        {
//            // ! important ! Use DBPREFIX_<table_name> for all tables
//
//            $sql = "ALTER TABLE DBPREFIX_xxxxxxx ....";
//            self::applyDbUpgradeToAllDB( $sql );
//        }
//        if( $from_version <= 1405061421 )
//        {
//            // ! important ! Use DBPREFIX_<table_name> for all tables
//
//            $sql = "CREATE TABLE DBPREFIX_xxxxxxx ....";
//            self::applyDbUpgradeToAllDB( $sql );
//        }
//        // Please add your future database scheme changes here
//
//


    }    
}
