<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<table class="leaderboard" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<th class="header-visitor">Visitor</th>
		<th class="header-score">&nbsp;</th>
		<th class="header-local">Local</th>
	</tr>
	<? foreach($games as $index => $game){ ?>
	<tr>
		<td class="game">
			<div class='visitor'>
				<img src="http://img.static.nfl.com/static/site/3.6/img/logos/teams-matte-80x53/<?= $game->visitorAbr ?>.png" />
				<div class='name'><?= $game->visitorName ?></div>
			</div>
		</td>
		<td class="points">
			<input type="radio" class="pool-radio" name="game_<?= $game->id ?>" value="<?= $game->id ?>-<?= $game->visitor ?>" <?= ($game->visitor == $game->picked) ? "checked": ""?> /> - 
			<input type="radio" class="pool-radio" name="game_<?= $game->id ?>" value="<?= $game->id ?>-<?= $game->local ?>" <?= ($game->local == $game->picked) ? "checked": ""?> />
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
<div style="text-align: center;">
	<input type="button" onclick="pool.savePool(<??>);" value="Save" class="searchNow button blue boxRound4 boxShadowButton">
</div>