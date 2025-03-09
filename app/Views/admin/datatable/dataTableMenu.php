<table class="table my-table-admin table-hover text-center mt-3">
  <thead>
    <tr class="align-middle">
      <td scope="col">No.</td>
      <td scope="col">Nama Menu</td>
      <td scope="col">Jenis Pack</td>
      <td scope="col">Nama Paket Menu</td>
      <td scope="col">Harga</td>
      <td scope="col">Aksi</td>
    </tr>
  </thead>
  <tbody id="dataTableMenu">
    <?php $no = $no;
    foreach ($dataMenu as $data) : ?>
      <tr class="align-middle text-wrap">
        <td scope="row"><?php echo $no++; ?>.</td>
        <td class="text-start"><img src="/assets/img/menu/<?php echo $data['gambar_menu']; ?>" class="gambar-menu lihatFotoMenu" alt="..." data-bs-toggle="modal" data-bs-target="#modalLihatFotoMenu"><?php echo $data['nama_menu']; ?></td>
        <td><?php echo $data['nama_pack'] != NULL ? $data['nama_pack'] : "-"; ?></td>
        <td><?php echo $data['nama_paket_menu'] != NULL ? $data['nama_paket_menu'] : "-"; ?></td>
        <td><?php echo $data['harga_menu'] != NULL ? "Rp. " . $data['harga_menu'] : "-"; ?></td>
        <td>
          <a class="btn btn-sm btn-warning rounded-pill my-border-btn" href="/dadmin/menu/edit/<?php echo $data['id_menu']; ?>" role="button">Edit
          </a>
          <button type="button" data-id="<?php echo $data['id_menu']; ?>" class="btn btn-sm btn-danger rounded-pill my-border-btn btnModalHapusMenu" data-bs-toggle="modal" data-bs-target="#modalHapusMenu">Hapus</button>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
<nav id="paginationTabelMenu" style="color: black;">
  <ul class="pagination pagination-sm">
    <li class="page-item border border-black">
      <button class="page-link btnPrev" style="color: black;" data-halamanAktif="<?php echo ($halamanAktif != 1) ? ($halamanAktif - 1) : ""; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </button>
    </li>
    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
      <li class="page-item border border-black"><button class="page-link btnLinkNumber <?php echo ($halamanAktif == $i) ? "active-page" : ""; ?>" style="color: black;" data-halaman="<?php echo $i; ?>"><?php echo $i; ?></button></li>
    <?php endfor; ?>
    <li class="page-item border border-black">
      <button class="page-link btnNext" style="color: black;" data-halamanAktif="<?php echo ($halamanAktif != $jumlahHalaman) ? ($halamanAktif + 1) : ""; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </button>
    </li>
  </ul>
</nav>