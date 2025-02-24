<div>
	<h1><?= h(__('Facturation')) ?></h1>

	<div class="pb-3">
		<?= date('l, d F, Y') ?>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-5">
				<h2><?= __('Historique') ?></h2>
				<div class="accordion" id="accordionExample">
					<?php foreach ($invoice['months'] as $idx => $monthData): ?>
						
						<div class="accordion-item">
							<div class="accordion-header">
								<button class="accordion-button <?php if ($idx != array_key_first($invoice['months'])) echo 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $idx ?>" aria-expanded="<?php if ($idx == array_key_first($invoice['months'])) echo 'true'; ?>" aria-controls="collapse<?= $idx ?>">
									<div class="container">
										<div class="row">
											<div class="col-8">
											<?= DateTime::createFromFormat('!m', $idx)->format('F') ?>, <?= $invoice['year'] ?>
											</div>
											<div class="col">
											<?= $monthData['total_amount'] . ' €' ?>
											</div>
										</div>
									</div>
									
								</button>
							</div>
							<div id="collapse<?= $idx ?>" class="accordion-collapse collapse <?php if ($idx == array_key_first($invoice['months']))  echo 'show'; else echo 'false' ?>" data-bs-parent="#accordionExample">
								<div class="accordion-body">
									<ul class="list-group">
										<?php foreach ($monthData['lessons'] as $lesson): ?>
											<li class="list-group-item">
												<div class="container">
													<div class="row">
														<div class="col-8">
														<?= $lesson['firstname'] .' '. $lesson['lastname'] ?>
														</div>
														<div class="col">
														<?= $lesson['total_amount'] ?> €
														</div>
													</div>
												</div>
											</li>
										<?php endforeach ?>
									</ul>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
			<div class="col">
				<h2><?= __('Mois actuel') ?></h2>
				<table class="table table-hover rounded">
					<thead class="border-bottom-1 border-secondary">
						<?= $this->Html->tableHeaders([
							['Nom de la leçon' => ['scope' => 'col']],
							['Total' => ['scope' => 'col']],
						]) ?>
					</thead>
					<?php foreach ($invoice['months'] as $month => $data): ?>
						<?php if ($data['is_current_month']): ?>
							<tbody class="border-0">
								<?php foreach ($data['lessons'] as $lesson): ?>
									<tr class="border-0">
										<td class="border-0"><?= $lesson['firstname'] .' '. $lesson['lastname'] ?></td>
										<td class="border-0"><?= $lesson['total_amount'] ?> €</td>
									</tr>
								<?php endforeach ?>

							</tbody>
							<tfoot class="border-top border-secondary">
								<tr>
									<td colspan="1"><?= __('Total') ?> : <?= $data['total_amount'] ?> €</td>
									<td>
										<a href="#"><?= __('Envoyer les factures') ?> <i class="fa-solid fa-paper-plane"></i></a>
									</td>
								</tr>
							</tfoot>
						<?php endif ?>
					<?php endforeach ?>
				</table>
			</div>
		</div>
	</div>
	
</div>