<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<div class="center-con" style="width: 100%;">
    <div class="card border-0" style="width: 25rem;">
        <div class="card-body">
            <img src="<?= base_url('/src/img/Logo Center.svg') ?>" alt="">
            <div class="d-flex flex-column mt-5">
                <a href="" class="btn btn-primary mt-3 rounded-5">User</a>
                <a href="" class="btn btn-primary mt-3 rounded-5">Employee</a>
                <a href="" class="btn btn-primary mt-3 rounded-5">Barangay Council</a>
                <a href="" class="btn btn-primary mt-3 rounded-5">Admin</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>