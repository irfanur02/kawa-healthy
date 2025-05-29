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
          <?php echo formatRupiah($data['total_harga'] + ($data['jumlah_hari'] * $data['biaya_ongkir'])); ?>
        <?php else : ?>
          <?php echo formatRupiah($data['total_harga_paketan_keseluruhan']); ?>
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
          <?php if ($data['approved'] == '-') : ?>
            Dibatalkan Pelanggan
          <?php endif; ?>
        </div>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>