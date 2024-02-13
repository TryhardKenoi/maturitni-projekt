<?= $this->extend('layout/Master') ?>
<?= $this->section('content'); ?>

<div class="text-center pt-3">
  <h1><b>Úpravit uživatele</b></h1>
  <hr>
</div>

<div class="" id="showForm">
    <form class="" id="editForm" action="<?= base_url('profil/zmena-hesla/submit/'. $user->id); ?>" method="post">
    <div class="form-group">
        <label for="end">Stávající heslo</label>
        <input type="password" class="form-control" id="old-password" name="old-password" value="">
      </div> 
      <div class="form-group">
        <label for="end">Nové heslo</label>
        <input type="password" class="form-control" id="password" name="password" value="">
      </div> 
      <div class="form-group">
        <label for="end">Nové heslo znovu</label>
        <input type="password" class="form-control" id="password-again" name="password-again" value="">
      </div>
      <p id="message"></p>
      <button type="submit" id="submitButton" class="btn btn-secondary" name="button">Odeslat</button>
  </form>
</div>

<?= $this->endSection(); ?>