<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content content-jadwal-personal">
    <div class="mt-4">
      <div class="row">
        <div class="col text-center fw-bold">Kelola Jadwal Menu <br> Personal Pack</div>
      </div>

      <div class="list-jadwal-personal content-jadwal">
        <div class="list-jadwal mt-4 text-center">
          <div class="sublist-jadwal border border-black rounded-start ">
            <div class="mb-2" >
              <label for="exampleFormControlInput1" class="form-label">Mulai</label>
              <input type="date" class="form-control form-control-sm my-border-input txtDate jadwalPersonal"
                  style="width: fit-content; margin: auto;">
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input my-border-input cbLibur" type="checkbox">
                <label class="form-check-label" for="cbLibur">Libur</label>
              </div>
              <br>
              <button type="button" class="btn mt-1 btn-sm btn-danger rounded-pill my-border-btn btnListHapusJadwal">Hapus</button>
          </div>
          <div class="sublist-jadwal border-top border-bottom border-black">
            <div class="header-list ">Lunch</div>
            <div class="body-list ">
              <div class="mb-3">
                <label for="txtMenuLunch" class="form-label">Cari</label>
                <input type="text" class="form-control form-control-sm my-border-input" id="txtMenuLunch" list="datalistOptions">
                <datalist id="datalistOptions">
                  <option value="Nasi">
                  <option value="Potato">
                </datalist>
              </div>
            </div>
          </div>
          <div class="sublist-jadwal border border-black rounded-end">
            <div class="header-list ">Dinner</div>
            <div class="body-list ">
              <label for="txtMenuDinner" class="form-label">Cari</label>
              <input type="text" class="form-control form-control-sm my-border-input" id="txtMenuDinner" list="datalistOptions">
              <datalist id="datalistOptions">
                <option value="Nasi">
                <option value="Potato">
              </datalist>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col text-center">
          <button class="btn btn-sm my-btn-main rounded-pill my-border-btn mb-2" id="btnTambahHariPersonal">Tambah
            Hari</button><br>
          <button class="btn btn-sm btn-success rounded-pill my-border-btn mb-2">Luncurkan Jadwal</button><br>
          <a href ="/dadmin/jadwalMenu" class="btn btn-sm btn-danger rounded-pill my-border-btn mb-2" role="button">Batal</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>