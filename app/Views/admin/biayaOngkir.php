<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content">
    <div class="container mt-4 content-biaya-ongkir">
      <div class="row">
        <div class="col text-center fw-bold">Kelola Biaya Ongkir</div>
      </div>
      <div class="row mt-3">
        <div class="col d-flex  justify-content-between align-items-center">
          <form action="">
            <div class="row g-3 align-items-center">
              <div class="col-auto">
                <label for="txtCariKotaAdmin" class="col-form-label">Cari Kota</label>
              </div>
              <div class="col-auto">
                <input type="text" id="txtCariKotaAdmin" class="form-control form-control-sm my-border-input">
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-light rounded my-border-btn">Cari</button>
              </div>
            </div>
          </form>
          <button type="button" class="btn btn-sm btn-primary rounded-pill my-border-btn" style="height: fit-content;" data-bs-toggle="modal"
            data-bs-target="#modalTambahKota">Tambah Kota</button>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table my-table-admin table-hover text-center mt-3">
          <thead>
            <tr class="align-middle">
              <td scope="col">No.</td>
              <td scope="col">Nama Kota</td>
              <td scope="col">Ongkir</td>
              <td scope="col">Aksi</td>
            </tr>
          </thead>
          <tbody>
            <tr class="align-middle">
              <td scope="row">1.</td>
              <td>Surabaya</td>
              <td>Rp. 5000</td>
              <td>
                <button type="button" class="btn btn-sm btn-warning rounded-pill my-border-btn" data-bs-toggle="modal"
                  data-bs-target="#modalEditKota">Edit</button>
                <button type="button" class="btn btn-sm btn-danger rounded-pill my-border-btn" data-bs-toggle="modal"
                  data-bs-target="#modalHapusKota">Hapus</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Kota-->
<div class="modal fade" id="modalTambahKota" tabindex="-1" aria-labelledby="modalTambahKotaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border border-dark">
      <div class="modal-header justify-content-center" style=" background-color: #055160; color: white;">
        <h1 class="modal-title fs-5" id="modalTambahKotaLabel">Form Tambah Kota</h1>
      </div>
      <div class="modal-body">
        <form action="" id="formKota">
          <div class="mb-3 row">
            <label for="namaKota" class="col-md-4 col-form-label">Nama Kota</label>
            <div class="col-md-8">
              <input type="text" class="form-control form-control-sm my-border-input" id="namaKota" name="namaKota"
                required>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="biayaOngkir" class="col-md-4 col-form-label">Biaya Ongkir</label>
            <div class="col-md-8">
              <input type="number" class="form-control form-control-sm my-border-input" id="biayaOngkir"
                name="biayaOngkir" required>
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

<!-- Modal Edit Kota-->
<div class="modal fade" id="modalEditKota" tabindex="-1" aria-labelledby="modalEditKotaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border border-dark">
      <div class="modal-header justify-content-center" style=" background-color: #055160; color: white;">
        <h1 class="modal-title fs-5" id="modalEditKotaLabel">Form Edit Kota</h1>
      </div>
      <div class="modal-body">
        <form action="" id="formKota">
          <div class="mb-3 row">
            <label for="namaKota" class="col-md-4 col-form-label">Nama Kota</label>
            <div class="col-md-8">
              <input type="text" class="form-control form-control-sm my-border-input" id="namaKota" name="namaKota"
                required>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="biayaOngkir" class="col-md-4 col-form-label">Biaya Ongkir</label>
            <div class="col-md-8">
              <input type="number" class="form-control form-control-sm my-border-input" id="biayaOngkir"
                name="biayaOngkir" required>
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

<!-- Modal Hapus Menu-->
<div class="modal fade modal-sm" id="modalHapusKota" tabindex="-1" aria-labelledby="modalHapusKota"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border border-dark">
      <div class="modal-header justify-content-center" style=" background-color: #055160; color: white;">
        <h1 class="modal-title fs-5" id="modalHapusKota">Konfirmasi</h1>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col text-center">
            <span>Apakah Anda Yakin ?</span>
            <div class="row mt-4">
              <div class="col d-grid">
                <button type="button" class="btn btn-danger my-border-btn rounded-pill">iya</button>
              </div>
              <div class="col d-grid">
                <button type="button" class="btn btn-light my-border-btn rounded-pill"
                  data-bs-dismiss="modal">tidak</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>