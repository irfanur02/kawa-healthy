<?php echo $this->extend('layout/user/template'); ?>

<?php echo $this->section('content'); ?>

  <?php echo $this->include('layout/user/navbar.php'); ?>

  <div class="content content-pesanana-datang container">
    <div class="row pt-4">
      <div class="col text-center">
        <h6>PESANAN KU</h6>
      </div>    
    </div>
    <div class="d-flex justify-content-center">
      <ul class="list-group nav-tab list-group-horizontal text-center ">
        <a href="/pesananKu" class="list-group-item border border-0 list-group-item-action <?php echo $tabPesananKu == "pesananKu" ? "my-active-tab" : ""; ?>">
                PesananKu
        </a>
        <a href="/pesananDatang" class="list-group-item border border-0 list-group-item-action <?php echo $tabPesananKu == "pesananDatang" ? "my-active-tab" : ""; ?>">
          Akan Datang
        </a>
        <a href="/pesananSelesai" class="list-group-item border border-0 list-group-item-action <?php echo $tabPesananKu == "pesananSelesai" ? "my-active-tab" : ""; ?>">
          Pesanan Selesai
        </a>
      </ul>
    </div>
    <div class="mt-3">
      <div class="text-center">
        <a href="pesanan_selesai.html" role="button" class="btn btn-sm my-btn-purpledark px-3 my-border-btn rounded-pill fs-6 lh-sm">Terima</a>
      </div>
      <div class="d-flex justify-content-center">
        <ul class="list-group mt-3 w-50">
          <li class="list-group-item boder border-black">
            <div class="row align-items-center lh-sm">
              <div class="col-9">Scramble Egg Saus Shimeji<br>Rp. 30000</div>
              <div class="col-3 text-end"><span class="badge text-bg-warning border border-black">2</span> Pedas</div>
            </div>
          </li>
          <li class="list-group-item boder border-black">
            <div class="row align-items-center lh-sm">
              <div class="col-9">Scramble Egg Saus Shimeji<br>Rp. 30000</div>
              <div class="col-3 text-end"><span class="badge text-bg-warning border border-black">2</span> Pedas</div>
            </div>
          </li>
          <li class="list-group-item boder border-black">
            <div class="row align-items-center lh-sm">
              <div class="col-9">Scramble Egg Saus Shimeji<br>Lunch Rp. 30000<br>Karbo Nasi Merah | Pantangan -</div>
              <div class="col-3 text-end"><span class="badge text-bg-warning border border-black">2</span></div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Modal Profil -->
  <div class="modal fade" id="modalProfil" tabindex="-1" aria-labelledby="modalProfilLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" style="max-width: 25em;">
      <div class="modal-content border border-dark">
        <div class="modal-header justify-content-center my-bg-purpledark">
          <h1 class="modal-title fs-5" id="modalProfilLabel">Profil</h1>
        </div>
        <div class="modal-body">
          <form action="" class="">
            <div class="mb-3 lh-1">
              <label for="txtNama" class="form-label">Nama</label>
              <input type="text" class="form-control form-control-sm my-border-input" id="txtNama" required>
            </div>
            <div class="mb-3 lh-1">
              <label for="txtAlamat" class="form-label">Alamat</label>
              <input type="text" class="form-control form-control-sm my-border-input" id="txtAlamat" required>
            </div>
            <div class="mb-3 lh-1">
              <label for="selectKota" class="form-label">Kota</label>
              <select class="form-select form-select-sm my-border-input" id="selectKota" required>
                <option selected disabled value=""></option>
                <option value="1">Gresik</option>
                <option value="2">Surabaya</option>
              </select>
            </div>
            <div class="mb-3 lh-1">
              <label for="txtNomorHP" class="form-label">Nomor HP</label>
              <input type="number" class="form-control form-control-sm my-border-input" id="txtNomorHP" required>
            </div>
            <div class="mb-3 lh-1">
              <label for="txtEmail" class="form-label">Email</label>
              <input type="email" class="form-control form-control-sm my-border-input" id="txtEmail" required>
            </div>
            <div class="mb-3 lh-1">
              <label for="txtUsername" class="form-label">Username</label>
              <input type="text" class="form-control form-control-sm my-border-input" id="txtUsername" required>
            </div>
            <div class="mb-4 lh-1">
              <label for="txtPassword" class="form-label">Password</label>
              <input type="password" class="form-control form-control-sm my-border-input" id="txtPassword" required>
            </div>
            <div class="d-flex justify-content-center">
              <button type="submit" class="btn btn-sm lh-sm px-4 my-btn-purpledark my-border-btn rounded-pill">UPDATE</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php echo $this->endSection(); ?>