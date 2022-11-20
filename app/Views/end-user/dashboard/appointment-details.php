<?= $this->extend('layouts/user_layouts') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div>
        <div class="pb-5">
            <h3 class="font-recoleta fw-bold">Appointment Details</h3>
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('/user/dashboard/') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Appointment Details</li>
                </ol>
            </nav>
        </div>
    </div>
    <?php
    if (isset($pending)) {
        $isOtherPurpose = true;
        foreach ($allIncharge as $incharge) {
            if ($incharge->incharge_to === $pending[0]->purpose) {
                $isOtherPurpose = false;
            }
        }
    ?>
        <div class="main">
            <div class="mb-5 me-md-5">
                <form action="" method="post" class="d-flex flex-md-row flex-column align-items justify-content-between gap-5" id="form-submit">
                    <div class="flex-fill">
                        <div class="pb-3">
                            <h6>Status</h6>
                            <p class="btn btn-warning rounded-5">Pending</p>
                        </div>
                        <div class="pb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="name" class="form-control" id="name" name="name" placeholder="Name" value="<?= $pending[0]->name; ?>" readonly>
                        </div>
                        <div class="pb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" value="<?= $pending[0]->address; ?>" id="address" placeholder="address" readonly>
                        </div>
                        <div class="pb-3">
                            <label for="social_pos" class="form-label">Social Position</label>
                            <input type="text" class="form-control" name="social_pos" value="<?= $pending[0]->social_pos; ?>" id="social_pos" placeholder="Social Position" readonly>
                        </div>
                        <div class="pb-3">
                            <label for="c_number" class="form-label">Contact number</label>
                            <input type="text" class="form-control" name="c_number" value="<?= $pending[0]->contact_number; ?>" id="c_number" placeholder="Contact Number" readonly>
                        </div>
                        <div class="pb-3">
                            <label for="purpose" class="form-label">Purpose</label>
                            <select class="form-select" name="purpose" id="purpose">
                                <?php
                                $filteredData = [];
                                foreach ($allIncharge as $incharge) {
                                    array_push($filteredData, $incharge->incharge_to);
                                }
                                $filteredData = array_unique($filteredData);
                                foreach ($filteredData as $value) {
                                ?>

                                    <option value="<?= $value ?>" <?= $pending[0]->purpose === $value ? 'selected=selected' : '' ?>><?= $value ?></option>

                                <?php

                                }
                                ?>
                                <option value="other" <?= $isOtherPurpose ? "selected=selected" : '' ?>>Other</option>
                            </select>
                        </div>

                    </div>

                    <div class="d-flex flex-column flex-fill">

                        <div class="pb-1">
                            <h6 class="mb-3">Person(s) in-charge of purpose</h6>
                            <div class="person-incharge-con">

                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="concern" class="form-label">Other Concerns</label>
                            <textarea class="form-control" name="concern" id="concern" cols="30" rows="10" disabled><?= $isOtherPurpose ? $pending[0]->purpose : '' ?></textarea>
                        </div>

                        <div class="">
                            <label for="sched" class="form-label">Schedule</label><br>
                            <input type="text" hidden class="form-control" id="sched" name="sched" value="<?= $pending[0]->schedule ?>">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Select Date
                            </button>
                            <br>
                            <br>
                            <div class="pb-1 selected-date-con">
                                <label for="selected-date" class="form-label">Selected Date</label><br>
                                <input type="text" disabled class="form-control selected-date" value="<?= date_format(date_create($pending[0]->schedule), 'D, F j, Y g:i a') ?>" id="selected-date" name="selected-date">
                            </div>
                        </div>
                        <div class="mt-5 d-flex justify-content-end gap-3">
                            <input type="hidden" name="id" class="pending_id" value="<?= $pending[0]->id; ?>">
                            <input type="submit" class="btn btn-primary" value="UPDATE">
                            <input type="button" class="btn btn-danger" id='remove' value="REMOVE">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php
    } else {
        $isOtherPurpose = true;
        foreach ($allIncharge as $incharge) {
            if ($incharge->incharge_to === $approved[0]->purpose) {
                $isOtherPurpose = false;
            }
        }
    ?>
        <div class="main">
            <div class="mb-5 me-md-5">
                <form action="" method="post" class="d-flex flex-md-row flex-column align-items justify-content-between gap-5" id="form-submit">
                    <div class="flex-fill">
                        <div class="pb-3">
                            <h6>Status</h6>
                            <p class="btn btn-success rounded-5">Approved</p>
                        </div>
                        <div class="pb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="name" class="form-control" id="name" name="name" placeholder="Name" value="<?= $approved[0]->name; ?>" readonly>
                        </div>
                        <div class="pb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" value="<?= $approved[0]->address; ?>" id="address" placeholder="address" readonly>
                        </div>
                        <div class="pb-3">
                            <label for="social_pos" class="form-label">Social Position</label>
                            <input type="text" class="form-control" name="social_pos" value="<?= $approved[0]->social_pos; ?>" id="social_pos" placeholder="Social Position" readonly>
                        </div>
                        <div class="pb-3">
                            <label for="c_number" class="form-label">Contact number</label>
                            <input type="text" class="form-control" name="c_number" value="<?= $approved[0]->contact_number; ?>" id="c_number" placeholder="Contact Number" readonly>
                        </div>

                        <div class="pb-3">
                            <label for="purpose" class="form-label">Purpose</label>
                            <select class="form-select" name="purpose" id="purpose" disabled>
                                <?php
                                foreach ($allIncharge as $incharge) {
                                ?>

                                    <option value="<?= $incharge->incharge_to ?>" <?= $approved[0]->purpose === $incharge->incharge_to ? 'selected=selected' : '' ?>><?= $incharge->incharge_to ?></option>

                                <?php

                                }
                                ?>
                                <option value="other" <?= $isOtherPurpose ? "selected=selected" : '' ?>>Other</option>
                            </select>
                        </div>

                    </div>

                    <div class="d-flex flex-column flex-fill">

                        <div class="pb-1">
                            <h6 class="mb-3">Person(s) in-charge of purpose</h6>
                            <div class="person-incharge-con">

                            </div>
                        </div>
                        <?php
                        if ($isOtherPurpose) {
                        ?>
                            <div class="mb-4">
                                <label for="concern" class="form-label">Other Concerns</label>
                                <textarea class="form-control" name="concern" id="concern" cols="30" rows="10" readonly><?= $approved[0]->purpose ?></textarea>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="">

                            <div class="pb-1 selected-date-con">
                                <label for="selected-date" class="form-label">Selected Date</label><br>
                                <input type="text" disabled class="form-control selected-date" value="<?= date_format(date_create($approved[0]->schedule), 'D, F j, Y g:i a') ?>" id="selected-date" name="selected-date">
                            </div>
                        </div>
                        <div class="mt-5 d-flex justify-content-end gap-3">
                            <input type="hidden" name="id" class="pending_id" value="<?= $approved[0]->id; ?>">
                            <input type="button" class="btn btn-danger" id='cancel' value="CANCEL">
                        </div>
                    </div>
                </form>
            </div>
        </div><?php

            } ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <option value="08">8</option>
                                            <option value="09">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="13">1</option>
                                            <option value="14">2</option>
                                            <option value="15">3</option>
                                            <option value="16">4</option>
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

</div>
<script src="<?= base_url('/src/js/calendar.js') ?>"></script>
<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute('content')
        const old_date = $('#selected-date').val();
        const purpopse = $('#purpose').val();

        $('#form-submit').submit(function(e) {
            e.preventDefault();

            //if nothing change do not update
            if (old_date == $('#selected-date').val() && purpopse == $('#purpose').val()) {
                Swal.fire(
                    'Nothing changed!',
                    'Information provided are not updated',
                    'info'
                ).then()
                // alert('Nothing to update')
                return
            }

            const formdata = new FormData($(this)[0]);
            if ($('#purpose').val() == 'other') {
                formdata.set('purpose', $('#concern').val());
                formdata.delete('concern')
            }

            const user_type = 001
            $.ajax({
                type: "post",
                url: `${url}/user/dashboard/edit-appointment`,
                data: formdata,
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                success: function(response) {
                    if (response.code == 0) {
                        console.log(response);
                        return;
                    }

                    Swal.fire(
                        'Submitted!',
                        response.msg,
                        'success'
                    ).then()

                    // alert(response.msg)
                    // console.log(response)
                }
            });


            for (var val of formdata) {
                console.log(`${val[0]}: ${val[1]}`)
            }

        });

        $('#cancel').click(function(e) {
            e.preventDefault();
            var id = $('.pending_id').val()
            Swal.fire({
                title: 'Are you sure?',
                text: "Your Appointment will be Canceled!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Continue!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `${url}/user/dashboard/cancel-appointment/${id}`
                }
            })
        });

        $('#remove').click(function(e) {
            e.preventDefault();
            var id = $('.pending_id').val()
            Swal.fire({
                title: 'Are you sure?',
                text: "Your Appointment will be Deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Continue!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `${url}/user/dashboard/remove-appointment/${id}`
                }
            })

        });
    });
</script>
<?= $this->endSection() ?>