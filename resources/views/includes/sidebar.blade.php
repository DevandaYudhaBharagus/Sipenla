  <div class="sidebar">
      <div class="logo-details">
          <div class="box-logo">
              <img src="{{ asset('images/internal-images/logo.png') }}" alt="" />
          </div>
          <div class="logo-name">
              <h6>SIPENLA</h6>
              <div class="text-logo-name">Data Master</div>
          </div>
          <i class="fa fa-angle-double-right" id="btn-icon"></i>
      </div>
      <ul class="nav-list">
          <li>
              <a id="dropdown-keuangan">
                  <div class="box-icon">
                      <img src="{{ asset('images/internal-images/master-user.png') }}" alt="" />
                  </div>
                  <span class="link-name">Data User</span>
                  <div class="arrow ms-auto">
                      <i class="fa fa-angle-down"></i>
                  </div>
              </a>
              <span class="tool">Data User</span>
              <ul class="menu-dropdown">
                  <li>
                      <a href="{{ url('/teacher') }}">
                          <div class="box-icon-dropdown">
                              <img src="{{ asset('images/internal-images/master-user.png') }}" alt="" />
                          </div>
                          <div class="text-dropdown">Data Guru</div>
                      </a>
                  </li>
                  <li>
                      <a href="{{ url('/student') }}">
                          <div class="box-icon-dropdown">
                              <img src="{{ asset('images/internal-images/master-user.png') }}" alt="" />
                          </div>
                          <div class="text-dropdown">Data Siswa</div>
                      </a>
                  </li>
                  <li>
                      <a href="{{ url('/employee') }}">
                          <div class="box-icon-dropdown">
                              <img src="{{ asset('images/internal-images/master-user.png') }}" alt="" />
                          </div>
                          <div class="text-dropdown">Data Pegawai</div>
                      </a>
                  </li>
              </ul>
          </li>
          <li>
              <a id="dropdown-keuangan">
                  <div class="box-icon">
                      <img src="{{ asset('images/internal-images/master-keuangan.png') }}" alt="" />
                  </div>
                  <span class="link-name">Data Keuangan</span>
                  <div class="arrow ms-auto">
                      <i class="fa fa-angle-down"></i>
                  </div>
              </a>
              <span class="tool">Data Keuangan</span>
              <ul class="menu-dropdown">
                  <li>
                      <a href="">
                          <div class="box-icon-dropdown">
                              <img src="{{ asset('images/internal-images/master-keuangan.png') }}" alt="" />
                          </div>
                          <div class="text-dropdown">SPP</div>
                      </a>
                  </li>
                  <li>
                      <a href="">
                          <div class="box-icon-dropdown">
                              <img src="{{ asset('images/internal-images/master-keuangan.png') }}" alt="" />
                          </div>
                          <div class="text-dropdown">Tabungan</div>
                      </a>
                  </li>
                  <li>
                      <a href="">
                          <div class="box-icon-dropdown">
                              <img src="{{ asset('images/internal-images/master-keuangan.png') }}" alt="" />
                          </div>
                          <div class="text-dropdown">Denda</div>
                      </a>
                  </li>
                  <li>
                      <a href="">
                          <div class="box-icon-dropdown">
                              <img src="{{ asset('images/internal-images/master-keuangan.png') }}" alt="" />
                          </div>
                          <div class="text-dropdown">Saldo</div>
                      </a>
                  </li>
                  <li>
                      <a href="">
                          <div class="box-icon-dropdown">
                              <img src="{{ asset('images/internal-images/master-keuangan.png') }}" alt="" />
                          </div>
                          <div class="text-dropdown">Pemabayaran</div>
                      </a>
                  </li>
                  <li>
                      <a href="">
                          <div class="box-icon-dropdown">
                              <img src="{{ asset('images/internal-images/master-keuangan.png') }}" alt="" />
                          </div>
                          <div class="text-dropdown">Riwayat Transaksi</div>
                      </a>
                  </li>
                  <li>
                      <a href="">
                          <div class="box-icon-dropdown">
                              <img src="{{ asset('images/internal-images/master-keuangan.png') }}" alt="" />
                          </div>
                          <div class="text-dropdown">Tarik Saldo</div>
                      </a>
                  </li>
              </ul>
          </li>
          <li>
              <a id="dropdown-keuangan">
                  <div class="box-icon">
                      <img src="{{ asset('images/internal-images/master-perpus.png') }}" alt="" />
                  </div>
                  <span class="link-name">Data Perpustakaan</span>
                  <div class="arrow ms-auto">
                      <i class="fa fa-angle-down"></i>
                  </div>
              </a>
              <span class="tool">Data Perpustakaan</span>
              <ul class="menu-dropdown">
                  <li>
                      <a href="">
                          <div class="box-icon-dropdown">
                              <img src="{{ asset('images/internal-images/master-perpus.png') }}" alt="" />
                          </div>
                          <div class="text-dropdown">Buku Baru</div>
                      </a>
                  </li>
                  <li>
                      <a href="">
                          <div class="box-icon-dropdown">
                              <img src="{{ asset('images/internal-images/master-perpus.png') }}" alt="" />
                          </div>
                          <div class="text-dropdown">Kehilangan</div>
                      </a>
                  </li>
                  <li>
                      <a href="">
                          <div class="box-icon-dropdown">
                              <img src="{{ asset('images/internal-images/master-perpus.png') }}" alt="" />
                          </div>
                          <div class="text-dropdown">Sumbangan</div>
                      </a>
                  </li>
              </ul>
          </li>
          {{-- <li>
              <a href="{{ url('/schedules') }}">
                  <div class="box-icon">
                      <img src="{{ asset('images/internal-images/master-jadwal.png') }}" alt="" />
                  </div>
                  <span class="link-name">Data Jadwal</span>
              </a>
              <span class="tool">Data Jadwal</span>
          </li> --}}
          <li>
              <a id="dropdown-keuangan">
                  <div class="box-icon">
                      <img src="{{ asset('images/internal-images/master-jadwal.png') }}" alt="" />
                  </div>
                  <span class="link-name">Data Jadwal</span>
                  <div class="arrow ms-auto">
                      <i class="fa fa-angle-down"></i>
                  </div>
              </a>
              <span class="tool">Data Jadwal</span>
              <ul class="menu-dropdown">
                  <li>
                      <a href="{{ url('/schedules') }}">
                          <div class="box-icon-dropdown">
                              <img src="{{ asset('images/internal-images/master-jadwal.png') }}" alt="" />
                          </div>
                          <div class="text-dropdown">Jadwal Pelajaran</div>
                      </a>
                  </li>
                  <li>
                      <a href="{{ url('/extra-schedules') }}" class="d-flex-align-items-center">
                          <div class="box-icon-dropdown">
                              <img src="{{ asset('images/internal-images/master-jadwal.png') }}" />
                          </div>
                          <div class="text-dropdown">Jadwal Ekstrakulikuler</div>
                      </a>
                  </li>
              </ul>
          </li>
          <li>
              <a id="dropdown-keuangan">
                  <div class="box-icon">
                      <img src="{{ asset('images/internal-images/master-kelas.png') }}" alt="" />
                  </div>
                  <span class="link-name">Data Kelas</span>
                  <div class="arrow ms-auto">
                      <i class="fa fa-angle-down"></i>
                  </div>
              </a>
              <span class="tool">Data Kelas</span>
              <ul class="menu-dropdown">
                  <li>
                      <a href="{{ url('/grade') }}">
                          <div class="box-icon-dropdown">
                              <img src="{{ asset('images/internal-images/master-jadwal.png') }}" alt="" />
                          </div>
                          <div class="text-dropdown">Kelas</div>
                      </a>
                  </li>
                  <li>
                      <a href="{{ url('/grade/class') }}" class="d-flex-align-items-center">
                          <div class="box-icon-dropdown">
                              <img src="{{ asset('images/internal-images/master-jadwal.png') }}" alt="" />
                          </div>
                          <div class="text-dropdown">Kelas Siswa</div>
                      </a>
                  </li>
              </ul>
          </li>

          <li>
              <a href="">
                  <div class="box-icon">
                      <img src="{{ asset('images/internal-images/master-role.png') }}" alt="" />
                  </div>
                  <span class="link-name">Data Role</span>
              </a>
              <span class="tool">Data Role</span>
          </li>
          <li>
              <a href="{{ url('/ekstrakurikuler') }}">
                  <div class="box-icon">
                      <img src="{{ asset('images/internal-images/master-ekstra.png') }}" alt="" />
                  </div>
                  <span class="link-name">Data Ekstrakuliler</span>
              </a>
              <span class="tool">Data Ekstrakuliler</span>
          </li>
          <li>
              <a href="{{ url('/facility') }}">
                  <div class="box-icon">
                      <img src="{{ asset('images/internal-images/master-fasilitas.png') }}" alt="" />
                  </div>
                  <span class="link-name">Data Fasilitas</span>
              </a>
              <span class="tool">Data Fasilitas</span>
          </li>

          <li>
              <a href="{{ url('/workshift') }}">
                  <div class="box-icon">
                      <img src="{{ asset('images/internal-images/master-shift.png') }}" alt="" />
                  </div>
                  <span class="link-name">Data Shift</span>
              </a>
              <span class="tool">Data Shift</span>
          </li>
          <li>
              <a href="{{ url('/subject') }}">
                  <div class="box-icon">
                      <img src="{{ asset('images/internal-images/master-mapel.png') }}" alt="" />
                  </div>
                  <span class="link-name">Data Mata Pelajaran</span>
              </a>
              <span class="tool">Data Mata Pelajaran</span>
          </li>
      </ul>
  </div>
