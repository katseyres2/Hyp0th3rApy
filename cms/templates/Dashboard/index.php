<div>
	<h1>Daily Planning</h1>

	<div class="pb-3">
		<?= date('l, d F, Y') ?>
	</div>

    <div class="accordion" id="accordionExample">
    <?php foreach($lessons as $key => $lesson): ?>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button <?php if ($key != 0) echo 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $key ?>" aria-expanded="<?php if ($key == 0) echo 'true'; ?>" aria-controls="collapse<?= $key ?>">
                    <?= h($lesson->team->name) ?>
                    <?= h(date_format($lesson->start_datetime, 'H:i')) ?> -
                    <?= h(date_format($lesson->end_datetime, 'H:i')) ?>
                </button>
            </h2>
            <div id="collapse<?= $key ?>" class="accordion-collapse collapse <?php if ($key == 0)  echo 'show'; else echo 'false' ?>" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?= count($lesson->team->riders) ?>
                    <?php foreach ($lesson->horses as $horse): ?>
                        <?= $horse->name ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    </div>

    <table>
        <?= $this->Html->tableHeaders(['Price', 'Number of people', 'Start datetime', 'End datetime', 'Team']) ?>
        
        <tr>
            <td><?= $lesson->price ?></td>
            <td><?= count($lesson->team->riders) ?></td>
            <td><?= $lesson->start_datetime ?></td>
            <td><?= $lesson->end_datetime ?></td>
            <td><?= $this->Html->link($lesson->team->name, ['controller' => 'Teams', 'action' => 'view', $lesson->team->id])  ?></td>
        </tr>
        
    </table>
</div>