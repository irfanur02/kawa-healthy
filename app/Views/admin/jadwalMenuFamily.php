<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content">
    <div class="mt-4">
      <div class="row">
        <div class="col text-center fw-bold">Kelola Jadwal Menu <br> Family Pack</div>
      </div>

      <div class="d-flex flex-wrap justify-content-center d-grid gap-2 mt-4 content-jadwal-family content-jadwal">
        <?php if ($case == 'update') : ?>
          <input type="hidden" name="case" value="updateJadwalMenu"></input>
          <?php foreach ($dataJadwalMenu as $dataJadwal) : ?>
            <ul class="list-group list-content-jadwal fw-medium bacaJadwalMenu" data-id=" <?php echo $dataJadwal['id_jadwal_menu']; ?>" style="width: 13em;">
              <li class="list-group-item border border-black text-center">
                <div class="mb-2">
                  <label for="exampleFormControlInput1" class="form-label">Mulai</label>
                  <input type="date" class="form-control form-control-sm my-border-input txtDate jadwalFamily" style="width: fit-content; margin: auto;" value="<?php echo $dataJadwal['tanggal_menu']; ?>" min="<?php echo $dataJadwal['tanggal_menu']; ?>" <?php echo ($dataJadwal['tanggal_menu'] <= date("Y-m-d")) ? "disabled" : ""; ?>>
                </div>
                <?php if ($dataJadwal['tanggal_menu'] <= date("Y-m-d")) : ?>
                  <span>Jadwal Kadaluarsa</span>
                <?php else : ?>
                  <?php if (!empty($dataJadwal['id_menu_pesanan']) && empty($dataJadwal['batal'])) : ?>
                    <span>Sudah Dipesan</span>
                  <?php else : ?>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input my-border-input cbLibur" id="cBoxLibur" <?php echo ($dataJadwal['status_libur'] == 'L') ? 'checked' : ''; ?> type="checkbox">
                      <label class="form-check-label" for="cBoxLibur">Libur</label>
                    </div>
                    <br>
                    <button type="button" class="btn mt-1 btn-sm btn-danger rounded-pill my-border-btn btnListHapusJadwal">Hapus</button>
                  <?php endif; ?>
                <?php endif; ?>
              </li>
              <?php if ($dataJadwal['status_libur'] == 'B') : ?>
                <li class="list-group-item border border-top-0 border-black ">
                  <?php if ($dataJadwal['tanggal_menu'] > date("Y-m-d")) : ?>
                    <?php if (empty($dataJadwal['id_menu_pesanan']) || !empty($dataJadwal['batal'])) : ?>
                      <div class="my-form-jadwal-family">
                        <input class="form-control form-control-sm rounded-0 my-border-input" type="text" name="itemMenu" id="txtMenu" list="datalistOptions" placeholder="Ketik Menu">
                        <datalist id="datalistOptions">
                        </datalist>
                        <button disabled class="btn btn-sm btn-primary rounded-0 my-border-btn btnTambahMenu">Tambahkan</button>
                      </div>
                    <?php endif; ?>
                  <?php endif; ?>
                  <ul class="list-group list-tambah-menu <?php ($dataJadwal['tanggal_menu'] > date("Y-m-d")) ? "mt-2" : ""; ?>">
                    <?php foreach ($dataDetailJadwal as $dataDetail) : ?>
                      <?php if ($dataDetail['tanggal_menu'] == $dataJadwal['tanggal_menu']) : ?>
                        <li class="list-group-item">
                          <div class="row">
                            <div class="col">
                              <input type="text" hidden value="<?php echo $dataDetail['id_menu']; ?>"></input>
                              <span class="text-wrap item"><?php echo $dataDetail['nama_menu']; ?></span>
                            </div>
                            <?php if ($dataJadwal['tanggal_menu'] > date("Y-m-d")) : ?>
                              <?php if (empty($dataJadwal['id_menu_pesanan']) || !empty($dataJadwal['batal'])) : ?>
                                <div class="col-auto">
                                  <button class="btn btn-sm btnHapusListMenu">
                                    <span class="fs-5 text-danger">
                                      <i class="bi bi-x-square"></i>
                                    </span>
                                  </button>
                                </div>
                              <?php endif; ?>
                            <?php endif; ?>
                          </div>
                        </li>
                      <?php endif ?>
                    <?php endforeach ?>
                  </ul>
                </li>
              <?php endif ?>
            </ul>
          <?php endforeach ?>
        <?php else : ?>
          <input type="hidden" name="case" value="saveJadwalMenu"></input>
          <ul class="list-group list-content-jadwal fw-medium" style="width: 13em;">
            <li class="list-group-item border border-black text-center">
              <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">Mulai</label>
                <input type="date" class="form-control form-control-sm my-border-input txtDate createJadwalFamily" style="width: fit-content; margin: auto;" min="<?php echo $maxTanggalAkhir['tanggal_akhir']; ?>">
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input my-border-input cbLibur" id="cBoxLibur" type="checkbox">
                <label class="form-check-label" for="cBoxLibur">Libur</label>
              </div>
              <br>
              <button type="button" class="btn mt-1 btn-sm btn-danger rounded-pill my-border-btn btnListHapusJadwal">Hapus</button>
            </li>
            <li class="list-group-item border border-top-0 border-black ">
              <div class="my-form-jadwal-family">
                <input class="form-control form-control-sm rounded-0 my-border-input" type="text" name="itemMenu" id="txtMenu" list="datalistOptions" placeholder="Ketik Menu">
                <datalist id="datalistOptions">
                </datalist>
                <button disabled class="btn btn-sm btn-primary rounded-0 my-border-btn btnTambahMenu">Tambahkan</button>
              </div>
              <ul class="list-group list-tambah-menu mt-2">
              </ul>
            </li>
          </ul>
        <?php endif ?>
      </div>

      <?php if ($jadwalKadaluarsa == true) : ?>
        <div class="row mt-4">
          <div class="col text-center">
            <button class="btn btn-sm my-btn-main rounded-pill my-border-btn mb-2" id="btnTambahHariFamily">Tambah
              Hari</button><br>
            <?php if ($case == 'update') : ?>
              <button class="btn btn-sm btn-success rounded-pill my-border-btn mb-2 btnPostMenuFamily" data-id="<?php echo $idJadwal; ?>">Update Jadwal</button><br>
            <?php else : ?>
              <button class="btn btn-sm btn-success rounded-pill my-border-btn mb-2 btnPostMenuFamily">Luncurkan Jadwal</button><br>
            <?php endif ?>
            <a href="/dadmin/jadwal" class="btn btn-sm btn-danger rounded-pill my-border-btn mb-2" role="button">Batal</a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>