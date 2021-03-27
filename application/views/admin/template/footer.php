    <script>
	    $(function () {
	      $('.dataTable').DataTable({
	        //"lengthChange": false,
	        //"order": [[ 9, "desc" ],[ 5, "desc" ], [ 6, "desc" ], [ 3, "desc" ], [ 1, "desc" ]]
	      });

	      $('.dataTable_mr_list').DataTable({
	        //"lengthChange": false,
	        //"order": [[ 5, "desc" ], [ 6, "desc" ], [ 3, "desc" ], [ 1, "desc" ]]
	      });

	      $(".search_name_badge").autocomplete({
           source: "<?php echo base_url(); ?>emr/search_name_badge",
           autoFocus: true,
           classes: {
               "ui-autocomplete": "highlight"
           }
       });

	      <?php if($this->session->flashdata('notif') == TRUE): ?>
	      Swal.fire(
	        '<?php echo $this->session->flashdata('notif'); ?>',
	        'Your data has been <?php echo $this->session->flashdata('notif'); ?>',
	        'success'
	      )
	      <?php endif; ?>
	      <?php if($this->session->flashdata('error') == TRUE): ?>
	      Swal.fire(
	        'Error!',
	        '<?php echo $this->session->flashdata('error'); ?>',
	        'error'
	      )
	      <?php endif; ?>

	      $("form").submit(function(e){
			    $('#loading').modal({
			    	show: true,
	          backdrop: 'static',
	          keyboard: false
			    });
				});
	    });

	    function delete_req_list(request_no){
	      Swal.fire({
	        title: 'Are you sure?',
	        text: "You won't be able to revert this!",
	        type: 'warning',
	        showCancelButton: true,
	        confirmButtonColor: '#3085d6',
	        cancelButtonColor: '#d33',
	        confirmButtonText: 'Yes, delete it!'
	      }).then((result) => {
	        if (result.value) {
	          window.location = '<?php echo base_url();?>emr/req_del_process/'+request_no;
	        }
	      })
	    }
	   
	    function approve_req_list(request_no, field,cat_field){
	      Swal.fire({
	        title: 'Are you sure to <b class="text-success">&nbsp;Approve&nbsp;</b> this?',
	        text: "You won't be able to revert this!",
	        type: 'warning',
	        showCancelButton: true,
	        confirmButtonColor: '#3085d6',
	        cancelButtonColor: '#d33',
	        confirmButtonText: 'Yes, Approve it!'
	      }).then((result) => {
	        if (result.value) {
	          window.location = '<?php echo base_url();?>emr/req_approve_process/'+request_no+'/'+field+'/'+cat_field;
	        }
	      })
	    }

	    async function reject_req_list(request_no){
	      const {value: text} = await Swal.fire({
				  input: 'textarea',
				  inputPlaceholder: 'Type your message here...',
				  showCancelButton: true,
				  inputValidator: (value) => {
				    if (!value) {
				      return 'You need to write something!'
				    }
				  }
				});
				if(text){
					Swal.fire({
		        title: 'Are you sure to <b class="text-danger">&nbsp;Reject&nbsp;</b> this?',
		        text: "You won't be able to revert this!",
		        type: 'warning',
		        showCancelButton: true,
		        confirmButtonColor: '#3085d6',
		        cancelButtonColor: '#d33',
		        confirmButtonText: 'Yes, Reject it!'
		      }).then((result) => {
		        if (result.value) {
		        	$.ajax({
				        url: "<?php echo base_url();?>emr/add_reason_reject/"+request_no,
				        type: "post",
				        data: {
				        	reason: text
				        },
				        success: function(data) {
				        	console.log(text);
				        	window.location = '<?php echo base_url();?>emr/req_reject_process/'+request_no;
				        }
					    });
		        }
		      });
				}
	      
	    }

	    function addmaterial(){
	    	$('input[name=m_description]').val() == '' ? $('input[name=m_description]').addClass("is-invalid") : $('input[name=m_description]').removeClass("is-invalid");
	    	$('textarea[name=m_reason]').val() == '' ? $('textarea[name=m_reason]').addClass("is-invalid") : $('textarea[name=m_reason]').removeClass("is-invalid");
	    	$('input[name=m_qty]').val() == '0' ? $('input[name=m_qty]').addClass("is-invalid") : $('input[name=m_qty]').removeClass("is-invalid");
	    	$('input[name=m_expected_cost]').val() == '0' ? $('input[name=m_expected_cost]').addClass("is-invalid") : $('input[name=m_expected_cost]').removeClass("is-invalid");
	    	// $('input[name=m_ros]').val() == '' ? $('input[name=m_ros]').addClass("is-invalid") : $('input[name=m_ros]').removeClass("is-invalid");

	    	if ($('.is-invalid').length) {
	    		return;
	    	}

	    	$.ajax({
	        url: "<?php echo base_url();?>emr/add_material_temp",
	        type: "post",
	        data: {
	        	m_description: $('input[name=m_description]').val(),
	        	m_size: $('input[name=m_size]').val(),
	        	m_uom: $('select[name=m_uom]').val(),
	        	m_qty: $('input[name=m_qty]').val(),
	        	m_currency_symbol: $('select[name=m_currency_symbol]').val(),
	        	m_expected_cost: $('input[name=m_expected_cost]').val(),
	        	m_ros: $('input[name=m_ros]').val(),
	        	m_reason: $('textarea[name=m_reason]').val(),
	        	m_remark: $('textarea[name=m_remark]').val()
	        },
	        success: function(data) {
	        	location.reload();
						// $("#t_material tbody").prepend(data);
						// $('#add_material').modal('toggle');
	        }
		    });
		  }

		  function delmaterial(btn, index, cat_mr) {
		  	$.ajax({
	        url: "<?php echo base_url();?>emr/del_material_temp/"+index+"/"+cat_mr,
	        success: function(data) {
	        	location.reload(cat_mr);
		    		// $(btn).parents("tr").remove();
	        }
		    });
		  }

		  function resetmaterial(form_action, category){
	      Swal.fire({
	        title: 'Are you sure to reset material request list?',
	        text: "You won't be able to revert this!",
	        type: 'warning',
	        showCancelButton: true,
	        confirmButtonColor: '#3085d6',
	        cancelButtonColor: '#d33',
	        confirmButtonText: 'Yes, delete it!'
	      }).then((result) => {
	        if (result.value) {
	          window.location = '<?php echo base_url();?>emr/reset_material_temp/'+form_action+'/'+category;
	        }
	      })
	    }

		  function uplatc(index) {
		    $('input[name=file_index]').val(index);
		    $('#upl_atc').modal('toggle');
		  }

		  function set_session_emr_data(name, input) {
		    
		    var data_val = $(input).val();
		    //console.log(data_val);

		    $.ajax({
	        	url: "<?php echo base_url();?>emr/set_session_emr_data/"+name+"/"+data_val,
		    });

		    if(name == 'id_cost'){
	
		    		var data_cat = $(input).find(':selected').data('cat');
		    		$('input[name=cost_cat]').val(data_cat);
		    				    	
			    	$.ajax({
		        		url: "<?php echo base_url();?>emr/set_session_emr_data/cost_cat/"+data_cat,
			    	});
		    }

		  }

	  </script>
    <footer class="container py-2">
      <div class="row">
        <div class="col-12 col-md">
          <center><small class="d-block mb-3 text-muted">&copy; 2019 - PT. SMOE - MATERIAL REQUEST</small></center>
        </div>
      </div>
    </footer>
  </body>
</html>