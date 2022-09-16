<?= $this->extend('layouts/admin_layouts') ?>
<?= $this->section('content') ?>

<div class="main-content">
    <div class="mt-3 mb-5">
        <h2>Dashboard</h2>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard/') ?>">Dashboard</a></li>
            </ol>
        </nav>
    </div>
    <div class="d-flex">
        <div class="calendar flex-fill">
            <div class="calendar-grid m-0">
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
                        <div class="pending-legend">
                            <p>Pending Appointments</p>
                            <div></div>
                        </div>
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
        let date = new Date()

        $('#month').children().each(function() {
            if ($(this).val() === convertMonthToName(date.getMonth())) {
                $(this).attr("selected", true)
                $(this).addClass("selected")
            }
        })
        populateCalendar(getDate(date.getMonth()), date.getMonth())

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

        function pendingHTMLTemplate(number, status) {
            return `<span class="pending-alert ${status}"><small class="pending-count">${number}</small></span>`
        }

        function populateCalendar([firstDay, lastUTCDay], month) {
            $('.days-entries').html('')

            let allDates = ''
            let isFirstWeekDone = false;

            let openingTR = '<tr>'
            let closingTR = '</tr>'
            let currentDay = ''
            let approvedTemplate = '<span class="approved-alert "><small class="approved-count">2</small></span>'

            // populate first week of the month
            for (let index2 = 1; index2 < firstDay; index2++) {
                currentDay += '<td></td>'

                if (index2 === firstDay - 1) {
                    isFirstWeekDone = true;
                }
            }

            // populate the remaining weeks
            for (let index = firstDay, days = 1; index <= lastUTCDay + firstDay; index++, days++) {
                let pending = pendingHTMLTemplate(2, '')

                if (date.getUTCDate() === days && date.getMonth() === month) {
                    currentDay += '<td class="active"><div><h4>' + days + '</h4>' + pending + approvedTemplate + '</div></td>'

                } else {
                    currentDay += '<td class=""><div><h4>' + days + '</h4>' + pending + approvedTemplate + '</div></td>'

                }

                if (index % 7 === 0) {
                    allDates += openingTR + currentDay + closingTR
                    currentDay = ''
                }

                if (index === lastUTCDay + firstDay) {
                    allDates += openingTR + currentDay + closingTR
                    currentDay = ''
                }

            }

            $('.days-entries').append(allDates)
        }

        $('#month').change(function(event) {
            $('#month').children().each(function() {
                $(this).removeAttr("selected")
            })

            populateCalendar(getDate(convertMonthToNumber($(this).val())), convertMonthToNumber($(this).val()))
        })
    })
</script>

<?= $this->endSection() ?>