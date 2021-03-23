<div class="card">
  <div class="card-header">
    <a href="<?= base_url(uri_string() . '/add') ?>" class="btn btn-primary btn-sm" style="float:right;">
      <i class="fas fa-plus"></i> Add
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table id="table-customer" name="table-customer" class="display table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Customer Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Email</th>
            <th>Type Id</th>

            <th>Action</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
  var table;
  $(document).ready(function() {
    table = $('#table-customer').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        "url": "<?= base_url(uri_string() . '/datatables') ?>",
        "type": "POST"
      },
    });
  });
</script>