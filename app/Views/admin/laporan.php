<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content">
    <div class="container mt-4 content-laporan">
      <div class="row">
        <div class="col text-center fw-bold">Laporan</div>
      </div>
      <div class="row mt-3 d-flex justify-content-center">
        <div class="col-auto text-center">
          <ul class="list-group">
            <li class="list-group-item border-0" style="padding: .1em;">
              <div class="fs-6 fw-bolder">Filter</div>
            </li>
            <li class="list-group-item border-0 m-auto" style="padding: .1em; width: fit-content;">
              <select class="form-select form-select-sm my-border-input fw-bolder" id="selectLaporan">
                <option selected value="periode">Per Periode</option>
                <option value="bulan">Per Bulan</option>
              </select>
            </li>
            <li class="list-group-item border-0 mt-3" id="filterPerPeriode">
              <div class="card border border-black">
                <div class="card-body fw-medium" style="padding: .3em">
                  <form action="" method="">
                    <div class="row mb-2">
                      <div class="col">
                        <span>Periode</span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col d-flex align-items-center">
                        <span style="width: 100%;">Tanggal Awal</span>
                        <input type="date" name="" class="form-control form-control-sm my-border-input">
                      </div>
                    </div>
                    <div class="row mt-1">
                      <div class="col d-flex align-items-center">
                        <span style="width: 100%;">Tanggal Akhir</span>
                        <input type="date" name="" class="form-control form-control-sm my-border-input">
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col d-grid gap-2 col-8 mx-auto">
                        <button type="submit" class="btn btn-primary btn-sm my-border-btn rounded-pill">Hitung</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="row" id="dataLaporan">
        <div class="col d-flex justify-content-center">
          <table class="table my-table-admin table-hover text-center mt-3" style="width: fit-content;">
            <thead>
              <tr class="align-middle">
                <td scope="col" style="padding: .5em 30px .5em 30px;">Tanggal</td>
                <td scope="col" style="padding: .5em 30px .5em 30px;">Pendapatan</td>
                <td scope="col" style="padding: .5em 30px .5em 30px;">Jumlah Jenis Pack</td>
              </tr>
            </thead>
            <tbody>
              <tr class="align-middle fw-medium">
                <td>1/1/2024</td>
                <td>Rp. 4.000.000</td>
                <td>
                  <span class="d-block">family pack: 10</span>
                  <span class="d-block">personal pack: 14</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>