<?= $this->extend('layouts/user_layouts') ?>
<?= $this->section('content') ?>

<div class="main-content my-4">
    <div class="pb-5">
        <h3 class="fw-bold">Notifications</h3>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard/') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Notifications</li>
            </ol>
        </nav>
    </div>
    <div>
        <?php
        foreach ($notifications as $notification) {
        ?>
            <div class="list-group" style="max-width: 35rem;">
                <div class="list-group-item border-0 d-flex justify-content-between align-items-start notif" data-id="<?= $notification->id ?>" style="cursor:pointer; width:100%" data-bs-toggle="modal" data-bs-target="#notifModal">
                    <div class="d-flex align-items-center gap-3 position-relative  <?= $notification->status === '0' ? "fw-semibold" : "" ?>" style=" min-height:5rem;">
                        <div style="width: 3rem; height:3rem; object-fit:contain">
                            <img src="<?= base_url('/src/img/Bato (CS).png') ?>" style="width:100%;height:100%" alt="">
                        </div>
                        <div class="d-flex flex-column justify-content-evenly">
                            <div class="notif-body">
                                <?= $notification->message ?>
                            </div>
                            <small class="mt-2 text-primary"><?= date_format(date_create($notification->sent_date), 'D, M j, Y g:i:s a') ?></small>
                        </div>
                        <?php
                        if ($notification->status === '0') {
                        ?>
                            <span class="position-absolute translate-middle bg-primary rounded-circle" style="top:10%; right:2%;padding:.35rem">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        <?php
                        }
                        ?>
                    </div>
                </div>

            </div>
        <?php
        }
        ?>
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
</div>

<script>
    window.onload = () => {
        handleResize()
    }
    window.addEventListener('resize', () => {
        handleResize()
    })

    function handleResize() {
        let body = document.querySelector("BODY");
        let positionInfo = body.getBoundingClientRect();

        if (positionInfo.width <= 900) {
            let notifInfo = document.querySelectorAll('.notif-body')
            for (const notif of notifInfo) {

                notif.style.width = positionInfo.width - 120 + 'px'
            }
        } else {
            let notifInfo = document.querySelectorAll('.notif-body')
            for (const notif of notifInfo) {

                notif.style.width = '25rem'
            }
        }
    }
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute("content");
        $(".close-modal").each(function() {
            $(this).click(function() {
                location.reload()
            })
        })
        $('.notif').each(function() {
            $(this).click(function() {
                let thisID = $(this).data('id')

                $.ajax({
                    type: "get",
                    url: `${url}/user/dashboard/already-read/${thisID}`,
                    success: function(response) {

                    }
                });

                $.ajax({
                    type: "get",
                    url: `${url}/user/dashboard/get-notifications`,
                    dataType: 'json',
                    success: function(response) {
                        let notif = response.notifications.find((element) => {
                            if (parseInt(element.id) === thisID) {
                                return element
                            }

                            return
                        })
                        $('.modal-body').text(notif.message)
                    }
                });
            })
        })
    })
</script>
<?= $this->endSection() ?>