<h1>Update horse</h1>

<div class="form content">
	<?= $this->Form->create($horse, ['url' => ['action' => 'edit']]) ?>
	<div class="mb-3"><?= $this->Form->control('name', ['class' => 'form-control', 'label' => ['class' => 'form-label'], 'placeholder' => __('the name of the horse')]) ?></div>
	<div class="mb-3"><?= $this->Form->control('max_working_hours', ['class' => 'form-control', 'label' => ['class' => 'form-label'], 'default' => 0, 'min' => 0, 'max' => 24]) ?></div>
	<?= $this->Form->hidden('update', ['default' => true]) ?>
	<?= $this->Form->hidden('id', ['default' => $horse->id]) ?>
	<?= $this->Form->button(__('Save'), ['class' => "btn btn-primary"]); ?>
	<?= $this->Form->end() ?>
</div>