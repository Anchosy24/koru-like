<nav id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4 class="text-white mb-0">Admin Panel</h4>
        <button class="btn btn-sm btn-outline-light d-lg-none" id="closeSidebar">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <hr class="w-100 text-light">

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-1">
            <a href="{{ route('dashboard') }}" class="nav-link text-white {{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('donation') }}" class="nav-link text-white {{ Request::is('donation') ? 'active' : '' }}">
                <i class="fas fa-boxes me-2"></i> Donations
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('contribution') }}" class="nav-link text-white {{ Request::is('contribution') ? 'active' : '' }}">
                <i class="fas fa-history me-2"></i> Contributions
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('user') }}" class="nav-link text-white {{ Request::is('user') ? 'active' : '' }}">
                <i class="fas fa-users me-2"></i> Users
            </a>
        </li>
    </ul>
    <!-- Logout Button (Pinned Bottom) -->
    <div class="mt-auto pt-3 border-top border-secondary">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-light w-100">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </form>
    </div>
</nav>