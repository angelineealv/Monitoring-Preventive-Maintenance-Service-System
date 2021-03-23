<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>PO CABANG | <?= @$page_heading ?></title>
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
  <link rel="stylesheet" href="<?= base_url("assets/css/training_hyperdat.css") ?>">
  <link rel="stylesheet" href="<?= base_url("assets/css/fonts.min.css") ?>">
</head>

<body>

  <div class="wrapper">
    <?php
    //header
    $this->load->view("template/inc/_header");
    //Sidebar
    $this->load->view("template/inc/_sidebar");
    ?>

    <div class="main-panel">
      <div class="content">
        <div class="page-inner">
          <div class="page-header">
            <h4 class="page-title"><?= @$page_heading ?></h4>
          </div>
          <div class="row">
            <div class="col-md-12">
              <?= $_content ?>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <div class="copyright ml-auto">
            <?= date("Y") ?> | <a href="<?= base_url("transaksi") ?>">PO CABANG</a>
          </div>
        </div>
      </footer>
    </div>
  </div>
</body>

<script src="<?= base_url("assets/js/core/jquery.3.2.1.min.js") ?>"></script>
<script src="<?= base_url("assets/js/core/popper.min.js") ?>"></script>
<script src="<?= base_url("assets/js/core/bootstrap.min.js") ?>"></script>

</html>