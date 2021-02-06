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
            'gameEnd' => 10,
            'firstPlayer' => 11,
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
        self::setGameStateInitialValue('gameEnd', 0);
        
        // Init game statistics
        // (note: statistics used in this file must be defined in your stats.inc.php file)
        //self::initStat( 'table', 'table_teststat1', 0 );    // Init a table statistics
        //self::initStat( 'player', 'player_teststat1', 0 );  // Init a player statistics (for all players)

        // TODO: setup the initial game situation here
       

        // Activate first player (which is in general a good idea :) )
        $firstPlayerId = $this->activeNextPlayer();
        self::setGameStateInitialValue('firstPlayer', $firstPlayerId);
        
        
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
            self::notifyPlayer( $player_id, 'drawCardsPersonal', '', array( 
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

        //player shops
        $result['shops'] = $this->cardDeck->getCardsInLocation('shop');

        //item deck
        $result['deckItem'] = $this->cardDeck->getCardsInLocation('deckItem');
        
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
        //max of players things in shop / number required for the player to win

        return 0;
    }


//////////////////////////////////////////////////////////////////////////////
//////////// Utility functions
////////////    

    /*
        In this space, you can put any utility methods useful for your game logic
    */
    

    function discardCard($id){
        $type_arg = $this->cardDeck->getCard($id)['type_arg'];
        if($type_arg == 0){
            $this->cardDeck->moveCard($id, 'discardBasic');
        } elseif ($type_arg == 1){
            $this->cardDeck->moveCard($id, 'discardAdvanced');
        } elseif ($type_arg == 2){
            $this->cardDeck->moveCard($id, 'deckItem');
        } else {
            throw new BgaVisibleSystemException ('Error in card discard');
        }
    }

    function discardCards($idArray){
        foreach($idArray as $value){
            $this->discardCard($value);
        }
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


     function doBasicPotion(){

     }

     function doAdvancedPotion(){

     }

     function doItem(){

     }

     function doCard($id){
        $type = $this->cardDeck->getCard($id)['type'];
        $player_id = self::getCurrentPlayerId();
        $player_name = self::getActivePlayerName();
        //notify all players card activated
        self::notifyAllPlayers('cardActivated', clienttranslate('${player_name} activates ${card_name}'), array(
            'player_name' => $player_name,
            'card_name' => $this->cards[$type]->name,
            'card_id' => $id,
        ));
        switch($type){
            //Items
            //Stone of Influence
            case 0:{
                break;
            }
            //Shield of Safety
            case 1:{
                break;
            }
            //Helmet of Preservation
            case 2:{
                break;
            }
            //Belt of Thievery
            case 3:{
                break;
            }
            //Statue of Wisdom
            case 4:{
                break;
            }
            //Necklace of Trades
            case 5:{
                break;
            }
            //Dagger of Light
            case 6:{
                break;
            }
            //Boots of Forthsight
            case 7:{
                break;
            }
            // Advanced Potions
            //Production Liqueur
            case 8:
            case 9:{
                break;
            }
            //Golden Water
            case 10:
            case 11:{
                break;
            }
            //Spy Oil
            case 12:
            case 13:{
                break;
            }
            //Thief Nectar
            case 14:
            case 15:{
                break;
            }
            //Guardian Elixer
            case 16:
            case 17:{
                break;
            }
            //Multiply Juice
            //In phase 1 of the next round, you may draw three times the amount of Potion Cards you normaly draw. Or 2 Item Cards. 
            case 18:
            case 19:{
                break;
            }
            //Sorcery Tonic
            //Draw an item card at random and add it to your shop
            case 20:
            case 21:{
                $this->cardDeck->shuffle('deckItem');
                $drawn = $this->cardDeck->pickCardForLocation('deckItem', 'shop', $player_id );
                //notify
                // notify all cards drawn
                self::notifyAllPlayers('drawCardsPublic', clienttranslate('${player_name} draws 1 item card'), array(
                    'player_name' => $player_name,
                    'player_id' =>  $player_id,
                    'type' => 'item',
                    'count' => 1,
                ));
                // notify player of cards
                self::notifyPlayer($player_id, 'drawCardsPrivate', '', array(
                    'cards' => array($drawn),
                ));
                //notify of make
                self::notifyAllPlayers('makePotionItem', clienttranslate('${player_name} adds ${item_name} to their shop'), array(
                    'player_id' => $player_id,
                    'player_name' => self::getActivePlayerName(),
                    'targetId' => $drawn->id,
                    'targetType' => $drawn->type,
                    'item_name' => $this->cards[$drawn->type]['name'],
                    'sourceIds' => array(),
                ));
                break;
            }
            //Wisdom Wine
            case 22:
            case 23:{
                break;
            }
            //Basic Potions
            //Production Potion
            case 24:
            case 25:{
                break;
            }
            //Gold Potion
            case 26:
            case 27:{
                break;
            }
            //Spy Potion
            case 28:
            case 29:{
                break;
            }
            //Thief Potion
            case 30:
            case 31:{
                break;
            }
            //Guardian Potion
            case 32:
            case 33:{
                break;
            }
            //Refresh Potion
            case 34:
            case 35:{
                break;
            }
            //Supply Potion
            //Immediately draw 5 simple potion cards and put them in your Book of Knowledge.
            case 36:
            case 37:{
                // draw 2 simple
                $drawn = $this->cardDeck->pickCards(5, 'deckBasic', $player_id);
                // notify all cards drawn
                self::notifyAllPlayers('drawCardsPublic', clienttranslate('${player_name} draws ${count} advanced potions'), array(
                    'player_name' => $player_name,
                    'player_id' =>  $player_id,
                    'type' => 'basic',
                    'count' => count($drawn),
                ));
                // notify player of cards
                self::notifyPlayer($player_id, 'drawCardsPrivate', '', array(
                    'cards' => $drawn,
                ));
                break;
            }
            //Wisdom Potion
            //Draw 2 advanced Potion Cards and put them in your Book of Knowledge -even if you have less than 3 potions in your shop.
            case 38:
            case 39:{
                // draw 2 advanced
                $drawn = $this->cardDeck->pickCards(2, 'deckAdvanced', $player_id);
                // notify all cards drawn
                self::notifyAllPlayers($player_id, 'drawCardsPublic', clienttranslate('${player_name} draws ${count} advanced potions'), array(
                    'player_name' => $player_name,
                    'player_id' =>  $player_id,
                    'type' => 'advanced',
                    'count' => count($drawn),
                ));
                // notify player of cards
                self::notifyPlayer('drawCardsPrivate', '', array(
                    'cards' => $drawn,
                ));
                break;
            }
            //Doubling Potion
            //Draw 2 simple potion cards and add them to your shop. If you draw another doubling potion, discard it
            case 40:
            case 41:{
                // draw 2 simple
                $drawn = $this->cardDeck->pickCards(2, 'deckBasic', $player_id);
                //notify draw 2
                self::notifyAllPlayers('drawCardsPublic', clienttranslate('${player_name} draws ${count} simple potions'), array(
                    'player_name' => $player_name,
                    'player_id' =>  $player_id,
                    'type' => 'basic',
                    'count' => count($drawn),
                ));
                self::notifyPlayer($player_id, 'drawCardsPrivate', '', array(
                    'cards' => $drawn,
                ));
                foreach($drawn as $cardId => $card){
                    if($card->type == 40 || $card->type == 41){
                        $this->cardDeck->playCard($cardId);
                        //notify discard
                        self::notifyAllPlayers('discardFromHand', clienttranslate('${player_name} discards ${card_name}'), array(
                            'player_name' => $player_name,
                            'player_id' => $player_id,
                            'cardType' => $card->type,
                            'cardId' => $cardId,
                        ));
                    }
                }
                break;
            }
            //Time Potion
            //Immediately after the round ends, you get an extra round (all 4 phases). If more than one player use the Time Potion in the same round, they play in turns as if it were a normal round.
            case 42:
            case 43:{
                //todo
                break;
            }
        }

     }

     //stock shop with potion or item from hand
     //target: id of card to create
     //sources: array of id's of cards to be used to pay for the card
     function makePotionItem($targetId, $sourceIds) {
        //var_dump('makePotionItem',$targetId,$sourceIds);
        //$sourceIds = array(1,2,3);
        self::checkAction('makePotionItem');
        $player_id = self::getActivePlayerId();
        //add cost, subtract resources, check each ingredient for <= 0
        $target = $this->cardDeck->getCard($targetId)['type'];
        if(!isset($this->cards[$target])){
            throw new BgaVisibleSystemException ( self::_("An error has occured (Error A3a) please refresh your page") );
        }
        $costGold = $this->cards[$target]['costGold'];
        $costRes = array('A' => 0, 'B' =>0, 'C' =>0, 'D' => 0, 'E' => 0);
        foreach($this->cards[$target]['costIngredients'] as $res){
            $costRes[$res]++;
        }
        
        foreach($sourceIds as $key => $sourceId){
            if($targetId == $sourceId){
                throw new BgaUserException(self::_("You can not use the card being made as a resource"));
            }
            $source = $this->cardDeck->getCard($sourceId)['type'];
            if(!isset($this->cards[$source])){
                throw new BgaVisibleSystemException ( self::_("An error has occured (Error A3b) please refresh your page") );
            }
            if($this->cards[$source]['valueType'] == 'ingredient'){
                foreach($this->cards[$source]['valueIngredients'] as $res){
                    $costRes[$res]--;
                }
            } else if($this->cards[$source]['valueType'] == 'coin'){
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
            $this->cardDeck->moveCard($targetId, 'shops', $player_id);
            //discard resources from hand
            $this->discardCards($sourceIds);
            //notify players
            self::notifyAllPlayers('makePotionItem', clienttranslate('${player_name} creates ${item_name}'), array(
                'player_id' => $player_id,
                'player_name' => self::getActivePlayerName(),
                'targetId' => $targetId,
                'targetType' => $target,
                'item_name' => $this->cards[$target]['name'],
                'sourceIds' => $sourceIds,
            ));
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
        self::notifyPlayer($player_id, 'drawCardsPersonal','', array(
            'cards' => $picked
        ) );


        // Notify all players that cards were drawn
        self::notifyAllPlayers( 'drawCardsPublic', clienttranslate( '${player_name} draws ${count} basic potions' ), array(
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

        if($this->cardDeck->countCardInLocation('shop', $player_id) < 3){
            throw new BgaUserException(self::_("You can not draw advanced potions, you do not have enough stock in your shop"));
        }

        $picked = $this->cardDeck->pickCards(1,'deckAdvanced', $player_id);
        $count = count($picked); 
        
        if($count == 0){
            //deck is empty
            throw new BgaUserException(self::_("You can not draw more advanced potions, the deck is empty!"));
        }

        //Notify the reciving player the cards received
        self::notifyPlayer($player_id, 'drawCardsPersonal','', array(
            'cards' => $picked
        ) );


        // Notify all players that cards were drawn
        self::notifyAllPlayers( 'drawCardsPublic', clienttranslate( '${player_name} draws ${count} advanced potion' ), array(
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
        
        $item = $this->cardDeck->getCard($itemId);

        if($advancedCount < 2){ //2 advanced cards
            throw new BgaUserException(self::_("You can not draw items, you do not have enough advanced potions in your shop"));
        }

        if($this->cardDeck->getCard($itemId)['location'] != 'deckItem'){
            throw new BgaUserException(self::_("You can not draw that item, it is not avalible in the deck"));
        }

        $this->cardDeck->moveCard($itemId, 'hand', $player_id);
        
        //Notify the reciving player the cards received
        self::notifyPlayer($player_id, 'drawCardsPersonal','', array(
            'cards' => array($item),
        ) );


        // Notify all players that cards were drawn
        self::notifyAllPlayers( 'drawCardsPublic', clienttranslate( '${player_name} draws ${item_name} from the item deck' ), array(
            'player_id' => $player_id,
            'player_name' => self::getActivePlayerName(),
            'type' => 'item',
            'item_name' => $this->cards[$item['type']]['name'],
            'count' => 1,
        ) );

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

// check if any players have enough cards in shop to trigger end game and notify players
    function stPlayerTurnEnd(){
     //check end game condition
     $shopCount = $this->cardDeck->countCardsByLocationArgs('shop');
     foreach($shopCount as $id => $value){
        if($value >= 8){
            self::setGameStateValue('gameEnd', 1);
            break;
        }
     }
     //next player or next round
     $nextPlayer = $this->activeNextPlayer();
     if($nextPlayer == self::getGameStateValue('firstPlayer')){
         $this->gamestate->nextState('roundEnd');
     } else {
         $this->gamestate->nextState('playerTurnStart');
     }

    }

    // check if game end and score
    function stRoundEnd(){
     //todo
     //check game end and move to next round
     
         if(self::getGameStateValue('gameEnd') == 1){
              $this->gamestate->nextState("gameEnd");
          } else {
              $this->gamestate->nextstate("roundStart");
          }
          
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
