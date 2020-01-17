<?php
require_once("globals.php");
require_once("session.php");
function require_multi($files) {
    $files = func_get_args();
    foreach($files as $file)
        require_once($file);
}
function echo_states($selected = null){
    $us_states = array(
        'AL'=>'Alabama',
        'AK'=>'Alaska',
        'AZ'=>'Arizona',
        'AR'=>'Arkansas',
        'CA'=>'California',
        'CO'=>'Colorado',
        'CT'=>'Connecticut',
        'DE'=>'Delaware',
        'DC'=>'District of Columbia',
        'FL'=>'Florida',
        'GA'=>'Georgia',
        'HI'=>'Hawaii',
        'ID'=>'Idaho',
        'IL'=>'Illinois',
        'IN'=>'Indiana',
        'IA'=>'Iowa',
        'KS'=>'Kansas',
        'KY'=>'Kentucky',
        'LA'=>'Louisiana',
        'ME'=>'Maine',
        'MD'=>'Maryland',
        'MA'=>'Massachusetts',
        'MI'=>'Michigan',
        'MN'=>'Minnesota',
        'MS'=>'Mississippi',
        'MO'=>'Missouri',
        'MT'=>'Montana',
        'NE'=>'Nebraska',
        'NV'=>'Nevada',
        'NH'=>'New Hampshire',
        'NJ'=>'New Jersey',
        'NM'=>'New Mexico',
        'NY'=>'New York',
        'NC'=>'North Carolina',
        'ND'=>'North Dakota',
        'OH'=>'Ohio',
        'OK'=>'Oklahoma',
        'OR'=>'Oregon',
        'PA'=>'Pennsylvania',
        'RI'=>'Rhode Island',
        'SC'=>'South Carolina',
        'SD'=>'South Dakota',
        'TN'=>'Tennessee',
        'TX'=>'Texas',
        'UT'=>'Utah',
        'VT'=>'Vermont',
        'VA'=>'Virginia',
        'WA'=>'Washington',
        'WV'=>'West Virginia',
        'WI'=>'Wisconsin',
        'WY'=>'Wyoming',
    );

    $returnHTML = "<option value=\"\">Select a State</option>";

    foreach ($us_states as $key => $value) {
        if($key == $selected){
            $returnHTML .= "<option value=\"{$key}\" selected>{$value}</option>";
        }else{
            $returnHTML .= "<option value=\"{$key}\">{$value}</option>";
        }
    }

    return $returnHTML;
}

function echo_cat(){
    global $itemTypes;

    $returnHTML = "";
    $query = "SELECT * FROM `item_type`";
    $result=mysqli_query( $connection, $query);
    confirm_query($result);
    while($value=mysqli_fetch_assoc($result)){
        $returnHTML .= "<tr><td><b>{$value['name']}</b><td></td><td></td><td></td><td></td><td></td></tr></td>";
    }

    return $returnHTML;
}

function echo_item_types($selected = null){
    global $connection;

    $returnHTML = "<option value=\"\">Select type</option><option value=\"Custom\">Custom</option>";

    $query = "SELECT * FROM `item_type`";
    $result=mysqli_query( $connection, $query);
    confirm_query($result);
    while($value=mysqli_fetch_assoc($result)){
        if($value == $selected){
            $returnHTML .= "<option value=\"{$value['name']}\" selected>{$value['name']}</option>";
        }else{
            $returnHTML .= "<option value=\"{$value['name']}\">{$value['name']}</option>";
        }
    }

    return $returnHTML;
}

function random_generator($length, $usableChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'){
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($usableChars) - 1);
        $randomString .= $usableChars[$index];
    }

    return $randomString;
}

function format_date_timezone($dateTime){
    $dt = new DateTime($dateTime);
    $dt -> setTimezone(new DateTimeZone($GLOBALS['site_info']['timezone']));
    return $dt->format('m/d/Y, H:i:s');
}

//Returns array of the highest bid on an item
function get_highest_bids($itemID){
    global $connection;

    $query = "SELECT * FROM `bid` WHERE `seller_item_id` = {$itemID} AND `bid_status` = 'Confirmed' ORDER BY `bid_amount` DESC LIMIT 1";
    $result=mysqli_query( $connection, $query);
    confirm_query($result);
    if(mysqli_num_rows($result) > 0){
        $bid = mysqli_fetch_array($result);
        $query = "SELECT * FROM `bid` WHERE `seller_item_id` = {$itemID} AND `bid_amount` = {$bid['bid_amount']} AND `bid_status` = 'Confirmed' ORDER BY `date_created` ASC";
        $result2=mysqli_query( $connection, $query);
        confirm_query($result2);
        return mysqli_fetch_all($result2,MYSQLI_ASSOC);
    }
    return array();
}

//Returns winning bid or false if there is none
function get_winning_bid($itemID){
    global $connection;

    //Get the item
    $query = "SELECT * FROM `seller_item` WHERE `id` = {$itemID}";
    $itemResult=mysqli_query( $connection, $query);
    confirm_query($itemResult);
    $item = mysqli_fetch_assoc($itemResult);
    //Get first record of the highest bid in case of tie bids
    $query = "SELECT * FROM `bid` WHERE `seller_item_id` = {$item['id']} AND `bid_status` = 'Confirmed' ORDER BY `bid_amount` DESC, `date_created` ASC LIMIT 1";
    $winResult=mysqli_query( $connection, $query);
    confirm_query($winResult);
    if(mysqli_num_rows($winResult) > 0){
        $winningBid = mysqli_fetch_assoc($winResult);
        //Make sure the highest bid is above or equal the asking amount
        if($winningBid['bid_amount'] >= $item['asking']){
            return $winningBid;
        }
    }
    return false;
}

//Returns array of all confirmed bids on an item
function get_item_bids($itemID){
    global $connection;

    $bids = array();
    $query = "SELECT * FROM `bid` WHERE `seller_item_id` = {$itemID} AND `bid_status` = 'Confirmed' ORDER BY `bid_amount` DESC, `date_created` DESC";
    $bidResult=mysqli_query( $connection, $query);
    confirm_query($bidResult);
    $bids=mysqli_fetch_all($bidResult,MYSQLI_ASSOC);

    return $bids;
}

//Returns array of all winning bids of a buyer
function get_buyer_won_bids($buyerID){
    global $connection;

    $winningBids = array();
    $query = "SELECT * FROM `bid` WHERE `buyer_id` = {$buyerID} AND `bid_status` = 'Confirmed'";
    $bidResult=mysqli_query( $connection, $query);
    confirm_query($bidResult);
    //Check each of the buyer's bid to see if it's the winning one for that item
    while($bid=mysqli_fetch_assoc($bidResult)){
        $winningBid = get_winning_bid($bid['seller_item_id']);
        if($winningBid !== false && $winningBid['buyer_id'] == $buyerID){
            //We should be down here if this is the winning bid
            array_push($winningBids, $winningBid);
        }
    }
    return $winningBids;
}

//Returns array of sold items under a seller
function get_seller_sold_items($sellerID){
    global $connection;

    $soldItems = array();
    $query = "SELECT * FROM `seller_item` WHERE `seller_id` = {$sellerID}";
    $sellerItemResult=mysqli_query( $connection, $query);
    confirm_query($sellerItemResult);
    //Check each of the seller's items to see if it's sold
    while($item=mysqli_fetch_assoc($sellerItemResult)){
        if(get_winning_bid($item['id']) !== false){
            array_push($soldItems, $item);
        }
    }
    return $soldItems;
}
?>
