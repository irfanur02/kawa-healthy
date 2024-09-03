$(document).ready(function() {

  // var base_url = "http://localhost:81/kawa-healthy/";
  var base_url = "http://localhost:8080";
  let eventSource = '';
  var jadwalNotifTanggal = false;
  var jadwalNotifMenu = false;

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
                        <td>${data.dataPencarian[i].nama_menu}</td>
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
              <td>${data.dataPencarian.nama_menu}</td>
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
                        <td>${data.dataPencarian[i].nama_menu}</td>
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
    if($(this).is(':checked')) {
      $(this).parent().parent().parent().find('li:nth-child(2)').remove();
    } else {
      jadwalNotifMenu = false;
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
    var listMenu = e.target.parentElement.parentElement.parentElement.parentElement.parentElement;
    listMenu.remove();
  })

  $("#btnTambahHariFamily").on('click', function() {
    var cekLibur = $(".content-jadwal-family").find('ul.list-content-jadwal:last-child').find('input[type=checkbox]').is(':checked');
    var tanggal = $(".content-jadwal-family").find("ul.list-content-jadwal:last-child").find("input[type=date]").val();
    var listItemMenu = $(".content-jadwal-family").find('ul.list-content-jadwal:last-child').find('ul.list-tambah-menu li');
    if (tanggal == '') {
      if (jadwalNotifTanggal == false) {
        jadwalNotifTanggal = true;
        $(".content-jadwal-family ul.list-content-jadwal:last-child").find("li:first-child div:first-child").append(`<span class="notifTanggal text-danger">Tanggal masih kosong</span>`);
      }
    } else if (cekLibur || listItemMenu.length > 0) {
      $(".content-jadwal-family").append(`
                  <ul class="list-group list-content-jadwal fw-medium" style="width: 13em;">
                    <li class="list-group-item border border-black text-center">
                      <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">Mulai</label>
                        <input type="date" class="form-control form-control-sm my-border-input txtDate jadwalFamily"
                          style="width: fit-content; margin: auto;">
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input my-border-input cbLibur" type="checkbox">
                        <label class="form-check-label" for="cbLibur">Libur</label>
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
    if ($(".content-jadwal-family").find('ul.list-content-jadwal').length != 1) {
      var listJadwalMenu = e.target.parentElement.parentElement;
      listJadwalMenu.remove();
    }
  })

  $(".my-content .btnPostMenuFamily").on('click', function() {
    var tanggal = $(".content-jadwal-family").find("ul.list-content-jadwal:last-child").find("input[type=date]").val();
    var listItemMenu = $(".content-jadwal-family").find('ul.list-content-jadwal:last-child').find('ul.list-tambah-menu li');
    var cekLibur = $(".content-jadwal-family").find('ul.list-content-jadwal:last-child').find('input[type=checkbox]').is(':checked');
    var updateJadwalMenu = $(".content-jadwal-family").find('.updateJadwalMenu');
    if (tanggal === '') {
      if (jadwalNotifTanggal == false) {
        jadwalNotifTanggal = true;
        $(".content-jadwal-family ul.list-content-jadwal:last-child").find("li:first-child div:first-child").append(`<span class="notifTanggal text-danger">Tanggal masih kosong</span>`);
      }
    } else if (cekLibur || listItemMenu.length > 0) {
      if (updateJadwalMenu.length == 0) { // save jadwal family
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
        var contentJadwal = $(".content-jadwal-family")
        var idJadwal = $(this).data('id');
        var dataJadwal = [];
        contentJadwal.find("ul.list-content-jadwal").each(function (index, element) {
          var itemsMenu = [];
          var idJadwalMenu = $(element).data('id');
          var tanggal = $(element).find('input[type=date]').val();
          var cbLibur = $(element).find('input[type=checkbox]').is(':checked');
          var listItemMenu = $(element).find('.list-tambah-menu');
          listItemMenu.find("li").each(function (index, element) {
            var idMenu = $(element).find('input').val();
            itemsMenu.push(idMenu);
          })
          dataJadwal.push({
            idJadwalMenu: idJadwalMenu,
            tanggal: tanggal,
            cbLibur: cbLibur,
            itemsMenu: itemsMenu
          });
        });
        $.ajax({
          url: base_url + '/dadmin/jadwal/update/family',
          type: 'POST',
          data: {
            idJadwal: idJadwal,
            dataJadwal: dataJadwal
          },
          dataType: 'json',
          success: function (data) {
            window.location.href = base_url + '/dadmin/jadwal';
          }
        });
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
  });
  
  $(".list-jadwal-personal").on('click', '.btnListHapusJadwal', function(e) {
    var listJadwalMenu = e.target.parentElement.parentElement;
    listJadwalMenu.remove();
  });

  $(".content-jadwal-personal").on('keydown', '.my-form-jadwal-personal .txtMenuLunch', function(e) {
    eventSource = e.key ? 'typed' : 'clicked';
  })

  $(".content-jadwal-personal").on('keydown', '.my-form-jadwal-personal .txtMenuLunch', function(e) {
    if (eventSource === 'clicked') {
      $(this).attr('data-menuLunch', true);
      console.log("lunch");
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
      console.log("dinner");
    } else {
      $(this).attr('data-menuDinner', false);
    }
  })

  $(".content-jadwal-personal").on('keyup', '.my-form-jadwal-personal .txtMenuLunch', function() {
    $(this).parent().find('span.notifMenu').remove();
    var keyword = $(this).val();
    var numCardFormJadwal = $(this).parent().parent().parent().parent().index() + 1;
    console.log(numCardFormJadwal);
    var txtMenuLunch = $(this).parent().find("datalist#datalistOptionsLunch" + numCardFormJadwal);
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
          console.log(data);
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
    var numCardFormJadwal = $(this).parent().parent().parent().index() + 1;
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
    var cardFormJadwal = $(".content-jadwal-personal").find(".list-jadwal");
    var tanggal = $(".content-jadwal-personal").find(".list-jadwal-personal .list-jadwal:last-child").find("input[type=date]").val();
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
        <div class="list-jadwal mt-4 text-center">
          <div class="sublist-jadwal border border-black rounded-start ">
            <div class="mb-2" >
              <label for="exampleFormControlInput1" class="form-label">Mulai</label>
              <input type="date" class="form-control form-control-sm my-border-input txtDate jadwalPersonal"
                  style="width: fit-content; margin: auto;">
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input my-border-input cbLibur" id="cBoxLibur" type="checkbox">
              <label class="form-check-label" for="cBoxLibur">Libur</label>
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
    var updateJadwalMenu = $(".content-jadwal-personal").find('.updateJadwalMenu');
    if (tanggal === '') {
      if (jadwalNotifTanggal == false) {
        jadwalNotifTanggal = true;
        $(".content-jadwal-personal .list-jadwal-personal .list-jadwal:last-child").find("div:first-child div:first-child").append(`<span class="notifTanggal text-sm text-danger">Tanggal masih kosong</span>`);
      }
    } else if (cekLibur || itemMenuLunch.val() != '' && itemMenuDinner.val() != '') {
      if (updateJadwalMenu.length == 0) { // save jadwal personal
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
            window.location.href = base_url + '/dadmin/jadwal';
          }
        });
      } else { // update jadwal personal
        var contentJadwal = $(".content-jadwal-personal")
        var idJadwal = $(this).data('id');
        var dataJadwal = [];
        contentJadwal.find("ul.list-content-jadwal").each(function (index, element) {
          var itemsMenu = [];
          var idJadwalMenu = $(element).data('id');
          var tanggal = $(element).find('input[type=date]').val();
          var cbLibur = $(element).find('input[type=checkbox]').is(':checked');
          var listItemMenu = $(element).find('.list-tambah-menu');
          listItemMenu.find("li").each(function (index, element) {
            var idMenu = $(element).find('input').val();
            itemsMenu.push(idMenu);
          })
          dataJadwal.push({
            idJadwalMenu: idJadwalMenu,
            tanggal: tanggal,
            cbLibur: cbLibur,
            itemsMenu: itemsMenu
          });
        });
        $.ajax({
          url: base_url + '/dadmin/jadwal/update/personal',
          type: 'POST',
          data: {
            idJadwal: idJadwal,
            dataJadwal: dataJadwal
          },
          dataType: 'json',
          success: function (data) {
            window.location.href = base_url + '/dadmin/jadwal';
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



  $(".btnHapusPesanan").on('click', function(e) {
    var listPesanan = e.target.parentElement.parentElement.parentElement.parentElement;
    listPesanan.remove();
  });

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
    $(this).attr("min", newToday);
  });

  $(".my-navbar .toggleMenu").on('click', function() {
    if (!$(".toggleMenu.dropdownMenu").hasClass("open")) {
      $(".toggleMenu.dropdownMenu").toggleClass("open");
    } else {
      $(".toggleMenu.dropdownMenu").toggleClass("close");
    }
  })

  $(".content-laporan select#selectLaporan").on('change', function() {
    if(this.value == "periode") {
      $(".content-laporan #filterPerPeriode").css("display", 'block');
    };

    if(this.value == "bulan") {
      $(".content-laporan #filterPerPeriode").css("display", 'none');
    };
  });

})