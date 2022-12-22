<?= $this->extend('layouts/admin_layouts') ?>
<?= $this->section('content') ?>

<div class="main-content">
    <div class="mt-3 mb-5">
        <h2>Approved Appointments</h2>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard/') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Approved Appointments</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex">
        <div class="calendar flex-fill">
            <div class="calendar-grid m-0">
                <center class="d-flex justify-content-between" style="cursor: pointer;">
                    <div class="button prev-year" style="cursor: pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                        Previous Month
                    </div>
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
                    <div class="button next-year">
                        Next Month
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </div>
                </center>
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
                            Appointments Calendar
                        </span>
                    </div>
                    </span>
                    <div class="card-body">
                        <p class="card-text">No appointments today</p>
                    </div>
                </div>
            </div>
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
                        <div class="approved-legend">
                            <p>Approved Appointments</p>
                            <div></div>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute('content')
        let date = new Date()

        $(".next-year").click(function() {
            if (date.getMonth() == 11) {
                date = new Date(date.getFullYear() + 1, 0, 1);
            } else {
                date = new Date(date.getFullYear(), date.getMonth() + 1, 1);
            }
            $('#month').children().each(function() {
                $(this).removeAttr("selected")
            })
            $('#month').children().each(function() {
                console.log($(this).val(), convertMonthToName(date.getMonth()))
                if ($(this).val() === convertMonthToName(date.getMonth())) {
                    $(this).attr("selected", true)
                    $(this).addClass("selected")
                }
            })

            getApprovedData([getDate(convertMonthToNumber($('#month').val())), convertMonthToNumber($('#month').val())])
        })

        $(".prev-year").click(function() {
            if (date.getMonth() == 0) {
                date = new Date(date.getFullYear() - 1, 11, 1);
            } else {
                date = new Date(date.getFullYear(), date.getMonth() - 1, 1);
            }
            console.log(date)
            $('#month').children().each(function() {
                $(this).removeAttr("selected")
            })
            $('#month').children().each(function() {
                console.log($(this).val(), convertMonthToName(date.getMonth()))
                if ($(this).val() === convertMonthToName(date.getMonth())) {
                    $(this).attr("selected", true)
                    $(this).addClass("selected")
                }
            })

            getApprovedData([getDate(convertMonthToNumber($('#month').val())), convertMonthToNumber($('#month').val())])
        })

        $('#month').children().each(function() {
            if ($(this).val() === convertMonthToName(date.getMonth())) {
                $(this).attr("selected", true)
                $(this).addClass("selected")
            }
        })
        // populateCalendar(getDate(date.getMonth()), date.getMonth())
        getApprovedData()

        function getApprovedData(controlledDate = undefined) {
            $.ajax({
                type: 'get',
                url: `${url}/admin/dashboard/get-all-approved-appointments`,
                async: true,
                success: function(response) {
                    let rawData = JSON.parse(response)
                    if (rawData.code === 0)
                        return

                    let approvedData = JSON.parse(response).data.approved
                    let approvedLength = approvedData.length
                    let getAllDates = [];
                    for (const key in approvedData) {
                        let [date, time] = approvedData[key].schedule.split(" ")
                        let [year, month, day] = date.split("-")

                        getAllDates.push({
                            month,
                            day,
                            year
                        })
                    }

                    if (controlledDate) {
                        populateCalendar(controlledDate[0], controlledDate[1], {
                            approvedLength,
                            getAllDates
                        })
                    } else {
                        populateCalendar(getDate(date.getMonth()), date.getMonth(), {
                            approvedLength,
                            getAllDates
                        })
                    }

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
            // let date = new Date();
            let firstDay = new Date(date.getFullYear(), month, 1);
            let lastDay = new Date(date.getFullYear(), month + 1, 0);

            return [firstDay.getDay() + 1, lastDay.getUTCDate()]

        }

        function pendingHTMLTemplate(number, status) {
            return `<span class="pending-alert ${status}"><small class="pending-count">${number}</small></span>`
        }

        function approvedHTMLTemplate(number, status) {
            return `<span class="approved-alert ${status}"><small class="approved-count">${number}</small></span>`
        }

        function populateCalendar([firstDay, lastUTCDay], month, approvedData = undefined) {
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

            let approvedDates = approvedData.getAllDates
            // populate the remaining weeks
            for (let j = firstDay, days = 1, i = 0; j <= lastUTCDay + firstDay; j++, days++, i++) {
                // console.log(approvedDates[i]?.year)
                if (date.getUTCDate() === days && date.getMonth() === month && date.getFullYear() === approvedDates[i]?.year) {

                    let hasApprovedDate = false;
                    let hasApprovedAlert = false;
                    for (let i = 0; i < approvedDates.length; i++) {
                        let approvedDateYear = parseInt(approvedDates[i].year)
                        let approvedDateMonth = parseInt(approvedDates[i].month)
                        let approvedDateDay = parseInt(approvedDates[i].day)
                        let {
                            hasSimilarDate,
                            similarCounter
                        } = getAppointmentPerDay(approvedDates, approvedDateMonth, approvedDateDay)
                        // console.log(approvedData, date.getMonth())

                        let approved = approvedHTMLTemplate(similarCounter, '')
                        if (hasApprovedAlert) break

                        if (approvedDateMonth === month + 1 && approvedDateDay === days && date.getFullYear() === approvedDateYear) {
                            hasApprovedDate = true
                            hasApprovedAlert = true
                            currentDay += '<td class="active"><a href="' + url + '/admin/dashboard/approved-appointments/schedule?month=' + (month + 1) + '&day=' + days + '&year=' + parseInt(approvedDates[i]?.year) + '" class="text-decoration-none text-dark"><div><h4>' + days + '</h4>' + approved + '</div></a></td>'
                        }
                    }

                    if (hasApprovedDate) continue;
                    // Date today

                    currentDay += '<td class="active"><a href="' + url + '/admin/dashboard/approved-appointments/schedule?month=' + (month + 1) + '&day=' + days + '&year=' + parseInt(approvedDates[i]?.year) + '" class="text-decoration-none text-dark"><div><h4>' + days + '</h4>' + '</div></a></td>'

                } else {
                    let hasApprovedDate = false;
                    let hasApprovedAlert = false;
                    for (let i = 0; i < approvedDates.length; i++) {
                        let approvedDateYear = parseInt(approvedDates[i].year)
                        let approvedDateMonth = parseInt(approvedDates[i].month)
                        let approvedDateDay = parseInt(approvedDates[i].day)
                        let {
                            hasSimilarDate,
                            similarCounter
                        } = getAppointmentPerDay(approvedDates, approvedDateMonth, approvedDateDay)
                        // console.log(approvedData, date.getMonth())

                        let approved = approvedHTMLTemplate(similarCounter, '')
                        if (hasApprovedAlert) break

                        if (approvedDateMonth === month + 1 && approvedDateDay === days && date.getFullYear() === approvedDateYear) {
                            hasApprovedDate = true
                            hasApprovedAlert = true
                            currentDay += '<td class=""><a href="' + url + '/admin/dashboard/approved-appointments/schedule?month=' + (month + 1) + '&day=' + days + '&year=' + parseInt(approvedDates[i]?.year) + '" class="text-decoration-none text-dark"><div><h4>' + days + '</h4>' + approved + '</div></a></td>'
                        }
                    }

                    if (!hasApprovedDate) {
                        // Date today

                        currentDay += '<td class=""><a href="' + url + '/admin/dashboard/approved-appointments/schedule?month=' + (month + 1) + '&day=' + days + '&year=' + parseInt(approvedDates[i]?.year) + '" class="text-decoration-none text-dark"><div><h4>' + days + '</h4>' + '</div></a></td>'
                    }

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

        function getAppointmentPerDay(approvedDates, month, day) {
            let hasSimilarDate = false
            let similarCounter = 0
            for (let index = 0; index < approvedDates.length; index++) {
                if (parseInt(approvedDates[index].month) === month && parseInt(approvedDates[index].day) === day) {
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

            getApprovedData([getDate(convertMonthToNumber($(this).val())), convertMonthToNumber($(this).val())])
        })
    })
</script>

<?= $this->endSection() ?>