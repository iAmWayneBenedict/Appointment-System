<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('/src/css/app.css') ?>">
    <meta name="base_url" content="<?= base_url() ?>">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <link rel="icon" href="<?= base_url('/src/img/Bato (CS).png') ?>">
    <title>Appointment System</title>
</head>

<body>
    <div class="center-con home-cover" style="background-image: url('<?= base_url('src/img/Bato_Municipal_HAll_WTR.webp') ?>')">
        <!-- <div class="position-absolute top-0 left-0 w-100" style="z-index: 100;">
            <div class="alert alert-warning alert-dismissible fade show text-center marquee position-relative" style="user-select: all;" role="alert">
                <script>
                    $(() => {
                        const base_url = document.querySelector("meta[name = base_url]").getAttribute("content");
                        $.ajax({
                            type: "get",
                            url: `${base_url}/announcements`,
                            success: function(res) {
                                $(".marquee").html(res)
                            }
                        })
                    })
                </script>
            </div>
        </div> -->
        <div class="position-absolute rounded-3 p-3 announcement-con" style="background-color: rgba(255,255,255,1); top: 10px; left:10px; width:25rem">
            <h4 class="mt-3 fw-bold">📢 Announcements</h4>
            <hr>
            <ul class="d-flex gap-3 flex-column announcement">
                <script>
                    $(() => {
                        const base_url = document.querySelector("meta[name = base_url]").getAttribute("content");
                        $.ajax({
                            type: "get",
                            url: `${base_url}/announcements`,
                            success: function(res) {
                                res = res.replaceAll("Good Morning, , This is Agriculture office of Bato \n", "")
                                $(".announcement").html(res)
                            }
                        })
                    })
                </script>
            </ul>
        </div>
        <button type="button" class="position-absolute btn btn-info top-0 start-0 fs-4 announcement-btn mt-3 ms-3 align-items-center" style="display: none; z-index: 1000;" data-bs-toggle="modal" data-bs-target="#announcementModal">📢 <span class="ms-2 fs-6">Announcements</span></button>
        <div class="card border-0 p-5" style="width: 30rem; z-index: 5;">
            <div class="card-body">
                <img src="<?= base_url('/src/img/Logo Center.svg') ?>" alt="">
                <div class="d-flex flex-column mt-5">

                    <!-- redirect to users login -->

                    <a href="<?= base_url("/user/login") ?>" class="btn btn-primary mt-3 rounded-5 py-2">User</a>

                    <!-- rediract to guest appointment registration -->

                    <a href="<?= base_url("/appointments/guest-user") ?>" class="btn btn-primary mt-3 rounded-5 py-2">Guest</a>

                    <!-- rediract to admin login -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="mt-3 fw-bold">📢 Announcements</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="d-flex gap-3 flex-column announcement">
                        <script>
                            $(() => {
                                const base_url = document.querySelector("meta[name = base_url]").getAttribute("content");
                                $.ajax({
                                    type: "get",
                                    url: `${base_url}/announcements`,
                                    success: function(res) {
                                        res = res.replaceAll("Good Morning, , This is Agriculture office of Bato \n", "")
                                        $(".announcement").html(res)
                                    }
                                })
                            })
                        </script>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script type="module" src="<?= base_url('/src/js/app.js') ?>"></script>
</body>

</html>