/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * magicshop implementation : © David Bond <David.CJ.Bond@gmail.com>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * magicshop.js
 *
 * magicshop user interface script
 * 
 * In this file, you are describing the logic of your user interface, in Javascript language.
 *
 */

define([
        "dojo", "dojo/_base/declare",
        "ebg/core/gamegui",
        "ebg/counter",
        "ebg/stock",
        "ebg/zone"
    ],
    function(dojo, declare) {
        return declare("bgagame.magicshop", ebg.core.gamegui, {
            constructor: function() {
                console.log('magicshop constructor');

                // Here, you can init the global variables of your user interface
                // Example:
                // this.myGlobalValue = 0;
                this.playerHand = null;
                this.cardWidth = 103;
                this.cardHeight = 156;
                this.basicTypeId = 100;
                this.advancedTypeId = 200;
                this.itemTypeId = 300;
                this.shopWidth = 372;
                this.shopHeight = 526;

                this.stockItemDisplay = null;




            },

            /*
                setup:
                
                This method must set up the game user interface according to current game situation specified
                in parameters.
                
                The method is called each time the game interface is displayed to a player, ie:
                _ when the game starts
                _ when a player refreshes the game page (F5)
                
                "gamedatas" argument contains all datas retrieved by your "getAllDatas" PHP method.
            */

            //todo display cards on player shops
            setup: function(gamedatas) {
                console.log("Starting game setup");

                // Setting up player boards
                for (var player_id in gamedatas.players) {
                    var player = gamedatas.players[player_id];

                    // TODO: Setting up players boards if needed
                }

                // TODO: Set up your game interface here, according to "gamedatas"
                //setup player hand
                this.playerHand = new ebg.stock();
                this.playerHand.create(this, $('myhand'), this.cardWidth, this.cardHeight);
                this.playerHand.onItemCreate = dojo.hitch( this, 'setupNewCard' );

                this.playerHand.image_items_per_row = 10;
                for (var cardType in gamedatas.cardInfo) {
                    this.playerHand.addItemType(cardType, cardType, g_gamethemeurl + 'img/spritesheet.jpg', gamedatas.cardInfo[cardType]['image']);
                }
                // Cards in player's hand
                /*
                for (var cardId in gamedatas['handBasic']) {
                    var card = gamedatas['handBasic'][cardId];
                    this.playerHand.addToStockWithId(card.type, this.basicTypeId + card.id);
                }
                for (var cardId in gamedatas['handAdvanced']) {
                    var card = gamedatas['handAdvanced'][cardId];
                    this.playerHand.addToStockWithId(card.type, this.advancedTypeId + card.id);
                }
                for (var cardId in gamedatas['handItem']) {
                    var card = gamedatas['handItem'][cardId];
                    this.playerHand.addToStockWithId(card.type, this.itemTypeId + card.id);
                }
                */
                for(var cardId in gamedatas['hand']){
                    var card = gamedatas['hand'][cardId];
                    this.playerHand.addToStockWithId(card.type, card.id);
                }


                //setup shop zone
                this.shopZones = {};
                for (var player_id in gamedatas.players) {
                    this.shopZones[player_id] = new ebg.zone();
                    this.shopZones[player_id].create(this, 'playerShop_' + player_id, this.cardWidth, this.cardHeight);
                    //custom does not exist
                    //this.shopZones[player_id].setPattern('custom');
                    this.shopZones[player_id].autoheight = false;
                    this.shopZones[player_id].itemIdToCoords = function(i) {
                        if (i == 0) {
                            return { x: 10, y: 195, w: 372, h: 156 };
                        } else if (i == 1) {
                            return { x: 130, y: 195, w: 372, h: 156 };
                        } else if (i == 2) {
                            return { x: 250, y: 195, w: 372, h: 156 };
                        } else if (i == 3) {
                            return { x: 10, y: 360, w: 372, h: 156 };
                        } else if (i == 4) {
                            return { x: 130, y: 360, w: 372, h: 156 };
                        } else {//if (i == 5) {
                            return { x: 250, y: 360, w: 372, h: 156 };
                        }
                    }

                    //test
                    for (var i = 0; i < 6; ++i) {
                        dojo.place(this.format_block('jstpl_test', {
                            player: player_id,
                            id: i
                        }), 'tests');
                        this.shopZones[player_id].placeInZone('test_' + player_id + '_' + i);
                    }
                }
                this.shopZonesJC = {};
                for (var player_id in gamedatas.players) {
                    this.shopZonesJC[player_id] = new ebg.zone();
                    this.shopZonesJC[player_id].create(this, 'playerShop_' + player_id, this.cardWidth, this.cardHeight);
                    //custom does not exist
                    //this.shopZonesJC[player_id].setPattern('custom');
                    this.shopZonesJC[player_id].autoheight = false;
                    this.shopZonesJC[player_id].itemIdToCoords = function(i) {
                        if (i == 0) {
                            return { x: 130, y: 30, w: 372, h: 156 };
                        } else {
                            return { x: 250, y: 30, w: 372, h: 156 };
                        }
                    }
                    //test
                    for (var i = 0; i < 2; ++i) {
                        dojo.place(this.format_block('jstpl_test', {
                            player: player_id,
                            id: i+'jc'
                        }), 'tests');
                        this.shopZonesJC[player_id].placeInZone('test_' + player_id + '_' + i+'jc');
                    }
                }

                //setup item display
                this.stockItemDisplay = new ebg.stock();
                this.stockItemDisplay.create(this, $('itemDeckDisplay'), this.cardWidth, this.cardHeight);
                this.stockItemDisplay.onItemCreate = dojo.hitch( this, 'setupNewCard' );

                this.stockItemDisplay.image_items_per_row = 10;
                for (var cardType in gamedatas.cardInfo) {
                    if(gamedatas.cardInfo[cardType]['type'] == 'item'){
                        this.stockItemDisplay.addItemType(cardType, cardType, g_gamethemeurl + 'img/spritesheet.jpg', gamedatas.cardInfo[cardType]['image']);
                    }
                }
                for(var cardId in gamedatas['deckItem']){
                    var card = gamedatas['deckItem'][cardId];
                    this.stockItemDisplay.addToStockWithId(card.type, card.id);
                }



                // Setup game notifications to handle (see "setupNotifications" method below)
                this.setupNotifications();

                console.log("Ending game setup");
            },


            ///////////////////////////////////////////////////
            //// Game & client states

            // onEnteringState: this method is called each time we are entering into a new game state.
            //                  You can use this method to perform some user interface changes at this moment.
            //
            onEnteringState: function(stateName, args) {
                console.log('Entering state: ' + stateName);

                switch (stateName) {

                    /* Example:
            
            case 'myGameState':
            
                // Show some HTML block at this game state
                dojo.style( 'my_html_block_id', 'display', 'block' );
                
                break;
           */


                    case 'dummmy':
                        break;
                }
            },

            // onLeavingState: this method is called each time we are leaving a game state.
            //                 You can use this method to perform some user interface changes at this moment.
            //
            onLeavingState: function(stateName) {
                console.log('Leaving state: ' + stateName);

                switch (stateName) {

                    /* Example:
            
            case 'myGameState':
            
                // Hide the HTML block we are displaying only during this game state
                dojo.style( 'my_html_block_id', 'display', 'none' );
                
                break;
           */


                    case 'dummmy':
                        break;
                }
            },

            // onUpdateActionButtons: in this method you can manage "action buttons" that are displayed in the
            //                        action status bar (ie: the HTML links in the status bar).
            //        
            onUpdateActionButtons: function(stateName, args) {
                console.log('onUpdateActionButtons: ' + stateName);

                if (this.isCurrentPlayerActive()) {
                    switch (stateName) {
                        /*               
                                         Example:
                         
                                         case 'myGameState':
                                            
                                            // Add 3 action buttons in the action status bar:
                                            
                                            this.addActionButton( 'button_1_id', _('Button 1 label'), 'onMyMethodToCall1' ); 
                                            this.addActionButton( 'button_2_id', _('Button 2 label'), 'onMyMethodToCall2' ); 
                                            this.addActionButton( 'button_3_id', _('Button 3 label'), 'onMyMethodToCall3' ); 
                                            break;
                        */
                       case 'playerTurn1':{
                           this.addActionButton('buttonDrawBasic', _('Draw 2 basic potions'), 'onActionDrawBasic');
                           if(true){//if shop contains enough potions
                            this.addActionButton('buttonDrawAdvanced', _('Draw 1 advanced potion'), 'onActionDrawAdvanced');
                           }
                           if(true){//if shop contains enough potions
                            this.addActionButton('buttonDrawItem', _('Select 1 item to draw'), 'onActionDrawItem');
                           }
                           break;

                       }
                        case 'playerTurn2':
                            {
                                this.addActionButton('buttonActionPass', _('Pass'), 'onActionPass');
                                break;
                            }
                        case 'playerTurn3':
                            {
                                this.addActionButton('buttonActionPass', _('Pass'), 'onActionPass');
                                break;
                            }
                        case 'playerTurn4':
                            {
                                this.addActionButton('buttonActionPass', _('Pass'), 'onActionPass');
                                break;
                            }

                    }
                }
            },

            ///////////////////////////////////////////////////
            //// Utility methods

            /*
        
                Here, you can defines some utility methods that you can use everywhere in your javascript
                script.
        
            */

            setupNewCard: function(card_div, card_type_id, card_id) {
                this.addTooltip(card_div.id, this.gamedatas['cardInfo'][card_type_id]['effectDescription'], '');
            },

            /*
                Id conversion
                +0 basic
                +1 advanced
                +2 item
            */
            idToCombo: function(id, typeId){
                var typeOffset = 0; //basic
                if(this.gamedatas.cardInfo[typeId]['type'] == 'advanced'){
                    typeOffset = 1;
                } else if (this.gamedatas.cardInfo[typeId]['type'] == 'item'){
                    typeOffset = 2;
                }
                id *= 3;
                id += typeOffset;
                return id;
            },

            ///////////////////////////////////////////////////
            //// Player's action

            /*
        
                Here, you are defining methods to handle player's action (ex: results of mouse click on 
                game objects).
                
                Most of the time, these methods:
                _ check the action is possible at this game state.
                _ make a call to the game server
        
            */

            /* Example:
        
            onMyMethodToCall1: function( evt )
            {
                console.log( 'onMyMethodToCall1' );
                
                // Preventing default browser reaction
                dojo.stopEvent( evt );

                // Check that this action is possible (see "possibleactions" in states.inc.php)
                if( ! this.checkAction( 'myAction' ) )
                {   return; }

                this.ajaxcall( "/magicshop/magicshop/myAction.html", { 
                                                                        lock: true, 
                                                                        myArgument1: arg1, 
                                                                        myArgument2: arg2,
                                                                        ...
                                                                     }, 
                             this, function( result ) {
                                
                                // What to do after the server call if it succeeded
                                // (most of the time: nothing)
                                
                             }, function( is_error) {

                                // What to do after the server call in anyway (success or failure)
                                // (most of the time: nothing)

                             } );        
            },        
        
            */
            onActionPass: function(evt) {
                console.log('onActionPass');

                // Preventing default browser reaction
                dojo.stopEvent(evt);

                // Check that this action is possible (see "possibleactions" in states.inc.php)
                if (!this.checkAction('pass')) {
                    return;
                }

                this.ajaxcall('/magicshop/magicshop/actionPass.html', { lock: true }, this, function(result) {}, function(is_error) {});

            },

            onActionDrawBasic: function(evt){
                console.log('onActionDrawBasic');

                dojo.stopEvent(evt);

                if(!this.checkAction('drawBasic')){
                    return;
                }

                this.ajaxcall('/magicshop/magicshop/actionDrawBasic.html', { lock: true }, this, function(result) {}, function(is_error) {});
            },

            onActionDrawAdvanced: function(evt){
                console.log('onActionDrawAdvanced');

                dojo.stopEvent(evt);

                if(!this.checkAction('drawAdvanced')){
                    return;
                }

                this.ajaxcall('/magicshop/magicshop/actionDrawAdvanced.html', { lock: true }, this, function(result) {}, function(is_error) {});
            },

            //todo determine desired item and send id
            onActionDrawItem: function(evt){
                console.log('onActionDrawItem');

                dojo.stopEvent(evt);

                if(!this.checkAction('drawItem')){
                    return;
                }

                var id = 0;

                this.ajaxcall('/magicshop/magicshop/actionDrawItem.html', { lock: true, item: id }, this, function(result) {}, function(is_error) {});
            },

            ///////////////////////////////////////////////////
            //// Reaction to cometD notifications

            /*
                setupNotifications:
                
                In this method, you associate each of your game notifications with your local method to handle it.
                
                Note: game notification names correspond to "notifyAllPlayers" and "notifyPlayer" calls in
                      your magicshop.game.php file.
        
            */
            setupNotifications: function() {
                console.log('notifications subscriptions setup');

                // TODO: here, associate your game notifications with local methods

                // Example 1: standard notification handling
                // dojo.subscribe( 'cardPlayed', this, "notif_cardPlayed" );

                // Example 2: standard notification handling + tell the user interface to wait
                //            during 3 seconds after calling the method in order to let the players
                //            see what is happening in the game.
                // dojo.subscribe( 'cardPlayed', this, "notif_cardPlayed" );
                // this.notifqueue.setSynchronous( 'cardPlayed', 3000 );
                // 
                dojo.subscribe('drawCards', this, 'notif_drawCards');
                dojo.subscribe('drawCardsPersonal', this, 'notif_drawCardsPersonal');
            },

            // TODO: from this point and below, you can write your game notifications handling methods

            /*
            Example:
        
            notif_cardPlayed: function( notif )
            {
                console.log( 'notif_cardPlayed' );
                console.log( notif );
                
                // Note: notif.args contains the arguments specified during you "notifyAllPlayers" / "notifyPlayer" PHP call
                
                // TODO: play the card in the user interface.
            },    
        
            */
           notif_drawCards: function(notif){
               console.log('notif_drawCards');
            //    notif.args.player_id
            //    notif.args.type
            //    notif.args.count

            var src;
            if(notif.args.type == 'basic'){
                src = 'basicPotionDeck';
            } else if (notif.args.type == 'advanced'){
                src = 'advancedPotionDeck';
            } else {
                src = 'itemDeck';
            }
            var dest = 'player_board_' + notif.args.player_id;

            //this.slideTemporaryObject( mobile_obj_html, mobile_obj_parent, from, to, duration, delay )
            for(var i = 0; i < notif.args.count; ++i){
                this.slideTemporaryObject('<div class="cardBack"></div>', src, src, dest, 500, 100 * i);
            }
            
           },


            notif_drawCardsPersonal: function(notif) {
                console.log('notif_drawCards');
                // Cards in player's hand
                for (var cardId in notif.args.cards) {
                    var card = notif.args.cards[cardId];
                    var type = this.gamedatas.cards[card['type']];
                    if (type == 'basic') {
                        //cardId += this.basicTypeId;
                        this.playerHand.addToStockWithId(card.type, cardId, 'basicPotionDeck');
                    } else if (type == 'advanced') {
                        //cardId += this.advancedTypeId;
                        this.playerHand.addToStockWithId(card.type, cardId, 'advancedPotionDeck');
                    } else if (type == 'item') {
                        //cardId += this.itemTypeId;
                        this.playerHand.addToStockWithId(card.type, cardId, 'itemDeck');
                    }
                }
            },

            notif_activateCard: function(notif) {

            },

            notif_playCard: function(notif) {

            }

        });
    });