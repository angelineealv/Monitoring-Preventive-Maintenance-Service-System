<div class="card scrollbar-inner">
  <form id="postform" name="postform" method="post">

    <div class="card-action">
      <?php if (@$formtype != "edit") { ?>
        <button type="submit" name="submit" class="btn btn-primary btn-sm pull-right" style="margin-left: 5px;">
          <i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
      <?php } else { ?>
        <button type="submit" name="submit" class="btn btn-primary btn-sm pull-right" style="margin-left: 5px;">
          <i class="fas fa-save"></i>&nbsp;&nbsp;Update</button>
      <?php } ?>
      <a href="<?= base_url("master/user") ?>" class="btn btn-sm btn-danger pull-right"><i class="fas fa-reply"></i>&nbsp;&nbsp; Back</a>
    </div>

    <div class="card-body">
      <div class="form-group">
        <label for="email2">Username</label>
        <input type="hidden" name="id" value="<?php ($form_type == 'edit') ? $row->userid : ''; ?>" />
        <input type="text" class="form-control" name="username" value="<?php ($form_type == 'edit') ? $row->username : ''; ?>" placeholder="Input Username" required />
      </div>

      <div class="form-group">
        <label for="email2">Fullname</label>
        <input type="text" class="form-control" name="name" value="<?php ($form_type == 'edit') ? $row->name : ''; ?>" placeholder="Input Fullname" required />
      </div>

      <div class="form-group">
        <label for="email2">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Input Password" required>
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
            $.refresh('table-user');
          } else {
            $.notify(e.message, 'error');
            window.location.href = e.redirect;
          }
        }
      });
    });
  });
</script>