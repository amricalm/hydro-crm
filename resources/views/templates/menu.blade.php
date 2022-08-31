<!--aside open-->
<aside class="app-sidebar">
    <div class="app-sidebar__logo">
        <a class="header-brand" href="{{ URL::to('/'); }}">
            <img src="{{asset('assets/images/brand/logo.png')}}" class="header-brand-img desktop-lgo" alt="Azea logo">
            <img src="{{asset('assets/images/brand/logo1.png')}}" class="header-brand-img dark-logo" alt="Azea logo">
            <img src="{{asset('assets/images/brand/favicon.png')}}" class="header-brand-img mobile-logo" alt="Azea logo">
            <img src="{{asset('assets/images/brand/favicon1.png')}}" class="header-brand-img darkmobile-logo" alt="Azea logo">
        </a>
    </div>
    <ul class="side-menu app-sidebar3">
        <li class="slide">
            <a class="side-menu__item" href="{{ URL::to('/'); }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z" />
                </svg>
                <span class="side-menu__label">Dashboard</span></a>
        </li>

        <!-- Menu dengan sub-sub menu -->
        @if(Auth::user()->role == 1)
        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M22 7.999a1 1 0 0 0-.516-.874l-9.022-5a1.003 1.003 0 0 0-.968 0l-8.978 4.96a1 1 0 0 0-.003 1.748l9.022 5.04a.995.995 0 0 0 .973.001l8.978-5A1 1 0 0 0 22 7.999zm-9.977 3.855L5.06 7.965l6.917-3.822 6.964 3.859-6.918 3.852z"></path><path d="M20.515 11.126 12 15.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"></path><path d="M20.515 15.126 12 19.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"></path></svg>
            <span class="side-menu__label">Data Induk</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu" style="display: none;">
                <li><a href="{{ url('pelanggan') }}" class="slide-item">Pelanggan</a></li>
                <li><a href="{{ url('karyawan') }}" class="slide-item">Karyawan</a></li>
                <li><a href="{{ url('produk') }}" class="slide-item">Produk</a></li>
                <li><a href="{{ url('jenis-produk') }}" class="slide-item">Kategori Produk</a></li>
                <li><a href="{{ url('aksi') }}" class="slide-item">Aksi</a></li>
                <li><a href="{{ url('target-aksi') }}" class="slide-item">Target Aksi</a></li>
                <li><a href="{{ url('respon') }}" class="slide-item">Respon</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M5 22h14c1.103 0 2-.897 2-2V9a1 1 0 0 0-1-1h-3V7c0-2.757-2.243-5-5-5S7 4.243 7 7v1H4a1 1 0 0 0-1 1v11c0 1.103.897 2 2 2zM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v1H9V7zm-4 3h2v2h2v-2h6v2h2v-2h2l.002 10H5V10z"></path></svg>
            <span class="side-menu__label">Aktivitas</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu" style="display: none;">
                <li><a href="{{ url('aktivitas') }}" class="slide-item">Aktivitas Sales</a></li>
                {{-- <li><a href="{{ url('penjualan') }}" class="slide-item">Penjualan</a></li> --}}
            </ul>
        </li>
        @else
        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M22 7.999a1 1 0 0 0-.516-.874l-9.022-5a1.003 1.003 0 0 0-.968 0l-8.978 4.96a1 1 0 0 0-.003 1.748l9.022 5.04a.995.995 0 0 0 .973.001l8.978-5A1 1 0 0 0 22 7.999zm-9.977 3.855L5.06 7.965l6.917-3.822 6.964 3.859-6.918 3.852z"></path><path d="M20.515 11.126 12 15.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"></path><path d="M20.515 15.126 12 19.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"></path></svg>
            <span class="side-menu__label">Data Induk</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu" style="display: none;">
                <li><a href="{{ url('pelanggan') }}" class="slide-item">Pelanggan</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M5 22h14c1.103 0 2-.897 2-2V9a1 1 0 0 0-1-1h-3V7c0-2.757-2.243-5-5-5S7 4.243 7 7v1H4a1 1 0 0 0-1 1v11c0 1.103.897 2 2 2zM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v1H9V7zm-4 3h2v2h2v-2h6v2h2v-2h2l.002 10H5V10z"></path></svg>
            <span class="side-menu__label">Aktivitas</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu" style="display: none;">
                <li><a href="{{ url('aktivitas') }}" class="slide-item">Aktivitas Sales</a></li>
                {{-- <li><a href="{{ url('penjualan') }}" class="slide-item">Penjualan</a></li> --}}
            </ul>
        </li>
        @endif
        @if(Auth::user()->role == 1)
        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M3 11h8V3H3zm2-6h4v4H5zM3 21h8v-8H3zm2-6h4v4H5zm8-12v8h8V3zm6 6h-4V5h4zm-5.99 4h2v2h-2zm2 2h2v2h-2zm-2 2h2v2h-2zm4 0h2v2h-2zm2 2h2v2h-2zm-4 0h2v2h-2zm2-6h2v2h-2zm2 2h2v2h-2z"></path></svg>
            <span class="side-menu__label">Setting</span><i class="angle fe fe-chevron-right"></i></a>
            <ul class="slide-menu" style="display: none;">
                <li><a href="{{ url('pengguna') }}" class="slide-item">Pengguna</a></li>
            </ul>
        </li>
        @endif
    </ul>
</aside>
<!--aside closed-->
