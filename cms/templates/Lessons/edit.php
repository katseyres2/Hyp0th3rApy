<h1>Modifier la leçon</h1>

<div class="form content">
	<p>
		<em>
			* L'assignation d'une nouvelle tranche horaire ne peut être faite que si elle peut accueillir le nombre de personnes enregistré dans la leçon.<br>
            * La suppression de la leçon libère la tranche horaire réservée en son nom.
		</em>
	</p>
	<?= $this->Form->create($lesson, ['url' => ['controller' => 'Lessons', 'action' => 'edit', $lesson->id]]) ?>
	<div class="mb-3"><?= $this->Form->control('firstname', ['class' => 'form-control', 'label' => ['class' => 'form-label', 'text' => 'Prénom'], 'placeholder' => __('the customer\'s firstname...')]) ?></div>
    <div class="mb-3"><?= $this->Form->control('lastname', ['class' => 'form-control', 'label' => ['class' => 'form-label', 'text' => 'Nom'], 'placeholder' => __('the customer\'s lastname...')]) ?></div>
	<div class="mb-3"><?= $this->Form->control('number_of_riders', ['class' => 'form-control', 'label' => ['class' => 'form-label', 'text' => 'Nombre de personnes'], 'default' => 1, 'min' => 1, 'max' => 8]) ?></div>
    <div class="mb-3"><?= $this->Form->control('price', ['class' => 'form-control', 'label' => ['class' => 'form-label', 'text' => 'Prix'], 'default' => 0, 'min' => 0, 'max' => 9999]) ?></div>

	<?php
	$planningsToString = [];
	foreach ($monthlyPlannings as $planning) {
		$remainingPlaces = 8;
		
		foreach ($planning->lessons as $lesson) {
			$remainingPlaces -= $lesson->number_of_riders;
		}

		if ($remainingPlaces == 0) {
			continue;
		}

		$addSuffixForPlural = '';

		if($remainingPlaces > 1) {
			$addSuffixForPlural = 's';
		}

		$dateToString = date_format($planning->start_datetime, 'd/m/Y');
		$startHourToString = date_format($planning->start_datetime, 'H:i');
		$endHourToString = date_format($planning->end_datetime, 'H:i');

		$planningsToString[] = [
			'text' => "$dateToString à $startHourToString - $endHourToString ($remainingPlaces place$addSuffixForPlural restante$addSuffixForPlural)",
			'value' => $planning->id, 
			'selected' => count($planningsToString) == 0,
		];
	}
	
	?>
	<div class="mb-2">Horaire</div>
	<?= $this->Form->select('planning_id', $planningsToString, ['class' => 'form-select', 'multiple' => false, 'label' => 'planning']) ?>

	<?= $this->Form->hidden('update', ['default' => true]) ?>
	<?= $this->Form->hidden('id', ['default' => $lesson->id]) ?>
	<?= $this->Form->button(__('Sauvegarder'), ['class' => "btn btn-primary mt-4"]); ?>
	<?= $this->Form->end() ?>
</div>