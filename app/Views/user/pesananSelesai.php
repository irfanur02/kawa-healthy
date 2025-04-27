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
          <?php foreach ($dataPesananUser as $index => $data) : ?>
            <tr class="text-center align-middle">
              <td><?php echo formatTanggal($data['tanggal_transaksi'], false, false, true); ?></td>
              <td><?php echo formatTanggal($data['tanggal_menu']); ?></td>
              <td><?php echo formatRupiah($data['total_harga'] + $data['biaya_ongkir']); ?></td>
              <td>
                <a class="btn btn-sm my-btn-tosca my-border-btn rounded-pill fw-medium lh-1" href="/pesananDetailBiasa/selesai/<?php echo $data['id_pesanan']; ?>/<?php echo $data['id_jadwal_menu']; ?>" role="button">Detail</a>
                <?php if (empty($data['keterangan_review'])) : ?>
                  <button type="button" data-indexBaris="<?php echo $index + 1; ?>" data-idPesanan="<?php echo $data['id_pesanan']; ?>" data-idMenuPesanan="<?php echo $data['id_menu_pesanan']; ?>" class="btn btn-sm my-btn-orange my-border-btn rounded-pill fw-medium lh-1 btnReview" data-bs-toggle="modal" data-bs-target="#modalReview">
                    Review
                  </button>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Review-->
<div class="modal fade modal-sm" id="modalReview" tabindex="-1" aria-labelledby="modalReviewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border border-dark">
      <div class="modal-header justify-content-center my-bg-green">
        <h1 class="modal-title fs-5" id="modalReviewLabel">Review</h1>
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
                <button type="button" class="btn btn-sm my-btn-green my-border-btn rounded-pill px-4" id="modalBtnReview">Kirim</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php echo $this->endSection(); ?>