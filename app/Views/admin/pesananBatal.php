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
      <div class="table-responsive m-4">
        <table class="table my-table-admin table-hover mt-3" id="tabelPesananBatal">
          <thead>
            <tr class="align-middle">
              <td class="text-center" scope="col">Pelanggan</td>
              <td class="text-center" scope="col">Total Harga Pesanan Pelanggan</td>
              <td class="text-center" scope="col">Aksi</td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($getAllPaketanPesananGantiMasa as $index => $data) : ?>
              <tr class="align-middle text-center">
                <td><?php echo $data['nama_pelanggan']; ?></td>
                <td>
                  <p class="fw-normal m-0 lh-1 text-decoration-underline">Ganti Masa Hari</p>
                  <p class="fw-light m-0 lh-1"><?php echo $data['masa_hari']; ?> Hari Jadwal Menu Batal</p>
                  <?php echo formatRupiah($data['total_harga'] + $data['total_ongkir']); ?>
                </td>
                <td>
                  <?php if (empty($data['uang_dikembalikan'])) : ?>
                    <button type="button" class="btn btn-sm btn-warning rounded-pill my-border-btn btnKembalikanUang gantiMasaHari" data-idMasaHariBatal="<?php echo $data['id_masa_hari_batal']; ?>" data-indexBaris="<?php echo $index + 1; ?>" data-nohp="<?php echo $data['notelp_pelanggan']; ?>" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiRefund">Balikkan Uang</button>
                  <?php else : ?>
                    Sudah Dikembalikan
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
            <?php foreach ($dataAllPaketanPesananBerhenti as $index => $data) : ?>
              <tr class="align-middle text-center">
                <td><?php echo $data['nama_pelanggan']; ?></td>
                <td>
                  <p class="fw-normal m-0 lh-1 text-decoration-underline">Berhenti Paketan</p>
                  <p class="fw-light m-0 lh-1"><?php echo $data['jumlah_hari']; ?> Hari Jadwal Menu Batal</p>
                  <?php echo formatRupiah($data['total_harga_keseluruhan']); ?>
                </td>
                <td>
                  <?php if ($data['id_status_pesanan'] != 9) : ?>
                    <button type="button" class="btn btn-sm btn-warning rounded-pill my-border-btn btnKembalikanUang berhentiPaketan" data-idPesanan="<?php echo $data['id_pesanan']; ?>" data-indexBaris="<?php echo $index + 1; ?>" data-nohp="<?php echo $data['notelp_pelanggan']; ?>" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiRefund">Balikkan Uang</button>
                  <?php else : ?>
                    Sudah Dikembalikan
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
            <?php foreach ($dataAllPesananBatal as $index => $data) : ?>
              <tr class="align-middle text-center">
                <td><?php echo $data['nama_pelanggan']; ?></td>
                <td>
                  <p class="fw-normal m-0 lh-1">Batal Menu Pesanan</p>
                  <?php echo formatRupiah($data['total_harga'] + $data['biaya_ongkir']); ?>
                </td>
                <td>
                  <?php if ($data['id_status_pesanan'] != 4) : ?>
                    <button type="button" class="btn btn-sm btn-warning rounded-pill my-border-btn btnKembalikanUang batalMenuPesanan" data-idMenuPesanan="<?php echo $data['id_menu_pesanan']; ?>" data-indexBaris="<?php echo $index + 1; ?>" data-nohp="<?php echo $data['notelp_pelanggan']; ?>" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiRefund">Balikkan Uang</button>
                  <?php else : ?>
                    Sudah Dikembalikan
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- Modal Konfirmasi Refund -->
<div class="modal fade modal-sm" id="modalKonfirmasiRefund" tabindex="-1" aria-labelledby="modalKonfirmasiRefundLabel" aria-hidden="true">
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
                <button class="btn btn-sm btn-danger rounded-pill my-border-btn fs-6" id="modalBtnKembalikanUang">iya</button>
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
<?php echo $this->endSection(); ?>