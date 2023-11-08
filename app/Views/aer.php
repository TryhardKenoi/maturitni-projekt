<?php

echo $this->extend("layout/master");

echo $this->section("content");
?>
<div class="container py-5 h-10">
  <div class="row justify-content-center align-items-center h-100 text-light">
     <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration " style="border-radius: 15px;">
           <div class="card-body p-4 p-md-5 bg-danger">
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-4 text-center">Přidejte misi</h3>
              <form action="<?php base_url();?>" method="post">
                <div validation-summary="ModelOnly" class="text-danger"></div>
                  <div class="row">
                      <!-- Username -->
                      <div class="col-md-6 mb-2">
                          <div class="form-outline">
                          <label for="Username" class="control-label"></label>
                          <input for="Username" id="Username" class="form-control form-control-lg" />
                          </div>
                      </div>
                      <!-- Password -->
                      <div class="col-md-6 mb-2">
                          <div class="form-outline">
                          <label for="Password" class="control-label"></label>
                          <input for="Password" id="Password" class="form-control form-control-lg" />
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <!-- First Name -->
                      <div class="col-md-6 mb-2">
                          <div class="form-outline">
                          <label for="Name" class="control-label"></label>
                          <input for="Name" id="Name" class="form-control form-control-lg" />
                          </div>
                      </div>
                      <!-- Last Name -->
                      <div class="col-md-6 mb-2">
                          <div class="form-outline">
                          <label for="Surname" class="control-label"></label>
                          <input for="Surname" id="Surname" class="form-control form-control-lg" />
                          </div>
                      </div>
                  </div>
                  <div class="row">
                  <!-- Submit -->
                  <div class="mt-2 pt-2 text-center">
                      <h1>Seru na to</h1>
                  </div>
              </form>
          </div>
       </div>
    </div>
 </div>
</div>
<?php
    /*$table = new \CodeIgniter\View\Table();
    $table->setHeading("ID", "Název");
    foreach ($data as $row) {
    $radek = array();
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
    echo "</div>";
*/
echo $this->endSection();
