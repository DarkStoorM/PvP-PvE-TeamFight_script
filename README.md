#PvP/PvE Team Fights Script

###Description
This is an enhanced version of my previous PvP/PvE system.
I had to expand it a little to handle something more than 1v1 fights, as requested.

###Usage
The whole explanation is in the code.

###NOTICE
It's worth mentioning, that you can modify that script by your needs, because the script consitst only of some basic stuff, the most commonly used player statistics.
Also, PlayerID from the previous system was changed into PlayerName, and the script was "fully" moved into the Object-Oriented.

Currently available player statistics are:

`Name` - Character name

`HP` - Character Hit Points

`MinDMG` - the minimum value for Character Damage

`MaxDMG` - the maximum value for Character Damage

* Min-Max is the Character Damage range. If you are not using the damage range, you can set the Max value as same as Min

`CritChance` - Critical Hit Chance (multiplying the outgoing damage by 150%)

`Defense` - Character Defense points value (decreasing incoming damage by calculated percentage)

* The damage decreasing formula should be adjusted to match your game mechanics.
* I think you can stick to the Diablo 3 damage reduction formula:

        `YOUR_ARMOR / ((50 * OPPONENT_LEVEL) + ARMOR)`

`Dodge` - The chance to avoid the next attack

`AttackSpeed` - !!! how many "seconds" have to pass between your attacks (the lower, the better). All the stuff about the attack speed is explained on my website. [You can read more here](http://darkstoorm.pl/article/pvp_pve_system_in_php/)