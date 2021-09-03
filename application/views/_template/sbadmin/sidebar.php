<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin'); ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('assets/FRONTEND/img/icon.ico'); ?>" height="30px">
        </div>
        <div class="sidebar-brand-text"><img src="<?= base_url('assets/FRONTEND/img/logo2.png'); ?>" width="165px"></div>
    </a>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Main Menu
    </div>
    <li class="nav-item <?= $menuPage == 1 ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('admin') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Beranda</span></a>
    </li>
    <li class="nav-item <?= $menuPage == 2 ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu_1" aria-expanded="true" aria-controls="menu_1">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Informasi</span>
        </a>
        <div id="menu_1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('admin/informasi/berita') ?>">Berita</a>
                <a class="collapse-item" href="<?= base_url('admin/informasi/bhabin') ?>">Bhabin & Kring Serse</a>
                <a class="collapse-item" href="<?= base_url('admin/informasi/nomor') ?>">Nomor Darurat</a>
                <a class="collapse-item" href="<?= base_url('admin/informasi/barang') ?>">Barang Hilang</a>
                <a class="collapse-item" href="<?= base_url('admin/informasi/orang') ?>">Orang Hilang</a>
                <a class="collapse-item" href="<?= base_url('admin/informasi/tahanan') ?>">Tahanan</a>
                <a class="collapse-item" href="<?= base_url('admin/informasi/buronan') ?>">Buronan</a>
            </div>
        </div>
    </li>

    <li class="nav-item" <?= $menuPage == 3 ? 'active' : ''; ?>>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu_2" aria-expanded="true" aria-controls="menu_2">
            <i class="fas fa-fw fa-bullhorn"></i>
            <span>Pengaduan</span>
        </a>
        <div id="menu_2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('admin/informasi/berita') ?>">Umum</a>
                <a class="collapse-item" href="<?= base_url('admin/informasi/berita') ?>">Covid-19</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?= $menuPage == 4 ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu_3" aria-expanded="true" aria-controls="menu_3">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Laporan</span>
        </a>
        <div id="menu_3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('admin/potensi/statistik') ?>">Tipe B</a>
                <a class="collapse-item" href="<?= base_url('admin/potensi/harga') ?>">Tipe C</a>
            </div>
        </div>
    </li>
    <li class="nav-item <?= $menuPage == 5 ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('admin/kotakmasuk') ?>" target="_BLANK">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Kelola Email</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Lainnya
    </div>
    <li class="nav-item <?= $menuPage == 6 ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu_4" aria-expanded="true" aria-controls="menu_4">
            <i class="fas fa-fw fa-globe"></i>
            <span>Pengaturan</span>
        </a>
        <div id="menu_4" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('admin/pengaturan/halamanweb') ?>">Halaman Web</a>
                <a class="collapse-item" href="<?= base_url('admin/pengaturan/halamanweb') ?>">Logo & Sosmed</a>
                <a class="collapse-item" href="<?= base_url('admin/pengaturan/gambarslider') ?>">Gambar Slider</a>
            </div>
        </div>
    </li>
    <li class="nav-item <?= $menuPage == 7 ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu_5" aria-expanded="true" aria-controls="menu_5">
            <i class="fas fa-fw fa-users"></i>
            <span>Pengguna Sistem</span>
        </a>
        <div id="menu_5" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('admin/pengguna/daftar') ?>">Daftar Pengguna</a>
                <a class="collapse-item" href="<?= base_url('admin/pengguna/aktivitas') ?>">Aktivitas Pengguna</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">