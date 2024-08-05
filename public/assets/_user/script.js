$( document ).ready(function() {

  $(".btnLanjutBayar").on('click', function() {
    $(".my-collapse").css("display", "block");
  });

  $(".btnBatalLanjutBayar").on('click', function() {
    $(".my-collapse").css("display", "none");
  });

  $(".my-dropdown").on('click', function(){
    if (!$(this).hasClass("dropDownTrue")) {
      $(this).find(".my-dropdown-menu").css("display", "block");
      $(this).addClass('dropDownTrue');
    } else {
      $(this).find(".my-dropdown-menu").css("display", "none");
      $(this).removeClass('dropDownTrue');
    }
  });

  $(".txtDate").on('focus', function() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    $(this).attr("min", today);
  });

  // view daftar pesanan
  $(".btnHapusList").on('click', function(e) {
    var totalHargaMenu = 0;
    var listPesanan = e.target.parentElement.parentElement.parentElement;
    listPesanan.remove();
    var listItemsMenu = $(".list-daftar-pesanan");
    listItemsMenu.find("li").each(function (index, element) {
      var qtyMenu = parseInt($(element).find(".qtyMenu").val());
      var hargaMenu = parseInt($(element).find(".hargaMenu").text());
      totalHargaMenu = totalHargaMenu + (qtyMenu*hargaMenu);
    });
    if (totalHargaMenu == 0) {
      $(".content-daftar-pesanan .dataPesanan").remove();
      $(".content-daftar-pesanan .dataPembayaran").remove();
      $(".content-daftar-pesanan .InfoDaftarPesanan").css("display", "block");
    }
    $(".totalHargaMenu").text("Rp. " + totalHargaMenu);
    var stringHargaOngkir = $(".hargaOngkir").text();
    var hargaOngkir = stringHargaOngkir.split(" ");
    $(".totalHargaMenuKeseluruhan").text("Rp. " + (totalHargaMenu+parseInt(hargaOngkir[1])));
  })

  $(".content-daftar-pesanan .qtyMenu").on('keyup', function(e) {
    if (e.code == 'KeyE' || e.code == 'Minus' || $(this).val() == '') {
      $(this).val();
    }

    var totalHargaMenu = 0;
    var listItemsMenu = $(".list-daftar-pesanan");
    listItemsMenu.find("li").each(function (index, element) {
      var qtyMenu = parseInt($(element).find(".qtyMenu").val());
      var hargaMenu = parseInt($(element).find(".hargaMenu").text());
      totalHargaMenu = totalHargaMenu + (qtyMenu*hargaMenu);
    });
    $(".totalHargaMenu").text("Rp. " + totalHargaMenu);
    var stringHargaOngkir = $(".hargaOngkir").text();
    var hargaOngkir = stringHargaOngkir.split(" ");
    $(".totalHargaMenuKeseluruhan").text("Rp. " + (totalHargaMenu+parseInt(hargaOngkir[1])));
  })

  $(".content-daftar-pesanan .my-form-checkbox").on('click', function() {
    if (!$(this).hasClass("checked")) {
      $(this).addClass("checked")
      $(this).find("input[type=checkbox]").prop('checked', true);
    } else {
      $(this).removeClass("checked")
      $(this).find("input[type=checkbox]").prop('checked', false);
    }
  })
  // view daftar pesanan

  // view homepage
  $(".homepage").on('click', '.my-form-checkbox', function() {
    if (!$(this).hasClass("checked")) {
      $(this).addClass("checked")
      $(this).find("input[type=checkbox]").prop('checked', true);
    } else {
      $(this).removeClass("checked")
      $(this).find("input[type=checkbox]").prop('checked', false);
    }
  })

  $(".personal .btnPilihMenu").on('click', function() {
    if (!$(this).hasClass("aktifPilih")) {
      $(this).addClass("aktifPilih");
      $(this).parent().parent().parent().find("li:nth-child(1) span:nth-child(2)").text("Batal Pilih");
      $(this).parent().parent().parent().find("button").css("display", "block");
      $(this).parent().parent().parent().find("input").css("display", "block");
    } else {
      $(this).parent().parent().parent().find("input").prop('checked', false);
      $(this).removeClass("aktifPilih");
      $(this).parent().parent().parent().find("li:nth-child(1) span:nth-child(2)").text("Pilih Menu");
      $(this).parent().parent().parent().find("button").css("display", "none");
      $(this).parent().parent().parent().find("input").css("display", "none");
    }
  })

  $(".family .btnPilihMenu").on('click', function() {
    $(this).attr("data-bs-toggle", "modal");
    $(this).attr("data-bs-target", "#modalPilihMenu");
    $(this).addClass("modalPilihMenu");
    $(this).addClass("modalFamily");
    $(this).text("Lanjut");
    $(this).parent().find("button:nth-child(2)").css("display", "block");
    $(this).parent().parent().parent().find("input").css("display", "block");
  })

  $(".family .btnBatalPilih").on('click', function() {
    $(this).parent().find("button:nth-child(1)").removeAttr("data-bs-toggle", "modal");
    $(this).parent().find("button:nth-child(1)").removeAttr("data-bs-target", "modalPilihMenu");
    $(this).parent().find("button:nth-child(1)").removeClass("modalPilihMenu");
    $(this).parent().find("button:nth-child(1)").removeClass("modalFamily");
    $(this).parent().parent().parent().find("input").prop('checked', false);
    $(this).parent().find("button:nth-child(1)").text("Pilih Menu");
    $(this).parent().find("button:nth-child(2)").css("display", "none");
    $(this).parent().parent().parent().find("input").css("display", "none");
  })

  var expanded = false;
  $(".selectBox").on('click', function(e) {
    if ($(e.target).className = "overSelect") {
      if (!expanded) {
        $("#checkboxes").css("display", "block");
        expanded = true;
      } else {
        $("#checkboxes").css("display", "none");
        expanded = false;
      }
    }
  })

  var hargaPaketTerpilih = [];
  var nilaiHargaPaket = 0;
  var totalHargaPaket = 0;
  $("#modalPaketan #checkboxes input").on('click', function() {
    // Mendapatkan harga dari elemen yang diklik
    var harga = parseInt($(this).attr("data-harga"));
    // Jika checkbox dicentang
    if ($(this).prop("checked") == true) {
      hargaPaketTerpilih.push(harga);
      // Menghitung total harga
      nilaiHargaPaket = hargaPaketTerpilih.reduce(function(total, currentValue) {
          return total + currentValue;
      }, 0);
      var jumlahHari = $("#modalPaketan input[name=jumlahHari]").val();
      totalHargaPaket = parseInt(jumlahHari) * nilaiHargaPaket;
      $("#modalPaketan .totalHargaMenu").text("Rp." + totalHargaPaket);
    } else {
      // Jika checkbox tidak dicentang
      var index = hargaPaketTerpilih.indexOf(harga);
      if (index !== -1) {
          hargaPaketTerpilih.splice(index, 1);
      }
      // Menghitung total harga setelah penghapusan
      nilaiHargaPaket = hargaPaketTerpilih.reduce(function(total, currentValue) {
          return total + currentValue;
      }, 0);
      totalHargaPaket = nilaiHargaPaket;
      $("#modalPaketan .totalHargaMenu").text("Rp." + nilaiHargaPaket);
    }
    var stringHargaOngkir = $(".hargaOngkir").text();
    var hargaOngkir = stringHargaOngkir.split(" ");
    $(".totalHargaMenuKeseluruhan").text("Rp. " + (totalHargaPaket+parseInt(hargaOngkir[1])));
  });

  $("#modalPaketan input[name=jumlahHari]").on('keyup', function() {
    var totalHargaMenu = parseInt($(this).val()) * nilaiHargaPaket;
    $(".totalHargaMenu").text("Rp. " + totalHargaMenu);
    var stringHargaOngkir = $(".hargaOngkir").text();
    var hargaOngkir = stringHargaOngkir.split(" ");
    $(".totalHargaMenuKeseluruhan").text("Rp. " + (totalHargaMenu+parseInt(hargaOngkir[1])));
  })

  const modalPaketan = document.getElementById('modalPaketan')
  modalPaketan.addEventListener('hidden.bs.modal', event => {
    $("#modalPaketan #txtAtasNama").val('');
    $("#modalPaketan #txtNominal").val('');
    $("#modalPaketan .txtPantangan").val('');
    $("#modalPaketan #txtGambar").val('');
    $("#modalPaketan #jumlahHari").val('1');
    $("#modalPaketan .totalHargaMenu").text('Rp. 0');
    $("#modalPaketan .txtDate").val('');
    $("#modalPaketan .my-collapse").css("display", "none");
    $("#modalPaketan #checkboxes").css("display", "none");
    $("#modalPaketan .totalHargaMenuKeseluruhan").text($(".hargaOngkir").text());
    var selectCheck = $("#modalPaketan #checkboxes");
    selectCheck.find("input").each(function (index, element) {
      $(element).prop("checked", false);
    });
    expanded = false;
  })

  $("#modalPilihMenu").on('click', '.btnHapusList', function(e) {
    var listPesanan = e.target.parentElement.parentElement.parentElement;
    var dataListPesanan = e.target.parentElement.parentElement.parentElement.parentElement;
    listPesanan.remove();
    if (dataListPesanan.getElementsByTagName('li').length == 0 ) {
      $("#modalPilihMenu .modal-footer").find("button")[1].click();
    }
  })

  $(".content-homepage").on('click', '.modalPilihMenu', function() {
    if ($(this).hasClass("modalPersonal")) {
      $("#modalPilihMenu .modal-dialog").addClass('modal-lg');
      var ul = $(this).parent().parent().parent().parent();
      ul.find("li").each(function (index, element) {
        if (index == 0) {
          var tanggalMenu = $(element).find(".tanggalMenuPersonal").text();
          $("#modalPilihMenu .modal-header span").text(tanggalMenu);
        }
        var jenisPaketMenu = $(element).find("span[class=jenisPaketMenu]").text();
        var menu = $(element).find("span[class=menuPersonal]").text();
        var hargaMenu = $(element).find("span[class=hargaMenuPersonal]").text();
        if ($(element).find("input[type=checkbox]").prop("checked") == true && index == 3) {
          $("#modalPilihMenu ul").append(
            `<li class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <p class="lh-sm m-0"><span class="fw-bold">` + jenisPaketMenu + ` ` + hargaMenu + `</span><br>` + menu + `</p>
                  </div>
                  <div class="col-auto">
                    <button type="button" class="btn btn-sm btn-danger rounded-pill my-border-btn btnHapusList">Hapus</button>
                  </div>
                </div>
              </li>`);
        } else if ($(element).find("input[type=checkbox]").prop("checked") == true) {
          $("#modalPilihMenu ul").append(
            `<li class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <p class="lh-sm m-0"><span class="fw-bold">` + jenisPaketMenu + ` ` + hargaMenu + `</span><br>` + menu + `</p>
                    <div class="d-flex align-items-center mt-2">
                      <span class="mx-1">Qty</span>
                      <input class="form-control form-control-sm my-border-input border border-0 mx-1 px-1 py-0 qtyMenu" style="width: 6ch;" type="number" min="1" oninput="validity.valid||(value='');" name="" value="1">
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="mb-3">
                      <select class="form-select form-select-sm my-border-input w-auto" style="height:fit-content;" id="selectKarbo" required>
                        <option selected disabled value="">Pilih Karbo</option>
                        <option value="1">Nasi Merah</option>
                        <option value="2">Maspotato</option>
                      </select>
                    </div>
                    <div>
                      <input type="text" class="form-control form-control-sm my-border-input w-50 txtPantangan w-100" placeholder="Masukkan Pantangan" required>
                    </div>
                  </div>
                  <div class="col-auto">
                    <button type="button" class="btn btn-sm btn-danger rounded-pill my-border-btn btnHapusList">Hapus</button>
                  </div>
                </div>
              </li>`);
        }
      });
    }

    if ($(this).hasClass("modalFamily")) {
      var ul = $(this).parent().parent().parent();
      ul.find("li").each(function (index, element) {
        if (index == 0) {
          var tanggalMenu = $(element).find("span").text();
          $("#modalPilihMenu .modal-header span").text(tanggalMenu);
        }
        var jenisPaketMenu = $(element).find("span[class=jenisPaketMenu]").text();
        var menu = $(element).find("span[class=menuFamily]").text();
        var hargaMenu = $(element).find("span[class=hargaMenuFamily]").text();
        if ($(element).find("input[type=checkbox]").prop("checked") == true) {
          $("#modalPilihMenu ul").append(
            `<li class="list-group-item">
                <div class="row align-items-center">
                  <div class="col">
                    <p class="my-0">` + menu + `<br><span class="fw-bold">` + hargaMenu + `</span></span></p>
                  </div>
                  <div class="col-auto d-flex flex-nowrap align-items-center">
                    <span class="mx-1">Qty</span>
                    <input class="form-control form-control-sm my-border-input border border-0 mx-1 px-1 py-0 qtyMenu" style="width: 6ch;" type="number" min="1" oninput="validity.valid||(value='');" name="" value="1">
                    <div class="my-form-checkbox">
                      <input class="form-check-input my-border-input mx-1" type="checkbox">
                      <label class="form-check-label" for="cbPedas">Pedas</label>
                    </div>
                  </div>
                  <div class="col-auto">
                    <button type="button" class="btn btn-sm btn-danger rounded-pill my-border-btn btnHapusList">Hapus</button>
                  </div>
                </div>
              </li>`);
        }
      });
    }
  })

  const modalPilihMenu = document.getElementById('modalPilihMenu');
  modalPilihMenu.addEventListener('hidden.bs.modal', event => {
    $("#modalPilihMenu .modal-dialog").removeClass('modal-lg');

    var listMenuPersonal = $(".content-homepage .personal-menu ul");
    listMenuPersonal.find("li").each(function (index, element) {
      $(element).find(".btnPilihMenu span:nth-child(2)").text("Pilih Menu");
      $(element).find(".btnPilihMenu").removeClass("aktifPilih");
      $(element).find("input[type=checkbox]").prop("checked", false);
      $(element).find("input").css("display", "none");
      $(element).find("button.modalPilihMenu").css("display", "none");
    });

    var listMenuFamily = $(".content-homepage .family-menu ul");
    listMenuFamily.find("li").each(function (index, element) {
      $(element).find("button:nth-child(1)").removeAttr("data-bs-toggle", "modal");
      $(element).find("button:nth-child(1)").removeAttr("data-bs-target", "modalPilihMenu");
      $(element).find("button:nth-child(1)").removeClass("modalPilihMenu");
      $(element).find("button:nth-child(1)").removeClass("modalFamily");
      $(element).find("button:nth-child(1)").text("Pilih Menu");
      $(element).find("input[type=checkbox]").prop("checked", false);
      $(element).find("input").css("display", "none");
      $(element).find("button.btnBatalPilih").css("display", "none");
    });
    $("#modalPilihMenu ul li").remove();
  })

  $('.page-scroll').on('click', function (e) {
    var tujuan = $(this).attr('href');
    var elemenTujuan = $(tujuan);
    // console.log(elemenTujuan.offset().top); // mengetahui / mencari jarak elemen ke atas browser

    //pindahkan scroll
    $('html').animate({
        scrollTop: elemenTujuan.offset().top - 65
    }, 500, 'swing');

    e.preventDefault();
  })
  // view homepage

});