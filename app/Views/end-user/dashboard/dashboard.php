<?= $this->extend('layouts/user_layouts') ?>
<?= $this->section('content') ?>
<div class="main-content">
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
        <div class="d-flex justify-content-between">
            <h3 class="fw-semibold font-recoleta">Upcoming Appointments</h3>
            <!-- <a href="" class="text-decoration-none">See all</a> -->
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 g-4 mt-1" style="max-width: 95%;">

            <!-- Appointments Card -->

            <div class="col">
                <div class="card h-100">
                    <div class="card-body justify-content-between d-flex">
                        <div class="d-flex flex-column" style="width: 100%;">
                            <div class="d-flex justify-content-between my-2 me-3">

                                <!-- employee name and role -->

                                <div>
                                    <h5 class="card-title m-0 fw-semibold font-recoleta">Jhon Doe</h5>
                                    <p class="card-text">Secretary</p>
                                </div>

                                <!-- employee status -->

                                <div class="card-status border border-secondary rounded-5 px-2">
                                    <div></div>
                                    <small class="ms-2">Available</small>
                                </div>
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
                        <!-- <div class="d-flex gap-3">
                            <p class="btn btn-success rounded-5" style="font-size: 14px;">August 20, 2022</p>
                            <p class="btn btn-primary rounded-5" style="font-size: 14px;">8:30 am</p>
                        </div> -->
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

                            <small class="text-dark fw-semibold">August 20, 2022</small>
                        </div>
                        <div>
                            <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>

                            <!-- time scheduled -->

                            <small class="text-dark fw-semibold">8:30 am</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- pending appointments section -->

    <div class="mt-5">
        <div class="d-flex justify-content-between">
            <h3 class="fw-semibold font-recoleta">Pending Appointments</h3>
            <!-- <a href="" class="text-decoration-none">See all</a> -->
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 g-4 mt-1" style="max-width: 95%;">
            <!-- Appointments Card -->
            <div class="col">
                <div class="card h-100">
                    <div class="card-body justify-content-between d-flex">
                        <div class="d-flex flex-column" style="width: 100%;">
                            <div class="d-flex justify-content-between my-2 me-3">

                                <!-- employee name and role -->

                                <div>
                                    <h5 class="card-title m-0 fw-semibold font-recoleta">Jhon Doe</h5>
                                    <p class="card-text">Secretary</p>
                                </div>

                                <!-- employee status -->

                                <div class="card-status border border-secondary rounded-5 px-2">
                                    <div></div>
                                    <small class="ms-2">Available</small>
                                </div>
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
                        <!-- <div class="d-flex gap-3">
                            <p class="btn btn-success rounded-5" style="font-size: 14px;">August 20, 2022</p>
                            <p class="btn btn-primary rounded-5" style="font-size: 14px;">8:30 am</p>
                        </div> -->
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

                            <small class="text-dark fw-semibold">August 20, 2022</small>
                        </div>
                        <div>
                            <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>

                            <!-- time scheduled -->

                            <small class="text-dark fw-semibold">8:30 am</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>