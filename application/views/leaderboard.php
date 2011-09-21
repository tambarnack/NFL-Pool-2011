<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<table class="leaderboard" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<th class="player-name-column">Player</th>
		<th class="player-points-column">Points</th>
		<th class="options">Options</th>
	</tr>
	<? foreach($players as $index => $player){ ?>
	<tr>
		<td><?= $player->name ?></td>
		<td class="points"><?= $player->points ?></td>
		<td class="options"><a href="#" onclick="pool.showProfile(<?= $player->id ?>)">See profile</a> </td>
	</tr>
	<? } ?>
</table>