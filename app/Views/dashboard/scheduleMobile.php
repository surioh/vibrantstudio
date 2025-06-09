<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reformer Classes</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Montserrat', sans-serif;
    }

    body {
        background: #fff;
        display: flex;
        justify-content: center;
    }

    .mobile-wrapper {
        width: 100%;
        max-width: 430px;
        min-height: 100vh;
        padding: 0 10px;
        background: #fff;
    }

    header {
        width: 100vw;
        background: linear-gradient(90deg, #d45d67, #d98285);
        background-image: url("<?php echo base_url() ?>image/PATERN-01.png"), linear-gradient(90deg, #d45d67, #d98285);
        background-repeat: repeat-x, no-repeat;
        background-size: auto 40px, cover;
        background-position: top, center;

        padding: 55px 20px 15px; /* Add top padding for ribbon space */
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        box-sizing: border-box;
        /* width: 100vw;
        background: linear-gradient(90deg, #d45d67, #d98285);
        padding: 15px 20px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw; */
    }

    .ribbon-top {
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
    }

    .logo {
        font-weight: bold;
        font-size: 1.2rem;
    }

    .logo img {
        height: 35px;
    }

    .hamburger {
        font-size: 1.5rem;
        cursor: pointer;
    }

    .calendar-header {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        margin-top: 15px;
    }

    .month {
        font-weight: bold;
        font-size: 1.2rem;
    }

    .week-arrow {
        margin: 0 35px;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        font-weight: bold;
        font-size: 1rem;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background 0.3s;
    }

    .week-arrow:hover {
        background: #ccc;
    }

    .day-selector {
        display: flex;
        overflow-x: auto;
        gap: 8px;
        background: #eee;
        padding: 10px;
        border-radius: 12px;
        margin: 10px 0 20px;
    }

    .day {
        width: 45px;
        height: 45px;
        min-width: 45px;
        border-radius: 50%;
        font-weight: 600;
        font-size: 0.85rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: none;
        background: transparent;
        color: #444;
        flex-shrink: 0;
        cursor: pointer;
    }

    .day.active {
        background: #6CBDFF;
        color:rgb(243, 240, 240);
        font-weight: bold;
    }

    .classes {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .class-button {
        margin-top: 15px;
        margin-bottom: 25px;
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .class-button button {
        background-color: white;
        border: 1px solid #f99393;
        border-radius: 10px;
        color: #A62C2C;
        padding: 5px 15px;
        text-align: center;
        text-decoration: none;
        font-size: 19px;
        font-weight: 600;
        cursor: pointer;
    }

    .class-button button:hover {
        background-color: #f99393;
        border: 1px solid white;
    }

    .class-button button.active {
        background-color: #f99393;
        color: white;
        border: 1px solid #f99393;
    }

    .class-card {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        padding: 20px;
        margin: 1.5px;
        border: 1.5px solid rgb(181, 79, 79);
        border-radius: 15px;
        /* background: #f4f4f4; */
        background: linear-gradient(to right, #ff8787,rgba(231, 178, 182, 0.7));
        font-size: 1rem;
        min-height: 100px;
    }

    .class-card .time {
        font-weight: bold;
        width: 70px;
        font-size: 1rem; /* Slightly increased for consistency */
    }

    .class-card .info {
        flex: 1;
        margin-left: 15px;
    }

    .class-card .info strong {
        font-size: 1.2rem; /* Bigger class name */
        font-weight: bold;
    }

    .class-card .info small em {
        font-size: 1rem; /* Bigger coach name */
        color: black;
    }

    .class-card.bookable {
        background-color: #f99393;
    }

    .class-card.full {
        background-color:rgb(246, 202, 202);
        color: white;
    }

    .class-card.full .action {
        color:white;
    }

    .class-card.booked {
        background-color: #6dbdff;
        color: white;
    }

    .class-card .action-container {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: center;
    }

    .class-card .action {
        white-space: nowrap;
        font-weight: bold;
        background: transparent;
        border: none;
        color: inherit;
        cursor: pointer;
        font-size: 0.85rem;
    }

    .class-card .sisa-kuota {
        font-size: 0.75rem;
        color: #666;
        margin-top: 5px;
    }

    .class-card.bookable .action {
        color: black;
    }

    .class-card.booked .action {
        color: black;
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
        background: #d45d67;
        color: white !important;
        padding: 10px;
        border-radius: 8px;
        margin-top: 10px;
    }

    /* ------------------- DESKTOP STYLES ------------------- */
    @media (min-width: 431px) {
        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .mobile-wrapper {
            max-width: 430px;
            /* Keep mobile content width */
            padding: 0 10px;
        }

        header {
            width: 100vw;
            /* Ensure full viewport width */
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
        }

        .logo {
            margin-left: calc((100vw - 430px) / 2);
            /* Center logo within constrained width */
        }

        .hamburger {
            margin-right: calc((100vw - 430px) / 2);
            /* Center hamburger within constrained width */
        }
    }

    /* ------------------- MOBILE STYLES ------------------- */
    @media (max-width: 430px) {
        header {
            width: 100vw;
            /* Ensure full viewport width on mobile */
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
        }

        .logo {
            margin-left: 0;
            /* Reset desktop centering */
        }

        .hamburger {
            margin-right: 0;
            /* Reset desktop centering */
        }
    }
    </style>

    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="mobile-wrapper">
        <header>
            <!-- <div class="ribbon-top">
                <img src="image/PATERN-01.png" alt="Decorative Ribbon" class="ribbon-image">
            </div> -->
            <div class="logo">
                <img src="<?php echo base_url() ?>image/FA VIBRAN artwork-03 2.png" alt="Logo" style="height: 35px;">
            </div>
            <div class="hamburger" onclick="toggleMenu()">☰</div>
        </header>

        <div class="calendar-header">
            <button class="week-arrow" onclick="changeWeek(-1)">❮</button>
            <div class="month" id="monthDisplay">May</div>
            <button class="week-arrow" onclick="changeWeek(1)">❯</button>
        </div>

        <div class="day-selector" id="daySelector"></div>

        <div class="class-button">
            <button type="button" data-value="Reformer">Reformer / Half Tower</button>
            <button type="button" data-value="Wunda Chair">Wunda</button>
            <button type="button" data-value="Cadillac">Cadillac</button>
        </div>

        <div class="classes" id="classList"></div>
    </div>

    <form action="booking_kelas" id="booking_kelas" method="post">
        <input type="hidden" name="actual_schedule_id" id="actual_id">
        <input type="hidden" name="tanggal" id="tanggal">
        <input type="hidden" name="class_name_override" id="class_name_override">
        <input type="hidden" name="user_session_category" id="user_session_category">
    </form>

    <script>
    const currentUserId = <?php echo $user_id; ?>;

    const daySelector = document.getElementById('daySelector');
    const monthDisplay = document.getElementById('monthDisplay');
    const classList = document.getElementById('classList');
    const classButtons = document.querySelectorAll('.class-button button'); // Select all class buttons

    // Pass PHP variables to JavaScript
    const groupSession = <?php echo json_encode($groupSession); ?>;
    const privateSession = <?php echo json_encode($privateSession); ?>;

    const dayNames = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    let weekOffset = 0;
    let selectedClass = 'Reformer';

    function toggleMenu() {
        const burgerModal = document.getElementById('burgerModal');
        burgerModal.style.display = 'flex';
    }

    document.addEventListener('DOMContentLoaded', () => {
        const burgerModal = document.getElementById('burgerModal');
        burgerModal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });

        const classButtons = document.querySelectorAll('.class-button button');
        classButtons.forEach(button => {
            button.addEventListener('click', function() {
                classButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                // Set the selected class name
                // selectedClass = this.textContent;
                selectedClass = this.getAttribute('data-value');
                // Reload the booking list with the selected class filter
                const activeDay = document.querySelector('.day.active');
                if (activeDay) {
                    const date = activeDay.getAttribute('data-date');
                    loadBookingList(date); // Reload with the new class filter
                }
            });
        });

        // Set the default active button
        classButtons[0].classList.add('active');

        // Initial load
        const activeDay = document.querySelector('.day.active');
        if (activeDay) {
            loadBookingList(activeDay.getAttribute('data-date'));
        }
    });

    function formatDMY(date) {
        const d = String(date.getDate()).padStart(2, '0');
        const m = String(date.getMonth() + 1).padStart(2, '0');
        const y = date.getFullYear();
        return `${y}-${m}-${d}`;
    }

    function getMonday(baseDate) {
        const day = baseDate.getDay();
        const offset = day === 0 ? -6 : 1 - day;
        const monday = new Date(baseDate);
        monday.setDate(baseDate.getDate() + offset);
        return monday;
    }

    function loadBookingList(date) {
        console.log('Fetching bookings for:', date, 'Class:', selectedClass);

        fetch(`/booking_list?tanggal=${encodeURIComponent(date)}`)
            .then(response => {
                if (!response.ok) throw new Error("Network response was not ok");
                return response.json();
            })
            .then(data => {
                console.log("Booking data:", data);
                console.log("selectedClass:", selectedClass);
                // Filter data based on selected class
                const filteredData = data.filter(item => {
                    const className = item.class_name_override || item.nama_kelas;

                    if (selectedClass === 'Reformer') {
                        return className === 'Reformer' || className === 'Half-Tower';
                    }

                    return className === selectedClass;
                });

                renderClassCards(filteredData);
            })
            .catch(error => {
                console.error("Fetch error:", error);
            });
    }

    function renderClassCards(data) {
        classList.innerHTML = '';

        if (data.length === 0) {
            classList.innerHTML = '<p style="text-align:center; color:#666;">No classes available</p>';
            return;
        }

        data.forEach(item => {
            let card = document.createElement('div');
            let isFull;
            let isBooked = false;
            const customerIds = item.customer_ids ? item.customer_ids.split(',') : [];

            if (customerIds.includes(String(currentUserId))) {
                isBooked = true;
            }
            
            const class_name_override = item.class_name_override;
            if (class_name_override != null) {
                item.nama_kelas = class_name_override;
            }

            if (isBooked) {
                card.className = 'class-card booked';
            } else if (item.user_session_category == "private" && item.jumlah_peserta > 0) {
                isFull = true;
                card.className = 'class-card full';
            } else {
                isFull = parseInt(item.sisa_kuota) === 0;
                card.className = 'class-card ' + (isFull ? 'full' : 'bookable book-button');
                card.setAttribute('data-id', item.actual_schedule_id);
                card.setAttribute('data-kelas', item.nama_kelas);
                card.setAttribute('data-tanggal', item.tanggal);
                card.setAttribute('data-kuota', item.kuota);
                card.setAttribute('data-sisaKuota', item.sisa_kuota);
            }

            const startTime = item.jam_mulai.split(':').slice(0, 2).join(':');
            const endTime = item.jam_selesai.split(':').slice(0, 2).join(':');
            const time = `<div class="time">${startTime} - ${endTime}</div>`;

            const info = `
                <div class="info">
                    <strong>${item.nama_kelas}</strong><br>
                    <small><em>${item.coach_name ? item.coach_name : 'Coach TBD'}</em></small>
                </div>
            `;
            const action = isBooked
                ? `<div class="action-container"><span class="action">Booked</span></div>`
                : isFull
                ? `<div class="action-container"><span class="action">Full</span></div>`
                : `<div class="action-container"><span class="action">Book Session</span><small class="sisa-kuota">Sisa Kuota: ${item.sisa_kuota}</small></div>`;

            card.innerHTML = time + info + action;
            classList.appendChild(card);
        });

        document.querySelectorAll('.book-button').forEach(button => {
            button.addEventListener('click', function() {
                let id = this.getAttribute("data-id");
                let nama_kelas = this.getAttribute("data-kelas");
                let tanggal = this.getAttribute("data-tanggal");
                let kuota = this.getAttribute("data-kuota");
                let sisa_kuota = this.getAttribute("data-sisaKuota");

                if (groupSession === 0 && privateSession === 0) {
                    Swal.fire({
                        title: "No Sessions Available",
                        text: "You have no group or private sessions to book this class. Please top up!",
                        icon: "error",
                        confirmButtonText: "Go to Topup",
                        showCancelButton: true,
                        cancelButtonText: "Cancel"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/topup";
                        }
                    });
                    return;
                }

                let classTypeSelect = '';
                if (nama_kelas === "Reformer" && sisa_kuota == kuota) {
                    classTypeSelect = `
                        <select id="class-type" class="swal2-select">
                            <option value="Reformer">Reformer</option>
                            <option value="Half-Tower">Half-Tower</option>
                        </select>
                    `;
                }

                let sessionTypeSelect = '';
                if (sisa_kuota < kuota) {
                    sessionTypeSelect = `
                        <select id="session-type" class="swal2-select">
                            ${groupSession > 0 ? '<option value="group">Group Session</option>' : ''}
                        </select>`;
                } else if (sisa_kuota == kuota) {
                    if (nama_kelas === "Cadillac") {
                        sessionTypeSelect = `
                        <select id="session-type" class="swal2-select">
                            ${privateSession > 0 ? '<option value="private">Private Session</option>' : ''}
                        </select>`;
                    } else {
                        sessionTypeSelect = `
                        <select id="session-type" class="swal2-select">
                            ${groupSession > 0 ? '<option value="group">Group Session</option>' : ''}
                            ${privateSession > 0 ? '<option value="private">Private Session</option>' : ''}
                        </select>`;
                    }
                }

                Swal.fire({
                    title: "Book Session",
                    html: `
                        <p>Available Sessions:</p>
                        <p>Group Sessions: ${groupSession}</p>
                        <p>Private Sessions: ${privateSession}</p>
                        <label for="session-type">Choose session type:</label>
                        <input type="hidden" id="session-tanggal" value="${tanggal}" />
                        <input type="hidden" id="session-id" value="${id}" />
                        ${sessionTypeSelect}
                        ${classTypeSelect}
                    `,
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, book it!",
                    preConfirm: () => {
                        const sessionType = document.getElementById('session-type').value;
                        const classType = document.getElementById('class-type')?.value || nama_kelas;
                        const actual_schedule_id = document.getElementById('session-id').value;
                        const tanggal = document.getElementById('session-tanggal').value;
                        if (!sessionType) {
                            Swal.showValidationMessage('Please select a session type');
                        }
                        document.getElementById('actual_id').value = actual_schedule_id;
                        document.getElementById('tanggal').value = tanggal;
                        document.getElementById('class_name_override').value = classType;
                        document.getElementById('user_session_category').value = sessionType;
                        return { sessionType };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('booking_kelas').submit();
                        const { sessionType } = result.value;
                        Swal.fire({
                            title: "Booked!",
                            text: `Your session would be booked using a ${sessionType} session.`,
                            icon: "success"
                        });
                    }
                });
            });
        });
    }

    function renderDays() {
        const today = new Date();
        const baseMonday = getMonday(today);
        baseMonday.setDate(baseMonday.getDate() + weekOffset * 7);

        const days = [];
        for (let i = 0; i < 7; i++) {
            const date = new Date(baseMonday);
            date.setDate(baseMonday.getDate() + i);
            days.push(date);
        }

        const monthName = days[3].toLocaleString('default', { month: 'long' });
        monthDisplay.textContent = monthName;

        daySelector.innerHTML = '';

        days.forEach((date, index) => {
            const button = document.createElement('button');
            button.className = 'day';
            const formattedDate = formatDMY(date);
            button.setAttribute('data-date', formattedDate); // Store date as data attribute

            if (date.toDateString() === new Date().toDateString() && weekOffset === 0) {
                button.classList.add('active');
                loadBookingList(formattedDate); // Load for today
            }

            button.innerHTML = `${dayNames[index]}<br><span>${date.getDate()}</span>`;
            button.onclick = () => {
                document.querySelectorAll('.day').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                loadBookingList(formattedDate);
            };

            daySelector.appendChild(button);
        });
    }

    function changeWeek(direction) {
        weekOffset += direction;
        renderDays();
    }

    renderDays();
    </script>
    <!-- Modal for Burger Menu -->
    <div id="burgerModal" class="modal">
        <div class="modal-content">
            <a href="/userMobile">Home</a>
            <a href="/topup">Topup</a>
            <a class="cta-button" href="/logout">Logout</a>
        </div>
    </div>

</body>

</html>