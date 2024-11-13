<div>
	<h1>Daily Planning</h1>

	<div class="pb-3">
		<?= date('l, d F, Y') ?>
	</div>

    <div class="accordion" id="accordionExample">
    <?php foreach($lessons as $key => $lesson): ?>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button <?php if ($selectedLesson != $lesson->id) echo 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $key ?>" aria-expanded="<?php if ($key == 0) echo 'true'; ?>" aria-controls="collapse<?= $key ?>">
                    <?= h($lesson->team->name) ?>
                    <?= h(date_format($lesson->start_datetime, 'H:i')) ?> -
                    <?= h(date_format($lesson->end_datetime, 'H:i')) ?>
                </button>
            </h2>
            <div id="collapse<?= $key ?>" class="accordion-collapse collapse <?php if ($selectedLesson == $lesson->id)  echo 'show'; else echo 'false' ?>" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="container text-left">
                        <div class="row">
                            <div class="col">
                                <?= __('The lesson has currently') ?> <?= count($lesson->team->riders) ?> <?= __('people') ?>.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?= __('Assign') ?> <?= count($lesson->team->riders) ?> horse<?php if (count($lesson->team->riders) > 1) echo 's' ?> :
                            </div>
                        </div>
                        <div class="row">
                            <?= $this->Form->create($lesson, ['type' => 'put', 'url' => ['controller' => 'Lessons', 'action' => 'assign', $lesson->id]]) ?>
                            <?php foreach ($lesson->horses as $index => $selectedHorse): ?>
                                <?php
                                $horseNames = [];
                                foreach ($horses as $horse) {
                                    $horseNames[] = [
                                        'text' => ucfirst(h($horse->name)),
                                        'value' => $horse->id, 
                                        'selected' => $horse->id == $selectedHorse->id
                                    ];
                                }
                                ?>
                                <?= $this->Form->select("horse$index", $horseNames, ['class' => 'form-select form-select-sm m-3', 'multiple' => false]) ?>
                            <?php endforeach ?>
                            <?= $this->Form->button(__('Save changes'), ['class' => 'btn btn-primary']) ?>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    </div>
</div>