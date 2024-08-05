<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content">
    <div class="container mt-4 content-paket-menu">
      <div class="row">
        <div class="col text-center fw-bold">Kelola Paket Menu</div>
      </div>
      <div class="row mt-3">
        <div class="col d-flex justify-content-between align-items-center">
          <form action="">
            <div class="row g-3 align-items-center">
              <div class="col-auto">
                <label for="txtCariPaketMenuAdmin" class="col-form-label">Cari Paket Menu</label>
              </div>
              <div class="col-auto">
                <input type="text" id="txtCariPaketMenuAdmin" class="form-control form-control-sm my-border-input">
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-light rounded my-border-btn">Cari</button>
              </div>
            </div>
          </form>
          <button type="button" class="btn btn-sm btn-primary rounded-pill my-border-btn" style="height: fit-content;" data-bs-toggle="modal"
            data-bs-target="#modalTambahPaketMenu">Tambah Paket Menu</button>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table my-table-admin table-hover text-center mt-3">
          <thead>
            <tr class="align-middle">
              <td scope="col">No.</td>
              <td scope="col">Nama Paket Menu</td>
              <td scope="col">Harga</td>
              <td scope="col">Aksi</td>
            </tr>
          </thead>
          <tbody>
            <tr class="align-middle">
              <td scope="row">1.</td>
              <td>lunch</td>
              <td>Rp. 50000</td>
              <td>
                <button type="button" class="btn btn-sm btn-warning rounded-pill my-border-btn" data-bs-toggle="modal"
                  data-bs-target="#modalEditPaketMenu">Edit</button>
                <button type="button" class="btn btn-sm btn-danger rounded-pill my-border-btn" data-bs-toggle="modal"
                  data-bs-target="#modalHapusPaketMenu">Hapus</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Paket Menu-->
<div class="modal fade" id="modalTambahPaketMenu" tabindex="-1" aria-labelledby="modalTambahPaketMenuLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border border-dark">
      <div class="modal-header justify-content-center" style=" background-color: #055160; color: white;">
        <h1 class="modal-title fs-5" id="modalTambahPaketMenuLabel">Form Tambah Paket Menu</h1>
      </div>
      <div class="modal-body">
        <form action="" id="formPaketMenu">
          <div class="mb-3 row">
            <label for="namaPaketMenu" class="col-md-4 col-form-label">Nama Paket Menu</label>
            <div class="col-md-8">
              <input type="text" class="form-control form-control-sm my-border-input" id="namaPaketMenu"
                name="namaPaketMenu" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="txtHarga" class="col-md-4 col-form-label">Harga PaketMenu</label>
            <div class="col-md-8">
              <input type="number" class="form-control form-control-sm my-border-input" id="txtHarga" name="txtHarga"
                required>
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

<!-- Modal Edit Paket Menu-->
<div class="modal fade" id="modalEditPaketMenu" tabindex="-1" aria-labelledby="modalEditPaketMenuLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border border-dark">
      <div class="modal-header justify-content-center" style=" background-color: #055160; color: white;">
        <h1 class="modal-title fs-5" id="modalEditPaketMenuLabel">Form Edit Paket Menu</h1>
      </div>
      <div class="modal-body">
        <form action="" id="formPaketMenu">
          <div class="mb-3 row">
            <label for="namaPaketMenu" class="col-md-4 col-form-label">Nama Paket Menu</label>
            <div class="col-md-8">
              <input type="text" class="form-control form-control-sm my-border-input" id="namaPaketMenu"
                name="namaPaketMenu" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="hargaPaket" class="col-md-4 col-form-label">Harga Paket Menu</label>
            <div class="col-md-8">
              <input type="number" class="form-control form-control-sm my-border-input" id="hargaPaket"
                name="hargaPaket" required>
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
<div class="modal fade modal-sm" id="modalHapusPaketMenu" tabindex="-1" aria-labelledby="modalHapusPaketMenuLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border border-dark">
      <div class="modal-header justify-content-center" style=" background-color: #055160; color: white;">
        <h1 class="modal-title fs-5" id="modalHapusPaketMenuLabel">Konfirmasi</h1>
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