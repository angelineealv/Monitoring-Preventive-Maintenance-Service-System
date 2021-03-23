<div class="card">
    <div class="card-header">
        <a href="<?= base_url(uri_string() . '/add') ?>" class="btn btn-primary btn-sm ml-3" style="float:right;">
            <i class="fas fa-plus"></i> Add
        </a>

        <a class="btn btn-warning  btn-sm " style="float:right;" href="<?php echo base_url('master/MasterCity/pdf') ?>"><i class="fa fa-file"></i> Export PDF</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table-city" name="table-city" class="display compact table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>City Name</th>
                        <th>Province Name </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<style type="text/css">
    <?php
    $css = file_get_contents('application/views/template/inc/datatable.css');
    echo $css;
    ?>
</style>
<script>
    var table;
    $(document).ready(function() {
        table = $('#table-city').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url(uri_string() . '/datatables') ?>",
                "type": "POST"
            },
            bAutoWidth: false,
            aoColumns: [{
                sWidth: '1%'
            }, {
                sWidth: '15%'
            }, {
                sWidth: '15%'
            }, {
                sWidth: '2%'
            }]
        });
    });
</script>