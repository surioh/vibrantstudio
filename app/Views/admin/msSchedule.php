<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="header">
    <h1>Master Schedule</h1>
</div>

<div class="card">
    <div class="table-header">
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
            Tambah Schedule
        </button> -->
        <!-- Modal -->
        <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="tambahSchedule" method="post">
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Kelas:</label>
                                    </div>
                                    <div class="col-6">
                                        <select name="kelas" id="select_kelas" class="form-control" required>
                                            <option>Pilih Kelas</option>
                                            <?php foreach ($kelas as $key => $value) { ?>
                                            <option value="<?php echo $value->id; ?>"
                                                data-kuota="<?php echo $value->kuota; ?>"><?php echo $value->name; ?>
                                            </option>
                                            <?php } ?>
                                        </select><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Hari:</label>
                                    </div>
                                    <div class="col-6">
                                        <select name="hari" class="form-control" required>
                                            <option value="">Pilih Hari</option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                            <option value="Minggu">Minggu</option>
                                        </select><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Kuota:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="kuota" id="kuota" readonly /><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Jam Mulai:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="time" class="form-control" name="jam_mulai" /><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Jam Selesai:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="time" class="form-control" name="jam_selesai" /><br>
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
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="EditSchedule" method="post">
                        <div class="modal-body">
                            <div class="container">
                                <input type="hidden" id="edit_id" name="id" />
                                <input type="hidden" id="edit_coach_id" name="coach_id" />
                                <div class="row">
                                    <div class="col-4">
                                        <label>Kelas:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="edit_class_name" readonly><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Jam Mulai:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="jam_mulai" id="edit_jam_mulai"
                                            required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Jam Selesai:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="jam_selesai" id="edit_jam_selesai"
                                            required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Kuota:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="kuota" id="edit_kuota"
                                            required><br>
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
            <label for="search">Search: </label>
            <input type="text" id="search" name="search">
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Class Name</th>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Kuota</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($schedule)): ?>
                    <?php foreach ($schedule as $row): ?>
                        <tr>
                            <td><?= esc($row['class_name']) ?></td>
                            <td><?= esc($row['hari']) ?></td>
                            <td><?= esc($row['jam_mulai']) ?></td>
                            <td><?= esc($row['jam_selesai']) ?></td>
                            <td><?= esc($row['kuota']) ?></td>
                            <td class="actions">
                                <button class="btn-detail" onClick="edit_click(<?= esc($row['id']) ?>)" data-toggle="modal" data-target="#modalEdit">Edit</button>
                                <button class="btn-hapus" onClick="delete_click(<?= esc($row['id']) ?>)">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No schedules found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div style="display:none">
        <form id="hapusdataform" action="hapusSchedule" method="post">
            <input type="hidden" id="hapus_id" name="id" />
        </form>
    </div>
</div>

<script>
window.addEventListener('DOMContentLoaded', function() {
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
        url: '/viewSchedule',
        type: 'POST',
        dataType: 'json',
        data: {
            id: id
        },
        success: function(data) {
            console.log(data);
            $("#edit_id").val(data.result.id);
            $("#edit_class_name").val(data.result.class_name);
            $("#edit_jam_mulai").val(data.result.jam_mulai);
            $("#edit_jam_selesai").val(data.result.jam_selesai);
            $("#edit_kuota").val(data.result.kuota);
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

document.getElementById("select_kelas").addEventListener("change", function() {
    var selectedOption = this.options[this.selectedIndex];
    var kuota = selectedOption.getAttribute("data-kuota");
    document.getElementById("kuota").value = kuota;
});

$(document).ready(function() {
    $('#search').on('keyup', function() {
        var searchText = $(this).val().toLowerCase();
        $('table tbody tr').each(function() {
            var className = $(this).find('td:nth-child(1)').text().toLowerCase(); // Search by Class Name (first column)
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