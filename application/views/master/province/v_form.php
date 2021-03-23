<div class="row" style="background-color: #f1f1f1;">
    <div class="card scrollbar-inner" style="float: left ;  
  width: 50%;margin-top:25px;margin-left:40px;margin-right:20px;">
        <form id="postform" name="postform" method="post">
            <div class="card-action">

                <h2 style="margin-top: 5px;">PROVINCE
                    <?php if (@$formtype != "edit") { ?>
                        <button type="submit" name="submit" class="btn btn-primary btn-sm pull-right" style="margin-left: 5px;">
                            <i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
                    <?php } else { ?>
                        <button type="submit" name="submit" class="btn btn-primary btn-sm pull-right" style="margin-left: 5px;">
                            <i class="fas fa-save"></i>&nbsp;&nbsp;Update</button>
                    <?php } ?>
                    <a href="<?= base_url("master/province") ?>" class="btn btn-sm btn-danger pull-right"><i class="fas fa-reply"></i>&nbsp;&nbsp; Cancel</a>

                    <hr style="color:#f1f1f1">
                </h2>
            </div>

            <div class="card-body">

                <div class="form-group">
                    <label for="email2">Province Name</label>
                    <input type="hidden" name="id" value="<?= ($form_type == 'edit') ? $row->provinceid : ''; ?>" />
                    <input type="text" class="form-control" name="provincename" value="<?= ($form_type == 'edit') ? $row->provincename : ''; ?>" placeholder="Input Province Name" required />
                </div>


                <div class="form-group">
                    <label for="email2">Country</label>
                    <br>
                    <select id='countryid' name="countryid" style='width: 100%;' required>
                        <option value='<?= ($form_type == 'edit') ? $row->countryid : ''; ?>'><?= ($form_type == 'edit') ? $row->countryname : ''; ?></option>
                    </select>
                </div>



                <input type="hidden" class="form-control" name="createdby" value="<?= $this->session->userdata('username'); ?>" placeholder="Input Created By" required />

                <input type="hidden" class="form-control" name="createddate" value=" <?php echo date('Y-m-d H:i:s') ?>" readonly placeholder="Input Created Date" required />

                <input type="hidden" class="form-control" name="updatedby" value="<?= $this->session->userdata('userid'); ?>" placeholder="Input Updated By" required />

                <input type="hidden" class="form-control" name="updateddate" value=" <?php echo date('Y-m-d H:i:s') ?>" readonly placeholder="Input Updated Date" required />



            </div>

    </div>
    <div class="card scrollbar-inner" style="float: right; width:40%;margin-top:25px;">
        <div class="card-body">
            <div class="col">
                <h2 style="margin-top: 18px;">INFO</h2>
                <hr style="color:#f1f1f1">
            </div>
            <div class="form-group">
                <label for="email2">Created By &emsp; &emsp; &emsp; &emsp;&emsp; &emsp; &emsp;<?= ($form_type == 'edit') ? $row->createdby : ''; ?></label>
            </div>

            <div class="form-group">
                <label for="email2">Created Date &emsp; &emsp; &emsp; &emsp;&emsp; &emsp; <?= ($form_type == 'edit') ? $row->createddate : ''; ?></label>

            </div>

            <div class="form-group">
                <label for="email2">Updated By &emsp; &emsp; &emsp; &emsp;&emsp; &emsp; &emsp; <?= ($form_type == 'edit') ? $row->updatedby : ''; ?></label>
            </div>

            <div class="form-group">
                <label for="email2">Updated Date &emsp; &emsp; &emsp; &emsp;&emsp; &emsp; <?= ($form_type == 'edit') ? $row->updateddate : ''; ?></label>

            </div>
            <div class="form-group">
                <label for="email2">Is Active</label>
                <input type="checkbox" name="isactive" value="t" <?php if ($form_type == 'edit' && $row->isactive == 't') : ?> <?php echo set_checkbox('isactive', 't', true); ?> <?php endif; ?> />
            </div>

        </div>
    </div>
    </form>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        $("#postform").submit(function(e) {
            e.preventDefault();
            var form = new FormData(this);

            $.ajax({
                url: '<?= base_url(uri_string() . '/process') ?>',
                type: 'POST',
                data: form,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(e) {
                    if (e.result == "1") {
                        $.notify(e.message, 'success');
                        setTimeout(function() {
                            window.location.href = e.redirect;
                        }, 1000);
                        $.refresh('table-province');
                    } else {
                        $.notify(e.message, 'error');
                        setTimeout(function() {
                            window.location.href = e.redirect;
                        }, 1000);
                    }
                }
            });
        });
    });
</script>



<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {

        $("#countryid").select2({
            ajax: {
                url: '<?= base_url() ?>Master/MasterProvince/getcountry',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    });
</script>