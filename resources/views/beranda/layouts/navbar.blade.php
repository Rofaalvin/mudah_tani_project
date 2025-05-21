<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">MUDAH TANI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/favorit">Favorit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/riwayat">Riwayat</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<style>
    /* css/custom.css */

    .navbar {
        background-color: #c6f7d1;
        /* Hijau Terang */
        padding: 10px 0;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        color: #2d3436;
        font-weight: bold;
    }

    .navbar-nav .nav-link {
        color: #2d3436;
        margin: 0 15px;
        transition: color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #26de81;
        /* Hijau Lebih Tua saat Hover */
    }

    .navbar-toggler {
        border: none;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='rgba(45, 52, 54, 0.7)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
</style>
