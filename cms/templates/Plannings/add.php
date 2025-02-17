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
            <?= $this->Html->link(__('List Plannings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="plannings form content">
            <?= $this->Form->create($planning) ?>
            <fieldset>
                <legend><?= __('Add Planning') ?></legend>
                <?php
                    echo $this->Form->control('start_datetime');
                    echo $this->Form->control('end_datetime');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
