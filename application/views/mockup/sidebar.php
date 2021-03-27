<div class="wrapper" style="min-height: 79vh">
<nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
  <ul class="list-unstyled components">
    
    <li>
      <a href="<?php echo base_url();?>mockup/activity_new">
        <i class="fas fa-plus"></i> &nbsp; Activity New
      </a>
    </li>

    <li>
      <a href="<?php echo base_url();?>mockup/activity_list">
        <i class="fas fa-business-time"></i> &nbsp; Activity List
      </a>
    </li>

  </ul>
</nav>