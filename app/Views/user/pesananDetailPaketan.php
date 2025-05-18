<?php echo $this->extend('layout/user/template'); ?>

<?php echo $this->section('content'); ?>

<?php echo $this->include('layout/user/navbar.php'); ?>

<div class="content content-detail-pesanan-p container mb-5">
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
    <ul class="list-group data-pesanan mx-auto">
      <li class="list-group-item boder border-0 border-top border-bottom border-black rounded-0 lh-sm p-1">
        <div class="row">
          <div class="col-md-5">
            <p><span class="fw-bold">
                Paket Menu<br>
                <?php foreach ($catatanPaketMenu as $data) : ?>
                  <?php echo ($data['nama_paket_menu'] == "infuse") ? "+" : ""; ?>
                  <?php echo $data['nama_paket_menu']; ?>
                <?php endforeach; ?>
            </p>
            <p><span class="fw-bold">Harga: </span><?php echo formatRupiah($totalHargaPaketan['total_harga']); ?>(+ongkir)</p>
            <?php if (!empty($catatanPaketan['id_karbo'])) : ?>
              <p><span class="fw-bold">Karbo: </span><?php echo $catatanPaketan['nama_karbo']; ?></p>
            <?php endif; ?>
            <p><span class="fw-bold">Pantangan: </span><?php echo $catatanPaketan['pantangan_paketan']; ?></p>
          </div>
          <div class="col-auto">
            <p><span class="fw-bold">Tanggal Transaksi: </span><?php echo formatTanggal($catatanPaketan['tanggal_transaksi'], false, false, true); ?></p>
            <p><span class="fw-bold">Tanggal Mulai: </span><?php echo formatTanggal($catatanPaketan['tanggal_mulai_pesanan'], false, false, true); ?></p>
            <p><span class="fw-bold">Paketan: </span><?php echo (empty($catatanPaketan['periode_hari_baru']) ? $catatanPaketan['periode_hari_paketan'] : $catatanPaketan['periode_hari_baru']); ?> Hari (<?php echo (!empty($pesananTerkirim['pesanan_terkirim']) ? $pesananTerkirim['pesanan_terkirim'] : 0); ?> hari terlewat)</p>
            <?php if ($catatanPaketan['approved'] == "y") : ?>
              <?php if ((empty($catatanPaketan['periode_hari_baru']) ? $catatanPaketan['periode_hari_paketan'] : $catatanPaketan['periode_hari_baru']) > 1) : ?>
                <?php if ($catatanPaketan['berhenti_paketan'] != "y") : ?>
                  <?php if ((empty($catatanPaketan['periode_hari_baru']) ? $catatanPaketan['periode_hari_paketan'] : $catatanPaketan['periode_hari_baru']) - (!empty($pesananTerkirim['pesanan_terkirim']) ? $pesananTerkirim['pesanan_terkirim'] : 0) != 1) : ?>
                    <button type="button" data-idPesanan="<?php echo $catatanPaketan['id_pesanan']; ?>" data-idCatatanPesanan="<?php echo $catatanPaketan['id_catatan_pesanan']; ?>" class="btn btn-sm my-btn-orange my-border-btn rounded-pill fw-medium lh-1 mt-1" data-bs-toggle="modal" data-bs-target="#modalGantiMasa">
                      Ganti Masa Hari
                    </button>
                  <?php endif; ?>
                <?php endif; ?>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
      </li>
    </ul>
    <?php if ($catatanPaketan['berhenti_paketan'] == "y") : ?>
      <p class="lh-1 mt-3 fw-bold text-danger text-center">PESANAN DIBATALKAN</p>
    <?php endif; ?>
    <ul class="list-group list-pesanan border border-black mt-3 mx-auto">
      <li class="list-group-item text-center">Jadwal</li>
      <?php foreach ($dataPesananPaketan as $index => $data) : ?>
        <li class="list-group-item" data-indexBaris="<?php echo $index + 1; ?>">
          <div class="row flex-wrap align-items-center">
            <div class="col-auto text-center">
              <?php echo formatTanggal($data['tanggal_menu']); ?><br>
              <?php if ($catatanPaketan['approved'] == "y") : ?>
                <?php if ($data['id_status_pesanan'] == 2 || $data['berhenti_paketan'] == "y") : ?>
                  <?php if (!empty($data['jumlah_tunda'])) : ?>
                    <span class="text-primary">Ditunda</span>
                  <?php else : ?>
                    <?php if ($data['berhenti_paketan'] == "y") : ?>
                      <span class="text-danger">Berhenti Paketan</span>
                    <?php else : ?>
                      <button type="button" data-idPesanan="<?php echo $catatanPaketan['id_pesanan']; ?>" data-idMenuPesanan="<?php echo $data['id_menu_pesanan']; ?>" data-indexBaris="<?php echo $index + 1; ?>" class="btn btn-sm my-btn-orange my-border-btn rounded-pill lh-1 mt-1 btnTunda" data-bs-toggle="modal" data-bs-target="#modalTundaPesanan">
                        Tunda
                      </button>
                    <?php endif; ?>
                  <?php endif; ?>
                <?php elseif ($data['id_status_pesanan'] == 5) : ?>
                  <span class="text-success">Dikirim</span>
                <?php elseif ($data['id_status_pesanan'] == 6) : ?>
                  <span class="text-success">Selesai</span>
                <?php endif; ?>
              <?php endif; ?>
            </div>
            <div class="col">
              <?php foreach ($dataDetailPesananPaketan as $detail) : ?>
                <?php if ($data['tanggal_menu'] == $detail['tanggal_menu']) : ?>
                  <p class="fw-bold lh-1 m-0"><?php echo $detail['nama_paket_menu']; ?></p>
                  <?php echo $detail['nama_menu']; ?>
                  <?php if ($detail['nama_paket_menu'] == null) : ?>
                    + infuse
                  <?php endif; ?>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </div>
        </li>
      <?php endforeach; ?>
      <!-- <li class="list-group-item">
        <div class="row flex-wrap align-items-center">
          <div class="col-auto text-center">
            Selasa 2 Januari<br>
            <span class="badge text-bg-success border border-black">Selesai</span>
          </div>
          <div class="col">
            N.merah, ayam cicane, oseng wortel pokcoy, sambal belimbing
            <hr class="mt-2 mb-2">
            <p class="m-0 text-decoration-underline">Review</p>
            <p class="m-0">Rasanya enak pas, cocok dah</p>
          </div>
        </div>
      </li>
      <li class="list-group-item">
        <div class="row flex-wrap align-items-center">
          <div class="col-auto text-center">
            Selasa 2 Januari<br>
            <button type="button" class="btn btn-sm my-btn-orange my-border-btn rounded-pill lh-1 mt-1" data-bs-toggle="modal" data-bs-target="#modalTundaPesanan">
              Tunda
            </button>
          </div>
          <div class="col">
            N.merah, ayam cicane, oseng wortel pokcoy, sambal belimbing
          </div>
        </div>
      </li> -->
      <li class="list-group-item">
        <div class="row">
          <div class="col text-center">
            <?php
            $sisa = 0;
            if ($sisaPesananPaketan['sisa_pesanan_paketan'] >= 0) {
              if (!empty($catatanPaketan['jumlah_tunda'])) {
                $sisa = $sisaPesananPaketan['sisa_pesanan_paketan'] + $catatanPaketan['jumlah_tunda'];
              } else {
                $sisa = $sisaPesananPaketan['sisa_pesanan_paketan'];
              }
            } else if ($sisaPesananPaketan['sisa_pesanan_paketan'] < 0) {
              $sisa = 0;
            } else {
              if (!empty($catatanPaketan['jumlah_tunda'])) {
                $sisa = 0 + $catatanPaketan['jumlah_tunda'];
              } else {
                $sisa = 0;
              }
            }
            ?>
            Sisa <?php echo $sisa; ?> Hari (Menu Sesuai Jadwal Menu)<br>
            <p class="m-0 lh-1 fw-normal">Belum Ada Jadwal Menu Baru</p>
          </div>
        </div>
      </li>
    </ul>
  </div>
</div>

<!-- Modal Tunda-->
<div class="modal fade modal-sm" id="modalTundaPesanan" tabindex="-1" aria-labelledby="modalTundaPesananLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border border-dark">
      <div class="modal-header justify-content-center my-bg-green">
        <h1 class="modal-title fs-5" id="modalTundaPesananLabel">Konfirmasi</h1>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col text-center">
            <span>Pesanan Otomatis Akan<br>Dipindahkan Ke Jadwal Berikutnya,<br>Yakin Ingin Menunda Pesanan ?</span>
            <div class="row mt-4">
              <div class="col d-grid">
                <button type="button" class="btn btn-sm lh-sm my-btn-green my-border-btn rounded-pill" id="modalBtnTunda">iya</button>
              </div>
              <div class="col d-grid">
                <button type="button" class="btn btn-sm lh-sm btn-light my-border-btn rounded-pill" data-bs-dismiss="modal">tidak</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Ganti Masa Hari-->
<div class="modal fade modal-sm" id="modalGantiMasa" tabindex="-1" aria-labelledby="modalGantiMasaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border border-dark">
      <div class="modal-header justify-content-center my-bg-green">
        <h1 class="modal-title fs-5" id="modalGantiMasaLabel">Ganti Masa Hari</h1>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col text-center">
            <div class="mb-3 lh-1">
              <div class="d-flex justify-content-center align-items-center">
                <label for="selectKota" class="form-label w-100 m-0">Jumlah Hari</label>
                <input type="number" oninput="validity.valid||(value='');" class="form-control qtyMenu" min="<?php echo (!empty($pesananTerkirim['pesanan_terkirim']) ? $pesananTerkirim['pesanan_terkirim'] : 0) + 1; ?>" max="<?php echo (empty($catatanPaketan['periode_hari_baru']) ? $catatanPaketan['periode_hari_paketan'] : $catatanPaketan['periode_hari_baru']) - 1; ?>" value="<?php echo (!empty($pesananTerkirim['pesanan_terkirim']) ? $pesananTerkirim['pesanan_terkirim'] : 0) + 1; ?>">
              </div>
            </div>
            <div class="row mt-4">
              <div class="col">
                <button type="button" class="btn btn-sm lh-sm my-btn-green my-border-btn rounded-pill px-4" id="btnGantiMasaHari">Update Masa hari</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php echo $this->endSection(); ?>