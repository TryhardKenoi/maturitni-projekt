<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <h1>Všichni uživatelé</h1>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Jméno</th>
                    <th scope="col">Příjmení</th>
                    <th></th>
                    
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $u): ?>
                    <tr>
                        <td><?= $u->id ?></td>
                        <td><?= $u->first_name ?></td>
                        <td><?= $u->last_name ?></td>
                        <td class="d-flex mx-1">
                            <a href="<?= base_url('/admin/users/del/'.$u->id) ?>" class="btn btn-danger">Smazat</a>
                            <a href="<?= base_url('/admin/users/edit/'.$u->id) ?>" class="btn btn-primary">Upravit</a>
                        </td>
                        
                        
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>
                            <a class="btn btn-primary" href="<?= base_url('/admin/register') ?>">Nový uživatel</a>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

<?= $this->endSection(); ?>
