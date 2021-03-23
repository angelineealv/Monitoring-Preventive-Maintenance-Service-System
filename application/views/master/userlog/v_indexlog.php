<div class="card">

    <div class="card-body">
        <div class="table-responsive">
            <table id="table-userlog" name="table-userlog" class="display table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>First Login</th>
                        <th>Last Login</th>
                        <th>Last Active</th>
                        <th>Active Duration</th>
                        <th>Last Location</th>
                        <th>Last Password Change</th>
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
        table = $('#table-userlog').DataTable({
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