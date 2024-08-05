<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>
  
  <div class="my-content content-dashboard fw-medium">
    <div class="mt-4">
      <div class="row">
        <div class="col text-center">Dashboard</div>
      </div>
      <div class="row">
        <div class="col text-center mt-3">Pesanan Siap Kirim</div>
        <div class="container">
          <div class="d-flex justify-content-center mt-1">
            <ul class="list-group border list-pesanan">
              <li class="list-group-item">
                <div class="row">
                  <div class="col">
                    <div class="row d-flex justify-content-between">
                      <p class="col-auto my-0 text-center align-top"><span class="fw-bold">Pelanggan</span><br>Agus<br>( 08123456789 )</p>
                      <p class="col my-0 align-top"><span class="fw-bold">Alamat<br></span>Jl. nanas no.22 kel. peneleh kec. genteng gresik</p>
                    </div>
                    <table class="table table-sm my-full-border table-hover mt-3">
                      <thead>
                        <tr class="align-middle">
                          <td class="text-center" scope="col">Menu</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="fw-normal d-flex align-items-center grid gap-2">
                            <div class="lh-1 d-inline-flex flex-column">Bayam Wortel<br><span class="fw-bold">Pedas</span></div>
                            <div>
                              <span class="badge text-bg-warning rounded-pill border border-black">2</span>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="fw-normal d-flex align-items-center grid gap-2">
                            <div class="lh-sm d-inline-flex flex-column">Kangkung</div>
                            <div>
                              <span class="badge text-bg-warning rounded-pill border border-black">2</span>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="fw-medium d-flex align-items-center grid gap-2">
                            <div class="lh-1 d-inline-flex flex-column">
                              <span class="fw-bold">Paket Lunch</span>
                              nasi merah ayam bakar suwir<br>
                              <span class="fw-bold">Karbo: Nasi Merah</span>
                              <span class="fw-bold">Pantangan: -</span>
                            </div>
                            <div>
                              <span class="badge text-bg-warning rounded-pill border border-black">2</span>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row">
                  <div class="col">
                    <div class="row d-flex justify-content-between">
                      <p class="col-auto my-0 text-center align-top"><span class="fw-bold">Pelanggan</span><br>Agus<br>( 08123456789 )</p>
                      <p class="col my-0 align-top"><span class="fw-bold">Alamat<br></span>Jl. nanas no.22 kel. peneleh kec. genteng gresik</p>
                    </div>
                    <table class="table table-sm my-full-border table-hover mt-3">
                      <thead>
                        <tr class="align-middle">
                          <td class="text-center" scope="col">Menu</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="fw-normal d-flex align-items-center grid gap-2">
                            <div class="lh-1 d-inline-flex flex-column">Bayam Wortel<br><span class="fw-bold">Pedas</span></div>
                            <div>
                              <span class="badge text-bg-warning rounded-pill border border-black">2</span>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="fw-normal d-flex align-items-center grid gap-2">
                            <div class="lh-sm d-inline-flex flex-column">Kangkung</div>
                            <div>
                              <span class="badge text-bg-warning rounded-pill border border-black">2</span>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="fw-medium d-flex align-items-center grid gap-2">
                            <div class="lh-1 d-inline-flex flex-column">
                              <span class="fw-bold">Paket Lunch</span>
                              nasi merah ayam bakar suwir<br>
                              <span class="fw-bold">Karbo: Nasi Merah</span>
                              <span class="fw-bold">Pantangan: -</span>
                            </div>
                            <div>
                              <span class="badge text-bg-warning rounded-pill border border-black">2</span>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="mx-auto" style="width:fit-content;">
            <a class="btn btn-success rounded-pill my-border-btn mt-3 mx-auto lh-md" href="#" style="padding: .1em 2em;" role="button">Ok, Kirim</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>