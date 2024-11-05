<h1>Add new horse</h1>

<?= $this->Form->create($horse) ?>
<?= $this->Form->control('name') ?>
<?= $this->Form->control('max_working_hours') ?>
<?= $this->Form->button(__('Create')) ?>
<?= $this->Form->end() ?>