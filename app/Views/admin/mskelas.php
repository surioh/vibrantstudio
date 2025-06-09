<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="header">
    <h1>Master Kelas</h1>
</div>

<div class="card">
    <div class="table-header">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
            Tambah Kelas
        </button>
        <!-- Modal -->
        <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="tambahKelas" method="post">
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Nama Kelas:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="name" required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Deskripsi:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="description" required><br>
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

        <!-- Modal Edit-->
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Kelas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="EditKelas" method="post">
                        <div class="modal-body">
                            <div class="container">
                                <input type="hidden" id="edit_id" name="id"/>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Nama:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="name" id="edit_name" required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Description:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="description" id="edit_desc" required><br>
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
            <label for="search">Search:&nbsp;</label>
            <input type="text" id="search" name="search">
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NAMA KELAS</th>
                    <th>DESKRIPSI</th>
                    <th>PEMBUAT</th>
                    <th>TANGGAL DAFTAR</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            
            <tbody>
                <?php 
                $number=1;
                foreach ($kelas as $k): ?>
                    <tr>
                        <td><?php echo $number; ?></td>
                        <td><?= esc($k['name']) ?></td>
                        <td><?= esc($k['description']) ?></td>
                        <td><?= esc($k['created_by']) ?></td>
                        <td><?= esc($k['created_date']) ?></td>
                        <td class="actions">
                            <button class="btn-detail" onClick="edit_click(<?php echo $k['id']??'' ?>)" data-toggle="modal" data-target="#modalEdit" >Edit</button>
                            <button class="btn-hapus" onClick="delete_click(<?php echo $k['id']??'' ?>)">Hapus</button>
                        </td>
                    </tr>
                <?php $number++; endforeach; ?>
            </tbody>
        </table>
    </div>
    <div style="display:none">
        <form id="hapusdataform" action="hapusKelas" method="post">
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
            url: '/viewKelas',
            type: 'POST',
            dataType: 'json',
            data: {id:id},
            success: function(data) {
                console.log(data);
                $("#edit_id").val(data.result.id);
                $("#edit_name").val(data.result.name);
                $("#edit_desc").val(data.result.description);
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
                // Set the value of the hidden input
                document.getElementById('hapus_id').value = x;

                // Submit the form
                document.getElementById('hapusdataform').submit();

                
            }
        });
    }
~
    $(document).ready(function() {
        // Search functionality
        $('#search').on('keyup', function() {
            var searchText = $(this).val().toLowerCase();

            $('table tbody tr').each(function() {
                var className = $(this).find('td:nth-child(2)').text().toLowerCase();
                if (className.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>
