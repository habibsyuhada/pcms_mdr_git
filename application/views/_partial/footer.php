    <footer class="container-fluid bg-white py-2">
      <div class="row">
        <div class="col-12 col-md">
          <center><small class="d-block my-1 text-muted">&copy; 2019 - PT. SMOE - PRODUCTION CONTROL MANAGEMENT SYSTEM </small></center>
        </div>
      </div>
    </footer>
    
    <?php $this->load->view('_partial/websocket');?>

    <script type="text/javascript">
      $('#dataTable').DataTable( {
         drawCallback: function () {
           console.log( 'Table redrawn '+new Date() );
         }
      } );

      $('.dataTable_v1').DataTable( {
        "paging": false,
        "order": []
      } );

      $('.select2').select2({
        theme: 'bootstrap'
      });

      $(".overflow-auto").floatingScroll();

      $('.custom-file-input').on('change', function() {
        $(this).parent().find('.custom-file-label').html($(this).val().replace(/C:\\fakepath\\/i, ''));
      });

      var delayTimer_sidebarCollapse;
    	function sidebarCollapse(){
        $('#sidebar').toggleClass('active');
        clearTimeout(delayTimer_sidebarCollapse);
        delayTimer_sidebarCollapse = setTimeout(function() {
          $.ajax({            
            url: "<?php echo base_url();?>home/sidebarCollapse/",
          });
        }, 500);
    	}

      <?php if($this->session->flashdata('success') == TRUE): ?>
      Swal.fire({
        title: 'Success!',
        type: 'success',
        text: '<?php echo $this->session->flashdata('success'); ?>',
        timer: 1000
      })
      <?php endif; ?>
      <?php if($this->session->flashdata('error') == TRUE): ?>
      Swal.fire(
        'Error!',
        '<?php echo $this->session->flashdata('error'); ?>',
        'error'
      )
      <?php endif; ?>
      $('form').attr('autocomplete', 'off');
      $('#sidebar').on('show.bs.collapse','.collapse', function() {
        $('#sidebar').find('.collapse.show').collapse('hide');
      });

      function sweetalert(type, text) {
        if(type == 'success'){
          Swal.fire({
            title: 'Success!',
            type: 'success',
            text: text,
            timer: 1000
          })
        }
        else if(type == 'error'){
          Swal.fire(
            'Error!',
            text,
            'error'
          )
        }
        else if(type == 'loading'){
          Swal.fire({
            title: text,
            onBeforeOpen () {
              Swal.showLoading ()
            },
            onAfterClose () {
              Swal.hideLoading()
            },
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
          });
        }
      }
    </script>

  </body>
</html>