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
<script>
  $(document).ready(function() {
    $('#table-user').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        "url": "<?php echo site_url('master/user/datatables') ?>",
        "type": "POST"
      },
      "columnDefs": [{
        "targets": [0],
        "orderable": true,
      }, ],
      "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        $(nRow).find(".cb").click(function() {
          if ($(".cb").is(":checked")) {
            $("#btnSend").removeAttr("disabled");
            // check.push($(this).val()); //post value checked to validate
            // console.log(check);
          } else {
            $("#btnSend").attr("disabled", "disabled");
          }

          let val = $(this).val(); //pick value checked to validate
          let index = check.indexOf(val); //detect value array of cb

          if (index > -1) { //if index of array cb > -1 aka not checked aka null
            check.splice(index, 1); //do remove val checked
          } else {
            check.push(val);
          }
        });
      }
    });
  });
</script>