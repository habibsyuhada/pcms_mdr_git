  <div class="row">
    <div class="col-md-6">
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">Annoucements</h6>
        <div class="overflow-auto media text-muted py-3 border-bottom border-top border-gray small">
          <div class="container-fluid">
            <!-- content -->
            <form>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Read Only</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control" value="email@example.com">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Normal</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Name">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Select</label>
                <div class="col-sm-10">
                  <select class="custom-select">
                    <option>asd</option>
                    <option>asd</option>
                    <option>asd</option>
                    <option>asd</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Upload</label>
                <div class="col-sm-10">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" onChange="$('.custom-file-label').html($(this).val())">
                    <label class="custom-file-label">Choose file</label>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Normal</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Name">
                </div>
              </div>
            </form>
            <!-- end content -->
          </div>
        </div>
        <small class="d-block text-right mt-3">
        </small>
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