<?= $this->extend('layouts/user_layouts') ?>
<?= $this->section('content') ?>

<div class="main-content mt-4">
    <div class="pb-5">
        <h3 class="font-recoleta" style="font-weight:800">Employee Status</h3>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard/') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Employee Status</li>
            </ol>
        </nav>
    </div>
    <div class="employees" style="width:98%">
        <table id="employees" class="table">
            <thead>
                <tr>
                    <!-- <th scope="col">ID</th> -->
                    <th scope="col">In Charge To</th>
                    <th scope="col">Status</th>
                    <th scope="col">Log Time</th>
                </tr>
            </thead>
            <tbody class="list">
                <!-- employee status insert here -->
            </tbody>
        </table>
    </div>
</div>

<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute('content')

        // update employees' status every second
        setInterval(() => {
            display_employees()
        }, 1000)

        function display_employees() {

            $.ajax({
                type: 'get',
                url: `${url}/scanner/get-employee-status-user`,
                async: true,
                success: function(response) {

                    // populate the table with employee status

                    $('.list').html(response);
                    // $('#employees').DataTable();
                }
            });
        }
    })
</script>

<?= $this->endSection() ?>