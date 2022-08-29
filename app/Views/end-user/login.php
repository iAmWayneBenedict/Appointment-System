<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<?php
if (session()->has('form-error')) {
    foreach (session('form-error')->getErrors() as $error) {
?>
        <div class="alert alert-danger m-1" role="alert">
            <?= $error; ?>
        </div>
    <?php
    }
} else if (session()->has('invalid')) {
    ?>
    <div class="alert alert-danger m-1" role="alert">
        <?= session('invalid'); ?>
    </div>
<?php
}
?>

<div class="login-con" style="width: 100%;">
    <div class="card border-0" style="width: 25rem;">
        <div class="card-body">
            <h5 class="mb-5">
                <b>Login</b>
            </h5>
            <form action="<?= base_url('user/login-user') ?>" method="post" id="form-login" class="ml-4">
                <div class="mb-3">
                    <label for="user_id" class="form-label">User ID</label>
                    <input type="text" class="form-control" id="user_id" name="user_id" placeholder="User ID">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <input type="submit" class="btn btn-primary mt-3 rounded-5" value="Login" />

            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>