<nav class="navbar">
    <div class="p-3">
        <h1><b>Event</b>Fusion</h1>
    </div>
    <div class="navbar-links">
        <ul>
            <li><a href="<?= base_url('')?>">Domů</a></li>

          <?php if (\App\Helpers\User::isLoggedIn()): ?>
            <li>
              <a href="<?= base_url('/profil/')?>">
                <?= \App\Helpers\User::user()->email; ?>
              </a>
            </li>
            <li><a href="<?= base_url('/auth/logout')?>">Odhlásit</a></li>
          <?php else: ?>
            <li><a href="<?= base_url('/auth')?>">Přihlášení</a></li>
            <li><a href="<?= base_url('/register')?>">Registrace</a></li>

          <?php endif;?>
        </ul>
</nav>
