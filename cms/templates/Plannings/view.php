<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Planning $planning
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Planning'), ['action' => 'edit', $planning->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Planning'), ['action' => 'delete', $planning->id], ['confirm' => __('Are you sure you want to delete # {0}?', $planning->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Plannings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Planning'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="plannings view content">
            <h3><?= h($planning->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($planning->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Datetime') ?></th>
                    <td><?= h($planning->start_datetime) ?></td>
                </tr>
                <tr>
                    <th><?= __('End Datetime') ?></th>
                    <td><?= h($planning->end_datetime) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($planning->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($planning->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Lessons') ?></h4>
                <?php if (!empty($planning->lessons)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Number Of Riders') ?></th>
                            <th><?= __('Firstname') ?></th>
                            <th><?= __('Lastname') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Planning Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($planning->lessons as $lesson) : ?>
                        <tr>
                            <td><?= h($lesson->id) ?></td>
                            <td><?= h($lesson->price) ?></td>
                            <td><?= h($lesson->number_of_riders) ?></td>
                            <td><?= h($lesson->firstname) ?></td>
                            <td><?= h($lesson->lastname) ?></td>
                            <td><?= h($lesson->created) ?></td>
                            <td><?= h($lesson->modified) ?></td>
                            <td><?= h($lesson->planning_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Lessons', 'action' => 'view', $lesson->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Lessons', 'action' => 'edit', $lesson->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Lessons', 'action' => 'delete', $lesson->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lesson->id)]) ?>
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