<div class="users form content">
    <?= $this->Form->create() ?>
    <div class="mb-3">
        <?= $this->Form->control('email', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
    </div>
    <div class="mb-3">
        <?= $this->Form->control('password', ['class' => 'form-control', 'label' => ['class' => 'form-label']]) ?>
    </div>
    <div class="mb-3">
        <div class="form-check">
            <?= $this->Form->control('remember_me', ['type' => 'checkbox', 'class' => 'form-check-input', 'label' => ['class' => 'form-check-label']]) ?>
        </div>
    </div>
    <div class="mb-3">
        <?= $this->Form->button(__('Login'), ['class' => "btn btn-primary"]); ?>
        <?= $this->Html->link(__('Create account'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'btn btn-primary m-2']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>