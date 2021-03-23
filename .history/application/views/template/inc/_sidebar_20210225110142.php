<div class="sidebar sidebar-style-2">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-primary">
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Main Navigation</h4>
        </li>
        <?php
        $id = session_value("levelid");
        $cekmenu = $this->M_Mnsidebar->sidebarmenu($id)->result_array();
        foreach ($cekmenu as $menu) {
          $sub = $this->M_Mnsidebar->sidebar_submenu($id, $menu['menuid'])->result_array();

          if (count($sub) > 0) {
            echo "<li class='nav-item nav-drop'>
                                    <a data-toggle='collapse' class='sub-drop' href='#menu" . $menu["menuid"] . "'>
                                        <i class='fas fa-layer-group'></i>
                                        <p>" . $menu["menuname"] . "</p>
                                        <span class='caret'></span>
                                    </a>";

            echo "<div class='collapse' id='menu" . $menu["menuid"] . "'>
                                        <ul class='nav nav-collapse'>";
            foreach ($sub as $sub) {
              echo "<li><a href='" . base_url("$sub[linkaddress]") . "'>
                                                <span class='sub-item'>" . $sub["menuname"] . "</span>
                                                </a></li>";
            }
            echo "</ul>
                                </div>
                            </li>";
          } else { ?>
            <li class="nav-item">
              <a href="<?= base_url("$menu[linkaddress]") ?>">
                <i class="fas fa-layer-group"></i>
                <p><?= $menu['menuname'] ?></p>
              </a>
            </li>
        <?php }
        }
        ?>
        <li class="nav-item">
          <a href="<?= base_url("logout") ?>">
            <i class="fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>