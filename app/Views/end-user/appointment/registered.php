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
                        <label for="name" class="form-label">Name</label>
                        <input type="name" class="form-control" id="name" name="name" placeholder="Name" value="<?= $userData->name; ?>" readonly>
                    </div>
                    <div class="pb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="<?= $userData->address; ?>" id="address" placeholder="address" readonly>
                    </div>
                    <div class="pb-3">
                        <label for="c_number" class="form-label">Contact number</label>
                        <input type="text" class="form-control" name="c_number" value="<?= $userData->contact_number; ?>" id="c_number" placeholder="Contact Number" readonly>
                    </div>

                    <div class="pb-3">
                        <label for="social_pos" class="form-label">Social Position</label>
                        <input type="text" class="form-control" name="social_pos" value="<?= $userData->social_pos; ?>" id="social_pos" placeholder="Social Position" readonly>
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
                        <!-- <input type="datetime-local" class="form-control" id="sched" name="sched"> -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Select Date
                        </button>
                    </div>
                    <input type="submit" class="btn btn-primary mt-5" value="SUBMIT">
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choose a day</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <div class="calendar flex-fill" style="max-width: 25rem;">
                        <div class="calendar-grid m-0 p-0 calendar-set-appointment">
                            <center>
                                <div style="width: fit-content;">
                                    <h3 class="fw-semibold calendar-title">January</h3>
                                </div>
                            </center>
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                    <button type="button" disabled class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute('content')
        let date = new Date()

        function getDate(month) {
            let date = new Date();
            let firstDay = new Date(date.getFullYear(), month, 1);
            let lastDay = new Date(date.getFullYear(), month + 1, 0);

            return [firstDay.getDay() + 1, lastDay.getUTCDate()]

        }
        let month = date.getMonth()
        populateCalendar(getDate(month), month)

        function populateCalendar([firstDay, lastUTCDay], month) {
            $('.days-entries').html('')

            let allDates = ''
            let isFirstWeekDone = false;

            let openingTR = '<tr>'
            let closingTR = '</tr>'
            let currentDay = ''
            let nextThreeDaysCounter = 0;
            let isNextThreeDaysCounterStart = false;

            // populate first week of the month
            for (let index2 = 1; index2 < firstDay; index2++) {
                currentDay += '<td></td>'

                if (index2 === firstDay - 1) {
                    isFirstWeekDone = true;
                }
            }

            // populate the remaining weeks

            for (let j = firstDay, days = 1; j <= lastUTCDay + firstDay; j++, days++) {
                let currentDayOfTheWeekNumber = getCurrentDayOfTheWeek(date.getMonth(), days);
                let currentDayOfTheWeekName = convertDayToName(currentDayOfTheWeekNumber);
                if (date.getUTCDate() === days && date.getMonth() === month) {
                    // Date today
                    if (currentDayOfTheWeekName === "Sun") {
                        currentDay += '<td class="active"><a role="button" aria-disabled="true" class="disabled text-decoration-none day text-danger"><div><h6>' + days + '</h6>' + '</div></a></td>'
                    } else if (currentDayOfTheWeekName === "Sat") {
                        currentDay += '<td class="active"><a role="button" aria-disabled="true" class="disabled text-decoration-none day text-danger"><div><h6>' + days + '</h6>' + '</div></a></td>'
                    } else {
                        currentDay += '<td class="active"><a role="button" class="text-decoration-none day text-dark"><div><h6>' + days + '</h6>' + '</div></a></td>'
                    }

                    isNextThreeDaysCounterStart = true

                } else {
                    if (nextThreeDaysCounter < 3 && isNextThreeDaysCounterStart) {
                        currentDay += '<td class=""><a role="button" aria-disabled="true" class="disabled text-decoration-none day text-danger"><div><h6>' + days + '</h6>' + '</div></a></td>'
                        nextThreeDaysCounter++;
                    } else {
                        // other day of the month
                        if (currentDayOfTheWeekName === "Sun") {
                            currentDay += '<td class=""><a role="button" aria-disabled="true" class="disabled text-decoration-none day text-danger"><div><h6>' + days + '</h6>' + '</div></a></td>'
                        } else if (currentDayOfTheWeekName === "Sat") {
                            currentDay += '<td class=""><a role="button" aria-disabled="true" class="disabled text-decoration-none day text-danger"><div><h6>' + days + '</h6>' + '</div></a></td>'
                        } else {
                            currentDay += '<td class=""><a role="button" class="text-decoration-none day text-dark"><div><h6>' + days + '</h6>' + '</div></a></td>'
                        }
                    }



                }
                if (currentDayOfTheWeekName === "Sat") {
                    allDates += openingTR + currentDay + closingTR
                    currentDay = ''
                }

                if (j === lastUTCDay + firstDay) {
                    allDates += openingTR + currentDay + closingTR
                    currentDay = ''
                }


            }

            $('.days-entries').append(allDates)
        }

        function getCurrentDayOfTheWeek(month, day) {
            let dayOfTheWeek = new Date(date.getFullYear(), month, day);

            return dayOfTheWeek.getDay() + 1;
        }

        function convertDayToName(dayNumber) {
            let week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"]
            for (let index = 0; index < week.length; index++) {
                if (index === dayNumber - 1) return week[index]
            }

            return false
        }

        $('.day').each(function() {
            $(this).click(function() {
                if ($(this).hasClass('disabled')) return
                console.log($(this))
            })
        })

        $('#purpose').on('change', displayPersonIncharge);
        displayPersonIncharge()

        function displayPersonIncharge(personIncharge = undefined) {

            if ($('#purpose').val() == 'other') {
                $('#concern').prop('disabled', false);
                $('#concern').parent().removeClass('d-none')
                $('.person-incharge-con').parent().addClass('d-none')
                $('.person-incharge-con').html("")
                return;
            }

            let purpose = $('#purpose').val();

            $.ajax({
                type: "get",
                url: `${url}/user/dashboard/get-incharge-employee/${purpose}`,
                // dataType: "json",
                success: function(response) {
                    let data = JSON.parse(response);
                    $('#concern').prop('disabled', true);
                    $('#concern').parent().addClass('d-none')
                    $('.person-incharge-con').parent().removeClass('d-none')
                    $('.person-incharge-con').html('')
                    for (const incharge of data) {
                        $('.person-incharge-con').append(personInChargeCardTemplate(incharge.name, incharge.designation))
                    }
                }
            });



            return;

        }

        function personInChargeCardTemplate(name, designation) {
            return `<div class="alert alert-info" role="alert">
                        <h6 class="m-0 fw-semibold">${name}</h5>
                        <small class="m-0">${designation}</small>
                    </div>`
        }

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
                success: function(response) {
                    if (response.code == 0) {
                        console.log(response.errors);
                        return;
                    }

                    alert(response.msg)
                    console.log(response)
                }
            });


            for (var val of formdata) {
                console.log(`${val[0]}: ${val[1]}`)
            }

        });
    });
</script>
<?= $this->endSection() ?>