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
            <?php foreach ($dataPelangganReview as $data) : ?>
              <tr class="align-middle">
                <td><?php echo $data['nama_pelanggan']; ?></td>
                <td class="text-start">
                  <?php foreach ($dataPesananPelanggan as $menu) : ?>
                    <?php if ($data['id_menu_pesanan'] == $menu['id_menu_pesanan']) : ?>
                      <ul class="list-unstyled m-0">
                        <li>
                          <ul>
                            <li><?php echo (!empty($menu['nama_menu']) ? $menu['nama_menu'] : "Infuse"); ?></li>
                          </ul>
                        </li>
                      </ul>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </td>
                <td><?php echo $data['keterangan_review']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection(); ?>