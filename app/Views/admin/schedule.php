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
            <div class="d-flex align-items-center" style="width: fit-content;">
                <label for="month" class="fw-semibold" style="white-space:nowrap">Select Month:</label>
                <select class="form-select fs-5 fw-bold border-0 shadow-none" style="cursor: pointer;" name="month" id="month">
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
            <div class="d-flex align-items-center" style="width: fit-content;">
                <label for="days" class="fw-semibold" style="white-space:nowrap">Select Day:</label>
                <select class="form-select fs-6 fw-bold border-0 shadow-none" style="cursor: pointer;" name="days" id="days">
                    <!-- days in a month insert here -->
                </select>
            </div>
            <div class="my-5" style="width: fit-content;">
                <h2 class="fw-bold font-recoleta current-date">Thu, September 1, 2022</h2>
            </div>
        </center>
        <div class="main-schedule me-3 rounded-4" style="min-height: 100vh;">
            <div>
                <div class="current-day d-flex flex-column align-items-center">
                    <span>Mon</span>
                    <h1>4</h1>
                </div>
            </div>
            <div class="d-flex appointment-details-card-con" style="height: fit-content; gap:3rem">
                <!-- appointment cards insert here -->
            </div>
        </div>
    </div>
</div>
<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute('content')
        let date = new Date()
        let params = new URLSearchParams(window.location.search)

        $('#month').children().each(function() {
            if ($(this).val() === convertMonthToName(date.getMonth())) {
                $(this).attr("selected", true)
            }
        })

        if (params.has('month') && params.has('day')) {
            let month = parseInt(params.get('month')) - 1

            populateCalendar(getDate(month), month)
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

        function convertDayToName(dayNumber) {
            let week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"]
            for (let index = 0; index < week.length; index++) {
                if (index === dayNumber - 1) return week[index]
            }

            return false
        }

        function getDate(month) {
            let date = new Date();
            let firstDay = new Date(date.getFullYear(), month, 1);
            let lastDay = new Date(date.getFullYear(), month + 1, 0);

            return lastDay.getDate()
        }

        function getCurrentDayOfTheWeek(month, day) {
            let dayOfTheWeek = new Date(date.getFullYear(), convertMonthToNumber(month), day);

            return dayOfTheWeek.getDay() + 1;
        }

        function populateCalendar(lastUTCDay, month) {
            populateDaysSelection(lastUTCDay)
            let currentDayOfTheWeek = getCurrentDayOfTheWeek($('#month').val(), $('#days').val())
            updateDisplayedDate(convertDayToName(currentDayOfTheWeek), convertMonthToName(month), $('#days').val())
        }

        function updateDisplayedDate(dayOfTheWeek, month, day) {
            let date = new Date()
            $('.current-date').html(`${dayOfTheWeek}, ${month} ${day}, ${date.getFullYear()}`)
            $('.current-day').children().first().html(dayOfTheWeek)
            $('.current-day').children().last().html(day)
        }

        function populateDaysSelection(lastUTCDay) {
            $('#days').html('')
            let day = parseInt(params.get('day'))
            let selectedMonth = parseInt(params.get('month')) - 1
            let date = new Date()

            for (let index = 1; index <= lastUTCDay; index++) {
                if (index === day && convertMonthToName(selectedMonth) === $("#month").val()) {
                    $('#days').append('<option value="' + index + '" selected="selected">' + index + '</option>')
                } else {
                    $('#days').append('<option value="' + index + '">' + index + '</option>')
                }
            }
        }

        function populateAppointmentDetails(approvedData) {
            $('.appointment-details-card-con').html("")
            let approvedLength = approvedData.length

            for (const key in approvedData) {
                let [date, time] = approvedData[key].schedule.split(" ")
                let [year, month, day] = date.split("-")

                if (parseInt(month - 1) === convertMonthToNumber($('#month').val()) && parseInt(day) === parseInt($('#days').val())) {

                    $('.appointment-details-card-con').append(`<div class="card appointment-details-card" style="min-width: 25rem;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title fw-semibold">${approvedData[key].name}</h5>
                                <small>${time}</small>
                            </div>
                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn-outline-primary px-3 bg-transparent text-dark rounded-5" disabled>${approvedData[key].purpose}</button>
                                <a href="#" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    </div>`)
                }
            }
        }

        retrieveAppointments()

        function retrieveAppointments() {
            $.ajax({
                type: 'get',
                url: `${url}/admin/dashboard/get-all-approved-appointments`,
                async: true,
                success: function(response) {
                    let rawData = JSON.parse(response)
                    let approvedData = JSON.parse(response).data.approved

                    populateAppointmentDetails(approvedData)

                    // console.log(getAllDates)
                }
            });
        }

        $('#month').change(function(event) {
            $('#month').children().each(function() {
                $(this).removeAttr("selected")
            })

            retrieveAppointments()
        })

        setTimeout(function() {
            $('#days').change(function(event) {
                let self = $(this).val()
                populateCalendar(getDate(convertMonthToNumber($('#month').val())), convertMonthToNumber($('#month').val()))

                $(this).children().each(function() {
                    $(this).removeAttr("selected")
                })

                $(this).children().each(function() {
                    if ($(this).val() === self) {
                        $(this).attr('selected', "selected")

                        let currentDayOfTheWeek = getCurrentDayOfTheWeek($('#month').val(), self)
                        updateDisplayedDate(convertDayToName(currentDayOfTheWeek), $('#month').val(), self)
                        retrieveAppointments()
                    }
                })
            })
        }, 1000)
    })
</script>

<?= $this->endSection() ?>