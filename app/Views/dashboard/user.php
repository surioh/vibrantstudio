<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VIBRANT - Your Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #00c2a8;
      --accent1: #ffc85c;
      --accent2: rgb(239, 164, 174);
      --accent3: #007da8;
      --accent4: rgba(222, 195, 136, 0.88);
      --neutral: #f7f7f7;
      --text-dark: #222;
      --text-light: #666;
    }
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Montserrat', sans-serif;
    }
    body {
      background-color: var(--neutral);
      color: var(--text-dark);
      line-height: 1.6;
      position: relative;
      overflow-x: hidden;
    }
    body::before {
      content: '';
      background: url('<?php echo base_url() ?>image/FA VIBRAN artwork-01.png') no-repeat center center;
      background-size: 40%;
      opacity: 0.05;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    }
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 40px;
      background-color: #fff8fb;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
      position: sticky;
      top: 0;
      z-index: 1000;
    }
    nav a {
      margin: 0 1rem;
      text-decoration: none;
      color: var(--text-dark);
      font-weight: 500;
      transition: color 0.3s;
    }
    nav a:hover {
      color: var(--primary);
    }
    .main-nav {
      display: flex;
      align-items: center;
      gap: 25px;
    }
    .nav-links {
      display: flex;
      justify-content: center;
      gap: 25px;
      flex-grow: 1; 
    }
    .cta-button {
      background-color: rgb(194, 70, 111);
      color: white !important;
      padding: 10px 20px;
      border-radius: 30px;
      font-weight: 600;
      transition: background-color 0.3s ease;
      text-decoration: none;
    }
    .cta-button:hover {
      background-color: #d81b60;
    }
    .section {
      padding: 4rem 2rem;
      max-width: 1000px;
      margin: 0 auto;
      animation: fadeIn 1.2s ease-in;
    }
    .card {
      background: white;
      padding: 1.5rem;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      margin-bottom: 2rem;
    }
    h2 {
      margin-bottom: 1rem;
      color: var(--accent3);
    }
    p {
      margin-bottom: 0.5rem;
    }
    footer {
      text-align: center;
      padding: 2rem;
      background: white;
      color: var(--text-light);
      font-size: 0.9rem;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 768px) {
      header {
        flex-direction: column;
        align-items: flex-start;
      }
      nav {
        margin: 1rem 0;
      }
    }
  </style>
</head>
<body>
  <?php echo view('nav/navout');?>

  <section class="section">
        <?php if($email){ ?>
            <h1>Welcome, <?php echo $email; ?>!</h1>
            <div class="biodata">
                <h2>Your Biodata</h2>
                <p><strong>Name:</strong> <?= esc($userData['name']) ?></p>
                <p><strong>Email:</strong> <?= esc($userData['email']) ?></p>
                <p><strong>Phone:</strong> <?= esc($userData['phone']) ?: 'Not provided' ?></p>
                <p><strong>Date of Birth:</strong> <?= esc($userData['date_of_birth']) ?: 'Not provided' ?></p>
                <p><strong>Role:</strong> <?= esc($userData['role']) ?></p>
                <p><strong>Account Status:</strong> <?= $userData['is_active'] ? 'Active' : 'Inactive' ?></p>
                <p><strong>Created By:</strong> <?= esc($userData['created_by']) ?></p>
            </div>
        <?php }else{ ?>
            <h1>Error: User data not available</h1>
            <p>Please log in again or contact support.</p>
            <a href="/login" class="cta-button">Go to Login</a>
        <?php } ?>
    </section>

    <section id="class" class="section">
    <div class="card">
        <h2>Your Class</h2>
        <p><strong>Class Name:</strong> Reformer Class</p>
        <p><strong>Instructor:</strong> Maria Yoga</p>
        <p><strong>Level:</strong> Intermediate</p>
    </div>
    </section>

    <section class="section" id="schedule">
        <h2>Class Schedule</h2>
        <p>Schedule details will appear here soon. Stay tuned!</p>
        <div style="height: 300px; background: #fff; border-radius: 12px; margin-top: 2rem; display: flex; align-items: center; justify-content: center; color: var(--text-light); font-style: italic; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
        [ Schedule loading... ]
        </div>
    </section>
    
    <?php echo view('footer/foot');?> ?>

</body>
</html>
