<div class="row justify-content-end align-items-center">
  <div class="col-4 text-center">
    <span class="fs-6 fw-bold">PERSONAL PACK</span><br>
    <?php if (formatTanggal($dataJadwalPersonal[0]['tanggal_menu'], false, true) == formatTanggal($dataJadwalPersonal[count($dataJadwalPersonal) - 1]['tanggal_menu'], false, true)) : ?>
      <span class="fs-6 fw-bold">(
        <?php echo formatTanggal($dataJadwalPersonal[0]['tanggal_menu'], true); ?> -
        <?php echo formatTanggal($dataJadwalPersonal[count($dataJadwalPersonal) - 1]['tanggal_menu'], true); ?>
        <?php echo formatTanggal($dataJadwalPersonal[count($dataJadwalPersonal) - 1]['tanggal_menu'], false, true); ?> )</span>
    <?php else : ?>
      <span class="fs-6 fw-bold">(
        <?php echo formatTanggal($dataJadwalPersonal[0]['tanggal_menu'], true); ?>
        <?php echo formatTanggal($dataJadwalPersonal[0]['tanggal_menu'], false, true); ?> -
        <?php echo formatTanggal($dataJadwalPersonal[count($dataJadwalPersonal) - 1]['tanggal_menu'], true); ?>
        <?php echo formatTanggal($dataJadwalPersonal[count($dataJadwalPersonal) - 1]['tanggal_menu'], false, true); ?> )</span>
    <?php endif; ?>
    <br>
    <button class="btn btn-sm my-btn-green border rounded-pill border-black my-border-btn lh-sm" data-bs-toggle="modal" data-bs-target="#modalInformasi">Informasi</button>
  </div>
  <div class="col-4 text-end">
    <button class="btn my-btn-orange border rounded-pill border-black my-border-btn lh-sm" id="btnModalPaketan" data-bs-toggle="modal" data-bs-target="#modalPaketan">Paketan</button>
  </div>
</div>
<div class="text-center mt-2">
  <div class="d-flex justify-content-center flex-wrap data-menu">
    <div class="list-data-menu personal-menu">
      <?php foreach ($dataJadwalPersonal as $data) : ?>
        <?php if ($data['tanggal_menu'] > date("Y-m-d")) : ?>
          <ul class="list-group border border-black">
            <li class="list-group-item border border-0 my-bg-greenlight">
              <div class="row m-0 <?php echo ($data['status_libur'] == "L") ? "py-2" : ""; ?>">
                <input type="text" name="idJadwalMenu" hidden value="<?php echo $data['id_jadwal_menu']; ?>">
                <div class="col my-auto tanggalMenuPersonal"><?php echo formatTanggal($data['tanggal_menu']); ?></div>
                <?php if ($data['tanggal_menu'] < date("Y-m-d") || $data['tanggal_menu'] == date("Y-m-d")) : ?>
                  <div class="col-3 btnPilihMenu MenuTutup">
                    <span class="d-inline-block"><i class="bi bi-x-lg"></i></span>
                    <span class="mx-1 d-inline-block my-2">Menu DiTutup</span>
                  </div>
                <?php else : ?>
                  <?php if ($data['status_libur'] == "B") : ?>
                    <div class="col-3 btnPilihMenu">
                      <span class="d-inline-block"><i class="bi bi-hand-index-thumb-fill"></i></span>
                      <span class="mx-1 d-inline-block my-2">Pilih Menu</span>
                    </div>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </li>
            <?php if ($data['status_libur'] == "L") : ?>
              <li class="list-group-item border border-0 bg-light text-center">
                <div class="d-flex flex-column px-5">
                  LIBUR
                </div>
              </li>
            <?php else : ?>
              <?php foreach ($dataDetailJadwalPersonal as $dataDetail) : ?>
                <?php if ($data['tanggal_menu'] == $dataDetail['tanggal_menu']) : ?>
                  <li class="list-group-item ">
                    <input type="text" name="idDetailJadwalMenu" hidden value="<?php echo $dataDetail['id_detail_jadwal_menu']; ?>">
                    <div class="row m-0">
                      <div class="col-1 p-0">
                        <img src="/assets/img/menu/<?php echo $dataDetail['gambar_menu']; ?>" class="gambar-menu lihatFotoMenu" alt="..." data-bs-toggle="modal" data-bs-target="#modalLihatFotoMenu">
                      </div>
                      <div class="col p-0 text-start">
                        <span class="menuPersonal"><?php echo $dataDetail['nama_menu']; ?></span>
                      </div>
                      <div class="col-3 p-0 d-flex align-items-center justify-content-end">
                        <div class="my-form-checkbox d-flex align-items-center">
                          <label class="form-check-label"><span class="jenisPaketMenu"><?php echo $dataDetail['nama_paket_menu']; ?></span><br><span class="hargaMenuPersonal"><?php echo formatRupiah($dataDetail['harga_paket_menu']); ?></span></label>
                          <input class="form-check-input my-border-input my-0 mx-1" type="checkbox">
                        </div>
                      </div>
                    </div>
                  </li>
                <?php endif; ?>
              <?php endforeach; ?>
              <li class="list-group-item ">
                <?php foreach ($dataInfuseJadwalPersonal as $dataInfuse) : ?>
                  <?php if ($data['tanggal_menu'] == $dataInfuse['tanggal_menu']) : ?>
                    <input type="text" hidden name="optionInfuse" value="<?php echo $dataInfuse['id_detail_jadwal_menu'];
                                                                          ?>">
                    <div class="row m-0 justify-content-end">
                      <div class="col text-end d-flex align-items-center justify-content-end">
                        <button class="btn btn-sm lh-sm my-btn-orange border rounded-pill border-black my-border-btn lh-sm modalPilihMenu modalPersonal" data-bs-toggle="modal" data-bs-target="#modalPilihMenu">Lanjut</button>
                      </div>
                      <div class="col-3 p-0 d-flex align-items-center justify-content-end">
                        <div class="my-form-checkbox d-flex align-items-center">
                          <label class="form-check-label"><span class="jenisPaketMenu"><?php echo $dataPaketMenu['nama_paket_menu']; ?></span><br><span class="hargaMenuPersonal"><?php echo formatRupiah($dataPaketMenu['harga_paket_menu']); ?></span></label>
                          <input class="form-check-input my-border-input my-0 mx-1" type="checkbox">
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>
              </li>
            <?php endif ?>
          </ul>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>