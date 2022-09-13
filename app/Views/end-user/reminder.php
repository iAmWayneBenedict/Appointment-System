<?= $this->extend("layouts/layout") ?>
<?= $this->section('content') ?>

<div class="container-fluid px-5 nav-con mt-5">
    <div class="px-3">
        <div>
            <h2 class="card-title" style="font-weight: 600;">Reminder</h2>
            <div class=" d-flex justify-content-center" style="width: 100%;">
                <div class="card border-0" style="width: 30rem;">
                    <div class="card-body">
                        <div class="center-con flex-column mt-4">
                            <span>User ID</span>
                            <h1 style="font-weight: 600;"><?= $user_informations['id'] ?></h1>
                            <span class="alert alert-info d-flex align-items-center bg-transparent border-0 p-0 text-primary" style="font-size: 14px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                                <span class="ms-2">Please take note of your User ID</span>
                            </span>
                            <div class="d-flex justify-content-evenly mt-4" style="width: 100%">
                                <div>
                                    <span>Name</span>
                                    <h4><?= $user_informations['name'] ?></h4>
                                </div>
                                <div>
                                    <span>Identity</span>
                                    <h4><?= $user_informations['identity'] ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="<?= base_url('user/login') ?>" class="btn btn-primary mt-5">Login Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?= $this->endSection() ?>