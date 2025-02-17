<div class="container p-3">
    <div class="row p-3">
        <div class="col-sm text-center">
            <div class="card">
                <div class="card-body">
                    Nombre de chevaux
                    <h1>
                        <?= $data['number_of_horses'] ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-sm text-center">
            <div class="card">
                <div class="card-body">
                    Nombre de leçons ce mois-ci
                    <h1>
                        <?= $data['number_of_lessons_this_month'] ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-sm text-center" style="visibility: collapse;">
            <div class="card">
                <div class="card-body">
                    Total ce mois-ci
                    <h1>
                        <?= $data['month_amount'] ?> €
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-sm text-center">
            <div class="card">
                <div class="card-body">
                    Dernier cheval créé
                    <h1>
                        <?= ucfirst($data['last_created_horse']->name) ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>