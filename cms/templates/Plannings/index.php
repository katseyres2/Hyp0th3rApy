<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Planning> $plannings
 */
?>
<div class="plannings index content">
    <h3><?= __('Plannings') ?></h3>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('start_datetime', 'Début') ?></th>
                    <th><?= $this->Paginator->sort('end_datetime', "Fin") ?></th>
                    <th><?= __('Nombre de participants') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($plannings as $planning): ?>
                <?php
                $numberOfRiders = 0;
                foreach ($planning->lessons as $lesson) {
                    $numberOfRiders += $lesson->number_of_riders;
                }
                ?>

                <tr>
                    <td><?= h(date_format($planning->start_datetime, 'd/m/Y à H:i:s')) ?></td>
                    <td><?= h(date_format($planning->end_datetime, 'd/m/Y à H:i:s')) ?></td>
                    <td><?= h($numberOfRiders) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('premier')) ?>
            <?= $this->Paginator->prev('< ' . __('précédent')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('suivant') . ' >') ?>
            <?= $this->Paginator->last(__('dernier') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} sur {{pages}}, montre {{current}} élément(s) sur {{count}}')) ?></p>
    </div>
</div>