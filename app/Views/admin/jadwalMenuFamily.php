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
        <ul class="list-group list-content-jadwal fw-medium" style="width: 13em;">
          <li class="list-group-item border border-black text-center">
            <div class="mb-2">
              <label for="exampleFormControlInput1" class="form-label">Mulai</label>
              <input type="date" class="form-control form-control-sm my-border-input txtDate jadwalFamily"
                style="width: fit-content; margin: auto;">
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input my-border-input cbLibur" type="checkbox">
              <label class="form-check-label" for="cbLibur">Libur</label>
            </div>
            <br>
            <button type="button"
              class="btn mt-1 btn-sm btn-danger rounded-pill my-border-btn btnListHapusJadwal">Hapus</button>
          </li>
          <li class="list-group-item border border-top-0 border-black ">
            <div class="my-form-jadwal-family">
              <input class="form-control form-control-sm rounded-0 my-border-input" type="text" name="" id="txtMenu"
                list="datalistOptions" placeholder="Ketik Menu">
              <datalist id="datalistOptions">
                <option value="Nasi">
                <option value="Potato">
              </datalist>
              <button class="btn btn-sm btn-primary rounded-0 my-border-btn btnTambahMenu">Tambahkan</button>
            </div>
            <ul class="list-group list-tambah-menu mt-2">
            </ul>
          </li>
        </ul>
      </div>

      <div class="row mt-4">
        <div class="col text-center">
          <button class="btn btn-sm my-btn-main rounded-pill my-border-btn mb-2" id="btnTambahHariFamily">Tambah
            Hari</button><br>
          <button class="btn btn-sm btn-success rounded-pill my-border-btn mb-2">Luncurkan Jadwal</button><br>
          <a href="/dadmin/jadwalMenu" class="btn btn-sm btn-danger rounded-pill my-border-btn mb-2" role="button">Batal</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>