<div id="content">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6>MWS Preview Upload</h6>
            <hr>
            <form action="<?= site_url('production/process_submit_mws') ?>" method="POST" id="formMws">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive overflow-auto">
                            <table class="table table-hover tableMws">
                                <thead class="bg-success text-white">
                                    <th>No</th>
                                    <th>Reference Number</th>
                                    <th>Mark Up</th>
                                    <th>TS-Out No</th>
                                    <th>TS-Out Date</th>
                                    <th>Doc Revision</th>
                                    <th>Review Status / Code</th>
                                    <th>TS-In No</th>
                                    <th>TS-In Date</th>
                                    <th>Remarks</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($export as $key => $value): ?>
                                    <tr
                                        class="tr<?= $key ?> <?= $value['duplicate'] || $value['found'] ? 'alert-danger font-weight-bold duplicate' : '' ?>">
                                        <td><?= $no++ ?></td>
                                        <td><input type="text" name="ref_no[]" value="<?= trim($value['data']['A']) ?>"
                                                id="" class="form-control ref_no<?= $key ?>"
                                                <?= $value['duplicate']   ? 'disabled' : 'readonly' ?>></td>
                                        <td><input type="text" name="mark_up[]" value="<?= $value['data']['B'] ?>" id=""
                                                class="form-control mark_up<?= $key ?>"
                                                <?= $value['duplicate']   ? 'disabled' : 'readonly' ?>></td>
                                        <td><input type="text" name="ts_out_no[]" value="<?= $value['data']['C'] ?>"
                                                id="" class="form-control ts_out_no<?= $key ?>"
                                                <?= $value['duplicate']   ? 'disabled' : 'readonly' ?>></td>
                                        <td><input type="text" name="ts_out_date[]"
                                                value="<?= $value['data']['D'] ? date('Y-m-d', strtotime($value['data']['D'])) : '' ?>"
                                                id="" class="form-control ts_out_date<?= $key ?>"
                                                <?= $value['duplicate']   ? 'disabled' : 'readonly' ?>></td>
                                        <td><input type="text" name="doc_revision[]" value="<?= $value['data']['E'] ?>"
                                                id="" class="form-control doc_revision<?= $key ?>"
                                                <?= $value['duplicate']   ? 'disabled' : 'readonly' ?>></td>
                                        <td><input type="text" name="review_status[]" value="<?= $value['data']['F'] ?>"
                                                id="" class="form-control review_status<?= $key ?>"
                                                <?= $value['duplicate']   ? 'disabled' : 'readonly' ?>></td>
                                        <td><input type="text" name="ts_in_no[]" value="<?= $value['data']['G'] ?>"
                                                id="" class="form-control ts_in_no<?= $key ?>"
                                                <?= $value['duplicate']   ? 'disabled' : 'readonly' ?>></td>
                                        <td><input type="text" name="ts_in_date[]"
                                                value="<?= $value['data']['H'] ? date('Y-m-d', strtotime($value['data']['H'])) : '' ?>"
                                                id="" class="form-control ts_in_date<?= $key ?>"
                                                <?= $value['duplicate']   ? 'disabled' : 'readonly' ?>></td>
                                        <td><input type="text" name="remarks[]" class="form-control remarks<?= $key ?>"
                                                value="<?= $value['data']['I'] ?>" id=""
                                                <?= $value['duplicate']   ? 'disabled' : 'readonly' ?>></td>
                                        <td class="statustd text-center">
                                            <?php if($value['duplicate']): ?>
                                            <b class="text-danger">Duplicate Data On Excel</b>
                                            <?php elseif($value['found']): ?>
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
                        <a href="javascript:history.back()" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
                            Back</a>
                        <button type="submit" class="btn btn-primary btnSubmit"><i class="fas fa-save"></i>
                            Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script>
$(document).ready(function() {
    var total_data = "<?= $total_data ?>"
    var total_not_found = "<?= $total_not_found ?>"
    if (total_data == total_not_found) {
        $('.btnSubmit').attr('disabled', true)
    }
    $('#formMws').submit(function(e) {
        e.preventDefault()
        var formData = $(this).serialize()
        Swal.fire({
            type: "question",
            title: "SUBMIT",
            text: "Submit MWS ?",
            allowOutsideClick: () => !Swal.isLoading(),
            showCancelButton: true,
        }).then((res) => {
            if (res.value) {
                Swal.fire({
                    title: "Uploading ...",
                    onBeforeOpen() {
                        Swal.showLoading()
                    },
                    allowOutsideClick: false
                })
                $.ajax({
                    url: $(this).attr('action'),
                    data: formData,
                    type: "POST",
                    dataType: "JSON",
                    processData: false,
                    success: function(data) {
                        console.log(data)
                        if (data.success) {
                            window.location.href = data.redirect
                        } else {
                            $.map(data.duplicate, function(v, i) {
                                console.log(v)
                                $(`.tr${i}`).addClass('alert-danger')
                                $(`.tr${i}`).find('.statustd').html(
                                    `<b class="text-danger">Already exist in database</b>`
                                )
                            })
                            Swal.fire({
                                type: "error",
                                title: `<b class="text-danger">ERROR</b>`,
                                text: "Error while uploading, check status column"
                            })
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
              if(column != 10){
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
              if(column != 10){
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
      if( data[10] !=  ''){
        $(row).css({"background-color":'#f8d7da', 'color' : '#721c24'});
        $(row).addClass('font-weight-bold');
      }
    }
  });
</script>