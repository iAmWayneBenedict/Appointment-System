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
                    <a href="<?= base_url("user/dashboard/delete-passed-appointment/{$appointment->id}") ?>" class="btn btn-danger">Delete</a>
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
        ?>
    </div>
</div>
<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute("content");

        $('.form-submit').each(function() {
            $(this).submit(function(e) {
                e.preventDefault();
                const formdata = $(this).serialize()

                $.ajax({
                    type: "post",
                    url: `${url}/user/dashboard/reschedule-appointment`,
                    data: formdata,
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

        $(() => {
            const url = document.querySelector("meta[name = base_url]").getAttribute('content')
            let date = new Date()
            let global_year = date.getFullYear();

            function getDate(month, year) {
                let date = new Date();
                let firstDay = new Date(year, month, 1);
                let lastDay = new Date(year, month + 1, 0);

                return [firstDay.getDay() + 1, lastDay.getUTCDate()]

            }

            populateCalendar(getDate(date.getMonth(), date.getFullYear()), date.getMonth(), global_year)
            $('.day').each(function() {
                $(this).click(handleClickDay)
            })

            function populateCalendar([firstDay, lastUTCDay], month, year) {
                $('.days-entries').html('')

                let allDates = ''
                let isFirstWeekDone = false;

                let openingTR = '<tr>'
                let closingTR = '</tr>'
                let currentDay = ''
                let nextThreeDaysCounter = 0;
                let isNextThreeDaysCounterStart = false;
                let isCurrentDayFound = false;

                // populate first week of the month
                for (let index2 = 1; index2 < firstDay; index2++) {
                    currentDay += '<td></td>'

                    if (index2 === firstDay - 1) {
                        isFirstWeekDone = true;
                    }
                }

                // populate the remaining weeks

                for (let j = firstDay, days = 1; j <= lastUTCDay + firstDay; j++, days++) {
                    let currentDayOfTheWeekNumber = getCurrentDayOfTheWeek(month, days, year);
                    let currentDayOfTheWeekName = convertDayToName(currentDayOfTheWeekNumber);
                    if (date.getUTCDate() === days && date.getMonth() === month) {
                        isCurrentDayFound = true;
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
                                if (!isCurrentDayFound && month === date.getMonth())
                                    currentDay += '<td class=""><a role="button" aria-disabled="true" class="disabled text-decoration-none day opacity-50 text-dark"><div><h6>' + days + '</h6>' + '</div></a></td>'
                                else
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

            $(".prev-month").click(function() {
                let selectedMonth = $('.calendar-title').text()
                $('.days-entries').html('')
                setCalendarTitle(convertMonthToName(date.getMonth()), date.getMonth())

                $(this).attr('disabled', true)
                $(".next-month").removeAttr('disabled')

                $(this).addClass('opacity-25')
                $(".next-month").removeClass('opacity-25')
                populateCalendar(getDate(date.getMonth(), date.getFullYear()), date.getMonth(), global_year)
                $('.day').each(function() {
                    $(this).click(handleClickDay)
                })
            })

            $(".next-month").click(function() {
                let selectedMonth = $('.calendar-title').text()
                $('.days-entries').html('')
                let nextDate = undefined;
                if (date.getMonth() == 11) {
                    nextDate = new Date(date.getFullYear() + 1, 0, 1);
                } else {
                    nextDate = new Date(date.getFullYear(), date.getMonth() + 1, 1);
                }
                console.log(nextDate.getFullYear())
                setCalendarTitle(convertMonthToName(nextDate.getMonth()), nextDate.getMonth())

                $(this).attr('disabled', true)
                $(".prev-month").removeAttr('disabled')
                $(this).addClass('opacity-25')

                $(".prev-month").removeClass('opacity-25')
                global_year = nextDate.getFullYear()
                populateCalendar(getDate(nextDate.getMonth(), nextDate.getFullYear()), nextDate.getMonth(), global_year)
                $('.day').each(function() {
                    $(this).click(handleClickDay)
                })
            })

            setCalendarTitle(convertMonthToName(date.getMonth()), date.getMonth())

            function setCalendarTitle(month, monthNumber) {
                $('.calendar-title').text(month)
                $('.calendar-title').data('month', monthNumber)
            }

            function convertMonthToName(monthNumber) {
                let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
                for (let index = 0; index < months.length; index++) {
                    if (index === monthNumber) return months[index]
                }

                return false
            }

            function getCurrentDayOfTheWeek(month, day, year) {
                let dayOfTheWeek = new Date(year, month, day);

                return dayOfTheWeek.getDay() + 1;
            }

            function convertDayToName(dayNumber) {
                let week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"]
                for (let index = 0; index < week.length; index++) {
                    if (index === dayNumber - 1) return week[index]
                }

                return false
            }
            let prevDayElement = undefined;

            function handleClickDay() {

                // remove prev clicked styling
                if (prevDayElement) {
                    prevDayElement.parent().removeClass('bg-primary')
                    prevDayElement.addClass('text-dark')
                    prevDayElement.removeClass('text-light')
                }

                if ($(this).hasClass('disabled')) return

                // add clicked styling
                $(this).parent().addClass('bg-primary')
                $(this).removeClass('text-dark')
                $(this).addClass('text-light')
                $('.save-date-btn').data("day", $(this).find('h6').text())
                prevDayElement = $(this);
            }

            $('.hour').change(changeHour)
            changeHour()

            function changeHour() {
                $('.save-date-btn').data("hour", $('.hour').val())
                if ($('.hour').val() > 12)
                    $('.datetime').text('pm')
                else
                    $('.datetime').text('am')
            }

            $('.minutes').change(changeMinutes)
            changeMinutes()

            function changeMinutes() {
                $('.save-date-btn').data("minutes", $('.minutes').val())
            }

            $('.save-date-btn').each(function() {
                console.log($(this))
                $(this).click(handleSaveDate)
            })

            function handleSaveDate() {
                console.log($(this))
                // get all date values
                let month = $('.calendar-title').data('month') + 1
                let day = $(this).data('day')
                let hour = $('.save-date-btn').data('hour')
                let minutes = $('.save-date-btn').data('minutes')

                // convert date values
                let currentDayOfTheWeekNumber = getCurrentDayOfTheWeek(month - 1, day, global_year);
                let currentDayOfTheWeekName = convertDayToName(currentDayOfTheWeekNumber);
                let selectedDate = `${global_year}-${month}-${day} ${hour}:${minutes}`
                let datetime = hour > 12 ? 'pm' : 'am';



                // redefine elements
                $(this).parents('.form-submit').find('.selected-date-con').removeClass('d-none')
                // $('.selected-date-con').removeClass('d-none')
                $(this).parents('.form-submit').find('#new-sched').val(selectedDate)
                $(this).parents('.form-submit').find('.selected-date').val(`${currentDayOfTheWeekName}, ${convertMonthToName(month-1)} ${parseInt(day)}, ${global_year} ${hour % 12}:${minutes} ${datetime}`)
                $(this).prev().click()
            }

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


        });
    })
</script>
<?= $this->endSection() ?>