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
              <li class="list-group-item pb-4">
                <div class="row">
                  <div class="col">
                    <p class="lh-1 mb-1">
                      <span class="fw-medium">Pelanggan: </span><?php echo $data['nama_pelanggan']; ?> (<?php echo $data['notelp_pelanggan']; ?>)
                    </p>
                    <p class="lh-1 m-0">Alamat: <span><?php echo $data['ongkir_kota']; ?> - <?php echo $data['alamat_pengiriman']; ?></span></p>
                    <table class="table table-sm my-full-border table-hover mt-1">
                      <thead>
                        <tr class="align-middle">
                          <td class="text-center" scope="col">Menu</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($dataPesananPelanggan as $detail) : ?>
                          <?php if ($detail['id_pesanan'] == $data['id_pesanan']) : ?>
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
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>