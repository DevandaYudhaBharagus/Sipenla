 <nav class="navbar navbar-expand-lg sticky-top">
     <div class="container">
         <a class="navbar-brand" href="#">
             <img src="{{ asset('images/internal-images/logo.svg') }}" alt="Logo" width="45" height="45"
                 class="d-inline-block align-text-center me-2" />
             SIPENLA</a>
         <div class="d-flex d-lg-none align-items-center">
             <div class="dropdown">
                 <button class="btn btn-dropdown" href="#" role="button" data-bs-toggle="dropdown"
                     aria-expanded="false">
                     <i class="material-icons">notifications_none</i>
                 </button>
                 <ul class="dropdown-menu">
                     <li><a class="dropdown-item" href="#">Action</a></li>
                     <li><a class="dropdown-item" href="#">Another action</a></li>
                     <li>
                         <hr class="dropdown-divider" />
                     </li>
                     <li>
                         <a class="dropdown-item" href="">test</a>
                     </li>
                 </ul>
             </div>
             <div class="dropstart">
                 <button class="btn btn-dropdown" href="#" role="button" data-bs-toggle="dropdown"
                     aria-expanded="false">
                     <img src="{{ asset('images/internal-images/user.png') }}" alt="" width="35"
                         height="35" />
                 </button>
                 <ul class="dropdown-menu mt-5">
                     <li><a class="dropdown-item" href="#">Action</a></li>
                     <li><a class="dropdown-item" href="#">Another action</a></li>
                     <li>
                         <hr class="dropdown-divider" />
                     </li>
                     <li>
                         <a class="dropdown-item" href="">test</a>
                     </li>
                 </ul>
             </div>
         </div>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
             aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"><i class="material-icons">view_headline</i></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
             <!-- navbar untuk tampilan desktop -->
             <ul class="navbar-nav d-lg-flex ms-auto d-none">
                 <li class="nav-item">
                     <a class="nav-link active" href="#">Data Master</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">Pembelajaran</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">Laporan</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">Layanan</a>
                 </li>
             </ul>
             <!-- akhir navbar untuk tampilan desktop -->

             <!-- navbar untuk tampilan hp -->
             <ul class="navbar-nav d-lg-none ms-auto d-flex">
                 <li class="nav-item">
                     <a class="nav-link active" href="#">Data Master</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">Pembelajaran</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">Laporan</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">Layanan</a>
                 </li>
             </ul>
             <!-- navbar untuk tampilan hp -->
         </div>
         <div class="d-lg-flex d-none ms-auto align-items-center">
             <div class="dropstart">
                 <button class="btn btn-dropdown" href="#" role="button" data-bs-toggle="dropdown"
                     aria-expanded="false">
                     <i class="material-icons">notifications_none</i>
                 </button>
                 <ul class="dropdown-menu mt-5 dropdown-announcement">
                     <h6>Notifikasi</h6>
                     <!-- start looping nofification announcement -->
                     <li>
                         <a class="dropdown-item">
                             <div class="img-announcement">
                                 <img src="{{ asset('images/internal-images/icon-announcement.png') }}"
                                     alt="" />
                             </div>
                             <div class="text-announcement">
                                 <div class="title-announcement">
                                     Peringatan pembayaran spp bulan Juni (nama)
                                 </div>
                                 <div class="sub-title">
                                     Harap melunasi tagihan spp bulan juni dalam 72 jam
                                 </div>
                                 <div class="date-announcement">03/06/22</div>
                             </div>
                         </a>
                     </li>
                     <!-- end looping notification announcement -->
                     <li>
                         <a class="dropdown-item">
                             <div class="img-announcement">
                                 <img src="{{ asset('images/internal-images/icon-announcement.png') }}"
                                     alt="" />
                             </div>
                             <div class="text-announcement">
                                 <div class="title-announcement">
                                     Peringatan pembayaran spp bulan Juni (nama)
                                 </div>
                                 <div class="sub-title">
                                     Harap melunasi tagihan spp bulan juni dalam 72 jam
                                 </div>
                                 <div class="date-announcement">03/06/22</div>
                             </div>
                         </a>
                     </li>
                     <li>
                         <a class="dropdown-item">
                             <div class="img-announcement">
                                 <img src="{{ asset('images/internal-images/icon-announcement.png') }}"
                                     alt="" />
                             </div>
                             <div class="text-announcement">
                                 <div class="title-announcement">
                                     Peringatan pembayaran spp bulan Juni (nama)
                                 </div>
                                 <div class="sub-title">
                                     Harap melunasi tagihan spp bulan juni dalam 72 jam
                                 </div>
                                 <div class="date-announcement">03/06/22</div>
                             </div>
                         </a>
                     </li>
                     <li>
                         <a class="dropdown-item">
                             <div class="img-announcement">
                                 <img src="{{ asset('images/internal-images/icon-announcement.png') }}"
                                     alt="" />
                             </div>
                             <div class="text-announcement">
                                 <div class="title-announcement">
                                     Peringatan pembayaran spp bulan Juni (nama)
                                 </div>
                                 <div class="sub-title">
                                     Harap melunasi tagihan spp bulan juni dalam 72 jam
                                 </div>
                                 <div class="date-announcement">03/06/22</div>
                             </div>
                         </a>
                     </li>
                 </ul>
             </div>
             <div class="dropstart">
                 <button class="btn btn-dropdown" href="#" role="button" data-bs-toggle="dropdown"
                     aria-expanded="false">
                     <img src="{{ asset('images/internal-images/user.png') }}" alt="" width="35"
                         height="35" />
                 </button>
                 <ul class="dropdown-menu mt-5">
                     <li><a class="dropdown-item" href="#">Action</a></li>
                     <li><a class="dropdown-item" href="#">Another action</a></li>
                     <li>
                         <hr class="dropdown-divider" />
                     </li>
                     <li>
                         <a class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </nav>
