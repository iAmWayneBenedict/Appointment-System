<?= $this->extend('layouts/user_layouts') ?>
<?= $this->section('content') ?>

<div class="container-fluid mt-5">
    <h5 class="text-uppercase" style="font-weight:700">employee status</h5>

    <div class="employees">
        <table id="employees" class="table table-striped" style="width:100%">
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
                    // datatable initialization
                    $('#employees').DataTable();
                    // {
                    //     lengthMenu: [
                    //         [25, 50, -1],
                    //         [25, 50, 'All'],
                    //     ],
                    // }
                }
            });
        }
    })
</script>

<?= $this->endSection() ?>