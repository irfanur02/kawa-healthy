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
                <option value="pelanggan">Per Pelanggan</option>
                <option value="menu">Per Menu</option>
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
                        <input type="date" name="tanggalAwal" class="form-control form-control-sm my-border-input">
                      </div>
                    </div>
                    <div class="row mt-1">
                      <div class="col d-flex align-items-center">
                        <span style="width: 100%;">Tanggal Akhir</span>
                        <input type="date" name="tanggalAkhir" class="form-control form-control-sm my-border-input">
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
      <div class="row">
        <div class="col d-flex justify-content-center" id="dataLaporan">
          <table class="table my-table-admin table-hover text-center mt-3" style="width: fit-content;">
            <thead>
              <tr class="align-middle">
                <td scope="col" style="padding: .5em 30px .5em 30px;">Tanggal</td>
                <td scope="col" style="padding: .5em 30px .5em 30px;">Pendapatan</td>
                <td scope="col" style="padding: .5em 30px .5em 30px;">Aktifitas</td>
                <td scope="col" style="padding: .5em 30px .5em 30px;">Pembelian</td>
                <td scope="col" style="padding: .5em 30px .5em 30px;">Aksi</td>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($dataLaporan as $data) : ?>
                <tr class="align-middle fw-medium">
                  <td><?php echo formatTanggal($data['tanggal_menu'], false, false, true); ?></td>
                  <td>
                    <?php echo formatRupiah($data['total_harga_family'] + $data['total_harga_personal'] +
                                          $data['total_harga_infuse'] + $data['total_harga_ongkir']); ?>
                  </td>
                  <td>
                    <?php echo $data['jumlah_pelanggan']; ?> Pelanggan
                    <br>
                    <?php echo $data['jumlah_pesanan']; ?> Pesanan
                  </td>
                  <td>
                    <span class="d-block">family pack: <?php echo (!empty($data['jumlah_family']) ? $data['jumlah_family'] : "-"); ?></span>
                    <span class="d-block">personal pack: <?php echo (!empty($data['jumlah_personal']) ? $data['jumlah_personal'] : "-"); ?></span>
                    <span class="d-block">infuse: <?php echo $data['jumlah_infuse']; ?></span>
                  </td>
                  <td>
                    <button class="btn p-0 px-1 btn-sm btn-outline-dark rounded-pill my-border-btn btnDetailAktifitas" data-laporan="periode" data-bs-toggle="modal" data-bs-target="#modalDetailAktifitas" data-tanggal="<?php echo $data['tanggal_menu']; ?>">lihat detail</button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- Modal lihat detail aktifitas-->
      <div class="modal fade" id="modalDetailAktifitas" tabindex="-1" aria-labelledby="modalDetailAktifitasLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
          <div class="modal-content border border-dark">
            <div class="modal-header justify-content-center" style=" background-color: #055160; color: white;">
              <h1 class="modal-title fs-5 text-center" id="modalDetailAktifitasLabel">
              </h1>
            </div>
            <div class="modal-body">
              <div class="d-flex justify-content-center" id="laporanAktifitas">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>