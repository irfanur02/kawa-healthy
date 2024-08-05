<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content">
    <div class="container mt-4">
      <div class="row">
        <div class="col text-center fw-bold">Kelola Menu</div>
      </div>
      <div class="row mt-3">
        <div class="col d-flex justify-content-between align-items-center">
          <form action="">
            <div class="row g-3 align-items-center">
              <div class="col-auto">
                <label for="txtCariMenuAdmin" class="col-form-label">Cari Menu</label>
              </div>
              <div class="col-auto">
                <input type="text" id="txtCariMenuAdmin" class="form-control form-control-sm my-border-input">
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-light rounded my-border-btn">Cari</button>
              </div>
            </div>
          </form>
          <a class="btn btn-sm btn-primary rounded-pill my-border-btn" style="height: fit-content;" href="/dadmin/createMenu" role="button">
            <span class="align-middle">Tambah Menu</span>
          </a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table my-table-admin table-hover text-center mt-3">
          <thead>
            <tr class="align-middle">
              <td scope="col">No.</td>
              <td scope="col">Nama Menu</td>
              <td scope="col">Jenis Pack</td>
              <td scope="col">Nama Paket Menu</td>
              <td scope="col">Harga</td>
              <td scope="col">Aksi</td>
            </tr>
          </thead>
          <tbody>
            <tr class="align-middle text-wrap">
              <td scope="row">1.</td>
              <td>nasi</td>
              <td>family</td>
              <td>-</td>
              <td>Rp. 10000</td>
              <td>
                <a class="btn btn-sm btn-warning rounded-pill my-border-btn" href="/dadmin/updateMenu/1" role="button">Edit
                </a>
                <button type="button" class="btn btn-sm btn-danger rounded-pill my-border-btn" data-bs-toggle="modal"
                  data-bs-target="#modalHapusMenu">Hapus</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- Modal Hapus Menu-->
<div class="modal fade modal-sm" id="modalHapusMenu" tabindex="-1" aria-labelledby="modalHapusMenuLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border border-dark">
      <div class="modal-header justify-content-center" style=" background-color: #055160; color: white;">
        <h1 class="modal-title fs-5" id="modalHapusMenuLabel">Konfirmasi</h1>
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