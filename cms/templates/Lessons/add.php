<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lesson $lesson
 * @var \Cake\Collection\CollectionInterface|string[] $plannings
 * @var \Cake\Collection\CollectionInterface|string[] $horses
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Lessons'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="lessons form content">
            <?= $this->Form->create($lesson) ?>
            <fieldset>
                <legend><?= __('Add Lesson') ?></legend>
                <?php
                    echo $this->Form->control('price');
                    echo $this->Form->control('number_of_riders');
                    echo $this->Form->control('firstname');
                    echo $this->Form->control('lastname');
                    echo $this->Form->control('planning_id', ['options' => $plannings]);
                    echo $this->Form->control('horses._ids', ['options' => $horses]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
