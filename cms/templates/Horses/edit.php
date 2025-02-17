<h1>Modifier le cheval</h1>

<div class="form content">
	<p>
		<em>
			* La modification d'heures maximale effectuées par le cheval n'aura pas d'impact sur les leçons déjà enregistrées avec ce cheval.
		</em>
	</p>
	<?= $this->Form->create($horse, ['url' => ['action' => 'edit']]) ?>
	<div class="mb-3"><?= $this->Form->control('name', ['class' => 'form-control', 'label' => ['class' => 'form-label', 'text' => 'Nom'], 'placeholder' => __('the name of the horse')]) ?></div>
	<div class="mb-3"><?= $this->Form->control('max_working_hours', ['class' => 'form-control', 'label' => ['class' => 'form-label', 'text' => 'Heures max par jour'], 'default' => 0, 'min' => 0, 'max' => 24]) ?></div>
	<?= $this->Form->hidden('update', ['default' => true]) ?>
	<?= $this->Form->hidden('id', ['default' => $horse->id]) ?>
	<?= $this->Form->button(__('Sauvegarder'), ['class' => "btn btn-primary"]); ?>
	<?= $this->Form->end() ?>
</div>