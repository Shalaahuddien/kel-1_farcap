<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/aspiration*') ? 'active' : '' }}" href="/dashboard/aspiration">
                    <!-- tanda bintang setelah aspirasi agar active tetap berjalan ketika alamat post ada tambahan diujungnya -->
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    Aspirasi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/register*') ? 'active' : '' }}" href="/dashboard/register">
                    <!-- tanda bintang setelah aspirasi agar active tetap berjalan ketika alamat post ada tambahan diujungnya -->
                    <span data-feather="user" class="align-text-bottom"></span>
                    Tambah Admin
                </a>
            </li>

        </ul>
    </div>
</nav>
