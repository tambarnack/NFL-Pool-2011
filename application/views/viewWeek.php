<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<table class="leaderboard" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<th class="header-visitor">Game</th>
		<th class="options">&nbsp;</th>
		<th class="header-local">Options</th>
	</tr>
	<? foreach($games as $index => $game){ ?>
	<tr>
		<td class="game">
			<div class='visitor'>
				<img src="http://img.static.nfl.com/static/site/3.6/img/logos/teams-matte-80x53/<?= $game->visitorAbr ?>.png" />
				<div class='name'><?= $game->visitorName ?></div>
			</div>
		</td>
		<td class="points <?= $game->winner != NULL ? ($game->picked == $game->winner ? "won": "lost") : "" ?>">
			<input type="radio" name="game_<?= $game->id ?>" value="<?= $game->visitor ?>" <?= ($game->visitor == $game->picked) ? "checked": ""?> disabled/> - 
			<input type="radio" name="game_<?= $game->id ?>" value="<?= $game->local ?>" <?= ($game->local == $game->picked) ? "checked": ""?> disabled/>
		</td>
		<td class="game">
			<div class='local'>
				<img src="http://img.static.nfl.com/static/site/3.6/img/logos/teams-matte-80x53/<?= $game->localAbr ?>.png" />
				<div class='name'><?= $game->localName ?></div>
			</div>
		</td>
	</tr>
	<? } ?>
</table>