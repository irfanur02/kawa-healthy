<table class="table my-table-admin table-hover text-center" style="width: fit-content;">
  <thead>
    <tr class="align-middle">
      <td scope="col" style="padding: .5em 30px .5em 30px;">Tanggal</td>
      <td scope="col" style="padding: .5em 30px .5em 30px;">Pelanggan</td>
      <td scope="col" style="padding: .5em 30px .5em 30px;">Pembelian</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach($dataAktifitas as $data) : ?>
      <tr>
        <td><?php echo formatTanggal($data['tanggal_menu'], false, false, true); ?></td>
        <td><?php echo $data['nama_pelanggan']; ?></td>
        <td><?php echo formatRupiah($data['total_harga_keseluruhan']); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>