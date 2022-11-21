<?= $this->extend('layouts/admin_layouts') ?>
<?= $this->section('content') ?>

<div class="main-content">
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <!-- Position it: -->
        <!-- - `.toast-container` for spacing between toasts -->
        <!-- - `top-0` & `end-0` to position the toasts in the upper right corner -->
        <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
        <div class="toast-container top-0 end-0 p-3" style="z-index: 2;">

            <!-- Then put toasts within -->
        </div>
    </div>

    <!-- <div class="mt-3 mb-5">
        <h2>Dashboard</h2>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div> -->
    <div class="greetings my-4">

        <div>
            <h1>Good <?php
                        if (date("H:i") < '12:00')
                            echo 'morning';
                        else if (date("H:i") >= '12:00' && date("H:i") < '18:00')
                            echo 'afternoon';
                        else
                            echo 'evening';

                        ?></h1>
            <h1>Admin</h1>
        </div>
        <div class="d-flex gap-2 mb-4">
            <div class="quick-overview rounded-5 px-4 py-2 mt-4" style="background: #cfe1ff; width:fit-content">
                <b>Here's a quick overview on what's happening.</b>
            </div>
            <div class="quick-overview rounded-5 px-4 py-2 mt-4 font-montserrat d-none" style="background: #FFE7BA; width:fit-content;">
                <small class="fw-semibold"><span id="notif-counter-alert">0</span> Unread Notifications</small>
            </div>
            <div class="quick-overview rounded-5 px-4 py-2 mt-4 font-montserrat" style="background: #FFCECE; width:fit-content;">
                <small class="fw-semibold"><span id="pending-counter-alert">3</span> Pending Appointments</small>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column">
        <div class="d-flex">
            <div class="d-flex gap-3 mb-5" style="height:fit-content">
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
        </div>

        <div class="my-5">
            <h4>Calendar of Events</h4>
            <div class="d-flex">
                <div class="calendar flex-fill">
                    <div class="calendar-grid dashboard m-0" style="padding-right: 2rem;">
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders">
                                    <line x1="4" y1="21" x2="4" y2="14"></line>
                                    <line x1="4" y1="10" x2="4" y2="3"></line>
                                    <line x1="12" y1="21" x2="12" y2="12"></line>
                                    <line x1="12" y1="8" x2="12" y2="3"></line>
                                    <line x1="20" y1="21" x2="20" y2="16"></line>
                                    <line x1="20" y1="12" x2="20" y2="3"></line>
                                    <line x1="1" y1="14" x2="7" y2="14"></line>
                                    <line x1="9" y1="8" x2="15" y2="8"></line>
                                    <line x1="17" y1="16" x2="23" y2="16"></line>
                                </svg>
                                <span class="ms-2">
                                    Accessability
                                </span>
                            </div>

                            <div class="card-body">
                                <div>
                                    <h5>Add Walk-in Clients</h5>
                                    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#walkinModal">Add Walk-in</button>
                                </div>
                                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === 'admin') { ?>
                                    <h5>Manage Holidays</h5>
                                    <div>
                                        <button type="button" class="btn btn-outline-success mb-4" data-bs-toggle="modal" data-bs-target="#holidayModal">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                            <small>Add Holiday</small>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger mb-4" id="remove-holiday" data-bs-toggle="modal" data-bs-target="#removeHolidayModal">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                            <small>Remove Holiday</small>
                                        </button>
                                    </div>
                                <?php } ?>
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="notifModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="me-3" style="width: 3rem; height:3rem; object-fit:contain">
                        <img src="<?= base_url('/src/img/Bato (CS).png') ?>" style="width:100%;height:100%" alt="">
                    </div>
                    <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="white-space: pre-wrap;">
                    <!-- Notification message here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="holidayModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Set Holiday</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="holiday_from" class="form-label">Holiday From</label>
                        <input name="holiday_from" class="form-control" required id="holiday_from" type="date">
                    </div>

                    <div class="mb-3">
                        <label for="holiday_to" class="form-label">Holiday To</label>
                        <input name="holiday_to" class="form-control" id="holiday_to" type="date">
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
    <div class="modal fade" id="removeHolidayModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Remove Holiday</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-1">
                        <label for="social_pos" class="form-label">Select Name of Holiday</label>
                        <select class="form-select" name="remove_holiday" id="remove-holiday-field">
                            <!-- list of holiday here -->
                        </select>
                        <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                            message!</span><br>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger submit-remove-holiday">Remove Holiday</button>
                </div>
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
                <form action="" method="post" class="d-flex flex-md-row flex-column align-items justify-content-between gap-5" id="walkin-submit">
                    <div class="flex-fill">
                        <div class="pb-3">
                            <h6>Status</h6>
                            <p class="btn btn-success rounded-5">Walkin</p>
                        </div>
                        <div class="pb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="name" class="form-control" id="name" name="name" placeholder="Name" required>
                        </div>
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
                            <label for="c_number" class="form-label">Contact number</label>
                            <input type="text" class="form-control" name="c_number" id="c_number" placeholder="Contact Number" required>
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
                        <div class="pb-3">
                            <label for="selected-date" class="form-label">Selected Date</label><br>
                            <input type="datetime-local" class="form-control" id="selected-date" name="selected-date">
                        </div>
                        <div class="pb-3">
                            <input type="submit" class="btn btn-warning" value="INSERT">
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
        initToast()
        getNotifications()
        setInterval(() => {
            getNotifications()
        }, 5000)
        let toastCount = 0;

        function getNotifications() {
            $.ajax({
                type: "get",
                url: `${url}/admin/dashboard/get-notifications`,
                dataType: "json",
                success: function(response) {
                    let notifications = response.notifications;
                    let counter = 0,
                        template = "",
                        unreadCounter = 0;
                    notifications?.map(function(notification) {
                        if (parseInt(notification.is_read)) return false;
                        unreadCounter++

                        if (counter >= 3) return
                        counter++

                        let date = new Date(notification.c_date);
                        let options = {
                            weekday: 'short',
                            year: 'numeric',
                            month: 'numeric',
                            day: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true,
                            timeZone: 'Asia/Manila'
                        };
                        let formatedDate = new Intl.DateTimeFormat('en-PH', options).format(date);
                        template += `
                            <div class="toast" role="alert" aria-live="assertive" data-bs-animation="true" aria-atomic="true">
                                <div class="toast-header">
                                    <img src="<?= base_url('src/img/Bato (CS).png') ?>" style="width:30px" class="rounded me-2" alt="...">
                                    <strong class="me-auto text-primary">Notification</strong>
                                    <small class="text-black">${formatedDate}</small>
                                    <button type="button" class="btn-close close-notif-toast" data-bs-dismiss="toast" data-value="${notification.id}" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                    ${notification.message}
                                    </div>
                                    </div>
                                    `

                        toastCount = $(".toast-container").children().length;
                    })
                    $(".toast-container").html(template)
                    // console.log(unreadCounter)
                    initToast()
                    handleNotifAlertBubble(unreadCounter)
                }

            });
        }

        function handleNotifAlertBubble(unreadCounter) {
            $("#notif-counter-alert").text(unreadCounter)

            if (unreadCounter !== 0) {
                $("#notif-counter-alert").parent().parent().removeClass("d-none")
                return
            }

            $("#notif-counter-alert").parent().parent().addClass("d-none")

        }

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
                    $("#preloader").modal("show");
                },
                success: function(response) {
                    $("#preloader").modal("hide");
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
                beforeSend: function() {
                    $("#preloader").modal("show");
                },
                success: function(response) {
                    setTimeout(_ => $("#preloader").modal("hide"), 500)
                    // alert(response.msg)
                    Swal.fire(
                        'Success!',
                        response.msg,
                        'success'
                    ).then(_ => location.reload())

                }
            });
        })

        function initToast() {
            const toastElList = document.querySelectorAll('.toast')
            const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl, {
                autohide: false,
                animation: false
            }));
            $('.toast').map(function() {
                $(this).toast("show")
            })
            toastEventListener()
        }

        function toastEventListener() {
            $('.close-notif-toast').each(function() {
                $(this).click(function(event) {
                    let thisID = $(this).data("value")
                    // let thisElement = $(this).parentsUntil(".toast-container")[1]
                    $.ajax({
                        type: "get",
                        url: `${url}/admin/dashboard/already-read/${thisID}`,
                        success: function(response) {
                            getNotifications()
                        }
                    });
                })
            })
        }

        async function getHolidaysFromApi() {

            let response = await fetch(`${url}/src/json/holidays.json`);

            let data = await response.json();

            let date = new Date();
            let holidays = [];
            for (const value of data) {
                if (date.getFullYear() === value.year) holidays = value.data;
            }
            $("table.calendar-table td>span>div").each(function() {
                for (let i = 0; i < holidays.length; i++) {
                    if ($(this).hasClass("disabled")) continue;

                    let holidayFrom = new Date(holidays[i].date);
                    let month = convertMonthToNumber($("#month").val());
                    if (
                        month === holidayFrom.getMonth() &&
                        holidayFrom.getDate() === parseInt($(this).find("h4").text())
                    ) {
                        let currentCalendarDay = parseInt($(this).find('h4').text())
                        $(this).append(`<span class='holiday-alert'>${holidays[i].name}</span>`)
                    }

                }
            });
        }
        initSelectRemoveHoliday()
        // new Intl.DateTimeFormat('en-PH', options).format(date)
        function initSelectRemoveHoliday() {
            $.ajax({
                type: 'get',
                url: `${url}/admin/get-holidays`,
                async: true,
                dataType: 'json',
                success: function(response) {
                    response.map(function(holiday) {
                        console.log(new Date(holiday.holiday_to) != "Invalid Date" ? "123" : 1234)
                        $('#remove-holiday-field').append(`
                            <option value="${holiday.id}">
                                <div class="d-flex justify-content-between">
                                    <span>${holiday.description} on</span>
                                    <small>${new Intl.DateTimeFormat('en-PH', {
                                        month: 'short',
                                        day: 'numeric',
                                        timeZone: 'Asia/Manila'
                                    }).format(new Date(holiday.holiday_from))} ${new Date(holiday.holiday_to) != "Invalid Date" ? " - " +(new Intl.DateTimeFormat('en-PH', {
                                        month: 'short',
                                        day: 'numeric',
                                        year: 'numeric',
                                        timeZone: 'Asia/Manila'
                                    }).format(new Date(holiday.holiday_to))) : ""}</small>
                                </div>
                            </option>
                        `)
                    })
                }
            })
        }

        $(".submit-remove-holiday").click(function() {
            let selectedHoliday = $('#remove-holiday-field').val()

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff0000",
                cancelButtonColor: "#d0d0d0d",
                confirmButtonText: "Proceed",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'get',
                        url: `${url}/admin/dashboard/remove-holidays/${selectedHoliday}`,
                        async: true,
                        dataType: 'json',
                        beforeSend: function() {
                            $("#preloader").modal("show");
                        },
                        success: function(response) {
                            setTimeout(_ => $("#preloader").modal("hide"), 500)
                            Swal.fire(
                                "Activate",
                                "You have successfully Activated a user",
                                "success"
                            ).then(_ => location.reload())

                        }
                    })
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
                    getHolidaysFromApi()
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