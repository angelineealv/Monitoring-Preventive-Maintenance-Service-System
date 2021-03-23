<div class="main-header">
  <div class="logo-header" data-background-color="light-blue2">
    <a href="<?= base_url("home") ?>" class="logo">
      <span class="text-logo">Hyperdata</span>
    </a>
    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">
        <i class="icon-menu"></i>
      </span>
    </button>
    <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
    <div class="nav-toggle">
      <button class="btn btn-toggle toggle-sidebar">
        <i class="icon-menu"></i>
      </button>
    </div>
  </div>
  <!-- End Logo Header -->

  <!-- Navbar Header -->
  <nav class="navbar navbar-header navbar-expand-lg" data-background-color="light-blue2">

    <div class="container-fluid">
      <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
        <li class="nav-item">
          <span class="badge badge-info">Selamat Datang <?= $this->session->userdata("username") ?></span>
        </li>
        <?php if (session_value("levelid") == 5) { ?>
          <li class="nav-item dropdown hidden-caret">
            <a class="nav-link dropdown-toggle" href="<?= base_url("transaksi/cart") ?>">
              <i class="fas fa-shopping-cart"></i>
              <span class="notification"><?php echo count($this->T_Trcart->count_cart($this->session->userdata("userid"))->result_array()); ?></span>
            </a>
          </li>
        <?php } ?>
        <li class="nav-item dropdown hidden-caret">
          <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
            <div class="avatar-sm">
              <img src="<?= base_url("assets/img/user-small.png") ?>" alt="..." class="avatar-img rounded-circle">
            </div>
          </a>
          <ul class="dropdown-menu dropdown-user animated fadeIn">
            <div class="dropdown-user-scroll scrollbar-outer">
              <li>
                <div class="user-box">
                  <div class="avatar-lg"><img src="<?= base_url("assets/img/user-small.png") ?>" alt="image profile" class="avatar-img rounded"></div>
                  <div class="u-text">
                    <h4><?= $this->session->userdata("fullname") ?></h4>
                    <p class="text-muted">@<?= $this->session->userdata("username") ?></p>
                  </div>
                </div>
              </li>
              <li>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url("logout") ?>">Logout</a>
              </li>
            </div>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <!-- End Navbar -->
</div>