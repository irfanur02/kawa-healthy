<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content content-batal-pesanan fw-medium">
    <div class="mt-4">
      <div class="row">
        <div class="col text-center">Data Pesanan</div>
      </div>
      <div class="row mt-3">
        <div class="col text-center d-flex justify-content-center">
          <ul class="list-group list-group-horizontal">
            <a href="/dadmin/pesanan" class="list-group-item border border-0 list-group-item-action <?php echo $tabPesanan == "pesananMasuk" ? "my-active" : ""; ?>" style="width: max-content;">
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
      <div class="table-responsive m-4">
        <table class="table my-table-admin table-hover mt-3">
          <thead>
            <tr class="align-middle">
              <td class="text-center" scope="col">Pelanggan</td>
              <td class="text-center" scope="col">Total Harga Pesanan Pelanggan</td>
              <td class="text-center" scope="col">Aksi</td>
            </tr>
          </thead>
          <tbody>
            <tr class="align-middle text-center">
              <td>Yudi</td>
              <td>Rp. 150000</td>
              <td>
                <button type="button" class="btn btn-sm btn-warning rounded-pill my-border-btn" data-bs-toggle="modal"
                  data-bs-target="#modalKonfirmasiRefund">Balikkan Uang</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- Modal Konfirmasi Refund -->
<div class="modal fade modal-sm" id="modalKonfirmasiRefund" tabindex="-1" aria-labelledby="modalKonfirmasiRefundLabel"
aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border border-dark">
      <div class="modal-header justify-content-center" style=" background-color: #055160; color: white;">
        <h1 class="modal-title fs-5" id="modalKonfirmasiRefundLabel">Konfirmasi</h1>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col text-center">
            <span>Apakah Anda Yakin ?</span>
            <div class="row mt-4">
              <div class="col d-grid">
                <a class="btn btn-sm btn-danger rounded-pill my-border-btn fs-6" href="https://wa.me/6281615167427" role="button" target="_blank">iya</a>
              </div>
              <div class="col d-grid">
                <button type="button" class="btn btn-light my-border-btn rounded-pill"
                  data-bs-dismiss="modal">tidak</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>