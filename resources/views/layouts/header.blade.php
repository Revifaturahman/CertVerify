<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">

        {{-- BRAND --}}
        <a class="navbar-brand fw-bold" href="/">CertVerify</a>

        {{-- TOGGLER (MOBILE) --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- NAV MENU --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-2">

                @auth
                    {{-- ADMIN ONLY --}}
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="/certificate">
                                Sertifikat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="/participant">
                                Peserta
                            </a>
                        </li>
                    @endif

                    {{-- PROFILE DROPDOWN (ALL ROLES) --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                           href="#"
                           role="button"
                           data-bs-toggle="dropdown"
                           aria-expanded="false">

                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
                                 alt="Avatar"
                                 class="rounded-circle"
                                 width="32"
                                 height="32">

                            <span class="fw-semibold">
                                {{ auth()->user()->name }}
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li>
                                <a class="dropdown-item" href="/profile">
                                    <i class="bi bi-person me-2"></i> Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="/login">Login</a>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>
