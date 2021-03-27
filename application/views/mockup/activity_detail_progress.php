<style type="text/css">
  .nav-link{
    color: #000;
  }
  .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
    color: #007bff;
    background: #fff;
    border-bottom: 2px solid #007bff;
    border-radius: 0px;
  }
</style>
<div id="content" class="container-fluid">
 
  <div class="row">

    <div class="col-md-12">
       <div class="overflow-auto text-muted  ">
          <h6><?php $this->load->view('_partial/breadcump.php');?></h6>
       </div>
    </div>

    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">

          <li class="nav-item">
            <a class="nav-link <?php echo ($t == '' ? 'active' : '') ?>" data-toggle="pill" href="#pills-activity">Activity</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($t == 'd' ? 'active' : '') ?>" data-toggle="pill" href="#pills-detail">Detail</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($t == 'r' ? 'active' : '') ?>" data-toggle="pill" href="#pills-rev">Revision</a>
          </li>

        </ul>
        <div class="overflow-auto media text-muted py-3 border-bottom border-top border-gray">
          <div class="container-fluid">
            <div class="tab-content">

              <!-- Activity Detail -->
              <div class="tab-pane fade <?php echo ($t == '' ? 'show active' : '') ?>" id="pills-activity">
                <form method="POST" action="<?php echo base_url();?>mockup/activity_detail_stop">
                  <div class="row">
                    <div class="col-md text-center">
                      <h1>Document Number : 001</h1>
                    </div>
                  </div>

                  <div class="row mt-3">
                    <div class="col-md">
                      <div class="form-group row">
                        <div class="col-xl text-center">
                          <input type="hidden" name="datetime_start" value="<?php echo $datetime_start; ?>">
                          <button type="submit" name='submit' value='submit' class="btn btn-danger btn-lg"><i class="fa fa-pause"></i> <b>STOP</b></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <table class="table dataTable table-hover text-center mt-4">
                  <thead class="bg-success text-white">
                    <tr>
                      <th width="1%">#</th>
                      <th>Drafter</th>
                      <th>Start Time</th>
                      <th>Stop Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="align-middle">1</td>
                      <td class="align-middle">Habib Syuhada</td>
                      <td class="align-middle"><?php echo $datetime_start; ?></td>
                      <td class="align-middle"><span class="badge badge-warning font-size-9">Progress</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- Activity Detail END -->

              <!-- Drawing Detail -->
              <div class="tab-pane fade <?php echo ($t == 'd' ? 'show active' : '') ?>" id="pills-detail">
                <form method="POST" action="<?php echo base_url();?>engineering/draw_edit_process">

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Document Number :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="drawing_no" value="001" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Drawing Number :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="drawing_no" value="093PRK31009-GY095" required>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Discipline :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="drawing_no" value="Structure" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Module :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="drawing_no" value="PRK-31009" required>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Total Drafter :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="drawing_no" value="1" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Drawing Type :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="drawing_no" value="Single Part" required>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Plan Hours :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="drawing_no" value="1000" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Actual Hours :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="drawing_no" value="0" required>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <div class="col-xl text-right">
                          <button type="submit" name='submit' value='submit' class="btn btn-primary" title="Update"><i class="fa fa-check"></i> Update</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </form>
              </div>
              <!-- Drawing Detail END -->

              <!-- Drawing Revision -->
              <div class="tab-pane fade <?php echo ($t == 'r' ? 'show active' : '') ?>" id="pills-rev">

                <form method="POST" action="<?php echo base_url();?>engineering/revision_new_process" enctype="multipart/form-data">

                  <div class="row">
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Revision Number :</label>
                        <div class="col-xl">
                          <input type="text" class="form-control" name="rev_no" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Attachment :</label>
                        <div class="col-xl">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" onChange="$('.custom-file-label').html($(this).val())" name="file">
                            <label class="custom-file-label">Choose file</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-xl-3 col-form-label">Remarks :</label>
                        <div class="col-xl">
                          <textarea class="form-control" name="remarks"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md">
                    </div>
                    <div class="col-md">
                      <div class="form-group row">
                        <div class="col-xl text-right">
                          <button type="submit" name='submit' value='submit' class="btn btn-primary" title="Submit"><i class="fa fa-check"></i> Submit</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </form>

                <table class="table dataTable table-hover text-center">
                  <thead class="bg-success text-white">
                    <tr>
                      <th>Revision Number</th>
                      <th>Date</th>
                      <th>Attachment</th>
                      <th>Remarks</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="align-middle">R 001</td>
                      <td class="align-middle">10 September 2019</td>

                     <td class="align-middle"><a target="_blank" href="<?php echo base_url_ftp();?>upload/rev/Contoh_Drawing.pdf" class="btn btn-flat btn-dark"><i class="fas fa-file-pdf"></i></a></td>

                       <!--  <td class="align-middle"><a target="_blank" href="http://10.5.252.88/content/public/document/drawing/<?php //echo $revision['attachment'] ?>" class="btn btn-flat btn-dark"><i class="fas fa-file-pdf"></i></a></td> -->

                      <td class="align-middle">-</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- Drawing Revision END -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->