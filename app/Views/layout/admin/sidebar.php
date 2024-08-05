<div class="toggleMenu dropdownMenu">
  <div class="my-sidebar">
    <div class="list-group">
      <a href="/dadmin/dashboard" class="list-group-item my-list-sidebar list-group-item-action fw-medium <?php echo $sidebar == 'dashboard' ? "my-active" : ""; ?>" aria-current="true">
        Dashboard
      </a>
      <a href="/dadmin/pesanan" class="list-group-item my-list-sidebar list-group-item-action <?php echo $sidebar == 'pesanan' ? "my-active" : ""; ?>">Lihat Pesanan</a>
      <a href="/dadmin/review" class="list-group-item my-list-sidebar list-group-item-action <?php echo $sidebar == 'lihatReview' ? "my-active" : ""; ?>">Lihat Review</a>
      <a href="/dadmin/menu" class="list-group-item my-list-sidebar list-group-item-action <?php echo $sidebar == 'kelolaMenu' ? "my-active" : ""; ?>">Kelola
        Menu</a>
      <a href="/dadmin/paketMenu" class="list-group-item my-list-sidebar list-group-item-action <?php echo $sidebar == 'kelolaPaketMenu' ? "my-active" : ""; ?>">Kelola
        Paket Menu</a>
      <a href="/dadmin/jadwalMenu"
        class="list-group-item list-group-item-action my-list-sidebar <?php echo $sidebar == 'kelolaJadwalMenu' ? "my-active" : ""; ?>">Kelola
        Jadwal Menu</a>
      <a href="/dadmin/biayaOngkir" class="list-group-item my-list-sidebar list-group-item-action <?php echo $sidebar == 'kelolaBiayaOngkir' ? "my-active" : ""; ?>">Kelola
        Biaya Ongkir</a>
      <a href="/dadmin/laporan" class="list-group-item my-list-sidebar list-group-item-action <?php echo $sidebar == 'laporan' ? "my-active" : ""; ?>">Laporan</a>
    </div>
  </div>
</div>