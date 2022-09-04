<?= $this->extend('layouts/main_layouts') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="mt-3 mb-5">
        <h2>Send Message</h2>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Send Message</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex">
        <div class="spread-container" style="padding-right: 7rem; border-right: 1px solid rgba(0, 0, 0, 0.3)">
            <h4>SMS</h4><br>
            <form action="<?= base_url('/test-sms') ?>" method="post">

                <div class="mb-3">
                    <label for="to_number" class="form-label">Recipient Number</label>
                    <input type="text" class="form-control" id="to_number" name="to_number" placeholder="+63 plus 10 digit number">
                </div>
                <!-- <textarea name="message" id="" cols="30" rows="10" placeholder="Message here"></textarea> -->
                <div class="">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" name="message" placeholder="Message here" id="message" style="height: 10rem"></textarea>
                </div>
                <input type="submit" class="btn btn-primary mt-4" value="Send">
            </form>
        </div>
        <div class="spread-container" style="padding-left: 7rem;">
            <h4>Email</h4><br>
            <form action="<?= base_url('/test-sms') ?>" method="post">

                <div class="mb-3">
                    <label for="to_number" class="form-label">To</label>
                    <input type="text" class="form-control" id="to_number" name="to_number" placeholder="Recipient Email">
                </div>
                <!-- <textarea name="message" id="" cols="30" rows="10" placeholder="Message here"></textarea> -->
                <div class="">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" name="message" placeholder="Message here" id="message" style="height: 10rem"></textarea>
                </div>
                <input type="submit" class="btn btn-primary mt-4" value="Send">
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>