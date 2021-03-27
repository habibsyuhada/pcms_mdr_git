<div id="content" class="container-fluid">
  <div class="row">

    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0"><?php echo $meta_title ?></h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <table class="table table-hover text-center dataTable">
              <thead class="bg-green-smoe text-white">
                <tr>
                  <th>#</th>
                  <th>Code</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach($dt_list as $no => $dt): 
                ?>
                <tr>
                  <td class="align-middle"><?php echo $no+1 ?></td>
                  <td class="align-middle"><?php echo $dt['company_code'] ?></td>
                  <td class="align-middle"><?php echo $dt['company_name'] ?></td>
                  </td>
                  <td class="align-middle">
                    <a href="<?php echo base_url(); ?>m_vendor/vendor_edit/<?php echo strtr($this->encryption->encrypt($dt['id_company']), '+=/', '.-~'); ?>" class="btn btn-warning" title="Detail">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="<?php echo base_url(); ?>m_vendor/vendor_delete_process/<?php echo strtr($this->encryption->encrypt($dt['id_company']), '+=/', '.-~'); ?>" class="btn btn-danger" title="Detail" onclick="delete_dt(event)">
                      <i class="fas fa-trash"></i> Delete
                    </a>
                  </td>
                </tr>
                <?php endforeach; ?>
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

  function delete_dt(ev) {
    ev.preventDefault();
    var urlToRedirect = ev.currentTarget.getAttribute('href');
    Swal.fire({
      title: 'Are you sure to <b class="text-danger">&nbsp;Delete&nbsp;</b> this?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Delete it!'
    }).then((result) => {
      if (result.value) {
        window.location = urlToRedirect;
      }
    });
  }
</script>