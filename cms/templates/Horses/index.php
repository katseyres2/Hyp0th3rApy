<h1>Gestionnaire de chevaux</h1>

<div class="container p-3">
	<div class="row gx-5">
		<div class="col">
			<div class="">
				<table class="table table-striped">
					<?= $this->Html->tableHeaders([
						['Nom' => ['scope' => 'col']],
						['Heures max par jour' => ['scope' => 'col']],
						['Modifier' => ['scope' => 'col']],
						['Supprimer' => ['scope' => 'col']],
					]) ?>
					<?php foreach ($horses as $h): ?>
					<tr>
						<td><?= h(ucfirst($h->name)) ?></td>
						<td><?= $h->max_working_hours ?></td>
						<td>
							<?= $this->Form->create(null, ['url' => ['action' => 'edit'], 'type' => 'put']) ?>
							<?= $this->Form->hidden('id', ['default' => $h->id, 'class' => '']) ?>
							<?= $this->Form->button('', ['class' => 'fa-solid fa-pen-to-square border-0 bg-transparent', 'type' => 'submit']) ?>
							<?= $this->Form->end() ?> 
						</td>
						<td>
							<?= $this->Form->create(null, ['url' => ['action' => 'delete'], 'type' => 'delete']) ?>
							<?= $this->Form->hidden('id', ['default' => $h->id, 'class' => '']) ?>
							<?= $this->Form->button('', ['class' => 'fa-solid fa-trash border-0 bg-transparent', 'style' => 'color: red', 'type' => 'submit', 'confirm' => __('Confirm')]) ?>
							<?= $this->Form->end() ?> 
						</td>
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
						<?= $this->Form->control('name', ['class' => 'form-control', 'label' => ['class' => 'form-label', 'text' => 'Nom'], 'placeholder' => __('le nom du cheval...')]) ?>
					</div>
					<div class="mb-3">
						<?= $this->Form->control('max_working_hours', ['class' => 'form-control', 'label' => ['class' => 'form-label', 'text' => 'Heures max par jour'], 'default' => 0, 'min' => 0, 'max' => 24]) ?>
					</div>
					<?= $this->Form->button(__('Créer'), ['class' => "btn btn-primary"]); ?>
					<?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</div>
