<?php echo $this->extend('layout/admin/template.php'); ?>

<?php echo $this->section('content'); ?>
<div class="my-template-area">

  <?php echo $this->include('layout/admin/navbar'); ?>

  <?php echo $this->include('layout/admin/sidebar'); ?>

  <div class="my-content">
    <div class="container mt-4 content-review-menu">
      <div class="row">
        <div class="col text-center fw-bold">Review Menu</div>
      </div>
      
      <div class="table-responsive">
        <table class="table my-table-admin table-hover text-center mt-3">
          <thead>
            <tr class="align-middle">
              <td scope="col">Nama</td>
              <td scope="col">Menu</td>
              <td scope="col">Review</td>
            </tr>
          </thead>
          <tbody>
            <tr class="align-middle">
              <td>abdi</td>
              <td class="text-start">
                <span class="d-block">-nasi</span>
                <span class="d-block">-mie goreng</span>
              </td>
              <td>enak</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>