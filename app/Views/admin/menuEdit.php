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
            <form action="/dadmin/menu/update/<?php echo $dataMenuId['id_menu']; ?>" method="post" id="formMenu">
              <div class="mb-3 row">
                <label for="namaMenu" class="col-md-3 col-form-label">Nama Menu</label>
                <div class="col-md-9">
                  <input type="text" class="form-control form-control-sm my-border-input" id="namaMenu" name="namaMenu" value="<?php echo $dataMenuId['nama_menu']; ?>" required>
                </div>
              </div>
              <div class="mb-3 row">
                <label class="col-md-3 col-form-label">Kategori Pack</label>
                <div class="col-md-7">
                  <select class="form-select form-select-sm my-border-input" name="jenisPack" required>
                    <option disabled value="">Pilih Jenis Pack</option>
                    <?php foreach ($dataPack as $data) : ?>
                      <?php if ($dataMenuId['id_pack'] == $data['id_pack']) : ?>
                        <option selected value="<?php echo $data['id_pack']; ?>"><?php echo $data['nama_pack']; ?> Pack</option>
                      <?php else : ?>
                        <option value="<?php echo $data['id_pack']; ?>"><?php echo $data['nama_pack']; ?> Pack</option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="hargaMenu" class="col-md-3 col-form-label">Harga Menu</label>
                <div class="col-md-7">
                  <?php if ($dataMenuId['harga_menu'] != NULL) : ?>
                    <input type="number" class="form-control form-control-sm my-border-input" id="hargaMenu" name="hargaMenu" min="1" oninput="validity.valid||(value='');" value="<?php echo $dataMenuId['harga_menu'] ?>" required>
                  <?php endif ?>
                  <?php if ($dataMenuId['harga_menu'] == NULL) : ?>
                    <input type="number" class="form-control form-control-sm my-border-input" id="hargaMenu" name="hargaMenu" min="1" oninput="validity.valid||(value='');" disabled="true" required>
                  <?php endif ?>
                </div>
              </div>
              <div class="mb-3 row">
                <label class="col-md-3 col-form-label">Nama Paket Menu</label>
                <div class="col-md-7">
                  <select class="form-select form-select-sm my-border-input" aria-label="Default select example" name="paketMenu" <?php echo $dataMenuId['id_paket_menu'] == NULL ? "disabled" : ""; ?> required>
                    <option <?php echo $dataMenuId['id_paket_menu'] == NULL ? "selected" : ""; ?> disabled value="">Pilih Paket Menu</option>
                    <?php foreach ($dataPaketMenu as $data) : ?>
                      <?php if ($data['nama_paket_menu'] != 'infuse') : ?>
                        <option value="<?php echo $data['id_paket_menu']; ?>"><?php echo $data['nama_paket_menu']; ?></option>
                      <?php endif ?>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <!-- <div class="mb-5 row">
                <label class="col-md-3 col-form-label">Jenis Karbo</label>
                <div class="col-md-6">                      
                  <select class="form-select form-select-sm my-border-input" aria-label="Default select example" <?php //echo $dataMenuId['id_karbo'] == NULL ? "disabled" : ""; 
                                                                                                                  ?>
                    name="jenisKarbo" required>
                    <option <?php //echo $dataMenuId['id_karbo'] == NULL ? "selected" : ""; 
                            ?> disabled value="">Pilih Jenis Karbo</option>
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
                <button type="submit" class="btn btn-primary rounded-pill my-border-btn ">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>