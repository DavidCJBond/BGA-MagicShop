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
 * material.inc.php
 *
 * magicshop game material description
 *
 * Here, you can describe the material of your game with PHP variables.
 *   
 * This file is loaded in your game logic class constructor, ie these variables
 * are available everywhere in your game logic code.
 *
 */


/*

Example:

$this->card_types = array(
    1 => array( "card_name" => ...,
                ...
              )
);

*/

$this->cards = array(
    0 => array(
        "type" => "item",
        "name" => clienttranslate("Stone of Influence"),
        "count" => 2,
        "points" => 7,
        "costGold" => 7,
        "costIngredients" => array( 'A', 'B', 'C', 'D', 'E'),
        "valueType" => "",
        "valueIngredients" => "",
        "effectDescription" => clienttranslate("You may decide the game ends when a player has not all 8, but only 7 shop spaces filled."),
        "image" => 10
    ),
    1 => array(
        "type" => "item",
        "name" => clienttranslate("Shield of Safety"),
        "count" => 2,
        "points" => 7,
        "costGold" => 7,
        "costIngredients" => array( 'A', 'B', 'C', 'D', 'E'),
        "valueType" => "",
        "valueIngredients" => "",
        "effectDescription" => clienttranslate("You are allowed to reorganise the potions in your shop and change their positions once per round."),
        "image" => 10
    ),
    2 => array(
        "type" => "item",
        "name" => clienttranslate("Helmet of Preservation"),
        "count" => 2,
        "points" => 7,
        "costGold" => 7,
        "costIngredients" => array( 'A', 'B', 'C', 'D', 'E'),
        "valueType" => "",
        "valueIngredients" => "",
        "effectDescription" => clienttranslate("The 2 spaces in your shop directly under the 2 display case spaces, are also display cases spaces now."),
        "image" => 10
    ),
    3 => array(
        "type" => "item",
        "name" => clienttranslate("Belt of Thievery"),
        "count" => 2,
        "points" => 7,
        "costGold" => 7,
        "costIngredients" => array( 'A', 'B', 'C', 'D', 'E'),
        "valueType" => "",
        "valueIngredients" => "",
        "effectDescription" => clienttranslate("When playing a Thief potion, you are allowed to steal an active potioncard. You can place it directly in your shop as normal. And your rival does not get to use it?s effect."),
        "image" => 10
    ),
    4 => array(
        "type" => "item",
        "name" => clienttranslate("Statue of Wisdom"),
        "count" => 2,
        "points" => 7,
        "costGold" => 7,
        "costIngredients" => array( 'A', 'B', 'C', 'D', 'E'),
        "valueType" => "",
        "valueIngredients" => "",
        "effectDescription" => clienttranslate("You receive 2 extra points if you finish the game with all 8 shop spaces filled."),
        "image" => 10
    ),
    5 => array(
        "type" => "item",
        "name" => clienttranslate("Necklace of Trades"),
        "count" => 2,
        "points" => 7,
        "costGold" => 7,
        "costIngredients" => array( 'A', 'B', 'C', 'D', 'E'),
        "valueType" => "",
        "valueIngredients" => "",
        "effectDescription" => clienttranslate("When producing a potion in phase 3, you can trade 2 different ingredients for an ingredient of choice (instead of 3 ingredients)."),
        "image" => 10
    ),
    6 => array(
        "type" => "item",
        "name" => clienttranslate("Dagger of Light"),
        "count" => 2,
        "points" => 7,
        "costGold" => 7,
        "costIngredients" => array( 'A', 'B', 'C', 'D', 'E'),
        "valueType" => "",
        "valueIngredients" => "",
        "effectDescription" => clienttranslate("Simple potions are always protected from Thiefpotion and Thief Nectar."),
        "image" => 10
    ),
    7 => array(
        "type" => "item",
        "name" => clienttranslate("Boots of Forthsight"),
        "count" => 2,
        "points" => 7,
        "costGold" => 7,
        "costIngredients" => array( 'A', 'B', 'C', 'D', 'E'),
        "valueType" => "",
        "valueIngredients" => "",
        "effectDescription" => clienttranslate("In phase 1, instead of 2, take 3 simple potion cards. Pick which ones you want to keep and discard the other."),
        "image" => 10
    ),
    8 => array(
        "type" => "advanced",
        "name" => clienttranslate("Production Liqueur"),
        "count" => 5,
        "points" => 4,
        "costGold" => 4,
        "costIngredients" => array( 'B', 'D', 'E'),
        "valueType" => "ingredient",
        "valueIngredients" => "array('C', 'D')",
        "effectDescription" => clienttranslate("To be used in phase 3 instead of phase 4. Gives you 3 extra ingredients in phase 3 when you produce a potion or magic item."),
        "image" => 10
    ),
    9 => array(
        "type" => "advanced",
        "name" => clienttranslate("Production Liqueur"),
        "count" => 1,
        "points" => 4,
        "costGold" => 4,
        "costIngredients" => array( 'B', 'D', 'E'),
        "valueType" => "coin",
        "valueIngredients" => "3",
        "effectDescription" => clienttranslate("To be used in phase 3 instead of phase 4. Gives you 3 extra ingredients in phase 3 when you produce a potion or magic item."),
        "image" => 10
    ),
    10 => array(
        "type" => "advanced",
        "name" => clienttranslate("Golden Water"),
        "count" => 5,
        "points" => 4,
        "costGold" => 4,
        "costIngredients" => array('A', 'C', 'D'),
        "valueType" => "ingredient",
        "valueIngredients" => "array('B', 'E')",
        "effectDescription" => clienttranslate("To be used in phase 3 instead of phase 4. Gives you 3 extra gold coins in phase 3 when you buy a potion or magic item. "),
        "image" => 10
    ),
    11 => array(
        "type" => "advanced",
        "name" => clienttranslate("Golden Water"),
        "count" => 1,
        "points" => 4,
        "costGold" => 4,
        "costIngredients" => array('A', 'C', 'D'),
        "valueType" => "coin",
        "valueIngredients" => "3",
        "effectDescription" => clienttranslate("To be used in phase 3 instead of phase 4. Gives you 3 extra gold coins in phase 3 when you buy a potion or magic item. "),
        "image" => 10
    ),
    12 => array(
        "type" => "advanced",
        "name" => clienttranslate("Spy Oil"),
        "count" => 5,
        "points" => 3,
        "costGold" => 3,
        "costIngredients" => array( 'A', 'B'),
        "valueType" => "ingredient",
        "valueIngredients" => "array('C', 'D')",
        "effectDescription" => clienttranslate("Choose a rival and view all cards in this players book of knowledge. Pick 2 of the potion cards (max 1 advanced)  and place them in your own book of knowledge. Your rival may use a Guardian Elixer. If so, you are not allowed to pick two cards, or even see the cards in the book of knowledge (depending on when the Guardian Elixer is played). In this case however, you get to draw a new simple potion card and a new advanced potion card from the deck and place them in you book of knowledge."),
        "image" => 10
    ),
    13 => array(
        "type" => "advanced",
        "name" => clienttranslate("Spy Oil"),
        "count" => 1,
        "points" => 3,
        "costGold" => 3,
        "costIngredients" => array( 'A', 'B'),
        "valueType" => "coin",
        "valueIngredients" => "3",
        "effectDescription" => clienttranslate("Choose a rival and view all cards in this players book of knowledge. Pick 2 of the potion cards (max 1 advanced)  and place them in your own book of knowledge. Your rival may use a Guardian Elixer. If so, you are not allowed to pick two cards, or even see the cards in the book of knowledge (depending on when the Guardian Elixer is played). In this case however, you get to draw a new simple potion card and a new advanced potion card from the deck and place them in you book of knowledge."),
        "image" => 10
    ),
    14 => array(
        "type" => "advanced",
        "name" => clienttranslate("Thief Nectar"),
        "count" => 5,
        "points" => 4,
        "costGold" => 4,
        "costIngredients" => array('A', 'C', 'E'),
        "valueType" => "ingredient",
        "valueIngredients" => "array('B', 'D')",
        "effectDescription" => clienttranslate("Steal a simple or advanced potion from a rival?s shop and add it to your own shop. Your rival may use a Guardian Elixer. If so, you are not allowed to steal a potion. In this case however, you get to draw a new advanced potion card from the deck and place it directly in your shop."),
        "image" => 10
    ),
    15 => array(
        "type" => "advanced",
        "name" => clienttranslate("Thief Nectar"),
        "count" => 1,
        "points" => 4,
        "costGold" => 4,
        "costIngredients" => array('A', 'C', 'E'),
        "valueType" => "coin",
        "valueIngredients" => "3",
        "effectDescription" => clienttranslate("Steal a simple or advanced potion from a rival?s shop and add it to your own shop. Your rival may use a Guardian Elixer. If so, you are not allowed to steal a potion. In this case however, you get to draw a new advanced potion card from the deck and place it directly in your shop."),
        "image" => 10
    ),
    16 => array(
        "type" => "advanced",
        "name" => clienttranslate("Guardian Elixer"),
        "count" => 5,
        "points" => 3,
        "costGold" => 3,
        "costIngredients" => array( 'B', 'C'),
        "valueType" => "ingredient",
        "valueIngredients" => "array('A', 'E')",
        "effectDescription" => clienttranslate("Protects you against all Spy or Thief potions. Can be used straight from your shop when you are attacked. You can play it immediately, or wait untill your rival tells you what card he wants to steal or take and decide then."),
        "image" => 10
    ),
    17 => array(
        "type" => "advanced",
        "name" => clienttranslate("Guardian Elixer"),
        "count" => 1,
        "points" => 3,
        "costGold" => 3,
        "costIngredients" => array( 'B', 'C'),
        "valueType" => "coin",
        "valueIngredients" => "3",
        "effectDescription" => clienttranslate("Protects you against all Spy or Thief potions. Can be used straight from your shop when you are attacked. You can play it immediately, or wait untill your rival tells you what card he wants to steal or take and decide then."),
        "image" => 10
    ),
    18 => array(
        "type" => "advanced",
        "name" => clienttranslate("Muliply Juice"),
        "count" => 5,
        "points" => 4,
        "costGold" => 4,
        "costIngredients" => array( 'A', 'D', 'E'),
        "valueType" => "star",
        "valueIngredients" => "1",
        "effectDescription" => clienttranslate("To be used in phase 1 of the next round, instead of phase 4. In phase 1 of the next round, you may draw three times the amount of potion cards you normaly draw. Or chose 2 item cards."),
        "image" => 10
    ),
    19 => array(
        "type" => "advanced",
        "name" => clienttranslate("Muliply Juice"),
        "count" => 1,
        "points" => 4,
        "costGold" => 4,
        "costIngredients" => array('A', 'D', 'E'),
        "valueType" => "coin",
        "valueIngredients" => "3",
        "effectDescription" => clienttranslate("To be used in phase 1 of the next round, instead of phase 4. In phase 1 of the next round, you may draw three times the amount of potion cards you normaly draw. Or chose 2 item cards."),
        "image" => 10
    ),
    20 => array(
        "type" => "advanced",
        "name" => clienttranslate("Sorcery Tonic"),
        "count" => 5,
        "points" => 5,
        "costGold" => 5,
        "costIngredients" => array( 'A', 'B', 'C', 'D'),
        "valueType" => "star",
        "valueIngredients" => "1",
        "effectDescription" => clienttranslate("Take the deck of item cards and shuffle it. Put it in front of you and draw the card on top. Add the card directly to your shop."),
        "image" => 10
    ),
    21 => array(
        "type" => "advanced",
        "name" => clienttranslate("Sorcery Tonic"),
        "count" => 1,
        "points" => 5,
        "costGold" => 5,
        "costIngredients" => array( 'A', 'B', 'C', 'D'),
        "valueType" => "coin",
        "valueIngredients" => "3",
        "effectDescription" => clienttranslate("Take the deck of item cards and shuffle it. Put it in front of you and draw the card on top. Add the card directly to your shop."),
        "image" => 10
    ),
    22 => array(
        "type" => "advanced",
        "name" => clienttranslate("Wisdom Wine"),
        "count" => 5,
        "points" => 5,
        "costGold" => 5,
        "costIngredients" => array( 'B', 'C', 'D', 'E'),
        "valueType" => "star",
        "valueIngredients" => "1",
        "effectDescription" => clienttranslate("Choose 1 item card and draw 4 advanced potion cards. Put all 5 cards in your book of knowledge."),
        "image" => 10
    ),
    23 => array(
        "type" => "advanced",
        "name" => clienttranslate("Wisdom Wine"),
        "count" => 1,
        "points" => 5,
        "costGold" => 5,
        "costIngredients" => array( 'B', 'C', 'D', 'E'),
        "valueType" => "coin",
        "valueIngredients" => "3",
        "effectDescription" => clienttranslate("Choose 1 item card and draw 4 advanced potion cards. Put all 5 cards in your book of knowledge."),
        "image" => 10
    ),
    24 => array(
        "type" => "basic",
        "name" => clienttranslate("Productionpotion"),
        "count" => 6,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array( 'A', 'E'),
        "valueType" => "ingredient",
        "valueIngredients" => "array('B')",
        "effectDescription" => clienttranslate("To be used in phase 3 instead of phase 4. Gives you 2 extra ingredients in phase 3 when you produce a potion or magic item. So when producing potions that need 1 or 2 ingredients, you don?t need to hand in any other cards."),
        "image" => 0
    ),
    25 => array(
        "type" => "basic",
        "name" => clienttranslate("Productionpotion"),
        "count" => 2,
        "points" => 2,
        "costGold" => 3,
        "costIngredients" => array(),
        "valueType" => "coin",
        "valueIngredients" => "1",
        "effectDescription" => clienttranslate("To be used in phase 3 instead of phase 4. Gives you 2 extra ingredients in phase 3 when you produce a potion or magic item. So when producing potions that need 1 or 2 ingredients, you don?t need to hand in any other cards."),
        "image" => 0
    ),
    26 => array(
        "type" => "basic",
        "name" => clienttranslate("Goldpotion"),
        "count" => 6,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array('D', 'E'),
        "valueType" => "ingredient",
        "valueIngredients" => "array('E')",
        "effectDescription" => clienttranslate("To be used in phase 3 instead of phase 4. Gives you 2 extra gold coins in phase 3 when you buy a potion or magic item. So when buying potions that cost 1 or 2 gold coins, you don?t need to hand in any other cards. "),
        "image" => 2
    ),
    27 => array(
        "type" => "basic",
        "name" => clienttranslate("Goldpotion"),
        "count" => 2,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array(),
        "valueType" => "coin",
        "valueIngredients" => "1",
        "effectDescription" => clienttranslate("To be used in phase 3 instead of phase 4. Gives you 2 extra gold coins in phase 3 when you buy a potion or magic item. So when buying potions that cost 1 or 2 gold coins, you don?t need to hand in any other cards. "),
        "image" => 2
    ),
    28 => array(
        "type" => "basic",
        "name" => clienttranslate("Spypotion "),
        "count" => 6,
        "points" => 1,
        "costGold" => 1,
        "costIngredients" => array('A'),
        "valueType" => "ingredient",
        "valueIngredients" => "array('C')",
        "effectDescription" => clienttranslate("Choose a rival and view all cards in this players book of knowledge. Pick 1 of the simple potion cards and place it in your own book of knowledge. Your rival may use a guardian potion or Guardian Elixer. If so, you are not allowed to pick a card, or even see the cards in the book of knowledge (depending on when the Guardianpotion or -Elixer is played). In this case however, you get to draw a new simple potion card from the deck and place it in you book of knowledge."),
        "image" => 5
    ),
    29 => array(
        "type" => "basic",
        "name" => clienttranslate("Spypotion "),
        "count" => 2,
        "points" => 1,
        "costGold" => 1,
        "costIngredients" => array(),
        "valueType" => "coin",
        "valueIngredients" => "1",
        "effectDescription" => clienttranslate("Choose a rival and view all cards in this players book of knowledge. Pick 1 of the simple potion cards and place it in your own book of knowledge. Your rival may use a guardian potion or Guardian Elixer. If so, you are not allowed to pick a card, or even see the cards in the book of knowledge (depending on when the Guardianpotion or -Elixer is played). In this case however, you get to draw a new simple potion card from the deck and place it in you book of knowledge."),
        "image" => 5
    ),
    30 => array(
        "type" => "basic",
        "name" => clienttranslate("Thiefpotion "),
        "count" => 6,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array('C', 'E'),
        "valueType" => "ingredient",
        "valueIngredients" => "array('D')",
        "effectDescription" => clienttranslate("Steal a simple potion from a rival's shop and add it to your own shop. Your rival may use a guardian potion or Guardian Elixer. If so, you are not allowed to steal a potion. In this case however, you get to draw a new simple potion card from the deck and place it directly in your shop. "),
        "image" => 7
    ),
    31 => array(
        "type" => "basic",
        "name" => clienttranslate("Thiefpotion "),
        "count" => 2,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array(),
        "valueType" => "coin",
        "valueIngredients" => "1",
        "effectDescription" => clienttranslate("Steal a simple potion from a rival's shop and add it to your own shop. Your rival may use a guardian potion or Guardian Elixer. If so, you are not allowed to steal a potion. In this case however, you get to draw a new simple potion card from the deck and place it directly in your shop. "),
        "image" => 7
    ),
    32 => array(
        "type" => "basic",
        "name" => clienttranslate("Guardianpotion"),
        "count" => 6,
        "points" => 1,
        "costGold" => 1,
        "costIngredients" => array('D'),
        "valueType" => "ingredient",
        "valueIngredients" => "array('B')",
        "effectDescription" => clienttranslate("Protects you against Spypotion or Thiefpotion. This potion never has to be made active in phase 2. Can be used straight from your shop when you are attacked. You can play it immediately, or wait untill your rival tells you what card he want?s to steal or take."),
        "image" => 3
    ),
    33 => array(
        "type" => "basic",
        "name" => clienttranslate("Guardianpotion"),
        "count" => 2,
        "points" => 1,
        "costGold" => 1,
        "costIngredients" => array(),
        "valueType" => "coin",
        "valueIngredients" => "1",
        "effectDescription" => clienttranslate("Protects you against Spypotion or Thiefpotion. This potion never has to be made active in phase 2. Can be used straight from your shop when you are attacked. You can play it immediately, or wait untill your rival tells you what card he want?s to steal or take."),
        "image" => 3
    ),
    34 => array(
        "type" => "basic",
        "name" => clienttranslate("Refreshpotion"),
        "count" => 6,
        "points" => 1,
        "costGold" => 1,
        "costIngredients" => array('C'),
        "valueType" => "ingredient",
        "valueIngredients" => "array('D')",
        "effectDescription" => clienttranslate("Put all potion cards currently in your book of knowledge aside. Draw the same number of simple and advanced potioncards from the decks and put them in your book of knowledge. Then draw 2 more simple potioncards and put them in your book as well. Discard all the potioncards you put aside. "),
        "image" => 4
    ),
    35 => array(
        "type" => "basic",
        "name" => clienttranslate("Refreshpotion"),
        "count" => 2,
        "points" => 1,
        "costGold" => 1,
        "costIngredients" => array(),
        "valueType" => "coin",
        "valueIngredients" => "1",
        "effectDescription" => clienttranslate("Put all potion cards currently in your book of knowledge aside. Draw the same number of simple and advanced potioncards from the decks and put them in your book of knowledge. Then draw 2 more simple potioncards and put them in your book as well. Discard all the potioncards you put aside. "),
        "image" => 4
    ),
    36 => array(
        "type" => "basic",
        "name" => clienttranslate("Supplypotion"),
        "count" => 6,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array( 'A', 'C'),
        "valueType" => "ingredient",
        "valueIngredients" => "array('A')",
        "effectDescription" => clienttranslate("Immediately draw 5 simple potioncards and put the in your book of knowledge. "),
        "image" => 6
    ),
    37 => array(
        "type" => "basic",
        "name" => clienttranslate("Supplypotion"),
        "count" => 2,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array(),
        "valueType" => "coin",
        "valueIngredients" => "1",
        "effectDescription" => clienttranslate("Immediately draw 5 simple potioncards and put the in your book of knowledge. "),
        "image" => 6
    ),
    38 => array(
        "type" => "basic",
        "name" => clienttranslate("Knowledgepotion"),
        "count" => 6,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array('B', 'E'),
        "valueType" => "ingredient",
        "valueIngredients" => "array('E')",
        "effectDescription" => clienttranslate("Draw 2 advanced potioncards and put the in your book of knowledge. Also if you have less than 3 potions in your shop. "),
        "image" => 9
    ),
    39 => array(
        "type" => "basic",
        "name" => clienttranslate("Knowledgepotion"),
        "count" => 2,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array(),
        "valueType" => "coin",
        "valueIngredients" => "1",
        "effectDescription" => clienttranslate("Draw 2 advanced potioncards and put the in your book of knowledge. Also if you have less than 3 potions in your shop. "),
        "image" => 9
    ),
    40 => array(
        "type" => "basic",
        "name" => clienttranslate("Doublepotion"),
        "count" => 6,
        "points" => 3,
        "costGold" => 3,
        "costIngredients" => array( 'A', 'B', 'E'),
        "valueType" => "ingredient",
        "valueIngredients" => "array('C')",
        "effectDescription" => clienttranslate("Draw 2 simple potioncards from the deck and add them directly to your shop. When you draw a new Doublepotion, discard it and draw another simple potioncard. "),
        "image" => 1
    ),
    41 => array(
        "type" => "basic",
        "name" => clienttranslate("Doublepotion"),
        "count" => 2,
        "points" => 3,
        "costGold" => 3,
        "costIngredients" => array(),
        "valueType" => "coin",
        "valueIngredients" => "1",
        "effectDescription" => clienttranslate("Draw 2 simple potioncards from the deck and add them directly to your shop. When you draw a new Doublepotion, discard it and draw another simple potioncard. "),
        "image" => 1
    ),
    42 => array(
        "type" => "basic",
        "name" => clienttranslate("Timepotion"),
        "count" => 6,
        "points" => 3,
        "costGold" => 3,
        "costIngredients" => array( 'B', 'C', 'D'),
        "valueType" => "ingredient",
        "valueIngredients" => "array('A')",
        "effectDescription" => clienttranslate("To be used at the end of the round, instead of phase 4. Immediately after this round ends, you get an extra round. So all 4 phases. If more players use Timepotion in the same round, they play in turns like in a normal round."),
        "image" => 8
    ),
    43 => array(
        "type" => "basic",
        "name" => clienttranslate("Timepotion"),
        "count" => 2,
        "points" => 3,
        "costGold" => 3,
        "costIngredients" => array(),
        "valueType" => "coin",
        "valueIngredients" => "1",
        "effectDescription" => clienttranslate("To be used at the end of the round, instead of phase 4. Immediately after this round ends, you get an extra round. So all 4 phases. If more players use Timepotion in the same round, they play in turns like in a normal round."),
        "image" => 8
    )
);