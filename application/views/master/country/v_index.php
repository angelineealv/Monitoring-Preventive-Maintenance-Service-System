<div class="card">
    <div class="card-header">

        <a class="btn btn-warning btn-sm" href="<?php echo base_url('master/MasterCountry/pdf') ?>"><i class="fa fa-print"></i> Print & Export PDF</a>
        <a href="<?= base_url(uri_string() . '/add') ?>" class="btn btn-primary btn-sm" style="float:right;">
            <i class="fas fa-plus"></i> Add
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table-country" name="table-country" class="display compact table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Country Name</th>
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
        table = $('#table-country').DataTable({
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

                },
                {
                    sWidth: '15%'
                },
                {
                    sWidth: '2%'
                }
            ]

        });
    });
</script>