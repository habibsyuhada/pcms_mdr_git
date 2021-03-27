<div id="content" class="container-fluid">
  <div class="row">

    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <?php  echo $this->session->flashdata('message');?>
            <table class="table table-hover text-center dataTable">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th>Document No</th>
                  <th>Drawing No</th>
                  <th>Module</th>
                  <th>Discipline</th>
                  <th>Project</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php for($i = 1; $i < 6; $i++): ?>
                <tr>
                  <td class="align-middle">00<?php echo $i ?></td>
                  <td class="align-middle">093PRK3100<?php echo 8-$i ?>-GY09<?php echo $i ?></td>
                  <td class="align-middle">PRK-31009</td>
                  <td class="align-middle">Structure</td>
                  <td class="align-middle">Tangguh Pack B</td>
                  <td class="align-middle">
                    <a href="<?php echo base_url(); ?>mockup/activity_detail" class="btn btn-primary text-white" title="Detail">
                      <i class="fas fa-file-alt"></i> Detail
                    </a>
                  </td>
                </tr>
                <?php endfor; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->

<script type="text/javascript">
  $('.dataTable').DataTable({
    "lengthChange": false,
    "order": []
  });
</script>