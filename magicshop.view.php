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
 * magicshop.view.php
 *
 * This is your "view" file.
 *
 * The method "build_page" below is called each time the game interface is displayed to a player, ie:
 * _ when the game starts
 * _ when a player refreshes the game page (F5)
 *
 * "build_page" method allows you to dynamically modify the HTML generated for the game interface. In
 * particular, you can set here the values of variables elements defined in magicshop_magicshop.tpl (elements
 * like {MY_VARIABLE_ELEMENT}), and insert HTML block elements (also defined in your HTML template file)
 *
 * Note: if the HTML of your game interface is always the same, you don't have to place anything here.
 *
 */
  
  require_once( APP_BASE_PATH."view/common/game.view.php" );
  
  class view_magicshop_magicshop extends game_view
  {
    function getGameName() {
        return "magicshop";
    }    
  	function build_page( $viewArgs )
  	{		
  	    // Get players & players number
        $players = $this->game->loadPlayersBasicInfos();
        $players_nbr = count( $players );
			global $g_user;
			$currentPlayerId = $g_user->get_id();
        /*********** Place your code below:  ************/


        /*
        
        // Examples: set the value of some element defined in your tpl file like this: {MY_VARIABLE_ELEMENT}

        // Display a specific number / string
        $this->tpl['MY_VARIABLE_ELEMENT'] = $number_to_display;

        // Display a string to be translated in all languages: 
        $this->tpl['MY_VARIABLE_ELEMENT'] = self::_("A string to be translated");

        // Display some HTML content of your own:
        $this->tpl['MY_VARIABLE_ELEMENT'] = self::raw( $some_html_code );
        
        */
        
        /*
        
        // Example: display a specific HTML block for each player in this game.
        // (note: the block is defined in your .tpl file like this:
        //      <!-- BEGIN myblock --> 
        //          ... my HTML code ...
        //      <!-- END myblock --> 
        

        $this->page->begin_block( "magicshop_magicshop", "myblock" );
        foreach( $players as $player )
        {
            $this->page->insert_block( "myblock", array( 
                                                    "PLAYER_NAME" => $player['player_name'],
                                                    "SOME_VARIABLE" => $some_value
                                                    ...
                                                     ) );
        }
        
        */

        $this->tpl['BASIC_POTIONS'] = _("Basic Potions");
        $this->tpl['ADVANCED_POTIONS'] = _("Advanced Potions");
        $this->tpl['ITEMS'] = _("Items");

        $this->page->begin_block( "magicshop_magicshop", "playerShops" );
        foreach( $players as $playerId => $info )
        {
            if($playerId != $currentPlayerId){
                $this->page->insert_block( "playerShops", array(
                    "PLAYER_ID" => $playerId,
                    "PLAYER_NAME" => $info['player_name'],
                    "PLAYER_COLOUR" => $info['player_color']
                ) );
            }
        }

    
        $this->tpl["CURRENT_PLAYER_ID"] = $currentPlayerId;
//        $this->tpl["CURRENT_PLAYER_SHOP"] = $players[$currentPlayerId]['player_name'];
//        $this->tpl["CURRENT_PLAYER_COLOUR"] = $players[$currentPlayerId]['player_color'];
        $this->tpl["CURRENT_PLAYER_SHOP"] = _('Your Shop'); //$players[$currentPlayerId]['player_name'];
        $this->tpl["CURRENT_PLAYER_HAND"] = _('Your Hand');




        /*********** Do not change anything below this line  ************/
  	}
  }
  

