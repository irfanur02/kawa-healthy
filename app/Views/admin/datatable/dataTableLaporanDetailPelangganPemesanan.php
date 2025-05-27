<table class="table my-table-admin table-hover text-center" style="width: fit-content;">
  <thead>
    <tr class="align-middle">
      <td scope="col" style="padding: .5em 30px .5em 30px; width: 20%;">Tanggal</td>
      <td scope="col" style="padding: .5em 30px .5em 30px;">Menu</td>
      <td scope="col" style="padding: .5em 30px .5em 30px;">Pembelian</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($dataPesananPelangganAkun as $data) : ?>
      <tr class="align-middle">
        <td><?php echo formatTanggal($data['tanggal_menu'], false, false, true); ?></td>
        <td>
          <?php foreach ($dataMenuPesananPelangganAkun as $detail): ?>
            <p class="lh-1 m-0 text-start">
              <?php if ($data['id_menu_pesanan'] == $detail['id_menu_pesanan']) : ?>
                  <?php if (!empty($detail['nama_menu'])) : ?>
                    <span>(<?php echo $detail['qty_menu']; ?>)</span>
                    <span><?php echo $detail['nama_menu']; ?></span>
                  <?php else : ?>
                    <span>(<?php echo $detail['qty_infuse']; ?>)</span>
                    <span>Infuse</span>
                  <?php endif; ?>
              <?php endif; ?>
            </p>
          <?php endforeach; ?>
        </td>
        <td><?php echo formatRupiah($data['total_harga'] + $data['biaya_ongkir']); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>