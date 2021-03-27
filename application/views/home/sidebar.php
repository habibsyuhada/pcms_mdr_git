<div class="wrapper" style="min-height: 79vh">
<nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
  <ul class="list-unstyled components">
    <li>
      <a href="#">
        <i class="fas fa-chart-line"></i> Engineering Stat
      </a>
    </li>
    <li>
      <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
        <i class="fas fa-home"></i> Drawing
      </a>
      <ul class="collapse list-unstyled" id="homeSubmenu">
        <li>
          <a href="<?php echo base_url();?>engineering/draw_list"><i class="fas fa-caret-right"></i> Drawing List</a>
        </li>
        <li>
          <a href="<?php echo base_url();?>engineering/draw_new"><i class="fas fa-caret-right"></i> Add New Drawing</a>
        </li>
        <li>
          <a href="<?php echo base_url();?>engineering/draw_import"><i class="fas fa-caret-right"></i> Import Drawing</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
        <i class="fas fa-home"></i> Drawing
      </a>
      <ul class="collapse list-unstyled" id="homeSubmenu2">
        <li>
          <a href="<?php echo base_url();?>engineering/draw_list"><i class="fas fa-caret-right"></i> Drawing List</a>
        </li>
        <li>
          <a href="<?php echo base_url();?>engineering/draw_new"><i class="fas fa-caret-right"></i> Add New Drawing</a>
        </li>
        <li>
          <a href="<?php echo base_url();?>engineering/draw_import"><i class="fas fa-caret-right"></i> Import Drawing</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="#">
        <i class="fas fa-chart-line"></i> MTO
      </a>
    </li>
  </ul>
</nav>