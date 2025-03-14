<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content content-detail-pesanan fw-medium">
    <div class="mt-4">
      <div class="row">
        <div class="col text-center">Data Pesanan</div>
      </div>
      <div class="row mt-3">
        <div class="col text-center d-flex justify-content-center">
          <ul class="list-group list-group-horizontal">
            <a href="/dadmin/pesananPembayaran" class="list-group-item border border-0 list-group-item-action <?php echo $tabPesanan == "pesananPembayaran" ? "my-active" : ""; ?>" style="width: max-content;">
              Pembayaran
            </a>
            <a href="/dadmin/pesananMasuk" class="list-group-item border border-0 list-group-item-action <?php echo $tabPesanan == "pesananMasuk" ? "my-active" : ""; ?>" style="width: max-content;">
              Pesanan Masuk
            </a>
            <a href="/dadmin/pesananBatal" class="list-group-item border border-0 list-group-item-action <?php echo $tabPesanan == "pesananBatal" ? "my-active" : ""; ?>" style="width: max-content;">
              Pesanan Batal
            </a>
            <a href="/dadmin/pesananRiwayat" class="list-group-item border border-0 list-group-item-action <?php echo $tabPesanan == "pesananRiwayat" ? "my-active" : ""; ?>" style="width: max-content;">
              Riwayat Pesanan
            </a>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col text-center mt-3 fw-bold">Pesanan Menu Tanggal <br> <?php echo formatTanggal($tanggalMenu); ?></div>
        <div class="container d-flex justify-content-center m-1">
          <ul class="list-group border list-pesanan">
            <?php foreach ($dataPelangganPemesanan as $data) : ?>
              <li class="list-group-item">
                <div class="row">
                  <div class="col">
                    <p class="lh-1 mb-1">
                      <span class="fw-medium">Pelanggan: </span><?php echo $data['nama_pelanggan']; ?> (<?php echo $data['notelp_pelanggan']; ?>)
                    </p>
                    <p class="lh-1 m-0">Alamat:</p>
                    <span><?php echo $data['ongkir_kota']; ?> - <?php echo $data['alamat_pengiriman']; ?></span>
                    <table class="table table-sm my-full-border table-hover mt-1">
                      <thead>
                        <tr class="align-middle">
                          <td class="text-center" scope="col">Menu</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($dataPesananPelanggan as $detail) : ?>
                          <?php if ($detail['nama_pelanggan'] == $data['nama_pelanggan']) : ?>
                            <?php if (empty($detail['jumlah_tunda'])) : ?>
                              <tr>
                                <td class="fw-normal d-flex align-items-center grid gap-2">
                                  <?php if ($detail['nama_pack'] == "family") : ?>
                                    <div class="lh-1 d-inline-flex flex-column"><?php echo $detail['nama_menu']; ?><br><span class="fw-medium"><?php echo (!empty($detail['keterangan_pedas']) ? "Pedas" : ""); ?></span></div>
                                    <div>
                                      <span class="badge text-bg-warning rounded-pill border border-black"><?php echo $detail['qty_menu']; ?></span>
                                    </div>
                                  <?php else : ?>
                                    <?php if (empty($detail['qty_infuse'])) : ?>
                                      <div class="lh-1 d-inline-flex flex-column fw-normal">
                                        <span class="fw-medium">Paket <?php echo $detail['nama_paket_menu']; ?></span>
                                        <?php echo $detail['nama_menu']; ?><br>
                                        <span class="fw-medium">Karbo: <?php echo $detail['nama_karbo']; ?></span>
                                        <span class="fw-medium">Pantangan: <?php echo (!empty($detail['pantangan_pesanan']) ? $detail['pantangan_pesanan'] : "-"); ?></span>
                                      </div>
                                      <div>
                                        <span class="badge text-bg-warning rounded-pill border border-black"><?php echo $detail['qty_menu']; ?></span>
                                      </div>
                                    <?php else : ?>
                                      <div>
                                        <span class="fw-medium">Infuse</span>
                                        <span class="badge text-bg-warning rounded-pill border border-black"><?php echo $detail['qty_infuse']; ?></span>
                                      </div>
                                    <?php endif; ?>
                                  <?php endif; ?>
                                </td>
                              </tr>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
          <!-- <ul class="list-group border list-pesanan">
            <li class="list-group-item">
              <div class="row">
                <div class="col-auto">
                  <p class="lh-1 mb-1"><span class="fw-bold">Pelanggan: </span>Agus (08123456789)</p>
                  <p class="lh-1 m-0"><span class="fw-medium text-decoration-underline">Pesanan Paketan</span></p>
                  <p class="lh-1 m-0"><span class="fw-normal">Masa Hari: 10</span></p>
                  <p class="lh-1 m-0"><span class="fw-normal">Paket Menu: Lunch + Infuse</span></p>
                  <p class="lh-1 m-0"><span class="fw-medium">Total Harga Paketan: Rp. 500000</span></p>
                  <table class="table table-sm my-full-border table-hover mt-3">
                    <thead>
                      <tr class="align-middle">
                        <td class="text-center" scope="col">Menu</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="fw-normal d-flex align-items-center grid gap-2">
                          <div class="lh-1 d-inline-flex flex-column">Bayam Wortel<br><span class="fw-medium">Pedas</span></div>
                          <div>
                            <span class="badge text-bg-warning rounded-pill border border-black">2</span>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="fw-normal d-flex align-items-center grid gap-2">
                          <div class="lh-sm d-inline-flex flex-column">Kangkung</div>
                          <div>
                            <span class="badge text-bg-warning rounded-pill border border-black">2</span>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="fw-medium d-flex align-items-center grid gap-2">
                          <div class="lh-1 d-inline-flex flex-column fw-normal">
                            <span class="fw-medium">Paket Lunch</span>
                            nasi merah ayam bakar suwir<br>
                            <span class="fw-medium">Karbo: Nasi Merah</span>
                            <span class="fw-medium">Pantangan: -</span>
                          </div>
                          <div>
                            <span class="badge text-bg-warning rounded-pill border border-black">2</span>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col d-flex flex-column d-flex align-items-center my-auto">
                  <div class="d-grid gap-1 mt-3">
                    <button type="button" class="btn btn-sm btn-primary rounded-pill my-border-btn" data-bs-toggle="modal" data-bs-target="#modalLihatGambar">Lihat Bukti Transfer</button>
                    <button type="button" class="btn btn-sm btn-success rounded-pill my-border-btn">Approve</button>
                    <button type="button" class="btn btn-sm btn-danger rounded-pill my-border-btn btnHapusPesanan" data-bs-toggle="modal" data-bs-target="#modalHapusPesanan">Hapus Pesanan</button>
                  </div>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <div class="col-auto">
                  <p><span class="fw-bold">Pelanggan: </span>Agus( 08123456789 )</p>
                  <table class="table table-sm my-full-border table-hover mt-3">
                    <thead>
                      <tr class="align-middle">
                        <td class="text-center" scope="col">Menu</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="fw-normal d-flex align-items-center grid gap-2">
                          <div class="lh-1 d-inline-flex flex-column">Kangkung<br><span class="fw-medium">Pedas</span></div>
                          <div>
                            <span class="badge text-bg-warning rounded-pill border border-black">2</span>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="fw-normal d-flex align-items-center grid gap-2">
                          <div class="lh-sm d-inline-flex flex-column">Kangkung</div>
                          <div>
                            <span class="badge text-bg-warning rounded-pill border border-black">2</span>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="fw-medium d-flex align-items-center grid gap-2">
                          <div class="lh-1 d-inline-flex flex-column fw-normal">
                            <span class="fw-medium">Paket Lunch</span>
                            nasi merah ayam bakar suwir<br>
                            <span class="fw-medium">Karbo: Nasi Merah</span>
                            <span class="fw-medium">Pantangan: -</span>
                          </div>
                          <div>
                            <span class="badge text-bg-warning rounded-pill border border-black">2</span>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col d-flex flex-column d-flex align-items-center my-auto">
                  <span class="fw-bold text-center">Total Harga<br>Rp. 150000<br>(+ongkir)</span>
                  <div class="d-grid gap-1 mt-3">
                    <button type="button" class="btn btn-sm btn-primary rounded-pill my-border-btn" data-bs-toggle="modal" data-bs-target="#modalLihatGambar">Lihat Bukti Transfer</button>
                    <button type="button" class="btn btn-sm btn-success rounded-pill my-border-btn">Approve</button>
                    <button type="button" class="btn btn-sm btn-danger rounded-pill my-border-btn btnHapusPesanan" data-bs-toggle="modal" data-bs-target="#modalHapusPesanan">Hapus Pesanan</button>
                  </div>
                </div>
              </div>
            </li>
          </ul> -->
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Hapus Pesanan -->
  <div class="modal fade modal-sm" id="modalHapusPesanan" tabindex="-1" aria-labelledby="modalHapusPesananLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border border-dark">
        <div class="modal-header justify-content-center" style=" background-color: #055160; color: white;">
          <h1 class="modal-title fs-5" id="modalHapusPesananLabel">Konfirmasi</h1>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col text-center">
              <span>Apakah Anda Yakin ?</span>
              <div class="row mt-4">
                <div class="col d-grid">
                  <button type="button" class="btn btn-danger my-border-btn rounded-pill">iya</button>
                </div>
                <div class="col d-grid">
                  <button type="button" class="btn btn-light my-border-btn rounded-pill" data-bs-dismiss="modal">tidak</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- modal lihat gambar -->
  <div class="modal fade modal-md" id="modalLihatGambar" tabindex="-1" aria-labelledby="modalLihatGambarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border border-dark">
        <div class="modal-header justify-content-center" style=" background-color: #055160; color: white;">
          <h1 class="modal-title fs-5" id="modalLihatGambarLabel">Konfirmasi</h1>
        </div>
        <div class="modal-body text-center">
          <img src="logo-big.jpg" class="border rounded" alt="..." style="width: 100%">
        </div>
        <div class="container mb-3 text-center">
          <button type="button" class="btn btn-light my-border-btn rounded-pill" style="padding: 0 3em 0 3em;" data-bs-dismiss="modal">tutup</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>