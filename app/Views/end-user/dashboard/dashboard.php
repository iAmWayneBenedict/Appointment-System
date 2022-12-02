<?= $this->extend('layouts/user_layouts') ?>
<?= $this->section('content') ?>
<div class="main-content mb-5">
    <div class="greetings mt-4">

        <h1>Good <?php
                    if (date("H:i") < '12:00')
                        echo 'morning';
                    else if (date("H:i") >= '12:00' && date("H:i") < '18:00')
                        echo 'afternoon';
                    else
                        echo 'evening';

                    ?></h1>
        <h1><?= $user->fname ?></h1>
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
            $employee_designation_counter = 0;
            $employee_designation = '';

            $myAppointment = $approved['myAppointment'];
            $allIncharge = $approved['allIncharge'];
            if ($myAppointment) {
                $hasFoundEmp = false;
                $empIncharge = null;
                foreach ($myAppointment as $user) {

                    foreach ($allIncharge as $employee) {
                        if ($user->purpose !== $employee->incharge_to) continue;
                        $empIncharge = $hasFoundEmp ? $empIncharge : $employee->name;
                        $hasFoundEmp = true;
                        $employee_designation_counter++;
                    }
            ?>
                    <div class="col p-0 p-sm-1" data-id="<?= $user->id ?>">
                        <div class="card h-100">
                            <div class="card-body justify-content-between d-flex">
                                <div class="d-flex flex-column" style="width: 100%;">
                                    <div class="d-flex justify-content-between my-2 me-3">

                                        <!-- employee name and role -->

                                        <div>
                                            <h5 class="card-title m-0 fw-semibold"><?= $hasFoundEmp ? $empIncharge : "Municipal Agriculture Office of Bato" ?></h5>
                                        </div>
                                    </div>
                                    <?php
                                    $employee_designation = '';
                                    if ($employee_designation_counter - 1 > 0) {
                                    ?>
                                        <small class="fw-semibold text-primary">and <?= $employee_designation_counter - 1 ?> other employee</small>
                                    <?php
                                    }
                                    ?>
                                    <br>
                                    <div class="fw-semibold position-relative">
                                        <span class="position-absolute" style="width: 10px; height:10px; border-radius:50%; background:blue; top:7px"></span>
                                        <span class="ms-4"><?= $user->purpose ?></span>
                                    </div>
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
            } else {
                ?>
                <div style="width:100%">
                    <center>
                        <h4 class="text-secondary">No Upcoming Appointments</h4>
                        <lottie-player src="https://assets7.lottiefiles.com/datafiles/AXZrSWB3sH4av1w/data.json" background="transparent" speed="1" style="width: 100%; max-width: 15rem; height: 100%; max-height: 15rem" autoplay></lottie-player>
                    </center>
                </div>
            <?php
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
            $employee_designation_counter = 0;
            $employee_designation = '';

            $myAppointment = $pending['myAppointment'];
            $allIncharge = $pending['allIncharge'];
            if ($myAppointment) {
                $hasFoundEmp = false;
                $empIncharge = null;
                foreach ($myAppointment as $user) {

                    foreach ($allIncharge as $employee) {
                        if ($user->purpose !== $employee->incharge_to) continue;
                        $empIncharge = $hasFoundEmp ? $empIncharge : $employee->name;
                        $hasFoundEmp = true;
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
                                            <h5 class="card-title m-0 fw-semibold"><?= $hasFoundEmp ? $empIncharge : "Municipal Agriculture Office of Bato" ?></h5>
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
                                    <br>
                                    <div class="fw-semibold position-relative">
                                        <span class="position-absolute" style="width: 10px; height:10px; border-radius:50%; background:blue; top:7px"></span>
                                        <span class="ms-4"><?= $user->purpose ?></span>
                                    </div>
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
            } else {
                ?>
                <div style="width:100%">
                    <center>
                        <h4 class="text-secondary">No Pending Appointments</h4>
                        <lottie-player src="https://assets7.lottiefiles.com/datafiles/AXZrSWB3sH4av1w/data.json" background="transparent" speed="1" style="width: 100%; max-width: 15rem; height: 100%; max-height: 15rem" autoplay></lottie-player>
                    </center>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute('content')
        document.addEventListener("DOMContentLoaded", () => {
            console.log("DOM ready!");
        });
        console.log(1)
        document.addEventListener("load", () => {
            console.log("DOM images!");
        });

        $('.col').each(function() {
            $(this).click(function() {
                location.href = url + "/user/dashboard/appointment-details/" + $(this).data('id')
            })
        })
    })
</script>
<?= $this->endSection() ?>