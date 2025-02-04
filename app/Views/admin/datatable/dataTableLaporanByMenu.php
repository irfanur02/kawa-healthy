<table class="table my-table-admin table-hover text-center mt-3" style="width: fit-content;">
  <thead>
    <tr class="align-middle">
      <td scope="col" style="padding: .5em 30px .5em 30px;">Menu</td>
      <td scope="col" style="padding: .5em 30px .5em 30px;">Jumlah Dibeli</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($dataJumlahPesananDataMenu as $data) : ?>
      <tr class="align-middle fw-medium">
        <td><?php echo (!empty($data['nama_menu']) ? $data['nama_menu'] : "Infuse"); ?></td>
        <td><?php echo (!empty($data['nama_menu']) ? $data['qty_menu'] : $data['qty_infuse']); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>