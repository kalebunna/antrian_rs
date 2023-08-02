<!--navigation-->
<div class="nav-container primary-menu">
    <div class="mobile-topbar-header">
        <div>
            <img src="{{ asset('templates/images/favicon-32x32.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Rukada</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <nav class="navbar navbar-expand-xl w-100">
        <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
            <li class="nav-item dropdown">
                <a href="javascript:;" class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                    data-bs-toggle="dropdown">
                    <div class="parent-icon">
                        <i class='bx bx-cart'></i>
                    </div>
                    <div class="menu-title">Identitas</div>
                </a>
                <ul class="dropdown-menu">
                    <li> <a class="dropdown-item" href=""><i class="bx bx-right-arrow-alt"></i>Products</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('resepsionis.index') }}">
                    <div class="parent-icon"><i class='bx bx-cookie'></i>
                    </div>
                    <div class="menu-title">Resepsionis</div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('poli.index') }}">
                    <div class="parent-icon"><i class='bx bx-cookie'></i>
                    </div>
                    <div class="menu-title">Poli</div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('pendaftaran') }}">
                    <div class="parent-icon"><i class='bx bx-cookie'></i>
                    </div>
                    <div class="menu-title">Panggil Pendaftaran</div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('panggilPoli') }}">
                    <div class="parent-icon"><i class='bx bx-cookie'></i>
                    </div>
                    <div class="menu-title">Panggil Poli</div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('identitas.index') }}">
                    <div class="parent-icon"><i class='bx bx-cookie'></i>
                    </div>
                    <div class="menu-title">Identitas</div>
                </a>
            </li>

        </ul>
    </nav>
</div>
<!--end navigation-->
