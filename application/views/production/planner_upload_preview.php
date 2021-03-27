<div id="content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="card-title">Planner Upload Preview</h6>
                <hr>
                <form action="<?= site_url('production/proceed_submit_planner') ?>" method="POST" id="formPlanner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="bg-success text-white">
                                        <th>No</th>
                                        <th>Reference Number</th>
                                        <th>WP</th>
                                        <th>WU</th>
                                        <th>CTR-Lead</th>
                                        <th>Interface Doc</th>
                                        <th>ASB</th>
                                        <th>IFR Planned Date</th>
                                        <th>IFA Planned Date </th>
                                        <th>AFC Planned Date </th>
                                        <th>ASB Planned Date </th>
                                        <th>IFI Planned Date </th>
                                        <th>AFD Planned Date</th>
                                        <th>Equipment Class</th>
                                        <th>Equipment SubClass</th>
                                        <th>Criticality </th>
                                        <th>Originator Doc. Number </th>
                                        <th>TAG</th>
                                        <th>Cable TAG</th>
                                        <th>Line TAG</th>
                                        <th>SPP TAG</th>
                                        <th>MDR Update Information</th>
                                        <th>Field Operations Delivrable</th>
                                        <th>Weight</th>
                                        <th>Progress</th>
                                        <th>Contractor Transmittal Sheet Number</th>
                                        <th>Issue Date Contractor Transmittal Sheet</th>
                                        <th>MDR Revision or Change Request nb</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; foreach($export as $key => $value): ?>
                                        <tr class="<?= $value['not_found'] ? 'alert-danger' : '' ?>">
                                            <td><?= $no++ ?></td>
                                            <td><input type="text" name="ref_no[]" value="<?= trim($value['data']['A']) ?>"
                                                    id="" class="form-control" readonly></td>
                                            <td><input type="text" name="wp[]" value="<?= $value['data']['B'] ?>" id=""
                                                    class="form-control" readonly></td>
                                            <td><input type="text" name="wu[]" value="<?= $value['data']['C'] ?>" id=""
                                                    class="form-control" readonly></td>
                                            <td><input type="text" name="ctr_lead[]" value="<?= $value['data']['D'] ?>"
                                                    id="" class="form-control" readonly></td>
                                            <td><input type="text" name="interface_doc[]"
                                                    value="<?= $value['data']['E'] ?>" id="" class="form-control"
                                                    readonly></td>
                                            <td><input type="text" name="asb[]" value="<?= $value['data']['F'] ?>" id=""
                                                    class="form-control" readonly>
                                            </td>
                                            <td><input type="text" name="ifr_planned_date[]"
                                                    value="<?= $value['data']['G'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="ifa_planned_date[]"
                                                    value="<?= $value['data']['H'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="afc_planned_date[]"
                                                    value="<?= $value['data']['I'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="asb_planned_date[]"
                                                    value="<?= $value['data']['J'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="ifi_planned_date[]"
                                                    value="<?= $value['data']['K'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="afd_planned_date[]"
                                                    value="<?= $value['data']['L'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="equipment_class[]"
                                                    value="<?= $value['data']['M'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="equipment_subclass[]"
                                                    value="<?= $value['data']['N'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="criticality[]"
                                                    value="<?= $value['data']['O'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="originator_doc_number[]"
                                                    value="<?= $value['data']['P'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="tag[]"
                                                    value="<?= $value['data']['Q'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="cable_tag[]"
                                                    value="<?= $value['data']['R'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="line_tag[]"
                                                    value="<?= $value['data']['S'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="spp_tag[]"
                                                    value="<?= $value['data']['T'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="mdr_update_information[]"
                                                    value="<?= $value['data']['U'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="field_operations_delivrable[]"
                                                    value="<?= $value['data']['V'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="weight[]"
                                                    value="<?= $value['data']['W'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="progress[]"
                                                    value="<?= $value['data']['X'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="contractor_transmittal_sheet_number[]"
                                                    value="<?= $value['data']['Y'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="issue_date_contractor_transmittal_sheet[]"
                                                    value="<?= $value['data']['Z'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="mdr_revision_request_nb[]"
                                                    value="<?= $value['data']['AA'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="fdb_volume[]"
                                                    value="<?= $value['data']['AB'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="brownfield_interface[]"
                                                    value="<?= $value['data']['AC'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td><input type="text" name="folio_drawing[]"
                                                    value="<?= $value['data']['AD'] ?>" id="" class="form-control"
                                                    readonly>
                                            </td>
                                            <td class="text-center">
                                                <?php if($value['not_found']): ?>
                                                <b class="text-danger">Document Number Not Found</b>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <a href="javascript:history.back()" class="btn btn-secondary"><i
                                    class="fas fa-arrow-left"></i> Back</a>
                            <button type="submit" class="btn btn-primary btnSubmit"><i class="fas fa-save"></i>
                                Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
$(document).ready(function() {
    var total_data = "<?= $total_data ?>"
    var total_not_found = "<?= $total_not_found ?>"
    if(total_data == total_not_found) {
        $('.btnSubmit').attr('disabled', true)
    }
    $('#formPlanner').submit(function(e) {
        var formData = $(this).serialize()
        e.preventDefault()
        Swal.fire({
            type: "question",
            title: "SUBMIT",
            text: "Submit planner data ?",
            showCancelButton: true
        }).then((res) => {
            if (res.value) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    success: function(data) {
                        if (data.success) {
                            window.location.href = data.redirect
                        }
                    },
                    error: function(err) {
                        console.log(err)
                    }
                })
            }
        })
    })
})
  $('table').DataTable( {
    paging: false,
    searching: false,
    dom: 'Bfrtip',
    buttons: [
      {
        extend:'excel',exportOptions: {format: {
          body: function ( data, row, column, node ) {
              if(column != 12){
                if($(data).is("input")){
                  data = $(data).val();
                }
              }
              
              return data;
          }
        }
      }},
      {
        extend:'copy',exportOptions: {format: {
          body: function ( data, row, column, node ) {
              if(column != 12){
                if($(data).is("input")){
                  data = $(data).val();
                }
              }
              
              return data;
          }
        }
      }}
    ],
    createdRow : function( row, data, dataIndex){
      if( data[12] !=  ''){
        $(row).css({"background-color":'#f8d7da', 'color' : '#721c24'});
        $(row).addClass('font-weight-bold');
      }
    }
  });
</script>