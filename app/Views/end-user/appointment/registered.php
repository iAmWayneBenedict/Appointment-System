<?= $this->extend('layouts/user_layouts') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div>
        <div class="pb-5">
            <h3 class="font-recoleta fw-bold">Appointment Registration</h3>
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('/user/dashboard/') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Appointment Registration</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="main">
        <div class="mb-5 me-md-5">
            <form action="" method="post" class="d-flex flex-md-row flex-column align-items justify-content-between gap-5" id="form-submit">
                <div class="flex-fill">
                    <div class="pb-3">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Name" value="<?= $userData->fname; ?>" readonly>
                    </div>
                    <div class="pb-3">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Name" value="<?= $userData->lname; ?>" readonly>
                    </div>
                    <div class="pb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="<?= $userData->address; ?>" id="address" placeholder="address" readonly>
                    </div>
                    <div class="pb-3">
                        <label for="social_pos" class="form-label">Social Position</label>
                        <input type="text" class="form-control" name="social_pos" value="<?= $userData->social_pos; ?>" id="social_pos" placeholder="Social Position" readonly>
                    </div>
                    <div class="pb-3">
                        <label for="c_number" class="form-label">Contact number</label>
                        <input type="text" class="form-control" name="c_number" value="<?= $userData->contact_number; ?>" id="c_number" placeholder="Contact Number" readonly>
                    </div>
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

                </div>

                <div class="d-flex flex-column flex-fill">
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
                        <label for="remark" class="form-label">Remarks</label>
                        <textarea class="form-control" name="remark" id="remark" cols="30" rows="5" placeholder="Remarks"></textarea>
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
        const url = document.querySelector("meta[name = base_url]").getAttribute("content");
        // submit appointment
        $('#form-submit').submit(function(e) {
            e.preventDefault();


            const formdata = new FormData($(this)[0]);
            if ($('#purpose').val() == 'other') {
                formdata.set('purpose', $('#concern').val());
                formdata.delete('concern')
            }
            const user_type = 001
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
                },
                success: function(response) {
                    setTimeout(function() {
                        if (response.code == 0) {
                            var msg = []; //hold all error messages

                            //loop error message and push to array
                            $.each(response.errors, function(key, val) {
                                msg.push(`${val}`)
                            });

                            alert(msg.toString()) //sweet alert
                            $("#appointment-submit").removeAttr('disabled');
                            $("#appointment-submit").val('SUBMIT');
                            return;
                        }

                        alert(response.msg)
                        location.reload()
                    }, 2000)
                }
            });

        });
    });
</script>
<?= $this->endSection() ?>