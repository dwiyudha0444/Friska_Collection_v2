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
                  <i class="bi bi-layout-text-window-reverse"></i><span>Produk</span><i
                      class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                  <li>
                      <a href="{{ url('produk') }}">
                          <i class="bi bi-circle"></i><span>produk</span>
                      </a>
                  </li>

              </ul>
          </li><!-- End Components Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-layout-text-window-reverse"></i><span>Kelola Kategori</span><i
                      class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                  <li>
                      <a href="{{ url('kategori') }}">
                          <i class="bi bi-circle"></i><span>Kategori</span>
                      </a>
                  </li>

              </ul>
          </li><!-- End Charts Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-journal-text"></i><span>Penjualan</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="penjualan-perbulan">
                          <i class="bi bi-circle"></i><span>Penjualan Perbulan</span>
                      </a>
                  </li>

                  <li>
                      <a href="penjualan-peritem">
                          <i class="bi bi-circle"></i><span>Penjualan Peritem</span>
                      </a>
                  </li>

              </ul>
          </li><!-- End Forms Nav -->




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
      </li><!-- End Profile Page Nav --> --}}

          {{-- <li class="nav-item">
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
      </li><!-- End Tables Nav --> --}}

          <li class="nav-heading">Prediksi</li>
          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-gem"></i><span>Prediksi</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ url('prediksi_hitung') }}">
                          <i class="bi bi-circle"></i><span>Hitung Prediksi</span>
                      </a>
                  </li>

              </ul>
              <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ url('prediksi') }}">
                          <i class="bi bi-circle"></i><span>Riwayat Prediksi</span>
                      </a>
                  </li>

              </ul>
          </li><!-- End Icons Nav -->

          <li class="nav-heading">User</li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ url('user') }}">
                  <i class="bi bi-person"></i>
                  <span>Kelola User</span>
              </a>
          </li><!-- End Profile Page Nav -->

      </ul>

  </aside><!-- End Sidebar-->
