<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content">
    <div class="container mt-4 content-biaya-ongkir">
      <?php if (session()->getFlashdata('notif') == 'tambahKota'): ?>
        <div class="alert alert-success p-2 position-relative alert-dismissible fade show" role="alert">
          Data Biaya Ongkir Berhasil Ditambahkan
          <button type="button" class="btn-close p-2 position-absolute top-50 end-0 translate-middle-y" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('notif') == 'updateKota'): ?>
        <div class="alert alert-primary p-2 position-relative alert-dismissible fade show" role="alert">
          Data Biaya Ongkir Berhasil Diupdate
          <button type="button" class="btn-close p-2 position-absolute top-50 end-0 translate-middle-y" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('notif') == 'deleteKota'): ?>
        <div class="alert alert-danger p-2 position-relative alert-dismissible fade show" role="alert">
          Data Biaya Ongkir Berhasil Dihapus
          <button type="button" class="btn-close p-2 position-absolute top-50 end-0 translate-middle-y" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
      <div class="row">
        <div class="col text-center fw-bold">Kelola Biaya Ongkir</div>
      </div>
      <div class="row mt-3">
        <div class="col d-flex  justify-content-between align-items-center">
          <div id="formCariOngkirKota">
            <div class="row g-3 align-items-center">
              <div class="col-auto">
                <label for="txtCariKotaAdmin" class="col-form-label">Cari Kota</label>
              </div>
              <div class="col-auto">
                <input type="text" id="txtCariKotaAdmin" class="form-control form-control-sm my-border-input" name="keyword" list="datalistOptions">
                <datalist id="datalistOptions">
                </datalist>
              </div>
              <div class="col-auto">
                <button type="button" class="btn btn-sm btn-light rounded my-border-btn">Cari</button>
              </div>
            </div>
          </div>
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
          <tbody id="dataTableOngkir">
            <?php if (count($dataOngkir) < 1): ?>
              <tr>
                <td colspan="4">
                  <div class="alert alert-secondary p-2 m-0" role="alert">
                    Data Biaya Ongkir Masih Kosong
                  </div>
                </td>
              </tr>
            <?php endif; ?>
            <?php $no=1; foreach ($dataOngkir as $key): ?>
            <tr class="align-middle">
              <td scope="row"><?php echo $no++;?>.</td>
              <td><?php echo $key['ongkir_kota']; ?></td>
              <td>Rp. <?php echo $key['biaya_ongkir']; ?></td>
              <td>
                <button type="button" data-id="<?php echo $key['id_ongkir']; ?>" class="btn btn-sm btn-warning rounded-pill my-border-btn btnModalEditOngkir" data-bs-toggle="modal"
                  data-bs-target="#modalEditKota">Edit</button>
                <button type="button" data-id="<?php echo $key['id_ongkir']; ?>" class="btn btn-sm btn-danger rounded-pill my-border-btn btnModalHapusOngkir" data-bs-toggle="modal"
                  data-bs-target="#modalHapusKota">Hapus</button>
              </td>
            </tr>
            <?php endforeach; ?>
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
        <form action="/dadmin/biayaOngkir/save" method="post" id="formOngkir">
          <?php echo csrf_field(); ?>
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
                name="biayaOngkir" min="1" oninput="validity.valid||(value='');" required>
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
        <form action="" method="post" id="formOngkir">
          <?php echo csrf_field(); ?>
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
              <input type="number" class="form-control form-control-sm my-border-input" min="1" oninput="validity.valid||(value='');" id="biayaOngkir"
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

<!-- Modal Hapus Kota-->
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
                <form method="post">
                  <button type="submit" class="btn w-100 btn-danger my-border-btn rounded-pill">iya</button>
                </form>
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