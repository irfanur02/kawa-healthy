$(document).ready(function() {

  // var base_url = "http://localhost:81/kawa-healthy/";
  // var base_url = "http://localhost:8080";
  var base_url = "https://orange-chimpanzee-880112.hostingersite.com";
  let eventSource = '';
  var jadwalNotifTanggal = false;
  var jadwalNotifMenu = false;

  $("#btnKirimPesanan").on("click", function() {
    var tanggalMenu = $(this).attr("data-tanggalMenu");

    $.ajax({
      url: base_url + '/dadmin/pesanan/kirim',
      type: 'POST',
      data: {
        tanggalMenu: tanggalMenu
      },
      dataType: 'json',
      success: function(response) {
          console.log(response);
      },
      error: function(xhr, status, error) {
          // Menangani kesalahan
          alert('Terjadi kesalahan saat mengupload!');
      }
    });
    location.reload();
  })

  // view paket menu
  $(".content-paket-menu #dataTablePaketMenu").on('click', '.btnModalEditPaketMenu', function() {
    var id = $(this).data('id');
    var namaPaket = $(this).parent().parent().find('td:nth-child(2)').text();
    var hargaPaket = $(this).parent().parent().find('td:nth-child(3)').text();
    hargaPaket = hargaPaket.split(' ');
    hargaPaket = hargaPaket[1];
    $("#modalEditPaketMenu .formPaketMenu").attr('action', '/dadmin/paketMenu/update/' + id);
    $("#modalEditPaketMenu input[name=namaPaketMenu]").val(namaPaket);
    $("#modalEditPaketMenu input[name=hargaPaketMenu]").val(hargaPaket);
  })

  $(".content-paket-menu #dataTablePaketMenu").on('click', '.btnModalHapusPaketMenu', function() {
    var id = $(this).data('id');
    $("#modalHapusPaketMenu form").attr('action', '/dadmin/paketMenu/delete/' + id);
  })

  $(".content-paket-menu #formCariPaketMenu input").on('keyup', function() {
    var keyword = $(this).val();
    if (keyword !== '') {
      $.ajax({
        url: base_url + '/dadmin/paketMenu/cari/',
        type: 'POST',
        data: {
          keyword: keyword,
        },
        dataType: 'json',
        success: function (data) {
          var element = '';
          $("#formCariPaketMenu #datalistOptions").empty();
          for (var i = 0; i < data.dataPencarian.length; i++) {
            element += `<option class="itemPencarian" value="${data.dataPencarian[i].nama_paket_menu}">`;
          }

          $("#formCariPaketMenu #datalistOptions").append(element);
        }
      });
    }
  })

  $(".content-paket-menu #formCariPaketMenu input").on('keypress', function(e) {
    var keyword = $(this).val();
    if(e.which == 13) {
      $.ajax({
      url: base_url + '/dadmin/paketMenu/cari/',
      type: 'POST',
      data: {
        keyword: keyword,
      },
      dataType: 'json',
      success: function (data) {
        var element = '';
        for (var i = 0; i < data.dataPencarian.length; i++) {
          element += `<tr class="align-middle">
                        <td scope="row">${i+1}.</td>
                        <td>${data.dataPencarian[i].nama_paket_menu}</td>
                        <td>Rp. ${data.dataPencarian[i].harga_paket_menu}</td>
                        <td>
                          <button type="button" data-id="${data.dataPencarian[i].id_paket_menu}" class="btn btn-sm btn-warning rounded-pill my-border-btn btnModalEditPaketMenu" data-bs-toggle="modal"
                            data-bs-target="#modalEditPaketMenu">Edit</button>
                          <button type="button" data-id="${data.dataPencarian[i].id_paket_menu}" class="btn btn-sm btn-danger rounded-pill my-border-btn btnModalHapusPaketMenu" data-bs-toggle="modal"
                            data-bs-target="#modalHapusPaketMenu">Hapus</button>
                        </td>
                      </tr>`;
        }
        $(".content-paket-menu #dataTablePaketMenu").html(element);
      }
    });
    }
  })

  $(".content-paket-menu #formCariPaketMenu #txtCariPaketMenu").on('keydown', function(e) {
    eventSource = e.key ? 'typed' : 'clicked';
  })

  $(".content-paket-menu #formCariPaketMenu #txtCariPaketMenu").on('input', function() {
    if (eventSource === 'clicked') {
      $.ajax({
        url: base_url + '/dadmin/paketMenu/getDetailPencarian/' + $(this).val(),
        type: 'POST',
        dataType: 'json',
        success: function (data) {
          $(".content-paket-menu #dataTablePaketMenu").html(`
            <tr class="align-middle">
                <td scope="row">1</td>
                <td>${data.detailData.nama_paket_menu}</td>
                <td>Rp. ${data.detailData.harga_paket_menu}</td>
                <td>
                  <button type="button" data-id="${data.detailData.id_paket_menu}" class="btn btn-sm btn-warning rounded-pill my-border-btn btnModalEditPaketMenu" data-bs-toggle="modal"
                    data-bs-target="#modalEditPaketMenu">Edit</button>
                  <button type="button" data-id="${data.detailData.id_paket_menu}" class="btn btn-sm btn-danger rounded-pill my-border-btn btnModalHapusPaketMenu" data-bs-toggle="modal"
                    data-bs-target="#modalHapusPaketMenu">Hapus</button>
                </td>
              </tr>
            `);
        }
      });
    }
  })

  $(".content-paket-menu #formCariPaketMenu button").on('click', function() {
    var keyword = $(".content-paket-menu #txtCariPaketMenu").val();
    $.ajax({
      url: base_url + '/dadmin/paketMenu/cari/',
      type: 'POST',
      data: {
        keyword: keyword,
      },
      dataType: 'json',
      success: function (data) {
        var element = '';
        for (var i = 0; i < data.dataPencarian.length; i++) {
          element += `<tr class="align-middle">
                        <td scope="row">${i+1}.</td>
                        <td>${data.dataPencarian[i].nama_paket_menu}</td>
                        <td>Rp. ${data.dataPencarian[i].harga_paket_menu}</td>
                        <td>
                          <button type="button" data-id="${data.dataPencarian[i].id_paket_menu}" class="btn btn-sm btn-warning rounded-pill my-border-btn btnModalEditPaketMenu" data-bs-toggle="modal"
                            data-bs-target="#modalEditPaketMenu">Edit</button>
                          <button type="button" data-id="${data.dataPencarian[i].id_paket_menu}" class="btn btn-sm btn-danger rounded-pill my-border-btn btnModalHapusPaketMenu" data-bs-toggle="modal"
                            data-bs-target="#modalHapusPaketMenu">Hapus</button>
                        </td>
                      </tr>`;
        }
        $(".content-paket-menu #dataTablePaketMenu").html(element);
      }
    });
  })
  // view paket menu


  // view menu
  $(".content-menu").on("click", ".lihatFotoMenu", function() {
    const detailMenu = $(this).parent();

    $("#modalLihatFotoMenu h1").text(detailMenu.text());
    $("#modalLihatFotoMenu img").attr("src", $(this).attr('src'));
  })

  $(".content-menu #dataTableMenu").on('click', '.btnModalHapusMenu', function() {
    var id = $(this).data('id');
    $("#modalHapusMenu form").attr('action', '/dadmin/menu/delete/' + id);
  })

  $(".content-menu #formCariMenu input").on('keyup', function() {
    var keyword = $(this).val();
    if (keyword !== '') {
      $.ajax({
        url: base_url + '/dadmin/menu/cari',
        type: 'POST',
        data: {
          keyword: keyword,
        },
        dataType: 'json',
        success: function (data) {
          var element = '';
          $("#formCariMenu #datalistOptions").empty();
          for (var i = 0; i < data.dataPencarian.length; i++) {
            element += `<option class="itemPencarian" value="${data.dataPencarian[i].nama_menu}">`;
          }

          $("#formCariMenu #datalistOptions").append(element);
        }
      });
    }
  })

  $(".content-menu #formCariMenu input").on('keypress', function(e) {
    var keyword = $(this).val();
    if(e.which == 13) {
      $.ajax({
      url: base_url + '/dadmin/menu/cari/',
      type: 'POST',
      data: {
        keyword: keyword,
      },
      dataType: 'json',
      success: function (data) {
        var element = '';
        for (var i = 0; i < data.dataPencarian.length; i++) {
          element += `<tr class="align-middle">
                        <td scope="row">${i+1}.</td>
                        <td class="text-start"><img src="/assets/img/menu/${data.dataPencarian[i].gambar_menu}" class="gambar-menu lihatFotoMenu" alt="..." data-bs-toggle="modal" data-bs-target="#modalLihatFotoMenu">${data.dataPencarian[i].nama_menu}</td>
                        <td>${data.dataPencarian[i].nama_pack}</td>
                        <td>${data.dataPencarian[i].nama_paket_menu != null ? data.dataPencarian[i].nama_paket_menu : '-'}</td>
                        <td>${data.dataPencarian[i].harga_menu != null ? 'Rp. ' + data.dataPencarian[i].harga_menu : '-'}</td>
                        <td>
                          <a class="btn btn-sm btn-warning rounded-pill my-border-btn" href="${base_url}/dadmin/menu/edit/${data.dataPencarian[i].id_menu}" role="button">Edit
                          </a>
                          <button type="button" data-id="${data.dataPencarian[i].id_menu}" class="btn btn-sm btn-danger rounded-pill my-border-btn btnModalHapusMenu" data-bs-toggle="modal"
                            data-bs-target="#modalHapusMenu">Hapus</button>
                        </td>
                      </tr>`;
        }
        $(".content-menu #dataTableMenu").html(element);
      }
    });
    }
  })

  $(".content-menu #formCariMenu #txtCariMenuAdmin").on('keydown', function(e) {
    eventSource = e.key ? 'typed' : 'clicked';
  })

  $(".content-menu #formCariMenu #txtCariMenuAdmin").on('input', function() {
    if (eventSource === 'clicked') {
      $.ajax({
        url: base_url + '/dadmin/menu/getDetailPencarian/' + $(this).val(),
        type: 'POST',
        dataType: 'json',
        success: function (data) {
          $(".content-menu #dataTableMenu").html(`
            <tr class="align-middle">
              <td scope="row">1.</td>
              <td class="text-start"><img src="/assets/img/menu/${data.dataPencarian[i].gambar_menu}" class="gambar-menu lihatFotoMenu" alt="..." data-bs-toggle="modal" data-bs-target="#modalLihatFotoMenu">${data.dataPencarian[i].nama_menu}</td>
              <td>${data.dataPencarian.nama_pack}</td>
              <td>${data.dataPencarian.nama_paket_menu != null ? data.dataPencarian.nama_paket_menu : '-'}</td>
              <td>${data.dataPencarian.harga_menu != null ? 'Rp. ' + data.dataPencarian.harga_menu : '-'}</td>
              <td>
                <a class="btn btn-sm btn-warning rounded-pill my-border-btn" href="${base_url}/dadmin/menu/edit/${data.dataPencarian.id_menu}" role="button">Edit
                </a>
                <button type="button" data-id="${data.dataPencarian.id_menu}" class="btn btn-sm btn-danger rounded-pill my-border-btn btnModalHapusMenu" data-bs-toggle="modal"
                  data-bs-target="#modalHapusMenu">Hapus</button>
              </td>
            </tr>
            `);
        }
      });
    }
  })

  $(".content-menu #formCariMenu button").on('click', function() {
    var keyword = $(".content-menu #txtCariMenuAdmin").val();
    $.ajax({
      url: base_url + '/dadmin/menu/cari/',
      type: 'POST',
      data: {
        keyword: keyword,
      },
      dataType: 'json',
      success: function (data) {
        var element = '';
        for (var i = 0; i < data.dataPencarian.length; i++) {
          element += `<tr class="align-middle">
                        <td scope="row">${i+1}.</td>
                        <td class="text-start"><img src="/assets/img/menu/${data.dataPencarian[i].gambar_menu}" class="gambar-menu lihatFotoMenu" alt="..." data-bs-toggle="modal" data-bs-target="#modalLihatFotoMenu">${data.dataPencarian[i].nama_menu}</td>
                        <td>${data.dataPencarian[i].nama_pack}</td>
                        <td>${data.dataPencarian[i].nama_paket_menu != null ? data.dataPencarian[i].nama_paket_menu : '-'}</td>
                        <td>${data.dataPencarian[i].harga_menu != null ? 'Rp. ' + data.dataPencarian[i].harga_menu : '-'}</td>
                        <td>
                          <a class="btn btn-sm btn-warning rounded-pill my-border-btn" href="${base_url}/dadmin/menu/edit/${data.dataPencarian[i].id_menu}" role="button">Edit
                          </a>
                          <button type="button" data-id="${data.dataPencarian[i].id_menu}" class="btn btn-sm btn-danger rounded-pill my-border-btn btnModalHapusMenu" data-bs-toggle="modal"
                            data-bs-target="#modalHapusMenu">Hapus</button>
                        </td>
                      </tr>`;
        }
        $(".content-menu #dataTableMenu").html(element);
      }
    });
  })
  // view menu


  // view biaya ongkir
  $(".content-biaya-ongkir #dataTableOngkir").on('click', '.btnModalEditOngkir', function() {
    var id = $(this).data('id');
    var namaPaket = $(this).parent().parent().find('td:nth-child(2)').text();
    var hargaPaket = $(this).parent().parent().find('td:nth-child(3)').text();
    hargaPaket = hargaPaket.split(' ');
    hargaPaket = hargaPaket[1];
    $("#modalEditKota #formOngkir").attr('action', '/dadmin/biayaOngkir/update/' + id);
    $("#modalEditKota input[name=namaKota]").val(namaPaket);
    $("#modalEditKota input[name=biayaOngkir]").val(hargaPaket);
  })

  $(".content-biaya-ongkir #dataTableOngkir").on('click', '.btnModalHapusOngkir', function() {
    var id = $(this).data('id');
    $("#modalHapusKota form").attr('action', '/dadmin/biayaOngkir/delete/' + id);
  })

  $(".content-biaya-ongkir #formCariOngkirKota input").on('keyup', function() {
    var keyword = $(this).val();
    if (keyword !== '') {
      $.ajax({
        url: base_url + '/dadmin/biayaOngkir/cari/',
        type: 'POST',
        data: {
          keyword: keyword,
        },
        dataType: 'json',
        success: function (data) {
          var element = '';
          $("#formCariOngkirKota #datalistOptions").empty();
          for (var i = 0; i < data.dataPencarian.length; i++) {
            element += `<option class="itemPencarian" value="${data.dataPencarian[i].ongkir_kota}">`;
          }

          $("#formCariOngkirKota #datalistOptions").append(element);
        }
      });
    }
  })

  $(".content-biaya-ongkir #formCariOngkirKota input").on('keypress', function(e) {
    var keyword = $(this).val();
    if(e.which == 13) {
      $.ajax({
      url: base_url + '/dadmin/biayaOngkir/cari/',
      type: 'POST',
      data: {
        keyword: keyword,
      },
      dataType: 'json',
      success: function (data) {
        var element = '';
        for (var i = 0; i < data.dataPencarian.length; i++) {
          element += `<tr class="align-middle">
                        <td scope="row">${i+1}.</td>
                        <td>${data.dataPencarian[i].ongkir_kota}</td>
                        <td>Rp. ${data.dataPencarian[i].biaya_ongkir}</td>
                        <td>
                          <button type="button" data-id="${data.dataPencarian[i].id_ongkir}" class="btn btn-sm btn-warning rounded-pill my-border-btn btnModalEditOngkir" data-bs-toggle="modal"
                            data-bs-target="#modalEditKota">Edit</button>
                          <button type="button" data-id="${data.dataPencarian[i].id_ongkir}" class="btn btn-sm btn-danger rounded-pill my-border-btn btnModalHapusOngkir" data-bs-toggle="modal"
                            data-bs-target="#modalHapusKota">Hapus</button>
                        </td>
                      </tr>`;
        }
        $(".content-biaya-ongkir #dataTableOngkir").html(element);
      }
    });
    }
  })

  $(".content-biaya-ongkir #formCariOngkirKota #txtCariKotaAdmin").on('keydown', function(e) {
    eventSource = e.key ? 'typed' : 'clicked';
  })

  $(".content-biaya-ongkir #formCariOngkirKota #txtCariKotaAdmin").on('input', function() {
    if (eventSource === 'clicked') {
      $.ajax({
        url: base_url + '/dadmin/biayaOngkir/getDetailPencarian/' + $(this).val(),
        type: 'POST',
        dataType: 'json',
        success: function (data) {
          $(".content-biaya-ongkir #dataTableOngkir").html(`
            <tr class="align-middle">
                <td scope="row">1</td>
                <td>${data.detailData.ongkir_kota}</td>
                <td>Rp. ${data.detailData.biaya_ongkir}</td>
                <td>
                  <button type="button" data-id="${data.detailData.id_ongkir}" class="btn btn-sm btn-warning rounded-pill my-border-btn btnModalEditOngkir" data-bs-toggle="modal"
                    data-bs-target="#modalEditKota">Edit</button>
                  <button type="button" data-id="${data.detailData.id_ongkir}" class="btn btn-sm btn-danger rounded-pill my-border-btn btnModalHapusOngkir" data-bs-toggle="modal"
                    data-bs-target="#modalHapusKota">Hapus</button>
                </td>
              </tr>
            `);
        }
      });
    }
  })

  $(".content-biaya-ongkir #formCariOngkirKota button").on('click', function() {
    var keyword = $(".content-biaya-ongkir #txtCariKotaAdmin").val();
    $.ajax({
      url: base_url + '/dadmin/biayaOngkir/cari/',
      type: 'POST',
      data: {
        keyword: keyword,
      },
      dataType: 'json',
      success: function (data) {
        var element = '';
        for (var i = 0; i < data.dataPencarian.length; i++) {
          element += `<tr class="align-middle">
                        <td scope="row">${i+1}.</td>
                        <td>${data.dataPencarian[i].ongkir_kota}</td>
                        <td>Rp. ${data.dataPencarian[i].biaya_ongkir}</td>
                        <td>
                          <button type="button" data-id="${data.dataPencarian[i].id_ongnkir}" class="btn btn-sm btn-warning rounded-pill my-border-btn btnModalEditOngkir" data-bs-toggle="modal"
                            data-bs-target="#modalEditKota">Edit</button>
                          <button type="button" data-id="${data.dataPencarian[i].id_ongnkir}" class="btn btn-sm btn-danger rounded-pill my-border-btn btnModalHapusOngkir" data-bs-toggle="modal"
                            data-bs-target="#modalHapusKota">Hapus</button>
                        </td>
                      </tr>`;
        }
        $(".content-biaya-ongkir #dataTableOngkir").html(element);
      }
    });
  })
  // view biaya ongkir


  // view menu
  const modalHapusMenu = document.getElementById('modalHapusMenu')
  if (modalHapusMenu) {
    modalHapusMenu.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget;
      const modalBtnHapusMenu = modalHapusMenu.querySelector('#modalBtnHapusMenu');
      const indexBarix = button.getAttribute('data-indexBaris');
      const idMenu = button.getAttribute('data-id');        
      modalBtnHapusMenu.setAttribute('data-indexBaris', indexBarix);
      modalBtnHapusMenu.setAttribute('data-idMenu', idMenu);
    })
    
    modalHapusMenu.addEventListener('hide.bs.modal', event => {
      modalHapusMenu.removeAttribute('data-idMenuPesanan');
    })
  }

  $("#modalBtnHapusMenu").on('click', function() {
    var idMenu = $(this).attr("data-idMenu");
    console.log(idMenu);
    $.ajax({
      url: base_url + '/dadmin/menu/delete/' + idMenu,
      type: 'POST',
      dataType: 'json',
      success: function (data) {
        window.location.href = base_url + '/dadmin/menu';
      }
    });
  })

  $(".content-menu .btnModalHapusMenu").on('click', function() {
    var halaman = $(this).attr("data-id");
    $.ajax({
      url: base_url + '/dadmin/menu/halaman/' + halaman,
      type: 'POST',
      dataType: 'json',
      success: function (data) {
        $("#tabelMenu").html(data.element)
      }
    });
  })

  $(".content-menu").on('click', '#tabelMenu .btnLinkNumber', function() {
    var halaman = $(this).attr("data-halaman");
    $.ajax({
      url: base_url + '/dadmin/menu/halaman/' + halaman,
      type: 'POST',
      dataType: 'json',
      success: function (data) {
        $("#tabelMenu").html(data.element)
      }
    });
  })

  $(".content-menu").on('click', '#tabelMenu .btnNext', function() {
    var halaman = $(this).attr("data-halamanAktif");
    $.ajax({
      url: base_url + '/dadmin/menu/halaman/' + halaman,
      type: 'POST',
      dataType: 'json',
      success: function (data) {
        $("#tabelMenu").html(data.element)
      }
    });
  })
  
  $(".content-menu").on('click', '#tabelMenu .btnPrev', function() {
    var halaman = $(this).attr("data-halamanAktif");
    $.ajax({
      url: base_url + '/dadmin/menu/halaman/' + halaman,
      type: 'POST',
      dataType: 'json',
      success: function (data) {
        $("#tabelMenu").html(data.element)
      }
    });
  })
  // view menu


  // view jadwal menu
  $(".content-jadwal-menu #btnBuatJadwal").on('click', function() {
    var pack = $("#selectJenisPack").val();
    if (pack == "family") {
      window.location.href = base_url + '/dadmin/jadwal/family'
    }

    if (pack == "personal") {
      window.location.href = base_url + '/dadmin/jadwal/personal'
    }
  })

  $(".content-jadwal-menu ul.ul-view button").on('click', function() {
    $(".content-jadwal-menu ul.ul-view button").removeClass('my-active');
    $(this).addClass('my-active');
  })

  $(".content-jadwal-menu #tabJadwalFamily").on('click', function() {
    $.ajax({
      url: base_url + '/dadmin/jadwal/viewJadwal',
      type: 'POST',
      data: {
        pack: 'family'
      },
      dataType: 'json',
      success: function (data) {
        $("#datatable").html(data.dataJadwal)
        $("#datatable caption").text("Riwayat Jadwal Family Pack");
      }
    });
  })
  
  $(".content-jadwal-menu #tabJadwalPersonal").on('click', function() {
    $.ajax({
      url: base_url + '/dadmin/jadwal/viewJadwal',
      type: 'POST',
      data: {
        pack: 'personal'
      },
      dataType: 'json',
      success: function (data) {
        $("#datatable").html(data.dataJadwal)
        $("#datatable caption").text("Riwayat Jadwal Personal Pack");
      }
    });
  })
  // view jadwal menu


  // view jadwal family
  var selectedDates = [];
  $(".content-jadwal-family").on('change', 'ul.list-content-jadwal input[type=date]', function(e) {
    $('.content-jadwal-family ul.list-content-jadwal:last-child span.notifTanggal').remove();
    jadwalNotifTanggal = false;

    var selectedDate = $(this).val();
    var isDuplicate = false;

    if (selectedDate) {
      // Check if the selected date is already in use
      isDuplicate = selectedDates.includes(selectedDate);

      // Add or remove the date from the list of selected dates
      if (!isDuplicate) {
        if (!selectedDates.includes(selectedDate)) {
          selectedDates.push(selectedDate);
        }
      } else {
        $(this).val(''); // Clear the input
        $(this).parent().append(`<span class="notifTanggal text-danger">sudah digunakan</span>`);
        setTimeout(function() {
          $('.content-jadwal-family ul.list-content-jadwal:last-child span.notifTanggal').remove();
        }, 3000);
      }
    }
  })

  $(".content-jadwal-family").on('change', '.cbLibur', function(e) {
    var listContentJadwal = e.target.parentElement.parentElement.parentElement;
    var aksiJadwal = $(".content-jadwal-family input[name=case]").val();
    if(aksiJadwal == "saveJadwalMenu") {
      if($(this).is(':checked')) {
        $(this).parent().parent().parent().find('li:nth-child(2)').remove();
      } else {
        $(this).parent().parent().parent().append(`
        <li class="list-group-item border border-top-0 border-black">
          <div class="my-form-jadwal-family">
            <input class="form-control form-control-sm rounded-0 my-border-input" type="text" name="itemMenu" id="txtMenu"
              list="datalistOptions" placeholder="Ketik Menu">
            <datalist id="datalistOptions">
            </datalist>
            <button disabled class="btn btn-sm btn-primary rounded-0 my-border-btn btnTambahMenu">Tambahkan</button>
          </div>
          <ul class="list-group list-tambah-menu mt-2">
          </ul>
        </li>`);
      }
    } else if(aksiJadwal == "updateJadwalMenu") {
      if($(this).is(':checked')) {
        $(this).parent().parent().parent().find('li:nth-child(2)').css("display", "none");
      } else {
        if($(this).parent().parent().parent().find('li:nth-child(2)').length > 0) {
          $(this).parent().parent().parent().find('li:nth-child(2)').css("display", "block");
        } else {
          $(this).parent().parent().parent().append(`
              <li class="list-group-item border border-top-0 border-black">
                <div class="my-form-jadwal-family">
                  <input class="form-control form-control-sm rounded-0 my-border-input" type="text" name="itemMenu" id="txtMenu"
                    list="datalistOptions" placeholder="Ketik Menu">
                  <datalist id="datalistOptions">
                  </datalist>
                  <button disabled class="btn btn-sm btn-primary rounded-0 my-border-btn btnTambahMenu">Tambahkan</button>
                </div>
                <ul class="list-group list-tambah-menu mt-2">
                </ul>
              </li>`);  
        }
      }
    }
  })

  $(".content-jadwal-family").on('keyup', '.my-form-jadwal-family input[name=itemMenu]', function() {
    var keyword = $(this).val();
    $('.content-jadwal-family ul.list-content-jadwal:last-child span.notifMenu').remove();
    jadwalNotifMenu = false;
    if (keyword !== '') {
      $.ajax({
        url: base_url + '/dadmin/jadwal/cariMenu',
        type: 'POST',
        data: {
          keyword: keyword,
          pack: 'family'
        },
        dataType: 'json',
        success: function (data) {
          var element = '';
          $(".content-jadwal-family .my-form-jadwal-family #datalistOptions").empty();
          for (var i = 0; i < data.dataPencarian.length; i++) {
            element += `<option class="itemPencarian" data-id="${data.dataPencarian[i].id_menu}" value="${data.dataPencarian[i].nama_menu}">`;
          }

          $(".my-form-jadwal-family #datalistOptions").append(element);
        }
      });
    }

    if (keyword == '') {
      $(this).parent().find('button').attr('disabled', 'true');
    }
  })

  $(".content-jadwal-family").on('keydown', '.my-form-jadwal-family input[name=itemMenu]', function(e) {
    eventSource = e.key ? 'typed' : 'clicked';
  })

  $(".content-jadwal-family").on('keydown', '.my-form-jadwal-family input[name=itemMenu]', function(e) {
    if (eventSource === 'clicked') {
      $(this).parent().find('button').removeAttr('disabled');
    }
  })

  $(".content-jadwal-family").on('click', '.btnTambahMenu', function() {
    var aksiJadwal = $(".content-jadwal-family input[name=case]").val();
    var listJadwalMenu = $(this).parent().parent().parent();
    var menu = $(this).parent().find("input").val();
    var idMenu = $(this).parent().find("datalist option[value='" + menu + "']").data('id');
    $(this).parent().parent().find(".list-tambah-menu").append(
      `<li class="list-group-item">
          <div class="row">
            <div class="col">
              <input type="text" hidden value="${idMenu}"></input>
              <span class="text-wrap item">${menu}</span>
            </div>
            <div class="col-auto">
              <button class="btn btn-sm btnHapusListMenu">
                <span class="fs-5 text-danger">
                  <i class="bi bi-x-square"></i>
                </span>
              </button>
            </div>
          </div>
        </li>`);
    $(this).parent().find("input").val('');
    $(this).parent().find("input").focus();
    $(this).parent().find('button').attr('disabled', 'true');
    $(this).parent().parent().find('span.notifMenu').remove();
  })

  $(".content-jadwal-family").on('click', '.btnHapusListMenu', function(e) {
    var listJadwalMenu = $(this).parent().parent().parent().parent().parent().parent();
    var listMenu = $(this).parent().parent().parent();
    listJadwalMenu.addClass("updateListMenu");
    listMenu.remove();
  })

  $("#btnTambahHariFamily").on('click', function() {
    var aksiJadwal = $(".content-jadwal-family input[name=case]").val();
    var cekLibur = $(".content-jadwal-family").find('ul.list-content-jadwal:last-child').find('input[type=checkbox]').is(':checked');
    var cardFormJadwal = $(".content-jadwal-family").find(".list-content-jadwal");
    var tanggal = $(".content-jadwal-family").find("ul.list-content-jadwal:last-child").find("input[type=date]").val();
    var minTanggal = $(".content-jadwal-family ul");
    console.log(minTanggal);
    var listItemMenu = $(".content-jadwal-family").find('ul.list-content-jadwal:last-child').find('ul.list-tambah-menu li');
    if (tanggal == '') {
      if (jadwalNotifTanggal == false) {
        jadwalNotifTanggal = true;
        $(".content-jadwal-family ul.list-content-jadwal:last-child").find("li:first-child div:first-child").append(`<span class="notifTanggal text-danger">Tanggal masih kosong</span>`);
      }
    } else if (cekLibur || listItemMenu.length > 0) {
      $(".content-jadwal-family").append(`
                  <ul class="list-group list-content-jadwal fw-medium ${(aksiJadwal == "updateJadwalMenu") ? "tambahListHari" : ""}" style="width: 13em;">
                    <li class="list-group-item border border-black text-center">
                      <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">Mulai</label>
                        <input type="date" class="form-control form-control-sm my-border-input txtDate jadwalFamily"
                          style="width: fit-content; margin: auto;" min="${minTanggal}">
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input my-border-input cbLibur" id="cbLibur${cardFormJadwal.length+1}" type="checkbox">
                        <label class="form-check-label" for="cbLibur${cardFormJadwal.length+1}">Libur</label>
                      </div>
                      <br>
                      <button type="button"
                        class="btn mt-1 btn-sm btn-danger rounded-pill my-border-btn btnListHapusJadwal">Hapus</button>
                    </li>
                    <li class="list-group-item border border-top-0 border-black">
                      <div class="my-form-jadwal-family">
                        <input class="form-control form-control-sm rounded-0 my-border-input" type="text" name="itemMenu" id="txtMenu"
                          list="datalistOptions" placeholder="Ketik Menu">
                        <datalist id="datalistOptions">
                        </datalist>
                        <button disabled class="btn btn-sm btn-primary rounded-0 my-border-btn btnTambahMenu">Tambahkan</button>
                      </div>
                      <ul class="list-group list-tambah-menu mt-2">
                      </ul>
                    </li>
                  </ul>`);
    } else {
      if (jadwalNotifMenu == false) {
        jadwalNotifMenu = true;
        $(".content-jadwal-family").find('ul.list-content-jadwal:last-child').find('ul.list-tambah-menu').append(`<span class="notifMenu text-danger">Menu masih kosong</span>`);
      }
    }
  });

  $(".content-jadwal-family").on('click', '.btnListHapusJadwal', function(e) {
    var aksiJadwal = $(".content-jadwal-family input[name=case]").val();
    var listJadwalMenu = $(this).parent().parent();
    if (aksiJadwal == "saveJadwalMenu") {
      if ($(".content-jadwal-family").find('ul.list-content-jadwal').length != 1) {
        listJadwalMenu.remove();
      }
    } else {
      listJadwalMenu.css("display", "none");
      listJadwalMenu.addClass("hapusJadwalMenu");
    }
  })

  $(".my-content .btnPostMenuFamily").on('click', function() {
    var tanggal = $(".content-jadwal-family").find("ul.list-content-jadwal:last-child").find("input[type=date]").val();
    var listItemMenu = $(".content-jadwal-family").find('ul.list-content-jadwal:last-child').find('ul.list-tambah-menu li');
    console.log(listItemMenu);
    var cekLibur = $(".content-jadwal-family").find('ul.list-content-jadwal:last-child').find('input[type=checkbox]').is(':checked');
    var aksiJadwal = $(".content-jadwal-family input[name=case]").val();
    if (tanggal === '') {
      if (jadwalNotifTanggal == false) {
        jadwalNotifTanggal = true;
        $(".content-jadwal-family ul.list-content-jadwal:last-child").find("li:first-child div:first-child").append(`<span class="notifTanggal text-danger">Tanggal masih kosong</span>`);
      }
    } else if (cekLibur || listItemMenu.length > 0) {
      if (aksiJadwal == "saveJadwalMenu") { // save jadwal family
        var contentJadwal = $(".content-jadwal-family")
        var dataJadwal = [];
        contentJadwal.find("ul.list-content-jadwal").each(function (index, element) {
          var itemsMenu = [];
          var tanggal = $(element).find('input[type=date]').val();
          var cbLibur = $(element).find('input[type=checkbox]').is(':checked');
          var listItemMenu = $(element).find('.list-tambah-menu');
          listItemMenu.find("li").each(function (index, element) {
            var idMenu = $(element).find('input').val();
            itemsMenu.push(idMenu);
          })
          dataJadwal.push({
            tanggal: tanggal,
            cbLibur: cbLibur,
            itemsMenu: itemsMenu
          });
        });
        $.ajax({
          url: base_url + '/dadmin/jadwal/save/family',
          type: 'POST',
          data: {
            dataJadwal: dataJadwal,
          },
          dataType: 'json',
          success: function (data) {
            window.location.href = base_url + '/dadmin/jadwal';
          }
        });
      } else { // update jadwal family
        var idJadwal = $(this).data('id');
        var contentJadwal = $(".content-jadwal-family");
        var dataJadwal = [];

        contentJadwal.find("ul.list-content-jadwal").each(function (index, element) {
          var idJadwalMenu = $(element).data('id') || null;
          var tanggal = $(element).find('input[type=date]').val();
          var cbLibur = $(element).find('input[type=checkbox]').is(':checked');
          var itemsMenuUpdate = [];
          var itemsMenuAdd = [];
          var listItemMenu = $(element).find('.list-tambah-menu');
          listItemMenu.find("li").each(function (index, el) {
            var idMenu = $(el).find('input').val();
            if (idMenu) {
              if ($(element).hasClass("tambahListHari")) {
                itemsMenuAdd.push(idMenu);
              } else {
                itemsMenuUpdate.push(idMenu);
              }
            }
          });
          var jadwalType = 
              $(element).hasClass("hapusJadwalMenu") ? "hapus" :
              $(element).hasClass("updateListMenu") ? "update" : 
              $(element).hasClass("bacaJadwalMenu") ? "baca" : 
              $(element).hasClass("tambahListHari") ? "tambah" : null;
          if (jadwalType && (itemsMenuUpdate.length > 0 || itemsMenuAdd.length > 0)) {
            var jadwalData = {
              idJadwalMenu: idJadwalMenu,
              jadwal: jadwalType,
              tanggal: tanggal,
              cbLibur: cbLibur
            };
            if (jadwalType === "tambah") {
              jadwalData.itemsMenuAdd = itemsMenuAdd;
            } else {
              jadwalData.itemsMenuUpdate = itemsMenuUpdate;
            }
            dataJadwal.push(jadwalData);
          }
        });

        console.log(dataJadwal);
        console.log(idJadwal);
        $.ajax({
          url: base_url + '/dadmin/jadwal/update/family',
          type: 'POST',
          data: {
            idJadwal: idJadwal,
            dataJadwal: dataJadwal,
          },
          dataType: 'json',
          success: function (data) {
            console.log(data);
            window.location.href = base_url + '/dadmin/jadwal';
          }
        });
      }
    } else {
      console.log($(".content-jadwal-family ul.list-content-jadwal:last-child").find("li:last-child div:first-child"));
      if (jadwalNotifMenu == false) {
        jadwalNotifMenu = true;
        $(".content-jadwal-family ul.list-content-jadwal:last-child").find("li:last-child div:first-child").append(`<span class="notifMenu text-danger">Menu masih kosong</span>`);
      }
    }
  })
  // view jadwal family


  // view jadwal personal
  var jadwalNotifMenuLunch = false;
  var jadwalNotifMenuDinner = false;
  $(".content-jadwal-personal").on('change', '.list-jadwal-personal .list-jadwal:last-child input[type=date]', function(e) {
    $(".content-jadwal-personal .list-jadwal-personal .list-jadwal:last-child").find("div:first-child div:first-child span.notifTanggal").remove();
    jadwalNotifTanggal = false;

    var selectedDate = $(this).val();
    var isDuplicate = false;

    if (selectedDate) {
      // Check if the selected date is already in use
      isDuplicate = selectedDates.includes(selectedDate);

      // Add or remove the date from the list of selected dates
      if (!isDuplicate) {
          if (!selectedDates.includes(selectedDate)) {
            selectedDates.push(selectedDate);
          }
      } else {
        $(this).val(''); // Clear the input
        $(this).parent().append(`<span class="notifTanggal text-danger">sudah digunakan</span>`);
        setTimeout(function() {
          $('.content-jadwal-personal .list-jadwal-personal .list-jadwal:last-child span.notifTanggal').remove();
        }, 3000);
      }
    }
  })

  $(".list-jadwal-personal").on('change', '.cbLibur', function(e) {
    var listContentJadwal = $(this).parent().parent().parent();
    var aksiJadwal = $(".content-jadwal-personal input[name=case]").val();
    if(aksiJadwal == "saveJadwalMenu") {
      if($(this).is(":checked") == true) {
        for (var i = 3; i >= 2; i--) {
          listContentJadwal.find(`.sublist-jadwal:nth-child(${i})`).remove();
        }
      } else {
        jadwalNotifMenu = false;
        listContentJadwal.append(`
            <div class="sublist-jadwal border-top border-bottom border-black">
              <div class="header-list my-form-jadwal-personal">Lunch</div>
              <div class="body-list">
                <div class="mb-3">
                  <label for="txtMenuLunch" class="form-label">Cari</label>
                  <input type="text" class="form-control form-control-sm my-border-input" id="txtMenuLunch" name="itemMenu" list="datalistOptionsLunch" placeholder="Ketik Menu">
                  <datalist id="datalistOptionsLunch">
                  </datalist>
                </div>
              </div>
            </div>
            <div class="sublist-jadwal border border-black rounded-end">
              <div class="header-list my-form-jadwal-personal">Dinner</div>
              <div class="body-list">
                <label for="txtMenuDinner" class="form-label">Cari</label>
                <input type="text" class="form-control form-control-sm my-border-input" id="txtMenuDinner" name="itemMenu" list="datalistOptionsDinner" placeholder="Ketik Menu">
                <datalist id="datalistOptionsDinner">
                </datalist>
              </div>
            </div>`);
      }
    } else if(aksiJadwal == "updateJadwalMenu") {
      if($(this).is(":checked") == true) {
        for (var i = 3; i >= 2; i--) {
          listContentJadwal.find(`.sublist-jadwal:nth-child(${i})`).css("display", "none");
        }
      } else {
        if(listContentJadwal.find(`.sublist-jadwal`).length != 1) {
          // $(this).parent().parent().parent().find('li:nth-child(2)').css("display", "block");
          for (var i = 3; i >= 2; i--) {
            listContentJadwal.find(`.sublist-jadwal:nth-child(${i})`).css("display", "block");
          }
        } else {
          listContentJadwal.append(`
            <div class="sublist-jadwal border-top border-bottom border-black">
              <div class="header-list my-form-jadwal-personal">Lunch</div>
              <div class="body-list">
                <div class="mb-3">
                  <label for="txtMenuLunch" class="form-label">Cari</label>
                  <input type="text" class="form-control form-control-sm my-border-input" id="txtMenuLunch" name="itemMenu" list="datalistOptionsLunch" placeholder="Ketik Menu">
                  <datalist id="datalistOptionsLunch">
                  </datalist>
                </div>
              </div>
            </div>
            <div class="sublist-jadwal border border-black rounded-end">
              <div class="header-list my-form-jadwal-personal">Dinner</div>
              <div class="body-list">
                <label for="txtMenuDinner" class="form-label">Cari</label>
                <input type="text" class="form-control form-control-sm my-border-input" id="txtMenuDinner" name="itemMenu" list="datalistOptionsDinner" placeholder="Ketik Menu">
                <datalist id="datalistOptionsDinner">
                </datalist>
              </div>
            </div>`);
        }
      }
    }
  });
  
  $(".list-jadwal-personal").on('click', '.btnListHapusJadwal', function(e) {
    var aksiJadwal = $(".content-jadwal-personal input[name=case]").val();
    var listJadwalMenu = $(this).parent().parent();
    if (aksiJadwal == "saveJadwalMenu") {
      if ($(".content-jadwal-personal").find('.list-jadwal').length != 1) {
        listJadwalMenu.remove();
      }
    } else {
      listJadwalMenu.css("display", "none");
      listJadwalMenu.addClass("hapusJadwalMenu");
    }

    // var listJadwalMenu = e.target.parentElement.parentElement;
    // listJadwalMenu.remove();
  });

  $(".content-jadwal-personal").on('keydown', '.my-form-jadwal-personal .txtMenuLunch', function(e) {
    eventSource = e.key ? 'typed' : 'clicked';
  })

  $(".content-jadwal-personal").on('keydown', '.my-form-jadwal-personal .txtMenuLunch', function(e) {
    if (eventSource === 'clicked') {
      $(this).attr('data-menuLunch', true);
      var cekData = $(this).parent().parent().parent().parent();
      if (cekData.hasClass("bacaJadwalMenu")) {
        $(this).closest(".list-jadwal").addClass("updateListMenu");
      }
    } else {
      $(this).attr('data-menuLunch', false);
    }
  })
  
  $(".content-jadwal-personal").on('keydown', '.my-form-jadwal-personal .txtMenuDinner', function(e) {
    eventSource = e.key ? 'typed' : 'clicked';
  })
  
  $(".content-jadwal-personal").on('keydown', '.my-form-jadwal-personal .txtMenuDinner', function(e) {
    if (eventSource === 'clicked') {
      $(this).attr('data-menuDinner', true);
      var cekData = $(this).parent().parent().parent();
      if (cekData.hasClass("bacaJadwalMenu")) {
        $(this).closest(".list-jadwal").addClass("updateListMenu");
      }
    } else {
      $(this).attr('data-menuDinner', false);
    }
  })

  $(".content-jadwal-personal").on('keyup', '.my-form-jadwal-personal .txtMenuLunch', function() {
    $(this).parent().find('span.notifMenu').remove();
    var keyword = $(this).val();
    var numCardFormJadwal = $(this).closest(".list-jadwal").index();
    console.log(numCardFormJadwal);
    var txtMenuLunch = $(this).parent().find("datalist#datalistOptionsLunch" + numCardFormJadwal);
    console.log(txtMenuLunch);
    jadwalNotifMenuLunch = false;
    if (keyword !== '') {
      $.ajax({
        url: base_url + '/dadmin/jadwal/cariMenu',
        type: 'POST',
        data: {
          keyword: keyword,
          pack: 'personal',
          paket: 'lunch'
        },
        dataType: 'json',
        success: function (data) {
          var element = '';
          txtMenuLunch.parent().find("#datalistOptionsLunch" + numCardFormJadwal).empty();
          for (var i = 0; i < data.dataPencarian.length; i++) {
            element += `<option id="itemPencarian" data-id="${data.dataPencarian[i].id_menu}" value="${data.dataPencarian[i].nama_menu}">`;
          }
          
          txtMenuLunch.append(element);
        }
      });
    }
  })

  $(".content-jadwal-personal").on('keyup', '.my-form-jadwal-personal .txtMenuDinner', function() {
    $(this).parent().find('span.notifMenu').remove();
    var keyword = $(this).val();
    var numCardFormJadwal = $(this).closest(".list-jadwal").index();
    console.log(numCardFormJadwal);
    var txtMenuDinner = $(this).parent().find("datalist#datalistOptionsDinner" + numCardFormJadwal);
    jadwalNotifMenuDinner = false;
    if (keyword !== '') {
      $.ajax({
        url: base_url + '/dadmin/jadwal/cariMenu',
        type: 'POST',
        data: {
          keyword: keyword,
          pack: 'personal',
          paket: 'dinner'
        },
        dataType: 'json',
        success: function (data) {
          console.log(data);
          var element = '';
          txtMenuDinner.parent().find("#datalistOptionsDinner" + numCardFormJadwal).empty();
          for (var i = 0; i < data.dataPencarian.length; i++) {
            element += `<option id="itemPencarian" data-id="${data.dataPencarian[i].id_menu}" value="${data.dataPencarian[i].nama_menu}">`;
          }
          txtMenuDinner.append(element);
        }
      });
    }
  })

  $("#btnTambahHariPersonal").on('click', function() {
    var aksiJadwal = $(".content-jadwal-personal input[name=case]").val();
    var cardFormJadwal = $(".content-jadwal-personal").find(".list-jadwal");
    var tanggal = $(".content-jadwal-personal").find(".list-jadwal-personal .list-jadwal:last-child").find("input[type=date]").val();
    var minTanggal = $(".content-jadwal-personal").find(".list-jadwal-personal .list-jadwal:last-child input[type=date]").attr("min");
    var itemMenuLunch = $(".content-jadwal-personal").find('.list-jadwal-personal .list-jadwal:last-child').find('input.txtMenuLunch');
    var itemMenuDinner = $(".content-jadwal-personal").find('.list-jadwal-personal .list-jadwal:last-child').find('input.txtMenuDinner');
    var cekLibur = $(".content-jadwal-personal").find('.list-jadwal-personal .list-jadwal:last-child').find('input[type=checkbox]').is(':checked');
    // console.log(tanggal);
    if (tanggal == '') {
      if (jadwalNotifTanggal == false) {
        jadwalNotifTanggal = true;
        $(".content-jadwal-personal .list-jadwal-personal .list-jadwal:last-child").find("div:first-child div:first-child").append(`<span class="notifTanggal text-sm text-danger">Tanggal masih kosong</span>`);
      }
    } else if (cekLibur || itemMenuLunch.val() != '' && itemMenuDinner.val() != '') {
      $(".list-jadwal-personal").append(`
        <div class="list-jadwal mt-4 text-center ${aksiJadwal == "updateJadwalMenu" ? "tambahListHari" : ""}" ${aksiJadwal == "updateJadwalMenu" ? "data-id='-'" : ""}>
          <div class="sublist-jadwal border border-black rounded-start ">
            <div class="mb-2" >
              <label for="exampleFormControlInput1" class="form-label">Mulai</label>
              <input type="date" class="form-control form-control-sm my-border-input txtDate jadwalPersonal"
                  style="width: fit-content; margin: auto;" min="${minTanggal}">
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input my-border-input cbLibur" id="cBoxLibur${(cardFormJadwal.length)+1}" type="checkbox">
              <label class="form-check-label" for="cBoxLibur${(cardFormJadwal.length)+1}">Libur</label>
            </div>
            <br>
            <button type="button" class="btn mt-1 btn-sm btn-danger rounded-pill my-border-btn btnListHapusJadwal">Hapus</button>
          </div>
          <div class="sublist-jadwal border-top border-bottom border-black">
            <div class="header-list">Lunch</div>
            <div class="body-list my-form-jadwal-personal">
              <div class="mb-3">
                <label for="txtMenuLunch" class="form-label">Cari</label>
                <input type="text" class="form-control form-control-sm my-border-input txtMenuLunch" name="itemMenu" list="datalistOptionsLunch${(cardFormJadwal.length)+1}" placeholder="Ketik Menu">
                <datalist id="datalistOptionsLunch${(cardFormJadwal.length)+1}">
                </datalist>
              </div>
            </div>
          </div>
          <div class="sublist-jadwal border border-black rounded-end">
            <div class="header-list">Dinner</div>
            <div class="body-list my-form-jadwal-personal">
              <label for="txtMenuDinner" class="form-label">Cari</label>
              <input type="text" class="form-control form-control-sm my-border-input txtMenuDinner" name="itemMenu" list="datalistOptionsDinner${(cardFormJadwal.length)+1}" placeholder="Ketik Menu">
              <datalist id="datalistOptionsDinner${(cardFormJadwal.length)+1}">
              </datalist>
            </div>
          </div>
        </div>`);
    } else {
      if (itemMenuLunch.val() == '') {
        if (jadwalNotifMenuLunch == false) {
          jadwalNotifMenuLunch = true;
          itemMenuLunch.parent().append(`<span class="notifMenu text-danger">Menu masih kosong</span>`);
        }
      } else {
        jadwalNotifMenuLunch = false;
        itemMenuLunch.parent().find('span.notifMenu').remove();
      }

      if (itemMenuDinner.val() == '') {
        if (jadwalNotifMenuDinner == false) {
          jadwalNotifMenuDinner = true;
          itemMenuDinner.parent().append(`<span class="notifMenu text-danger">Menu masih kosong</span>`);
        }
      } else {
        jadwalNotifMenuDinner = false;
        itemMenuDinner.parent().find('span.notifMenu').remove();
      }
    }
  });

  $(".my-content .btnPostMenuPersonal").on('click', function() {
    var tanggal = $(".content-jadwal-personal").find(".list-jadwal:last-child").find("input[type=date]").val();
    var itemMenuLunch = $(".content-jadwal-personal").find('.list-jadwal-personal .list-jadwal:last-child').find('input.txtMenuLunch');
    var itemMenuDinner = $(".content-jadwal-personal").find('.list-jadwal-personal .list-jadwal:last-child').find('input.txtMenuDinner');
    var cekLibur = $(".content-jadwal-personal").find('.list-jadwal:last-child').find('input[type=checkbox]').is(':checked');
    var aksiJadwal = $(".content-jadwal-personal input[name=case]").val();
    if (tanggal === '') {
      if (jadwalNotifTanggal == false) {
        jadwalNotifTanggal = true;
        $(".content-jadwal-personal .list-jadwal-personal .list-jadwal:last-child").find("div:first-child div:first-child").append(`<span class="notifTanggal text-sm text-danger">Tanggal masih kosong</span>`);
      }
    } else if (cekLibur || itemMenuLunch.val() != '' && itemMenuDinner.val() != '') {
      if (aksiJadwal == "saveJadwalMenu") { // save jadwal personal
        console.log("save jadwal");
        var contentJadwal = $(".content-jadwal-personal")
        var dataJadwal = [];
        contentJadwal.find(".list-jadwal").each(function (index, element) {
          // console.log(index+1);
          var tanggal = $(element).find('input[type=date]').val();
          var cbLibur = $(element).find('input[type=checkbox]').is(':checked');
          var menuLunch = $(element).find(".txtMenuLunch").val();
          var menuDinner = $(element).find(".txtMenuDinner").val();
          var idMenuLunch = $(element).find("#datalistOptionsLunch" + (index+1) + " option[value='" + menuLunch + "']").data('id');
          var idMenuDinner = $(element).find("#datalistOptionsDinner" + (index+1) + " option[value='" + menuDinner + "']").data('id');
          dataJadwal.push({
            tanggal: tanggal,
            cbLibur: cbLibur,
            idMenuLunch: idMenuLunch,
            idMenuDinner: idMenuDinner
          });
        });
        console.log(dataJadwal);
        $.ajax({
          url: base_url + '/dadmin/jadwal/save/personal',
          type: 'POST',
          data: {
            dataJadwal: dataJadwal,
          },
          dataType: 'json',
          success: function (data) {
            console.log(data);
          }
        });
        window.location.href = base_url + '/dadmin/jadwal';
      } else { // update jadwal personal
        console.log("update jadwal");
        var contentJadwal = $(".content-jadwal-personal");
        var idJadwal = $(this).attr('data-idJadwal');
        var dataJadwal = [];
        contentJadwal.find(".list-jadwal").each(function (index, element) {
          var idJadwalMenu = $(element).data('id') || null;
          var tanggal = $(element).find('input[type=date]').val();
          var cbLibur = $(element).find('input[type=checkbox]').is(':checked');
          var menuLunch = $(element).find(".txtMenuLunch").val();
          var menuDinner = $(element).find(".txtMenuDinner").val();
          var idMenuLunch = $(element).find(".txtMenuLunch").attr("data-idMenuLunch");
          var idMenuDinner = $(element).find(".txtMenuDinner").attr("data-idMenuDinner");
          var idMenuLunchBaru = $(element).find("#datalistOptionsLunch" + (index+1) + " option[value='" + menuLunch + "']").data('id');
          var idMenuDinnerBaru = $(element).find("#datalistOptionsDinner" + (index+1) + " option[value='" + menuDinner + "']").data('id');
          var jadwalType = 
              $(element).hasClass("hapusJadwalMenu") ? "hapus" :
              $(element).hasClass("updateListMenu") ? "update" : 
              $(element).hasClass("bacaJadwalMenu") ? "baca" : 
              $(element).hasClass("tambahListHari") ? "tambah" : null;

          dataJadwal.push({
            idJadwalMenu: idJadwalMenu,
            jadwal: jadwalType,
            tanggal: tanggal,
            cbLibur: cbLibur,
            idMenuLunch: idMenuLunch,
            idMenuDinner: idMenuDinner,
            idMenuLunchBaru: idMenuLunchBaru,
            idMenuDinnerBaru: idMenuDinnerBaru
          });
        });

        console.log(dataJadwal);
        console.log(idJadwal);

        $.ajax({
          url: base_url + '/dadmin/jadwal/update/personal',
          type: 'POST',
          data: {
            idJadwal: idJadwal,
            dataJadwal: dataJadwal
          },
          dataType: 'json',
          success: function (data) {
            console.log(data);
            // window.location.href = base_url + '/dadmin/jadwal';
          }
        });
      }
    } else {
      if (itemMenuLunch.val() == '') {
        if (jadwalNotifMenuLunch == false) {
          jadwalNotifMenuLunch = true;
          itemMenuLunch.parent().append(`<span class="notifMenu text-danger">Menu masih kosong</span>`);
        }
      } else {
        jadwalNotifMenuLunch = false;
        itemMenuLunch.parent().find('span.notifMenu').remove();
      }

      if (itemMenuDinner.val() == '') {
        if (jadwalNotifMenuDinner == false) {
          jadwalNotifMenuDinner = true;
          itemMenuDinner.parent().append(`<span class="notifMenu text-danger">Menu masih kosong</span>`);
        }
      } else {
        jadwalNotifMenuDinner = false;
        itemMenuDinner.parent().find('span.notifMenu').remove();
      }
    }
  })
  // view jadwal personal


  // view pesanan
  $(".content-pesanan .btnApprove").on('click', function(e) {
    var idPesanan = $(this).attr('data-idPesanan');
    $.ajax({
      url: base_url + '/dadmin/pesanan/approved',
      type: 'POST',
      data: {
        idPesanan: idPesanan,
      },
      dataType: 'json',
      success: function (data) {
        console.log(data);
      }
    });
    $(this) // Tombol approve yang diklik
      .siblings(".btnTolakPesanan") // Cari tombol tolak pesanan bersaudara
      .addBack() // Gabungkan dengan tombol approve
      .remove(); // Hapus kedua elemen tersebut
  });

  $(".content-pesanan .btnLihatGambar").on('click', function(e) {
    var idPesanan = $(this).attr('data-idPesanan');
    $.ajax({
      url: base_url + '/dadmin/pesanan/detailPembayaran',
      type: 'POST',
      data: {
        idPesanan: idPesanan,
      },
      dataType: 'json',
      success: function (data) {
        var data = data.dataPembayaran;
        console.log(data);
        $("#modalLihatGambar img").attr("src", "/assets/img/bukti_transfer/" + data.gambar_transfer);
        $("#modalLihatGambar .nama").text(data.atas_nama_pembayaran);
        $("#modalLihatGambar .nominal").text(data.nominal_pembayaran);
      }
    });
  })
  
  urlCek = base_url + '/dadmin/pesananPembayaran';
  if ($(location).attr('href') == urlCek) {
    modalLihatGambar.addEventListener('hidden.bs.modal', event => {
      $("#modalLihatGambar .nama").text("");
      $("#modalLihatGambar .nominal").text("");
    })
  }

  const modalTolakPesanan = document.getElementById('modalTolakPesanan')
  if (modalTolakPesanan) {
    modalTolakPesanan.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget;
      // Extract info from data-bs-* attributes
      const idPesanan = button.getAttribute('data-idPesanan');
      const indexBarix = button.getAttribute('data-indexBaris');

      // Update the modal's content.
      const modalBtnTolak = modalTolakPesanan.querySelector('#modalBtnTolak');
      modalBtnTolak.setAttribute('data-idPesanan', idPesanan);
      modalBtnTolak.setAttribute('data-indexBaris', indexBarix);
    })
  }
  
  $("#modalTolakPesanan #modalBtnTolak").on('click', function(e) {
    var idPesanan = $(this).attr('data-idPesanan');
    var indexBaris = $(this).attr('data-indexBaris');
    $.ajax({
      url: base_url + '/dadmin/pesanan/notApproved',
    type: 'POST',
    data: {
      idPesanan: idPesanan,
    },
    dataType: 'json',
    success: function (data) {
        console.log(data);
      }
    });
    const modalTolakPesanan = document.getElementById('modalTolakPesanan');    
    const modalInstance = bootstrap.Modal.getInstance(modalTolakPesanan);
    modalInstance.hide();
    $(".modal-backdrop").remove();
    var targetRow = $("#tabelPembayaran tr").eq(indexBaris); // Ambil baris berdasarkan index
    var btnTolakPesanan = targetRow.find(".btnTolakPesanan");
    var btnApprove = targetRow.find(".btnTolakPesanan").siblings(".btnApprove");
    btnTolakPesanan.after("Pesanan Ditolak");
    btnTolakPesanan.remove();
    btnApprove.remove();
  });

  const modalKonfirmasiRefund = document.getElementById('modalKonfirmasiRefund')
  if (modalKonfirmasiRefund) {
    modalKonfirmasiRefund.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget;
      const modalBtnKembalikanUang = modalKonfirmasiRefund.querySelector('#modalBtnKembalikanUang');
      const indexBarix = button.getAttribute('data-indexBaris');
      const nohp = button.getAttribute('data-nohp');
      modalBtnKembalikanUang.setAttribute('data-indexBaris', indexBarix);
      modalBtnKembalikanUang.setAttribute('data-nohp', nohp);
      
      if (button.classList.contains('batalMenuPesanan')) {
        const idMenuPesanan = button.getAttribute('data-idMenuPesanan');        
        modalBtnKembalikanUang.setAttribute('data-idMenuPesanan', idMenuPesanan);
        modalKonfirmasiRefund.setAttribute('data-status', "batalMenuPesanan");
      }
      
      if (button.classList.contains('gantiMasaHari')) {
        const idMasaHariBatal = button.getAttribute('data-idMasaHariBatal');
        modalBtnKembalikanUang.setAttribute('data-idMasaHariBatal', idMasaHariBatal);
        modalKonfirmasiRefund.setAttribute('data-status', "gantiMasaHari");
      }
      
      if (button.classList.contains('berhentiPaketan')) {
        const idPesanan = button.getAttribute('data-idPesanan');
        modalBtnKembalikanUang.setAttribute('data-idPesanan', idPesanan);
        modalKonfirmasiRefund.setAttribute('data-status', "berhentiPaketan");
      }
    })
    
    modalKonfirmasiRefund.addEventListener('hide.bs.modal', event => {
      modalKonfirmasiRefund.removeAttribute('data-idMenuPesanan');
      modalKonfirmasiRefund.removeAttribute('data-idMasaHariBatal');
      modalKonfirmasiRefund.removeAttribute('data-idPesanan');
    })
  }

  $("#modalKonfirmasiRefund #modalBtnKembalikanUang").on("click", function() {
    var dataStatus = $("#modalKonfirmasiRefund").attr("data-status");

    var nohp = $(this).attr('data-nohp');
    var idPesanan = $(this).attr('data-idPesanan');
    var idMenuPesanan = $(this).attr('data-idMenuPesanan');
    var idMasaHariBatal = $(this).attr('data-idMasaHariBatal');
    var indexBaris = $(this).attr('data-indexBaris');

    $.ajax({
      url: base_url + '/dadmin/pesanan/kembalikanUang',
      type: 'POST',
      data: {
        idPesanan: idPesanan,
        idMenuPesanan: idMenuPesanan,
        idMasaHariBatal: idMasaHariBatal,
        status: (dataStatus == "gantiMasaHari") ? "gantiMasaHari" : 
              (dataStatus == "berhentiPaketan") ? "berhentiPaketan" : 
              (dataStatus == "batalMenuPesanan") ? "batalMenuPesanan" : null
    },
    dataType: 'json',
    success: function (data) {
        console.log(data);
      }
    });
    const modalKonfirmasiRefund = document.getElementById('modalKonfirmasiRefund');    
    const modalInstance = bootstrap.Modal.getInstance(modalKonfirmasiRefund);
    modalInstance.hide();
    $(".modal-backdrop").remove();
    var btnKembalikanUang = $("#tabelPesananBatal tr").find(`.${dataStatus}[data-indexBaris="${indexBaris}"]`); // Ambil baris berdasarkan index
    btnKembalikanUang.after("Sudah Dikembalikan");
    btnKembalikanUang.remove();

    window.open("https://wa.me/"+ nohp +"?text=Kakak%20ini%20uangnya%20mau%20dikirim%20lewat%20apa%20?");
  })

  $(".btnHapusPesanan").on('click', function(e) {
    var listPesanan = e.target.parentElement.parentElement.parentElement.parentElement;
    listPesanan.remove();
  });
  // view pesanan


  $(".content-tambah-menu").on('change', "#fileGambar", function (event) {
    $(".invalid-feedback, .valid-feedback").remove();
    var fileInput = $('.content-tambah-menu #fileGambar')[0];
    var file = fileInput.files[0];
    var allowedExtensions = ["jpg", "jpeg", "png"];
    var allowedMimeTypes = ["image/jpeg", "image/jpg", "image/png"];
    var preview = $('#previewGambar');


    // Ambil ekstensi file
    var fileExtension = file.name.split('.').pop().toLowerCase();

    // Validasi ekstensi file
    if (!allowedExtensions.includes(fileExtension)) {
      $(".content-tambah-menu #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
          File harus dalam format JPG/JPEG
      </div>`);
      return;
    } else {
      if (event.target.files && event.target.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          preview.attr("src", e.target.result);
          preview.css("display", "block");
        };
        reader.readAsDataURL(event.target.files[0]);
      } else {
        preview.css("display", "none");
      }
      $(".content-tambah-menu #fileGambar").parent().find(".invalid-fileGambar").remove();
    }

    // Validasi tipe MIME
    if (!allowedMimeTypes.includes(file.type)) {
      $(".content-tambah-menu #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
          File harus dalam format JPG/JPEG
      </div>`);
      return;
    } else {
      if (event.target.files && event.target.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          preview.attr("src", e.target.result);
          preview.css("display", "block");
        };
        reader.readAsDataURL(event.target.files[0]);
      } else {
        preview.css("display", "none");
      }
      $(".content-tambah-menu #fileGambar").parent().find(".invalid-fileGambar").remove();
    }
  })

  var klikGambar = false;
  $(".content-edit-menu").on('change', "#fileGambar", function (event) {
    klikGambar = true;
    $(".invalid-feedback, .valid-feedback").remove();
    var fileInput = $('.content-edit-menu #fileGambar')[0];
    var file = fileInput.files[0];
    var allowedExtensions = ["jpg", "jpeg", "png"];
    var allowedMimeTypes = ["image/jpeg", "image/jpg", "image/png"];
    var preview = $('#previewGambar');

    // Ambil ekstensi file
    var fileExtension = file.name.split('.').pop().toLowerCase();

    // Validasi ekstensi file
    if (!allowedExtensions.includes(fileExtension)) {
      $(".content-edit-menu #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
          File harus dalam format JPG/JPEG
      </div>`);
      return;
    } else {
      if (event.target.files && event.target.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          preview.attr("src", e.target.result);
          preview.css("display", "block");
        };
        reader.readAsDataURL(event.target.files[0]);
      } else {
        preview.css("display", "none");
      }
      $(".content-edit-menu #fileGambar").parent().find(".invalid-fileGambar").remove();
    }

    // Validasi tipe MIME
    if (!allowedMimeTypes.includes(file.type)) {
      $(".content-edit-menu #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
          File harus dalam format JPG/JPEG
      </div>`);
      return;
    } else {
      if (event.target.files && event.target.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          preview.attr("src", e.target.result);
          preview.css("display", "block");
        };
        reader.readAsDataURL(event.target.files[0]);
      } else {
        preview.css("display", "none");
      }
      $(".content-edit-menu #fileGambar").parent().find(".invalid-fileGambar").remove();
    }
  })

  $("#formMenu").on('submit', function(e) {
    e.preventDefault();
    
    var namaMenu = $('.content-tambah-menu #namaMenu').val();
    var jenisPack = $('.content-tambah-menu #jenisPack').val();
    var hargaMenu = $('.content-tambah-menu #hargaMenu').val();
    var paketMenu = $('.content-tambah-menu #paketMenu').val();

    var fileInput = $('.content-tambah-menu #fileGambar')[0];
    var file = fileInput.files[0];
    var allowedExtensions = ["jpg", "jpeg"];
    var allowedMimeTypes = ["image/jpeg", "image/jpg"];
    // Ambil ekstensi file
    var fileExtension = file.name.split('.').pop().toLowerCase();
    // Validasi ekstensi file
    if (!allowedExtensions.includes(fileExtension)) {
      $(".content-tambah-menu #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
          File harus dalam format JPG/JPEG
      </div>`);
      return;
    }
    // Validasi tipe MIME
    if (!allowedMimeTypes.includes(file.type)) {
      $(".content-tambah-menu #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
          File harus dalam format JPG/JPEG
      </div>`);
      return;
    }
    
    var formData = new FormData();
    formData.append('namaMenu', namaMenu);
    formData.append('jenisPack', jenisPack);
    formData.append('hargaMenu', hargaMenu);
    formData.append('paketMenu', paketMenu);
    formData.append('fileGambar', fileInput.files[0]);
    // Kirim data menggunakan AJAX
    $.ajax({
      url: base_url + '/dadmin/menu/save',
      type: 'POST',
      data: formData,
      dataType: 'json',
      contentType: false,  // Jangan set Content-Type, biar FormData yang mengatur
      processData: false,  // Jangan memproses data menjadi string
      success: function(response) {
          console.log(response);
          window.location.href = base_url + '/dadmin/menu';
      },
      error: function(xhr, status, error) {
          // Menangani kesalahan
          alert('Terjadi kesalahan saat mengupload!');
      }
    });
  })

  $("#formMenuEdit").on('submit', function(e) {
    e.preventDefault();

    $(".content-edit-menu #fileGambar").parent().find(".invalid-fileGambar").remove();

    var idMenu = $('.content-edit-menu #idMenu').val();
    var gambarLama = $('.content-edit-menu #gambarLama').val();
    var namaMenu = $('.content-edit-menu #namaMenu').val();
    var jenisPack = $('.content-edit-menu #jenisPack').val();
    var hargaMenu = $('.content-edit-menu #hargaMenu').val();
    var paketMenu = $('.content-edit-menu #paketMenu').val();
    var fileInput = $('.content-edit-menu #fileGambar')[0];

    // console.log(idMenu);
    // console.log(gambarLama);
    // console.log(namaMenu);
    // console.log(jenisPack);
    // console.log(hargaMenu);
    // console.log(paketMenu);
    // console.log((fileInput.files[0]) ? fileInput.files[0] : gambarLama);

    if (klikGambar) {
      var file = fileInput.files[0];
      var allowedExtensions = ["jpg", "jpeg"];
      var allowedMimeTypes = ["image/jpeg", "image/jpg"];
      // Ambil ekstensi file
      var fileExtension = file.name.split('.').pop().toLowerCase();
      // Validasi ekstensi file
      if (!allowedExtensions.includes(fileExtension)) {
        $(".content-edit-menu #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
            File harus dalam format JPG/JPEG
        </div>`);
        return;
      } else {
        $(".content-edit-menu #fileGambar").parent().find(".invalid-fileGambar").remove();
      }
      // Validasi tipe MIME
      if (!allowedMimeTypes.includes(file.type)) {
        $(".content-edit-menu #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
            File harus dalam format JPG/JPEG
        </div>`);
        return;
      } else {
        $(".content-edit-menu #fileGambar").parent().find(".invalid-fileGambar").remove();
      }
    }

    var formData = new FormData();
    formData.append('idMenu', idMenu);
    formData.append('gambarLama', gambarLama);
    formData.append('namaMenu', namaMenu);
    formData.append('jenisPack', jenisPack);
    formData.append('hargaMenu', hargaMenu);
    formData.append('paketMenu', paketMenu);
    formData.append('fileGambar', (fileInput.files[0]) ? fileInput.files[0] : null);
    // Kirim data menggunakan AJAX
    $.ajax({
      url: base_url + '/dadmin/menu/update',
      type: 'POST',
      data: formData,
      dataType: 'json',
      contentType: false,  // Jangan set Content-Type, biar FormData yang mengatur
      processData: false,  // Jangan memproses data menjadi string
      success: function(response) {
          console.log(response);
          window.location.href = base_url + '/dadmin/menu';
      },
      error: function(xhr, status, error) {
          // Menangani kesalahan
          alert('Terjadi kesalahan saat mengupload!');
      }
    });
  })

  $("#formMenu select[name='jenisPack']").on('change', function() {
    if(this.value == 1) {
      $("#formMenu input[name='hargaMenu']").attr("disabled", false);
      $("#formMenu select[name='paketMenu']").attr("disabled", true);
      $("#formMenu select[name='jenisKarbo']").attr("disabled", true);
    };

    if(this.value == 2) {
      $("#formMenu input[name='hargaMenu']").attr("disabled", true);
      $("#formMenu select[name='paketMenu']").attr("disabled", false);
      $("#formMenu select[name='jenisKarbo']").attr("disabled", false);
    };
  });

  $(".my-content .content-jadwal").on('focus', '.txtDate', function() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    newToday = yyyy + '-' + mm + '-' + dd;
    // $(this).attr("min", newToday);
    if($(".content-jadwal input[name=case]").val() == "saveJadwalMenu") {
      $(this).attr("min", $(this).attr("min"));
    } else {
      $(this).attr("min", newToday);
    }
  });

  $(".my-navbar .toggleMenu").on('click', function() {
    if (!$(".toggleMenu.dropdownMenu").hasClass("open")) {
      $(".toggleMenu.dropdownMenu").toggleClass("open");
    } else {
      $(".toggleMenu.dropdownMenu").toggleClass("close");
    }
  })

  $(".content-laporan").on('submit', '#filterPerPeriode form', function(e) {
    e.preventDefault();
    $.ajax({
      url: base_url + '/dadmin/laporanByPeriode',
      type: 'POST',
      data: {
        tanggalAwal: $("#filterPerPeriode input[name=tanggalAwal]").val(),
        tanggalAkhir: $("#filterPerPeriode input[name=tanggalAkhir]").val()
      },
      dataType: 'json',
      success: function (data) {
        console.log(data.laporan);
        $("#dataLaporan").html(data.element)
      }
    });
  })

  $(".content-laporan").on("click", ".btnLaporanDetailPelanggan", function() {
    console.log($(this).data("id"));
    $.ajax({
      url: base_url + '/dadmin/laporanByDetailPelanggan',
      type: 'POST',
      data: {id: $(this).data("id")},
      dataType: 'json',
      success: function (data) {
        console.log(data.laporan);
        console.log(data.id);
        $("#dataLaporan").html(data.element)
      }
    });
  })
  
  $(".content-laporan").on("click", "#btnLihatPelanggan", function() {
    $.ajax({
      url: base_url + '/dadmin/laporanByPelanggan',
      type: 'POST',
      dataType: 'json',
      success: function (data) {
        console.log(data.laporan);
        $("#dataLaporan").html(data.element)
      }
    });
  })

  $(".content-laporan select#selectLaporan").on('change', function() {
    if(this.value == "periode" || this.value == "bulan" || this.value == "pelanggan" || this.value == "menu") {
      $(".content-laporan #filterPerPeriode").css("display", 'none');
    };

    if(this.value == "periode") {
      $(".content-laporan #filterPerPeriode").css("display", 'block');
      
      $.ajax({
        url: base_url + '/dadmin/laporanByPeriode',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
          console.log(data.laporan);
          $("#dataLaporan").html(data.element)
        }
      });
    };
    
    if(this.value == "bulan") {
      $.ajax({
        url: base_url + '/dadmin/laporanByBulan',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
          console.log(data.laporan);
          console.log(data.data);
          $("#dataLaporan").html(data.element)
        }
      });
    };

    if(this.value == "pelanggan") {
      $.ajax({
        url: base_url + '/dadmin/laporanByPelanggan',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
          console.log(data.laporan);
          $("#dataLaporan").html(data.element)
        }
      });
    };

    if(this.value == "menu") {
      $.ajax({
        url: base_url + '/dadmin/laporanByMenu',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
          console.log(data.laporan);
          $("#dataLaporan").html(data.element)
        }
      });
    };
  });

})