<style type="text/css">
  th{
    vertical-align: middle !important;
  }
</style>
<div id="content" class="container-fluid">
   <h4>Monitoring Status Man Hours On <?php echo $data_date ?></h4>
  <hr/>

  <div class="alert alert-info font-weight-bold">
  <h6 class="font-weight-bold"><i class="fas fa-info-circle"></i> Click the name to see personal performance.</h6>
    <a href="<?php echo base_url() ?>home\summary_user_date\<?php echo $utc ?>" class="btn btn-sm btn-info">View Summary Activity</a>
  </div>

  <div class="row">
    <div class="col-md-6">
      <h4>Drafter Statistic</h4>
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Drafter List</h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <table class="table table-hover text-center dataTable">
              <thead>
                <tr class="bg bg-success" style="color: white">
                  <th class="text-left">Drafter</th>
                  <th>GA</th>
                  <th>Assembly</th>
                  <th>Single Part</th>
                  <th>Nesting</th>
                  <th>WeldMap</th>
                  <th>Procedure &<br>Method Statement</th>
                </tr>
              </thead>
              <tbody>
                <?php if(isset($data_user['Drafter'])): ?>
                <?php foreach ($data_user['Drafter'] as $row) { ?>
                  <tr>
                    <td class="text-left">
                      <a href="<?php echo site_url();?>drafter/performance/<?php echo strtr($this->encryption->encrypt($row['id_user']), '+=/', '.-~'); ?>"><span class=""><?php echo $user_list[$row['id_user']];  ?></span></a>
                    </td>                    
                    <td><?php echo $func->convert_to_time_format($row['GA']); ?></td>
                    <td><?php echo $func->convert_to_time_format($row['AS']); ?></td>
                    <td><?php echo $func->convert_to_time_format($row['SP']); ?></td>
                    <td><?php echo $func->convert_to_time_format($row['NS']); ?></td>
                    <td><?php echo $func->convert_to_time_format($row['NDT']); ?></td>
                    <td><?php echo $func->convert_to_time_format($row['PC&MS']); ?></td>
                  </tr>
                <?php } ?>
                <?php endif; ?>
              </tbody>
            </table>
           </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <h4>Checker Statistic</h4>
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Checker List</h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <table class="table table-hover text-center dataTable">
              <thead>
                <tr class="bg bg-aqua" style="color: white">
                  <th class="text-left">Checker</th>
                  <th>GA</th>
                  <th>Assembly</th>
                  <th>Single Part</th>
                  <th>Nesting</th>
                  <th>WeldMap</th>
                  <th>Procedure &<br>Method Statement</th>
                  </tr>
              </thead>
              <tbody>
                <?php if(isset($data_user['Checker'])): ?>
                <?php foreach ($data_user['Checker'] as $row) { ?>
                <tr>
                  <td class="text-left">
                    <a href="<?php echo site_url();?>drafter/performance/<?php echo strtr($this->encryption->encrypt($row['id_user']), '+=/', '.-~'); ?>"><span class=""><?php echo $user_list[$row['id_user']];  ?></span></a>
                  </td>                    
                  <td><?php echo $func->convert_to_time_format($row['GA']); ?></td>
                  <td><?php echo $func->convert_to_time_format($row['AS']); ?></td>
                  <td><?php echo $func->convert_to_time_format($row['SP']); ?></td>
                  <td><?php echo $func->convert_to_time_format($row['NS']); ?></td>
                  <td><?php echo $func->convert_to_time_format($row['NDT']); ?></td>
                  <td><?php echo $func->convert_to_time_format($row['PC&MS']); ?></td>
                </tr>
              <?php } ?>
              <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
 
  </div>

  <div class="row">
    <div class="col-md-6">
      <h4>Engineer Statistic</h4>
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Engineer List</h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <table class="table table-hover text-center dataTable">
              <thead>
                <tr class="bg bg-success" style="color: white">
                <th class="text-left">Engineer</th>
                <th>GA</th>
                <th>Assembly</th>
                <th>Single Part</th>
                <th>Nesting</th>
                <th>WeldMap</th>
                <th>Procedure &<br>Method Statement</th>
              </tr>
            </thead>
            <tbody>
              <?php if(isset($data_user['Engineer'])): ?>
              <?php foreach ($data_user['Engineer'] as $row) { ?>
                <tr>
                  <td class="text-left">
                    <a href="<?php echo site_url();?>drafter/performance/<?php echo strtr($this->encryption->encrypt($row['id_user']), '+=/', '.-~'); ?>"><span class=""><?php echo $user_list[$row['id_user']];  ?></span></a>
                  </td>                    
                  <td><?php echo $func->convert_to_time_format($row['GA']); ?></td>
                  <td><?php echo $func->convert_to_time_format($row['AS']); ?></td>
                  <td><?php echo $func->convert_to_time_format($row['SP']); ?></td>
                  <td><?php echo $func->convert_to_time_format($row['NS']); ?></td>
                  <td><?php echo $func->convert_to_time_format($row['NDT']); ?></td>
                  <td><?php echo $func->convert_to_time_format($row['PC&MS']); ?></td>
                </tr>
              <?php } ?>
              <?php endif; ?>
            </tbody>
          </table>
           </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <h4>Modeler Statistic</h4>
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Modeler List</h6>
        <div class="overflow-auto media text-muted py-3 mt-1 border-bottom border-top border-gray">
          <div class="container-fluid">
            <table class="table table-hover text-center dataTable">
              <thead>
                <tr class="bg bg-aqua" style="color: white">
                  <th class="text-left">Modeler</th>
                  <th>AL-SHAHEEN GALLAF</th>
                  <th>FORMOSA 2</th>
                  </tr>
              </thead>
              <tbody>
                <?php if(isset($data_user['Modeler'])): ?>
                <?php foreach ($data_user['Modeler'] as $row) { ?>
                <tr>
                  <td class="text-left">
                    <a href="<?php echo site_url();?>drafter/performance/<?php echo strtr($this->encryption->encrypt($row['id_user']), '+=/', '.-~'); ?>"><span class=""><?php echo $user_design_list[$row['id_user']];  ?></span></a>
                  </td>                    
                  <td><?php echo $func->convert_to_time_format($row['gallaf']) ?></td>
                  <td><?php echo $func->convert_to_time_format($row['formosa']) ?></td>
                </tr>
              <?php } ?>
              <?php endif; ?>
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
  $('.dataTable').DataTable();
</script>