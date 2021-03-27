<div id="content" class="container-fluid">
  <form method="POST" action="<?php echo base_url();?>report/template_report_excel">
    <div class="row">

      <div class="col-md-12">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
          <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
            <div class="container-fluid">

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">From Date</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" name="from_date" value="<?php echo date('Y-m-01') ?>">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">To Date</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" name="to_date" value="<?php echo date('Y-m-t') ?>">
                </div>
              </div>

            </div>
          </div>
          <div class="text-right mt-3">
            <button type="submit" name='submit' id='submitBtn'  value='submit' class="btn btn-success " title="Submit"><i class="fa fa-check"></i> Submit</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->