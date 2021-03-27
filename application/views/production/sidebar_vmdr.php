<div class="wrapper" style="min-height: 79vh">
<nav id="sidebar" class="<?php echo (($this->input->cookie('sidebarCollapse') !== NULL && $this->input->cookie('sidebarCollapse') == 1) ? 'active' : '') ?>">
  <ul class="list-unstyled components">
    <?php if($this->permission_eng_act[35] == '1'): ?>
    <li>
      <a href="#vendor_pack_sidebar_design" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-file-alt"></i> &nbsp; Vendor Package
      </a>
      <ul class="collapse show list-unstyled" id="vendor_pack_sidebar_design">
        <li>
          <a href="<?php echo base_url();?>production/vendor_pack_dc_list">
            <i class="fas fa-folder-open"></i> &nbsp; Vendor Package List
          </a>
        </li>
        <?php if($this->permission_eng_act[36] == '1'): ?>
        <li>
          <a href="<?php echo base_url();?>production/vendor_pack_dc_new">
            <i class="fas fa-plus"></i> &nbsp; Add Vendor Package
          </a>
        </li>
        <li>
          <a href="<?php echo base_url();?>production/vendor_pack_dc_list_import">
            <i class="fas fa-file-import"></i> &nbsp; Import Vendor Package
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </li>
    <li>
      <a href="#master_vendor_sidebar" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <i class="fas fa-file-alt"></i> &nbsp; Vendor Master Data
      </a>
      <ul class="collapse show list-unstyled" id="master_vendor_sidebar">
        <li>
          <a href="<?php echo base_url();?>m_vendor/vendor_list">
            <i class="fas fa-folder-open"></i> &nbsp; Vendor List
          </a>
        </li>
        <?php if($this->permission_eng_act[36] == '1'): ?>
        <li>
          <a href="<?php echo base_url();?>m_vendor/vendor_new">
            <i class="fas fa-plus"></i> &nbsp; Add New Vendor
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </li>
    <?php endif; ?>

  </ul>
</nav>