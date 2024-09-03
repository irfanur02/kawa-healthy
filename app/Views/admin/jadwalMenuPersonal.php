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
        <?php if ($case == 'update') : ?>
          <?php foreach ($dataJadwalMenu as $dataJadwal) : ?>
            <div class="list-jadwal mt-4 text-center updateJadwalMenu" data-id="<?php echo $dataJadwal['id_jadwal_menu']; ?>">
              <div class="sublist-jadwal border border-black rounded-start ">
                <div class="mb-2">
                  <label for="exampleFormControlInput1" class="form-label">Mulai</label>
                  <input type="date" class="form-control form-control-sm my-border-input txtDate jadwalPersonal" style="width: fit-content; margin: auto;" value="<?php echo $dataJadwal['tanggal_menu']; ?>">
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input my-border-input cbLibur" id="cBoxLibur" <?php echo ($dataJadwal['status_libur'] == 'L') ? 'checked' : ''; ?> type="checkbox">
                  <label class="form-check-label" for="cBoxLibur">Libur</label>
                </div>
                <br>
                <button type="button" class="btn mt-1 btn-sm btn-danger rounded-pill my-border-btn btnListHapusJadwal">Hapus</button>
              </div>
              <?php if ($dataJadwal['status_libur'] == 'B') : ?>
                <?php foreach ($dataDetailJadwal as $dataDetail) : ?>
                  <?php if ($dataDetail['tanggal_menu'] == $dataJadwal['tanggal_menu']) : ?>
                    <?php if ($dataDetail['nama_paket_menu'] == 'family') : ?>
                      <div class="sublist-jadwal border-top border-bottom border-black">
                        <div class="header-list">Lunch</div>
                        <div class="body-list my-form-jadwal-personal">
                          <div class="mb-3">
                            <label for="txtMenuLunch" class="form-label">Cari</label>
                            <input type="text" class="form-control form-control-sm my-border-input txtMenuLunch" name="itemMenu" list="datalistOptionsLunch1" placeholder="Ketik Menu" value="<?php echo $dataDetail['nama_menu']; ?>">
                            <datalist id="datalistOptionsLunch1">
                            </datalist>
                          </div>
                        </div>
                      </div>
                    <?php else : ?>
                      <div class="sublist-jadwal border border-black rounded-end">
                        <div class="header-list">Dinner</div>
                        <div class="body-list my-form-jadwal-personal">
                          <label for="txtMenuDinner" class="form-label">Cari</label>
                          <input type="text" class="form-control form-control-sm my-border-input txtMenuDinner" name="itemMenu" list="datalistOptionsDinner1" placeholder="Ketik Menu" value="<?php echo $dataDetail['nama_menu']; ?>">
                          <datalist id="datalistOptionsDinner1">
                          </datalist>
                        </div>
                      </div>
                    <?php endif ?>
                  <?php endif ?>
                <?php endforeach ?>
              <?php endif ?>
            </div>
          <?php endforeach ?>
        <?php else : ?>
          <div class="list-jadwal mt-4 text-center">
            <div class="sublist-jadwal border border-black rounded-start ">
              <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">Mulai</label>
                <input type="date" class="form-control form-control-sm my-border-input txtDate jadwalPersonal" style="width: fit-content; margin: auto;">
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
                  <input type="text" class="form-control form-control-sm my-border-input txtMenuLunch" name="itemMenu" list="datalistOptionsLunch1" placeholder="Ketik Menu">
                  <datalist id="datalistOptionsLunch1">
                  </datalist>
                </div>
              </div>
            </div>
            <div class="sublist-jadwal border border-black rounded-end">
              <div class="header-list">Dinner</div>
              <div class="body-list my-form-jadwal-personal">
                <label for="txtMenuDinner" class="form-label">Cari</label>
                <input type="text" class="form-control form-control-sm my-border-input txtMenuDinner" name="itemMenu" list="datalistOptionsDinner1" placeholder="Ketik Menu">
                <datalist id="datalistOptionsDinner1">
                </datalist>
              </div>
            </div>
          </div>
        <?php endif ?>
      </div>

      <div class="row mt-4">
        <div class="col text-center">
          <button class="btn btn-sm my-btn-main rounded-pill my-border-btn mb-2" id="btnTambahHariPersonal">Tambah
            Hari</button><br>
          <button class="btn btn-sm btn-success rounded-pill my-border-btn mb-2 btnPostMenuPersonal">Luncurkan Jadwal</button><br>
          <a href="/dadmin/jadwal" class="btn btn-sm btn-danger rounded-pill my-border-btn mb-2" role="button">Batal</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>