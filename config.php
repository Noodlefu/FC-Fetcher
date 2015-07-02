<?php
// Used for misc debug output
$debug = false;
// Database information
$db_server = "";
$db_user = "";
$db_pass = "";
$db_database = "";
$db_port = ""; // can be left blank if default (3306)
// Default number of members per page
$perPage = 30;
// Fetch the id below from Lodestone : http://na.finalfantasyxiv.com/lodestone/freecompany/9232379236109517808/
$fc_id = "9232379236109517808";

$classes = [
    ["name" => "gladiator", "type" => "battle", "image" => "images/gladiator.png" ],
	["name" => "marauder", "type" => "battle", "image" => "images/marauder.png" ],
    ["name" => "lancer", "type" => "battle", "image" => "images/lancer.png" ],
	["name" => "pugilist", "type" => "battle", "image" => "images/pugilist.png" ],
	["name" => "archer", "type" => "battle", "image" => "images/archer.png" ],
    ["name" => "rogue", "type" => "battle", "image" => "images/rogue.png" ],
	["name" => "conjurer", "type" => "battle", "image" => "images/conjurer.png" ],
    ["name" => "thaumaturge", "type" => "battle", "image" => "images/thaumaturge.png" ],
	["name" => "arcanist", "type" => "battle", "image" => "images/arcanist.png" ],
    ["name" => "dark knight", "type" => "battle", "image" => "images/darkknight.png" ],
	["name" => "machinist", "type" => "battle", "image" => "images/machinist.png" ],
    ["name" => "astrologian", "type" => "battle", "image" => "images/astrologian.png" ],
	["name" => "carpenter", "type" => "hand", "image" => "images/carpenter.png" ],
    ["name" => "blacksmith", "type" => "hand", "image" => "images/blacksmith.png" ],
	["name" => "armorer", "type" => "hand", "image" => "images/armorer.png" ],
    ["name" => "goldsmith", "type" => "hand", "image" => "images/goldsmith.png" ],
	["name" => "leatherworker", "type" => "hand", "image" => "images/leatherworker.png" ],
	["name" => "weaver", "type" => "hand", "image" => "images/weaver.png" ],
	["name" => "alchemist", "type" => "hand", "image" => "images/alchemist.png" ],
	["name" => "culinarian", "type" => "hand", "image" => "images/culinarian.png" ],
	["name" => "miner", "type" => "hand", "image" => "images/miner.png" ],
	["name" => "botanist", "type" => "hand", "image" => "images/botanist.png" ],
	["name" => "fisher", "type" => "hand", "image" => "images/fisher.png" ],
];
?>