<?= $this->extend('layouts/admin_layouts') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="mt-3 mb-5">
        <h2>Users</h2>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>
    </div>
    <div style="width: 90%;">
        <div class="users">
            <table id="users" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Code ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Email</th>
                        <th scope="col">Identity</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <td><?= $user['code_id'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['address'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['identity'] ?></td>
                            <td>
                                <button type="button" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                    <span class="ms-2">Remove</span>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script>
    $(document).ready(function() {
        const url = document.querySelector("meta[name = base_url]").getAttribute('content')

        $('#users').DataTable();
    });
</script>
<?= $this->endSection() ?>