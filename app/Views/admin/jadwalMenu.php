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
          <ul class="list-group">
            <li class="list-group-item border-0">
              <div class="fs-6 fw-bolder">Buat Jadwal</div>
            </li>
            <li class="list-group-item border-0">
              <select class="form-select form-select-sm my-border-input fw-bolder" id="selectJenisPack" required>
                <option selected disabled value="">Pilh Jenis Pack</option>
                <option value="1">Family Pack</option>
                <option value="2">Personal Pack</option>
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
        <div class="col d-flex justify-content-center">
          <table class="table my-table-admin table-hover text-center mt-3" style="width: fit-content;">
            <caption class="caption-top text-center fw-bold text-black">Riwayat Jadwal Menu</caption>
            <thead>
              <tr class="align-middle">
                <td scope="col" style="padding: .5em 30px .5em 30px;">Tanggal Mulai</td>
                <td scope="col" style="padding: .5em 30px .5em 30px;">Tanggal Akhir</td>
                <td scope="col" style="padding: .5em 30px .5em 30px;">Aksi</td>
              </tr>
            </thead>
            <tbody>
              <tr class="align-middle">
                <td>1/1/2024</td>
                <td>5/1/2024</td>
                <td>
                  <button type="button" class="btn btn-sm btn-warning rounded-pill my-border-btn"
                    data-bs-toggle="modal" data-bs-target="#modalEditJadwal">Edit</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEditJadwal" tabindex="-1" aria-labelledby="modalEditJadwalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content border border-dark">
      <div class="modal-body">
        <div class="d-grid gap-2">
          <a href="/dadmin/jadwalMenu/1/family" class="btn btn-primary rounded-pill my-border-btn d-block" role="button">Family Pack</a>
          <a href="/dadmin/jadwalMenu/1/personal" class="btn btn-primary rounded-pill my-border-btn d-block" role="button">Personal Pack</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>