<nav class="navbar my-nav bg-body-tertiary fixed-top my-bg-green" style="padding: .3em 0;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
      <img src="/assets/img/logo-mini.jpg" alt="Logo" width="33" height="33" class="d-inline-block align-text-top rounded-circle">
      <span class="fs-6 fw-medium text-white">KAWA HEALTHY</span>
    </a>
    <div class="justify-content-end">
      <?php if ($session->has('logged_in')) : ?>
        <a href="/daftarPesanan" class="btn btn-sm btn-light my-border-btn rounded-pill mx-1 fw-medium lh-sm" role="button">Daftar Pesanan</a>
        <a href="/pesananKu" class="btn btn-sm btn-light my-border-btn rounded-pill mx-1 fw-medium lh-sm" role="button">PesananKU</a>
        <div class="my-dropdown d-inline-block">
          <button type="button" class="btn btn-sm btn-light my-border-btn rounded-circle p-1 mx-1 fw-medium lh-1"><i class="bi bi-person-circle fs-3 m-0 p-0"></i></button>
          <div class="list-group my-dropdown-menu border border-black rounded w-auto">
            <button type="button" class="list-group-item list-group-item-action p-0 fw-medium" data-bs-toggle="modal" data-bs-target="#modalProfil" data-id="<?php echo $session->get('id_akun'); ?>" id="btnModalProfil" data-id-akun="<?php echo $session->get('id_akun'); ?>">Profil</button>
            <button type="button" class="list-group-item list-group-item-action p-0 fw-medium" id="logout">Keluar</button>
          </div>
        </div>
      <?php else : ?>
        <a href="/daftarAkun" target="_blank" class="btn btn-sm btn-light my-border-btn rounded-pill mx-1 fw-medium lh-sm" role="button">Daftar</a>
        <button type="button" class="btn btn-sm my-btn-orange my-border-btn rounded-pill mx-1 fw-medium lh-sm" data-bs-toggle="modal" data-bs-target="#modalLogin">Login</button>
      <?php endif; ?>
    </div>
  </div>
</nav>

<!-- modal profil -->
<div class="modal fade" id="modalProfil" tabindex="-1" aria-labelledby="modalProfilLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content border border-dark">
      <div class="modal-header justify-content-center my-bg-green">
        <h1 class="modal-title fs-5" id="modalProfilLabel">Profil</h1>
      </div>
      <div class="modal-body">
        <form class="">
          <input type="text" hidden name="idAkun">
          <input type="text" hidden name="idPelanggan">
          <div class="mb-3 lh-1">
            <label for="txtNama" class="form-label">Nama</label>
            <input type="text" class="form-control form-control-sm my-border-input" name="nama" id="txtNama" required>
          </div>
          <div class="mb-3 lh-1">
            <label for="txtAlamat" class="form-label">Alamat</label>
            <input type="text" class="form-control form-control-sm my-border-input" name="alamat" id="txtAlamat" required>
          </div>
          <div class="mb-3 lh-1">
            <label for="selectKota" class="form-label">Kota</label>
            <select class="form-select form-select-sm my-border-input" name="kota" id="selectKota" required>
              <option selected disabled value=""></option>
            </select>
          </div>
          <div class="mb-3 lh-1">
            <label for="txtNomorHP" class="form-label">Nomor HP</label>
            <input type="number" class="form-control form-control-sm my-border-input" name="notelp" id="txtNomorHP" required>
          </div>
          <div class="mb-3 lh-1">
            <label for="txtEmail" class="form-label">Email</label>
            <input type="email" class="form-control form-control-sm my-border-input" name="email" id="txtEmail" required>
          </div>
          <div class="mb-3 lh-1">
            <label for="txtUsername" class="form-label">Username</label>
            <input type="text" class="form-control form-control-sm my-border-input" name="username" id="txtUsername" required>
          </div>
          <div class="mb-4 lh-1">
            <label for="txtPassword" class="form-label">Password</label>
            <input type="password" class="form-control form-control-sm my-border-input" name="password" id="txtPassword" required>
          </div>
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-sm lh-sm px-4 my-btn-green my-border-btn rounded-pill">UPDATE</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- modal login -->
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content border border-dark">
      <div class="modal-header justify-content-center my-bg-green">
        <h1 class="modal-title fs-5" id="modalLoginLabel">LOGIN</h1>
      </div>
      <div class="modal-body">
        <form id="formLoginUser" class="">
          <div class="mb-3 lh-1">
            <label for="txtUsername" class="form-label">Username</label>
            <input type="text" class="form-control form-control-sm my-border-input" name="username" id="txtUsername" required>
            <div class="invalid-feedback invalid-username">
            </div>
          </div>
          <div class="mb-3 lh-1">
            <label for="txtPassword" class="form-label">Password</label>
            <input type="password" class="form-control form-control-sm my-border-input" name="password" id="txtPassword" required>
            <div class="invalid-feedback invalid-password">
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-sm lh-sm px-4 my-btn-orange my-border-btn rounded-pill" id="login">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>