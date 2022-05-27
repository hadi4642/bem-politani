<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-book-2-fill"></i>
                        <span>Data Master</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('prodi.index') }}">Prodi</a></li>
                        <li><a href="{{ route('divisi.index') }}">Divisi</a></li>
                        <li><a href="{{ route('anggota.index') }}">Anggota</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('kegiatan.index') }}" class=" waves-effect">
                        <i class="ri-file-list-fill"></i>
                        <span>Kegiatan</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
