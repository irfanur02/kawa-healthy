<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content content-tambah-menu">
    <div class="container mt-4">
      <div class="row">
        <div class="col text-center fw-bold">Form Edit Menu</div>
      </div>
      <div class="d-flex justify-content-center">
        <div class="card mt-4 border border-dark p-3 form-tambahMenu" style="width: 60vw;">
          <div class="card-body">
            <form action="" id="formMenu">
              <div class="mb-3 row">
                <label for="namaMenu" class="col-md-3 col-form-label">Nama Menu</label>
                <div class="col-md-9">
                  <input type="text" class="form-control form-control-sm my-border-input" id="namaMenu"
                    name="namaMenu" required>
                </div>
              </div>
              <div class="mb-3 row">
                <label class="col-md-3 col-form-label">Kategori Pack</label>
                <div class="col-md-7">
                  <select class="form-select form-select-sm my-border-input" name="jenisPack" required>
                    <option selected disabled value="">Pilh Jenis Pack</option>
                    <option value="1">Family Pack</option>
                    <option value="2">Personal Pack</option>
                  </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="hargaMenu" class="col-md-3 col-form-label">Harga Menu</label>
                <div class="col-md-7">
                  <input type="number" class="form-control form-control-sm my-border-input" id="hargaMenu"
                    name="hargaMenu" disabled="true" required>
                </div>
              </div>
              <div class="mb-3 row">
                <label class="col-md-3 col-form-label">Nama Paket Menu</label>
                <div class="col-md-7">
                  <select class="form-select form-select-sm my-border-input" aria-label="Default select example"
                    name="paketMenu" disabled="true" required>
                    <option selected disabled value>Pilh Paket Menu</option>
                    <option value="1">Lunch</option>
                    <option value="1">Dinner</option>
                  </select>
                </div>
              </div>
              <div class="mb-5 row">
                <label class="col-md-3 col-form-label">Jenis Karbo</label>
                <div class="col-md-6">
                  <select class="form-select form-select-sm my-border-input" aria-label="Default select example"
                    name="jenisKarbo" disabled="true" required>
                    <option selected disabled value>Pilh Jenis Karbo</option>
                    <option value="1">Nasi Merah</option>
                    <option value="1">Maspotato</option>
                  </select>
                </div>
              </div>
              <div class="d-grid gap-2 col-2 mx-auto">
                <button type="submit" class="btn btn-primary rounded-pill my-border-btn ">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>