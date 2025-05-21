<div class="sidebar">
    <ul>
        <li><a href="{{ url('/produk') }}">Produk</a></li>
        <li><a href="{{ url('/pembelian') }}">Pembelian</a></li>
        <li><a href="{{ url('/penjualan') }}">Penjualan</a></li>
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

<style>
    .sidebar {
        width: 220px;
        background-color: #e8f5e9; /* hijau muda */
        padding: 20px;
        min-height: 100vh;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 0;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar li {
        margin-bottom: 12px;
    }

    .sidebar a {
        display: block;
        padding: 10px 15px;
        background-color: #ffffff;
        border-left: 4px solid transparent;
        color: #2e7d32; /* hijau gelap */
        border-radius: 5px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }

    .sidebar a:hover {
        background-color: #c8e6c9; /* hijau hover */
        border-left: 4px solid #2e7d32;
        color: #1b5e20;
    }

    .sidebar a.active {
        background-color: #a5d6a7;
        border-left: 4px solid #1b5e20;
        color: #1b5e20;
    }
</style>
