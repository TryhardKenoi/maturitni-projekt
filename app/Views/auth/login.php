<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Kenoi's website</title>
  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
  <link type="text/css" rel="stylesheet" href="<?= base_url('assets/bootstrap/css/custom.css'); ?>">
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet'>
  <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
  <meta charset='utf-8' />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
  <script nonce="bc3073cb-09ca-4c53-88a1-e5f5d7fe092e">
    (function(w, d) {
      ! function(j, k, l, m) {
        j[l] = j[l] || {};
        j[l].executed = [];
        j.zaraz = {
          deferred: [],
          listeners: []
        };
        j.zaraz.q = [];
        j.zaraz._f = function(n) {
          return async function() {
            var o = Array.prototype.slice.call(arguments);
            j.zaraz.q.push({
              m: n,
              a: o
            })
          }
        };
        for (const p of ["track", "set", "debug"]) j.zaraz[p] = j.zaraz._f(p);
        j.zaraz.init = () => {
          var q = k.getElementsByTagName(m)[0],
            r = k.createElement(m),
            s = k.getElementsByTagName("title")[0];
          s && (j[l].t = k.getElementsByTagName("title")[0].text);
          j[l].x = Math.random();
          j[l].w = j.screen.width;
          j[l].h = j.screen.height;
          j[l].j = j.innerHeight;
          j[l].e = j.innerWidth;
          j[l].l = j.location.href;
          j[l].r = k.referrer;
          j[l].k = j.screen.colorDepth;
          j[l].n = k.characterSet;
          j[l].o = (new Date).getTimezoneOffset();
          if (j.dataLayer)
            for (const w of Object.entries(Object.entries(dataLayer).reduce(((x, y) => ({
                ...x[1],
                ...y[1]
              })), {}))) zaraz.set(w[0], w[1], {
              scope: "page"
            });
          j[l].q = [];
          for (; j.zaraz.q.length;) {
            const z = j.zaraz.q.shift();
            j[l].q.push(z)
          }
          r.defer = !0;
          for (const A of [localStorage, sessionStorage]) Object.keys(A || {}).filter((C => C.startsWith("_zaraz_"))).forEach((B => {
            try {
              j[l]["z_" + B.slice(7)] = JSON.parse(A.getItem(B))
            } catch {
              j[l]["z_" + B.slice(7)] = A.getItem(B)
            }
          }));
          r.referrerPolicy = "origin";
          r.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(j[l])));
          q.parentNode.insertBefore(r, q)
        };
        ["complete", "interactive"].includes(k.readyState) ? zaraz.init() : j.addEventListener("DOMContentLoaded", zaraz.init)
      }(w, d, "zarazData", "script");
    })(window, document);
  </script>
</head>
</head>

<body class="hold-transition login-page">
  <div class="login-box">

    <div class="card card-outline card-secondary">
      <div class="card-header text-center">
        <a href="<?= base_url('/'); ?>" class="h1"><b>Event</b>Fusion</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg"><?php

                    use Symfony\Contracts\Service\Attribute\Required;

 echo lang('Auth.login_heading'); ?></p>
        <form id="myForm" action="<?= base_url('auth/login'); ?>" method="post">
          <div class="input-group mb-3">
            <div class="d-flex w-100">
              <input type="email" name="identity" id="identity" class="form-control" placeholder="Email" >
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <div class="d-flex w-100">
              <input type="password" name="password" id="password" class="form-control" placeholder="<?= lang('Auth.login_password_label');?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">
                  <?= lang('Auth.login_remember_label'); ?>
                </label>
              </div>
            </div>

            <div class="col-4">
              <button type="submit" id="submit" name="submit" class="btn btn-primary btn-block"><?= lang('Auth.login_submit_btn'); ?></button>
            </div>

          </div>
        </form>
      </div>


      <p class="mb-1 pr-3 pl-3">
        <a href="forgot-password.html"><?php echo lang('Auth.login_forgot_password'); ?></a>
      </p>
      <p class="mb-1 pr-3 pl-3 pb-3">
        <a href="<?= base_url('/auth/register') ?> "><?php echo lang('Auth.no_login_yet'); ?></a>
      </p>
    </div>

  </div>

  </div>


  <script src="<?= base_url('assets/bootstrap/js/jquery.js')?>"></script>
  <script src="<?= base_url('assets/bootstrap/js/jquery.validate.min.js')?>"></script>
  <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js')?>"></script>


  


</body>

</html>
