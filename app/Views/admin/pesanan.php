<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content content-pesanan fw-medium">
    <div class="mt-4">
      <div class="row">
        <div class="col text-center">Data Pesanan</div>
      </div>
      <div class="row mt-3">
        <div class="col text-center d-flex justify-content-center">
          <ul class="list-group list-group-horizontal">
            <a href="/dadmin/pesanan" class="list-group-item border border-0 list-group-item-action <?php echo $tabPesanan == "pesananMasuk" ? "my-active" : ""; ?>" style="width: max-content;">
              Pesanan Masuk
            </a>
            <a href="/dadmin/pesananBatal" class="list-group-item border border-0 list-group-item-action <?php echo $tabPesanan == "pesananBatal" ? "my-active" : ""; ?>" style="width: max-content;">
              Pesanan Batal
            </a>
            <a href="/dadmin/pesananRiwayat" class="list-group-item border border-0 list-group-item-action <?php echo $tabPesanan == "pesananRiwayat" ? "my-active" : ""; ?>" style="width: max-content;">
              Riwayat Pesanan
            </a>
          </ul>
        </div>
      </div>
      <div class="table-responsive m-4">
        <table class="table my-table-admin table-hover mt-3">
          <thead>
            <tr class="align-middle">
              <td class="text-center" scope="col">Menu Tanggal</td>
              <td class="text-center" scope="col">Menu</td>
              <td class="text-center" scope="col">Jenis Pack</td>
              <td class="text-center" scope="col">Jenis Karbo</td>
              <td class="text-center" scope="col">Aksi</td>
            </tr>
          </thead>
          <tbody>
            <tr class="align-middle">
              <td class="text-center">Selasa 2 Januari</td>
              <td>
                <ul class="list-group">
                  <li class="list-group-item align-items-center">
                    nasi
                    <span class="badge text-bg-warning rounded-pill border border-black">14</span>
                  </li>
                  <li class="list-group-item align-items-center">
                    kangkung fefaf e aef aef a
                    <span class="badge text-bg-warning rounded-pill border border-black">2</span>
                  </li>
                  <li class="list-group-item align-items-center">
                    bayam
                    <span class="badge text-bg-warning rounded-pill border border-black">1</span>
                  </li>
                </ul>
              </td>
              <td class="text-center">
                <ul class="list-group">
                  <li class="list-group-item align-items-center">
                    Family Pack
                    <span class="badge text-bg-warning rounded-pill border border-black">14</span>
                  </li>
                  <li class="list-group-item align-items-center">
                    Personal Pack
                    <span class="badge text-bg-warning rounded-pill border border-black">2</span>
                  </li>
                </ul>
              </td>
              <td class="text-center">
                <ul class="list-group">
                  <li class="list-group-item align-items-center">
                    Nasi Merah
                    <span class="badge text-bg-warning rounded-pill border border-black">14</span>
                  </li>
                </ul>
              </td>
              <td>
                <a class="btn btn-sm btn-primary rounded-pill my-border-btn lh-md" href="/dadmin/pesananDetail" role="button">Lihat Detail Menu</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>