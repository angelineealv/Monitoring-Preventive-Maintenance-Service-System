<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Login | PO Cabang</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

  <script src="<?= base_url("assets/js/plugin/webfont/webfont.min.js") ?>"></script>
  <script>
    WebFont.load({
      google: {
        "families": ["Lato:300,400,700,900"]
      },
      custom: {
        "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
        urls: ['<?= base_url("assets/css/fonts.min.css") ?>']
      },
      active: function() {
        sessionStorage.fonts = true;
      }
    });
  </script>
  <link rel="stylesheet" href="<?= base_url("assets/css/bootstrap.min.css") ?>">
  <link rel="stylesheet" href="<?= base_url("assets/css/atlantis.css") ?>">
  <link rel="stylesheet" href="<?= base_url("assets/css/pocabang.css") ?>">
  <script src="<?= base_url("assets/js/core/jquery.3.2.1.min.js") ?>"></script>
  <script src="<?= base_url("assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js") ?>"></script>
  <script src="<?= base_url("assets/js/core/popper.min.js") ?>"></script>
  <script src="<?= base_url("assets/js/core/bootstrap.min.js") ?>"></script>
  <script>
    window.setTimeout(function() {
      $("#alert-suc").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 5000);
  </script>
</head>

<body class="login">
  <div class="wrapper wrapper-login">
    <div class="container container-login animated fadeIn content-log">
      <h3 class="text-center">Sign In to PO CABANG</h3>
      <?php if (@$_GET["status"] == "account_inactive") { ?>
        <div class="col-md-12" id="alert-suc">
          <div class="alert alert-warning">
            <strong>Failed!</strong> Akun anda telah di non-aktifkan. <br>Harap Hubungi Admin!
          </div>
        </div>
      <?php } ?>
      <?php if (@$_GET["status"] == "branch_notfound") { ?>
        <div class="col-md-12" id="alert-suc">
          <div class="alert alert-warning">
            <strong>Failed!</strong> Akun Anda Tidak Memiliki Kode Cabang!<br>Harap Hubungi Admininistrator!
          </div>
        </div>
      <?php } ?>
      <?php if (@$_GET["status"] == "login_failed") { ?>
        <div class="col-md-12" id="alert-suc">
          <div class="alert alert-danger">
            <strong>Failed!</strong> Username/Password anda salah! <br>Silahkan coba lagi!
          </div>
        </div>
      <?php } ?>
      <div class="login-form">
        <form action="<?= base_url("login/auth") ?>" method="post">
          <div class="form-group">
            <label for="username" class="placeholder"><b>Username</b></label>
            <input id="username" name="dt[username]" type="text" class="form-control" placeholder="Input Username" required>
          </div>
          <div class="form-group">
            <label for="password" class="placeholder"><b>Password</b></label>
            <div class="position-relative">
              <input id="password" name="dt[password]" type="password" class="form-control" placeholder="Input Password" required>
              <div class="show-password">
                <i class="icon-eye"></i>
              </div>
            </div>
          </div>
          <div class="form-group form-action-d-flex mb-3">
            <button type="submit" name="submit" class="btn btn-primary col-md-12 fw-bold"><i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Sign In</button>
          </div>
        </form>
        <div class="login-account">
          <span class="msg">Training | <?= date("Y") ?></span>
        </div>
      </div>
    </div>

    <div class="container container-signup animated fadeIn">
      <h3 class="text-center">Sign Up</h3>
      <div class="login-form">
        <div class="form-group">
          <label for="fullname" class="placeholder"><b>Fullname</b></label>
          <input id="fullname" name="fullname" type="text" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="email" class="placeholder"><b>Email</b></label>
          <input id="email" name="email" type="email" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="passwordsignin" class="placeholder"><b>Password</b></label>
          <div class="position-relative">
            <input id="passwordsignin" name="passwordsignin" type="password" class="form-control" required>
            <div class="show-password">
              <i class="icon-eye"></i>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="confirmpassword" class="placeholder"><b>Confirm Password</b></label>
          <div class="position-relative">
            <input id="confirmpassword" name="confirmpassword" type="password" class="form-control" required>
            <div class="show-password">
              <i class="icon-eye"></i>
            </div>
          </div>
        </div>
        <div class="row form-sub m-0">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="agree" id="agree">
            <label class="custom-control-label" for="agree">I Agree the terms and conditions.</label>
          </div>
        </div>
        <div class="row form-action">
          <div class="col-md-6">
            <a href="#" id="show-signin" class="btn btn-danger btn-link w-100 fw-bold">Cancel</a>
          </div>
          <div class="col-md-6">
            <a href="#" class="btn btn-primary w-100 fw-bold">Sign Up</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= base_url("assets/js/atlantis.min.js") ?>"></script>
</body>

</html>