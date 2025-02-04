<?php echo $this->extend('layout/user/template'); ?>

<?php echo $this->section('content'); ?>

<?php echo $this->include('layout/user/navbar.php'); ?>

<div class="content content-pesananku container">
  <div class="row pt-4">
    <div class="col text-center">
      <h6>PESANAN KU</h6>
    </div>
  </div>
  <div class="d-flex justify-content-center">
    <ul class="list-group nav-tab list-group-horizontal text-center ">
      <a href="/pesananKu" class="list-group-item border border-0 list-group-item-action <?php echo $tabPesananKu == "pesananKu" ? "my-active-tab" : ""; ?>">
        PesananKu
      </a>
      <a href="/pesananDatang" class="list-group-item border border-0 list-group-item-action <?php echo $tabPesananKu == "pesananDatang" ? "my-active-tab" : ""; ?>">
        Akan Datang
      </a>
      <a href="/pesananSelesai" class="list-group-item border border-0 list-group-item-action <?php echo $tabPesananKu == "pesananSelesai" ? "my-active-tab" : ""; ?>">
        Pesanan Selesai
      </a>
    </ul>
  </div>
  <div class="mt-5">
    <div class="table-content">
      <table class="table table-hover table-sm table-borderless mb-0">
        <thead>
          <tr class="text-center">
            <td scope="col">Tanggal Transaksi</td>
            <td scope="col">Menu Tanggal</td>
            <td scope="col">Paketan</td>
            <td scope="col">Total Harga</td>
            <td scope="col">Aksi</td>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($dataPesananPaketan) && empty($dataPesananBiasa)) : ?>
            <tr class="text-center align-middle">
              <td colspan="5">
                <div class="card my-bg-pinklight border border-black InfoDaftarPesanan" style="display: block;">
                  <div class="card-body text-center">
                    <span class="fs-5">Kamu Belum Pesanan Apapun</span>
                    <br>
                    <a class="btn btn-link my-text-purpledark" href="/" role="button">Pesan Dulu Yuk!</a>
                  </div>
                </div>
              </td>
            </tr>
          <?php endif; ?>
          <?php foreach ($dataPesananPaketan as $index => $data) : ?>
            <tr class="text-center align-middle">
              <td><?php echo formatTanggal($data['tanggal_transaksi'], false, false, true); ?></td>
              <td>
                <p class="m-0 lh-1 fw-normal">Tanggal Mulai</p>
                <?php echo formatTanggal($data['tanggal_menu']); ?>
              </td>
              <td><?php echo (empty($data['periode_hari_baru']) ? $data['periode_hari_paketan'] : $data['periode_hari_baru']); ?> Hari<br>(Berjalan <?php echo (!empty($data['pesanan_terkirim']) ? $data['pesanan_terkirim'] : "0"); ?> hari)</td>
              <td>Rp. <?php echo $data['total_harga']; ?></td>
              <td>
                <a class="btn btn-sm my-btn-orange my-border-btn rounded-pill fw-medium lh-1" href="/pesananDetailPaketan/<?php echo $data['id_pesanan']; ?>" role="button">Detail</a>
                <?php if ($data['approved'] == "y" || $data['approved'] == NULL) : ?>
                  <?php if (empty($data['berhenti_paketan'])) : ?>
                    <button type="button" data-idPesanan="<?php echo $data['id_pesanan']; ?>" data-indexBaris="<?php echo $index + 1; ?>" class="btn btn-sm btn-light my-border-btn rounded-pill fw-medium lh-1 btnBerhentiPaketan" data-bs-toggle="modal" data-bs-target="#modalBerhentiPaketan">
                      Berhenti
                    </button>
                  <?php else : ?>
                    <span class="badge text-bg-danger">Berhenti</span>
                  <?php endif; ?>
                <?php endif; ?>
                <?php if ($data['approved'] == "n") : ?>
                  <span class="badge text-bg-danger">Di Tolak</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
          <?php foreach ($dataPesananBiasa as $index => $data) : ?>
            <tr class="text-center align-middle">
              <td><?php echo formatTanggal($data['tanggal_transaksi'], false, false, true); ?></td>
              <td><?php echo formatTanggal($data['tanggal_menu']); ?></td>
              <td>-</td>
              <td>Rp. <?php echo $data['total_semua_harga']; ?></td>
              <td class="text-end">
                <a class="btn btn-sm my-btn-orange my-border-btn rounded-pill fw-medium lh-1" href="/pesananDetailBiasa/<?php echo $data['id_pesanan']; ?>/<?php echo $data['id_jadwal_menu']; ?>" role="button">Detail</a>
                <?php if ($data['batal'] != "b") : ?>
                  <button type="button" class="btn btn-sm btn-light my-border-btn rounded-pill fw-medium lh-1 btnBatalPesanan" data-idJadwalMenu="<?php echo $data['id_jadwal_menu']; ?>" data-idPesanan="<?php echo $data['id_pesanan']; ?>" data-indexBaris="<?php echo $index + 1; ?>" data-bs-toggle="modal" data-bs-target="#modalBatalPesan">
                    Batal
                  </button>
                <?php else : ?>
                  <span class="badge text-bg-danger">Di Batalkan</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Batal-->
<div class="modal fade modal-sm" id="modalBatalPesan" tabindex="-1" aria-labelledby="modalBatalPesanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border border-dark">
      <div class="modal-header justify-content-center my-bg-green">
        <h1 class="modal-title fs-5" id="modalBatalPesanLabel">Konfirmasi</h1>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col text-center">
            <span>Yakin Ingin<br>Membatalkan Pesanan ?</span>
            <div class="row mt-4">
              <div class="col d-grid">
                <button type="button" class="btn my-btn-green my-border-btn rounded-pill" id="modalBtnBatal">iya</button>
              </div>
              <div class="col d-grid">
                <button type="button" class="btn btn-light my-border-btn rounded-pill" data-bs-dismiss="modal">tidak</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Berhenti-->
<div class="modal fade modal-sm" id="modalBerhentiPaketan" tabindex="-1" aria-labelledby="modalBerhentiPaketanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border border-dark">
      <div class="modal-header justify-content-center my-bg-green">
        <h1 class="modal-title fs-5" id="modalBerhentiPaketanLabel">Konfirmasi</h1>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col text-center">
            <span>Yakin Ingin<br>Berhenti Paketan ?</span>
            <div class="row mt-4">
              <div class="col d-grid">
                <button type="button" class="btn my-btn-green my-border-btn rounded-pill" id="modalBtnBerhentiPaketan">iya</button>
              </div>
              <div class="col d-grid">
                <button type="button" class="btn btn-light my-border-btn rounded-pill" data-bs-dismiss="modal">tidak</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php echo $this->endSection(); ?>