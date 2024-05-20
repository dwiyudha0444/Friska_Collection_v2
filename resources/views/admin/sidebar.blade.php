  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ url('dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Stok Barang</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

          <li>
            <a href="{{ url('stok-fashion') }}">
              <i class="bi bi-circle"></i><span>Fashion</span>
            </a>
          </li>

          <li>
            <a href="{{ url('stok-prabotan') }}">
              <i class="bi bi-circle"></i><span>Prabotan</span>
            </a>
          </li>
 
 
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Prediksi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

          <li>
            <a href="{{ url('prediksi') }}">
              <i class="bi bi-circle"></i><span>Prediksi</span>
            </a>
          </li>
 
        </ul>
      </li><!-- End Tables Nav -->

      {{-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Permintaaan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

          <li>
            <a href="{{ url('permintaan') }}">
              <i class="bi bi-circle"></i><span>Permintaan</span>
            </a>
          </li>
        
          <li>
            <a href="{{ url('permintaan-detail') }}">
              <i class="bi bi-circle"></i><span>Permintaan Detail</span>
            </a>
          </li>
 
        </ul>
      </li><!-- End Charts Nav --> --}}

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Kelola User</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ url('user') }}">
              <i class="bi bi-circle"></i><span>User</span>
            </a>
          </li>

        </ul>
      </li><!-- End Icons Nav -->


      {{-- <li class="nav-heading">Nama & Kategori Obat</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('obat') }}">
          <i class="bi bi-menu-button-wide"></i>
          <span>Obat</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('kategori') }}">
          <i class="bi bi-menu-button-wide"></i>
          <span>Kategori</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-heading">PDF</li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="pemakaian_pdf">
              <i class="bi bi-circle"></i><span>Pemakaian PDF</span>
            </a>
          </li>

          <li>
            <a href="persediaan_pdf">
              <i class="bi bi-circle"></i><span>Persediaan PDF</span>
            </a>
          </li>

          <li>
            <a href="permintaan_detail_pdf">
              <i class="bi bi-circle"></i><span>Permintaan PDF</span>
            </a>
          </li>

          <li>
            <a href="lplpo_pdf">
              <i class="bi bi-circle"></i><span>Lplpo PDF</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Forms Nav --> --}}

      {{-- <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('profile') }}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav --> --}}


    </ul>

  </aside><!-- End Sidebar-->