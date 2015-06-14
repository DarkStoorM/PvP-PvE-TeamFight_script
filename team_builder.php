<?php
// Temporary class for building players
// explained in index.php

// I will build a random team in this place
class PlayerInfo {
	public $Name = null;
	public $HP = null;
	public $MinDMG = null;
	public $MaxDMG = null;
	public $CritChance = null;
	public $Defense = null;
	public $Dodge = null;
	public $AttackSpeed = null;
	
	public function __construct($info) {
		$this -> Name = $info["Name"];
		$this -> HP = $info["HP"];
		$this -> MinDMG = $info["MinDMG"];
		$this -> MaxDMG = $info["MaxDMG"];
		$this -> CritChance = $info["CritChance"];
		$this -> Defense = $info["Defense"];
		$this -> Dodge = $info["Dodge"];
		$this -> AttackSpeed = $info["AttackSpeed"];
	}
}

/***
	This is not necessary, but I will use this to create a non-existing team
	I am creating a 3v2 fictional team, 3 "Players" versus 2 Elite Bosses
	the code will be a bit long, because I have to make 5 different players manually
	
	When working on an actual game and you are about to have a team fight,
	you have to create a member array and put it in a loop.
	
	Just imagine when you have an alliance of 100vs100, so you just have to loop it.
	It can be done like this:
	
		// !!! $member->field is just an example, it depends on your object's fields
	
	$members1 = array();
	
	foreach($my_team_list as $member) {
		$members1[] = new PlayerInfo(array(
			"Name" => $member->Name,
			"HP" => $member->HP,
			"MinDMG" => $member->MinDMG,
			"MaxDMG" => $member->MaxDMG,
			"CritChance" => $member->CritChance,
			"Defense" => $member->Defense,
			"Dodge" => $member->Dodge,
			"AttackSpeed" => $member->AttackSpeed
		));
	}
	
	BUT, this code depends on the method how you are storing the player information.
	It will be either $member->field or $member["field"]
	
	But this will need some modifications of the team building code.
	The rest is explained in the index.php, you can return to that file
	
	THIS IS ONLY AN EXAMPLE!
***/

$member1 = new PlayerInfo(array(
	"Name" => "Awesome Tank",
	"HP" => 6382,
	"MinDMG" => 760,
	"MaxDMG" => 1145,
	"CritChance" => 19,
	"Defense" => 6227,
	"Dodge" => 13,
	"AttackSpeed" => 30
));

$member2 = new PlayerInfo(array(
	"Name" => "Some Random Dude",
	"HP" => 3524,
	"MinDMG" => 384,
	"MaxDMG" => 632,
	"CritChance" => 30,
	"Defense" => 1865,
	"Dodge" => 5,
	"AttackSpeed" => 18
));

$member3 = new PlayerInfo(array(
	"Name" => "IDK_LMAO",
	"HP" => 4201,
	"MinDMG" => 560,
	"MaxDMG" => 900,
	"CritChance" => 15,
	"Defense" => 3806,
	"Dodge" => 10,
	"AttackSpeed" => 15
));

/***
	To check if the code will work properly with the main concept of this code
	I will create two players (bosses) to imitate a team creation from the database
	and we have to work on arrays, not on an object.
	
	Let's say we have the following two records about bosses in our database,
	and the result is an array.
	
	We can create something like this:
	foreach( $result as $db_row ) {
		$my_team_list[] = $db_row;
	}
	
	and that's pretty much it. Just remember to match the field names or you are screwed.
***/

$my_team_list = array(
	array(	
		"Name" => "Elite Blightwalker",
		"HP" => 15000,
		"MinDMG" => 1742,
		"MaxDMG" => 2210,
		"CritChance" => 25,
		"Defense" => 5760,
		"Dodge" => 10,
		"AttackSpeed" => 35
	),
	
	array(
		"Name" => "Elite Ragecaster",
		"HP" => 10000,
		"MinDMG" => 624,
		"MaxDMG" => 842,
		"CritChance" => 17,
		"Defense" => 2749,
		"Dodge" => 5,
		"AttackSpeed" => 25
	)
);

// our example team 2
$member4 = array();

// This loop is an alternative version of building a team.
// !!!IMPORTANT - should be removed if not used.
foreach($my_team_list as $member) {
	$member4[] = new PlayerInfo(array(
		"Name" => $member["Name"],
		"HP" => $member["HP"],
		"MinDMG" => $member["MinDMG"],
		"MaxDMG" => $member["MaxDMG"],
		"CritChance" => $member["CritChance"],
		"Defense" => $member["Defense"],
		"Dodge" => $member["Dodge"],
		"AttackSpeed" => $member["AttackSpeed"]
	));
}