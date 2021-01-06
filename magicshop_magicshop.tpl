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


<div class="whiteblock flex-container">
    <div class="deckWrap">
        <div>
            {BASIC_POTIONS}
        </div>
        <div id="basicPotionDeck" class="card cardBack" style="margin:auto">
        </div>
    </div>
    <div class="deckWrap">
        {ADVANCED_POTIONS}
        <div id="advancedPotionDeck" class="card cardBack" style="margin:auto">
        </div>
    </div>
    <div class="deckWrap">
        {ITEMS}
        <div id="itemDeck" class="card cardBack" style="margin:auto">
        </div>
    </div>
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
        <div class="flex-container">
            <div id="activePotionWrap_{PLAYER_ID}" class="classActivePotionWrap">
                Active Potion
                <div id="activePotion_{PLAYER_ID}" class="card">
                </div>
            </div>
            <div id="playerShop_{PLAYER_ID}">
            </div>
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
	<div id="playerShop_{CURRENT_PLAYER_ID}">
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
