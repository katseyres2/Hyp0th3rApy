<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b92b01fb6c.js" crossorigin="anonymous"></script>
    <?= $this->Html->css(['cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-2">
        <div class="container-fluid">
            <a href="<?= $this->Url->build('/') ?>" class="navbar-brand"><span>Hyp0</span>th3rApy</a>
            <div>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><?= $this->Html->link(__('Accueil'), ['controller' => 'Dashboard', 'action' => 'index'], ['class' => 'nav-link active']) ?></li>
                    <li class="nav-item"><?= $this->Html->link(__('Statistiques'), ['controller' => 'Statistics', 'action' => 'index'], ['class' => 'nav-link active']) ?></li>
                    <li class="nav-item"><?= $this->Html->link(__('Séances'), ['controller' => 'Plannings', 'action' => 'index'], ['class' => 'nav-link active']) ?></li>
                    <li class="nav-item"><?= $this->Html->link(__('Leçons'), ['controller' => 'Lessons', 'action' => 'index'], ['class' => 'nav-link active']) ?></li>
                    <li class="nav-item"><?= $this->Html->link(__('Chevaux'), ['controller' => 'Horses', 'action' => 'index'], ['class' => 'nav-link active']) ?></li>
                    <li class="nav-item"><?= $this->Html->link(__('Facturation'), ['controller' => 'Invoice', 'action' => 'index'], ['class' => 'nav-link active']) ?></li>
                    <?php if(isset($profile)): ?>
                    <li class="nav-item"><?= $this->Html->link(__('Compte'), ['controller' => 'Users', 'action' => 'profile'], ['class' => 'nav-link active']) ?></li>
                    <li class="nav-item"><?= $this->Html->link(__('Déconnexion'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link active']) ?></li>
                    <?php endif ?>
                    <li class="nav-item fs-4 pt-0 ps-4 mt-0"><a href="https://github.com/katseyres2/Hyp0th3rApy"><i class="mt-1 ms-3 fs-3 fa-brands fa-github" style="color: black;"></a></i></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="main m-3">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
