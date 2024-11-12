<div>
	<h1>Daily Planning</h1>

	<div>
		<?= date('r') ?>
	</div>

    <div class="accordion" id="accordionExample">
    <?php foreach($lessons as $key => $lesson): ?>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button <?php if ($key != 0) echo 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $key ?>" aria-expanded="<?php if ($key == 0) echo 'true'; ?>" aria-controls="collapse<?= $key ?>">
                    <?= h($lesson->team->name) ?>
                </button>
            </h2>
            <div id="collapse<?= $key ?>" class="accordion-collapse collapse <?php if ($key == 0)  echo 'show'; else echo 'false' ?>" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
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