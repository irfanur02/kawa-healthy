<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content content-dashboard fw-medium">
    <div class="mt-4">
      <div class="row">
        <div class="col text-center">Dashboard</div>
      </div>
      <div class="row">
        <div class="col text-center mt-3">Pesanan Siap Kirim</div>
        <div class="container">
          <div class="d-flex justify-content-center mt-1">
            <ul class="list-group border list-pesanan">
              <?php foreach ($dataPelangganPemesanan as $data) : ?>
                <?php if (empty($data['jumlah_tunda'])) : ?>
                  <li class="list-group-item">
                    <div class="row">
                      <div class="col">
                        <div class="row d-flex justify-content-between">
                          <p class="col-auto my-0 text-center align-top"><span class="fw-bold">Pelanggan</span><br><?php echo $data['nama_pelanggan']; ?><br> (<?php echo $data['notelp_pelanggan']; ?>)</p>
                          <p class="col my-0 align-top"><span class="fw-bold">Alamat<br></span><?php echo $data['alamat_pengiriman']; ?> <?php echo $data['ongkir_kota']; ?></p>
                        </div>
                        <table class="table table-sm my-full-border table-hover mt-3">
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
                <?php endif; ?>
              <?php endforeach; ?>
            </ul>
          </div>
          <?php if (!empty($dataPelangganPemesanan)) : ?>
            <?php if (empty($data['jumlah_tunda'])) : ?>
              <div class="mx-auto" style="width:fit-content;">
                <button class="btn btn-success rounded-pill my-border-btn mt-3 mx-auto lh-md" data-tanggalMenu="<?php echo $tanggalMenu; ?>" style="padding: .1em 2em;" id="btnKirimPesanan">Ok, Kirim</button>
              </div>
            <?php endif; ?>
          <?php else : ?>
            <div class="card bg-success-subtle border border-black mt-5 mx-auto" style="width: max-content;">
              <div class="card-body text-center">
                <span class="fs-6">
                  Pesanan Sudah Dikirim<br>
                  Menunggu Pesanan Selanjutnya
                </span>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>