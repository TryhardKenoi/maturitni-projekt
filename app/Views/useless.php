<?php

echo $this->extend("layout/master");

echo $this->section("content");


?>
  <div class="container p-3">
    <div class="row align-items-stretch justify-content-start card-deck">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <img src="<?= base_url('assets/images/pagination.png')?>" class="card-img-top" alt="...">
                <div class="card-text">
                    <h6 class="text-white pt-2">Pagination</h6>
                    <a href="<?= base_url('useless/page')?>" type="button" class="btn btn-primary">Objevit</a>
                </div>
            </div>
        </div>
        <div class="card text-white bg-dark">
            <div class="card-body">
                <img src="<?= base_url('assets/images/plusminus.jpg')?>" class="card-img-top" alt="...">
                <div class="card-text">
                    <h6 class="text-white pt-2">Přidávání/Editace</h6>
                    <a href="<?= base_url('useless/aer')?>" type="button" class="btn btn-primary">Objevit</a>
                </div>
            </div>
        </div>
        <div class="w-100">

        </div>

<?php
echo $this->endSection();
