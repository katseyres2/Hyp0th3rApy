<div>
	<h1>Daily Planning</h1>

	<div>
		<?= date('r') ?>
	</div>

	<table>
		<?= $this->Html->tableHeaders(['Schedules', 'Create a new customer']) ?>
		<tr>
			<td>
				<table>
					<?= $this->Html->tableHeaders(['Hours', 'Price', 'Number of people', 'Start datetime', 'Customer']) ?>
                    <?php foreach($lessons as $lesson): ?>
                    <tr>
                        <td><?= $lesson->price ?></td>
                        <td><?= $lesson->hours ?></td>
                        <td><?= $lesson->number_of_people ?></td>
                        <td><?= $lesson->start_datetime ?></td>
                        <td><?= $lesson->customer->name ?></td>

                    </tr>
                    <?php endforeach ?>
				</table>
			</td>
			<td>
				<?= $this->Form->create($customer, ['type' => 'post']) ?>
				<?= $this->Form->control('name') ?>
				<?= $this->Form->control('people number', ['type' => 'integer']) ?>
				<?= $this->Form->control('duration (hours)', ['type' => 'time']) ?>
				<?= $this->Form->control('price', ['type' => 'float']) ?>
				<?= $this->Form->button(__('Create')) ?>
				<?= $this->Form->end() ?>
			</td>
		</tr>
	</table>


    <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Collapsible Group Item #1
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Collapsible Group Item #2
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Collapsible Group Item #3
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>


	<!-- <div class="container py-9 py-lg-11 position-relative z-index-1">
    <div class="row">
            <div class="col-lg-5 mb-5 mb-lg-0">
                <h5 class="mb-4 text-info aos-init aos-animate" data-aos="fade-up">Schedule and Agenda</h5>
                <div class="nav nav-pills flex-column aos-init aos-animate" id="myTab" role="tablist" data-aos="fade-up">
                    <button class="nav-link px-4 text-start mb-3 active" id="d1-tab" data-bs-toggle="tab" data-bs-target="#day1" type="button" role="tab" aria-controls="day1" aria-selected="true">
                        <span class="d-block fs-5 fw-bold">Day 1</span>
                        <span class="small">Mon, Jan 2, 2023</span>
                    </button>
                    
                    <button class="nav-link px-4 text-start" id="d2-tab" data-bs-toggle="tab" data-bs-target="#day2" type="button" role="tab" aria-controls="day2" aria-selected="false" tabindex="-1">
                        <span class="d-block fs-5 fw-bold">Day 2</span>
                        <span class="small">Tue, Jan 3, 2023</span>
                    </button>
                </div>
            </div>
            
            <div class="col-lg-7 col-xl-6">
                <div data-aos="fade-up" class="tab-content aos-init aos-animate" id="myTabContent">
                    <div class="tab-pane fade active show" id="day1" role="tabpanel" aria-labelledby="d1-tab">
                        <ul class="pt-4 list-unstyled mb-0">
                            <li class="d-flex flex-column flex-md-row py-4">
                                <span class="flex-shrink-0 width-13x me-md-4 d-block mb-3 mb-md-0 small text-muted">9:00
                                    AM - 10:00 AM</span>
                                <div class="flex-grow-1 ps-4 border-start border-3">
                                    <h4>Registration and Coffee</h4>
                                    <p class="mb-0">
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                        officia deserunt mollit anim id est laborum.
                                    </p>
                                </div>
                            </li>
                            <li class="d-flex flex-column flex-md-row py-4">
                                <span class="flex-shrink-0 width-13x me-md-4 d-block mb-3 mb-md-0 small text-muted">10:00
                                    AM - 11:00 AM</span>
                                <div class="flex-grow-1 ps-4 border-start border-3">
                                    <h4>Culpa qui officia deserunt</h4>
                                    <p class="mb-0">
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                        officia deserunt mollit anim id est laborum.
                                    </p>
                                </div>
                            </li>
                            <li class="d-flex flex-column flex-md-row py-4">
                                <span class="flex-shrink-0 width-13x me-md-4 d-block mb-3 mb-md-0 small text-muted">11:00
                                    AM - 12:30 PM</span>
                                <div class="flex-grow-1 ps-4 border-start border-3">
                                    <h4>Excepteur sint occaecat cupidatat</h4>
                                    <p class="mb-0">
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                        officia deserunt mollit anim id est laborum.
                                    </p>
                                </div>
                            </li>
                            <li class="d-flex flex-column flex-md-row py-4">
                                <span class="flex-shrink-0 width-13x me-md-4 d-block mb-3 mb-md-0 small text-muted">12:30
                                    PM - 1:30 PM</span>
                                <div class="flex-grow-1 ps-4 border-start border-3">
                                    <h4>Lunch break</h4>
                                    <p class="mb-0">
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                        officia deserunt mollit anim id est laborum.
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="day2" role="tabpanel" aria-labelledby="d2-tab">
                        <ul class="pt-4 list-unstyled mb-0">
                            <li class="d-flex flex-column flex-md-row py-4">
                                <span class="flex-shrink-0 width-13x me-md-4 d-block mb-3 mb-md-0 small text-muted">9:00
                                    AM - 10:00 AM</span>
                                <div class="flex-grow-1 ps-4 border-start border-3">
                                    <h4>Excepteur sint occaecat</h4>
                                    <p class="mb-0">
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                        officia deserunt mollit anim id est laborum.
                                    </p>
                                </div>
                            </li>
                            <li class="d-flex flex-column flex-md-row py-4">
                                <span class="flex-shrink-0 width-13x me-md-4 d-block mb-3 mb-md-0 small text-muted">10:00
                                    AM - 11:00 AM</span>
                                <div class="flex-grow-1 ps-4 border-start border-3">
                                    <h4>Culpa qui officia deserunt</h4>
                                    <p class="mb-0">
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                        officia deserunt mollit anim id est laborum.
                                    </p>
                                </div>
                            </li>
                            <li class="d-flex flex-column flex-md-row py-4">
                                <span class="flex-shrink-0 width-13x me-md-4 d-block mb-3 mb-md-0 small text-muted">11:00
                                    AM - 12:30 PM</span>
                                <div class="flex-grow-1 ps-4 border-start border-3">
                                    <h4>Excepteur sint occaecat cupidatat</h4>
                                    <p class="mb-0">
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                        officia deserunt mollit anim id est laborum.
                                    </p>
                                </div>
                            </li>
              
                       
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>