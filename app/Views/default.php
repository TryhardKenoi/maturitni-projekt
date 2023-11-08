<?php

echo $this->extend("layout/master");

echo $this->section("content");

?>

<div class="container p-3">
    <div class="row align-items-stretch justify-content-start card-deck">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <img src="<?= base_url('assets/images/kosmonaut.jpg')?>" class="card-img-top" alt="...">
                <div class="card-text">
                    <h6 class="text-white pt-2">Info o kosmonautech a jejich raketách</h6>
                    <a href="<?= base_url('kosmonaut')?>" type="button" class="btn btn-primary">Více info</a>
                </div>
            </div>
        </div>
        <div class="card text-white bg-dark">
            <div class="card-body">
                <img src="<?= base_url('assets/images/organizace.jpg')?>" class="card-img-top" alt="...">
                <div class="card-text">
                    <h6 class="text-white pt-2">Info o organizacích</h6>
                    <a href="<?= base_url('organizace')?>" type="button" class="btn btn-primary">Více info</a>
                </div>
            </div>
        </div>
        <div class="card text-white bg-dark">
            <div class="card-body">
                <img src="<?= base_url('assets/images/stanice.jpg')?>" class="card-img-top" alt="...">
                <div class="card-text">
                    <h6 class="text-white pt-2">Info o zemi a vesmírných stanicích</h6>
                    <a href="<?= base_url('zeme')?>" type="button" class="btn btn-primary">Více info</a>
                </div>
            </div>
        </div>
        <div class="w-100">

        </div>


    <div class="container p-5">
        <div class="alert alert-primary text-center" role="alert">
            Bylo by to tak pěkné, pokud bychom nemuseli dětal takové kokotiny, ale budíž.
            <a href="<?= base_url('/useless')?>">
                <button type="button" class="btn btn-secondary">Kokotiny zde</button>
            </a>

        </div>
    </div>


<?php

echo $this->endSection();