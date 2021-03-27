<div class="container-fluid medium" style="min-height: 79vh">
  <div class="row">
    <div class="col-md-12">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Annoucements</h6>
        <div class="overflow-auto media text-muted py-3 border-bottom border-top border-gray small">
          <div class="container-fluid">
            <table class="table dataTable table-striped text-center">
              <thead>
                <tr>
                  <th>Badge</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Departement</th>
                  <th>Title</th>
                  <th>Project</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php for($badge = 10039315; $badge < 10039360; $badge++): ?>
                <tr>
                  <td><?php echo $badge ?></td>
                  <td>Habib Syuhada</td>
                  <td>Male</td>
                  <td>IT</td>
                  <td>IT Programmer</td>
                  <td>Overhead</td>
                  <td>
                    <button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <?php endfor; ?>
              </tbody>
            </table>
          </div>
        </div>
        <small class="d-block text-right mt-3">
        </small>
      </div>
    </div>
  </div>
</div>
<script>
  $(function () {
    $('.dataTable').DataTable({
      "lengthChange": false,
    })
  })
</script>