<h1><?= h($horse->name) ?></h1>
<p>
	Created at : <?= $horse->created->format(DATE_RFC850) ?><br>
	Updated at : <?= $horse->modified->format(DATE_RFC850) ?><br>
	Max working hours : <?=$horse->max_working_hours ?><br>
	Deleted : <?= $horse->deleted ? '1' : '0' ?>
</p>
