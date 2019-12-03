<?php
require_once("globals.php");
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

function echo_item_types($selected = null){
    $types = array(
        'Custom',
        'Antlers',
        'Artic Fox',
        'Baculum',
        'Badger',
        'Bear Parts',
        'Bear rug',
        'Beaver',
        'Beaver Darts',
        'Beaver Skulls',
        'Beaver Tails',
        'Bee Hive',
        'Blue Fox',
        'Bobcat',
        'Bobcat Bones',
        'Bobcat Paws',
        'Bobcat Skull',
        'Castor',
        'Cougar',
        'Coyote',
        'Coyote Paws',
        'Coyote Skulls',
        'Cross Fox',
        'Earings',
        'Ermine',
        'Ermine Skull',
        'Fox Paws',
        'Fur Coat',
        'Fur Headband',
        'Fur Pieces',
        'Goat Skulls',
        'Goat / Sheep Horns',
        'Grey Fox',
        'Grouse Tails',
        'Hoop Art',
        'Indian Leather Jacket',
        'Indian Shield',
        'Lion Skull',
        'Lynx Feet',
        'Marten',
        'Mink',
        'Misc Bones',
        'Misc Skulls',
        'Musk Rat',
        'Necklace',
        'Opossum',
        'Otter',
        'Porky Claws',
        'Porky Hair',
        'Porky Quills',
        'Raccoon',
        'Raccoon Paws',
        'Raccoon Skulls',
        'Red Fox',
        'Silver Fox',
        'Skunk',
        'Skunk Essence',
        'Skunk Skulls',
        'Tanned Lamb Skin',
        'Traps',
        'Turkey Beard',
        'Turkey Tails',
        'White fox',
        'Wolf',
        'Wolf Skull'
    );

    $returnHTML = "<option value=\"\">Select type</option>";

    foreach ($types as $value) {
        if($value == $selected){
            $returnHTML .= "<option value=\"{$value}\" selected>{$value}</option>";
        }else{
            $returnHTML .= "<option value=\"{$value}\">{$value}</option>";
        }
    }

    return $returnHTML;
}
?>
