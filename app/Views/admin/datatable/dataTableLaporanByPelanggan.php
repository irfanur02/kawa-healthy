<div>
  <div class="d-flex justify-content-end mt-4 gap-2">
    <div class="fw-medium">
      <span>Bulan</span>
      <select class="form-select form-select-sm my-border-input d-inline fw-medium perPelanggan" style="width: fit-content;" id="selectBulanPerolehan">
        <option value="null">Opsi</option>
        <?php foreach ($bulanPerolehan as $key => $data): ?>
          <option value="<?php echo $data['tanggal_menu']; ?>"><?php echo formatTanggal($data['tanggal_menu'], false, true, false); ?></option>
        <?php endforeach ?>
      </select>
    </div>  
    <div class="fw-medium">
      <span>Tahun</span>
      <select class="form-select form-select-sm my-border-input d-inline fw-medium perPelanggan" style="width: fit-content;" id="selectTahunPerolehan">
        <?php foreach ($tahunPerolehan as $key => $data): ?>
          <option selected value="<?php echo $data['tanggal_menu']; ?>"><?php echo date('Y', strtotime($data['tanggal_menu'])); ?></option>
        <?php endforeach ?>
      </select>
    </div>
  </div>

  <table class="table my-table-admin table-hover text-center mt-1" style="width: fit-content;">
    <thead>
      <tr class="align-middle">
        <td scope="col" style="padding: .5em 30px .5em 30px;">Pelanggan</td>
        <td scope="col" style="padding: .5em 30px .5em 30px;">Jumlah Pemesanan</td>
        <td scope="col" style="padding: .5em 30px .5em 30px;">Pembelian</td>
        <td scope="col" style="padding: .5em 30px .5em 30px;">Detail</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($dataJumlahPemesananPelanggan as $data) : ?>
        <tr class="align-middle fw-medium">
          <td><?php echo $data['nama_pelanggan']; ?></td>
          <td><?php echo $data['jumlah_pemesanan']; ?></td>
          <td><?php echo formatRupiah($data['total_keseluruhan']); ?></td>
          <td>
            <button type="button" class="btn btn-warning btn-sm my-border-btn rounded-pill lh-1 btnLaporanDetailPelanggan" data-id="<?php echo $data['id_akun']; ?>">Detail</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>