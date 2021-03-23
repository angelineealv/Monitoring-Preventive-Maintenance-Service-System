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
</head>

<body class="login">
  <div class="wrapper wrapper-login">
    <div class="container container-login animated fadeIn content-log" style='padding: 100px; display: block; width: 500px;'>
      <h3 class="text-center">Sign In</h3>
      <div class="login-form">
        <form method="post" id="form-login" name="form-login">
          <div class="form-group">
            <label for="username" class="placeholder"><b>Username</b></label>
            <input id="username" name="username" type="text" class="form-control" placeholder="Input Username" required>
          </div>
          <div class="form-group">
            <label for="password" class="placeholder"><b>Password</b></label>
            <div class="position-relative">
              <input id="password" name="password" type="password" class="form-control" placeholder="Input Password" required>
              <!-- <div class="show-password">
                <i class="icon-eye"></i>
              </div> -->
            </div>
          </div>
          <div class="form-group form-action-d-flex mb-3">
            <button type="submit" name="submit" class="btn btn-primary col-md-12 fw-bold"><i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Sign In</button>
          </div>
        </form>
        <div class="login-account text-center">
          <span class="msg">Training | <?= date("Y") ?></span>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= base_url("assets/js/core/jquery.3.2.1.min.js") ?>"></script>
  <script src="<?= base_url("assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js") ?>"></script>
  <script src="<?= base_url("assets/js/core/bootstrap.min.js") ?>"></script>
  <script src="<?= base_url("assets/js/plugin/sweetalert/sweetalert.min.js") ?>"></script>
  <script src="<?= base_url("assets/js/core/popper.min.js") ?>"></script>
  <script src="<?= base_url("assets/js/atlantis.min.js") ?>"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#form-login').submit(function(e) {
        e.preventDefault();

        var username = $('#username').val();
        var password = $('#password').val();

        $.ajax({
          url: '<?= base_url("login/auth") ?>',
          type: 'post',
          data: {
            username: username,
            password: password
          },
          success: function(resp) {
            if (resp == 1) {

            } else {

            }
          }
        });
      });
    });
  </script>
</body>

</html>