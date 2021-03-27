<div id="content" class="container-fluid">
  <form method="POST" action="<?php echo base_url();?>mockup/activity_list">
    <div class="row">

      <div class="col-md-12">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
          <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
            <div class="container-fluid">

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Document Number</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="drawing_no" placeholder="Document Number">                
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Drawing Number</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="drawing_no" placeholder="Drawing Number">                
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Drawing Type</label>
                <div class="col-sm-10">
                  <select class="custom-select" name="module">
                    <option value="GA">GA</option>
                    <option value="AS">AS</option>
                    <option value="SP">SP</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Project</label>
                <div class="col-sm-10">
                  <select class="custom-select" name="module">
                    <option value="Structure">Tangguh Pack B</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Discipline</label>
                <div class="col-sm-10">
                  <select class="custom-select" name="module">
                    <option value="Structure">Structure</option>
                    <option value="Piping">Piping</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Module</label>
                <div class="col-sm-10">
                  <select class="custom-select" name="module">
                    <option value="PRK-31009  ">PRK-31009 </option>
                  </select>
                </div>
              </div>

            </div>
          </div>
          <div class="text-right mt-3">
            <button type="submit" name='submit' id='submitBtn'  value='submit' class="btn btn-success " title="Submit"><i class="fa fa-check"></i> Submit</button>
            <a href="<?php echo base_url();?>engineering/draw_list" class="btn btn-secondary " title="Submit"><i class="fa fa-close"></i> Cancel</a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script type="text/javascript">
  
  $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    orientation: "bottom auto",
    autoclose: true,
    todayHighlight: true
  });

  var delayTimer;
  function drawing_no_check(input) {
    text = $(input).val();
    console.log(text);
    clearTimeout(delayTimer);
    delayTimer = setTimeout(function() {
      // Do the ajax stuff
      $.ajax({
        url: "<?php echo base_url();?>engineering/drawing_no_check/",
        type: "post",
        data: {
          drawing_no: text
        },
        success: function(data) {
          if(data != 0){
            $(input).addClass('is-invalid');
            $('.invalid-feedback').remove( ":contains('Duplicate Drawing Number')" );
            $(input).after('<div class="invalid-feedback">Duplicate Drawing Number.</div>');
            $('button[name=submit]').prop("disabled", true);
          }
          else{
            $('.invalid-feedback').remove( ":contains('Duplicate Drawing Number')" );
            $(input).removeClass('is-invalid');
            $(input).addClass('is-valid');
          }
          if (!$('.is-invalid').length) {
            $('button[name=submit]').prop("disabled", false);
          }
        }
      });
    }, 1500); // Will do the ajax stuff after 1000 ms, or 1 s
  }
</script>