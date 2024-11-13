<h1>Horse Manager</h1>

<div class="container p-3">
	<div class="row gx-5">
		<div class="col">
			<div class="">
				<table class="table table-striped">
					<?= $this->Html->tableHeaders([
						['Name' => ['scope' => 'col']],
						['Max working hours' => ['scope' => 'col']],
						['Edit' => ['scope' => 'col']],
						['Delete' => ['scope' => 'col']],
					]) ?>
					<?php foreach ($horses as $h): ?>
					<tr>
						<td><?= h(ucfirst($h->name)) ?></td>
						<td><?= $h->max_working_hours ?></td>
						<td><?= $this->Html->link('', ['action' => 'edit', $h->id], ['class' => 'fa-solid fa-pen-to-square']) ?></td>
						<td>
							<?= $this->Form->create(null, ['url' => ['action' => 'delete'], 'type' => 'delete']) ?>
							<?= $this->Form->hidden('id', ['default' => $h->id, 'class' => '']) ?>
							<?= $this->Form->button('', ['class' => 'fa-solid fa-trash border-0 bg-transparent', 'style' => 'color: red', 'type' => 'submit', 'confirm' => __('Confirm')]) ?>
							<?= $this->Form->end() ?> 
					</tr>
					<?php endforeach ?>
				</table>
			</div>
		</div>
		<div class="col">
			<div class="">
				<div class="form content">
					<?= $this->Form->create($horse, ['url' => ['action' => 'add']]) ?>
					<div class="mb-3">
						<?= $this->Form->control('name', ['class' => 'form-control', 'label' => ['class' => 'form-label'], 'placeholder' => __('the name of the horse')]) ?>
					</div>
					<div class="mb-3">
						<?= $this->Form->control('max_working_hours', ['class' => 'form-control', 'label' => ['class' => 'form-label'], 'default' => 0, 'min' => 0, 'max' => 24]) ?>
					</div>
					<?= $this->Form->button(__('Create'), ['class' => "btn btn-primary"]); ?>
					<?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</div>
