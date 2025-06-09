<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VIBRANT - Sound of Body & Soul</title>
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
        #loader {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100vw;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 200;
        }
        #loader img {
            width: 150px;
            animation: fadeInZoom 1.5s ease-in-out infinite alternate;
        }
        @keyframes fadeInZoom {
            from { opacity: 0.3; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
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
        .main-nav a {
            align-items: center;
            text-decoration: none;
            color: rgb(66, 26, 53);
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .main-nav a:hover {
            color: rgb(218, 84, 128);
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
       
        .hero {
          text-align: center;
          padding: 6rem 2rem 4rem;
          background: linear-gradient(120deg, var(--accent2), var(--accent4));
          color: white;
          animation: fadeIn 1.5s ease-in;
        }

        .hero h1 {
          font-size: 3rem;
          margin-bottom: 1rem;
        }

        .hero p {
          font-size: 1.2rem;
          margin-bottom: 2rem;
        }

        .section {
          padding: 4rem 2rem;
          max-width: 1000px;
          margin: 0 auto;
          animation: fadeIn 1.2s ease-in;
        }

        .carousel {
          position: relative;
          max-width: 600px;
          margin: auto;
          overflow: hidden;
        }

        .carousel-image {
          display: none;
          width: 100%;
          border-radius: 12px;
        }

        .carousel-image.active {
          display: block;
        }

        .carousel-controls {
          position: absolute;
          bottom: 10px;
          width: 100%;
          display: flex;
          justify-content: space-between;
          padding: 0 10px;
        }

        .carousel-controls button {
          background-color: var(--primary);
          width: 50px;
          height: 50px;
          font-size: 24px;
          border: none;
          color: white;
          cursor: pointer;
          border-radius: 50%;
          transition: background-color 0.3s ease;
        }
        
        .cards {
          display: grid;
          grid-template-columns: repeat(2, 1fr); /* 2x2 grid */
          gap: 1.5rem;
          margin-top: 2rem;
        }

        .card {
          background: white;
          padding: 1.5rem;
          border-radius: 12px;
          box-shadow: 0 4px 12px rgba(0,0,0,0.08);
          transition: transform 0.3s, box-shadow 0.3s;
          border: none;
          text-align: left;
          cursor: pointer;
        }

        .card:hover {
          transform: translateY(-5px);
          box-shadow: 0 6px 16px rgba(0,0,0,0.15);
        }

        button.card h3, button.card p {
          color: var(--text-dark);
        }

        form input, form select {
          width: 100%;
          padding: 0.5rem;
          margin: 0.5rem 0 1rem;
          border: 1px solid #ccc;
          border-radius: 6px;
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
          .hero h1 {
            font-size: 2.2rem;
          }
        }
    </style>

</head>
<body>
    <div id="loader">
        <img src="<?php echo base_url() ?>image/FA VIBRAN artwork-01.png" alt="Loading..." />
    </div>

    <?php include 'C:\xampp\htdocs\vibrant\app\Views\nav\nav.php'; ?>

    <section class="hero">
        <h1>Reconnect with Your Body & Soul</h1>
        <img src="image/organic-flat-people-meditating-illustration.png" alt="Yoga Vector" style="height: 550px;">
        <p>Join our expert-led Pilates classes in a calming, vibrant environment.</p>
        <a href="#classes" class="cta-button">Explore Classes</a>
    </section>

    <section id="classes" class="section">
      <h2>Our Classes</h2>
      <div class="cards">
        <button class="card" onclick="location.href='/classes'">
          <h3>Reformer Class</h3>
          <p>Pilates Reformer class helps improve flexibility, core strength, agility, and posture.</p>
        </button>
        <button class="card" onclick="location.href='class-template.html?class=halftower'">
          <h3>Half Tower</h3>
          <p>A Pilates tower class targets all major muscle groups, improving endurance and spinal mobility.</p>
        </button>
        <button class="card" onclick="location.href='class-template.html?class=wunda'">
          <h3>Wunda Chair</h3>
          <p>Wunda Chair Pilates combines elegance and effectiveness to improve core strength, flexibility, and body balance.</p>
        </button>
        <button class="card" onclick="location.href='class-template.html?class=cadillac'">
          <h3>Cadillac Pilates</h3>
          <p>Cadillac Pilates offers benefits like improved strength, flexibility, core stability, and injury prevention.</p>
        </button>
      </div>
    </section>

    <section id="studio" class="section">
      <h2>Studio Preview</h2>
      <div class="carousel">
        <img src="<?php echo base_url() ?>image/studio1.png" class="carousel-image" alt="Studio 1">    
        <img src="<?php echo base_url() ?>image/studio2.png" class="carousel-image" alt="Studio 2">
        <img src="<?php echo base_url() ?>image/studio3.png" class="carousel-image" alt="Studio 3">
        <div class="carousel-controls">
          <button id="prevImage">‹</button>
          <button id="nextImage">›</button>
        </div>
      </div>
    </section>

      <section id="testimonials" class="section">
        <h2>What Our Clients Say</h2>
        <div class="cards">
          <div class="card">
            <p>“I feel stronger and more centered since I started classes at Vibrant.”</p>
            <small>- Sarah L.</small>
          </div>
          <div class="card">
            <p>“The atmosphere is peaceful and the instructors are amazing.”</p>
            <small>- Daniel K.</small>
          </div>
        </div>
      </section>

      <?php include 'C:\xampp\htdocs\vibrant\app\Views\footer\foot.php'; ?>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
<script>
    window.addEventListener('load', function () {
        document.getElementById('loader').style.display = 'none';
    });

    $(document).ready(function(){
        let currentImage = 0;
        let images = document.querySelectorAll('.carousel-image');

        function showImage(index) {
            images.forEach((img, i) => {
                img.classList.toggle('active', i === index);
            });
        }

        $("#prevImage").click(function(){
            currentImage = (currentImage - 1 + images.length) % images.length;
            showImage(currentImage);
        });

        $("#nextImage").click(function(){
            currentImage = (currentImage + 1) % images.length;
            showImage(currentImage);
        });

        showImage(currentImage);
    });
</script>
</html>