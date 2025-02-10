<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content content-jadwal-personal fw-medium">
    <div class="mt-4">
      <div class="row">
        <div class="col text-center fw-bold">Kelola Jadwal Menu <br> Personal Pack</div>
      </div>

      <div class="list-jadwal-personal content-jadwal">
        <?php if ($case == 'update') : ?> <!-- case update jadwal -->
          <input type="hidden" name="case" value="updateJadwalMenu"></input>
          <?php foreach ($dataJadwalMenu as $index => $dataJadwal) : ?>
            <div class="list-jadwal mt-4 text-center bacaJadwalMenu" data-id="<?php echo $dataJadwal['id_jadwal_menu']; ?>">
              <div class="sublist-jadwal border border-black rounded-start ">
                <div class="mb-2">
                  <label for="exampleFormControlInput1" class="form-label">Mulai</label>
                  <input type="date" class="form-control form-control-sm my-border-input txtDate jadwalPersonal" style="width: fit-content; margin: auto;" value="<?php echo $dataJadwal['tanggal_menu']; ?>" <?php echo ($dataJadwal['tanggal_menu'] < date("Y-m-d") || $dataJadwal['id_menu_pesanan'] != null) ? "disabled" : ""; ?>>
                </div>
                <?php if ($dataJadwal['tanggal_menu'] < date("Y-m-d")) : ?>
                  <span>Jadwal Kadaluarsa</span>
                <?php else : ?>
                  <?php if (empty($dataJadwal['id_menu_pesanan']) || !empty($dataJadwal['id_menu_pesanan'])) : ?>
                    <?php if (!empty($dataJadwal['batal']) && !empty($dataJadwal['berhenti_paketan']) || $dataJadwal['id_menu_pesanan'] != null) : ?>
                      <span>Sudah Dipesan</span>
                    <?php else : ?>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input my-border-input cbLibur" id="cBoxLibur<?php echo $index + 1; ?>" <?php echo ($dataJadwal['status_libur'] == 'L') ? 'checked' : ''; ?> type="checkbox">
                        <label class="form-check-label" for="cBoxLibur<?php echo $index + 1; ?>">Libur</label>
                      </div>
                      <br>
                      <button type="button" class="btn mt-1 btn-sm btn-danger rounded-pill my-border-btn btnListHapusJadwal">Hapus</button>
                    <?php endif; ?>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
              <?php if ($dataJadwal['status_libur'] == 'B') : ?>
                <?php foreach ($dataDetailJadwal as $dataDetail) : ?>
                  <?php if ($dataDetail['tanggal_menu'] == $dataJadwal['tanggal_menu']) : ?>
                    <?php if (!empty($dataDetail['nama_paket_menu'])) : ?>
                      <?php if ($dataDetail['nama_paket_menu'] == 'lunch') : ?>
                        <div class="sublist-jadwal border-top border-bottom border-black">
                          <div class="header-list">Lunch</div>
                          <div class="body-list my-form-jadwal-personal">
                            <div class="mb-3">
                              <label for="txtMenuLunch" class="form-label">Cari</label>
                              <input type="text" class="form-control form-control-sm my-border-input txtMenuLunch" name="menuLunch" list="datalistOptionsLunch<?php echo $index + 1; ?>" placeholder="Ketik Menu" data-idMenuLunch="<?php echo $dataDetail['id_menu']; ?>" value="<?php echo $dataDetail['nama_menu']; ?>" <?php echo ($dataJadwal['tanggal_menu'] < date("Y-m-d") || $dataJadwal['id_menu_pesanan'] != null) ? "disabled" : ""; ?>>
                              <datalist id="datalistOptionsLunch<?php echo $index + 1; ?>">
                              </datalist>
                            </div>
                          </div>
                        </div>
                      <?php else : ?>
                        <div class="sublist-jadwal border border-black rounded-end">
                          <div class="header-list">Dinner</div>
                          <div class="body-list my-form-jadwal-personal">
                            <label for="txtMenuDinner" class="form-label">Cari</label>
                            <input type="text" class="form-control form-control-sm my-border-input txtMenuDinner" name="menuDinner" list="datalistOptionsDinner<?php echo $index + 1; ?>" placeholder="Ketik Menu" data-idMenuDinner="<?php echo $dataDetail['id_menu']; ?>" value="<?php echo $dataDetail['nama_menu']; ?>" <?php echo ($dataJadwal['tanggal_menu'] < date("Y-m-d") || $dataJadwal['id_menu_pesanan'] != null) ? "disabled" : ""; ?>>
                            <datalist id="datalistOptionsDinner<?php echo $index + 1; ?>">
                            </datalist>
                          </div>
                        </div>
                      <?php endif ?>
                    <?php endif ?>
                  <?php endif ?>
                <?php endforeach ?>
              <?php endif ?>
            </div>
          <?php endforeach ?>
        <?php else : ?> <!-- case save jadwal -->
          <input type="hidden" name="case" value="saveJadwalMenu"></input>
          <div class="list-jadwal mt-4 text-center">
            <div class="sublist-jadwal border border-black rounded-start ">
              <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">Mulai</label>
                <input type="date" class="form-control form-control-sm my-border-input txtDate jadwalPersonal" style="width: fit-content; margin: auto;" min="<?php echo date('Y-m-d', strtotime($maxTanggalAkhir['tanggal_akhir'] . ' +1 day')); ?>">
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input my-border-input cbLibur" id="cBoxLibur" type="checkbox">
                <label class="form-check-label" for="cBoxLibur">Libur</label>
              </div>
              <br>
              <button type="button" class="btn mt-1 btn-sm btn-danger rounded-pill my-border-btn btnListHapusJadwal">Hapus</button>
            </div>
            <div class="sublist-jadwal border-top border-bottom border-black">
              <div class="header-list">Lunch</div>
              <div class="body-list my-form-jadwal-personal">
                <div class="mb-3">
                  <label for="txtMenuLunch" class="form-label">Cari</label>
                  <input type="text" class="form-control form-control-sm my-border-input txtMenuLunch" name="itemMenu" list="datalistOptionsLunch1" autocomplete="off" placeholder="Ketik Menu">
                  <datalist id="datalistOptionsLunch1">
                  </datalist>
                </div>
              </div>
            </div>
            <div class="sublist-jadwal border border-black rounded-end">
              <div class="header-list">Dinner</div>
              <div class="body-list my-form-jadwal-personal">
                <label for="txtMenuDinner" class="form-label">Cari</label>
                <input type="text" class="form-control form-control-sm my-border-input txtMenuDinner" name="itemMenu" list="datalistOptionsDinner1" autocomplete="off" placeholder="Ketik Menu">
                <datalist id="datalistOptionsDinner1">
                </datalist>
              </div>
            </div>
          </div>
        <?php endif ?>
      </div>

      <?php if ($jadwalKadaluarsa == true) : ?>
        <div class="row mt-4">
          <div class="col text-center">
            <button class="btn btn-sm my-btn-main rounded-pill my-border-btn mb-2" id="btnTambahHariPersonal">Tambah
              Hari</button><br>
            <?php if ($case == 'update') : ?>
              <button class="btn btn-sm btn-success rounded-pill my-border-btn mb-2 btnPostMenuPersonal" data-idJadwal=<?php echo $idJadwal; ?>>Update Jadwal</button><br>
            <?php else : ?>
              <button class="btn btn-sm btn-success rounded-pill my-border-btn mb-2 btnPostMenuPersonal">Luncurkan Jadwal</button><br>
            <?php endif ?>
            <a href="/dadmin/jadwal" class="btn btn-sm btn-danger rounded-pill my-border-btn mb-2" role="button">Batal</a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>