<div class="row justify-content-end align-items-center mb-3">
  <div class="col text-center">
    <span class="fs-6 fw-bold">FAMILY PACK</span><br>
    <?php if (formatTanggal($dataJadwalFamily[0]['tanggal_menu'], false, true) == formatTanggal($dataJadwalFamily[count($dataJadwalFamily) - 1]['tanggal_menu'], false, true)) : ?>
      <span class="fs-6 fw-bold">(
        <?php echo formatTanggal($dataJadwalFamily[0]['tanggal_menu'], true); ?> -
        <?php echo formatTanggal($dataJadwalFamily[count($dataJadwalFamily) - 1]['tanggal_menu'], true); ?>
        <?php echo formatTanggal($dataJadwalFamily[count($dataJadwalFamily) - 1]['tanggal_menu'], false, true); ?> )</span>
    <?php else : ?>
      <span class="fs-6 fw-bold">(
        <?php echo formatTanggal($dataJadwalFamily[0]['tanggal_menu'], true); ?>
        <?php echo formatTanggal($dataJadwalFamily[0]['tanggal_menu'], false, true); ?> -
        <?php echo formatTanggal($dataJadwalFamily[count($dataJadwalFamily) - 1]['tanggal_menu'], true); ?>
        <?php echo formatTanggal($dataJadwalFamily[count($dataJadwalFamily) - 1]['tanggal_menu'], false, true); ?> )</span>
    <?php endif; ?>
  </div>
</div>
<div class="list-data-menu family-menu d-flex justify-content-center flex-wrap">
  <?php foreach ($dataJadwalFamily as $data) : ?>
    <ul class="list-group border border-black">
      <li class="list-group-item border border-0 my-bg-greenlight text-center">
        <input type="text" hidden name="idJadwalMenu" value="<?php echo $data['id_jadwal_menu']; ?>">
        <span class="tanggalMenuFamily"><?php echo formatTanggal($data['tanggal_menu']); ?></span>
      </li>
    <?php if ($data['status_libur'] == "L") : ?>
      <li class="list-group-item border border-0 bg-light text-center">
        <div class="d-flex flex-column px-5">
          LIBUR
        </div>
      </li>
    <?php else : ?>
      <?php foreach ($dataDetailJadwalFamily as $dataDetail) : ?>
        <?php if ($data['tanggal_menu'] == $dataDetail['tanggal_menu']) : ?>
          <li class="list-group-item border border-0">
            <input type="text" hidden name="idDetailJadwalMenu" value="<?php echo $dataDetail['id_detail_jadwal_menu']; ?>">
            <div class="list-menu d-flex flex-nowrap justify-content-between">
              <div class="col-menu p-0 text-start">
                <p class="lh-1 m-0"><span class="menuFamily"><?php echo $dataDetail['nama_menu']; ?></span></p>
                <p class="lh-1 m-0 fw-bold">
                  <span class="hargaMenuFamily"><?php echo formatRupiah($dataDetail['harga_menu']); ?></span>
                  <span><button type="button" class="btn btn-sm btn-link p-0 text-black lihatFotoMenu" data-gambar="/assets/img/menu/<?php echo $dataDetail['gambar_menu']; ?>" data-bs-toggle="modal" data-bs-target="#modalLihatFotoMenu">Lihat Gambar</button></span>
                </p>
              </div>
              <div class="my-form-checkbox d-flex align-items-center">
                <input class="form-check-input my-border-input my-0" type="checkbox">
              </div>
            </div>
          </li>
        <?php endif; ?>
      <?php endforeach; ?>
      <li class="list-group-item border border-0 my-bg-greenlight text-center">
        <div class="d-flex flex-column px-5">
          <?php if ($data['tanggal_menu'] < date("Y-m-d") || $data['tanggal_menu'] == date("Y-m-d")) : ?>
            <span>Menu DiTutup</span>
          <?php else : ?>
            <button class="btn btn-sm lh-sm my-btn-orange border rounded-pill border-black my-border-btn text-nowrap btnPilihMenu">Pilih Menu</button>
            <button class="btn btn-sm lh-sm my-btn-orange border rounded-pill border-black my-border-btn text-nowrap modalPilihMenu modalFamily btnLanjut" data-bs-toggle="modal" data-bs-target="#modalPilihMenu">Lanjut</button>
            <button class="btn btn-sm lh-sm btn-light border rounded-pill border-black my-border-btn mt-2 btnBatalPilih">Batal</button>
          <?php endif; ?>
        </div>
      </li>
    <?php endif; ?>
    </ul>
  <?php endforeach; ?>
</div>