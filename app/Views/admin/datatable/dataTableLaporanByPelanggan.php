<table class="table my-table-admin table-hover text-center mt-3" style="width: fit-content;">
  <thead>
    <tr class="align-middle">
      <td scope="col" style="padding: .5em 30px .5em 30px;">Pelanggan</td>
      <td scope="col" style="padding: .5em 30px .5em 30px;">Jumlah Pemesanan</td>
      <td scope="col" style="padding: .5em 30px .5em 30px;">Detail</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($dataJumlahPemesananPelanggan as $data) : ?>
      <tr class="align-middle fw-medium">
        <td><?php echo $data['nama_pelanggan']; ?></td>
        <td><?php echo $data['jumlah_pemesanan']; ?></td>
        <td>
          <button type="button" class="btn btn-warning btn-sm my-border-btn rounded-pill lh-1 btnLaporanDetailPelanggan" data-id="<?php echo $data['id_akun']; ?>">Detail</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>