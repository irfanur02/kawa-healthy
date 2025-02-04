<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content content-pesanan fw-medium">
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
        <table class="table my-table-admin table-hover mt-3" id="tabelPembayaran">
          <thead>
            <tr class="align-middle">
              <td class="text-center" scope="col">Tanggal Transaksi</td>
              <td class="text-center" scope="col">Pelanggan</td>
              <td class="text-center" scope="col">Total Harga</td>
              <td class="text-center" scope="col">Aksi</td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dataAllPesananUser as $index => $data) : ?>
              <tr class="align-middle">
                <td class="text-center">
                  <?php echo formatTanggal($data['tanggal_transaksi'], false, false, true); ?>
                </td>
                <td class="text-center">
                  <?php echo $data['nama_pelanggan']; ?><br>
                  <?php if (!empty($data['id_catatan_pesanan'])) : ?>
                    <span class="fw-normal">Paketan</span>
                  <?php endif; ?>
                </td>
                <td class="text-center">
                  <?php if (empty($data['id_catatan_pesanan'])) : ?>
                    Rp. <?php echo $data['total_harga'] + ($data['jumlah_hari'] * $data['biaya_ongkir']); ?>
                  <?php else : ?>
                    Rp. <?php echo $data['total_harga_paketan_keseluruhan']; ?>
                  <?php endif; ?>
                </td>
                <td>
                  <div class="d-flex flex-column gap-1 text-center">
                    <button type="button" data-idPesanan="<?php echo $data['id_pesanan']; ?>" class="btn btn-sm btn-primary rounded-pill my-border-btn btnLihatGambar" data-bs-toggle="modal" data-bs-target="#modalLihatGambar">Lihat Bukti Transfer</button>
                    <?php if (empty($data['approved'])) : ?>
                      <?php if (empty($data['batal'])) : ?>
                        <button type="button" data-idPesanan="<?php echo $data['id_pesanan']; ?>" class="btn btn-sm btn-success rounded-pill my-border-btn btnApprove">Approve</button>
                        <button type="button" data-indexBaris="<?php echo $index + 1; ?>" data-idPesanan="<?php echo $data['id_pesanan']; ?>" class="btn btn-sm btn-danger rounded-pill my-border-btn btnTolakPesanan" data-bs-toggle="modal" data-bs-target="#modalTolakPesanan">Tolak Pesanan</button>
                      <?php else : ?>
                        Dibatalkan Pelanggan
                      <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($data['approved'] == 'n') : ?>
                      Pesanan Ditolak
                    <?php endif; ?>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Tolak Pesanan -->
  <div class="modal fade modal-sm" id="modalTolakPesanan" tabindex="-1" aria-labelledby="modalTolakPesananLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border border-dark">
        <div class="modal-header justify-content-center" style=" background-color: #055160; color: white;">
          <h1 class="modal-title fs-5" id="modalTolakPesananLabel">Konfirmasi</h1>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col text-center">
              <span>Apakah Anda Yakin ?</span>
              <div class="row mt-4">
                <div class="col d-grid">
                  <button type="button" class="btn btn-danger my-border-btn rounded-pill" id="modalBtnTolak">iya</button>
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
          <img src="" class="border rounded" alt="..." style="width: 13em">
          <div class="card">
            <div class="card-body">
              <p class="m-0 lh-1">Nama Penransfer: <span class="nama"></span></p>
              <p class="m-0 lh-1">Nominal: Rp. <span class="nominal"></span></p>
            </div>
          </div>
        </div>
        <div class="container mb-3 text-center">
          <button type="button" class="btn btn-light my-border-btn rounded-pill" style="padding: 0 3em 0 3em;" data-bs-dismiss="modal">tutup</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>