<?php
    // print_r($report);

    $key_month = NULL;
    if(!empty($report)){
        $value = max($report);
        $key_month = array_search($value, $report);
    }
?>
    <div class="row m-4 rounded-lg justify-content-center" style="background-color: #ffffff !important;">
        <div class="col-5 m-5">
            <div class="row pl-3 pr-3 pb-4 pt-4">
                <div class="col-sm-6 mb-2">
                    <div class="card">
                        <div class="card-header text-center">
                            <b>TOTAL APPOINTMENTS</b>
                        </div>
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item"><?= $total_appointment?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <b>DATE TODAY</b>
                        </div>
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item"><?= $date_today?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 mb-4"></div>
                <div class="col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <b>BUSIEST MONTH</b>
                        </div>
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item"><?= date('F',strtotime($date_today))?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 align-items-center">
            <canvas id="myChart3" width="850" height="450"></canvas>
        </div>    
    </div>
    <div class="row m-4 rounded-lg" style="background-color: #ffffff !important;">
        <div class="col-6 p-3">
            <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
        </div>
        <div class="col-6 p-3">
            <canvas id="myChart2" style="width:100%;max-width:700px"></canvas>
        </div>
    </div>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th colspan="5" class="text-uppercase text-center"> <h4>Appointment Summary<h2></th>
            </tr>
            <tr class="table-warning">
                <th>Schedule</th>
                <th>Client</th>
                <th>Purpose</th>
                <th>Social Positions</th>
                <th>State</th>
            </tr>
        </thead>
        <tbody class="results">
        <?php
            foreach($results as $result){ 
        ?>
            <tr class="table-success">
                <td><?= $result['schedule']?></td>
                <td><?= $result['name'] ?></td>
                <td><?= $result['purpose']?></td>
                <td><?= $result['social_pos'] ?></td>
                <td><?= $result['state'] ?></td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    <hr>
    <div class="row">
        <div class="col-6">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-warning">
                        <th colspan="2" class="p-2">Appointment State</th>
                    </tr>
                </thead>
                <tbody class="results">
                <?php
                    foreach($from_result as $key => $val){ 
                ?>
                    <tr class="">
                        <th scope="row"><?= ucwords($key) ?></th>
                        <td><?= $val ?></td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-6">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-warning">
                        <th colspan="2" class="p-2">Appointment Purpose</th>
                    </tr>
                </thead>
                <tbody class="results">
                <?php
                    foreach($purpose as $key => $val){ 
                ?>
                    <tr class="">
                        <th scope="row"><?= $key ?></th>
                        <td><?= $val ?></td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        <?php unset($from_result['all'])?>
        var xValues = <?= json_encode(array_keys($from_result))?>;
        var yValues = <?= json_encode(array_values($from_result))?>;
        var barColors = [
        "#FD0100",
        "#F76915",
        "#EEDE04",
        "#A0D636",
        "#2FA236",
        "#333ED4"
        ];

        new Chart("myChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            title: {
            display: true,
            devicePixelRatio: 4,
            text: "Appointment States"
            }
        }
        });

        //data sets for Appointment Purposes
        var xValuesAP = <?= json_encode(array_keys($purpose))?>

        var yValuesAP = <?= json_encode(array_values($purpose))?>

        new Chart("myChart2", {
            type: 'horizontalBar',
            data: {
            labels: xValuesAP,
            datasets: [
                {
                label: "Population (millions)",
                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                data: yValuesAP
                }
            ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Appointment Purposes'
                },
                scales: {
                xAxes: [{
                    ticks: {
                    stepSize: 1,
                    beginAtZero: true,
                    },
                }],
            },
            }
        });

        //line chart

        new Chart("myChart3", {
        type: 'line',
        data: {
            labels: <?= json_encode(array_keys($report))?>,
            datasets: [{ 
                data: <?= json_encode(array_values($report))?>,
                label: "Value",
                borderColor: "#3e95cd",
                fill: false
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Appointments /Month'
            },
            responsive: true,
		    maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                    stepSize: 1,
                    beginAtZero: true,
                    },
                }],
            },
        }
        });
    </script>
<?php

?>