<?php echo $this->extend('layout/user/template'); ?>

<?php echo $this->section('content'); ?>

<?php echo $this->include('layout/user/navbar.php'); ?>

<div class="content content-daftar-pesanan container step-pembayaran">
  <div class="row pt-4">
    <div class="col text-center">
      <h6>DAFTAR PESANAN</h6>
    </div>
  </div>
  <?php if (empty($dataPesanan)) : ?>
    <div class="card my-bg-pinklight border border-black mt-5 InfoDaftarPesanan" style="display: block;">
      <div class="card-body text-center">
        <span class="fs-5">Daftar Pesanan Masih Kosong</span>
        <br>
        <a class="btn btn-link my-text-purpledark" href="/" role="button">Pesan Dulu Yuk!</a>
      </div>
    </div>
  <?php else : ?>
    <div class="mt-3 dataPesanan">
      <input type="hidden" name="totalHarga" value="<?php echo $totalHarga["total_harga"]; ?>">
      <ul class="list-group list-daftar-pesanan rounded-0">
        <?php foreach ($dataPesanan as $index => $data) : ?>
          <?php if ($data["id_pack"] == "1") : ?> <!-- family -->
            <li class="list-group-item lh-1 p-0">
              <input hidden name="idDetailMenuPesanan" value="<?php echo $data['id_detail_menu_pesanan']; ?>">
              <input hidden name="namaPack" value="<?php echo $data['nama_pack']; ?>">
              <input type="hidden" name="pack" value="<?php echo $data["id_pack"]; ?>">
              <div class="row d-flex flex-nowrap m-0">
                <div class="col my-2">
                  <div class="row d-flex flex-nowrap align-items-center">
                    <div class="col-3"><?php echo formatTanggal($data['tanggal_menu']); ?></div>
                    <div class="col">
                      <p class="my-0"><?php echo $data['nama_menu']; ?><br><span class="fw-bold">Rp. <span class="hargaMenu"><?php echo $data['harga_menu']; ?></span></span></p>
                    </div>
                    <div class="col-auto d-flex flex-nowrap align-items-center">
                      <span class="mx-1">Qty</span>
                      <input class="form-control form-control-sm my-border-input bg-light border border-0 mx-1 px-1 py-0 qtyMenu" style="width: 6ch;" type="number" name="textQtyMenu" value="<?php echo $data['qty_menu']; ?>">
                      <div class="my-form-checkbox">
                        <input class="form-check-input my-border-input my-0 mx-1" type="checkbox" name="cbkPedas" <?php echo ($data['keterangan_pedas'] == "p") ? "checked" : ""; ?>>
                        <label class="form-check-label mx-1" for="cbPedas">Pedas</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-auto p-0"><button class="btn rounded-0 btnHapusList">HAPUS</button></div>
              </div>
            </li>
          <?php else : ?> <!-- personal -->
            <li class="list-group-item lh-1 p-0">
              <input hidden name="idDetailMenuPesanan" value="<?php echo $data['id_detail_menu_pesanan']; ?>">
              <input hidden name="namaPack" value="<?php echo $data['nama_pack']; ?>">
              <input type="hidden" name="pack" value="<?php echo $data["id_pack"]; ?>">
              <div class="row d-flex flex-nowrap m-0">
                <div class="col my-2">
                  <div class="row d-flex flex-nowrap align-items-center">
                    <div class="col-3"><?php echo formatTanggal($data['tanggal_menu']); ?></div>
                    <div class="col">
                      <div class="row d-flex flex-nowrap">
                        <div class="col">
                          <p class="my-0"><?php echo ($data['nama_menu'] != NULL) ? $data['nama_menu'] : "Infuse"; ?><br><span class="fw-bold"><?php echo $data['nama_paket_menu']; ?> Rp. <span class="hargaMenu"><?php echo ($data['nama_menu'] != NULL) ? $data['harga_paket_menu'] : $dataPaketMenu['harga_paket_menu']; ?></span></span></p>
                        </div>
                        <div class="col-auto d-flex flex-nowrap align-items-center">
                          <span class="mx-1">Qty</span>
                          <input class="form-control form-control-sm my-border-input bg-light border border-0 mx-1 px-1 py-0 qtyMenu" oninput="validity.valid||(value='');" style="width: 6ch;" min="1" type="number" name="textQtyMenu" value="<?php echo ($data['nama_menu'] != NULL) ? $data['qty_menu'] : $data['qty_infuse']; ?>">
                        </div>
                      </div>
                      <?php if ($data['nama_menu'] != NULL) : ?>
                        <div class="mt-2 d-flex gap-2">
                          <?php if ($data['nama_paket_menu'] == "lunch") : ?>
                            <select class="form-select form-select-sm my-border-input w-auto" style="height:fit-content;" id="selectKarbo" name="selectKarbo" required>
                              <option selected disabled value="">Pilih Karbo</option>
                              <?php foreach ($dataKarbo as $dataK) : ?>
                                <option <?php echo ($dataK['id_karbo'] == $data['id_karbo']) ? "selected" : ""; ?> value="<?php echo $dataK['id_karbo']; ?>"><?php echo $dataK['nama_karbo']; ?></option>
                              <?php endforeach; ?>
                            </select>
                          <?php endif; ?>
                          <input type="text" class="form-control form-control-sm my-border-input w-50" id="txtPantangan" name="txtPantangan" placeholder="Masukkan Pantangan" value="<?php echo $data['pantangan_pesanan']; ?>" required>
                          </input>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <div class="col-auto p-0"><button class="btn rounded-0 btnHapusList">HAPUS</button></div>
              </div>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
      <div class="mx-auto" style="max-width: 17em;">
        <ul class="list-group rounded-0">
          <li class="list-group-item fw-bold border border-top-0 border-black">
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
                <select class="form-select form-select-sm my-border-input" id="selectKota" name="selectKota">
                  <option selected disabled value="">Pilih Kota</option>
                  <?php foreach ($dataOngkir as $data) : ?>
                    <option value="<?php echo $data["id_ongkir"]; ?>" data-hargaOngkir="<?php echo $data["biaya_ongkir"]; ?>"><?php echo $data["ongkir_kota"]; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="d-flex justify-content-between gap-3">
              <label for="exampleFormControlInput1" class="form-label m-0">Alamat</label>
              <div>
                <input type="text" class="form-control form-control-sm my-border-input" id="txtAlamat" name="txtAlamat" required>
              </div>
            </div>
          </li>
          <li class="list-group-item fw-bold border border-top-0 border-black">
            <div class="row">
              <div class="col d-flex justify-content-between">
                <span>HARGA</span>
                <span class="totalHargaMenu">Rp. <?php echo $totalHarga["total_harga"]; ?></span>
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
          </li>
        </ul>
        <button type="button" class="btn btn-sm my-btn-orange my-border-btn rounded-pill mt-3 mb-3 w-100 fw-medium btnLanjutBayar">Lanjut Pembayaran</button>
      </div>
    </div>
    <div class="my-collapse mb-5 dataPembayaran" id="collapsePembayaran">
      <hr>
      <div class="mx-auto" style="max-width: 17em;">
        <div class="card list-pembayaran border border-0">
          <div class="card-header my-bg-purple border border-black rounded-1 text-center">
            PEMBAYARAN
          </div>
          <ul class="list-group">
            <li class="list-group-item border border-black mt-1">
              <div class="row">
                <div class="col">
                  <img src="/mandiri.png" alt="" style="width: 30%;">
                  <span class="d-inline-block mx-2">1234524534634</span>
                </div>
                <div class="col-1 align-self-end d-flex justify-content-center align-items-center text-center"><span><i class="bi bi-copy"></i></span></div>
              </div>
            </li>
            <li class="list-group-item border border-black mt-1">
              <div class="row">
                <div class="col">
                  <img src="/gopay.png" alt="" style="width: 30%;">
                  <span class="d-inline-block mx-2">1234524534634</span>
                </div>
                <div class="col-1 align-self-end d-flex justify-content-center align-items-center text-center"><span><i class="bi bi-copy"></i></span></div>
              </div>
            </li>
          </ul>
          <div class="d-flex justify-content-center flex-column text-center">
            <div class="mt-3 lh-1 mx-auto">
              <label for="txtGambar" class="form-label">Upload Bukti Transfer</label><br>
              <input type="file" style="color: transparent; width: 90px;" class="my-file-input mx-auto" id="fileGambar" name="fileGambar" required>
            </div>
            <div class="mt-3 lh-1 mx-auto" style="width: 10em;">
              <label for="txtNominal" class="form-label">Nominal</label>
              <input type="number" class="form-control form-control-sm my-border-input" oninput="validity.valid||(value='');" min="1" id="txtNominal" name="txtNominal" required>
            </div>
            <div class="mt-3 lh-1 mx-auto" style="width: 10em;">
              <label for="txtAtasNama" class="form-label">Atas Nama</label>
              <input type="text" class="form-control form-control-sm my-border-input" id="txtAtasNama" name="txtAtasNama" required>
            </div>
            <button type="button" class="btn btn-sm my-btn-orange my-border-btn rounded-pill mt-4 w-50 mx-auto fw-medium" id="btnBayarPesananan">Bayar</button>
            <button type="button" class="btn btn-sm btn-light my-border-btn rounded-pill mt-1 w-50 mx-auto fw-medium btnBatalBayarPesananan">Batal</button>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>
<?php echo $this->endSection(); ?>