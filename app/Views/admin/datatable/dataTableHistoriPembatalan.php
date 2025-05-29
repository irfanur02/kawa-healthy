<thead>
  <tr class="align-middle">
    <td class="text-center" scope="col">Pelanggan</td>
    <td class="text-center" scope="col">Total Harga Pesanan Pelanggan</td>
    <td class="text-center" scope="col">Aksi</td>
  </tr>
</thead>
<tbody>
  <?php if ($status == 'historiPembatalan'): ?>
    <?php if ($statusPembatalan == 'gantiMasaHari') : ?>
      <?php foreach ($dataAllPaketanPesananGantiMasa as $index => $data) : ?>
        <tr class="align-middle text-center">
          <td><?php echo $data['nama_pelanggan']; ?></td>
          <td>
            <p class="fw-normal m-0 lh-1 text-decoration-underline">Ganti Masa Hari</p>
            <p class="fw-light m-0 lh-1"><?php echo $data['masa_hari']; ?> Hari Jadwal Menu Batal</p>
            <?php echo formatRupiah($data['total_harga'] + $data['total_ongkir']); ?>
          </td>
          <td>
            <?php if (empty($data['uang_dikembalikan'])) : ?>
              <button type="button" class="btn btn-sm btn-warning rounded-pill my-border-btn btnKembalikanUang gantiMasaHari" data-idMasaHariBatal="<?php echo $data['id_masa_hari_batal']; ?>" data-indexBaris="<?php echo $index + 1; ?>" data-nohp="<?php echo $data['notelp_pelanggan']; ?>" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiRefund">Balikkan Uang</button>
            <?php else : ?>
              Sudah Dikembalikan
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php elseif ($statusPembatalan == 'berhentiPaketan') : ?>
      <?php foreach ($dataAllPaketanPesananBerhenti as $index => $data) : ?>
        <tr class="align-middle text-center">
          <td><?php echo $data['nama_pelanggan']; ?></td>
          <td>
            <p class="fw-normal m-0 lh-1 text-decoration-underline">Berhenti Paketan</p>
            <p class="fw-light m-0 lh-1"><?php echo $data['jumlah_hari']; ?> Hari Jadwal Menu Batal</p>
            <?php echo formatRupiah($data['total_harga_keseluruhan']); ?>
          </td>
          <td>
            <?php if ($data['id_status_pesanan'] != 9) : ?>
              <button type="button" class="btn btn-sm btn-warning rounded-pill my-border-btn btnKembalikanUang berhentiPaketan" data-idPesanan="<?php echo $data['id_pesanan']; ?>" data-indexBaris="<?php echo $index + 1; ?>" data-nohp="<?php echo $data['notelp_pelanggan']; ?>" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiRefund">Balikkan Uang</button>
            <?php else : ?>
              Sudah Dikembalikan
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php elseif ($statusPembatalan == 'batalPesanan') : ?>
      <?php foreach ($dataAllPesananBatal as $index => $data) : ?>
        <tr class="align-middle text-center">
          <td><?php echo $data['nama_pelanggan']; ?></td>
          <td>
            <p class="fw-normal m-0 lh-1">Batal Menu Pesanan</p>
            <?php echo formatRupiah($data['total_harga'] + $data['biaya_ongkir']); ?>
          </td>
          <td>
            <?php if ($data['id_status_pesanan'] != 4) : ?>
              <button type="button" class="btn btn-sm btn-warning rounded-pill my-border-btn btnKembalikanUang batalMenuPesanan" data-idMenuPesanan="<?php echo $data['id_menu_pesanan']; ?>" data-indexBaris="<?php echo $index + 1; ?>" data-nohp="<?php echo $data['notelp_pelanggan']; ?>" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiRefund">Balikkan Uang</button>
            <?php else : ?>
              Sudah Dikembalikan
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif ?>
  <?php elseif ($status == 'pembatalanBaru'): ?>
    <?php foreach ($dataAllPaketanPesananGantiMasa as $index => $data) : ?>
        <tr class="align-middle text-center">
          <td><?php echo $data['nama_pelanggan']; ?></td>
          <td>
            <p class="fw-normal m-0 lh-1 text-decoration-underline">Ganti Masa Hari</p>
            <p class="fw-light m-0 lh-1"><?php echo $data['masa_hari']; ?> Hari Jadwal Menu Batal</p>
            <?php echo formatRupiah($data['total_harga'] + $data['total_ongkir']); ?>
          </td>
          <td>
            <?php if (empty($data['uang_dikembalikan'])) : ?>
              <button type="button" class="btn btn-sm btn-warning rounded-pill my-border-btn btnKembalikanUang gantiMasaHari" data-idMasaHariBatal="<?php echo $data['id_masa_hari_batal']; ?>" data-indexBaris="<?php echo $index + 1; ?>" data-nohp="<?php echo $data['notelp_pelanggan']; ?>" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiRefund">Balikkan Uang</button>
            <?php else : ?>
              Sudah Dikembalikan
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php foreach ($dataAllPaketanPesananBerhenti as $index => $data) : ?>
            <tr class="align-middle text-center">
              <td><?php echo $data['nama_pelanggan']; ?></td>
              <td>
                <p class="fw-normal m-0 lh-1 text-decoration-underline">Berhenti Paketan</p>
                <p class="fw-light m-0 lh-1"><?php echo $data['jumlah_hari']; ?> Hari Jadwal Menu Batal</p>
                <?php echo formatRupiah($data['total_harga_keseluruhan']); ?>
              </td>
              <td>
                <?php if ($data['id_status_pesanan'] != 9) : ?>
                  <button type="button" class="btn btn-sm btn-warning rounded-pill my-border-btn btnKembalikanUang berhentiPaketan" data-idPesanan="<?php echo $data['id_pesanan']; ?>" data-indexBaris="<?php echo $index + 1; ?>" data-nohp="<?php echo $data['notelp_pelanggan']; ?>" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiRefund">Balikkan Uang</button>
                <?php else : ?>
                  Sudah Dikembalikan
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
    <?php foreach ($dataAllPesananBatal as $index => $data) : ?>
        <tr class="align-middle text-center">
          <td><?php echo $data['nama_pelanggan']; ?></td>
          <td>
            <p class="fw-normal m-0 lh-1">Batal Menu Pesanan</p>
            <?php echo formatRupiah($data['total_harga'] + $data['biaya_ongkir']); ?>
          </td>
          <td>
            <?php if ($data['id_status_pesanan'] != 4) : ?>
              <button type="button" class="btn btn-sm btn-warning rounded-pill my-border-btn btnKembalikanUang batalMenuPesanan" data-idMenuPesanan="<?php echo $data['id_menu_pesanan']; ?>" data-indexBaris="<?php echo $index + 1; ?>" data-nohp="<?php echo $data['notelp_pelanggan']; ?>" data-bs-toggle="modal" data-bs-target="#modalKonfirmasiRefund">Balikkan Uang</button>
            <?php else : ?>
              Sudah Dikembalikan
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
  <?php endif ?>
</tbody>