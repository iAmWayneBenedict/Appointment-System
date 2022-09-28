<?= $this->extend('layouts/user_layouts') ?>
<?= $this->section('content') ?>
<div class="main-content mb-5">
    <div>
        <div class="pb-5">
            <h3 class="font-recoleta fw-bold">Passed Appointments</h3>
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('/user/dashboard/') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Passed Appointments</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="d-flex flex-wrap gap-5">
        <?php
        $index = 0;
        if ($myAppointment) {
            foreach ($myAppointment as $appointment) {
                $index++
        ?>
                <form action="" method="post" class="form-submit" style="width:30rem">
                    <div class="pb-3 d-flex justify-content-between">
                        <h1 class="font-recoleta fw-bold">Appointment ID #<?= $appointment->id ?></h1>
                        <input type="text" class="form-control" name="id" value="<?= $appointment->id ?>" id="id" hidden>
                    </div>
                    <div class="pb-3">
                        <label for="purpose" class="form-label">Purpose</label>
                        <input type="text" class="form-control" name="purpose" value="<?= $appointment->purpose ?>" id="purpose" readonly>
                    </div>
                    <div class="pb-3">
                        <label for="old-schedule" class="form-label">Old Schedule</label>
                        <input type="text" class="form-control" name="old-schedule" value="<?= $appointment->schedule ?>" id="old-schedule" readonly>
                    </div>
                    <div class="">
                        <label for="new-sched" class="form-label">Reschedule</label><br>
                        <input type="text" hidden class="form-control" id="new-sched" name="new-sched" required>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $index ?>">
                            Select Date
                        </button>
                        <br>
                        <br>
                        <div class="pb-1 selected-date-con d-none">
                            <label for="selected-date" class="form-label">Selected Date</label><br>
                            <input type="text" disabled class="form-control selected-date" id="selected-date" name="selected-date">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <input type="submit" class="btn btn-primary" value="Resched">
                        <a href="<?= base_url("user/dashboard/delete-passed-appointment/{$appointment->id}") ?>" class="btn btn-danger">Remove</a>
                        <a href="<?= base_url("user/dashboard/delete1-passed-appointment/{$appointment->id}") ?>" class="btn btn-success">Already Done</a>
                    </div>

                    <!-- modal -->
                    <div class="modal fade" id="exampleModal<?= $index ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Choose a date</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex justify-content-center">
                                    <div class="calendar flex-fill" style="max-width: 25rem;">
                                        <div class="calendar-grid m-0 p-0 calendar-set-appointment">
                                            <div class="w-full">
                                                <div class="d-flex justify-content-between">
                                                    <button type="button" class="btn prev-month">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
                                                            <line x1="19" y1="12" x2="5" y2="12"></line>
                                                            <polyline points="12 19 5 12 12 5"></polyline>
                                                        </svg>
                                                    </button>
                                                    <h3 class="fw-semibold calendar-title">January</h3>
                                                    <button type="button" class="btn next-month">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                                            <polyline points="12 5 19 12 12 19"></polyline>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="calendar-con">
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Sun</th>
                                                            <th scope="col">Mon</th>
                                                            <th scope="col">Tue</th>
                                                            <th scope="col">Wed</th>
                                                            <th scope="col">Thu</th>
                                                            <th scope="col">Fri</th>
                                                            <th scope="col">Sat</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="days-entries">

                                                    </tbody>
                                                </table>
                                                <div class="d-flex flex-column align-items-center">
                                                    <div style="width: fit-content;">
                                                        <h4 class="fw-semibold">Time</h4>
                                                    </div>
                                                    <div class="d-flex gap-3 align-items-center" style="max-width: 15rem;">
                                                        <select class="form-select text-center hour">
                                                            <option value="07">7</option>
                                                            <option value="08">8</option>
                                                            <option value="09">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="13">1</option>
                                                            <option value="14">2</option>
                                                            <option value="15">3</option>
                                                        </select>
                                                        <span>:</span>
                                                        <select class="form-select text-center minutes">
                                                            <option value="00">00</option>
                                                            <option value="15">15</option>
                                                            <option value="30">30</option>
                                                            <option value="45">45</option>
                                                        </select>
                                                        <div class="datetime">
                                                            pm
                                                        </div>
                                                    </div>
                                                    <!-- <div class="spinner-border text-primary mt-3" style="width: 20px; height: 20px" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <div class="alert text-danger py-2" role="alert">
                                        <small>asd</small>
                                    </div> -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <div>
                                        <small><b>Legend:</b></small>
                                        <div class="d-flex align-items-center" role="alert">
                                            <span class="bg-danger rounded-circle" style="width: 10px; height: 10px;"></span>
                                            <small class="ms-2">
                                                Cannot set appointment
                                            </small>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary save-date-btn">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            <?php
            }
        } else {
            ?>
            <div class="d-flex justify-content-center w-100">
                <h3 class="text-muted text-center">No passed appointments</h3>
            </div>
        <?php } ?>
    </div>
</div>
<script src="<?= base_url('/src/js/calendar.js') ?>"></script>
<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute("content");

        $('.form-submit').each(function() {
            $(this).submit(function(e) {
                e.preventDefault();
                const formdata = $(this).serializeArray()
                console.log(formdata)
                $.ajax({
                    type: "post",
                    url: `${url}/user/dashboard/reschedule-appointment`,
                    data: {
                        id: formdata[0].value,
                        new_sched: formdata[3].value,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.code == 500) {
                            alert(response.msg)
                            return
                        } else if (response.code == 0) {
                            alert(response.msg)
                        }

                        location.reload()
                    }
                });
            });
        })


    })
</script>
<?= $this->endSection() ?>