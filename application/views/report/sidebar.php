<div class="wrapper" style="min-height: 79vh">
<nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
  <ul class="list-unstyled components">
    <li>
      <a href="<?php echo base_url();?>report/monthly_report">
      <i class="fas fa-moon"></i>  &nbsp; Activity Monthly Report
      </a>
    </li>
    <li>
      <a href="<?php echo base_url();?>report/template_report">
      <i class="fas fa-moon"></i>  &nbsp; Template PCMS Summary Report
      </a>
    </li>
    <li>
      <a href="<?php echo base_url();?>report/master_mdr_report">
      <i class="fas fa-moon"></i>  &nbsp; Master MDR Report
      </a>
    </li>
  </ul>
</nav>