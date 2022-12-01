<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<div class="main d-flex justify-content-center mb-5 p-4">
    <div class="mt-5" style="max-width: 30rem; width: 100%;">
        <form action="" method="post" class="d-flex flex-column" id="form-submit">
            <div class="alert alert-info mb-0" role="alert">
                You can Register to monitor your appointments and more with ease!
            </div>
            <center> To register you can click <a href="<?= base_url('/user/register') ?>">here</a></center>
            <h3 class="font-recoleta fw-bold my-5">Guest Appointment Registration</h3>
            <div class="flex-fill">
                <div class="pb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
                <!-- <div class="pb-3">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
                </div>
                <div class="pb-3">
                    <label for="mname" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name">
                </div>
                <div class="pb-3">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name">
                </div>
                <div class="pb-3">
                    <label for="suffix" class="form-label">Suffix</label>
                    <input type="text" class="form-control" id="suffix" name="suffix" placeholder="Suffix">
                </div> -->
                <div class="pb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="address">
                </div>
                <div class="pb-3">
                    <label for="social_pos" class="form-label">Social Position</label>
                    <select class="form-select" name="social_pos" id="social_pos">
                        <option value="Farmer">Farmers</option>
                        <option value="Fisherfolk">FisherFolks</option>
                        <option value="Barangay Official">Barangay Official</option>
                        <option value="Regional Staff">Regional Staff</option>
                        <option value="Business Owner">Business Owner</option>
                    </select>
                </div>
                <div class="pb-3">
                    <label for="c_number" class="form-label">Contact number <small><span class="text-danger">*</span>09xx xxx xxxx</small></label>
                    <input type="text" class="form-control" name="c_number" id="c_number" placeholder="Contact Number">
                </div>

            </div>

            <div class="d-flex flex-column flex-fill">
                <div class="pb-3">
                    <label for="purpose" class="form-label">Purpose</label>
                    <select class="form-select" name="purpose" id="purpose">
                        <option value="RSBSA (Registry System for Basic Sector in Agriculture)">RSBSA (Registry System for Basic Sector in Agriculture)</option>
                        <option value="Registration of Municipal Fisherfolks">Registration of Municipal Fisherfolks</option>
                        <option value="Processing of Crop Insurance (PCIC Program)">Processing of Crop Insurance (PCIC Program)</option>
                        <option value="Distribution of Farm Inputs">Distribution of Farm Inputs</option>
                        <option value="Boat Registration">Boat Registration</option>
                        <option value="Stocks">Stocks</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="pb-1">
                    <h6 class="mb-3">Person(s) in-charge of purpose</h6>
                    <div class="person-incharge-con">

                    </div>
                </div>
                <div class="mb-4 d-none">
                    <label for="concern" class="form-label">Other Concerns</label>
                    <textarea class="form-control" name="concern" id="concern" cols="30" rows="10" placeholder="Other Concerns" disabled></textarea>
                </div>
                <div class="">
                    <label for="sched" class="form-label">Schedule</label><br>
                    <input type="text" hidden class="form-control" id="sched" name="sched">
                    <button type="button" id="select-date" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Select Date
                    </button>
                    <br>
                    <br>
                    <div class="pb-1 selected-date-con d-none">
                        <label for="selected-date" class="form-label">Selected Date</label><br>
                        <input type="text" disabled class="form-control selected-date" id="selected-date" name="selected-date">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea class="form-control" name="remarks" id="remarks" cols="30" rows="5" placeholder="Remarks"></textarea>
                </div>
                <input type="submit" class="btn btn-primary mt-5" id="appointment-submit" value="SUBMIT">
            </div>
        </form>
    </div>
</div>
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
                            <table class="calendar-table table table-borderless">
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
                                        <option value="15">4</option>
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
<script src="<?= base_url('/src/js/calendar.js') ?>"></script>
<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute("content");
        // submit appointment
        $('#form-submit').submit(function(e) {
            e.preventDefault();


            const formdata = new FormData($(this)[0]);
            if ($('#purpose').val() == 'other') {
                formdata.set('purpose', $('#concern').val());
                formdata.delete('concern')
            }

            const user_type = 000
            $.ajax({
                type: "post",
                url: `${url}/appointments/${user_type}/submit-appointment`,
                data: formdata,
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function() {
                    // Show image container
                    //show loading gif
                    console.log("please wait....");

                    $("#appointment-submit").attr('disabled', 'disabled')
                    $("#appointment-submit").val('Please Wait......')
                    $("#preloader").modal("show");
                },
                success: function(response) {
                    setTimeout(function() {
                        $("#preloader").modal("hide");
                        if (response.code == 0) {
                            var msg = []; //hold all error messages

                            //loop error message and push to array
                            $.each(response.errors, function(key, val) {
                                msg.push(`${val}`)
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                html: msg.join('<br>'),
                            }) //sweet alert
                            $("#appointment-submit").removeAttr('disabled');
                            $("#appointment-submit").val('SUBMIT');
                            return;
                        }

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.msg,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload()
                        })

                    }, 2000)
                }
            });

        });
    });
</script>
<?= $this->endSection() ?>