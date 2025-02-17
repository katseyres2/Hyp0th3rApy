<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lesson $lesson
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Lesson'), ['action' => 'edit', $lesson->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Lesson'), ['action' => 'delete', $lesson->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lesson->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Lessons'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Lesson'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="lessons view content">
            <h3><?= h($lesson->firstname) ?></h3>
            <table>
                <tr>
                    <th><?= __('Firstname') ?></th>
                    <td><?= h($lesson->firstname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lastname') ?></th>
                    <td><?= h($lesson->lastname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Planning') ?></th>
                    <td><?= $lesson->hasValue('planning') ? $this->Html->link($lesson->planning->id, ['controller' => 'Plannings', 'action' => 'view', $lesson->planning->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($lesson->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($lesson->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Number Of Riders') ?></th>
                    <td><?= $this->Number->format($lesson->number_of_riders) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($lesson->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($lesson->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Horses') ?></h4>
                <?php if (!empty($lesson->horses)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Max Working Hours') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($lesson->horses as $horse) : ?>
                        <tr>
                            <td><?= h($horse->id) ?></td>
                            <td><?= h($horse->name) ?></td>
                            <td><?= h($horse->max_working_hours) ?></td>
                            <td><?= h($horse->created) ?></td>
                            <td><?= h($horse->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Horses', 'action' => 'view', $horse->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Horses', 'action' => 'edit', $horse->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Horses', 'action' => 'delete', $horse->id], ['confirm' => __('Are you sure you want to delete # {0}?', $horse->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>