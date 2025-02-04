<?php echo $this->extend('layout/user/template'); ?>

<?php echo $this->section('content'); ?>

<?php echo $this->include('layout/user/navbar.php'); ?>

<div class="content content-pesanan-datang container">
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
      <?php if (!empty($dataPesanan)) : ?>
        <button type="button" class="btn btn-sm my-btn-orange px-3 my-border-btn rounded-pill fs-6 lh-sm" id="btnTerima">Terima</button>
      <?php endif; ?>
    </div>
    <div class="d-flex justify-content-center">
      <?php if (empty($dataPesanan)) : ?>
        <div class="card bg-success-subtle border border-black mt-5 mx-auto" style="width: max-content;">
          <div class="card-body text-center">
            <span class="fs-6">Pesananmu Akan Dikirim Sesuai Jadwal</span>
          </div>
        </div>
      <?php else : ?>
        <ul class="list-group mt-3 w-50">
          <?php foreach ($dataPesanan as $data) : ?>
            <?php if (empty($data['jumlah_tunda'])) : ?>
              <li class="list-group-item boder border-black">
                <div class="row align-items-center lh-sm">
                  <?php if ($data['nama_pack'] == "family") : ?>
                    <div class="col-9"><?php echo $data['nama_menu']; ?><br>Rp. <?php echo $data['harga_menu']; ?></div>
                    <div class="col-3 text-end">Qty <span class="badge text-bg-light border border-black"><?php echo $data['qty_menu']; ?></span> <?php echo ($data['keterangan_pedas'] == "p") ? "Pedas" : ""; ?></div>
                  <?php else : ?>
                    <?php if (!empty($data['nama_menu'])) : ?>
                      <div class="col-9">
                        <?php echo $data['nama_menu']; ?><br>
                        <?php echo $data['nama_paket_menu']; ?> Rp. <?php echo $data['harga_paket_menu']; ?><br>
                        Karbo <?php echo (!empty($data['nama_karbo']) ? $data['nama_karbo'] : "-"); ?> | Pantangan <?php echo (!empty($data['pantangan_pesanan']) ? $data['pantangan_pesanan'] : "-"); ?>
                      </div>
                      <div class="col-3 text-end">Qty <span class="badge text-bg-light border border-black"><?php echo $data['qty_menu']; ?></span></div>
                    <?php else : ?>
                      <div class="col-9">
                        Infuse
                      </div>
                      <div class="col-3 text-end">Qty <span class="badge text-bg-light border border-black"><?php echo $data['qty_infuse']; ?></span></div>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
              </li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php echo $this->endSection(); ?>