<div class="flex-row mt-4">
  <?php if ($laporan == 'bulan') : ?>
    <div class="d-flex justify-content-between align-items-center">
      <span class="d-inline align-baseline fw-medium">Total Perolehan : <?php echo formatRupiah($dataPerolehanPemasukan); ?></span>
      <div class="fw-medium">
        <span>Tahun</span>
        <select class="form-select form-select-sm my-border-input d-inline fw-medium" style="width: fit-content;" id="selectTahunPerolehan">
          <?php foreach ($tahunPerolehan as $key => $data): ?>
          <option selected value="<?php echo $data['tanggal_menu']; ?>"><?php echo date('Y', strtotime($data['tanggal_menu'])); ?></option>
        <?php endforeach ?>
        </select>
      </div>
    </div>
  <?php elseif ($laporan == 'periode') : ?>
    <?php if ($range == 'aktif') : ?>
      <div class="d-flex justify-content-between align-items-center">
        <span class="d-inline align-baseline fw-medium">
          Rentang Tanggal
          <br>
          <?php echo formatTanggal($tanggalAwal, false, false, true); ?> - <?php echo formatTanggal($tanggalAkhir, false, false, true); ?>
          </span>
        <div class="fw-medium text-end">
          <span>Total Perolehan</span>
          <br>
          <span><?php echo formatRupiah($perolehan); ?></span>
        </div>
      </div>
    <?php endif ?>
  <?php endif; ?>

  <table class="table my-table-admin table-hover text-center mt-1" style="width: fit-content;">
    <thead>
      <tr class="align-middle">
        <td scope="col" style="padding: .5em 30px .5em 30px;"><?php echo ($laporan == 'periode') ? "Tanggal" : "Bulan"; ?></td>
        <td scope="col" style="padding: .5em 30px .5em 30px;">Pendapatan</td>
        <td scope="col" style="padding: .5em 30px .5em 30px;">Aktifitas</td>
        <td scope="col" style="padding: .5em 30px .5em 30px;">Pembelian</td>
        <td scope="col" style="padding: .5em 30px .5em 30px;">Aksi</td>
      </tr>
    </thead>
    <tbody>
      <?php if ($laporan == 'periode') : ?>
        <?php if (empty($dataLaporan)) : ?>
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
              <td><?php echo formatTanggal($data['tanggal_menu'], false, false, true) ?></td>
              <td>
                <?php echo formatRupiah($data['total_harga_family'] + $data['total_harga_personal'] +
                                          $data['total_harga_infuse'] + $data['total_harga_ongkir']); ?>
                                            
              </td>
              <td>
                <?php echo $data['jumlah_pelanggan']; ?> Pelanggan
                <br>
                <?php echo $data['jumlah_pesanan']; ?> Pesanan
              </td>
              <td>
                <span class="d-block">family pack: <?php echo (!empty($data['jumlah_family']) ? $data['jumlah_family'] : "-"); ?></span>
                <span class="d-block">personal pack: <?php echo (!empty($data['jumlah_personal']) ? $data['jumlah_personal'] : "-"); ?></span>
                <span class="d-block">infuse: <?php echo $data['jumlah_infuse']; ?></span>
              </td>
              <td>
                <button class="btn p-0 px-1 btn-sm btn-outline-dark rounded-pill my-border-btn btnDetailAktifitas" data-laporan="periode" data-bs-toggle="modal" data-bs-target="#modalDetailAktifitas" data-tanggal="<?php echo $data['tanggal_menu']; ?>">lihat detail</button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      <?php else : ?>
        <?php foreach ($dataLaporanPerBulan as $index => $data) : ?>
          <tr class="align-middle fw-medium">
            <td>
              <span><?php echo formatTanggal($data['tanggal_menu'], false, true, false); ?></span>
              <!-- <br>
              <button class="btn p-0 px-1 btn-sm btn-outline-dark rounded-pill my-border-btn btnFrekuensiHari" data-bs-toggle="modal" data-bs-target="#modalFrekuensiHari" data-tanggal="<?php echo $data['tanggal_menu']; ?>">frekuensi hari</button> -->
            </td>
            <td>
              <?php echo formatRupiah($data['total_harga_family'] +
                $data['total_harga_personal'] +
                $data['total_harga_infuse'] + $data['total_harga_ongkir']); ?>
            </td>
            <td>
              <?php echo $data['jumlah_pelanggan']; ?> Pelanggan
              <br>
              <?php echo $data['jumlah_pesanan']; ?> Pesanan
            </td>
            <td>
              <span class="d-block">family pack: <?php echo (!empty($data['total_jumlah_family']) ? $data['total_jumlah_family'] : "-"); ?></span>
              <span class="d-block">personal pack: <?php echo (!empty($data['total_jumlah_personal']) ? $data['total_jumlah_personal'] : "-"); ?></span>
              <span class="d-block">infuse: <?php echo $data['total_jumlah_infuse']; ?></span>
            </td>
            <td>
              <button class="btn p-0 px-1 btn-sm btn-outline-dark rounded-pill my-border-btn btnDetailAktifitas" data-laporan="bulan" data-bs-toggle="modal" data-bs-target="#modalDetailAktifitas" data-tanggal="<?php echo $data['tanggal_menu']; ?>">lihat detail</button>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <!-- Modal frekuensi hari-->
  <div class="modal fade" id="modalFrekuensiHari" tabindex="-1" aria-labelledby="modalFrekuensiHariLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border border-dark">
        <div class="modal-header justify-content-center" style=" background-color: #055160; color: white;">
          <h1 class="modal-title fs-5" id="modalFrekuensiHariLabel"></h1>
        </div>
        <div class="modal-body">
          <div class="d-flex" style="overflow-x: auto; width: 100%;">
            <canvas class="mx-auto" id="chartCanvas" style="height: 300px;"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>