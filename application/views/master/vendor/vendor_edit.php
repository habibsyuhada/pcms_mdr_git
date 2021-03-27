<?php
  $dt   = $dt_list[0];
?>
<div id="content" class="container-fluid">
  <form method="POST" action="<?php echo base_url();?>m_vendor/vendor_edit_process">
    <div class="row">

      <div class="col-md-12">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
          <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
            <div class="container-fluid">

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Code</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" oninput="company_code_check(this);" name="company_code" placeholder="Code Vendor" value="<?php echo $dt['company_code'] ?>">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" oninput="company_name_check(this);" name="company_name" placeholder="Description Vendor" value="<?php echo $dt['company_name'] ?>">
                </div>
              </div>

            </div>
          </div>
          <div class="text-right mt-3">
            <input type="hidden" name="id_company" value="<?php echo $dt['id_company'] ?>">
            <button type="submit" name='submit' id='submitBtn'  value='submit' class="btn btn-success " title="Submit"><i class="fa fa-check"></i> Submit</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script type="text/javascript">
  var delayTimer;
  function company_code_check(input) {
    text = $(input).val();
    if(text == ''){
      return false;
    }
    clearTimeout(delayTimer);
    delayTimer = setTimeout(function() {
      // Do the ajax stuff
      $.ajax({
        url: "<?php echo base_url();?>m_vendor/company_code_check/",
        type: "post",
        data: {
          company_code: text
        },
        success: function(data) {
          if(data != 0){
            $(input).addClass('is-invalid');
            $('.invalid-feedback').remove( ":contains('Duplicate Code Vendor')" );
            $(input).after('<div class="invalid-feedback">Duplicate Code Vendor.</div>');
            $('button[name=submit]').prop("disabled", true);
          }
          else{
            $('.invalid-feedback').remove( ":contains('Duplicate Code Vendor')" );
            $(input).removeClass('is-invalid');
            $(input).addClass('is-valid');
          }
          if (!$('.is-invalid').length) {
            $('button[name=submit]').prop("disabled", false);
          }
        }
      });
    }, 500); // Will do the ajax stuff after 1000 ms, or 1 s
  }

  function company_name_check(input) {
    text = $(input).val();
    if(text == ''){
      return false;
    }
    clearTimeout(delayTimer);
    delayTimer = setTimeout(function() {
      // Do the ajax stuff
      $.ajax({
        url: "<?php echo base_url();?>m_vendor/company_name_check/",
        type: "post",
        data: {
          company_name: text
        },
        success: function(data) {
          if(data != 0){
            $(input).addClass('is-invalid');
            $('.invalid-feedback').remove( ":contains('Duplicate Description Vendor')" );
            $(input).after('<div class="invalid-feedback">Duplicate Description Vendor.</div>');
            $('button[name=submit]').prop("disabled", true);
          }
          else{
            $('.invalid-feedback').remove( ":contains('Duplicate Description Vendor')" );
            $(input).removeClass('is-invalid');
            $(input).addClass('is-valid');
          }
          if (!$('.is-invalid').length) {
            $('button[name=submit]').prop("disabled", false);
          }
        }
      });
    }, 500); // Will do the ajax stuff after 1000 ms, or 1 s
  }
</script>