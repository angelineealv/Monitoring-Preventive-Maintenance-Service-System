<div class="card scrollbar-inner">
  <form action="<?= base_url(uri_string() . "/process") ?>" method="post">

    <div class="card-action">
      <a href="<?= base_url("master/user") ?>" class="btn btn-sm btn-danger"><i class="fas fa-reply"></i>&nbsp;&nbsp; Back</a>
      <?php if (@$formtype != "edit") { ?>
        <button type="reset" class="btn btn-warning float-right"><i class="fas fa-redo-alt"></i>&nbsp;&nbsp;Reset</button>
        <button type="submit" name="submit" class="btn btn-primary btn-simpan float-right btn-add"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to Cart</button>
        <button type="button" name="submit" class="btn btn-primary btn-simpan float-right btn-tonase" onclick="CekTonase()"><i class="fas fa-search"></i>&nbsp;&nbsp;Hitung Tonase</button>&nbsp;&nbsp;
      <?php } else { ?>
        <button type="reset" class="btn btn-warning float-right"><i class="fas fa-redo-alt"></i>&nbsp;&nbsp;Reset</button>
        <button type="submit" name="submit" class="btn btn-primary btn-simpan float-right btn-edit"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
        <button type="button" name="submit" class="btn btn-primary btn-simpan float-right btn-tonase-edit" onclick="CekTonaseEdit()"><i class="fas fa-search"></i>&nbsp;&nbsp;Hitung Tonase</button>&nbsp;&nbsp;
      <?php } ?>
    </div>

    <div class="card-body">
      <div class="form-group">
        <label for="email2">Code</label>
        <input type="hidden" name="id" value="<?= @$detcart["cartid"] ?>" />
        <input type="hidden" name="dt[weight]" id="weight" <?php if (@$formtype != "edit") { ?> value="<?= @$detprod["productweight"] ?>" <?php } else { ?> value="<?= $detcart["productweight"] ?>" <?php } ?> />
        <input type="hidden" class="form-control" name="dt[productid]" <?php if (@$formtype != "edit") { ?> value="<?= @$detprod["productid"] ?>" <?php } else { ?> value="<?= $detcart["productid"] ?>" <?php } ?> />

        <input type="text" class="form-control" name="dt[productcode]" <?php if (@$formtype != "edit") { ?> value="<?= @$detprod["productcode"] ?>" <?php } else { ?> value="<?= $detcart["productcode"] ?>" <?php } ?> placeholder="Input Code" readonly required />
      </div>

      <div class="form-group">
        <label for="email2">Product</label>
        <input type="text" class="form-control" name="dt[productname]" <?php if (@$formtype != "edit") { ?> value="<?= @$detprod["productname"] ?>" <?php } else { ?> value="<?= $detcart["productname"] ?>" <?php } ?> placeholder="Input Product Name" readonly required />
      </div>

      <div class="form-group">
        <label for="email2">Brand</label>
        <input type="text" class="form-control" name="dt[brand]" <?php if (@$formtype != "edit") { ?> value="<?= @$detprod["brand"] ?>" <?php } else { ?> value="<?= $detcart["brand"] ?>" <?php } ?> placeholder="Input Brand" readonly required>
      </div>

      <div class="form-group">
        <label for="email2">Quantity</label>
        <input type="text" class="form-control numcheck qty-cek" id="qtyS" name="dt[qty]" <?php if (@$formtype != "edit") { ?> value="1" <?php } else { ?> value="<?= intval($detcart["qty"]) ?>" <?php } ?> placeholder="Input Quantity" onkeypress="return isNumberKey(event)" required>
      </div>
      <div class="form-group">
        <label for="email2">UOM</label>
        <select name="dt[uomid]" id='selUom' class="form-control" />
        <option value="">-- Select UOM --</option>
        <?php if (@$formtype == "edit") { ?>
          <option value='<?= $detcart["uomid"] ?>' selected /> <?= $detcart["uom"] ?> </option>
        <?php } ?>
        </select>
        <input type="hidden" id="uomid">
        <input type="hidden" name="dt[ratio]" id="ratio">
      </div>
      <div class="form-group">
        <label for="email2">Tonase</label>
        <input type="text" id="tonaseh" class="form-control" name="dt[tonase]" <?php if (@$formtype != "edit") { ?> value="" <?php } else { ?> value="<?= @$detcart["tonase"] ?>" <?php } ?> readonly required>
      </div>
      <div class="form-group">
        <label for="email2">Current Stock</label>
        <input type="text" class="form-control numcheck" name="dt[currentstock]" <?php if (@$formtype != "edit") { ?> value="1" <?php } else { ?> value="<?= @intval($detcart["currentstock"]) ?>" <?php } ?> placeholder="Input Current Stock" onkeypress="return isNumberKey(event)" required>
      </div>
      <div class="form-group">
        <label for="email2">Min Stock</label>
        <input type="text" class="form-control numcheck" name="dt[minstock]" <?php if (@$formtype != "edit") { ?> value="1" <?php } else { ?> value="<?= @intval($detcart["minstock"]) ?>" <?php } ?> placeholder="Input Min Stock" onkeypress="return isNumberKey(event)" required>
      </div>
      <div class="form-group">
        <label for="email2">Max Stock</label>
        <input type="text" class="form-control numcheck" name="dt[maxstock]" <?php if (@$formtype != "edit") { ?> value="1" <?php } else { ?> value="<?= @intval($detcart["maxstock"]) ?>" <?php } ?> placeholder="Input Max Stock" onkeypress="return isNumberKey(event)" required>
      </div>
      <div class="form-group">
        <label for="email2">Rata rata Penjualan</label>
        <input type="text" class="form-control numcheck formatnum" name="dt[rataratapenjualan]" <?php if (@$formtype != "edit") { ?> value="1" <?php } else { ?> value="<?= @number_format($detcart["rataratapenjualan"]) ?>" <?php } ?> onkeypress="return isNumberKey(event)" placeholder="Input Rata rata Penjualan" required>
      </div>
      <div class="form-group">
        <label for="email2">NPWP</label>
        <input type="text" class="form-control npwp" oblur="return formatNpwp(value)" required>
      </div>

      <div class="form-group">
        <label for="email2">NPWP User</label>
        <input type="text" class="form-control npwp" oblur="return formatNpwp(value)" required>
      </div>
      <div class="form-group">
        <label for="email2">Description</label>
        <textarea class="form-control" name="dt[description]" rows="5"><?= @$detcart["description"] ?></textarea>
      </div>
    </div>
  </form>
</div>