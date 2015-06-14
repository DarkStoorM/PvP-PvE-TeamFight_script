<?php
/***
	This is a re-worked PvP/PvE script
	for handling team fights instead of 1v1s
	
	Instructions:
		- Start from this file
		- Go to the team_builder.php, read the important information about team building
			^this is where you build up the teams.
		- Go to the Fight.php to see how
***/

// We will define a global, which will tell us whether to use the fight log or not.
define("pvp_fight_log", true);

// including our required files.
require("team_builder.php");
require("players.php");

// This is our main file to fire up the fights
require("Fight.php");


/***
	This part is critical, because it depends on how do you get your players for both teams.
	Every game provides a different mechanics, so there is a need for different codes.
	These are the basics, that you can modify on your own to match your game mechanics.
	
	If you store the current player's information in an array or object, be sure to provide the required information
	and it depends if you store whole your team in your own array - then you need to loop it.
		
	I used a temporary class for building my custom team to solve the above problem
	See: team_builder.php
***/

// First thing we got to do, is to create two arrays containing some members.
// More stuff explained in team_builders.php regarding the bigger team size
$alpha_team = array($member1, $member2, $member3);
$beta_team = array($member4);

// We are creating a new instance of our Fight class and passing the both team arrays as parameters
$fight = new Fight($alpha_team, $beta_team);

// Let's set the time limit for every fight
$fight->time_limit = 1200;

// This is the method which will start the fight. Use it whenever you are ready.
$fight->StartFight();