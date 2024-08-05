<?php echo $this->extend('layout/user/template_login.php'); ?>

<?php echo $this->section('content'); ?>
<nav class="navbar my-nav p-2 mb-5 bg-body-tertiary my-bg-purplelight">
  <div class="container-fluid justify-content-center flex-column">
    <a class="navbar-brand text-center" href="homepage.html">
      <img src="/assets/img/logo-big.jpg" alt="logo_kawa_healthy.jpg" class="rounded-circle">
      <h6 class="text-center mt-2 m-0 lh-base">KAWA HEALTHY</h6>
    </a>
  </div>
</nav>

<div class="d-flex justify-content-center content-daftar">
  <ul class="list-group border border-black mb-5" style="width: 300px;">
    <li
      class="list-group-item my-bg-purple border border-0 text-center fw-medium p-3">
      PENDAFTARAN AKUN
    </li>
    <li class="list-group-item">
      <form action="" class="mt-3 mb-3">
        <div class="mb-3 lh-1">
          <label for="txtNama" class="form-label">Nama</label>
          <input type="text" class="form-control form-control-sm my-border-input" id="txtNama" required>
        </div>
        <div class="mb-3 lh-1">
          <label for="txtAlamat" class="form-label">Alamat</label>
          <input type="text" class="form-control form-control-sm my-border-input" id="txtAlamat" required>
        </div>
        <div class="mb-3 lh-1">
          <label for="selectKota" class="form-label">Kota</label>
          <select class="form-select form-select-sm my-border-input" id="selectKota" required>
            <option selected disabled value=""></option>
            <option value="1">Gresik</option>
            <option value="2">Surabaya</option>
          </select>
        </div>
        <div class="mb-3 lh-1">
          <label for="txtNomorHP" class="form-label">Nomor HP</label>
          <input type="number" class="form-control form-control-sm my-border-input" id="txtNomorHP" required>
        </div>
        <div class="mb-3 lh-1">
          <label for="txtEmail" class="form-label">Email</label>
          <input type="email" class="form-control form-control-sm my-border-input" id="txtEmail" required>
        </div>
        <div class="mb-3 lh-1">
          <label for="txtUsername" class="form-label">Username</label>
          <input type="text" class="form-control form-control-sm my-border-input" id="txtUsername" required>
        </div>
        <div class="mb-4 lh-1">
          <label for="txtPassword" class="form-label">Password</label>
          <input type="password" class="form-control form-control-sm my-border-input" id="txtPassword" required>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
          <button type="submit" class="btn btn-md my-btn-purpledark my-border-btn rounded-pill fw-medium">Daftar</button>
        </div>
      </form>
    </li>
  </ul>
</div>
<?php echo $this->endSection(); ?>