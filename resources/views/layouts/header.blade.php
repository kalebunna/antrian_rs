<!--start header -->
<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="topbar-logo-header">
                <div class="">
                    <img src="{{ Storage::url('public/logo/' . showIdentitas()->logo) }}" class="logo-icon" alt="logo icon">
                </div>
                <div class="">
                    <h4 class="logo-text">{{ showIdentitas()->nama }}</h4>
                </div>
            </div>
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
            <div class="search-bar flex-grow-1">

            </div>
            <div class="user-box badge bg-gradient-bloody">
                <h3 id="clock-wrapper" style="margin: 0%" class="text-white"></h3>
            </div>
        </nav>
    </div>
</header>
<!--end header -->