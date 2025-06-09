<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
}

.filter-box {
    display: flex;
    align-items: center;
}

.filter-box label {
    margin-right: 5px;
    /* font-weight: bold; */
}

.filter-box select {
    padding: 5px 10px;
    border: 1px solid black;
    border-radius: 5px;
    background-color: white;
    color: black;
    /* font-weight: bold; */
    cursor: pointer;
}

.filter-box select:focus {
    outline: none;
}

.search-box {
    display: flex;
    align-items: center;
}

.search-box label {
    margin-right: 5px;
    /* font-weight: bold; */
}

.search-box input {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
</style>

<div class="header">
    <h1>Schedule Hari Ini</h1>
</div>

<div class="card">
    <div class="table-header">
        <div class="filter-box">
            <label for="class-type">Class Type: </label>
            <select id="class-type" name="class-type">
                <option value="all">All Classes</option>
                <option value="Reformer">Reformer</option>
                <option value="Half Tower">Half Tower</option>
                <option value="Wunda Chair">Wunda Chair</option>
                <option value="Cadillac">Cadillac</option>
            </select>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="exportTodayScheduleExcel"><button class="btn btn-success">Export Excel</button></a>
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
                    <th>Nama Kelas</th>
                    <th>Hari</th>
                    <th>Tanggal</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Coach</th>
                    <th>Customer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $key => $value) { ?>
                <tr>
                    <td><?php echo $value->class_name_override ?: $value->nama_kelas; ?></td>
                    <td><?php echo $value->hari; ?></td>
                    <td><?php echo $value->tanggal; ?></td>
                    <td><?php echo $value->jam_mulai; ?></td>
                    <td><?php echo $value->jam_selesai; ?></td>
                    <td><?php echo $value->coach_name; ?></td>
                    <td><?php echo $value->customer_names; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    // Combined search and class type filter functionality
    function filterTable() {
        var searchText = $('#search').val().toLowerCase();
        var selectedClass = $('#class-type').val().toLowerCase();

        $('table tbody tr').each(function() {
            var className = $(this).find('td:nth-child(1)').text().toLowerCase();
            var matchesSearch = className.includes(searchText);
            var matchesClass = (selectedClass === 'all' || className === selectedClass);

            if (matchesSearch && matchesClass) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // Trigger filter on search input
    $('#search').on('keyup', function() {
        filterTable();
    });

    // Trigger filter on class type change
    $('#class-type').on('change', function() {
        filterTable();
    });
});
</script>

<?= $this->endSection() ?>