<div class="flex-row">
  <div class="row mb-2 mt-2">
    <div class="col text-center fw-bold">
      <span>
        <button type="button" class="btn btn-sm btn-link text-black" id="btnLihatPelanggan">Lihat Pelanggan</button>
      </span>
      <span class="d-block">Pelanggan</span>
      <span class="d-block fw-medium">Nama: <?php echo $dataPelanggan['nama_pelanggan']; ?></span>
    </div>
  </div>
  <table class="table my-table-admin table-hover text-center" style="width: fit-content;">
    <thead>
      <tr class="align-middle">
        <td scope="col" style="padding: .5em 30px .5em 30px;">Periode</td>
        <td scope="col" style="padding: .5em 30px .5em 30px;">Jumlah Pemesanan</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($dataPemesananPelanggan as $data) : ?>
        <tr class="align-middle fw-medium">
          <td><?php echo formatTanggal($data['tanggal_menu'], false, true, false); ?></td>
          <td><?php echo $data['jumlah_pemesanan']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>