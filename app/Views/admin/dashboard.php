<?= $this->extend('layouts/admin_layouts') ?>
<?= $this->section('content') ?>

<div class="main-content">
    <div class="mt-3 mb-5">
        <h2>Dashboard</h2>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex flex-column">
        <div class="d-flex gap-3 mb-5">
            <div class="card" style="width: 18rem;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="dashboard-icon bg-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                    </div>
                    <div>
                        <small class="card-title m-0">Total Appointments</small>
                        <h3 class="m-0"><?= $total ?></h3>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="dashboard-icon bg-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <div>
                        <small class="card-title m-0">Approved Appointments</small>
                        <h3 class="m-0"><?= $approvedCount ?></h3>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="dashboard-icon bg-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader">
                            <line x1="12" y1="2" x2="12" y2="6"></line>
                            <line x1="12" y1="18" x2="12" y2="22"></line>
                            <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
                            <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
                            <line x1="2" y1="12" x2="6" y2="12"></line>
                            <line x1="18" y1="12" x2="22" y2="12"></line>
                            <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
                            <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
                        </svg>
                    </div>
                    <div>
                        <small class="card-title m-0">Pending Appointments</small>
                        <h3 class="m-0"><?= $pendingCount ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h4>Walk in Clients</h4>
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#walkinModal">Walk in</button>
        </div>
        <div class="my-5">
            <h4>Calendar of Events</h4>
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#holidayModal">Holiday</button>
            <div class="d-flex">
                <div class="calendar flex-fill">
                    <div class="calendar-grid dashboard m-0">
                        <center>
                            <div style="width: fit-content;">
                                <select class="form-select fs-5 fw-bold border-0 shadow-none" style="cursor: pointer;" id="month">
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                        </center>
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
                    </div>
                </div>
                <div class="d-flex flex-column" style="width: 30%; margin-top: 5rem">
                    <div class="pe-5">
                        <div class="card mb-3">
                            <div class="card-header text-bg-primary d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span class="ms-2">
                                    Calendar Legend
                                </span>
                            </div>
                            </span>
                            <div class="card-body">
                                <p class="card-text">
                                <div class="event-legend">
                                    <p>Event Schedules</p>
                                    <div></div>
                                </div>
                                <div class="holiday-legend">
                                    <p>Holiday</p>
                                    <div></div>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === 'admin') { ?>
            <div class="my-5">
                <h4>Generate Report for this Month</h4>
                <a href="<?= base_url('/admin/dashboard/report') ?>" class="btn btn-primary">Generate Report</a>
            </div>
        <?php } ?>
    </div>
</div>
<div class="modal fade" id="holidayModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="holiday_from" class="form-label">Holiday From</label>
                    <input name="holiday_from" class="form-control" required id="holiday_from" type="datetime-local">
                </div>

                <div class="mb-3">
                    <label for="holiday_to" class="form-label">Holiday To</label>
                    <input name="holiday_to" class="form-control" id="holiday_to" type="datetime-local">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" required id="description" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submit-holiday">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="walkinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Walk-in Clients</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="d-flex flex-md-row flex-column align-items justify-content-between gap-5" id="walk-submit">
                    <div class="flex-fill">
                        <div class="pb-1">
                            <h6>Status</h6>
                            <p class="btn btn-success rounded-5">Walkin</p>
                        </div>
                        <div class="pb-1">
                            <label for="name" class="form-label">Name</label>
                            <input type="name" class="form-control" id="name" name="name" placeholder="Name" required>
                        </div>
                        <div class="pb-1">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="address">
                        </div>
                        <div class="pb-1">
                            <label for="social_pos" class="form-label">Social Position</label>
                            <select class="form-select" name="social_pos" id="social_pos">
                                <option value="Farmer">Farmers</option>
                                <option value="Fisherfolk">FisherFolks</option>
                                <option value="Barangay Official">Barangay Official</option>
                                <option value="Regional Staff">Regional Staff</option>
                                <option value="Business Owner">Business Owner</option>
                            </select>
                        </div>
                        <div class="pb-1">
                            <label for="c_number" class="form-label">Contact number</label>
                            <input type="text" class="form-control" name="c_number" id="c_number" placeholder="Contact Number" required>
                        </div>
                        <div class="pb-1">
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
                            <label for="selected-date" class="form-label">Selected Date</label><br>
                            <input type="datetime-local" class="form-control" id="selected-date" name="selected-date">
                        </div>
                        <div class="pb-1 d-flex justify-content-end mt-3">
                            <input type="submit" class="btn btn-primary" value="INSERT">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute('content')
        let date = new Date()

        $('#month').children().each(function() {
            if ($(this).val() === convertMonthToName(date.getMonth())) {
                $(this).attr("selected", true)
                $(this).addClass("selected")
            }
        })

        $('#walkin-submit').submit(function(e) {
            e.preventDefault();

            const formdata = new FormData($(this)[0]);

            $.ajax({
                type: "post",
                url: `${url}/admin/dashboard/insert-walkin`,
                data: formdata,
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {
                    //loader
                },
                success: function(response) {
                    if (response.code == 1) {
                        alert('Inserted')
                        location.reload()
                    } else {
                        alert('Not Inserted')
                    }
                },
                error: function(xhr) {
                    alert("Error occured.please try again");
                    console.log(xhr.statusText + ':' + xhr.responseText)
                },
                complete: function() {
                    //hide loader
                }
            });
        });

        $('.submit-holiday').click(function() {
            let holiday_from = $('#holiday_from').val()
            let holiday_to = $('#holiday_to').val()
            let description = $('#description').val()

            $.ajax({
                type: "post",
                url: `${url}/admin/dashboard/set-holiday`,
                data: {
                    holiday_from,
                    holiday_to,
                    description
                },
                dataType: "json",
                success: function(response) {
                    alert(response.msg)
                    location.reload()
                }
            });
        })

        // populateCalendar(getDate(date.getMonth()), date.getMonth())
        getEventDates()

        function getEventDates(controlledDate = undefined) {
            $.ajax({
                type: 'get',
                url: `${url}/admin/dashboard/get-all-release-dates`,
                async: true,
                success: function(response) {
                    getHolidays()
                    let rawData = JSON.parse(response)
                    console.log(rawData)
                    let stocksReleaseData = JSON.parse(response).data
                    let getAllDescription = [];
                    let getAllDates = [];
                    for (const key in stocksReleaseData) {
                        // console.log(stocksReleaseData['release_date'])
                        // let date = stocksReleaseData['release_date'].split(" ")
                        let [year, month, day] = stocksReleaseData[key].release_date.split("-")

                        getAllDates.push({
                            month,
                            day
                        })

                        getAllDescription.push({
                            description: stocksReleaseData[key].description
                        })
                    }

                    if (controlledDate) {
                        populateCalendar(controlledDate[0], controlledDate[1], {
                            getAllDescription,
                            getAllDates
                        })
                    } else {
                        populateCalendar(getDate(date.getMonth()), date.getMonth(), {
                            getAllDescription,
                            getAllDates
                        })
                    }
                }
            });
        }



        function getHolidays() {
            $.ajax({
                type: 'get',
                url: `${url}/admin/get-holidays`,
                async: true,
                dataType: 'json',
                success: function(response) {
                    // $(".submit-holiday").prev().click()
                    $('table.calendar-table td span div').each(function() {
                        for (let i = 0; i < response.length; i++) {
                            let holidayFrom = new Date(response[i].holiday_from)
                            let holidayTo = new Date(response[i].holiday_to)
                            let month = convertMonthToNumber($('#month').val())

                            if (holidayTo == "Invalid Date") {
                                if (month === holidayFrom.getMonth() && holidayFrom.getDate() === parseInt($(this).first().text())) {
                                    console.log(1)
                                    $(this).append(holidayHTMLTemplate(response[i].description))
                                    continue
                                }
                            }

                            if (month === holidayFrom.getMonth() && holidayTo.getDate() >= parseInt($(this).first().text()) && holidayFrom.getDate() <= parseInt($(this).first().text())) {

                                $(this).append(holidayHTMLTemplate(response[i].description))
                            }
                        }

                    })


                }
            });
        }

        function convertMonthToNumber(monthName) {
            let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
            for (let index = 0; index < months.length; index++) {
                if (months[index] === monthName) return index
            }

            return false
        }

        function convertMonthToName(monthNumber) {
            let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
            for (let index = 0; index < months.length; index++) {
                if (index === monthNumber) return months[index]
            }

            return false
        }

        function getDate(month) {
            let date = new Date();
            let firstDay = new Date(date.getFullYear(), month, 1);
            let lastDay = new Date(date.getFullYear(), month + 1, 0);

            return [firstDay.getDay() + 1, lastDay.getUTCDate()]

        }

        function releaseHTMLTemplate(description) {
            return `<span class="release-alert">${description}</span>`
        }

        function holidayHTMLTemplate(description) {
            return `<span class="holiday-alert">${description}</span>`
        }

        function populateCalendar([firstDay, lastUTCDay], month, stocksReleaseData = undefined) {
            $('.days-entries').html('')

            let allDates = ''
            let isFirstWeekDone = false;

            let openingTR = '<tr>'
            let closingTR = '</tr>'
            let currentDay = ''

            // populate first week of the month
            for (let index2 = 1; index2 < firstDay; index2++) {
                currentDay += '<td></td>'

                if (index2 === firstDay - 1) {
                    isFirstWeekDone = true;
                }
            }

            let isHolidayClosed = false;

            let stocksReleaseDates = stocksReleaseData.getAllDates
            let stocksDescriptions = stocksReleaseData.getAllDescription
            // populate the remaining weeks
            for (let j = firstDay, days = 1; j <= lastUTCDay + firstDay; j++, days++) {
                if (date.getUTCDate() === days && date.getMonth() === month) {
                    // let isHoliday = false;
                    // for (let i = 0; i < holidays.length; i++) {
                    //     let holidayFrom = new Date(holidays[i].holiday_from)
                    //     let holidayTo = new Date(holidays[i].holiday_to)

                    //     if (holidayTo == 'Invalid Date') {
                    //         isHolidayClosed = true;
                    //         continue;
                    //     }

                    //     if (holidayTo.getMonth() === month && holidayTo.getDate() === days) {
                    //         isHoliday = true
                    //         isHolidayClosed = true;
                    //         let holiday = holidayHTMLTemplate(holidays[i].description)
                    //         currentDay += '<td class="active"><span class="text-decoration-none text-dark" style="cursor:default;"><div><h4>' + days + '</h4>' + holiday + '</div></span></td>'
                    //         continue;
                    //     }

                    //     if (holidayFrom.getMonth() === month && holidayFrom.getDate() === days) {

                    //         isHoliday = true
                    //         isHolidayClosed = false;
                    //         let holiday = holidayHTMLTemplate(holidays[i].description)
                    //         currentDay += '<td class="active"><span class="text-decoration-none text-dark" style="cursor:default;"><div><h4>' + days + '</h4>' + holiday + '</div></span></td>'
                    //     }
                    // }

                    // if (isHoliday) continue;

                    let hasStocksReleaseDate = false;
                    let hasStocksReleaseAlert = false;
                    for (let i = 0; i < stocksReleaseDates.length; i++) {
                        let stocksReleaseDateMonth = parseInt(stocksReleaseDates[i].month)
                        let stocksReleaseDateDay = parseInt(stocksReleaseDates[i].day)
                        let release = releaseHTMLTemplate(stocksDescriptions[i].description)
                        if (hasStocksReleaseAlert) break

                        if (stocksReleaseDateMonth === month + 1 && stocksReleaseDateDay === days) {
                            hasStocksReleaseDate = true
                            hasStocksReleaseAlert = true
                            currentDay += '<td class="active"><span class="text-decoration-none text-dark" style="cursor:default;"><div><h4>' + days + '</h4>' + release + '</div></span></td>'
                        }
                    }

                    if (hasStocksReleaseDate) continue;
                    // Date today



                    currentDay += '<td class="active"><span class="text-decoration-none text-dark" style="cursor:default;"><div><h4>' + days + '</h4>' + '</div></span></td>'

                } else {
                    // let isHoliday = false;
                    // for (let i = 0; i < holidays.length; i++) {
                    //     let holidayFrom = new Date(holidays[i].holiday_from)
                    //     let holidayTo = new Date(holidays[i].holiday_to)

                    //     if (holidayTo == 'Invalid Date') {
                    //         isHolidayClosed = true;
                    //         continue;
                    //     }

                    //     // break
                    //     if (holidayTo.getMonth() === month && holidayTo.getDate() >= days && holidayFrom.getDate() <= days) {
                    //         isHoliday = true
                    //         isHolidayClosed = true;
                    //         let holiday = holidayHTMLTemplate(holidays[i].description)
                    //         currentDay += '<td class=""><span class="text-decoration-none text-dark" style="cursor:default;"><div><h4>' + days + '</h4>' + holiday + '</div></span></td>'
                    //         console.log(holidayTo.getDate(), days)
                    //         console.log("break")
                    //         break;
                    //     }

                    //     if (holidayFrom.getMonth() === month && holidayFrom.getDate() === days) {

                    //         isHoliday = true
                    //         isHolidayClosed = false;
                    //         let holiday = holidayHTMLTemplate(holidays[i].description)
                    //         currentDay += '<td class=""><span class="text-decoration-none text-dark" style="cursor:default;"><div><h4>' + days + '</h4>' + holiday + '</div></span></td>'
                    //     }
                    // }

                    // if (isHoliday) continue;

                    let hasStocksReleaseDate = false;
                    let hasStocksReleaseAlert = false;
                    for (let i = 0; i < stocksReleaseDates.length; i++) {
                        let stocksReleaseDateMonth = parseInt(stocksReleaseDates[i].month)
                        let stocksReleaseDateDay = parseInt(stocksReleaseDates[i].day)
                        let release = releaseHTMLTemplate(stocksDescriptions[i].description)
                        if (hasStocksReleaseAlert) break

                        if (stocksReleaseDateMonth === month + 1 && stocksReleaseDateDay === days) {
                            hasStocksReleaseDate = true
                            hasStocksReleaseAlert = true
                            currentDay += '<td class=""><span class="text-decoration-none text-dark" style="cursor:default;"><div><h4>' + days + '</h4>' + release + '</div></span></td>'
                        }
                    }

                    if (hasStocksReleaseDate) continue;
                    // Date today

                    currentDay += '<td class=""><span class="text-decoration-none text-dark" style="cursor:default;"><div><h4>' + days + '</h4>' + '</div></span></td>'

                }

                if (j % 7 === 0) {
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

        function getAppointmentPerDay(stocksReleaseDates, month, day) {
            let hasSimilarDate = false
            let similarCounter = 0
            for (let index = 0; index < stocksReleaseDates.length; index++) {
                if (parseInt(stocksReleaseDates[index].month) === month && parseInt(stocksReleaseDates[index].day) === day) {
                    hasSimilarDate = true;
                    similarCounter++
                }

            }

            return {
                hasSimilarDate,
                similarCounter
            }
        }

        $('#month').change(function(event) {
            $('#month').children().each(function() {
                $(this).removeAttr("selected")
            })

            console.log()
            // getApprovedData([getDate(convertMonthToNumber($(this).val())), convertMonthToNumber($(this).val())])
            getEventDates([getDate(convertMonthToNumber($(this).val())), convertMonthToNumber($(this).val())])
        })
    })
</script>

<?= $this->endSection() ?>