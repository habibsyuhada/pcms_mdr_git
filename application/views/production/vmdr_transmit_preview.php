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
      <div class="card shadow my-3">
        <div class="card-header">
          <h6 class="m-0"><?php echo $meta_title ?></h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <form method="POST" action="<?php echo base_url() ?>production/vmdr_transmit_process">
            <div class="overflow-auto">
              <table class="table table-hover text-center">
                <thead class="bg-green-smoe text-white">
                  <tr>
                    <th>Reference Number</th>
                    <th>Rev No</th>
                    <th>Code</th>
                    <th>Rev Date</th>
                    <th>Status</th>
                    <th>Class</th>
                    <th>Title</th>
                    <th>Project</th>
                    <th>Discipline</th>
                    <th>Module</th>
                    <th>Attachment</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    foreach ($document_list as $key => $document): 
                      $status = "";
                      if(!isset($revision_list[$document['id']])){
                        $status = "No File Uploaded1";
                      }
                      elseif($revision_list[$document['id']]["status_review"] != 0){
                        $status = "No File Uploaded2";
                      }
                  ?>
                  <tr class="<?php echo ($status != "" ? "bg-alert-warning" : "") ?>">
                    <td>
                      <?php echo $document['ref_no'] ?>
                      <input type="hidden" name="id_document[]" value="<?php echo $document['id'] ?>" <?php echo ($status != "" ? "disabled" : "") ?>>
                      <input type="hidden" name="id_revision[]" value="<?php echo $revision_list[$document['id']]['id'] ?>" <?php echo ($status != "" ? "disabled" : "") ?>>
                    </td>
                    <td><?php echo $document['revision_no'] ?></td>
                    <td><?php echo $document['code'] ?></td>
                    <td><?php echo $document['revision_date'] ?></td>
                    <td><?php echo $document['status_remark'] ?></td>
                    <td><?php echo $document['class'] ?></td>
                    <td><?php echo $document['description'] ?></td>
                    <td><?php echo @$project_list[$document['project_id']]['project_name'] ?></td>
                    <td><?php echo @$discipline_list[$document['discipline']]['discipline_name'] ?></td>
                    <td><?php echo @$module_list[$document['module']]['mod_desc'] ?></td>
                    <td>
                      <?php if($status == ""): ?>
                      <a target="_blank" href="<?php echo base_url_ftp()?>upload/production_design/file/<?php echo $document['attachment'] ?>" class="btn btn-flat btn-dark"><i class="fas fa-file-pdf"></i></a>
                      <?php endif; ?>
                    </td>
                    <td><b><?php echo $status ?></b></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-info"><i class="fas fa-check"></i> Transmit</button>
            </div>
          </form>
        </div>
      </div>
    </div>    
  </div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->

<!-- <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-1.10.2.min.js"></script> -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.chained.min.js"></script>
<script>
    $("#modulex").chained("#projectx"); // disini kita hubungkan kota dengan provinsi
</script>