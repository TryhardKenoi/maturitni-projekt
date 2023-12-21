<!DOCTYPE html>
<html lang='cs'>

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


<body class="hold-transition register-page">
  <div class="register-box">
    <div class="card card-outline card-secondary">
      <div class="card-header text-center">
        <a href="<?= base_url('/'); ?>" class="h1"><b>Event</b>Fusion</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Vytvoření skupiny</p>
        <form action="<?= base_url('/auth/create_group') ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" name="group_name" id="group_name" class="form-control" placeholder="Název skupiny">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="description" id="description" placeholder="Popisek">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
            <div class="">
              <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block">Vytvořit skupinu</button>
            </div>
          </div>
        </form>
        <div class="social-auth-links text-center">
        </div>



    </div>
  </div>


  <script src="../../plugins/jquery/jquery.min.js"></script>

  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="../../dist/js/adminlte.min.js?v=3.2.0"></script>
</body>

</html>
