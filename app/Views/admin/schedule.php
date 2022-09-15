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
    <div class="calendar">
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
            <div class="calendar-grid per-week p-0" style="max-width: 30rem">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">1</th>
                            <th scope="col" class="text-center">2</th>
                            <th scope="col" class="text-center">3</th>
                            <th scope="col" class="text-center">4</th>
                            <th scope="col" class="text-center">5</th>
                            <th scope="col" class="text-center">6</th>
                            <th scope="col" class="text-center">7</th>
                        </tr>
                    </thead>
                    <tbody class="days-entries">
                        <tr>
                            <td class="text-center">Sun</td>
                            <td class="text-center">Mon</td>
                            <td class="text-center">Tue</td>
                            <td class="text-center center">Wed</td>
                            <td class="text-center">Thu</td>
                            <td class="text-center">Fri</td>
                            <td class="text-center">Sat</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </center>
        <div class="main-schedule mt-5 me-3 rounded-4" style="height: 100vh;">
            <div>
                <div class="current-day">
                    <span>Mon</span>
                    <h1>4</h1>
                </div>
            </div>
            <div class="d-flex appointment-details-card-con" style="height: fit-content; gap:3rem">
                <div class="card appointment-details-card active" style="min-width: 30rem;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title fw-semibold">John Doe</h5>
                            <small>9:00 am</small>
                        </div>
                        <div class="d-flex justify-content-between mt-5">
                            <button type="button" class="btn-outline-primary px-3 bg-transparent text-dark rounded-5" disabled>Filing of Insurance</button>
                            <a href="#" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
                <div class="card appointment-details-card" style="min-width: 30rem;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title fw-semibold">John Doe</h5>
                            <small>9:00 am</small>
                        </div>
                        <div class="d-flex justify-content-between mt-5">
                            <button type="button" class="btn-outline-primary px-3 bg-transparent text-dark rounded-5" disabled>Filing of Insurance</button>
                            <a href="#" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
                <div class="card appointment-details-card" style="min-width: 30rem;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title fw-semibold">John Doe</h5>
                            <small>9:00 am</small>
                        </div>
                        <div class="d-flex justify-content-between mt-5">
                            <button type="button" class="btn-outline-primary px-3 bg-transparent text-dark rounded-5" disabled>Filing of Insurance</button>
                            <a href="#" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
                <div class="card appointment-details-card" style="min-width: 30rem;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title fw-semibold">John Doe</h5>
                            <small>9:00 am</small>
                        </div>
                        <div class="d-flex justify-content-between mt-5">
                            <button type="button" class="btn-outline-primary px-3 bg-transparent text-dark rounded-5" disabled>Filing of Insurance</button>
                            <a href="#" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
                <div class="card appointment-details-card" style="min-width: 30rem;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title fw-semibold">John Doe</h5>
                            <small>9:00 am</small>
                        </div>
                        <div class="d-flex justify-content-between mt-5">
                            <button type="button" class="btn-outline-primary px-3 bg-transparent text-dark rounded-5" disabled>Filing of Insurance</button>
                            <a href="#" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
                <div class="card appointment-details-card" style="min-width: 30rem;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title fw-semibold">John Doe</h5>
                            <small>9:00 am</small>
                        </div>
                        <div class="d-flex justify-content-between mt-5">
                            <button type="button" class="btn-outline-primary px-3 bg-transparent text-dark rounded-5" disabled>Filing of Insurance</button>
                            <a href="#" class="btn btn-primary">View</a>
                        </div>
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

        function populateCalendar([firstDay, lastUTCDay], month) {
            // let allDates = ''
            // let isFirstWeekDone = false;

            // let openingTR = '<tr>'
            // let closingTR = '</tr>'
            // let currentDay = ''

            // // populate first week of the month
            // for (let index2 = 1; index2 < firstDay; index2++) {
            //     currentDay += '<td></td>'

            //     if (index2 === firstDay - 1) {
            //         isFirstWeekDone = true;
            //     }
            // }

            // // populate the remaining weeks
            // for (let index = firstDay, days = 1; index <= lastUTCDay + firstDay; index++, days++) {

            //     if (date.getUTCDate() === days && date.getMonth() === month) {
            //         currentDay += '<td class="active">' + days + '</td>'

            //     } else {
            //         currentDay += '<td>' + days + '</td>'

            //     }

            //     if (index % 7 === 0) {
            //         allDates += openingTR + currentDay + closingTR
            //         currentDay = ''
            //     }

            //     if (index === lastUTCDay + firstDay) {
            //         allDates += openingTR + currentDay + closingTR
            //         currentDay = ''
            //     }

            // }

            // $('.days-entries').append(allDates)
        }

        $('#month').change(function(event) {
            $('.days-entries').html('')
            $('#month').children().each(function() {
                $(this).removeAttr("selected")
            })

            populateCalendar(getDate(convertMonthToNumber($(this).val())), convertMonthToNumber($(this).val()))
        })
    })
</script>

<?= $this->endSection() ?>