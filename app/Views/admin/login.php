<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<div class="login-con" style="width: 100%;">
    <div class="card border-0" style="width: 25rem;">
        <div class="card-body">
            <h5 class="mb-5">
                <b>Login</b>
            </h5>
            <form action="<?= base_url('admin/admin-login') ?>" method="post" id="form-login" class="ml-4">

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control pass" id="password" name="password" placeholder="Password">
                </div>
                <input type="submit" class="btn btn-primary mt-5 my-3 rounded-5 py-2" value="Login" />
            </form>
        </div>
    </div>
</div>
<?php
    if (session()->has('invalid')) {
        ?>
        <script type="text/javascript">
            $('.pass').css({
                'border-color': 'red'
            })
        </script>
    <?php
    }
?>
<?= $this->endSection() ?>