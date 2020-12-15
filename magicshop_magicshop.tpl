{OVERALL_GAME_HEADER}

<!-- 
--------
-- BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
-- magicshop implementation : © David Bond <David.CJ.Bond@gmail.com>
-- 
-- This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
-- See http://en.boardgamearena.com/#!doc/Studio for more information.
-------
-->


<div id="deckWrap" class="whiteblock">
    <span id="basicPotionDeckWrap">
        <div>
            {BASIC_POTIONS}
        </div>
        <div id="basicPotionDeck" class="cardBack">
        </div>
    </span>
    <span id="advancedPotionDeckWrap">
        {ADVANCED_POTIONS}
        <div id="advancedPotionDeck" class="cardBack">
        </div>
    </span>
    <span id="itemDeckWrap">
        {ITEMS}
        <div id="itemDeck" class="cardBack">
        </div>
    </span>
</div>

<div id="itemDeckDisplay">
    display item deck
</div>




<div id="playerShopsWrap" class="whiteblock flex-container">
    <!-- BEGIN playerShops -->
    <div class="playerShopWrap">
        <div class="playerShopName" style="color:#{PLAYER_COLOUR}">
            <b>{PLAYER_NAME}</b>
        </div>
        <div class="playerShop" id="playerShop_{PLAYER_ID}">
        </div>
    </div>
    <!-- END playerShops -->
</div>

<span>
<div class="playerShopWrap whiteblock">
<!--	<div class="playerShopName" style="color:#{CURRENT_PLAYER_COLOUR}"> -->
    <div class="playerShopName">
	    <b>{CURRENT_PLAYER_SHOP}</b>
    </div>
	<div class="playerShop" id="playerShop_{CURRENT_PLAYER_ID}">
	</div>
	
</div>

<div id="playerhand">
    <b>{CURRENT_PLAYER_HAND}</b>
</div>

<div id="myhand" class="whiteblock">
</div>
</span>
<div id="tests">
</div>
<script type="text/javascript">

// Javascript HTML templates

/*
// Example:
var jstpl_some_game_item='<div class="my_game_item" id="my_game_item_${MY_ITEM_ID}"></div>';

*/
var jstpl_test = '<div id="test_${player}_${id}" class="test"></div>'


</script>  

{OVERALL_GAME_FOOTER}
