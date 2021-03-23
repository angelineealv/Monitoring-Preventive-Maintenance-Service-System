<div class="card">
    <div class="card-header">
        <a href="<?= base_url(uri_string() . '/add') ?>" class="btn btn-primary btn-sm ml-3" style="float:right;">
            <i class="fas fa-plus"></i> Add
        </a>

        <a class="btn btn-danger  btn-sm ml-3" style="float:right;" href="<?php echo base_url('master/MasterCustomer/print') ?>"><i class="fa fa-print"></i> Print</a>
        <a class="btn btn-warning  btn-sm " style="float:right;" href="<?php echo base_url('master/MasterCustomer/pdf') ?>"><i class="fa fa-file"></i> Export PDF</a>

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