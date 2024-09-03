<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content">
    <div class="container mt-4 content-jadwal-menu">
      <div class="row">
        <div class="col text-center fw-bold">Kelola Jadwal Menu</div>
      </div>
      <div class="row mt-3 d-flex justify-content-center">
        <div class="col-auto text-center">
          <ul class="list-group ul-create">
            <li class="list-group-item border-0">
              <div class="fs-6 fw-bolder">Buat Jadwal</div>
            </li>
            <li class="list-group-item border-0">
              <select class="form-select form-select-sm my-border-input fw-bolder" id="selectJenisPack" required>
                <option selected disabled value="">Pilh Jenis Pack</option>
                <?php foreach ($dataPack as $data) : ?>
                  <option value="<?php echo $data['nama_pack']; ?>"><?php echo $data['nama_pack']; ?> Pack</option>
                <?php endforeach ?>
              </select>
            </li>
            <li class="list-group-item border-0">
              <button type="button" class="btn btn-sm btn-primary rounded-pill my-border-btn" id="btnBuatJadwal">Buat
                Jadwal</button>
            </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col d-flex flex-column justify-content-center">
          <div class="col text-center d-flex justify-content-center mt-4">
            <ul class="list-group list-group-horizontal ul-view">
              <button type="button" class="list-group-item border border-0 list-group-item-action text-nowrap my-active" style="width:12em;" id="tabJadwalFamily">Jadwal Family Pack</button>
              <button type="button" class="list-group-item border border-0 list-group-item-action text-nowrap" style="width:12em;" id="tabJadwalPersonal">Jadwal Personal Pack</button>
            </ul>
          </div>
          <div id="datatable">
            <table class="table my-table-admin table-hover text-center" style="width: fit-content; margin: 0 auto;">
              <caption class="caption-top text-center fw-bold text-black">Riwayat Jadwal Family Pack</caption>
              <thead>
                <tr class="align-middle">
                  <td scope="col" style="padding: .5em 30px .5em 30px;">Tanggal Mulai</td>
                  <td scope="col" style="padding: .5em 30px .5em 30px;">Tanggal Akhir</td>
                  <td scope="col" style="padding: .5em 30px .5em 30px;">Aksi</td>
                </tr>
              </thead>
              <div id="dataTableJadwalMenu">
                <tbody>
                  <?php foreach ($dataJadwalMenu as $data) : ?>
                    <tr class="align-middle">
                      <td><?php echo $data['tanggal_mulai']; ?></td>
                      <td><?php echo $data['tanggal_akhir']; ?></td>
                      <td>
                        <a href="/dadmin/jadwal/<?php echo $data['id_jadwal']; ?>/family" role="button" class="btn btn-sm btn-warning rounded-pill my-border-btn">Edit</buttaon>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </div>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>