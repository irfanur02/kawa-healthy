<table class="table my-table-admin table-hover text-center" style="width: fit-content; margin: 0 auto;">
  <caption class="caption-top text-center fw-bold text-black">Riwayat Jadwal Family Pack</caption>
  <thead>
    <tr class="align-middle">
      <td scope="col" style="padding: .5em 30px .5em 30px;">Tanggal Mulai</td>
      <td scope="col" style="padding: .5em 30px .5em 30px;">Tanggal Akhir</td>
      <td scope="col" style="padding: .5em 30px .5em 30px;">Aksi</td>
    </tr>
  </thead>
  <div id="dataTableJadwalMenu">
    <tbody>
      <?php foreach ($dataJadwalMenu as $data) : ?>
        <tr class="align-middle">
          <td><?php echo $data['tanggal_mulai']; ?></td>
          <td><?php echo $data['tanggal_akhir']; ?></td>
          <td>
            <a href="/dadmin/jadwal/<?php echo $data['id_jadwal']; ?>/<?php echo $dataPack; ?>" role="button" class="btn btn-sm btn-warning rounded-pill my-border-btn">Edit</buttaon>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </div>
</table>