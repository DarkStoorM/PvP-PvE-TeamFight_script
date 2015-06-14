<?php

class Fight {
	// Let's make our Team arrays first
	public $team1 = array();
	public $team2 = array();
	public $temp_alpha = array();
	public $temp_beta = array();
	/***
		We  have to define max time for a fight.
		Let's say it will be like... 600 seconds. Since it's a boss fight, and the statistics are higher,
		we will make it a bit longer.
		
		We will also handle the time_up case, to "exhaust" players.
		The reason of it is to avoid endless loop (if it's possible).
	***/
	public $time_limit = 2000;
	
	public $condition = "";
	
	public function __construct($alpha, $beta) {
		$this->temp_alpha = $alpha;
		$this->temp_beta = $beta;
		
		$this->BuildTeam();
	}
	
	public function BuildTeam() {
		/***
			Our first team
			If our $alpha_team consists of non-array elements (our players are instances of Player class),
			we are inserting these objects into our $team1 array. We only need the player objects, so there
			is no need for the further steps.
			
			On the other hand, if we are dealing with the array result, we are looping through it to get the player objects.
		***/
		foreach($this->temp_alpha as $alpha) {
			if(is_array($alpha)) {
				foreach($alpha as $member) {
					// $member is the current element of the $alpha array
					$this -> team1[] = new Player($member);
				}
			} else {
				// in this case, $alpha is not an array, so we will just put it into the $team1[]
				$this -> team1[] = new Player($alpha);
			}
		}

		foreach($this->temp_beta as $beta) {
			if(is_array($beta)) {
				foreach($beta as $member) {
					$this -> team2[] = new Player($member);
				}
			} else {
				$this -> team2[] = new Player($beta);
			}
		}
	}
	
	public function StartFight() {
		$team1 = $this->team1;
		$team2 = $this->team2;
		
		while(!empty($team1) || !empty($team2)) {
			$condition = check_teams($team1, $team2);
			if(!empty($condition)) { break; }
			
			$player_turns = array();
			// Inserting Player1 turns into our Turns array
			$player_turns = $team1[0]->roll_turns($this->time_limit, $player_turns);

			// Now if we have Player1 turns generated, let's make the same for Player2
			// We have to pass the same array to the method
			$player_turns = $team2[0]->roll_turns($this->time_limit, $player_turns);
			
			// We have to sort our array keys, because Player2 turns were added
			// at the end of an array
			ksort($player_turns);

			// Now we have to loop through our array. We will use switch() for methods
			for($i=1; $i <= $this ->time_limit; $i++) {
				if(!empty($player_turns[$i])){
					switch($i) {
						// We are checking what type of turn we have in our array key
						// We are calling the $teamX[0], because the first players in their teams are fighting against eachother
						case $player_turns[$i]==$team1[0]->Name: $team1[0]->attack($team2[0]); break;
						case $player_turns[$i]==$team2[0]->Name: $team2[0]->attack($team1[0]); break;
						case $player_turns[$i]=="Draw": Draw($team1[0], $team2[0]); break;
					}
					
					
					if($team1[0]->HP <=0) {
						// Remove negative numbers just in case
						if($team1[0]->HP <0) {
							$team1[0]->HP=0;
						}
						
						// The first player has been defeated, so we are removing him from the fight
						fight_log("<b>".$team1[0]->Name." has been defeated.</b><br>");
						// We are using array_shift() to remove the first element, but we don't need the information back
						array_shift($team1);
						break;
					}
					
					if($team2[0]->HP <=0) {
						// and the same here
						if($team2[0]->HP <0)
							$team2[0]->HP=0;
						
						// and the same for the second player
						fight_log("<b>".$team2[0]->Name." has been defeated.</b><br>");
						array_shift($team2);
						break;
					}
				}
			}
			
			/***
				Basically what it does is to check if we ran out of time, which will "exhaust" the player,
				and one with the higher amount of Hit Points wins.
				
				We are putting the IF block here, because we need to check if the time was up
					($i greater than $time_limit breaks the loop)
				so, if the $i variable hits the limit, we know that the time was up,
				and we can check the other conditions.
			***/
			if($i >= $this -> time_limit) {
				// if at the end of our fight the player of the first team has more Hit Points, he wins
				// and the second player is removed from the queue
				if(($team1[0]->HP == $team2[0]->HP)) {
					/***
						WARNING: 
						This is the case, that will most likely NEVER happen. It has extremely low chance to happen at all.
						But why not, both players are exhausted, and they can't fight anymore, so we will remove them.
					***/
					fight_log("Both players are too exhausted to fight.<br><br>");
					array_shift($team1);
					array_shift($team2);
				} elseif($team1[0]->HP > $team2[0]->HP) {
					fight_log($team2[0]->Name." is too exhausted to fight.<br><br>");
					array_shift($team2);
				} elseif($team2[0]->HP > $team1[0]->HP) {
					// Just in case we are sending the information to our fight log
					fight_log($team1[0]->Name." is too exhausted to fight.<br><br>");
					array_shift($team1);
				}
			}
		}
	}
}