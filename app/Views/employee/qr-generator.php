<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<div class="login-con" style="width: 100%;">
    <div class="card border-0" style="width: 25rem;">
        <div class="card-body">
            <h5 class="mb-5">
                <b>QR Code</b>
            </h5>
            <div id="qr-code"></div>
            <br><br><br><br>
            <form action="">
                <input type="text" name="q" id="qr-data" />
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url("/src/js/qrcode.min.js") ?>"></script>
<script>
    let qrForm = document.querySelector("form");
    let qrCode = new QRCode(document.getElementById("qr-code"));
    qrForm.addEventListener("submit", generateQr);

    function generateQr(event) {
        event.preventDefault();

        // let data = new FormData(qrForm);
        // let obj = {};
        // for (const [key, value] of data.entries()) {
        // 	obj = { ...obj, key: value };
        // }
        // console.log(obj);
        qrCode.makeCode(document.querySelector("#qr-data").value); // admin scan
    }
</script>
<?= $this->endSection() ?>