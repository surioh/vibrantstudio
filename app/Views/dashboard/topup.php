<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vibrant Top Up</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


    <style>
    :root {
        --primary: #ff8787;
        --background:rgb(253, 251, 251);
        --text-dark: #222;
        --text-light: #666;
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Montserrat', sans-serif;
        margin: 0;
        padding: 0;
        background-color: var(--background);
        font-size: 16px; /* Base font size */
    }

    body::before {
        content: '';
        background: url('<?php echo base_url() ?>image/FA VIBRAN artwork-01.png') no-repeat center center;
        background-size: contain; /* Scales the image proportionally */
        opacity: 0.3; /* Adjust opacity as needed */
        position: fixed; /* Keeps the image in place on scroll */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1; /* Places it behind all content */
    }

    header {
        width: 100vw;
        background: linear-gradient(to bottom, #ff6b6b, rgb(230, 140, 140));
        background-image: url("<?php echo base_url() ?>image/PATERN-01.png"), linear-gradient(to bottom, #ff6b6b, rgb(230, 140, 140));
        background-repeat: repeat-x, no-repeat;
        background-size: auto 40px, cover;
        background-position: top, center;

        color: white;
        padding: 50px 20px 15px; /* Enough top padding for ribbon visibility */
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        box-sizing: border-box;

        /* background: linear-gradient(to bottom, #ff6b6b,rgb(230, 140, 140));
        color: white;
        padding: 10px 20px;
        display: block;
        justify-content: space-between;
        align-items: center;
        position: relative; */
    }

    .header-content {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        /* display: flex;
        align-items: center;
        width: 100%;
        justify-content: space-between;
        padding: 10px 20px; apply padding here */
    }

    /* .ribbon-top {
        width: 100%;
        height: 40px;
        background-size: auto 100%;
    }

    @media (width >= 30em) {
        .ribbon-top {
            display: none;
        }
    }

    .ribbon-image {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
    } */

    .logo {
        height: 50px; /* Logo size */
    }
    
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        width: 80%;
        max-width: 400px;
        text-align: center;
    }

    .modal-content a {
        display: block;
        text-decoration: none;
        color: #d45d67;
        font-weight: bold;
        padding: 18px;
        font-size: 1.1rem;
        transition: 0.2s;
        margin-top: 20px;
        border-radius: 15px;
        border: 1px solid #d45d67;
    }

    .modal-content a:hover {
        background-color: var(--primary);
        color: white;
        border-radius: 5px;
    }

    .cta-button {
        background-color: var(--primary);
        color: white;
        padding: 10px;
        border-radius: 5px;
    }

    .burger-menu {
        font-size: 24px;
        cursor: pointer;
        transition: color 0.3s;
    }

    .burger-menu:hover {
        color: var(--primary);
    }

    .section-title {
        text-align: center;
        font-size: 35px;
        font-weight: 700;
        margin: 35px 20px 10px;
        color: var(--text-dark);
    }

    .package-section {
        margin: 0 20px 20px;
        padding: 12px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .package-header {
        display: flex;
        justify-content: space-between;
        font-weight: 600;
        padding: 5px 0; /* Increased padding for header */
        color: var(--text-dark);
        font-size: 20px; /* Increased header text size */
    }

    .package-item {
        display: flex;
        justify-content: space-between;
        padding: 20px;
        /* background-color: var(--primary); */
        background: linear-gradient(to right, #ff8787,rgb(227, 151, 101));
        color: white;
        margin: 8px 0; 
        border-radius: 8px;
        border: 1.5px solid rgb(215, 101, 101);
        font-weight: bold;
        font-size: 18px; 
        min-height: 70px; 
        align-items: center; 
    }

    .package-inside {
        color:rgb(236, 229, 229);
        font-size: 16px;
        font-weight: 500;
    }

    #inside-name {
        color: white;
        font-size: 18px;
        font-weight: 700;
    }

    .cta-button {
        background: #d45d67;
        color: white !important;
        padding: 10px;
        border-radius: 8px;
        margin-top: 10px;
    }

    /* Mobile-specific adjustments */
    @media (max-width: 600px) {
        .package-header, .package-item {
            display: flex;
            justify-content: space-between;
            text-align: center;
        }

        .package-header div, .package-item div {
            flex: 1;
            margin: 0 6px; /* Increased spacing between columns */
        }

        .package-header div:first-child, .package-item div:first-child {
            text-align: left;
        }

        .package-header div:last-child, .package-item div:last-child {
            text-align: right;
        }
    }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <header>
        <!-- <div class="ribbon-top">
            <img src="image/PATERN-01.png" alt="Decorative Ribbon" class="ribbon-image">
        </div> -->
        <div class="header-content">
            <img src="<?php echo base_url() ?>image/FA VIBRAN artwork-01.png" alt="Vibrant Logo" class="logo" />
            <div class="hamburger" onclick="toggleMenu()">☰</div>
        </div>
    </header>
    <?php 
        function formatRupiahK($value) {
            $value = (int) $value;
            if ($value >= 1000) {
                return 'Rp. ' . number_format($value / 1000, 0, ',', '.') . 'K';
            }
            return 'Rp. ' . number_format($value, 0, ',', '.');
        }
    ?>
    <div class="section-title">Group Class</div>
    <div class="package-section">
        <div class="package-header">
            <div>Package</div>
            <div>Price</div>
            <div>Valid For</div>
        </div>

        <?php foreach ($group as $p){ ?>
            <div class="package-item" data-sales="<?php echo $p->sales_id; ?>" data-price="<?php echo $p->harga; ?>">
                <div class="package-inside" id="inside-name"><?php echo $p->package_name; ?></div>
                <div class="package-inside"><?php echo formatRupiahK($p->harga); ?></div>
                <div class="package-inside"><?php echo $p->valid_for; ?></div>
            </div>
        <?php }?>
    </div>

    <div class="section-title">Private Class</div>
    <div class="package-section">
        <div class="package-header">
            <div>Package</div>
            <div>Price</div>
            <div>Valid For</div>
        </div>
        
        <?php foreach ($private as $p){ ?>
            <div class="package-item" data-sales="<?php echo $p->sales_id; ?>" data-price="<?php echo $p->harga; ?>">
                <div class="package-inside" id="inside-name"><?php echo $p->package_name; ?></div>
                <div class="package-inside"><?php echo formatRupiahK($p->harga); ?></div>
                <div class="package-inside"><?php echo $p->valid_for; ?></div>
            </div>
        <?php }?>
    </div>

    <script>
        function toggleMenu() {
            const burgerModal = document.getElementById('burgerModal');
            burgerModal.style.display = burgerModal.style.display === 'flex' ? 'none' : 'flex';
        }

        document.addEventListener('DOMContentLoaded', () => {
            const burgerModal = document.getElementById('burgerModal');
            
            // Close modal on outside click
            burgerModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.style.display = 'none';
                }
            });

            // Close modal on Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && burgerModal.style.display === 'flex') {
                    burgerModal.style.display = 'none';
                }
            });
        });

    document.querySelectorAll('.package-item').forEach(item => {
        item.addEventListener('click', () => {
            Swal.fire({
                title: "Cara Pembayaran",
                icon: "success",
                html: `
                    <p style="margin-bottom: 10px;">Kirim bukti transfer pembelian paket melalui Whatsapp dibawah ini</p>
                    <p style="margin-bottom: 20px;">disertakan dengan note "nama paket + private/group"</p>
                    <a href="http://wa.me/+628119271910" target="_blank" style="display: inline-block;">
                        <img src="<?php echo base_url() ?>image/wa-icon.png" 
                            alt="WhatsApp"
                            style="width: 174px; height: 114px; border-radius: 10px; transition: transform 0.3s;"
                            onmouseover="this.style.transform='scale(1.1)'" 
                            onmouseout="this.style.transform='scale(1)'">
                    </a>
                `,
                showConfirmButton: false
            });
        });
    });
    </script>

    <!-- Modal for Burger Menu -->
    <div id="burgerModal" class="modal">
        <div class="modal-content">
            <a href="/userMobile">Home</a>
            <a href="/scheduleMobile">Schedule</a>
            <a class="cta-button" href="/logout">Logout</a>
        </div>
    </div>

</body>

</html>