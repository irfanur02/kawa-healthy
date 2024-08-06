$(document).ready(function() {

  // var base_url = "http://localhost:81/kawa-healthy/";
  var base_url = "http://localhost:8080";

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

  let eventSource = '';
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

  $("#btnBuatJadwal").on('click', function() {
    if($("#selectJenisPack").val() == 1) {
      window.location.href = base_url + 'dadmin/jadwalMenu/family'
    }
    
    if($("#selectJenisPack").val() == 2) {
      window.location.href = base_url + 'dadmin/jadwalMenu/personal'
    }
  })

  $(".my-content .content-jadwal").on('focus', '.txtDate', function() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    // var itemJadwal = $(".content-jadwal input[type=date]").length;
    // var newToday = '';
    // if (itemJadwal == 1) {
      newToday = yyyy + '-' + mm + '-' + dd;
    // } else {
    //   if ($(this).hasClass('jadwalFamily')) {
    //     newToday = $(this).parent().parent().parent().parent().find(`ul:nth-child(${itemJadwal-1}) input[type=date]`).val();
    //   } else {
    //     newToday = $(this).parent().parent().parent().parent().find(`div.list-jadwal:nth-child(${itemJadwal-1}) input[type=date]`).val();
    //   }
    //   var date = newToday.split('-');
    //   var getDay = parseInt(date[2])+1; 
    //   var newDay = String(getDay).padStart(2, '0');
    //   var newToday = date[0] + '-' + date[1] + '-' + newDay;
    // }
    $(this).attr("min", newToday);
  });

  $("#btnTambahHariFamily").on('click', function() {
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
                <input class="form-control form-control-sm rounded-0 my-border-input" type="text" name="" id="txtMenu"
                  list="datalistOptions" placeholder="Ketik Menu">
                <datalist id="datalistOptions">
                  <option value="Nasi">
                  <option value="Potato">
                </datalist>
                <button class="btn btn-sm btn-primary rounded-0 my-border-btn btnTambahMenu">Tambahkan</button>
              </div>
              <ul class="list-group list-tambah-menu mt-2">
              </ul>
            </li>
          </ul>`);
  });

  $(".content-jadwal-family").on('click', '.btnTambahMenu', function() {
    var menu = $(this).parent().find("input").val();
    $(this).parent().parent().find(".list-tambah-menu").append(
      `<li class="list-group-item">
          <div class="row">
            <div class="col">
              <span class="text-wrap">${menu}</span>
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
  })

  $(".content-jadwal-family").on('click', '.btnListHapusJadwal', function(e) {
    var listJadwalMenu = e.target.parentElement.parentElement;
    listJadwalMenu.remove();
  })

  $(".content-jadwal-family").on('click', '.btnHapusListMenu', function(e) {
    var listMenu = e.target.parentElement.parentElement.parentElement.parentElement.parentElement;
    listMenu.remove();
  })
  
  $(".content-jadwal-family").on('change', '.cbLibur', function(e) {
    var listContentJadwal = e.target.parentElement.parentElement.parentElement;
    if(this.checked == true) {
      listContentJadwal.children[1].remove();
    } else {
      listContentJadwal.innerHTML += `<li class="list-group-item border border-top-0 border-black">
              <div class="my-form-jadwal-family">
                <input class="form-control form-control-sm rounded-0 my-border-input" type="text" name="" id="txtMenu"
                  list="datalistOptions" placeholder="Ketik Menu">
                <datalist id="datalistOptions">
                  <option value="Nasi">
                  <option value="Potato">
                </datalist>
                <button class="btn btn-sm btn-primary rounded-0 my-border-btn btnTambahMenu">Tambahkan</button>
              </div>
              <ul class="list-group list-tambah-menu mt-2">
              </ul>
            </li>`;
    }
  })

  $("#btnTambahHariPersonal").on('click', function() {
    $(".list-jadwal-personal").append(`<div class="list-jadwal mt-4 text-center">
            <div class="sublist-jadwal border border-black rounded-start ">
              <div class="mb-2" >
                <label for="exampleFormControlInput1" class="form-label">Mulai</label>
                <input type="date" class="form-control form-control-sm my-border-input txtDate"
                    style="width: fit-content; margin: auto;">
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input my-border-input cbLibur" type="checkbox">
                  <label class="form-check-label" for="cbLibur">Libur</label>
                </div>
                <br>
                <button type="button" class="btn mt-1 btn-sm btn-danger rounded-pill my-border-btn btnListHapusJadwal">Hapus</button>
            </div>
            <div class="sublist-jadwal border-top border-bottom border-black">
              <div class="header-list ">Lunch</div>
              <div class="body-list ">
                <div class="mb-3">
                  <label for="txtMenuLunch" class="form-label">Cari</label>
                  <input type="text" class="form-control form-control-sm my-border-input" id="txtMenuLunch" list="datalistOptions">
                  <datalist id="datalistOptions">
                    <option value="Nasi">
                    <option value="Potato">
                  </datalist>
                </div>
              </div>
            </div>
            <div class="sublist-jadwal border border-black rounded-end">
              <div class="header-list ">Dinner</div>
              <div class="body-list ">
                <label for="txtMenuDinner" class="form-label">Cari</label>
                <input type="text" class="form-control form-control-sm my-border-input" id="txtMenuDinner" list="datalistOptions">
                <datalist id="datalistOptions">
                  <option value="Nasi">
                  <option value="Potato">
                </datalist>
              </div>
            </div>
          </div>`);
  });

  $(".list-jadwal-personal").on('click', '.btnListHapusJadwal', function(e) {
    var listJadwalMenu = e.target.parentElement.parentElement;
    listJadwalMenu.remove();
  });

  $(".list-jadwal-personal").on('change', '.cbLibur', function(e) {
    var listContentJadwal = e.target.parentElement.parentElement.parentElement;
    if(this.checked == true) {
      for (var i = 2; i >= 1; i--) {
        listContentJadwal.children[i].remove();
      }
    } else {
      listContentJadwal.innerHTML += `<div class="sublist-jadwal border-top border-bottom border-black">
              <div class="header-list ">Lunch</div>
              <div class="body-list ">
                <div class="mb-3">
                  <label for="txtMenuLunch" class="form-label">Cari</label>
                  <input type="text" class="form-control form-control-sm my-border-input" id="txtMenuLunch" list="datalistOptions">
                  <datalist id="datalistOptions">
                    <option value="Nasi">
                    <option value="Potato">
                  </datalist>
                </div>
              </div>
            </div>
            <div class="sublist-jadwal border border-black rounded-end">
              <div class="header-list ">Dinner</div>
              <div class="body-list ">
                <label for="txtMenuDinner" class="form-label">Cari</label>
                <input type="text" class="form-control form-control-sm my-border-input" id="txtMenuDinner" list="datalistOptions">
                <datalist id="datalistOptions">
                  <option value="Nasi">
                  <option value="Potato">
                </datalist>
              </div>
            </div>`;
    }
  });

  $(".btnHapusPesanan").on('click', function(e) {
    var listPesanan = e.target.parentElement.parentElement.parentElement.parentElement;
    listPesanan.remove();
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