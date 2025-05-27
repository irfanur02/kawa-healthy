<table class="table my-table-admin table-hover text-center mt-3" style="width: fit-content;">
  <thead>
    <tr class="align-middle">
      <td scope="col" style="padding: .5em 30px .5em 30px; width: 40%">Menu</td>
      <td scope="col" style="padding: .5em 30px .5em 30px; width: 20%">Jumlah Dibeli</td>
      <td scope="col" style="padding: .5em 30px .5em 30px; width: 20%">Pendapatan</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($dataJumlahPesananDataMenu as $data) : ?>
      <tr class="align-middle">
        <td class="text-start">
          <?php if (!empty($data['nama_menu'])): ?>
            <?php echo $data['nama_menu'] . '<br>'; ?>
            <?php if (!empty($data['harga_menu'])): ?>
              <span class="fw-medium"><?php echo formatRupiah($data['harga_menu']); ?></span>
            <?php else: ?>
              <span class="fw-medium"><?php echo formatRupiah($data['harga_paket_menu']) . ' (' . $data['nama_paket_menu'] . ')'; ?></span>
            <?php endif; ?>
          <?php else: ?>
            <?php echo 'Infuse' ?><br>
            <span class="fw-medium"><?php echo formatRupiah($paketInfuse); ?></span>
          <?php endif; ?>
        </td>
        <td>
          <?php echo (!empty($data['nama_menu']) ? $data['qty_menu'] : $data['qty_infuse']); ?>    
        </td>
        <td>
          <?php echo !empty($data['nama_menu']) 
            ? formatRupiah($data['perolehan']) 
            : formatRupiah($data['qty_infuse'] * $paketInfuse); ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>