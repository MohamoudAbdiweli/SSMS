<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHIRE SACCO Management System</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans">

    <nav class="bg-green-600 text-white shadow sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center py-2 px-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-16 rounded-full object-cover">

            <div class="space-x-4">
                <a href="/" class="hover:text-gray-200">Home</a>
                <a href="#about" class="hover:text-gray-200">About</a>
                <a href="#services" class="hover:text-gray-200">Services</a>
                <a href="/register" class="hover:text-gray-200">Register</a>
                <a href="/login" class="hover:text-gray-200">Login</a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section id="about" class="bg-white py-20 shadow-md scroll-mt-24">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold mb-4">Welcome to SHIRE SACCO Management System</h2>
            <p class="text-gray-600 mb-6">Securely manage your savings, deposits, and withdrawals anytime, anywhere.</p>
            <a href="/register"
                class="bg-green-600 text-white px-6 py-3 rounded-lg shadow hover:bg-green-700 transition">Get
                Started</a>
        </div>
    </section>

    <!-- FEATURES / ABOUT -->
    <section id="services" class="py-20 scroll-mt-24">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-bold mb-12">Why Choose SHIRE SACCO MS?</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Feature 1 -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <h4 class="text-xl font-semibold mb-2">Secure Transactions</h4>
                    <p class="text-gray-500">
                        All deposits and withdrawals are processed securely with encrypted transactions.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <h4 class="text-xl font-semibold mb-2">Easy to Use</h4>
                    <p class="text-gray-500">
                        User-friendly interface to help you manage your account without hassle.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <h4 class="text-xl font-semibold mb-2">Track Your Savings</h4>
                    <p class="text-gray-500">
                        View your balance, transaction history, and manage deposits & withdrawals easily.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <h4 class="text-xl font-semibold mb-2">Fast Loan Processing</h4>
                    <p class="text-gray-500">
                        Apply and receive loans quickly with our efficient approval system.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <h4 class="text-xl font-semibold mb-2">24/7 Access</h4>
                    <p class="text-gray-500">
                        Access your account anytime, anywhere using our online platform.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <h4 class="text-xl font-semibold mb-2">Detailed Reports</h4>
                    <p class="text-gray-500">
                        Generate financial reports and insights to monitor your progress.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-12">
        <div class="container mx-auto px-6 py-12 grid md:grid-cols-3 gap-8">

            <!-- Left Column: SACCO Info -->
            <div class="space-y-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-16 rounded-full object-cover">
                <p class="text-gray-400">
                    Empowering your financial growth through secure savings, deposits, withdrawals,
                    and smart loan management. Join us and manage your finances with ease and safety.
                </p>
            </div>

            <!-- Middle Column: Contact Form + Icons -->
            <div class="space-y-4">
                <h3 class="text-xl font-bold mb-4">Contact Us</h3>

                @if(session('success'))
                <p class="bg-green-100 text-green-700 p-2 rounded mb-2">{{ session('success') }}</p>
                @endif

                <!-- Contact Form -->
                <form action="{{ route('contact.send') }}" method="POST"
                    class="space-y-3 bg-gray-800 p-4 rounded-lg shadow-md">
                    @csrf
                    <input type="text" name="name" placeholder="Your Name"
                        class="block w-full p-2 rounded border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>

                    <input type="email" name="email" placeholder="Your Email"
                        class="block w-full p-2 rounded border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>

                    <textarea name="message" rows="3" placeholder="Your Message"
                        class="block w-full p-2 rounded border border-gray-600 bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500"
                        required></textarea>
                    <button type="submit"
                        class="w-full bg-green-600 px-4 py-2 rounded hover:bg-green-700 transition font-semibold">
                        Send Message
                    </button>
                </form>

                <!-- Social Icons -->
                <div class="flex justify-center space-x-4 mt-4 text-2xl">

                    <!-- Phone -->
                    <a href="tel:+256709835603" class="text-gray-600 hover:text-gray-800 transition" title="Call Us">
                        <i class="fas fa-phone"></i>
                    </a>

                    <!-- WhatsApp -->
                    <a href="https://wa.me/256726166153?text=Hello%20I%20want%20to%20join%20SACCO" target="_blank"
                        class="text-green-500 hover:text-green-600 transition" title="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>

                    <!-- Instagram -->
                    <a href="https://instagram.com/shiredhere" target="_blank"
                        class="text-pink-500 hover:text-pink-600 transition" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <!-- Facebook -->
                    <a href="https://facebook.com/" target="_blank" class="text-blue-600 hover:text-blue-700 transition"
                        title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <!-- Twitter (X) -->
                    <a href="https://twitter.com/MohamoudAb19921" target="_blank"
                        class="text-black hover:text-gray-800 transition" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>

                </div>
            </div>

            <!-- Right Column: Map -->
            <div class="space-y-4">
                <h3 class="text-xl font-bold mb-4">Our Location</h3>
                <iframe src="https://maps.google.com/maps?q=Kampala%20Uganda&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    class="w-full h-64 rounded-lg border-0 shadow-lg"></iframe>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="bg-gray-800 text-gray-400 text-center p-4 mt-8">
            &copy; 2026 SHIRE SACCO Management System. All Rights Reserved.
        </div>
    </footer>

</body>

</html>