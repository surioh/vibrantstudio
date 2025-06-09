<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    
    <link href="template/bootstrap-4.0.0/dist/css/bootstrap.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="css/sweetalert2.min.css" rel="stylesheet">
    <style>
                /* Reset and base styles */
                * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        body {
            margin: 0;
            background-color: #f9fafb;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #ffffff;
            padding: 1.5rem;
            height: 100vh;
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
            position: fixed;
            border-right: 1px #C7C8CC solid;
        }

        .brand {
            margin-bottom: 2rem;
        }

        .brand h2 {
            color: #3b82f6;
            margin: 0;
            font-size: 1.5rem;
        }

        .brand small {
            color: #6b7280;
        }

        .menu {
            display: flex;
            flex-direction: column;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #6b7280;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 0.5rem;
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
        }

        .menu-item:hover {
            background-color:rgb(255, 255, 255);
            color: #EFBC9B;
            text-decoration:none;
        }

        .menu-item.active {
            background-color: #C5705D;
            color: #ffffff;
        }

        /* Main content */
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            width: calc(100% - 250px);
        }

        .header {
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 1.75rem;
            color: #374151;
        }

        /* Card */
        .card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 1.5rem;
        }

        /* Table */
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .btn-primary {
            background-color: #C5705D;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #EFBC9B;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 0.75rem;
            border-bottom: 1px solid rgb(190, 190, 190);
            font-size: 0.95rem;
        }

        th {
            color: #6b7280;
            font-weight: 600;
        }

        .actions button {
            margin-right: 0.5rem;
            border: none;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-detail {
            background-color: #AB886D;
            color: white;
        }

        .btn-hapus {
            background-color: #C96868;
            color: white;
        }

        .search-box {
            display: flex;
            align-items: center;
        }

        .search-box input {
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            width: 200px;
        }
        a {
            margin: 0 1rem;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            transition: color 0.3s;
        }
        a:hover {
            color: var(--primary);
            text-decoration: none;
        }

        .cta-button {
            background-color: #C5705D;
            color: white !important;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }
        .cta-button:hover {
            background-color: #EFBC9B;
        }
    </style>

    <script src="js/sweetalert2.all.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="template/bootstrap-4.0.0/dist/js/bootstrap.js"></script>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            <img src="image/FA VIBRAN artwork-01.png" alt="Vibrant Logo" style="height: 60px;">
        </div>
        <nav class="menu">
            <a href="<?= site_url('msKelas') ?>" class="menu-item <?= $active == 'msKelas' ? 'active' : '' ?>">Master Kelas</a>
            <a href="<?= site_url('msUser') ?>" class="menu-item <?= $active == 'msUser' ? 'active' : '' ?>">Master User</a>
            <a href="<?= site_url('msSchedule') ?>" class="menu-item <?= $active == 'msSchedule' ? 'active' : '' ?>">Master Jadwal</a>
            <a href="<?= site_url('actualSchedule') ?>" class="menu-item <?= $active == 'actualSchedule' ? 'active' : '' ?>">Jadwal Bulan Ini</a>
            <a href="<?= site_url(relativePath: 'todaySchedule') ?>" class="menu-item <?= $active == 'todaySchedule' ? 'active' : '' ?>">Jadwal Hari Ini</a>
            <a href="<?= site_url('msCustomer') ?>" class="menu-item <?= $active == 'msCustomer' ? 'active' : '' ?>">Customer</a>
        </nav>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <?= $this->renderSection('content') ?>
    </div>
</body>

<script>
    window.addEventListener('load', function () {
        // document.getElementById('loader').style.display = 'none';
    });
</script>

</html>
