<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login / Sign Up - Vibrant Pilates</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="bg-gradient-to-r from-pink-200 via-pink-100 to-orange-100 min-h-screen flex items-center justify-center px-4">

    <?php if(session()->getFlashdata('success')): ?>
    <div class="fixed top-5 left-1/2 transform -translate-x-1/2 w-full max-w-sm sm:max-w-md px-4 z-50">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-md relative"
            role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline"><?= session()->getFlashdata('success') ?></span>
        </div>
    </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>
    <div class="fixed top-5 left-1/2 transform -translate-x-1/2 w-full max-w-sm sm:max-w-md px-4 z-50">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-md relative" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline"><?= session()->getFlashdata('error') ?></span>
        </div>
    </div>
    <?php endif; ?>

    <div class="bg-white shadow-xl rounded-2xl p-6 sm:p-8 w-full max-w-sm sm:max-w-md transition-all duration-300 relative"
        style="background-image: url('<?php echo base_url() ?>image/FA VIBRAN artwork-01.png'); background-size: 95%; background-position: center; background-repeat: no-repeat; background-opacity: 0.1;">
        <div class="absolute inset-0 bg-white bg-opacity-80"></div> <!-- Overlay for better text readability -->
        <div class="relative z-10">
            <!-- Ensure content is above the overlay -->
            <div class="text-center mb-6">
                <img src="<?php echo base_url() ?>image/FA VIBRAN artwork-01.png" alt="Vibrant Logo"
                    class="mx-auto w-12 sm:w-16 mb-4">
                <h2 id="form-title" class="text-xl sm:text-2xl font-semibold text-pink-700">Welcome Back</h2>
                <p class="text-sm text-gray-500">Reconnect with your body & soul</p>
            </div>

            <!-- Login & Signup Form -->
            <form id="auth-form" action="login_check" method="POST" class="space-y-4">
                <div id="name-field" class="hidden">
                    <label class="block text-gray-600 font-medium mb-1">Full Name</label>
                    <input type="text" name="fullname"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-300">
                </div>

                <div id="phone-field" class="hidden">
                    <label class="block text-gray-600 font-medium mb-1">Phone</label>
                    <input type="tel" name="phone"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-300">
                </div>

                <div id="dob-field" class="hidden">
                    <label class="block text-gray-600 font-medium mb-1">Date Of Birth</label>
                    <input type="date" name="date_of_birth"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-300">
                </div>

                <div>
                    <label class="block text-gray-600 font-medium mb-1">Email</label>
                    <input type="email" name="email"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-300"
                        required>
                </div>

                <div>
                    <label class="block text-gray-600 font-medium mb-1">Password</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-300"
                        required>
                </div>

                <div id="confirm-field" class="hidden">
                    <label class="block text-gray-600 font-medium mb-1">Confirm Password</label>
                    <input type="password" name="confirm-password"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-300">
                </div>

                <button type="submit"
                    class="w-full bg-pink-600 hover:bg-pink-700 text-white py-2 rounded-lg font-semibold transition duration-300">
                    <span id="submit-text">Login</span>
                </button>
            </form>

            <!-- Toggle Text -->
            <p class="text-sm text-center text-gray-500 mt-4">
                <span id="toggle-text">Don't have an account?</span>
                <a href="#" id="toggle-link" class="text-pink-600 hover:underline">Sign up</a>
            </p>
        </div>
    </div>

    <!-- Toggle Logic -->
    <script>
    const isLogin = {
        value: true
    };
    const toggleLink = document.getElementById("toggle-link");
    const toggleText = document.getElementById("toggle-text");
    const submitText = document.getElementById("submit-text");
    const formTitle = document.getElementById("form-title");

    const nameField = document.getElementById("name-field");
    const phoneField = document.getElementById("phone-field");
    const confirmField = document.getElementById("confirm-field");
    const dobField = document.getElementById("dob-field");

    toggleLink.addEventListener("click", (e) => {
        e.preventDefault();
        isLogin.value = !isLogin.value;

        if (isLogin.value) {
            formTitle.textContent = "Welcome Back";
            submitText.textContent = "Login";
            toggleText.textContent = "Don't have an account?";
            toggleLink.textContent = "Sign up";
            nameField.classList.add("hidden");
            phoneField.classList.add("hidden");
            confirmField.classList.add("hidden");
            dobField.classList.add("hidden");
            document.getElementById("auth-form").action = "login_check";
        } else {
            formTitle.textContent = "Create an Account";
            submitText.textContent = "Sign Up";
            toggleText.textContent = "Already have an account?";
            toggleLink.textContent = "Login";
            nameField.classList.remove("hidden");
            phoneField.classList.remove("hidden");
            confirmField.classList.remove("hidden");
            dobField.classList.remove("hidden");
            document.getElementById("auth-form").action = "register";
        }
    });
    </script>

</body>

</html>