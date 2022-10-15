<?= $this->extend('layouts/user_layouts') ?>
<?= $this->section('content') ?>
<div class="main-content mt-4">
    <div>
        <div class="pb-5">
            <h3 class="font-recoleta fw-bold">Pending Appointments</h3>
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('/user/dashboard/') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pending Appointments</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row row-cols-1 d-flex justify-content-center justify-content-sm-start row-cols-md-2 row-cols-xl-3 g-4 mt-1" style="max-width: 100%;">
        <!-- Appointments Card -->
        <?php
        $employee_designation_counter = 0;
        $employee_designation = '';

        $myAppointment = $pending['myAppointment'];
        $allIncharge = $pending['allIncharge'];
        foreach ($myAppointment as $user) {

            foreach ($allIncharge as $employee) {
                if ($user->purpose !== $employee->incharge_to) continue;

                $employee_designation_counter++;
            }
        ?>
            <div class="col p-0 p-sm-1" data-id="<?= $user->id ?>">
                <div class="card h-100">
                    <div class="card-body justify-content-between d-flex">
                        <div class="d-flex flex-column" style="width: 100%;">
                            <div class="d-flex justify-content-between my-2 me-3">

                                <!-- employee designatin and incharge to -->

                                <div>
                                    <h5 class="card-title m-0 fw-semibold"><?= $employee->incharge_to ?></h5>
                                    <p class="card-text"><?= $employee_designation ? $employee->incharge_to : '' ?></p>
                                </div>
                            </div>
                            <?php
                            $employee_designation = '';
                            if ($employee_designation_counter - 1 > 0) {
                            ?>
                                <small class="fw-semibold text-primary">and <?= $employee_designation_counter - 1 ?> other people</small>
                            <?php
                            }
                            ?>
                        </div>

                        <!-- options button -->

                        <div class="dropdown">
                            <button type="button" class="btn options" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- date and time scheduled -->

                    <div class="card-footer d-flex gap-4">
                        <div>
                            <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>

                            <!-- date scheduled -->

                            <small class="text-dark fw-semibold"><?= date_format(date_create($user->schedule), "F j, Y") ?></small>
                        </div>
                        <div>
                            <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>

                            <!-- time scheduled -->

                            <small class="text-dark fw-semibold"><?= date_format(date_create($user->schedule), "g:i a") ?></small>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            $employee_designation_counter = 0;
        }
        ?>
    </div>
</div>
<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute('content')
        $('.col').each(function() {
            $(this).click(function() {
                location.href = url + "/user/dashboard/appointment-details/" + $(this).data('id')
            })
        })
    })
</script>
<?= $this->endSection() ?>