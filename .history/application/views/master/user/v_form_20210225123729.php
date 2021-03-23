<div class="card scrollbar-inner">
  <form action="<?= base_url(uri_string() . "/process") ?>" method="post">

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
        <input type="hidden" name="id" value="<?php ($formtype == 'edit') ? $row->userid : '' ;" />
        <input type="hidden" name="dt[weight]" id="weight" <?php if (@$formtype != "edit") { ?> value="<?= @$detprod["productweight"] ?>" <?php } else { ?> value="<?= $detcart["productweight"] ?>" <?php } ?> />
        <input type="hidden" class="form-control" name="dt[productid]" <?php if (@$formtype != "edit") { ?> value="<?= @$detprod["productid"] ?>" <?php } else { ?> value="<?= $detcart["productid"] ?>" <?php } ?> />

        <input type="text" class="form-control" name="dt[productcode]" <?php if (@$formtype != "edit") { ?> value="<?= @$detprod["productcode"] ?>" <?php } else { ?> value="<?= $detcart["productcode"] ?>" <?php } ?> placeholder="Input Code" readonly required />
      </div>

      <div class="form-group">
        <label for="email2">Name</label>
        <input type="text" class="form-control" name="dt[productname]" <?php if (@$formtype != "edit") { ?> value="<?= @$detprod["productname"] ?>" <?php } else { ?> value="<?= $detcart["productname"] ?>" <?php } ?> placeholder="Input Product Name" readonly required />
      </div>

      <div class="form-group">
        <label for="email2">Password</label>
        <input type="text" class="form-control" name="dt[brand]" <?php if (@$formtype != "edit") { ?> value="<?= @$detprod["brand"] ?>" <?php } else { ?> value="<?= $detcart["brand"] ?>" <?php } ?> placeholder="Input Brand" readonly required>
      </div>
    </div>
  </form>
</div>