<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content content-tambah-menu">
    <div class="container mt-4">
      <div class="row">
        <div class="col text-center fw-bold">Form Tambah Menu</div>
      </div>
      <div class="d-flex justify-content-center">
        <div class="card mt-4 border border-dark p-3 form-tambahMenu" style="width: 60vw;">
          <div class="card-body">
            <form action="" method="post" id="formMenu">
              <div class="mb-3 row">
                <label for="namaMenu" class="col-md-3 col-form-label">Nama Menu</label>
                <div class="col-md-9">
                  <input type="text" class="form-control form-control-sm my-border-input" id="namaMenu" name="namaMenu" required>
                </div>
              </div>
              <div class="mb-3 row">
                <label class="col-md-3 col-form-label">Kategori Pack</label>
                <div class="col-md-7">
                  <select class="form-select form-select-sm my-border-input" name="jenisPack" id="jenisPack" required>
                    <option selected disabled value="">Pilh Jenis Pack</option>
                    <?php foreach ($dataPack as $data) : ?>
                      <option value="<?php echo $data['id_pack']; ?>"><?php echo $data['nama_pack']; ?> Pack</option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="hargaMenu" class="col-md-3 col-form-label">Harga Menu</label>
                <div class="col-md-7">
                  <input type="number" class="form-control form-control-sm my-border-input" id="hargaMenu" name="hargaMenu" min="1" oninput="validity.valid||(value='');" disabled="true" required>
                </div>
              </div>
              <div class="mb-3 row">
                <label class="col-md-3 col-form-label">Nama Paket Menu</label>
                <div class="col-md-7">
                  <select class="form-select form-select-sm my-border-input" aria-label="Default select example" id="paketMenu" name="paketMenu" disabled="true" required>
                    <option selected disabled value>Pilh Paket Menu</option>
                    <?php foreach ($dataPaketMenu as $data) : ?>
                      <?php if ($data['nama_paket_menu'] != 'infuse') : ?>
                        <option value="<?php echo $data['id_paket_menu']; ?>"><?php echo $data['nama_paket_menu']; ?></option>
                      <?php endif ?>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="hargaMenu" class="col-md-3 col-form-label">Gambar Menu</label>
                <div class="col-md-7">
                  <input type="file" style="color: transparent; width: 110px;" class="my-file-input mx-auto" id="fileGambar" required>
                  <!-- Elemen untuk preview gambar -->
                  <img id="previewGambar" src="" alt="Preview Gambar" style="max-width: 100%; margin-top: 10px; display: none;">
                </div>
              </div>
              <!-- <div class="mb-5 row">
                <label class="col-md-3 col-form-label">Jenis Karbo</label>
                <div class="col-md-6">
                  <select class="form-select form-select-sm my-border-input" aria-label="Default select example"
                    name="jenisKarbo" disabled="true" required>
                    <option selected disabled value>Pilh Jenis Karbo</option>
                    <?php //foreach ($dataKarbo as $data): 
                    ?>
                      <option value="<?php //echo $data['id_karbo']; 
                                      ?>"><?php //echo $data['nama_karbo'];  
                                          ?></option>
                    <?php //endforeach; 
                    ?>
                  </select>
                </div>
              </div> -->
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