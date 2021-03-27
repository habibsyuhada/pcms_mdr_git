	<body style="background-color: whitesmoke">
    <div class="bg-white">
      <div class="container-fluid">
        <div class="row py-3 align-items-center">
          <div class="col-md">
            <img src="<?php echo base_url();?>img/logo.png" width="225">
          </div>
          <div class="col-md text-right">
             <button type="button" class="btn btn-primary text-white">
              <i class="fa fa-user"></i> &nbsp;<?php echo $read_cookies[1]; ?>
            </button>
            <a href='<?php echo $read_cookies[9]; ?>'>  
            <button type="button" class="btn btn-flat bg-danger text-white">
              <i class="fa fa-sign-out"></i> Portal
            </button>
          </a>
          </div>
        </div>
      </div>
    </div>
    
    <nav class="sticky-top py-1 bg-green-smoe">

       <div class="row align-items-center">
            <div class="col-md">
        
                <div class="btn-group">
                    <a href="<?php echo base_url();?>home/home" class="btn btn-flat btn-green-smoe text-white">
                      <i class="fa fa-home"></i> &nbsp;Dashboard
                    </a>
                </div>

                <div class="btn-group">

                  <button type="button" class="btn dropdown-toggle" style="background-color:#008060;color:white;" data-toggle="dropdown">
                  <i class="fa fa-dropbox"></i> &nbsp; Material Request List
                  </button>
                   <div class="dropdown-menu" >
                     <?php if($read_permission[0] == '1'){ ?>
                    <a class="dropdown-item submenu"  href="<?php echo base_url();?>emr/req_new" class="btn btn-flat text-white">
                      <i class="fa fa-angle-right"></i> &nbsp;New Request
                    </a>
                    <?php 
                      $id_user        = $read_cookies[0];
                      $CI =& get_instance();
                      $CI->load->model('home_mod');
                      $hasil          = $CI->home_mod->check_userDraft($id_user);
                      $total_data     = $hasil->num_rows();
                    ?>
                    <a class="dropdown-item submenu"  href="<?php echo base_url();?>emr/req_list_apr_reject/Draft" class="btn btn-flat text-white">
                      <i class="fa fa-angle-right"></i> &nbsp;Draft <span style='color:red;font-weight: bold;'> ( <?php echo $total_data; ?> ) </span>
                    </a>
                    <?php } ?>
                    <?php if($read_permission[5] == '1'){ ?>
                    <a class="dropdown-item submenu"  href="<?php echo base_url();?>emr/req_list" class="btn btn-flat text-white">
                      <i class="fa fa-angle-right"></i> &nbsp;Pending
                    </a>
                    <?php } ?>
                     <a class="dropdown-item submenu"  href="<?php echo base_url();?>emr/req_list_apr_reject/In-Progress" class="btn btn-flat text-white">
                      <i class="fa fa-angle-right"></i> &nbsp;In-Progress
                    </a>
                    <a class="dropdown-item submenu"  href="<?php echo base_url();?>emr/req_list_apr_reject/Approved" class="btn btn-flat text-white">
                      <i class="fa fa-angle-right"></i> &nbsp;Approved
                    </a>
                     <a class="dropdown-item submenu"  href="<?php echo base_url();?>emr/req_list_apr_reject/Rejected" class="btn btn-flat text-white">
                      <i class="fa fa-angle-right"></i> &nbsp;Rejected
                    </a>
                    <a class="dropdown-item submenu"  href="<?php echo base_url();?>emr/req_list_apr_reject/Completed" class="btn btn-flat text-white">
                      <i class="fa fa-angle-right"></i> &nbsp;Completed
                    </a>
                    
                     </div>
                </div>

                <div class="btn-group">
                    <a href="<?php echo base_url();?>emr/report" class="btn btn-flat btn-green-smoe text-white">
                      <i class="fa fa-file"></i> &nbsp;Status Report
                    </a>
                </div>

            </div>
            <div class="col-md text-right">
              <div class="btn-group">
                    <button type="button" class="btn" style="background-color:#008060;color:white;" data-toggle="dropdown">
                    <?php echo date("l, d F Y"); ?>
                    </button>
                </div>
                <div class="btn-group">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div> 
        </div>
      

    </nav>

  <!-- <body style="background-color: whitesmoke">
    <div class="bg-white">
      <div class="container-fluid">
        <div class="row py-3 align-items-center">
          <div class="col-md">
            <img src="<?php echo base_url();?>img/logo.png" width="225">
          </div>
          <div class="col-md text-right">
            <h1>E-MR Application</h1>
          </div>
        </div>
      </div>
    </div>
    
    <nav class="sticky-top py-1 bg-green-smoe">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md">
            <div class="btn-group">
              <a href="<?php echo base_url();?>emr/req_list" class="btn btn-flat btn-green-smoe text-white">
                <i class="fa fa-list"></i> Request List
              </a>
            </div>
          </div>
          <div class="col-md text-right">
            <div class="btn-group">
              <button type="button" class="btn btn-flat btn-green-smoe text-white">
                <i class="fa fa-user"></i> Profile
              </button>
            </div>
            <div class="btn-group">
              <button type="button" class="btn btn-flat bg-danger text-white">
                <i class="fa fa-sign-out"></i> Portal
              </button>
            </div>
          </div>
        </div>
      </div>
    </nav> -->