<div id="content" class="container-fluid">
  <form method="POST" action="<?php echo base_url();?>report/master_mdr_report_excel">
    <div class="row">

      <div class="col-md-12">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
          <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
            <a href="<?php echo base_url() ?>report/master_mdr_report_excel" class="btn btn-success">SMOP MDR Report</a>&nbsp;
            <a href="<?php echo base_url() ?>report/overall_mdr_report_excel" class="btn btn-success">Overall MDR Report</a>&nbsp;
            <a href="<?php echo base_url() ?>report/overall_mdr_report_compress_excel" class="btn btn-success">Overall MDR Report (Compressed)</a>
          </div>
          <!-- <div class="text-right mt-3">
            <button type="submit" name='submit' id='submitBtn'  value='submit' class="btn btn-success " title="Submit"><i class="fa fa-check"></i> Submit</button>
          </div> -->
        </div>
      </div>
    </div>
  </form>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->
<script>
  modulexprojectx();
  function modulexprojectx() {
    if($('#projectx').val() ==''){
      $('#modulex').prop('disabled', true);
    }
    else{
      $('#modulex').prop('disabled', false);
    }
  }
</script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.chained.min.js"></script>
<script>
    $("#modulex").chained("#projectx"); // disini kita hubungkan kota dengan provinsi
</script>