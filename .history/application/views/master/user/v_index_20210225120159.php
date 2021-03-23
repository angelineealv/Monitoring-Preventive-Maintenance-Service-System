<div class="card">
  <div class="card-header">
    <a href="<?= base_url(uri_string() . '/add') ?>" class="btn btn-primary btn-sm" style="float:right;">
      <i class="fas fa-plus"></i> Add
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table id="basic-datatables" id="table-user" class="display table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th>Username</th>
            <th>Name</th>
            <th>Active</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#table-user').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        "url": "<?= base_url(uri_string() . '/datatables') ?>",
        "type": "POST"
      },
      "columnDefs": [{
        "targets": [0],
        "orderable": true,
      }, ],
    });
  });
</script>