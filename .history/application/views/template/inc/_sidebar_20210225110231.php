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
        <li class='nav-item nav-drop'>
          <a data-toggle='collapse' class='sub-drop' href='#menu" . $menu["menuid"] . "'>
            <i class='fas fa-layer-group'></i>
            <p>" . $menu["menuname"] . "</p>
            <span class='caret'></span>
          </a>
        </li>
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