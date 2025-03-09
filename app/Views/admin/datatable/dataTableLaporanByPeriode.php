<table class="table my-table-admin table-hover text-center mt-3" style="width: fit-content;">
  <thead>
    <tr class="align-middle">
      <td scope="col" style="padding: .5em 30px .5em 30px;">Tanggal</td>
      <td scope="col" style="padding: .5em 30px .5em 30px;">Pendapatan</td>
      <td scope="col" style="padding: .5em 30px .5em 30px;">Jumlah Jenis Pack</td>
    </tr>
  </thead>
  <tbody>
    <?php if ($laporan == 'periode') : ?>
      <?php if (empty($datalaporan)) : ?>
        <tr class="text-center align-middle">
          <td colspan="5">
            <div class="card my-bg-pinklight border border-black InfoDaftarPesanan" style="display: block;">
              <div class="card-body text-center">
                <span class="fs-5">Tidak ada pemesanan</span>
              </div>
            </div>
          </td>
        </tr>
      <?php else : ?>
        <?php foreach ($dataLaporan as $data) : ?>
          <tr class="align-middle fw-medium">
            <td><?php echo $data['tanggal_menu']; ?></td>
            <td>Rp. <?php echo $data['total_harga'] + $data['biaya_ongkir']; ?></td>
            <td>
              <span class="d-block">family pack: <?php echo (!empty($data['jumlah_family']) ? $data['jumlah_family'] : "-"); ?></span>
              <span class="d-block">personal pack: <?php echo (!empty($data['jumlah_personal']) ? $data['jumlah_personal'] : "-"); ?></span>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    <?php else : ?>
      <?php foreach ($dataLaporanPerBulan as $index => $data) : ?>
        <tr class="align-middle fw-medium">
          <td><?php echo $data['tanggal_menu']; ?></td>
          <td>Rp.
            <?php $totalOngkir = ($data['bulan_tahun'] == $dataTotalOngkir[$index]['bulan_tahun']) ? $dataTotalOngkir[$index]['total_ongkir'] : ""; ?>
            <?php echo $data['total_harga_family'] +
              $data['total_harga_personal'] +
              $data['total_harga_infuse'] + $totalOngkir; ?></td>
          <td>
            <span class="d-block">family pack: <?php echo (!empty($data['total_jumlah_family']) ? $data['total_jumlah_family'] : "-"); ?></span>
            <span class="d-block">personal pack: <?php echo (!empty($data['total_jumlah_personal']) ? $data['total_jumlah_personal'] : "-"); ?></span>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>