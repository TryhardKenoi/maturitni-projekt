<?php

echo $this->extend("layout/master");

echo $this->section("content");

?>
<div class="text-center p-3">
    <h1 class="text-center">Stránkování</h1>
</div>
<?php

    $table = new \CodeIgniter\View\Table();
    $table->setHeading("Název mise", "Čas startu mise", "Datum startu mise");
    foreach ($records as $row) {
    $radek = array($row->nazev, $row->start, $row->datum);
    $table->addRow($radek);
    }
    $template = [
    'table_open' => '<table class="table table-dark table-striped table-bordered">',
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
    echo $pager->links();
    echo "</div>";

echo $this->endSection();
