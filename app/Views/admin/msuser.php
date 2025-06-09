<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="header">
    <h1>Master User</h1>
</div>

<div class="card">
    <div class="table-header">
         <!-- <a class="cta-button" href="login">Tambah User</a> -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
            Tambah User
        </button>
        <!-- Modal Tambah (unchanged) -->
        <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="tambahUser" method="post">
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Nama:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="name" required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Email:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="email" required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Password:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="password" class="form-control" name="password" required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Nomor HP:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="phone" required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Tanggal Lahir:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="date" class="form-control" name="date_of_birth" required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Role:</label>
                                    </div>
                                    <div class="col-6">
                                        <select class="form-control" name="role" required>
                                            <option>Select Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="customer">Customer</option>
                                            <option value="coach">Coach</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="EditUser" method="post">
                        <div class="modal-body">
                            <div class="container">
                                <input type="hidden" id="edit_id" name="id">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="edit_name">Nama:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="edit_name" name="name" required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="edit_email">Email:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="edit_email" name="email" required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="edit_phone">Nomor HP:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="edit_phone" name="phone" required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="edit_role">Role:</label>
                                    </div>
                                    <div class="col-6">
                                        <select class="form-control" id="edit_role" name="role" required>
                                            <option>Select Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="customer">Customer</option>
                                            <option value="coach">Coach</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="edit_date_of_birth">Tanggal Lahir:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="date" class="form-control" id="edit_date_of_birth" name="date_of_birth" required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="edit_phone">Password:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="password" class="form-control" id="edit_password" name="password"><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="search-box">
            <label for="search">Search: </label>
            <input type="text" id="search" name="search">
        </div>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NAMA</th>
                    <th>EMAIL</th>
                    <th>NOMOR HP</th>
                    <th>TANGGAL LAHIR</th>
                    <th>ROLE</th>
                    <th>PEMBUAT</th>
                    <th>TANGGAL DAFTAR</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $number = 1;
                foreach ($user as $u): ?>
                    <tr>
                        <td><?php echo $number; ?></td>
                        <td><?= esc($u['name']) ?></td>
                        <td><?= esc($u['email']) ?></td>
                        <td><?= esc($u['phone']) ?></td>
                        <td><?= esc($u['date_of_birth']) ?></td>
                        <td><?= esc($u['role']) ?></td>
                        <td><?= esc($u['created_by']) ?></td>
                        <td><?= esc($u['created_date']) ?></td>
                        <td class="actions">
                            <button class="btn-detail" onClick="edit_click(<?php echo $u['id'] ?? '' ?>)" data-toggle="modal" data-target="#modalEdit">Edit</button>
                            <button class="btn-hapus" onClick="delete_click(<?php echo $u['id'] ?? '' ?>)">Hapus</button>
                        </td>
                    </tr>
                <?php 
                    $number++; 
                    endforeach; ?>
            </tbody>
        </table>
    </div>
    <div style="display:none">
        <form id="hapusdataform" action="hapusUser" method="post">
            <input type="hidden" id="hapus_id" name="id"/>
        </form>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function () {
        <?php if (isset($del) && $del == 1): ?>
            Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
            });
        <?php endif; ?>

        <?php if (isset($error) && $error == 1): ?>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Data Gagal Tersimpan!",
            });
        <?php endif; ?>

        <?php if (isset($update) && $update == 1): ?>
            Swal.fire({
                title: "Good job!",
                text: "Data Berhasil Disimpan!",
                icon: "success"
            });
        <?php endif; ?>
    });

    function edit_click(id) {
        $.ajax({
            url: '/viewUser',
            type: 'POST',
            dataType: 'json',
            data: { id: id },
            success: function(data) {
                console.log(data);
                if (data.status === 'success' && data.result) {
                    $("#edit_id").val(data.result.id);
                    $("#edit_name").val(data.result.name);
                    $("#edit_email").val(data.result.email);
                    $("#edit_phone").val(data.result.phone);
                    $("#edit_role").val(data.result.role);
                    $("#edit_date_of_birth").val(data.result.date_of_birth);
                } else {
                    console.error('Invalid response:', data);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function delete_click(x) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('hapus_id').value = x;
                document.getElementById('hapusdataform').submit();
            }
        });
    }

        $(document).ready(function() {
        // Search functionality
        $('#search').on('keyup', function() {
            var searchText = $(this).val().toLowerCase();

            $('table tbody tr').each(function() {
                var userName = $(this).find('td:nth-child(2)').text().toLowerCase();
                if (userName.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>