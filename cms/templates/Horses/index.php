<h1>Horses</h1>
<?= $this->Html->link('Add new horse', ['action' => 'add']) ?>
<table>
	<?= $this->Html->tableHeaders(['Name', 'Max working hours', 'Last modification', 'Actions']) ?>
	<?php foreach ($horses as $horse): ?>
	<tr>
		<td><?= $this->Html->link($horse->name, ['action' => 'view', $horse->id]) ?></td>
		<td><?= $horse->max_working_hours ?></td>
		<td><?= $horse->modified->format(DATE_RFC850) ?></td>
		<td>
			<?= $this->Html->link('Edit', ['action' => 'edit', $horse->id]) ?> | 
			<?= $this->Form->postLink('Delete', ['action' => 'delete', $horse->id], ['confirm' => 'Sure?']) ?>
		</td>
	</tr>
	<?php endforeach ?>
</table>