<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vibrant</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS for Carousel -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
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

    body {
        font-family: 'Montserrat', sans-serif;
        margin: 0;
        padding: 0;
        background-color: rgba(255, 254, 254, 0.88);
    }

    body::before {
            content: '';
            background: url('<?php echo base_url() ?>image/FA VIBRAN artwork-01.png') no-repeat center center;
            background-size: contain; /* Scales the image proportionally */
            opacity: 0.13; /* Adjust opacity as needed */
            position: fixed; /* Keeps the image in place on scroll */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

    header {
        background: linear-gradient(to top, #ff6b6b, rgb(246, 168, 168));
        color: white;
        flex-direction: row;
        align-items: center;
        padding: 10px 20px;
        position: relative;
        text-align: center; /* Center align content */
    }

    /* Ensure carousel fits within promo div */
    .promo .carousel-inner,
    .promo .carousel-item,
    .promo .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover; 
    }

    .header-content {
        display: flex;
        flex-direction: column; /* Stack items vertically for centering */
        align-items: center; /* Center items horizontally */
        justify-content: center; /* Center items vertically */
        width: 100%;
        gap: 10px; /* Space between logo and welcome text */
    }

    .welcome-text {
        text-align: left; /* Left-align the welcome text */
        flex-grow: 1;
    }

    .logo {
        margin: 50px auto 0; /* Center the logo horizontally */
        height: auto; /* Maintain aspect ratio */
    }

    .ribbon {
        position: absolute;
        top: -8px; /* Adjust based on ribbon image height */
        left: 50%;
        transform: translateX(-50%); /* Center the ribbon horizontally */
        width: 100%; /* Adjust width as needed */
        max-width: 400px;
        z-index: 10; /* Ensure ribbon is above header content */
    }

    .burger-menu {
        position: absolute;
        right: 20px;
        top: 50%; /* Center vertically in the header */
        transform: translateY(-50%); /* Adjust for vertical centering */
        font-size: 28px; /* Match the font size of the h1 for consistency */
        line-height: 1; /* Remove extra spacing */
        display: flex;
        align-items: center;
        height: 44px; /* Match the combined height of welcome text (28px + 16px) */
        cursor: pointer;
    }

    .promo {
        background-color: #ddd;
        text-align: center;
        margin: 20px;
        border-radius: 15px;
        font-weight: bold;
        overflow: hidden;
        aspect-ratio: 16 / 9; /* Maintain responsive size */
        max-width: 100%;
        position: relative;
    }

    /* ------------------- MOBILE STYLES (Default) ------------------- */
    header {
        flex-direction: column; /* Keep column to stack logo and text */
        text-align: left; /* Align content to the left */
        position: relative;
        padding: 10px 20px;
    }

    .header-content {
        flex-direction: column; /* Stack logo and welcome text vertically */
        align-items: flex-start; /* Align items to the left */ 
        gap: 0px; /* Remove gap between logo and text */
    }

    .welcome-text {
        text-align: left; /* Ensure text is left-aligned */
    }

    .welcome-text p {
        padding-top: 15px;
        margin: 7px; /* Remove default margin on the paragraph */
    }

    .welcome-text h1 {
        margin: 0; /* Remove default margin on the h1, keeping it tight */
        margin-left: 7px;
        font-size: 32px; /* Ensure font size is preserved */
        padding-bottom: 15px;
    }

    .burger-menu {
        position: absolute;
        right: 40px;
        top: 138px; /* Align with the top of the logo */
        font-size: 24px;
        line-height: 1;
        display: flex;
        align-items: center;
        height: 60px; /* Match the logo height for alignment */
    }

    h3 {
        margin: 20px;
        font-weight: bold;
        color: var(--text-dark);
    }

    .session-card {
        background-color: #6CBDFF; /* Match the light blue from the second image */
        color: #fff; /* White text to match */
        margin: 10px 20px; /* Reduced margin to match spacing */
        padding: 20px; /* Match padding */
        border-radius: 15px; /* Match border-radius */
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .session-card:hover {
        background-color:rgb(128, 171, 176); /* Light blue hover effect */
    }

    .session-card .time {
        font-size: 0.9rem; /* Match the time font size */
        min-width: 70px; /* Match width */
        text-align: center; /* Align left to match */
    }

    .session-card .details {
        flex-grow: 1;
        text-align: left;
        padding-left: 15px; /* Match spacing */
    }

    .session-card .details .class-name {
        font-size: 1.2rem;
        font-weight: bold;
        margin: 5px; 
        color: #000000;
    }

    .session-card .details .coach {
        font-size: 0.9rem; /* Bigger coach name to match */
        color: #000000; /* White text to match */
        margin: 0;
        margin-left: 5px; 
        margin-bottom: 5px;
    }

    .session-card .date {
        font-size: 0.95rem; 
        color: #fff;
        min-width: 60px;
        text-align: right;
    }

    .session-summary {
        background-color: rgb(255, 255, 255);
        margin: 20px;
        padding: 15px 10px;
        border-radius: 20px;
        border: 1px solid grey;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .session-stats {
        display: flex;
        justify-content: space-between;
    }

    .no-session {
        margin-left: 23px;
    }

    .stat-number {
        margin-bottom: 5px;
    }

    .stat-box {
        flex: 1;
        text-align: center;
        font-weight: bold;
    }

    .stat-box span {
        display: block;
        font-size: 12px;
        color: var(--text-light);
        font-weight: normal;
    }

    .book-btn {
        background-color: #ff8787;
        color: white;
        font-weight: bold;
        font-size: 16px;
        text-decoration: none;
        border: none;
        padding: 15px;
        margin: 30px auto;
        display: block;
        border-radius: 12px;
        width: 80%;
        text-align: center;
        cursor: pointer;
    }

    .book-btn:hover {
        background-color: #ff6b6b;
    }

    footer {
        text-align: center;
        font-size: 12px;
        color: #999;
        padding-bottom: 20px;
    }

    /* ------------------- DESKTOP STYLES ------------------- */
    @media (min-width: 601px) {
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        body::before {
            content: '';
            background: url('<?php echo base_url() ?>image/FA VIBRAN artwork-01.png') no-repeat center center;
            background-size: 20%; /* Scales the image proportionally */
            opacity: 0.15; /* Adjust opacity as needed */
            position: fixed; /* Keeps the image in place on scroll */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Places it behind all content */
        }

        header {
            width: 100%;
            padding: 10px 0;
        }

        .header-content {
            max-width: 400px; 
            margin: 0 auto;
        }

        .session-card {
            max-width: 300px;
            margin: 0 auto 10px; 
            padding: 15px; 
        }

        .burger-menu {
            right: calc((100% - 400px) / 2 + 20px); /* Align with constrained content */
        }

        .promo {
            max-width: 400px;
            aspect-ratio: 16 / 9;
            margin: 20px auto;
            position: relative;
        }

        h3 {
            max-width: 400px;
            margin: 20px auto;
        }

        .session-summary {
            max-width: 400px;
            padding: 20px 110px;;
            border: 1px solid grey;
            margin: 20px auto;
        }

        .book-btn {
            max-width: 400px;
        }

        footer {
            max-width: 400px;
            margin: 0 auto;
        }
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: white;
        padding: 40px 25px;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        gap: 15px;
        width: 80%;
        max-width: 300px;
        text-align: center;
    }

    .modal-content a {
        text-decoration: none;
        color: #d45d67;
        font-weight: bold;
        padding: 18px;
        font-size: 1.1rem;
        transition: 0.2s;
        margin-top: 10px;
        border-radius: 15px;
        border: 1px solid #d45d67;
    }

    .modal-content a:hover {
        color: #a93e4f;
    }

    .cta-button {
        background: #d45d67;
        color: white !important;
        padding: 10px;
        border-radius: 8px;
        margin-top: 10px;
    }
    </style>
</head>

<body>
    <?php echo view('nav/navmobile');?>

    <div class="promo">
        <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?php echo base_url() ?>image/studio4.png" class="d-block w-100" alt="Promo 1">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo base_url() ?>image/studio2.png" class="d-block w-100" alt="Promo 2">
                </div>
                <div class="carousel-item">
                    <img src="<?php echo base_url() ?>image/studio3.png" class="d-block w-100" alt="Promo 3">
                </div>
            </div>
        </div>
    </div>

    <h3>Your upcoming sessions</h3>
        <?php if (empty($bookedSession)): ?>
            <p class="no-session">You have no upcoming sessions</p>
        <?php else: ?>
            <?php foreach ($bookedSession as $session): ?>
                <div class="session-card" data-id="<?php echo $session['user_schedule_id'] ?>">
                    <div class="time">
                        <?php echo date('h:i A', strtotime($session['jam_mulai'])); ?> <br> - <br>
                        <?php echo date('h:i A', strtotime($session['jam_selesai'])); ?>
                    </div>
                    <div class="details">
                        <div class="class-name">
                            <?php echo $session['class_name_override'] ?? $session['class_name']; ?>
                        </div>
                        <div class="coach"><?php echo $session['coach_name'] ?? 'Coach TBD'; ?></div>
                    </div>
                    <div class="date">
                        <?php echo date('D, m-d', strtotime($session['tanggal'])); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    <div class="session-summary">
        <div class="session-stats stat-container">
            <div class="stat-box">
                <div class="stat-number"><?php echo $groupSession ?></div>
                <div class="stat-label">Group Session</div>
            </div>
            <div class="stat-box">
                <div class="stat-number"><?php echo $privateSession ?></div>
                <div class="stat-label">Private Session</div>
            </div>
        </div>
    </div>

    <a href="/topup" class="book-btn">Book More Sessions!</a>

    <footer>
        © 2025 VIBRANT - Sound of Body & Soul. All rights reserved.
    </footer>
    
    <form id="cancel_book_form" action="cancel_booking" method="post">
        <input type="hidden" value="" id="delete_id" name="id" />
    </form>
    <!-- Modal for Burger Menu -->
    <div id="burgerModal" class="modal">
        <div class="modal-content">
            <a href="/scheduleMobile">Schedule</a>
            <a href="/topup">Topup</a>
            <a class="cta-button" href="/logout">Logout</a>
        </div>
    </div>

    <!-- Bootstrap JS for Carousel -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Burger Menu Modal
        const burgerModal = document.getElementById('burgerModal');
        document.querySelector('.burger-menu').addEventListener('click', function() {
            burgerModal.style.display = 'flex';
        });

        burgerModal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });

        // Debug: Check if session cards exist
        const sessionCards = document.querySelectorAll('.session-card');
        console.log('Found session cards:', sessionCards.length);

        // Add click event listeners to session cards
        sessionCards.forEach(card => {
            card.addEventListener('click', function() {
                console.log('Card clicked'); // Debug log
                const className = this.querySelector('.class-name')?.textContent || 'Unknown Class';
                const coach = this.querySelector('.coach')?.textContent || 'Unknown Coach';
                const date = this.querySelector('.date')?.textContent || 'Unknown Date';
                const timeRange = this.querySelector('.time')?.textContent || 'Unknown Time';
                const id = this.getAttribute('data-id');
                document.getElementById("delete_id").value=id;

                Swal.fire({
                    title: "Manage Session",
                    text: `Do you want to manage this ${className} session on ${date} from ${timeRange} with ${coach}?`,
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No"
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log(`Managing session: ${className} on ${date} at ${timeRange}`); // Debug log
                        document.getElementById("cancel_book_form").submit();
                        // Add your logic here for managing the session (e.g., redirect to a manage page)
                        // Example: window.location.href = `/manageSession?id=${card.dataset.id}`; (if you have an ID)
                    }
                });
            });
        });
    });
    </script>
</body>

</html>