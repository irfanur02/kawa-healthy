<?php echo $this->extend('layout/user/template'); ?>

<?php echo $this->section('content'); ?>
<div class="homepage">
  <?php echo $this->include('layout/user/navbar.php'); ?>

  <div class="content-homepage">
    <div class="my-jumbotron">
      <div class="my-img-jumbotron">
        <div class="my-effect"></div>
        <div class="my-body-jumbotron d-flex justify-content-center align-items-center flex-column text-center">
          <h1 class="lh-1">KAWA HEALTHY</h1>
          <h4 class="lh-1 fs-5">Healthy Catering For Fit Your Body</h4>
          <h3 class="lh-1 fs-5 mt-3">STAY FIT & STAY HEALTHY</h3>
          <div class="btn-group rounded-pill my-btn-group" style="margin-top: 5em;" role="group" aria-label="Basic example">
            <a href="#katalog-personal" role="button" class="btn btn-light border border-0 fw-medium my-text-purpledark rounded-start-pill py-2 text-nowrap page-scroll" style="width: 13em;">
              <span class="fs-4">Personal Pack</span>
              <br>
              <span>2500 Pack Terjual</span>
            </a>
            <a href="#katalog-family" role="button" class="btn btn-light border border-0 fw-medium my-text-purpledark rounded-end-pill py-2 text-nowrap page-scroll" style="width: 13em;">
              <span class="fs-4">Family Pack</span>
              <br>
              <span>1200 Pack Terjual</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="content-katalog">
      <div class="border content-body-katalog personal border-black rounded bg-light p-3" id="katalog-personal">
        <div class="row justify-content-end align-items-center">
          <div class="col-4 text-center">
            <span class="fs-6 fw-bold">PERSONAL PACK<br>(1 - 5 Januari)</span>
          </div>
          <div class="col-4 text-end">
            <button class="btn my-btn-purpledark border rounded-pill border-black my-border-btn lh-sm" data-bs-toggle="modal" data-bs-target="#modalPaketan">Paketan</button>
          </div>
        </div>
        <div class="text-center mt-2">
          <div class="d-flex justify-content-center flex-wrap data-menu">
            <div class="list-data-menu personal-menu">
              <ul class="list-group border border-black">
                <li class="list-group-item border border-0 my-bg-purple">
                  <div class="row m-0">
                    <div class="col my-auto tanggalMenuPersonal">Senin 1 Januari</div>
                    <div class="col-3 btnPilihMenu">
                      <span class="d-inline-block"><i class="bi bi-hand-index-thumb-fill"></i></span>
                      <span class="mx-1 d-inline-block my-2">Pilih Menu</span>
                    </div>
                  </div>
                </li>
                <li class="list-group-item my-bg-purplelight">
                  <div class="row m-0">
                    <div class="col p-0 text-start">
                      <span class="menuPersonal">Nasi Bakar Ayam Suwir Kemangi, Orek Telur, Lalapan Timun Wortel, Sambal</span>
                    </div>
                    <div class="col-3 p-0 d-flex align-items-center justify-content-end">
                      <div class="my-form-checkbox d-flex align-items-center">
                        <label class="form-check-label"><span class="jenisPaketMenu">Lunch</span><br><span class="hargaMenuPersonal">Rp. 45000</span></label>
                        <input class="form-check-input my-border-input my-0 mx-1" type="checkbox">
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item my-bg-purplelight">
                  <div class="row m-0">
                    <div class="col p-0 text-start">
                      <span class="menuPersonal">Nasi Bakar Ayam Suwir Kemangi, Orek Telur, Lalapan Timun Wortel, Sambal</span>
                    </div>
                    <div class="col-3 p-0 d-flex align-items-center justify-content-end">
                      <div class="my-form-checkbox d-flex align-items-center">
                        <label class="form-check-label"><span class="jenisPaketMenu">Dinner</span><br><span class="hargaMenuPersonal">Rp. 50000</span></label>
                        <input class="form-check-input my-border-input my-0 mx-1" type="checkbox">
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item my-bg-purplelight">
                  <div class="row m-0 justify-content-end">
                    <div class="col text-end d-flex align-items-center justify-content-end">
                      <button class="btn btn-sm lh-sm my-btn-purpledark border rounded-pill border-black my-border-btn lh-sm modalPilihMenu modalPersonal" data-bs-toggle="modal" data-bs-target="#modalPilihMenu">Lanjut</button>
                    </div>
                    <div class="col-3 p-0 d-flex align-items-center justify-content-end">
                      <div class="my-form-checkbox d-flex align-items-center">
                        <label class="form-check-label"><span class="jenisPaketMenu">Infuse</span><br><span class="hargaMenuPersonal">Rp. 55000</span></label>
                        <input class="form-check-input my-border-input my-0 mx-1" type="checkbox">
                      </div>
                    </div>
                  </div>
                </li>
              </ul>

              <ul class="list-group border border-black">
                <li class="list-group-item border border-0 my-bg-purple">
                  <div class="row m-0">
                    <div class="col my-auto tanggalMenuPersonal">Senin 1 Februari</div>
                    <div class="col-3 btnPilihMenu">
                      <span class="d-inline-block"><i class="bi bi-hand-index-thumb-fill"></i></span>
                      <span class="mx-1 d-inline-block my-2">Pilih Menu</span>
                    </div>
                  </div>
                </li>
                <li class="list-group-item my-bg-purplelight">
                  <div class="row m-0">
                    <div class="col p-0 text-start">
                      <span class="menuPersonal">Nasi Bakar Ayam Suwir Kemangi, Orek Telur, Lalapan Timun Wortel, Sambal</span>
                    </div>
                    <div class="col-3 p-0 d-flex align-items-center justify-content-end">
                      <div class="my-form-checkbox d-flex align-items-center">
                        <label class="form-check-label"><span class="jenisPaketMenu">Lunch</span><br><span class="hargaMenuPersonal">Rp. 45000</span></label>
                        <input class="form-check-input my-border-input my-0 mx-1" type="checkbox">
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item my-bg-purplelight">
                  <div class="row m-0">
                    <div class="col p-0 text-start">
                      <span class="menuPersonal">Nasi Bakar Ayam Suwir Kemangi, Orek Telur, Lalapan Timun Wortel, Sambal</span>
                    </div>
                    <div class="col-3 p-0 d-flex align-items-center justify-content-end">
                      <div class="my-form-checkbox d-flex align-items-center">
                        <label class="form-check-label"><span class="jenisPaketMenu">Dinner</span><br><span class="hargaMenuPersonal">Rp. 50000</span></label>
                        <input class="form-check-input my-border-input my-0 mx-1" type="checkbox">
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item my-bg-purplelight">
                  <div class="row m-0 justify-content-end">
                    <div class="col text-end d-flex align-items-center justify-content-end">
                      <button class="btn btn-sm lh-sm my-btn-purpledark border rounded-pill border-black my-border-btn lh-sm modalPilihMenu modalPersonal" data-bs-toggle="modal" data-bs-target="#modalPilihMenu">Lanjut</button>
                    </div>
                    <div class="col-3 p-0 d-flex align-items-center justify-content-end">
                      <div class="my-form-checkbox d-flex align-items-center">
                        <label class="form-check-label"><span class="jenisPaketMenu">Infuse</span><br><span class="hargaMenuPersonal">Rp. 55000</span></label>
                        <input class="form-check-input my-border-input my-0 mx-1" type="checkbox">
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- family -->

      <div class="content-body-katalog family pt-3" id="katalog-family" style="margin-top: 7em;">
        <div class="row justify-content-end align-items-center mb-3">
          <div class="col text-center">
            <span class="fs-6 fw-bold">FAMILY PACK<br>(1 - 5 Januari)</span>
          </div>
        </div>
        <div class="list-data-menu family-menu d-flex justify-content-center flex-wrap">
          <ul class="list-group border border-black">
            <li class="list-group-item border border-0 my-bg-toscalight text-center">
              <span class="tanggalMenuFamily">Senin 1 Januari</span>
            </li>
            <li class="list-group-item border border-0">
              <div class="list-menu d-flex flex-nowrap justify-content-between">
                <div class="col-menu p-0 text-start">
                  <p class="lh-1 m-0"><span class="menuFamily">Scramble Egg Saus Shimeji</span></p>
                  <p class="lh-1 m-0 fw-bold"><span class="hargaMenuFamily">Rp. 20000</span></p>
                </div>
                <div class="my-form-checkbox d-flex align-items-center">
                  <input class="form-check-input my-border-input my-0" type="checkbox">
                </div>
              </div>
            </li>
            <li class="list-group-item border border-0">
              <div class="list-menu d-flex flex-nowrap justify-content-between">
                <div class="col-menu p-0 text-start">
                  <p class="lh-1 m-0"><span class="menuFamily">Kangkung</span></p>
                  <p class="lh-1 m-0 fw-bold"><span class="hargaMenuFamily">Rp. 15000</span></p>
                </div>
                <div class="my-form-checkbox d-flex align-items-center">
                  <input class="form-check-input my-border-input my-0" type="checkbox">
                </div>
              </div>
            </li>
            <li class="list-group-item border border-0 my-bg-toscalight text-center">
              <div class="d-flex flex-column px-5">
                <button class="btn btn-sm lh-sm my-btn-tosca border rounded-pill border-black my-border-btn text-nowrap btnPilihMenu">Pilih Menu</button>
                <button class="btn btn-sm lh-sm btn-danger border rounded-pill border-black my-border-btn mt-2 btnBatalPilih">Batal</button>
              </div>
            </li>
          </ul>

          <ul class="list-group border border-black">
            <li class="list-group-item border border-0 my-bg-toscalight text-center">
              <span>Senin 1 Maret</span>
            </li>
            <li class="list-group-item border border-0">
              <div class="list-menu d-flex flex-nowrap justify-content-between">
                <div class="col-menu p-0 text-start">
                  <p class="lh-1 m-0"><span class="menuFamily">Kangkung</span></p>
                  <p class="lh-1 m-0 fw-bold"><span class="hargaMenuFamily">Rp. 15000</span></p>
                </div>
                <div class="my-form-checkbox d-flex align-items-center">
                  <input class="form-check-input my-border-input my-0" type="checkbox">
                </div>
              </div>
            </li>
            <li class="list-group-item border border-0">
              <div class="list-menu d-flex flex-nowrap justify-content-between">
                <div class="col-menu p-0 text-start">
                  <p class="lh-1 m-0"><span class="menuFamily">Scramble Egg Saus Shimeji</span></p>
                  <p class="lh-1 m-0 fw-bold"><span class="hargaMenuFamily">Rp. 30000</span></p>
                </div>
                <div class="my-form-checkbox d-flex align-items-center">
                  <input class="form-check-input my-border-input my-0" type="checkbox">
                </div>
              </div>
            </li>
            <li class="list-group-item border border-0 my-bg-toscalight text-center">
              <div class="d-flex flex-column px-5">
                <button class="btn btn-sm lh-sm my-btn-tosca border rounded-pill border-black my-border-btn text-nowrap btnPilihMenu">Pilih Menu</button>
                <button class="btn btn-sm lh-sm btn-danger border rounded-pill border-black my-border-btn mt-2 btnBatalPilih">Batal</button>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal pilih menu -->
<div class="modal fade" id="modalPilihMenu" tabindex="-1" aria-labelledby="modalPilihMenuLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header my-bg-pinklight justify-content-center border-bottom border-black">
        <h1 class="modal-title fs-5 text-center" id="modalPilihMenuLabel">Personal Pack<br><span>Selasa 2 Januari</span></h1>
      </div>
      <div class="modal-body p-0">
        <ul class="list-group">

        </ul>
      </div>
      <div class="modal-footer my-bg-pinklight border-top border-black">
        <button class="btn btn-sm px-4 my-btn-purpledark border rounded-pill border-black my-border-btn fw-medium" data-bs-dismiss="modal">Lanjut Pilih Menu</button>
        <a href="daftar_pesanan.html" class="btn btn-sm px-4 my-btn-pink my-border-btn rounded-pill mx-1 fw-medium" role="button">Selesai</a>
        <button type="button" class="btn btn-light btn-sm px-4 border rounded-pill border-black my-border-btn fw-medium" data-bs-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Paketan -->
<div class="modal fade" id="modalPaketan" tabindex="-1" aria-labelledby="modalPaketanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-sm">
    <div class="modal-content">
      <div class="modal-header my-bg-pinklight justify-content-center border-bottom border-black">
        <h1 class="modal-title fs-5" id="modalPaketanLabel">Personal Pack Paketan</h1>
      </div>
      <div class="modal-body p-0">
        <div class="container">
          <div class="mb-3 mt-3 lh-1">
            <div class="multiselect">
              <div class="selectBox">
                <select class="form-select form-select-sm my-border-input">
                  <option>Pilih Paket Menu</option>
                </select>
                <div class="overSelect"></div>
              </div>
              <div id="checkboxes">
                <label for="one">
                  <input class="form-check-input my-border-input m-0" data-harga="50000" type="checkbox" id="one" />
                  Paket Lunch
                </label>
                <label for="two">
                  <input class="form-check-input my-border-input m-0" data-harga="55000" type="checkbox" id="two" />
                  Paket Dinner
                </label>
                <label for="three">
                  <input class="form-check-input my-border-input m-0" data-harga="5000" type="checkbox" id="three" />
                  Infuse
                </label>
              </div>
            </div>
          </div>
          <div class="mb-2">
            <div class="d-flex justify-content-between align-items-center">
              <label for="exampleFormControlInput1" class="form-label m-0">Mulai Tanggal</label>
              <input type="date" class="form-control form-control-sm my-border-input txtDate mx-0" style="width: 50%;">
            </div>
          </div>
          <div class="mb-2">
            <div class="d-flex justify-content-between align-items-center">
              <label for="exampleFormControlInput1" class="form-label m-0">Berapa Hari</label>
              <input type="number" class="form-control form-control-sm my-border-input mx-0 inputNumber" type="number" min="1" oninput="validity.valid||(value='');" name="jumlahHari" id="jumlahHari" value="1" style="width: 50%;">
            </div>
          </div>
          <div class="mb-3">
            <select class="form-select form-select-sm my-border-input mx-auto w-auto" style="height:fit-content;" id="selectKarbo" required>
              <option selected disabled value="">Pilih Karbo</option>
              <option value="1">Nasi Merah</option>
              <option value="2">Maspotato</option>
            </select>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control form-control-sm my-border-input w-50 txtPantangan w-100" placeholder="Masukkan Pantangan" required>
          </div>
        </div>
        <div class="container py-2 border-top border-bottom border-black">
          <div class="row">
            <div class="col d-flex justify-content-between">
              <span>HARGA</span>
              <span class="totalHargaMenu">Rp. 83000</span>
            </div>
          </div>
          <div class="row">
            <div class="col d-flex justify-content-between">
              <span>ONGKIR</span>
              <span class="hargaOngkir">Rp. 10000</span>
            </div>
          </div>
          <div class="row">
            <div class="col d-flex justify-content-between">
              <span>TOTAL HARGA</span>
              <span class="totalHargaMenuKeseluruhan">Rp. 93000</span>
            </div>
          </div>
        </div>
        <div class="container d-flex flex-column px-5 my-bg-pinklight py-2 border-bottom border-black">
          <button class="btn btn-sm lh-sm btn-light border rounded-pill border-black my-border-btn text-nowrap btnBatalLanjutBayar">Batal</button>
          <button class="btn btn-sm lh-sm my-btn-pink border rounded-pill border-black my-border-btn mt-2 btnLanjutBayar">Lanjut Pembayaran</button>
        </div>
        <div class="container my-collapse border-top border-black mt-3 pt-3">
          <div class="mb-5 dataPembayaran" id="collapsePembayaran">
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
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>