<?php

/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * magicshop implementation : © David Bond <David.CJ.Bond@gmail.com>
 *
 * This code has been produced on the BGA studio platform for use on https://boardgamearena.com.
 * See http://en.doc.boardgamearena.com/Studio for more information.
 * -----
 * 
 * magicshop.action.php
 *
 * magicshop main action entry point
 *
 *
 * In this file, you are describing all the methods that can be called from your
 * user interface logic (javascript).
 *       
 * If you define a method "myAction" here, then you can call it from your javascript code with:
 * this.ajaxcall( "/magicshop/magicshop/myAction.html", ...)
 *
 */


class action_magicshop extends APP_GameAction
{
  // Constructor: please do not modify
  public function __default()
  {
    if (self::isArg('notifwindow')) {
      $this->view = "common_notifwindow";
      $this->viewArgs['table'] = self::getArg("table", AT_posint, true);
    } else {
      $this->view = "magicshop_magicshop";
      self::trace("Complete reinitialization of board game");
    }
  }

  // TODO: defines your action entry points there


  /*
    
    Example:
  	
    public function myAction()
    {
        self::setAjaxMode();     

        // Retrieve arguments
        // Note: these arguments correspond to what has been sent through the javascript "ajaxcall" method
        $arg1 = self::getArg( "myArgument1", AT_posint, true );
        $arg2 = self::getArg( "myArgument2", AT_posint, true );

        // Then, call the appropriate method in your game logic, like "playCard" or "myAction"
        $this->game->myAction( $arg1, $arg2 );

        self::ajaxResponse( );
    }
    
    */

  public function actionPass()
  {
    self::setAjaxMode();
    $this->game->pass();
    self::ajaxResponse();
  }

  public function actionMake()
  {
    self::setAjaxMode();

    $arg1 = self::getArg('target', AT_posint, true);
    $arg2Raw = self::getArg('sources', AT_numberlist, true);
    $arg2Raw = trim($card_ids_raw);

    if ($arg2Raw == '') {
      $arg2 = array();
    } else {
      $arg2 = explode(' ', $arg2Raw);
    }

    $this->game->makePotionItem($arg1, $arg2);

    self::ajaxResponse();
  }

  public function actionDrawBasic(){
    self::setAjaxMode();

    $this->game->actionDrawBasic();

    self::ajaxResponse();
  }

  public function actionDrawAdvanced(){
    self::setAjaxMode();

    $this->game->actionDrawAdvanced();

    self::ajaxResponse();
    
  }

  public function actionDrawItem(){
    self::setAjaxMode();
    $arg1 = self::getArg('item', AT_posint, true);
    $this->game->actionDrawItem($arg1);
    self::ajaxResponse();
  }
}
