<?php echo $this->extend('layout/user/template'); ?>

<?php echo $this->section('content'); ?>

  <?php echo $this->include('layout/user/navbar.php'); ?>

  <div class="content content-daftar-pesanan container">
    <div class="row pt-4">
      <div class="col text-center">
        <h6>DAFTAR PESANAN</h6>
      </div>    
    </div>
    <div class="card my-bg-pinklight border border-black mt-5 InfoDaftarPesanan">
      <div class="card-body text-center">
        <span class="fs-5">Daftar Pesanan Masih Kosong</span>
        <br>
        <a class="btn btn-link my-text-purpledark" href="homepage.html" role="button">Pesan Dulu Yuk!</a>
      </div>
    </div>
    <div class="mt-3 dataPesanan">
      <ul class="list-group list-daftar-pesanan rounded-0">
        <li class="list-group-item lh-1 p-0">
          <div class="row d-flex flex-nowrap m-0">
            <div class="col my-2">
              <div class="row d-flex flex-nowrap align-items-center">
                <div class="col-3">Selasa 2 Januari</div>
                <div class="col">
                  <p class="my-0">Botok Tahu Udang Kemangi<br><span class="fw-bold">Rp. <span class="hargaMenu">30000</span></span></p>
                </div>
                <div class="col-auto d-flex flex-nowrap align-items-center">
                  <span class="mx-1">Qty</span>
                  <input class="form-control form-control-sm my-border-input bg-warning border border-0 mx-1 px-1 py-0 qtyMenu" style="width: 6ch;" type="number" min="1" oninput="validity.valid||(value='');" name="" value="1">
                  <div class="my-form-checkbox">
                    <input class="form-check-input my-border-input my-0 mx-1" type="checkbox">
                    <label class="form-check-label mx-1" for="cbPedas">Pedas</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto p-0"><button class="btn rounded-0 btnHapusList">HAPUS</button></div>
          </div>
        </li>
        <li class="list-group-item lh-1 p-0">
          <div class="row d-flex flex-nowrap m-0">
            <div class="col my-2">
              <div class="row d-flex flex-nowrap align-items-center">
                <div class="col-3">Selasa 2 Januari</div>
                <div class="col">
                  <p class="my-0">Tahu Udang Kemangi<br><span class="fw-bold">Rp. <span class="hargaMenu">15000</span></span></p>
                </div>
                <div class="col-auto d-flex flex-nowrap align-items-center">
                  <span class="mx-1">Qty</span>
                  <input class="form-control form-control-sm my-border-input bg-warning border border-0 mx-1 px-1 py-0 qtyMenu" style="width: 6ch;" type="number" name="" value="1">
                  <div class="my-form-checkbox">
                    <input class="form-check-input my-border-input my-0 mx-1" type="checkbox">
                    <label class="form-check-label mx-1" for="cbPedas">Pedas</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto p-0"><button class="btn rounded-0 btnHapusList">HAPUS</button></div>
          </div>
        </li>
        <li class="list-group-item lh-1 p-0">
          <div class="row d-flex flex-nowrap m-0">
            <div class="col my-2">
              <div class="row d-flex flex-nowrap align-items-center">
                <div class="col-3">Rabu 3 Januari</div>
                <div class="col">
                  <div class="row d-flex flex-nowrap">
                    <div class="col">
                      <p class="my-0">Nasa Merah Ayam Bakar Krawu Telur Asin<br><span class="fw-bold">Lunch Rp. <span class="hargaMenu">25000</span></span></p>
                    </div>
                    <div class="col-auto d-flex flex-nowrap align-items-center">
                      <span class="mx-1">Qty</span>
                      <input class="form-control form-control-sm my-border-input bg-warning border border-0 mx-1 px-1 py-0 qtyMenu" oninput="validity.valid||(value='');" style="width: 6ch;" type="number" name="" value="1">
                    </div>
                  </div>
                  <div class="mt-2 d-flex gap-2">
                    <select class="form-select form-select-sm my-border-input w-auto" style="height:fit-content;" id="selectKarbo" required>
                      <option selected disabled value="">Pilih Karbo</option>
                      <option value="1">Nasi Merah</option>
                      <option value="2">Maspotato</option>
                    </select>
                    <input type="text" class="form-control form-control-sm my-border-input w-50" id="txtPantangan" placeholder="Masukkan Pantangan" required>
                    </input>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto p-0"><button class="btn rounded-0 btnHapusList">HAPUS</button></div>
          </div>
        </li>
      </ul>
      <div class="mx-auto" style="max-width: 17em;">
        <ul class="list-group border border-top-0 border-black rounded-0">
          <li class="list-group-item fw-bold">
            <div class="row">
              <div class="col d-flex justify-content-between">
                <span>HARGA</span>
                <span class="totalHargaMenu">Rp. 83000</span></div>
            </div>
            <div class="row">
              <div class="col d-flex justify-content-between">
                <span>ONGKIR</span>
                <span class="hargaOngkir">Rp. 10000</span></div>
            </div>
            <div class="row">
              <div class="col d-flex justify-content-between">
                <span>TOTAL HARGA</span>
                <span class="totalHargaMenuKeseluruhan">Rp. 93000</span>
              </div>
            </div>
          </li>
        </ul>
        <button type="button" class="btn btn-sm my-btn-purpledark my-border-btn rounded-pill mt-3 w-100 fw-medium btnLanjutBayar">Lanjut Pembayaran</button>
      </div>
    </div>
    <div class="my-collapse mb-5 dataPembayaran" id="collapsePembayaran">
      <hr>
      <div class="mx-auto" style="max-width: 17em;">
        <div class="card list-pembayaran border border-0">
          <div class="card-header my-bg-purple border border-black rounded-1 text-center">
            PEMBAYARAN
          </div>
          <div class="d-flex justify-content-center flex-column text-center">
            <div class="mt-3 lh-1 mx-auto">
              <label for="txtGambar" class="form-label">Upload Bukti Transfer</label><br>
              <input type="file" style="color: transparent; width: 90px;" class="my-file-input mx-auto" id="txtGambar" required>
            </div>
            <div class="mt-3 lh-1 mx-auto" style="width: 10em;">
              <label for="txtNominal" class="form-label">Nominal</label>
              <input type="text" class="form-control form-control-sm my-border-input" id="txtNominal" required>
            </div>
            <div class="mt-3 lh-1 mx-auto" style="width: 10em;">
              <label for="txtAtasNama" class="form-label">Atas Nama</label>
              <input type="text" class="form-control form-control-sm my-border-input" id="txtAtasNama" required>
            </div>
            <button type="button" class="btn btn-sm my-btn-purpledark my-border-btn rounded-pill mt-4 w-50 mx-auto fw-medium" id="btnLanjutBayar">Bayar</button>
            <button type="button" class="btn btn-sm btn-danger my-border-btn rounded-pill mt-1 w-50 mx-auto fw-medium btnBatalLanjutBayar">Batal</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Profil -->
  <div class="modal fade" id="modalProfil" tabindex="-1" aria-labelledby="modalProfilLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
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

