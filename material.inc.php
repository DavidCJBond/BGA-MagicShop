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



$this->cards = array(
    0 => array(
        "type" => "item",
        "name" => clienttranslate("Sword of Influence"),
        "count" => 2,
        "points" => 7,
        "costGold" => 7,
        "costIngredients" => array( 'A', 'B', 'C', 'D', 'E'),
        "valueType" => "",
        "valueIngredients" => "",
        "effectDescription" => clienttranslate("You can decide the game ends when a player fills a 7th shop space (instead of all 8 shop spaces). Apart from the fact that no one will have all 8 shop spaces filled, the game plays out exactly the same as described on page 8. You can make this decision as soon as a 7th card is placed on any shop board."),
        "image" => 10
    ),
    1 => array(
        "type" => "item",
        "name" => clienttranslate("Shield of Resistance"),
        "count" => 2,
        "points" => 7,
        "costGold" => 7,
        "costIngredients" => array( 'A', 'B', 'C', 'D', 'E'),
        "valueType" => "",
        "valueIngredients" => "",
        "effectDescription" => clienttranslate("You are allowed to reorganise the potions in your shop and change their positions once per round - including the cards in the display cases."),
        "image" => 10
    ),
    2 => array(
        "type" => "item",
        "name" => clienttranslate("Helmet of Safekeeping"),
        "count" => 2,
        "points" => 7,
        "costGold" => 7,
        "costIngredients" => array( 'A', 'B', 'C', 'D', 'E'),
        "valueType" => "",
        "valueIngredients" => "",
        "effectDescription" => clienttranslate("2 of your normal shop spaces are turned into display case spaces. Which means you have 4 display case spaces now. "),
        "image" => 10
    ),
    3 => array(
        "type" => "item",
        "name" => clienttranslate("Axe of Thievery"),
        "count" => 2,
        "points" => 7,
        "costGold" => 7,
        "costIngredients" => array( 'A', 'B', 'C', 'D', 'E'),
        "valueType" => "",
        "valueIngredients" => "",
        "effectDescription" => clienttranslate("When playing a Thief Potion or Thief Nectar, you are allowed to steal an active potion card. You can place it directly in your shop as normal and your rival does not get to use its effect. Guardian Potion and Guardian Elixier can still protect against the theft."),
        "image" => 10
    ),
    4 => array(
        "type" => "item",
        "name" => clienttranslate("Mace of Wisdom"),
        "count" => 2,
        "points" => 7,
        "costGold" => 7,
        "costIngredients" => array( 'A', 'B', 'C', 'D', 'E'),
        "valueType" => "",
        "valueIngredients" => "",
        "effectDescription" => clienttranslate("You receive 2 extra points if you have all 8 shop spaces filled when the game ends. The game ends when all players have finished the final round."),
        "image" => 10
    ),
    5 => array(
        "type" => "item",
        "name" => clienttranslate("Hammer of Trading"),
        "count" => 2,
        "points" => 7,
        "costGold" => 7,
        "costIngredients" => array( 'A', 'B', 'C', 'D', 'E'),
        "valueType" => "",
        "valueIngredients" => "",
        "effectDescription" => clienttranslate("When producing a potion in phase 3, you can trade 2 different ingredients for an ingredient of your choice (instead of 3 different ingredients)."),
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
        "effectDescription" => clienttranslate("Simple potions are always protected against Thief Potion and Thief Nectar."),
        "image" => 10
    ),
    7 => array(
        "type" => "item",
        "name" => clienttranslate("Crossbow of Foresight"),
        "count" => 2,
        "points" => 7,
        "costGold" => 7,
        "costIngredients" => array( 'A', 'B', 'C', 'D', 'E'),
        "valueType" => "",
        "valueIngredients" => "",
        "effectDescription" => clienttranslate("If you draw Simple Potion Cards in phase 1, take 3 Simple Potion Cards. Chose which 2 you want to keep and place the third on the discard pile."),
        "image" => 10
    ),
    8 => array(
        "type" => "advanced",
        "name" => clienttranslate("Creation Oil"),
        "count" => 5,
        "points" => 4,
        "costGold" => 4,
        "costIngredients" => array('B', 'D', 'E'),
        "valueType" => "ingredient",
        "valueIngredients" => array('C', 'D'),
        "effectDescription" => clienttranslate("To be used in phase 3 instead of phase 4. Gives you 3 extra ingredients in phase 3 when you produce a potion or magic item."),
        "image" => 10
    ),
    9 => array(
        "type" => "advanced",
        "name" => clienttranslate("Creation Oil"),
        "count" => 1,
        "points" => 4,
        "costGold" => 4,
        "costIngredients" => array('B', 'D', 'E'),
        "valueType" => "coin",
        "valueIngredients" => 3,
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
        "valueIngredients" => array('B', 'E'),
        "effectDescription" => clienttranslate("To be used in phase 3 instead of phase 4. Gives you 3 extra gold coins in phase 3 when you buy a potion or magic item."),
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
        "valueIngredients" => 3,
        "effectDescription" => clienttranslate("To be used in phase 3 instead of phase 4. Gives you 3 extra gold coins in phase 3 when you buy a potion or magic item."),
        "image" => 10
    ),
    12 => array(
        "type" => "advanced",
        "name" => clienttranslate("Spy Liqueur"),
        "count" => 5,
        "points" => 3,
        "costGold" => 3,
        "costIngredients" => array( 'A', 'B'),
        "valueType" => "ingredient",
        "valueIngredients" => array('C', 'D'),
        "effectDescription" => clienttranslate("Choose a rival and view all the cards in his or her Book of Knowledge. Pick 2 potion cards (max 1 advanced) and place them in your own Book of Knowledge. Your rival may use a Guardian Elixer. If so, you are not allowed to see the cards or to pick two (depending on when the Guardian Elixer is played). In this case however, you get to draw a new Simple Potion Card and a new Advanced Potion Card from the deck and place it in your Book of Knowledge."),
        "image" => 10
    ),
    13 => array(
        "type" => "advanced",
        "name" => clienttranslate("Spy Liqueur"),
        "count" => 1,
        "points" => 3,
        "costGold" => 3,
        "costIngredients" => array( 'A', 'B'),
        "valueType" => "coin",
        "valueIngredients" => 3,
        "effectDescription" => clienttranslate("Choose a rival and view all the cards in his or her Book of Knowledge. Pick 2 potion cards (max 1 advanced) and place them in your own Book of Knowledge. Your rival may use a Guardian Elixer. If so, you are not allowed to see the cards or to pick two (depending on when the Guardian Elixer is played). In this case however, you get to draw a new Simple Potion Card and a new Advanced Potion Card from the deck and place it in your Book of Knowledge."),
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
        "valueIngredients" => array('B', 'D'),
        "effectDescription" => clienttranslate("Steal a simple or advanced potion from a rival’s shop and add it to your own shop. Your rival may use a Guardian Elixer. If so, you are not allowed to steal a potion. In this case however, you get to draw a new Advanced Potion Card from the deck and place it directly in your shop."),
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
        "valueIngredients" => 3,
        "effectDescription" => clienttranslate("Steal a simple or advanced potion from a rival’s shop and add it to your own shop. Your rival may use a Guardian Elixer. If so, you are not allowed to steal a potion. In this case however, you get to draw a new Advanced Potion Card from the deck and place it directly in your shop."),
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
        "valueIngredients" => array('A', 'E'),
        "effectDescription" => clienttranslate("Protects you against the effects of Spy Potion, Spy Liqueur, Thief potion and Thief Nectar. It can be used straight from your shop when you are attacked, without being made active first. You can play it immediately, or wait until your rival tells you what card they want to steal or take."),
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
        "valueIngredients" => 3,
        "effectDescription" => clienttranslate("Protects you against the effects of Spy Potion, Spy Liqueur, Thief potion and Thief Nectar. It can be used straight from your shop when you are attacked, without being made active first. You can play it immediately, or wait until your rival tells you what card they want to steal or take."),
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
        "valueIngredients" => 1,
        "effectDescription" => clienttranslate("In phase 1 of the next round, you may draw three times the amount of Potion Cards you normaly draw. Or 2 Item Cards. "),
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
        "valueIngredients" => 3,
        "effectDescription" => clienttranslate("In phase 1 of the next round, you may draw three times the amount of Potion Cards you normaly draw. Or 2 Item Cards. "),
        "image" => 10
    ),
    20 => array(
        "type" => "advanced",
        "name" => clienttranslate("Sorcery Tonic"),
        "count" => 5,
        "points" => 5,
        "costGold" => 5,
        "costIngredients" => array('A', 'B', 'C', 'D'),
        "valueType" => "star",
        "valueIngredients" => 1,
        "effectDescription" => clienttranslate("Draw an item card at random and add it to your shop"),
        "image" => 10
    ),
    21 => array(
        "type" => "advanced",
        "name" => clienttranslate("Sorcery Tonic"),
        "count" => 1,
        "points" => 5,
        "costGold" => 5,
        "costIngredients" => array('A', 'B', 'C', 'D'),
        "valueType" => "coin",
        "valueIngredients" => 3,
        "effectDescription" => clienttranslate("Draw an item card at random and add it to your shop"),
        "image" => 10
    ),
    22 => array(
        "type" => "advanced",
        "name" => clienttranslate("Wisdom Wine"),
        "count" => 5,
        "points" => 5,
        "costGold" => 5,
        "costIngredients" => array('B', 'C', 'D', 'E'),
        "valueType" => "star",
        "valueIngredients" => 1,
        "effectDescription" => clienttranslate("Choose 1 Item Card and draw 4 Advanced Potion Cards. Put all 5 cards in your Book of Knowledge."),
        "image" => 10
    ),
    23 => array(
        "type" => "advanced",
        "name" => clienttranslate("Wisdom Wine"),
        "count" => 1,
        "points" => 5,
        "costGold" => 5,
        "costIngredients" => array('B', 'C', 'D', 'E'),
        "valueType" => "coin",
        "valueIngredients" => 3,
        "effectDescription" => clienttranslate("Choose 1 Item Card and draw 4 Advanced Potion Cards. Put all 5 cards in your Book of Knowledge."),
        "image" => 10
    ),
    24 => array(
        "type" => "basic",
        "name" => clienttranslate("Creation Potion"),
        "count" => 6,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array('A', 'E'),
        "valueType" => "ingredient",
        "valueIngredients" => array('B'),
        "effectDescription" => clienttranslate("To be used in phase 3 instead of phase 4. Gives you 2 extra ingredients in phase 3 when you produce a potion or magic item. Thus, when producing potions that require 1 or 2 ingredients, you do not need to discard any other cards."),
        "image" => 0
    ),
    25 => array(
        "type" => "basic",
        "name" => clienttranslate("Creation Potion"),
        "count" => 2,
        "points" => 2,
        "costGold" => 3,
        "costIngredients" => array('A', 'E'),
        "valueType" => "coin",
        "valueIngredients" => 1,
        "effectDescription" => clienttranslate("To be used in phase 3 instead of phase 4. Gives you 2 extra ingredients in phase 3 when you produce a potion or magic item. Thus, when producing potions that require 1 or 2 ingredients, you do not need to discard any other cards."),
        "image" => 0
    ),
    26 => array(
        "type" => "basic",
        "name" => clienttranslate("Gold Potion"),
        "count" => 6,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array('D', 'E'),
        "valueType" => "ingredient",
        "valueIngredients" => array('E'),
        "effectDescription" => clienttranslate("To be used in phase 3 instead of phase 4. Gives you 2 extra gold coins in phase 3 when you buy a potion or magic item. Thus when buying potions that cost 1 or 2 gold coins, you do not need to discard in any other cards."),
        "image" => 2
    ),
    27 => array(
        "type" => "basic",
        "name" => clienttranslate("Gold Potion"),
        "count" => 2,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array('D', 'E'),
        "valueType" => "coin",
        "valueIngredients" => 1,
        "effectDescription" => clienttranslate("To be used in phase 3 instead of phase 4. Gives you 2 extra gold coins in phase 3 when you buy a potion or magic item. Thus when buying potions that cost 1 or 2 gold coins, you do not need to discard in any other cards."),
        "image" => 2
    ),
    28 => array(
        "type" => "basic",
        "name" => clienttranslate("Spy Potion"),
        "count" => 6,
        "points" => 1,
        "costGold" => 1,
        "costIngredients" => array('A'),
        "valueType" => "ingredient",
        "valueIngredients" => array('C'),
        "effectDescription" => clienttranslate("Choose a rival and view all the cards in their Book of Knowledge. Take 1 of the simple Potion Cards and place it in your own Book of Knowledge. Your rival may use a guardian potion. If so, you are not allowed to see the cards or to pick one (depending on when the guardian card is played). In this case however, you get to draw a new simple Potion Card from the deck and place it in your Book of Knowledge."),
        "image" => 5
    ),
    29 => array(
        "type" => "basic",
        "name" => clienttranslate("Spy Potion"),
        "count" => 2,
        "points" => 1,
        "costGold" => 1,
        "costIngredients" => array('A'),
        "valueType" => "coin",
        "valueIngredients" => 1,
        "effectDescription" => clienttranslate("Choose a rival and view all the cards in their Book of Knowledge. Take 1 of the simple Potion Cards and place it in your own Book of Knowledge. Your rival may use a guardian potion. If so, you are not allowed to see the cards or to pick one (depending on when the guardian card is played). In this case however, you get to draw a new simple Potion Card from the deck and place it in your Book of Knowledge."),
        "image" => 5
    ),
    30 => array(
        "type" => "basic",
        "name" => clienttranslate("Thief Potion"),
        "count" => 6,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array('C', 'E'),
        "valueType" => "ingredient",
        "valueIngredients" => array('D'),
        "effectDescription" => clienttranslate("Steal a simple potion from a rival’s shop and add it to your own shop. Your rival may use a guardian potion. If so, you are not allowed to steal a potion. In this case however, you get to draw a new simple Potion Card from the deck and place it directly in your shop."),
        "image" => 7
    ),
    31 => array(
        "type" => "basic",
        "name" => clienttranslate("Thief Potion"),
        "count" => 2,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array('C', 'E'),
        "valueType" => "coin",
        "valueIngredients" => 1,
        "effectDescription" => clienttranslate("Steal a simple potion from a rival’s shop and add it to your own shop. Your rival may use a guardian potion. If so, you are not allowed to steal a potion. In this case however, you get to draw a new simple Potion Card from the deck and place it directly in your shop."),
        "image" => 7
    ),
    32 => array(
        "type" => "basic",
        "name" => clienttranslate("Guardian Potion"),
        "count" => 6,
        "points" => 1,
        "costGold" => 1,
        "costIngredients" => array('D'),
        "valueType" => "ingredient",
        "valueIngredients" => array('B'),
        "effectDescription" => clienttranslate("Protects you against the Spy Potion or Thief Potion. Can be used straight from your shop when you are attacked, without being made active first. You can play it immediately, or wait until your rival tells you what card they want to steal or take."),
        "image" => 3
    ),
    33 => array(
        "type" => "basic",
        "name" => clienttranslate("Guardian Potion"),
        "count" => 2,
        "points" => 1,
        "costGold" => 1,
        "costIngredients" => array('D'),
        "valueType" => "coin",
        "valueIngredients" => 1,
        "effectDescription" => clienttranslate("Protects you against the Spy Potion or Thief Potion. Can be used straight from your shop when you are attacked, without being made active first. You can play it immediately, or wait until your rival tells you what card they want to steal or take."),
        "image" => 3
    ),
    34 => array(
        "type" => "basic",
        "name" => clienttranslate("Refresh Potion"),
        "count" => 6,
        "points" => 1,
        "costGold" => 1,
        "costIngredients" => array('C'),
        "valueType" => "ingredient",
        "valueIngredients" => array('D'),
        "effectDescription" => clienttranslate("Put all Potion Cards currently in your Book of Knowledge aside. Draw the same number of simple and advanced Potion Cards from the decks and put them in your Book of Knowledge. Then draw 2 more simple Potion Cards and put them in your book as well. Discard all the Potion Cards you put aside."),
        "image" => 4
    ),
    35 => array(
        "type" => "basic",
        "name" => clienttranslate("Refresh Potion"),
        "count" => 2,
        "points" => 1,
        "costGold" => 1,
        "costIngredients" => array('C'),
        "valueType" => "coin",
        "valueIngredients" => 1,
        "effectDescription" => clienttranslate("Put all Potion Cards currently in your Book of Knowledge aside. Draw the same number of simple and advanced Potion Cards from the decks and put them in your Book of Knowledge. Then draw 2 more simple Potion Cards and put them in your book as well. Discard all the Potion Cards you put aside."),
        "image" => 4
    ),
    36 => array(
        "type" => "basic",
        "name" => clienttranslate("Supply Potion"),
        "count" => 6,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array('A', 'C'),
        "valueType" => "ingredient",
        "valueIngredients" => array('A'),
        "effectDescription" => clienttranslate("Immediately draw 5 simple potion cards and put them in your Book of Knowledge."),
        "image" => 6
    ),
    37 => array(
        "type" => "basic",
        "name" => clienttranslate("Supply Potion"),
        "count" => 2,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array('A', 'C'),
        "valueType" => "coin",
        "valueIngredients" => 1,
        "effectDescription" => clienttranslate("Immediately draw 5 simple potion cards and put them in your Book of Knowledge."),
        "image" => 6
    ),
    38 => array(
        "type" => "basic",
        "name" => clienttranslate("Wisdom Potion"),
        "count" => 6,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array('B', 'E'),
        "valueType" => "ingredient",
        "valueIngredients" => array('E'),
        "effectDescription" => clienttranslate("Draw 2 advanced Potion Cards and put them in your Book of Knowledge -even if you have less than 3 potions in your shop."),
        "image" => 9
    ),
    39 => array(
        "type" => "basic",
        "name" => clienttranslate("Wisdom Potion"),
        "count" => 2,
        "points" => 2,
        "costGold" => 2,
        "costIngredients" => array('B', 'E'),
        "valueType" => "coin",
        "valueIngredients" => 1,
        "effectDescription" => clienttranslate("Draw 2 advanced Potion Cards and put them in your Book of Knowledge -even if you have less than 3 potions in your shop."),
        "image" => 9
    ),
    40 => array(
        "type" => "basic",
        "name" => clienttranslate("Doubling Potion"),
        "count" => 6,
        "points" => 3,
        "costGold" => 3,
        "costIngredients" => array('A', 'B', 'E'),
        "valueType" => "ingredient",
        "valueIngredients" => array('C'),
        "effectDescription" => clienttranslate("Draw 2 simple potion cards and add them to your shop. If you draw another doubling potion, discard it"),
        "image" => 1
    ),
    41 => array(
        "type" => "basic",
        "name" => clienttranslate("Doubling Potion"),
        "count" => 2,
        "points" => 3,
        "costGold" => 3,
        "costIngredients" => array('A', 'B', 'E'),
        "valueType" => "coin",
        "valueIngredients" => 1,
        "effectDescription" => clienttranslate("Draw 2 simple potion cards and add them to your shop. If you draw another doubling potion, discard it"),
        "image" => 1
    ),
    42 => array(
        "type" => "basic",
        "name" => clienttranslate("Time Potion"),
        "count" => 6,
        "points" => 3,
        "costGold" => 3,
        "costIngredients" => array('B', 'C', 'D'),
        "valueType" => "ingredient",
        "valueIngredients" => array('A'),
        "effectDescription" => clienttranslate("Immediately after the round ends, you get an extra round (all 4 phases). If more than one player use the Time Potion in the same round, they play in turns as if it were a normal round."),
        "image" => 8
    ),
    43 => array(
        "type" => "basic",
        "name" => clienttranslate("Time Potion"),
        "count" => 2,
        "points" => 3,
        "costGold" => 3,
        "costIngredients" => array('B', 'C', 'D'),
        "valueType" => "coin",
        "valueIngredients" => 1,
        "effectDescription" => clienttranslate("Immediately after the round ends, you get an extra round (all 4 phases). If more than one player use the Time Potion in the same round, they play in turns as if it were a normal round."),
        "image" => 8
    )
);
