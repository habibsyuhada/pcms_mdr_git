<div class="wrapper" style="min-height: 79vh">
<nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
  <ul class="list-unstyled components">
    <?php if($this->permission_eng_act[35] == '1'): ?>
    <li>
      <a href="#mdr_sidebar_design" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-file-alt"></i> &nbsp; MDR
      </a>
      <ul class="collapse show list-unstyled" id="mdr_sidebar_design">
        <li>
          <a href="<?php echo base_url();?>production/mdr_dc_list">
            <i class="fas fa-folder-open"></i> &nbsp; MDR List
          </a>
        </li>
        <?php if($this->permission_eng_act[36] == '1'): ?>
        <li>
          <a href="<?php echo base_url();?>production/mdr_dc_new">
            <i class="fas fa-plus"></i> &nbsp; Add MDR
          </a>
        </li>
        <li>
          <a href="<?php echo base_url();?>production/mdr_dc_list_import">
            <i class="fas fa-file-import"></i> &nbsp; Import MDR
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </li>
    <?php endif; ?>

  </ul>
</nav>