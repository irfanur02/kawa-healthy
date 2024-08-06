<?php echo $this->extend('layout/admin/template_login.php'); ?>

<?php echo $this->section('content'); ?>
<nav class="navbar shadow p-2 mb-5 bg-body-tertiary rounded">
  <div class="container-fluid justify-content-center flex-column">
    <img src="/assets/img/logo-big.jpg" alt="logo_kawa_healthy.jpg" class="rounded-circle">
    <h6 class="text-center mt-2 m-0 lh-base my-text-main">KAWA HEALTHY</br>ADMIN</h6>
  </div>
</nav>

<div class="d-flex justify-content-center">
  <ul class="list-group border border-black" style="width: 300px;">
    <li
      class="list-group-item my-bg-main border border-0 text-center fw-normal">
      FORM LOGIN
    </li>
    <li class="list-group-item">
      <form action="/dadmin/authLogin" method="post" class="mt-4 mb-4">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
          <label for="txtUsernameAdmin" class="form-label">Username</label>
          <input type="text" class="form-control my-border-input <?php echo session()->getFlashdata('dataLogin') == "username" ? "is-invalid" : ""; ?>" <?php echo session()->getFlashdata('dataLogin') == "username" ? "autofocus" : ""; ?> name="username" id="txtUsernameAdmin" value="<?php echo old('username'); ?>" required>
          <?php if (session()->getFlashdata('dataLogin') == "username"): ?>
            <div class="invalid-feedback">
              Username tidak ada
            </div>
          <?php endif; ?>
        </div>
        <div class="mb-4">
          <label for="txtPasswordAdmin" class="form-label">Password</label>
          <input type="password" class="form-control my-border-input <?php echo session()->getFlashdata('dataLogin') == "password" ? "is-invalid" : ""; ?>" <?php echo session()->getFlashdata('dataLogin') == "password" ? "autofocus" : ""; ?> name="password" id="txtPasswordAdmin" required>
          <?php if (session()->getFlashdata('dataLogin') == "password"): ?>
            <div class="invalid-feedback">
              Password salah
            </div>
          <?php endif; ?>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
          <button type="submit" class="btn btn-md my-btn-main my-border-btn rounded-pill">Masuk</button>
        </div>
      </form>
    </li>
  </ul>
</div>
<?php echo $this->endSection(); ?>