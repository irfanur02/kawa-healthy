<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content content-riwayat-pesanan fw-medium">
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
      <div class="table-responsive-lg m-4">
        <table class="table my-table-admin table-hover mt-3">
          <thead>
            <tr class="align-middle">
              <td class="text-center" scope="col">Menu Tanggal</td>
              <td class="text-center" scope="col">Pelanggan</td>
              <td class="text-center" scope="col">Alamat</td>
              <td class="text-center" scope="col">Menu</td>
              <td class="text-center" scope="col">Total Harga</td>
              <td class="text-center" scope="col">Aksi</td>
            </tr>
          </thead>
          <tbody class="fw-normal">
            <tr class="align-middle">
              <td class="text-center">Selasa 2 Januari</td>
              <td class="text-center">Anis</td>
              <td>Jl. nanas no.22 kel. peneleh kec. genteng gresik</td>
              <td>
                <ul class="list-group">
                  <li class="list-group-item align-items-center">
                    nasi merah ayam bakar suwir
                    <span class="badge text-bg-warning rounded-pill border border-black">14</span>
                  </li>
                  <li class="list-group-item align-items-center">
                    Kangkung
                    <span class="badge text-bg-warning rounded-pill border border-black">2</span>
                  </li>
                </ul>
              </td>
              <td class="text-center">Rp. 150000</td>
              <td class="text-center">
                <button type="button" class="btn btn-sm btn-primary rounded-pill my-border-btn" data-bs-toggle="modal"
                  data-bs-target="#modalLihatGambar">Lihat Bukti Transfer</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- modal lihat gambar -->
<div class="modal fade modal-md" id="modalLihatGambar" tabindex="-1" aria-labelledby="modalLihatGambarLabel"
aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border border-dark">
      <div class="modal-header justify-content-center" style=" background-color: #055160; color: white;">
        <h1 class="modal-title fs-5" id="modalLihatGambarLabel">Konfirmasi</h1>
      </div>
      <div class="modal-body text-center">
        <img src="logo-big.jpg" class="border rounded" alt="..." style="width: 100%">
      </div>
      <div class="container mb-3 text-center">
        <button type="button" class="btn btn-light my-border-btn rounded-pill" style="padding: 0 3em 0 3em;" data-bs-dismiss="modal">tutup</button>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>