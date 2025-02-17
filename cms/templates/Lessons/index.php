<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Lesson> $lessons
 */
?>
<div class="lessons index content">
    <h3><?= __('Leçons') ?></h3>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('firstname', 'Prénom') ?></th>
                    <th><?= $this->Paginator->sort('lastname', 'Nom') ?></th>
                    <th><?= $this->Paginator->sort('number_of_riders', 'Nombre de personnes') ?></th>
                    <th><?= $this->Paginator->sort('price', 'Prix') ?></th>
                    <th><?= $this->Paginator->sort('created', 'Date de création') ?></th>
                    <th><?= $this->Paginator->sort('modified', 'Dernière modification') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lessons as $lesson): ?>
                <tr>
                    <td><?= h($lesson->firstname) ?></td>
                    <td><?= h($lesson->lastname) ?></td>
                    <td><?= $this->Number->format($lesson->number_of_riders) ?></td>
                    <td><?= $this->Number->format($lesson->price) ?></td>
                    <td><?= h(date_format($lesson->created, 'd/m/Y à H:i:s')) ?></td>
                    <td><?= h(date_format($lesson->modified, 'd/m/Y à H:i:s')) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Voir'), ['action' => 'view', $lesson->id]) ?>
                        <?= $this->Html->link(__('Modifier'), ['action' => 'edit', $lesson->id]) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $lesson->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lesson->id)]) ?>
                    </td>
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
        <p><?= $this->Paginator->counter(__('Page {{page}} sur {{pages}}, montre {{current}} leçon(s) sur {{count}}')) ?></p>
    </div>
</div>