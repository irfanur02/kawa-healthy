<?php echo $this->extend('layout/user/template'); ?>

<?php echo $this->section('content'); ?>

  <?php echo $this->include('layout/user/navbar.php'); ?>

  <div class="content content-pesanan-selesai container">
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
    <div class="mt-5">
      <div class="table-content">
        <table class="table table-hover table-sm table-borderless mb-0">
          <thead>
            <tr class="text-center">
              <td scope="col">Tanggal Transaksi</td>
              <td scope="col">Menu Tanggal</td>
              <td scope="col">Total Harga</td>
              <td scope="col">Aksi</td>
            </tr>
          </thead>
          <tbody>
            <tr class="text-center align-middle">
              <td>31 Desember 2024</td>
              <td>Kamis 4 Januari</td>
              <td>Rp. 150000</td>
              <td>
                <a class="btn btn-sm my-btn-tosca my-border-btn rounded-pill fw-medium lh-1" href="pesanan_detail_paketan.html" role="button">Detail</a>
                <button type="button" class="btn btn-sm btn-success my-border-btn rounded-pill fw-medium lh-1" data-bs-toggle="modal" data-bs-target="#modalReview">
                  Review
                </button>
              </td>
            </tr>
            <tr class="text-center align-middle">
              <td>31 Desember 2024</td>
              <td>Kamis 4 Januari</td>
              <td>Rp. 93000</td>
              <td class="text-start">
                <a class="btn btn-sm my-btn-tosca my-border-btn rounded-pill fw-medium lh-1" href="pesanan_detail_biasa.html" role="button">Detail</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Review-->
  <div class="modal fade modal-sm" id="modalReview" tabindex="-1" aria-labelledby="modalReviewLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border border-dark">
        <div class="modal-header justify-content-center my-bg-purpledark">
          <h1 class="modal-title fs-5" id="modalReviewLabel">Ganti Masa Hari</h1>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col text-center">
              <div class="mb-3 lh-1">
                <div class="mb-3 d-flex flex-column">
                  <label for="txtReview" class="form-label">Beri Review</label>
                  <input type="text" class="form-control form-control-sm my-border-input" id="txtReview">
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <button type="button" class="btn btn-sm my-btn-purpledark my-border-btn rounded-pill px-4">Kirim</button>
                </div>
              </div>
            </div>
          </div>
        </div>
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