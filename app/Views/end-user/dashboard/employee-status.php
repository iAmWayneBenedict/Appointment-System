<?= $this->extend('layouts/user_layouts') ?>
<?= $this->section('content') ?>

<div class="main-content mt-5">
    <h5 class="text-uppercase" style="font-weight:700">employee status</h5>

    <div class="employees" style="width:98%">
        <table id="employees" class="table">
            <thead>
                <tr>
                    <!-- <th scope="col">ID</th> -->
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody class="list">
            </tbody>
        </table>
    </div>
</div>

<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute('content')

        setInterval(() => {
            display_employees()
        }, 1000)

        function display_employees() {

            $.ajax({
                type: 'get',
                url: `${url}/get-employee-status-user`,
                async: true,
                success: function(response) {
                    $('.list').html(response);
                    // $('#employees').DataTable();
                }
            });
        }
    })
</script>

<?= $this->endSection() ?>