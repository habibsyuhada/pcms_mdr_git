<style type="text/css">
  #topbar-mobile{
    display: none;
  }
  @media (max-width: 767px) {
    #topbar-mobile{
      display: block;
    }
    #topbar-desktop{
      display: none;
    }
  }
  body, .form-control, .custom-select, .btn{
    font-size: 0.9rem
  }
</style>
<body style="background-color: whitesmoke;">
  <div class="bg-white">
    <div class="container-fluid">
      <div class="row py-3 align-items-center">
        <div class="col-md">
          <img src="<?php echo base_url();?>img/logo.png" width="225">
           
        </div>     
        <div class="col-md text-right">
           <button type="button" class="btn btn-primary text-white">
            <i class="fa fa-user"></i> &nbsp; <?php echo @$this->user_cookie[1]; ?>
          </button>
          <a href='<?php echo $this->user_cookie[9]; ?>'>  
          <button type="button" class="btn btn-flat bg-danger text-white">
            <i class="fa fa-sign-out"></i> Portal
          </button>
        </a>
        </div>
      </div>
    </div>
  </div>
  
  <nav class="sticky-top py-1 bg-green-smoe container-fluid">
    
      <div class="row align-items-center" id="topbar-mobile">
      </div>

      <div class="row align-items-center" id="topbar-desktop">
        <div class="col-xl">
          <div class="row">
            <div class="col-md-auto d-flex justify-content-between">
              <div class="btn-group">
                <button type="button" class="btn btn-flat btn-green-smoe text-white" onClick="sidebarCollapse();" <?php echo (isset($sidebar) ? '' : 'disabled'); ?>>
                  <i class="fas fa-align-justify"></i>
                </button>
              </div>
            </div>
            <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">
                <a href="<?php echo base_url();?>home/home" class="btn btn-flat btn-green-smoe text-white">
                  <i class="fas fa-home"></i> &nbsp;Home
                </a>
              </div>
            </div>

            <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">
                <a href="<?php echo base_url();?>production/mdr_dc_list" class="btn btn-flat btn-green-smoe text-white">
                  <i class="fas fa-industry"></i> &nbsp;MDR
                </a>
              </div>
            </div>

            <div class="col-md-auto text-center topbar-menu">
              <div class="btn-group">
                <a href="<?php echo base_url();?>production/vendor_pack_dc_list" class="btn btn-flat btn-green-smoe text-white">
                  <i class="fas fa-industry"></i> &nbsp;VMDR
                </a>
              </div>
            </div>
            
          </div>
        </div>
        <div class="col-xl-auto text-center">
          <div class="btn-group">
            <button type="button" class="btn btn-flat btn-green-smoe text-white">
              <span class="text-white"><?php echo date("l, d F Y"); ?></span>
            </button>
          </div>
        </div> 
      </div>
    

  </nav>
<style>
  .border-mobile{
    border-bottom: 1px solid #dee2e6 
  }
  #topmenu .col-md-auto:nth-child(1) .border-mobile{
    border-top: 1px solid #dee2e6 
  }
</style>
<script>
  var topbarmenu = '<div class="col-xl">' +
          '<div class="row">' +
            '<div class="col-md-auto d-flex justify-content-between">' +
              '<div class="btn-group">' +
                '<button type="button" class="btn btn-flat btn-dark text-white" onClick="sidebarCollapse();" <?php echo (isset($sidebar) ? '' : 'disabled'); ?>>' +
                  '<i class="fas fa-align-justify"></i>' +
                '</button>' +
              '</div>' +
              '<div id="idbtncol" class="btn-group">' +
                '<button type="button" class="btn btn-flat btn-light text-black" data-toggle="collapse" data-target="#topmenu">' +
                  '<i class="fas fa-align-justify"></i>' +
                '</button>' +
              '</div>' +
            '</div>            ' +
          '</div>' +
          '<div class="row collapse mt-3" id="topmenu">';
  $(".topbar-menu").each(function() {  
    var menu_html = $(this).find('.btn-group').html();
    topbarmenu += '<div class="col-md-auto">' +
                    '<div class="btn-group w-100 border-mobile text-left">'+
                    menu_html +
                    '</div>'+
                  '</div>';
  });
  topbarmenu += '<div class="col-md-auto text-center">' +
              '<div class="btn-group mt-3">' +
                '<button type="button" class="btn btn-flat btn-green-smoe text-white">' +
                  '<span class="text-white"><?php echo date("l, d F Y"); ?></span>' +
                '</button>' +
              '</div>' +
            '</div> ' +

          '</div>' +
        '</div> ';
  $("#topbar-mobile").html(topbarmenu);
  $("#topmenu a").each(function() {
    $(this).addClass("text-left");
  })
</script>