<div class="card scrollbar-inner" style=" background-color: #f1f1f1;">
  <form id="postform" name="postform" method="post">

    <div class="row">
      <div class="card-body" style="margin:30px; padding: 30px; width: 50%; background-color:white;">


        <div class="card-action ">

          <h1> Customer

            <?php if (@$formtype != "edit") { ?>
              <button type="submit" name="submit" class="btn btn-primary btn-sm pull-right" style="margin-left: 5px;">
                <i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
            <?php } else { ?>
              <button type="submit" name="submit" class="btn btn-primary btn-sm pull-right" style="margin-left: 5px;">
                <i class="fas fa-save"></i>&nbsp;&nbsp;Update</button>
            <?php } ?>
            <a href="<?= base_url("master/customer") ?>" class="btn btn-sm btn-danger pull-right"><i class="fas fa-reply"></i>&nbsp;&nbsp; Cancel</a>
          </h1>

        </div>


        <div class="form-group">
          <label for="email2">Fullname</label>
          <input type="hidden" name="id" value="<?= ($form_type == 'edit') ? $row->customerid : ''; ?>" />
          <input type="text" class="form-control" name="fullname" value="<?= ($form_type == 'edit') ? $row->customername : ''; ?>" placeholder="Input Fullname" required />
        </div>

        <div class="form-group">
          <label for="email2">Prefix</label>
          <input type="text" class="form-control" name="prefix" value="<?= ($form_type == 'edit') ? $row->customerprefix : ''; ?>" placeholder="Input Prefix" required />
        </div>

        <div class="form-group">
          <label for="email2">Phone No.</label>
          <input type="text" class="form-control" name="phone" value="<?= ($form_type == 'edit') ? $row->customerphone : ''; ?>" placeholder="Input Phone No." required />
        </div>

        <div class="form-group">
          <label for="email2">Address</label>
          <input type="text" class="form-control" name="address" value="<?= ($form_type == 'edit') ? $row->customeraddress : ''; ?>" placeholder="Input Address" required />
        </div>

        <div class="form-group">
          <label for="email2">E-mail</label>
          <input type="email" class="form-control" name="email" value="<?= ($form_type == 'edit') ? $row->customeremail : ''; ?>" placeholder="Input E-mail" required />
        </div>

        <div class="form-group">
          <label for="email2">Type</label>
          <input type="number" class="form-control" name="type" value="<?= ($form_type == 'edit') ? $row->customertypeid : ''; ?>" placeholder="Input Type ID" required />
        </div>

        <div class="form-group">
          <label for="email2">Province</label>
          <br>
          <select id='province' name="province" style='width: 100%;' required>
            <option value='<?= ($form_type == 'edit') ? $row->customerprovinceid : ''; ?>'><?= ($form_type == 'edit') ? $provname->provincename : ''; ?></option>
          </select>
        </div>

        <div class="form-group">
          <label for="email2">City</label>
          <br>
          <select id='city' name="city" style='width: 100%;' required>
            <option value='<?= ($form_type == 'edit') ? $row->customercityid : ''; ?>'><?= ($form_type == 'edit') ? $cityname->cityname : ''; ?></option>
          </select>
        </div>

        <div class="form-group">
          <label for="email2">Sub District</label>
          <input type="number" class="form-control" name="subdis" value="<?= ($form_type == 'edit') ? $row->customersubdisid : ''; ?>" placeholder="Input Sub District ID" required />
        </div>

        <div class="form-group">
          <label for="email2">UV</label>
          <input type="number" class="form-control" name="uv" value="<?= ($form_type == 'edit') ? $row->customeruvid : ''; ?>" placeholder="Input UV ID" required />
        </div>

        <div class="form-group">
          <label for="email2">Postal Code</label>
          <input type="text" class="form-control" name="postal" value="<?= ($form_type == 'edit') ? $row->customerpostalcode : ''; ?>" placeholder="Input Postal Code" required />
        </div>

        <div class="form-group">
          <label for="email2">Latitude</label>
          <input type="number" class="form-control" name="latitude" value="<?= ($form_type == 'edit') ? $row->customerlatitude : ''; ?>" placeholder="Input Latitude" required />
        </div>

        <div class="form-group">
          <label for="email2">Longtitude</label>
          <input type="number" class="form-control" name="longtitude" value="<?= ($form_type == 'edit') ? $row->customerlongtitude : ''; ?>" placeholder="Input Longtitude" required />
        </div>
      </div>



      <div class="card-body" style="margin-left:5px; margin-right:30px;margin-bottom:30px; margin-top: 30px; padding: 30px; background-color:white;">

        <h1>INFO</h1>
        <hr>

        <div class="form-group ">
          <label for="email2">Created By &emsp;&emsp;&emsp;&emsp;&emsp;<?= ($form_type == 'edit') ? $create->create : ''; ?></label>
        </div>

        <div class="form-group">
          <label for="email2">Created Date &emsp;&emsp;&emsp;&emsp;<?= ($form_type == 'edit') ? $row->createddate : ''; ?></label>
        </div>

        <div class="form-group">
          <label for="email2">Updated By &emsp;&emsp;&emsp;&emsp;&emsp;<?= ($form_type == 'edit') ? $create->update : ''; ?></label>
        </div>

        <div class="form-group">
          <label for="email2">Updated Date &emsp;&emsp;&emsp;&emsp;<?= ($form_type == 'edit') ? $row->updateddate : ''; ?></label>
        </div>

        <div class="form-group">
          <label for="email2">Is Active</label>
          <input type="checkbox" name="isactive" value="t" <?php if ($form_type == 'edit' && $row->isactive == 't') : ?> <?php echo set_checkbox('isactive', 't', true); ?> <?php endif; ?> />
        </div>
      </div>
    </div>
  </form>
</div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
            $.refresh('table-user');
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
<script type="text/javascript">
  $(document).ready(function() {

    $("#province").select2({
      ajax: {
        url: '<?= base_url() ?>Master/MasterCustomer/getProvince',
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
<script type="text/javascript">
  $(document).ready(function() {

    $("#city").select2({
      ajax: {
        url: '<?= base_url() ?>Master/MasterCustomer/getCity',
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