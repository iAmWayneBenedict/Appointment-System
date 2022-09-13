<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<div class="login-con" style="width: 100%;">
    <div class="card border-0" style="width: 25rem;">
        <div class="card-body">
            <h5 class="mb-5">
                <b>Login</b>
            </h5>
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
            <form action="<?= base_url('user/login-user') ?>" method="post" id="form-login" class="ml-4">
                <div class="mb-3">
                    <label for="user_id" class="form-label">User ID</label>
                    <input type="text" class="form-control" id="user_id" name="user_id" placeholder="User ID">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div>
                    <input type="checkbox" name="show-password" id="show-password">
                    <label for="show-password">Show Password</label>
                </div>
                <input type="submit" class="btn btn-primary mt-5 my-3 rounded-5 py-2" value="Login" />
                <center>
                    <span>Already have an account?</span>
                    <a href="<?= base_url("/user/register") ?>" class="text-decoration-none text-primary">
                        <b>Register</b>
                    </a>
                </center>
            </form>
        </div>
    </div>
</div>
<script>
    $(() => {
        $('#show-password').change(function(event) {
            if ($(this).is(':checked')) {
                $("#password").attr('type', 'text')
            } else {
                $("#password").attr('type', 'password')

            }
        })
    })
</script>
<?= $this->endSection() ?>