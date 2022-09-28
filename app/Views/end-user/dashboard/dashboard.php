<?= $this->extend('layouts/user_layouts') ?>
<?= $this->section('content') ?>
<div class="main-content mb-5">
    <div class="greetings mt-4">
        <h1>Good morning</h1>
        <h1>User</h1>
    </div>
    <a href="<?= base_url("/user/dashboard/set-appointment") ?>" class="add-appointment-btn btn btn-primary my-5 center-vertical" style="width:fit-content">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        <span class="ms-2">Make an Appointment</span>
    </a>

    <!-- upcoming appointments section -->

    <div>
        <?php
        if ($myAppointment) {
        ?>
            <div class="passed-appointments my-5">
                <h5>You have unattened appointments!</h5>
                <p>Click the button below to reschedule</p>
                <a href="<?= base_url('user/dashboard/passed-appointment') ?>" class="btn btn-warning">Unattened Appointments</a>
            </div>
        <?php
        }
        ?>
        <div class="d-flex justify-content-between">
            <h3 class="fw-semibold font-recoleta">Upcoming Appointments</h3>
            <!-- <a href="" class="text-decoration-none">See all</a> -->
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 g-4 mt-1 mx-0" style="max-width: 99%;">
            <!-- Appointments Card -->

            <?php
            $employee_incharge_counter = 0;
            $employee_incharge = '';

            $myAppointment = $approved['myAppointment'];
            $allIncharge = $approved['allIncharge'];
            foreach ($myAppointment as $user) {

                foreach ($allIncharge as $employee) {
                    if ($user->purpose !== $employee->incharge_to) continue;

                    $employee_incharge = $employee->name;
                    $employee_incharge_counter++;
                }
            ?>
                <div class="col p-0 p-sm-1" data-id="<?= $user->id ?>">
                    <div class="card h-100">
                        <div class="card-body justify-content-between d-flex">
                            <div class="d-flex flex-column" style="width: 100%;">
                                <div class="d-flex justify-content-between my-2 me-3">

                                    <!-- employee name and role -->

                                    <div>
                                        <?php
                                        if ($employee_incharge) {
                                        ?>
                                            <h5 class="card-title m-0 fw-semibold font-recoleta"><?= $employee_incharge ?></h5>
                                            <p class="card-text"><?= $employee->designation ?></p>
                                        <?php
                                        } else {
                                        ?>
                                            <h5 class="card-title m-0 fw-semibold font-recoleta">Proceed to walk in based on the given date</h5>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php
                                if ($employee_incharge_counter - 1 > 0) {
                                ?>
                                    <small class="fw-semibold text-primary">and <?= $employee_incharge_counter - 1 ?> other people</small>
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
                $employee_incharge_counter = 0;
            }
            ?>
        </div>
    </div>

    <!-- pending appointments section -->

    <div class="mt-5">
        <div class="d-flex justify-content-between">
            <h3 class="fw-semibold font-recoleta">Pending Appointments</h3>
            <!-- <a href="" class="text-decoration-none">See all</a> -->
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 g-4 mt-1 mx-0" style="max-width: 99%;">
            <!-- Appointments Card -->
            <?php
            $employee_incharge_counter = 0;
            $employee_incharge = '';

            $myAppointment = $pending['myAppointment'];
            $allIncharge = $pending['allIncharge'];
            foreach ($myAppointment as $user) {

                foreach ($allIncharge as $employee) {
                    if ($user->purpose !== $employee->incharge_to) continue;

                    $employee_incharge = $employee->name;
                    $employee_incharge_counter++;
                }
            ?>
                <div class="col p-0 p-sm-1" data-id="<?= $user->id ?>">
                    <div class="card h-100">
                        <div class="card-body justify-content-between d-flex">
                            <div class="d-flex flex-column" style="width: 100%;">
                                <div class="d-flex justify-content-between my-2 me-3">

                                    <!-- employee name and role -->

                                    <div>
                                        <h5 class="card-title m-0 fw-semibold font-recoleta"><?= $employee_incharge ?></h5>
                                        <p class="card-text"><?= $employee->designation ?></p>
                                    </div>
                                </div>
                                <?php
                                if ($employee_incharge_counter - 1 > 0) {
                                ?>
                                    <small class="fw-semibold text-primary">and <?= $employee_incharge_counter - 1 ?> other people</small>
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
                $employee_incharge_counter = 0;
            }
            ?>
        </div>
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