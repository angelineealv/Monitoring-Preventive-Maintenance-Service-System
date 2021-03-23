<footer class="footer">
    <div class="container-fluid">
        <div class="copyright ml-auto">
            <?= date("Y") ?> | <a href="<?= base_url("transaksi") ?>">PO CABANG</a>
        </div>
    </div>
</footer>
<div class="modal" id="modalDateEst" class="close close-mod" tabindex="-1" role="dialog" aria-labelledby="modalDateEst" aria-hidden="true"></div>
<script src="<?= base_url("assets/plugins/select2/select2.full.min.js") ?>"></script>
<script src="<?= base_url("assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js") ?>"></script>
<script src="<?= base_url("assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js") ?>"></script>
<script src="<?= base_url("assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js") ?>"></script>
<script src="<?= base_url("assets/plugins/moment/moment.min.js") ?>"></script>
<script src="<?= base_url("assets/js/plugin/sweetalert/sweetalert.min.js") ?>"></script>
<script>
    $(document).ready(function() {
        $('#modalDateEst').modal({
            show: false,
            backdrop: 'static',
            keyboard: false
        });
        $('#disabled-button').tooltip();
        $('.tooltip-button').tooltip();
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });
        // $('.scrollbar-inner').scrollbar();

        var t = false
        $('.numcheck').focus(function() {
            var $this = $(this)
            t = setInterval(
                function() {
                    if ($this.val() < 1 && $this.val().length != 0) {
                        if ($this.val() < 1) {
                            $this.val(1)
                        }
                    }
                }, 50)
        });
        $('.numcheck').blur(function() {
            if (t != false) {
                window.clearInterval(t)
                t = false;
            }
        });
        $(".formatnum").on('keyup', function() {
            var n = parseInt($(this).val().replace(/\D/g, ''), 10);
            $(this).val(n.toLocaleString());
        });
        $('.numericinpt').keyup(function() {
            if (!this.value.match(/^(\d|,)+$/)) {
                this.value = this.value.replace(/[^0-9.]/g, '');
            }
        });
    });

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
<script src="<?= base_url("assets/js/atlantis.min.js") ?>"></script>