<div class="flex-row">
  <div class="row mb-2 mt-2">
    <div class="col text-center fw-bold">
      <span>
        <button type="button" class="btn btn-sm btn-link text-black" id="btnLihatPelanggan">Lihat Pelanggan</button>
      </span>
      <div class="d-flex justify-content-between">
        <div class="text-start">
          <span class="d-block">Pelanggan</span>
          <span class="d-block fw-medium">Nama: <?php echo $dataPelanggan['nama_pelanggan']; ?></span>
        </div>
        <div class="text-end">
          <span class="d-block">Total Pembelian</span>
          <span class="d-block fw-medium"><?php echo formatRupiah($dataTotalPembelianPelanggan['total_keseluruhan']); ?></span>
        </div>
      </div>
    </div>
  </div>
  <table class="table my-table-admin table-hover text-center" style="width: fit-content;">
    <thead>
      <tr class="align-middle">
        <td scope="col" style="padding: .5em 30px .5em 30px;">Periode</td>
        <td scope="col" style="padding: .5em 30px .5em 30px;">Jumlah Pemesanan</td>
        <td scope="col" style="padding: .5em 30px .5em 30px;">Pembelian</td>
        <td scope="col" style="padding: .5em 30px .5em 30px;">Aksi</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($dataPemesananPelanggan as $data) : ?>
        <tr class="align-middle fw-medium">
          <td>
            <?php echo formatTanggal($data['tanggal_menu'], false, true, false); ?>
            <?php echo date('Y', strtotime($data['tanggal_menu'])); ?>    
          </td>
          <td><?php echo $data['jumlah_pemesanan']; ?></td>
          <td><?php echo formatRupiah($data['total_keseluruhan']); ?></td>
          <td>
            <button class="btn p-0 px-1 btn-sm btn-outline-dark rounded-pill my-border-btn btnDetailPelangganPemesanan" data-idAkun="<?php echo $idAkun; ?>" data-tanggal="<?php echo $data['tanggal_menu']; ?>" data-bs-toggle="modal" data-bs-target="#modalDetailPelangganPemesanan">lihat detail</button>    
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- Modal lihat detail pelanggan pemesanan-->
  <div class="modal fade" id="modalDetailPelangganPemesanan" tabindex="-1" aria-labelledby="modalDetailPelangganPemesananLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
      <div class="modal-content border border-dark">
        <div class="modal-header justify-content-center" style=" background-color: #055160; color: white;">
          <h1 class="modal-title fs-5 text-center" id="modalDetailPelangganPemesananLabel">
          </h1>
        </div>
        <div class="modal-body">
          <div class="d-flex justify-content-center" id="laporanDetailPelangganPemesanan">
          </div>
        </div>
      </div>
    </div>
  </div>