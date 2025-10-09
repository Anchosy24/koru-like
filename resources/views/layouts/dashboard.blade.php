<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koru-Like Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css" />
    <style>
        body {
            overflow-x: hidden;
        }

        /* Sidebar base */
        #sidebar {
            width: 240px;
            transition: all 0.3s ease;
        }

        /* Mobile behavior */
        @media (max-width: 991.98px) {
            #sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                transform: translateX(-100%);
                z-index: 1045;
            }
            #sidebar.show {
                transform: translateX(0);
            }
            #sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.4);
                z-index: 1040;
            }
            #sidebar-overlay.show {
                display: block;
            }
        }

        /* Desktop layout: sidebar on left, content on right */
        @media (min-width: 992px) {
            .dashboard-container {
                display: flex;
                min-height: 100vh;   /* at least one screen high */
                align-items: stretch; /* default, but explicit is fine */
            }
            #main-content {
                flex-grow: 1;
                margin-left: 0;
            }
        }

        .nav-link.active {
            background-color: #495057 !important;
        }
    </style>
</head>
<body>
    <!-- Mobile top bar -->
    <div class="bg-dark text-white p-2 d-lg-none d-flex align-items-center">
        <button class="btn btn-outline-light me-2" id="toggleSidebar">
            <i class="fas fa-bars"></i>
        </button>
        <h5 class="mb-0">Admin Panel</h5>
    </div>

    <!-- Sidebar + Content Container -->
    <div class="dashboard-container">
        @include('partials.sidebar')

        <main id="main-content" class="p-4 flex-grow-1">
            @yield('content')
        </main>
    </div>

    <div id="sidebar-overlay"></div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggleBtn = document.getElementById('toggleSidebar');
        const closeBtn = document.getElementById('closeSidebar');

        toggleBtn?.addEventListener('click', () => {
            sidebar.classList.add('show');
            overlay.classList.add('show');
        });
        closeBtn?.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
        overlay?.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    </script>

    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false,
        });
    </script>
    @elseif (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            timer: 2000,
            showConfirmButton: false,
        });
    </script>
    @endif
    @stack('script')
</body>
</html>