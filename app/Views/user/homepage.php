<?php echo $this->extend('layout/user/template'); ?>

<?php echo $this->section('content'); ?>
<div class="homepage">
  <?php echo $this->include('layout/user/navbar.php'); ?>

  <div class="content-homepage">
    <div class="my-jumbotron">
      <div class="my-img-jumbotron">
        <div class="my-effect"></div>
        <div class="my-body-jumbotron d-flex justify-content-center align-items-center flex-column text-center">
          <h1 class="lh-1 text-green">KAWA HEALTHY</h1>
          <h4 class="lh-1 text-green fs-5">Healthy Catering For Fit Your Body</h4>
          <h3 class="lh-1 text-green fs-5 mt-3">STAY FIT & STAY HEALTHY</h3>
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
            <span class="fs-6 fw-bold">PERSONAL PACK</span><br>
            <?php if (empty($dataJadwalPersonal[0]['tanggal_menu'])) : ?>
              <span class="fs-6 ">Mohon Maaf Kami Masih Libur</span>
            <?php else : ?>
              <?php if (formatTanggal($dataJadwalPersonal[0]['tanggal_menu'], false, true) == formatTanggal($dataJadwalPersonal[count($dataJadwalPersonal) - 1]['tanggal_menu'], false, true)) : ?>
                <span class="fs-6 fw-bold">(
                  <?php echo formatTanggal($dataJadwalPersonal[0]['tanggal_menu'], true); ?> -
                  <?php echo formatTanggal($dataJadwalPersonal[count($dataJadwalPersonal) - 1]['tanggal_menu'], true); ?>
                  <?php echo formatTanggal($dataJadwalPersonal[count($dataJadwalPersonal) - 1]['tanggal_menu'], false, true); ?> )</span>
              <?php else : ?>
                <span class="fs-6 fw-bold">(
                  <?php echo formatTanggal($dataJadwalPersonal[0]['tanggal_menu'], true); ?>
                  <?php echo formatTanggal($dataJadwalPersonal[0]['tanggal_menu'], false, true); ?> -
                  <?php echo formatTanggal($dataJadwalPersonal[count($dataJadwalPersonal) - 1]['tanggal_menu'], true); ?>
                  <?php echo formatTanggal($dataJadwalPersonal[count($dataJadwalPersonal) - 1]['tanggal_menu'], false, true); ?> )</span>
              <?php endif; ?>
              <br>
              <button class="btn btn-sm my-btn-green border rounded-pill border-black my-border-btn lh-sm" data-bs-toggle="modal" data-bs-target="#modalInformasi">Informasi</button>
            <?php endif; ?>
          </div>
          <div class="col-4 text-end">
            <?php if (!empty($dataJadwalPersonal[0]['tanggal_menu'])) : ?>
              <button class="btn my-btn-orange border rounded-pill border-black my-border-btn lh-sm" id="btnModalPaketan" data-bs-toggle="modal" data-bs-target="#modalPaketan">Paketan</button>
            <?php endif; ?>
          </div>
        </div>
        <div class="text-center mt-2">
          <div class="d-flex justify-content-center flex-wrap data-menu">
            <div class="list-data-menu personal-menu">
              <?php foreach ($dataJadwalPersonal as $data) : ?>
                <ul class="list-group border border-black">
                  <li class="list-group-item border border-0 my-bg-greenlight">
                    <div class="row m-0">
                      <input type="text" name="idJadwalMenu" hidden value="<?php echo $data['id_jadwal_menu']; ?>">
                      <div class="col my-auto tanggalMenuPersonal"><?php echo formatTanggal($data['tanggal_menu']); ?></div>
                      <?php if ($data['tanggal_menu'] < date("Y-m-d") || $data['tanggal_menu'] == date("Y-m-d")) : ?>
                        <div class="col-3 btnPilihMenu MenuTutup">
                          <span class="d-inline-block"><i class="bi bi-x-lg"></i></span>
                          <span class="mx-1 d-inline-block my-2">Menu DiTutup</span>
                        </div>
                      <?php else : ?>
                        <div class="col-3 btnPilihMenu">
                          <span class="d-inline-block"><i class="bi bi-hand-index-thumb-fill"></i></span>
                          <span class="mx-1 d-inline-block my-2">Pilih Menu</span>
                        </div>
                      <?php endif; ?>
                    </div>
                  </li>
                  <?php foreach ($dataDetailJadwalPersonal as $dataDetail) : ?>
                    <?php if ($data['tanggal_menu'] == $dataDetail['tanggal_menu']) : ?>
                      <li class="list-group-item ">
                        <input type="text" name="idDetailJadwalMenu" hidden value="<?php echo $dataDetail['id_detail_jadwal_menu']; ?>">
                        <div class="row m-0">
                          <div class="col-1 p-0">
                            <img src="/menu1.jpg" class="gambar-menu lihatFotoMenu" alt="..." data-bs-toggle="modal" data-bs-target="#modalLihatFotoMenu">
                          </div>
                          <div class="col p-0 text-start">
                            <span class="menuPersonal"><?php echo $dataDetail['nama_menu']; ?></span>
                          </div>
                          <div class="col-3 p-0 d-flex align-items-center justify-content-end">
                            <div class="my-form-checkbox d-flex align-items-center">
                              <label class="form-check-label"><span class="jenisPaketMenu"><?php echo $dataDetail['nama_paket_menu']; ?></span><br><span class="hargaMenuPersonal"><?php echo formatRupiah($dataDetail['harga_paket_menu']); ?></span></label>
                              <input class="form-check-input my-border-input my-0 mx-1" type="checkbox">
                            </div>
                          </div>
                        </div>
                      </li>
                    <?php endif; ?>
                  <?php endforeach; ?>
                  <li class="list-group-item ">
                    <?php foreach ($dataInfuseJadwalPersonal as $dataInfuse) : ?>
                      <?php if ($data['tanggal_menu'] == $dataInfuse['tanggal_menu']) : ?>
                        <input type="text" hidden name="optionInfuse" value="<?php echo $dataInfuse['id_detail_jadwal_menu'];
                                                                              ?>">
                        <div class="row m-0 justify-content-end">
                          <div class="col text-end d-flex align-items-center justify-content-end">
                            <button class="btn btn-sm lh-sm my-btn-orange border rounded-pill border-black my-border-btn lh-sm modalPilihMenu modalPersonal" data-bs-toggle="modal" data-bs-target="#modalPilihMenu">Lanjut</button>
                          </div>
                          <div class="col-3 p-0 d-flex align-items-center justify-content-end">
                            <div class="my-form-checkbox d-flex align-items-center">
                              <label class="form-check-label"><span class="jenisPaketMenu"><?php echo $dataPaketMenu['nama_paket_menu']; ?></span><br><span class="hargaMenuPersonal"><?php echo formatRupiah($dataPaketMenu['harga_paket_menu']); ?></span></label>
                              <input class="form-check-input my-border-input my-0 mx-1" type="checkbox">
                            </div>
                          </div>
                        </div>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </li>
                </ul>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>

      <!-- family -->

      <div class="content-body-katalog family pt-3" id="katalog-family" style="margin-top: 7em;">
        <div class="row justify-content-end align-items-center mb-3">
          <div class="col text-center">
            <span class="fs-6 fw-bold">FAMILY PACK</span><br>
            <?php if (empty($dataJadwalFamily[0]['tanggal_menu'])) : ?>
              <span class="fs-6">Mohon Maaf Kami Masih Libur</span>
            <?php else : ?>
              <?php if (formatTanggal($dataJadwalFamily[0]['tanggal_menu'], false, true) == formatTanggal($dataJadwalFamily[count($dataJadwalFamily) - 1]['tanggal_menu'], false, true)) : ?>
                <span class="fs-6 fw-bold">(
                  <?php echo formatTanggal($dataJadwalFamily[0]['tanggal_menu'], true); ?> -
                  <?php echo formatTanggal($dataJadwalFamily[count($dataJadwalFamily) - 1]['tanggal_menu'], true); ?>
                  <?php echo formatTanggal($dataJadwalFamily[count($dataJadwalFamily) - 1]['tanggal_menu'], false, true); ?> )</span>
              <?php else : ?>
                <span class="fs-6 fw-bold">(
                  <?php echo formatTanggal($dataJadwalFamily[0]['tanggal_menu'], true); ?>
                  <?php echo formatTanggal($dataJadwalFamily[0]['tanggal_menu'], false, true); ?> -
                  <?php echo formatTanggal($dataJadwalFamily[count($dataJadwalFamily) - 1]['tanggal_menu'], true); ?>
                  <?php echo formatTanggal($dataJadwalFamily[count($dataJadwalFamily) - 1]['tanggal_menu'], false, true); ?> )</span>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
        <div class="list-data-menu family-menu d-flex justify-content-center flex-wrap">
          <?php foreach ($dataJadwalFamily as $data) : ?>
            <ul class="list-group border border-black">
              <li class="list-group-item border border-0 my-bg-greenlight text-center">
                <input type="text" hidden name="idJadwalMenu" value="<?php echo $data['id_jadwal_menu']; ?>">
                <span class="tanggalMenuFamily"><?php echo formatTanggal($data['tanggal_menu']); ?></span>
              </li>
              <?php foreach ($dataDetailJadwalFamily as $dataDetail) : ?>
                <?php if ($data['tanggal_menu'] == $dataDetail['tanggal_menu']) : ?>
                  <li class="list-group-item border border-0">
                    <input type="text" hidden name="idDetailJadwalMenu" value="<?php echo $dataDetail['id_detail_jadwal_menu']; ?>">
                    <div class="list-menu d-flex flex-nowrap justify-content-between">
                      <div class="col-menu p-0 text-start">
                        <p class="lh-1 m-0"><span class="menuFamily"><?php echo $dataDetail['nama_menu']; ?></span></p>
                        <p class="lh-1 m-0 fw-bold">
                          <span class="hargaMenuFamily"><?php echo formatRupiah($dataDetail['harga_menu']); ?></span>
                          <span><button type="button" class="btn btn-sm btn-link p-0 text-black lihatFotoMenu" data-gambar="/menu1.jpg" data-bs-toggle="modal" data-bs-target="#modalLihatFotoMenu">Lihat Gambar</button></span>
                        </p>
                      </div>
                      <div class="my-form-checkbox d-flex align-items-center">
                        <input class="form-check-input my-border-input my-0" type="checkbox">
                      </div>
                    </div>
                  </li>
                <?php endif; ?>
              <?php endforeach; ?>
              <li class="list-group-item border border-0 my-bg-greenlight text-center">
                <div class="d-flex flex-column px-5">
                  <?php if ($data['tanggal_menu'] < date("Y-m-d") || $data['tanggal_menu'] == date("Y-m-d")) : ?>
                    <span>Menu DiTutup</span>
                  <?php else : ?>
                    <button class="btn btn-sm lh-sm my-btn-orange border rounded-pill border-black my-border-btn text-nowrap btnPilihMenu">Pilih Menu</button>
                    <button class="btn btn-sm lh-sm my-btn-orange border rounded-pill border-black my-border-btn text-nowrap modalPilihMenu modalFamily btnLanjut" data-bs-toggle="modal" data-bs-target="#modalPilihMenu">Lanjut</button>
                    <button class="btn btn-sm lh-sm btn-light border rounded-pill border-black my-border-btn mt-2 btnBatalPilih">Batal</button>
                  <?php endif; ?>
                </div>
              </li>
            </ul>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal lihat foto menu -->
<div class="modal fade" id="modalLihatFotoMenu" tabindex="-1" aria-labelledby="modalLihatFotoMenuLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header my-bg-orange border-bottom border-black justify-content-center">
        <h1 class="modal-title fs-5" id="modalLihatFotoMenuLabel"></h1>
      </div>
      <div class="modal-body">
        <img src="" class="rounded mx-auto d-block" alt="...">
      </div>
      <div class="modal-footer my-bg-vanilla">
        <button type="button" class="btn btn-light btn-sm px-4 border rounded-pill border-black my-border-btn fw-medium" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal informasi -->
<div class="modal fade" id="modalInformasi" tabindex="-1" aria-labelledby="modalInformasiLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header my-bg-orange justify-content-center border-bottom border-black">
        <h1 class="modal-title fs-5" id="modalInformasiLabel">Informasi</h1>
      </div>
      <div class="modal-body p-0">
        <div class="text-center mt-2 mb-2">
          <span>Waktu Makan</span><br>
          <span>(Lunch: 12.00 - 14.00)</span><br>
          <span>(Dinner: 18.00 - 19.00)</span>
          <br><br>
          <span>Keterangan</span><br>
          <span>(Lunch: Dengan Karbo)</span><br>
          <span>(Dinner: Tanpa Karbo)</span><br>
        </div>
      </div>
      <div class="modal-footer my-bg-orange border-top border-black">
        <button type="button" class="btn btn-light btn-sm px-4 border rounded-pill border-black my-border-btn fw-medium" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal pilih menu -->
<div class="modal fade" id="modalPilihMenu" tabindex="-1" aria-labelledby="modalPilihMenuLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header my-bg-orange justify-content-center border-bottom border-black">
        <h1 class="modal-title fs-5 text-center" id="modalPilihMenuLabel"></h1>
      </div>
      <?php if ($session->has('logged_in')) : ?>
        <div class="modal-body p-0">
          <ul class="list-group">

          </ul>
        </div>
        <div class="modal-footer my-bg-vanilla border-top border-black">
          <button class="btn btn-sm px-4 my-btn-green border rounded-pill border-black my-border-btn fw-medium btnTambahDaftarPesanan lanjutPilihMenu">Lanjut Pilih Menu</button>
          <button class="btn btn-sm px-4 my-btn-orange my-border-btn rounded-pill mx-1 fw- btnTambahDaftarPesanan selesaiPilihMenu">Selesai</button>
          <button type="button" class="btn btn-light btn-sm px-4 border rounded-pill border-black my-border-btn fw-medium" data-bs-dismiss="modal">Batal</button>
        </div>
      <?php else : ?>
        <div class="card my-bg-pinklight border border-black m-3 InfoDaftarPesanan" style="display: block;">
          <div class="card-body text-center">
            <span class="fs-6">Anda Belum Login, Silahkan Login Dulu</span>
            <br>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Modal Paketan -->
<div class="modal fade" id="modalPaketan" tabindex="-1" aria-labelledby="modalPaketanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-sm">
    <div class="modal-content">
      <div class="modal-header my-bg-orange justify-content-center border-bottom border-black">
        <h1 class="modal-title fs-5" id="modalPaketanLabel">Personal Pack Paketan</h1>
      </div>
      <?php if ($session->has('logged_in')) : ?>
        <div class="modal-body p-0 my-bg-vanilla step-pembayaran">
          <div class="container">
            <div class="mb-3 mt-3 lh-1">
              <div class="multiselect">
                <div class="selectBox">
                  <select class="form-select form-select-sm my-border-input" name="paketMenu" id="pilihPaket">
                    <option>Pilih Paket Menu</option>
                  </select>
                  <div class="overSelect"></div>
                </div>
                <div id="checkboxes">
                  <?php foreach ($dataAllPaketMenu as $index => $data) : ?>
                    <label for="cbkPaketMenu<?php echo $index + 1; ?>">
                      <input class="form-check-input my-border-input m-0 cbkPaketMenu" data-harga="<?php echo $data['harga_paket_menu']; ?>" data-idPaketMenu="<?php echo $data['id_paket_menu']; ?>" id="cbkPaketMenu<?php echo $index + 1; ?>" type="checkbox" />
                      <?php echo $data['nama_paket_menu']; ?>
                    </label>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
            <div class="mb-2">
              <div class="d-flex justify-content-between align-items-center">
                <label for="exampleFormControlInput1" class="form-label m-0">Mulai Tanggal</label>
                <div>
                  <input type="date" id="tanggalMulai" name="tanggal" class="form-control form-control-sm my-border-input txtDate mx-0">
                </div>
              </div>
            </div>
            <div class="mb-2">
              <div class="d-flex justify-content-between align-items-center">
                <label for="exampleFormControlInput1" class="form-label m-0">Berapa Hari</label>
                <input type="number" class="form-control form-control-sm my-border-input mx-0 inputNumber" type="number" min="1" oninput="validity.valid||(value='');" name="jumlahHari" id="jumlahHari" value="1" style="width: 50%;">
              </div>
            </div>
            <div class="mb-3 text-center" style="display: none;">
              <select class="form-select form-select-sm my-border-input mx-auto w-auto" name="karbo" style="height:fit-content;" id="selectKarbo" required>
                <option selected disabled value="-">Pilih Karbo</option>
                <?php foreach ($dataKarbo as $data) : ?>
                  <option value="<?php echo $data['id_karbo']; ?>"><?php echo $data['nama_karbo']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <input type="text" class="form-control form-control-sm my-border-input w-50 txtPantangan w-100" id="txtPantangan" placeholder="Masukkan Pantangan" required>
            </div>
          </div>
          <div class="container py-2 border-top border-black">
            <span class="d-block mx-auto">Pengiriman</span>
            <div class="form-check">
              <input class="form-check-input my-border-input" type="checkbox" value="false" id="cbkCekAlamatRumah">
              <label class="form-check-label" for="cbkCekAlamatRumah">
                Gunakan alamat rumah
              </label>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <label for="exampleFormControlInput1" class="form-label m-0">Kota</label>
              <div>
                <select class="form-select form-select-sm my-border-input" name="kota" id="selectKota">
                  <option disabled value="">Pilih Kota</option>
                </select>
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <label for="exampleFormControlInput1" class="form-label m-0">Alamat</label>
              <div>
                <input type="text" class="form-control form-control-sm my-border-input" name="alamat" id="txtAlamat" required>
              </div>
            </div>
          </div>
          <div class="container py-2 border-top border-bottom border-black">
            <div class="row">
              <div class="col d-flex justify-content-between">
                <span>HARGA</span>
                <span class="totalHargaMenu">Rp. 0</span>
              </div>
            </div>
            <div class="row">
              <div class="col d-flex justify-content-between">
                <span>ONGKIR</span>
                <span class="hargaOngkir">Rp. 0</span>
              </div>
            </div>
            <div class="row">
              <div class="col d-flex justify-content-between">
                <span>TOTAL HARGA</span>
                <span class="totalHargaMenuKeseluruhan">Rp. 0</span>
              </div>
            </div>
          </div>
          <div class="container d-flex flex-column px-5 my-bg-pinklight py-2 border-bottom border-black">
            <button class="btn btn-sm lh-sm btn-light border rounded-pill border-black my-border-btn text-nowrap btnBatalLanjutBayar">Batal</button>
            <button class="btn btn-sm lh-sm my-btn-orange border rounded-pill border-black my-border-btn mt-2 btnLanjutBayar">Lanjut Pembayaran</button>
          </div>
          <div class="container my-collapse border-top border-black mt-3 pt-3">
            <div class="mb-5 dataPembayaran" id="collapsePembayaran">
              <div class="mx-auto" style="max-width: 17em;">
                <div class="card list-pembayaran border border-0">
                  <div class="card-header my-bg-orange border border-black rounded-1 text-center">
                    PEMBAYARAN
                  </div>
                  <ul class="list-group">
                    <li class="list-group-item border border-black mt-1">
                      <div class="row">
                        <div class="col">
                          <img src="/mandiri.png" alt="" style="width: 30%;">
                          <span class="d-inline-block mx-2">1234524534634</span>
                        </div>
                        <div class="col-1 align-self-end d-flex justify-content-center align-items-center text-center"><span><i class="bi bi-copy" style="cursor: pointer;"></i></span></div>
                      </div>
                    </li>
                    <li class="list-group-item border border-black mt-1">
                      <div class="row">
                        <div class="col">
                          <img src="/gopay.png" alt="" style="width: 30%;">
                          <span class="d-inline-block mx-2">1234524534634</span>
                        </div>
                        <div class="col-1 align-self-end d-flex justify-content-center align-items-center text-center">
                          <span>
                            <i class="bi bi-copy" style="cursor: pointer;"></i>
                          </span>
                        </div>
                      </div>
                    </li>
                  </ul>
                  <div class="d-flex justify-content-center flex-column text-center">
                    <div class="mt-3 lh-1 mx-auto">
                      <label for="txtGambar" class="form-label">Upload Bukti Transfer</label><br>
                      <input type="file" style="color: transparent; width: 90px;" class="my-file-input mx-auto" name="gambar" id="fileGambar" required>
                    </div>
                    <div class="mt-3 lh-1 mx-auto" style="width: 10em;">
                      <label for="txtNominal" class="form-label">Nominal</label>
                      <input oninput="validity.valid||(value='');" min="1" type="number" name="nominal" class="form-control form-control-sm my-border-input qtyMenu" id="txtNominal" required>
                    </div>
                    <div class="mt-3 lh-1 mx-auto" style="width: 10em;">
                      <label for="txtAtasNama" class="form-label">Atas Nama</label>
                      <input type="text" class="form-control form-control-sm my-border-input" name="atasNama" id="txtAtasNama" required>
                    </div>
                    <button type="button" class="btn btn-sm my-btn-orange my-border-btn rounded-pill mt-4 w-50 mx-auto fw-medium" id="btnLanjutBayar">Bayar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php else : ?>
        <div class="card my-bg-pinklight border border-black m-3 InfoDaftarPesanan" style="display: block;">
          <div class="card-body text-center">
            <span class="fs-6">Anda Belum Login, Silahkan Login Dulu</span>
            <br>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>