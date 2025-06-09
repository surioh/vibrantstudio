<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="header">
    <h1>Master Customer</h1>
</div>

<div class="card">
    <div class="table-header">
        <!-- Modal Edit -->
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="EditCustomer" method="post">
                        <div class="modal-body">
                            <div class="container">
                                <input type="hidden" id="edit_id" name="id">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="edit_name">Nama:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="edit_name" name="name" readonly><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="edit_email">Email:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="edit_email" name="email" readonly><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="edit_group">Group:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="edit_group" name="group" required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="edit_private">Private:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="edit_private" name="private" required><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="edit_expiration">Expiration:</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="date" class="form-control" id="edit_expiration" name="expiration" required><br>
                                    </div>
                                </div>
                                <br>
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
                    <th>GROUP</th>
                    <th>PRIVATE</th>
                    <th>EXPIRATION</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php $number = 1; foreach ($customer as $u): ?>
                    <tr>
                        <td><?= $number ?></td>
                        <td><?= esc($u->name) ?></td>
                        <td><?= esc($u->email) ?></td>
                        <td><?= esc($u->group_session ?? '-') ?></td>
                        <td><?= esc($u->private_session ?? '-') ?></td>
                        <td><?= esc($u->expiration ?? '-') ?></td>
                        <td class="actions">
                            <button class="btn-detail" onClick="edit_click(<?= $u->id ?? '0' ?>)" data-toggle="modal" data-target="#modalEdit">Edit</button>
                        </td>
                    </tr>
                <?php $number++; endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function () {
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
            url: '/viewCustomer',
            type: 'POST',
            dataType: 'json',
            data: { id: id },
            success: function(data) {
                console.log(data);
                if (data.status === 'success' && data.result) {
                    $("#edit_id").val(data.result.id);
                    $("#edit_name").val(data.result.name);
                    $("#edit_email").val(data.result.email);
                    $("#edit_group").val(data.result.group_session ?? 0);
                    $("#edit_private").val(data.result.private_session ?? 0);
                    $("#edit_expiration").val(data.result.expiration ?? '');
                } else {
                    console.error('Invalid response:', data);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
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