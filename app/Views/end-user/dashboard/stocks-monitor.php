<?= $this->extend('layouts/user_layouts') ?>
<?= $this->section('content') ?>
<div class="main-content mt-4">
    <div>
        <div class="pb-3 pb-md-5">
            <h3 class="font-recoleta fw-bold">Stocks Monitoring</h3>
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('/user/dashboard/') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Stocks Monitoring</li>
                </ol>
            </nav>
        </div>
    </div>
    <div>
        <div class="cards" style="text-align: center;">
            <hr>
            <h4>Schedules of Release <br> and <br> Stocks Available</h4>
            <hr>
            <br>
        </div>
        <div class="list">

        </div>
        <!-- <div style="width: 90%;">
            <div class="users">
                <table id="users" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Description</th>
                            <th scope="col">Category</th>
                            <th scope="col">Sub Category</th>
                            <th scope="col">Available</th>
                        </tr>
                    </thead>
                    <tbody class="list">

                    </tbody>
                </table>
            </div>
        </div> -->
    </div>
</div>
<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute("content");

        displayStocksRelease()

        function displayStocksRelease() {
            $.ajax({
                type: "get",
                url: `${url}/user/dashboard/get-all-release-dates`,
                success: function(res) {
                    let response = JSON.parse(res)
                    $('.list').html('')
                    for (let index = 0; index < response.data.length; index++) {
                        const element = response.data[index];
                        let [year, month, day] = element.release_date.split('-')
                        let monthName = convertMonthToName(parseInt(month - 1))
                        let dayOfTheWeek = convertDayToName(getCurrentDayOfTheWeek(month - 1, day, year))
                        $('.list').append(`
                            <div>
                                <div class="text-center">
                                    <h3>${element.description}</h3>
                                    <p>${dayOfTheWeek}, ${monthName} ${day}, ${year}</p>
                                </div>
                                <div class="d-flex justify-content-center gap-3">
                                    <div class="card" style="width: 10rem">
                                        <div class="card-body d-flex flex-column align-items-center gap-3">
                                            <div class="dashboard-icon bg-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <small class="card-title m-0 text-center">Available Stocks</small>
                                                <h3 class="m-0 text-center">${element.available}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card" style="width: 10rem">
                                        <div class="card-body d-flex flex-column align-items-center gap-3">
                                            <div class="dashboard-icon bg-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check">
                                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="8.5" cy="7" r="4"></circle>
                                                    <polyline points="17 11 19 13 23 9"></polyline>
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <small class="card-title m-0 text-center">Allocated Stocks</small>
                                                <h3 class="m-0 text-center">${element.allocated}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card" style="width: 10rem">
                                        <div class="card-body d-flex flex-column align-items-center gap-3">
                                            <div class="dashboard-icon bg-info">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter">
                                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                                                </svg>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <small class="card-title m-0 text-center">Total Quantity</small>
                                                <h3 class="m-0 text-center">${element.total_quantity}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                        console.log(element)
                    }
                }
            });
        }

        function getCurrentDayOfTheWeek(month, day, year) {
            let dayOfTheWeek = new Date(year, month, day);

            return dayOfTheWeek.getDay() + 1;
        }

        function convertDayToName(dayNumber) {
            let week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
            for (let index = 0; index < week.length; index++) {
                if (index === dayNumber - 1) return week[index];
            }

            return false;
        }

        function convertMonthToName(monthNumber) {
            let months = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ];
            for (let index = 0; index < months.length; index++) {
                if (index === monthNumber) return months[index];
            }

            return false;
        }
    })
</script>
<?= $this->endSection() ?>