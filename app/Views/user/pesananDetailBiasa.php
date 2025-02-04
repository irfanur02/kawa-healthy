<?php

use function PHPUnit\Framework\isEmpty;

echo $this->extend('layout/user/template'); ?>

<?php echo $this->section('content'); ?>

<?php echo $this->include('layout/user/navbar.php'); ?>

<div class="content content-detail-pesanan-b container">
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
  <div class="mt-5 mb-5">
    <ul class="list-group data-pesanan mx-auto">
      <li class="list-group-item boder border-0 border-top border-bottom border-black rounded-0 lh-sm p-1">
        <div class="row">
          <div class="col-md-5">
            <p><span class="fw-bold">Harga: </span>Rp. <?php echo $dataTransaksi['total_semua_harga']; ?>(+ongkir)</p>
          </div>
          <div class="col-auto">
            <p><span class="fw-bold">Tanggal Transaksi: </span><?php echo formatTanggal($dataTransaksi['tanggal_transaksi'], false, false, true); ?></p>
          </div>
        </div>
      </li>
    </ul>
    <ul class="list-group list-pesanan border border-black mt-3 mx-auto">
      <li class="list-group-item text-center">Jadwal</li>
      <li class="list-group-item">
        <div class="row flex-wrap align-items-center">
          <div class="col-auto"><?php echo formatTanggal($dataTransaksi['tanggal_menu']); ?></div>
          <div class="col">
            <table class="table table-sm mb-0">
              <thead>
                <tr>
                  <td class="text-center fw-medium">Menu</td>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($dataPesanan as $data) : ?>
                  <?php if ($data['id_pack'] == 1) : ?>
                    <tr>
                      <td>
                        <div class="row align-items-center lh-sm">
                          <div class="col-9"><?php echo $data['nama_menu']; ?><br>Rp. <?php echo $data['harga_menu']; ?></div>
                          <div class="col-3 text-end"><span class="badge text-bg-light border border-black"><?php echo $data['qty_menu']; ?></span> <?php echo !empty($data['keterangan_pedas']) ? ($data['keterangan_pedas'] == "p" ? "pedas" : "") : ""; ?></div>
                        </div>
                      </td>
                    </tr>
                  <?php else : ?>
                    <tr>
                      <td>
                        <div class="row align-items-center lh-sm">
                          <?php if ($data['qty_infuse'] == NULL) : ?>
                            <div class="col-9"><?php echo $data['nama_menu']; ?><br><?php echo $data['nama_paket_menu']; ?> Rp. <?php echo $data['harga_paket_menu']; ?><br>Karbo: <?php echo $data['nama_karbo']; ?> | Pantangan: <?php echo ($data['pantangan_pesanan'] != NULL) ? $data['pantangan_pesanan'] : "-"; ?></div>
                            <div class="col-3 text-end"><span class="badge text-bg-light border border-black"><?php echo $data['qty_menu']; ?></span></div>
                          <?php else : ?>
                            <div class="col-9"><?php echo $dataPaketMenu['nama_paket_menu']; ?><br>Rp. <?php echo $dataPaketMenu['harga_paket_menu']; ?></div>
                            <div class="col-3 text-end"><span class="badge text-bg-light border border-black"><?php echo $data['qty_infuse']; ?></span></div>
                          <?php endif; ?>
                        </div>
                      </td>
                    </tr>
                  <?php endif; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
            <?php if ($tabPesananKu == "pesananSelesai") : ?>
              <?php if (!empty($dataReview)) : ?>
                <hr class="mt-2 mb-2">
                <p class="m-0 text-decoration-underline">Review</p>
                <p class="m-0"><?php echo $dataReview['keterangan_review']; ?></p>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
      </li>
    </ul>
  </div>
</div>

<?php echo $this->endSection(); ?>