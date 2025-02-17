<?php
use Cake\I18n\DateTime;
?>

<div>
	<h1>Planning Journalier</h1>

	<div class="pb-3">
		<?= date('l, d F, Y') ?>
	</div>

    <div class="container">
        <div class="row">
            <div class="col">
                <h2><?= h('Horaires') ?></h2>
                <div class="accordion" id="accordionExample">
                    <?php if (count($dailyPlannings) == 0): ?>
                        <div class="fst-italic">Aucune leçon prévue aujourd'hui.</div>
                        <?= $this->Html->link('Générer le planning annuel', ['controller' => 'Plannings', 'action' => 'generatePlanningOfTheYear'], ['class' => 'btn btn-primary mt-4']); ?>
                    <?php endif ?>
                
                    <?php foreach($dailyPlannings as $key => $planning): ?>
                        <?php
                        $sumOfRiders = 0;
                        foreach ($planning->lessons as $lesson) {
                            $sumOfRiders += $lesson->number_of_riders;
                        }
                        ?>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button <?php if ($selectedPlanning != $planning->id) echo 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $key ?>" aria-expanded="<?php if ($key == 0) echo 'true'; ?>" aria-controls="collapse<?= $key ?>">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                <?php 
                                                $remainingReservations = 8 - $sumOfRiders;
                                                if ($remainingReservations > 1) {
                                                    $pluralSuffix = 's';
                                                } else {
                                                    $pluralSuffix = '';
                                                }
                                                ?>
                                                <?= h(date_format($planning->start_datetime, 'H:i')) ?> - <?= h(date_format($planning->end_datetime, 'H:i')) ?>
                                                <span>
                                                    (<?= $remainingReservations ?> place<?= $pluralSuffix ?> disponible<?= $pluralSuffix ?>)
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse<?= $key ?>" class="accordion-collapse collapse <?php if ($selectedPlanning == $planning->id)  echo 'show'; else echo 'false' ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="container text-left">
                                        <div class="row">
                                            <?= $this->Form->create(null, ['type' => 'put', 'url' => ['controller' => 'Plannings', 'action' => 'assign', $planning->id]]) ?>
                                            <?php 
                                            // Lock all horses already selected in this lesson.
                                            $lockedHorseIds = [];

                                            foreach ($planning->lessons as $lesson) {
                                                foreach ($lesson->horses as $horse) {
                                                    $lockedHorseIds[] = $horse->id;
                                                }
                                            }
                                            ?>
                                            
                                            <?php foreach ($planning->lessons as $lessonKey => $lesson): ?>
                                                <div class="row">
                                                    <div class="col-5">
                                                        <strong>Nom de la réservation :</strong>
                                                    </div>
                                                    <div class="col text-left">
                                                    <?= ucfirst($lesson->firstname) ?> <?= ucfirst($lesson->lastname) ?>
                                                    </div>
                                                    <div class="col-1">
                                                    <?= $this->Html->link(
                                                            '',
                                                            ['controller' => 'Lessons', 'action' => 'edit', $lesson->id],
                                                            ['class' => 'fa-solid fa-pen-to-square border-0 bg-transparent', 'type' => 'edit'],
                                                        ) ?>
                                                    </div>
                                                </div>
                                                <?php 
                                                
                                                // Iterate on each lesson an assign a horse or blank to this lesson.
                                                for ($i=0; $i<$lesson->number_of_riders; $i++) {
                                                    $selectedHorse = null;
                                                    
                                                    // Assign the horse at position $i.
                                                    if (isset($lesson->horses[$i])) {
                                                        $selectedHorse = $lesson->horses[$i];
                                                    }

                                                    $horseNames = [
                                                        [
                                                            'text' => 'Aucun',
                                                            'value' => -1,
                                                            'selected' => $selectedHorse == null
                                                        ]
                                                    ];
                                                    
                                                    foreach ($horses as $horse) {
                                                        if (in_array($horse->id, $lockedHorseIds) && $selectedHorse?->id != $horse->id) {
                                                            continue;
                                                        }

                                                        $totalWorkingSeconds = 0;
                                                        $maxWorkingSeconds = $horse->max_working_hours * 3600;
                                                    
                                                        foreach ($horse->lessons as $l) {
                                                            $duration = $l->planning->end_datetime->getTimestamp() - $l->planning->start_datetime->getTimestamp();
                                                            $totalWorkingSeconds += $duration;
                                                        }
                                                    
                                                        $remainingWorkingSeconds = $maxWorkingSeconds - $totalWorkingSeconds;
                                                    
                                                        $horseNames[] = [
                                                            'text' => ucfirst(h($horse->name)) . ' - ' . $remainingWorkingSeconds/3600 . __('h restantes'),
                                                            'value' => $horse->id, 
                                                            'selected' => $selectedHorse != null && $horse->id == $selectedHorse->id,
                                                        ];
                                                    }
                                                    echo $this->Form->select("horse$lessonKey$i", $horseNames, ['class' => 'form-select form-select-sm m-3', 'multiple' => false]);
                                                }
                                                ?>
                                            <?php endforeach ?>
                                            <?= $this->Form->button(__('Enregistrer les modifications'), ['class' => 'btn btn-primary']) ?>
                                            <?= $this->Form->end() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col">
                <h2>Nouvelle Leçon</h2>
                <div class="form">
                    <?= $this->Form->create(null, ['url' => ['controller' => 'Lessons', 'action' => 'add']]) ?>
                    
                    <div class="mb-3">
                        <?= $this->Form->control(
                            'firstname',
                            [
                                'class' => 'form-control',
                                'label' => [
                                    'class' => 'form-label',
                                    'text' => 'Prénom',
                                ]
                            ]
                        ) ?>
                    </div>
                    <div class="mb-3">
                        <?= $this->Form->control(
                            'lastname',
                            [
                                'class' => 'form-control',
                                'label' => [
                                    'class' => 'form-label',
                                    'text' => 'Nom'
                                ]
                            ]
                        ) ?>
                    </div>
                    <div class="mb-3">
                        <?= $this->Form->control(
                            'number_of_people',
                            [
                                'type' => 'integer', 
                                'class' => 'form-control', 
                                'label' => [
                                    'class' => 'form-label',
                                    'text' => 'Personne(s)'
                                ],
                                'default' => 1,
                                'min' => 1,
                                'max' => 10,
                            ]
                        ) ?>
                    </div>
                    <div class="input-group mb-3">
                        <?= $this->Form->control(
                            'price',
                            [
                                'type' => 'integer', 
                                'class' => 'form-control', 
                                'label' => [
                                    'class' => 'form-label',
                                    'text' => 'Prix',
                                ],
                                'default' => 0,
                                'min' => 0,
                                'max' => 30000,
                            ]
                        ) ?>
                    </div>
                    <div>
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
                        <?= $this->Form->select('planning', $planningsToString, ['class' => 'form-select', 'multiple' => false, 'label' => 'planning']) ?>
                    </div>
                    <?= $this->Form->button(__('Créer'), ['class' => "mt-3 btn btn-primary"]); ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/Dashboard/main.js" crossorigin="anonymous"></script>
