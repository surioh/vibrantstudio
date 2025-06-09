<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
    .card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .filter-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-group label {
        font-weight: bold;
        color: #333;
        margin-right: 10px;
    }

    .filter-group select, .filter-group input[type="date"] {
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: #fff;
        width: 200px; /* Consistent width for all inputs */
    }

    .btn {
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }

    .btn-primary {
        background: #ff69b4; /* Pink color */
        color: #fff;
    }

    .btn-primary:hover {
        background: #ff85c0;
    }

    .btn-secondary {
        background: #ccc;
        color: #333;
    }

    .btn-secondary:hover {
        background: #bbb;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    td.actions {
        display: flex;
        gap: 5px;
    }

    .btn-detail, .btn-hapus {
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .search-box {
        display: flex;
        align-items: center;
    }

    .search-box label {
        margin-right: 10px;
        color: #333;
    }

    .search-box input {
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
</style>

<div class="header">
    <h1>Actual Schedule</h1>
</div>

<div class="card">
    <div class="table-header">
        <form action="<?= base_url('actualSchedule') ?>" method="get" style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
            <!-- Class Filter -->
            <div class="filter-group">
                <label>Class Type:</label>
                <select name="class_filter" id="class_filter" onchange="this.form.submit()">
                    <option value="">All Classes</option>
                    <?php foreach ($kelas as $k): ?>
                        <option value="<?= esc($k->name) ?>" <?= ($classFilter == $k->name ? 'selected' : '') ?>>
                            <?= esc($k->name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Time Filter (Dropdown) -->
            <div class="filter-group">
                <label>Time:</label>
                <select name="time_filter" id="time_filter" onchange="this.form.submit()">
                    <option value="">All Times</option>
                    <?php foreach ($distinctTimes as $time): ?>
                        <option value="<?= esc($time['jam_mulai']) ?>" <?= ($timeFilter == $time['jam_mulai'] ? 'selected' : '') ?>>
                            <?= esc($time['jam_mulai']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Date Filter (Calendar Picker) -->
            <div class="filter-group">
                <label>Date:</label>
                <input type="date" name="date_filter" id="date_filter" value="<?= esc($dateFilter) ?>" onchange="this.form.submit()">
            </div>

            <!-- Clear All Button -->
            <div class="filter-group">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='<?= base_url('actualSchedule') ?>'">Clear All</button>
            </div>
        </form>

        <div class="search-box">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search">
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>
                        <a href="<?= base_url('actualSchedule?sort=class_name&direction=' . ($sortColumn == 'class_name' && $sortDirection == 'ASC' ? 'DESC' : 'ASC')) ?>">
                            Kelas <?= ($sortColumn == 'class_name' ? ($sortDirection == 'ASC' ? '↑' : '↓') : '') ?>
                        </a>
                    </th>
                    <th>
                        <a href="<?= base_url('actualSchedule?sort=hari&direction=' . ($sortColumn == 'hari' && $sortDirection == 'ASC' ? 'DESC' : 'ASC')) ?>">
                            Hari <?= ($sortColumn == 'hari' ? ($sortDirection == 'ASC' ? '↑' : '↓') : '') ?>
                        </a>
                    </th>
                    <th>
                        <a href="<?= base_url('actualSchedule?sort=coach_name&direction=' . ($sortColumn == 'coach_name' && $sortDirection == 'ASC' ? 'DESC' : 'ASC')) ?>">
                            Coach <?= ($sortColumn == 'coach_name' ? ($sortDirection == 'ASC' ? '↑' : '↓') : '') ?>
                        </a>
                    </th>
                    <th>
                        <a href="<?= base_url('actualSchedule?sort=tanggal&direction=' . ($sortColumn == 'tanggal' && $sortDirection == 'ASC' ? 'DESC' : 'ASC')) ?>">
                            Tanggal <?= ($sortColumn == 'tanggal' ? ($sortDirection == 'ASC' ? '↑' : '↓') : '') ?>
                        </a>
                    </th>
                    <th>
                        <a href="<?= base_url('actualSchedule?sort=jam_mulai&direction=' . ($sortColumn == 'jam_mulai' && $sortDirection == 'ASC' ? 'DESC' : 'ASC')) ?>">
                            Jam Mulai <?= ($sortColumn == 'jam_mulai' ? ($sortDirection == 'ASC' ? '↑' : '↓') : '') ?>
                        </a>
                    </th>
                    <th>
                        <a href="<?= base_url('actualSchedule?sort=jam_selesai&direction=' . ($sortColumn == 'jam_selesai' && $sortDirection == 'ASC' ? 'DESC' : 'ASC')) ?>">
                            Jam Selesai <?= ($sortColumn == 'jam_selesai' ? ($sortDirection == 'ASC' ? '↑' : '↓') : '') ?>
                        </a>
                    </th>
                    <th>
                        <a href="<?= base_url('actualSchedule?sort=kuota&direction=' . ($sortColumn == 'kuota' && $sortDirection == 'ASC' ? 'DESC' : 'ASC')) ?>">
                            Kuota <?= ($sortColumn == 'kuota' ? ($sortDirection == 'ASC' ? '↑' : '↓') : '') ?>
                        </a>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($schedule)): ?>
                <?php foreach ($schedule as $row): ?>
                <tr>
                    <td><?= esc($row['class_name']) ?></td>
                    <td><?= esc($row['hari']) ?></td>
                    <td><?= esc($row['coach_name']) ?></td>
                    <td><?= esc($row['tanggal']) ?></td>
                    <td><?= esc($row['jam_mulai']) ?></td>
                    <td><?= esc($row['jam_selesai']) ?></td>
                    <td><?= esc($row['sisa_kuota']) ?></td>
                    <td class="actions">
                        <button class="btn btn-success" onClick="book_click(<?= esc($row['id']) ?>)" data-toggle="modal"
                            data-target="#modalBook">Customer Book</button>
                        <button class="btn-detail" onClick="edit_click(<?= esc($row['id']) ?>)" data-toggle="modal"
                            data-target="#modalEdit">Edit</button>
                        <button class="btn-hapus" onClick="delete_click(<?= esc($row['id']) ?>)">Hapus</button>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="8">No schedules found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div style="display:none">
        <form id="hapusdataform" action="hapusActualSchedule" method="post">
            <input type="hidden" id="hapus_id" name="id" />
        </form>
    </div>
</div>

<div class="modal fade" id="modalBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Book Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="CustomerBookActualSchedule" method="post">
                <div class="modal-body">
                    <div class="container">
                        <input type="hidden" id="book_id" name="id" />
                        <input type="hidden" id="book_coach_id" name="coach_id" />
                        <div class="row">
                            <div class="col-4">
                                <label>Kelas:</label>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="book_class_name" readonly><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>Coach:</label>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="book_coach" readonly><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>Tanggal:</label>
                            </div>
                            <div class="col-6">
                                <input type="date" class="form-control" name="tanggal" id="book_tanggal" readonly><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>Jam Mulai:</label>
                            </div>
                            <div class="col-6">
                                <input type="time" class="form-control" id="book_jam_mulai" readonly><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>Jam Selesai:</label>
                            </div>
                            <div class="col-6">
                                <input type="time" class="form-control" id="book_jam_selesai" readonly><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>Kuota:</label>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="book_kuota" readonly><br>
                            </div>
                        </div>
                        <div id="book_repeat">
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-4">
                                <label>Jumlah Orang:</label>
                            </div>
                            <div class="col-6">
                                <input type="number" class="form-control" id="book_orang" name="book_orang" ><br>
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
<!-- Modal Edit (unchanged) -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="EditActualSchedule" method="post">
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
                                <label>Coach:</label>
                            </div>
                            <div class="col-6">
                                <select name="coach_id" id="edit_coach" class="form-control" required>
                                    <option value="">Select Coach</option>
                                    <?php foreach ($coach as $c): ?>
                                    <option value="<?= esc($c->id) ?>"><?= esc($c->name) ?></option>
                                    <?php endforeach; ?>
                                </select><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>Tanggal:</label>
                            </div>
                            <div class="col-6">
                                <input type="date" class="form-control" name="tanggal" id="edit_tanggal" readonly><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>Jam Mulai:</label>
                            </div>
                            <div class="col-6">
                                <input type="time" class="form-control" id="edit_jam_mulai" readonly><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>Jam Selesai:</label>
                            </div>
                            <div class="col-6">
                                <input type="time" class="form-control" id="edit_jam_selesai" readonly><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>Kuota:</label>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="edit_kuota" readonly><br>
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

function book_click(id) {
    $.ajax({
        url: '/viewActualSchedule2',
        type: 'POST',
        dataType: 'json',
        data: {
            id: id
        },
        success: function(data) {
            console.log('AJAX Success:', data);
            if (data.status === 'success' && data.result) {
                $("#book_id").val(data.result.id);
                $("#book_class_name").val(data.result.class_name);
                $("#book_coach").val(data.result.coach_id);
                $("#book_tanggal").val(data.result.tanggal);
                $("#book_jam_mulai").val(data.result.jam_mulai);
                $("#book_jam_selesai").val(data.result.jam_selesai);
                $("#book_kuota").val(data.result.sisa_kuota);
                $("#book_coach_id").val(data.result.coach_id);
                
                let kuota = parseInt(data.result.sisa_kuota);
                $("#book_orang").attr("max", kuota);

                // Add blur checker after setting max
                $("#book_orang").off('blur').on('blur', function () {
                    let value = parseInt($(this).val());
                    if (value > kuota) {
                        $(this).val(kuota);
                    }
                });


                // Clear existing content
                $('#book_repeat').html('');

                // Check if user list exists and populate
                if (data.users && Array.isArray(data.users)) {
                    const optionsHtml = data.users.map(user => {
                        return `<option value="${user.id}">${user.name}</option>`;
                    }).join('');

                    const rowHtml = `
                        <div class="row">
                            <div class="col-4">
                                <label>Pilih Customer:</label>
                            </div>
                            <div class="col-6">
                                <select class="form-control" name="book_customer">
                                    ${optionsHtml}
                                </select>
                            </div>
                        </div>
                    `;

                    // Append the row
                    $('#book_repeat').append(rowHtml);
                }
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Schedule data not found!",
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error, 'Status:', status, 'Response:', xhr.responseText);
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Failed to fetch schedule data!",
            });
        }
    });
}

function edit_click(id) {
    $.ajax({
        url: '/viewActualSchedule',
        type: 'POST',
        dataType: 'json',
        data: {
            id: id
        },
        success: function(data) {
            console.log('AJAX Success:', data);
            if (data.status === 'success' && data.result) {
                $("#edit_id").val(data.result.id);
                $("#edit_class_name").val(data.result.class_name);
                $("#edit_coach").val(data.result.coach_id);
                $("#edit_tanggal").val(data.result.tanggal);
                $("#edit_jam_mulai").val(data.result.jam_mulai);
                $("#edit_jam_selesai").val(data.result.jam_selesai);
                $("#edit_kuota").val(data.result.sisa_kuota);
                $("#edit_coach_id").val(data.result.coach_id);
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Schedule data not found!",
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error, 'Status:', status, 'Response:', xhr.responseText);
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Failed to fetch schedule data!",
            });
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
    $('#search').on('keyup', function() {
        var searchText = $(this).val().toLowerCase();
        $('table tbody tr').each(function() {
            var className = $(this).find('td:nth-child(1)').text().toLowerCase();
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