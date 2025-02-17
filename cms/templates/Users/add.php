<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users form content">
    <?= $this->Form->create($user, ['type' => 'post', 'url' => ['controller' => 'Users', 'action' => 'add']]) ?>
    <div class="mb-3">
        <?= $this->Form->control('username', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
    </div>
    <div class="mb-3">
        <?= $this->Form->control('email', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
    </div>
    <div class="mb-3">
        <?= $this->Form->control('password', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
    </div>
    <?= $this->Form->button(__('Create'), ['class' => "btn btn-primary"]); ?>
    <?= $this->Form->end() ?>
</div>