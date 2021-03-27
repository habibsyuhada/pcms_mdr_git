<div id="content" class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow my-3">
        <div class="card-header">
          <h6>Summary Master Document Register</h6>
        </div>
        <div class="card-body bg-white overflow-auto">
          <table id="tabel_doc_per_role" class="table table-hover text-center">
            <thead>
              <tr class="bg bg-yellow" style="color: white">
                <th rowspan="2" class="text-center" style="vertical-align: middle;">Project</th>
                <th colspan="2" class="text-center bg bg-success">MDR</th>
                <th colspan="3" class="text-center bg bg-info">VMDR</th>
              </tr>
              <tr style="color: white">
                <th class="text-center bg bg-success">Open</th>
                <th class="text-center bg bg-success">Complete</th>
                <th class="text-center bg bg-info">Open</th>
                <th class="text-center bg bg-info">Review</th>
                <th class="text-center bg bg-info">Complete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($summary as $key => $value): ?>
              <tr>
                <td><?php echo $project_list[$value['project_id']]['project_name'] ?></td>
                <td><?php echo $value['mdr_meta'] ?></td>
                <td><?php echo $value['mdr_complete'] ?></td>
                <td><?php echo $value['vmdr_meta'] ?></td>
                <td><?php echo $value['vmdr_review'] ?></td>
                <td><?php echo $value['vmdr_complete'] ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div><!-- ini div dari sidebar yang class wrapper -->