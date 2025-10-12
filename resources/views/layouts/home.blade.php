<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koru-Like Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css " rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css " rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css " rel="stylesheet">
    @stack('style')
    <style>
        body {
        background-color: #0a0a0a;
        color: #fff;
        font-family: 'Segoe UI', sans-serif;
        }

        /* Neon hover underline */
        .navbar .nav-link {
        position: relative;
        color: #fff;
        transition: color 0.3s ease;
        }

        .navbar .nav-link::after {
        content: "";
        position: absolute;
        left: 50%;
        bottom: -5px;
        width: 0;
        height: 3px;
        background: #00ff80;
        box-shadow: 0 0 8px #00ff80, 0 0 15px rgba(0,255,128,0.7);
        transition: all 0.3s ease;
        transform: translateX(-50%);
        border-radius: 2px;
        }

        .navbar .nav-link:hover::after,
        .navbar .nav-link.active::after {
        width: 100%;
        }

        /* Ensure menu is perfectly centered */
        .navbar-collapse {
        justify-content: center !important;
        }

        .navbar-nav {
        justify-content: center;
        align-items: center;
        flex-grow: 1;
        }

        /* Fix spacing on smaller screens */
        @media (max-width: 991.98px) {
        .navbar-nav {
            width: 100%;
            align-items: center !important;
            justify-content: center !important;
        }
        .dropdown {
            margin-top: 0.8rem;
        }
        }

        /* Dropdown look */
        .dropdown-menu {
        min-width: 150px;
        }
        .dropdown-item:hover {
        background-color: #00ff80;
        color: #000 !important;
        }

        /* Toggler */
        .navbar-toggler:focus {
        outline: none;
        box-shadow: none;
        }

        .dark-input {
            background-color: #1e293b;
            color: #fff;
            border: none;
        }

        .dark-input:focus {
            background-color: #1e293b;
            color: #fff;
            border: 1px solid #fbbf24;
            box-shadow: none;
        }

        .dark-input::placeholder {
            color: rgba(255, 255, 255, 0.6); /* Light gray for visibility */
        }

        .footer {
        background: #0a0c12; /* very dark background */
        }

        .footer-link {
        color: #bbb;
        text-decoration: none;
        transition: color 0.3s ease;
        }

        .footer-link:hover {
        color: #00ff80; /* neon green hover */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark px-4 py-2">
        <div class="container-fluid">

            <!-- Left Logo -->
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
            <img src="{{ asset('image/koru-nobg.png') }}" alt="Koru DAO" width="50" class="me-2"> 
            Koru
            </a>

            <!-- Toggler (mobile) -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list text-light fs-2"></i>
            </button>

            <!-- Collapsible Section -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarContent">

            <!-- Center Menu -->
            <ul class="navbar-nav mx-auto text-center d-flex flex-lg-row flex-column align-items-center gap-lg-4 mt-3 mt-lg-0">
                <li class="nav-item">
                <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                    <i class="bi bi-search me-1"></i> Discover
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ Request::is('trending') ? 'active' : '' }}" href="{{ route('trending') }}">
                    <i class="bi bi-graph-up-arrow me-1"></i> Trending
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ Request::is('community') ? 'active' : '' }}" href="{{ route('community') }}">
                    <i class="bi bi-people me-1"></i> Community
                </a>
                </li>
            </ul>

            <!-- Right Dropdown (no profile picture) -->
            <div class="dropdown ms-lg-auto mt-3 mt-lg-0 text-center text-lg-end">
                <button class="btn btn-dark dropdown-toggle" type="button" id="navbarProfileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name ?? 'Guest' }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end bg-dark border-0 shadow" aria-labelledby="navbarProfileDropdown">
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item text-light bg-dark">Logout</button>
                    </form>
                </li>
                </ul>
            </div>

            </div>
        </div>
        </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="footer text-light pt-5 pb-3">
    <div class="container">
        <div class="row">
        <div class="col-md-4 mb-4">
            <img src="{{ asset('image/koru-nobg.png') }}" alt="Koru DAO Logo" class="rounded-circle mb-4" width= 100;>
            <h5 class="fw-bold">KORU</h5>
            <p class="text-light">Discover trending conversations and contribute to meaningful projects that shape the future.</p>
        </div>

        <!-- Platform Links -->
        <div class="col-md-4 mb-4">
            <h6 class="fw-bold">Platform</h6>
            <ul class="list-unstyled">
            <li><a href="#" class="footer-link">Discover</a></li>
            <li><a href="#" class="footer-link">Trending</a></li>
            <li><a href="#" class="footer-link">Community</a></li>
            </ul>
        </div>

        <!-- Support Links -->
        <div class="col-md-4 mb-4">
            <h6 class="fw-bold">Support</h6>
            <ul class="list-unstyled">
            <li><a href="#" class="footer-link">Help Center</a></li>
            <li><a href="#" class="footer-link">Contact Us</a></li>
            <li><a href="#" class="footer-link">Privacy Policy</a></li>
            </ul>
        </div>
        </div>

        <!-- Bottom Bar -->
        <hr class="border-secondary">
        <div class="text-center text-light small">
            ©2025 Koru-Like. Built with passion for community-driven innovation.
        </div>
    </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Enhanced Confirmation Modal Script -->
@if (session('confirmDonationId'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var donationId = "{{ session('confirmDonationId') }}";
            var confirmForm = document.getElementById('confirmForm');

            // Set form action dynamically
            confirmForm.action = "/donation/confirm/" + donationId;

            // Show modal
            var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
            confirmModal.show();

            // Add loading state for better UX
            confirmForm.addEventListener('submit', function(e) {
                var submitBtn = confirmForm.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Confirming...';
                submitBtn.disabled = true;
            });
        });
    </script>
@endif

<!-- SweetAlert Notification -->
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        theme: 'dark',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false,
    });
</script>
@elseif (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        theme: 'dark',
        timer: 2000,
        showConfirmButton: false,
    });
@endif
</script>
@stack('script')
</body>
</html>
