<html>

    <head>

        <title>Kenoi's website</title>
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/bootstrap/css/custom.css'); ?>">

    </head>

    <body>
        <?= $this->include('layout/navbar'); ?>
        <div class="container-fluid">
            <!--Area for dynamic content -->
            <?= $this->renderSection("content"); ?>
        </div>
    <body>

</html>