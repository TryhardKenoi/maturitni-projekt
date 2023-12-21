<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>


    <div class="text-center">
      <div class="text-center pt-3">
        <h1>Skupina</h1>
        <hr>
      </div>
        <p>Název: <?= $group->name; ?></p>
        <p>Popisek: <?= $group->description; ?></p>
    </div>


<?php $this->endSection(); ?>
