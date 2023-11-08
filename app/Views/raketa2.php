<?php

echo $this->extend("layout/master");

echo $this->section("content");

$table = new \CodeIgniter\View\Table();
$table->setHeading("Jméno", "Příjmení");
foreach ($data as $row) {
    $radek = array($row->jmeno, $row->prijmeni);
    $table->addRow($radek);
}
?>

        <div class="text-center p-3">
            <h1 class="text-center">Obrázek</h1>
            <img src="<?= base_url('/assets/images/' . $row->obrazek);?>" class="ahoj pb-5 pt-3 img-fluid">
        </div>

        <div class="text-center p-5">
            <h1>Videozáznam ze vzletu rakety</h1>
              <iframe width="560" height="315" src="<?= $row->odkaz?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

    <h1 class="text-center">Jména kosmonautů, kteří měli možnost si tuto skvělou raketku vyzkoušet</h1>
</div>




<?php
$template = [
    'table_open' => '<table class="table table-dark table-striped table-bordered ">',
    'thead_open' => '<thead>',
    'thead_close' => '</thead>',
    'heading_row_start' => '<tr>',
    'heading_row_end' => '</tr>',
    'heading_cell_start' => '<th>',
    'heading_cell_end' => '</th>',
    'tfoot_open' => '<tfoot>',
    'tfoot_close' => '</tfoot>',
    'footing_row_start' => '<tr>',
    'footing_row_end' => '</tr>',
    'footing_cell_start' => '<td>',
    'footing_cell_end' => '</td>',
    'tbody_open' => '<tbody>',
    'tbody_close' => '</tbody>',
    'row_start' => '<tr>',
    'row_end' => '</tr>',
    'cell_start' => '<td>',
    'cell_end' => '</td>',
    'row_alt_start' => '<tr>',
    'row_alt_end' => '</tr>',
    'cell_alt_start' => '<td>',
    'cell_alt_end' => '</td>',
    'table_close' => '</table>'
];

$table->setTemplate($template);
echo "<div class=container pl-5 pr-5>";
echo $table->generate();
echo "</div>";


echo $this->endSection();
