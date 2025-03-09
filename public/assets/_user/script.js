$( document ).ready(function() {

  // var base_url = "http://localhost:81/kawa-healthy/";
  var base_url = "http://localhost:8080";
  var urlCek;
  var nilaiHargaPaket = 0;

  $("#tanggalMulai").on("change", function () {
    // $(".invalid-feedback, .valid-feedback").remove();
    var tanggal = $("#modalPaketan input[name=tanggal]");
    if (tanggal.val() === null || tanggal.val() === "") {
      // tanggal.removeClass('is-valid').addClass('is-invalid');
      tanggal.parent().append(`<div class="text-danger invalid-tanggal">
                Tanggal belum diisi
            </div>`);
        return; // Berhenti jika validasi gagal
    } else {
      tanggal.parent().find(".invalid-tanggal").remove(); // Hapus kelas invalid jika valid
    }
  })
  
  $("#selectKarbo").on("change", function () {
    $(".invalid-feedback, .valid-feedback").remove();
    var karbo = $("#modalPaketan select[name=karbo]");
    if (karbo.val() === null || karbo.val() === "") {
      karbo.removeClass('is-valid').addClass('is-invalid');
      karbo.parent().append(`<div class="invalid-feedback invalid-karbo">
                Karbo belum diisi
            </div>`);
        return; // Berhenti jika validasi gagal
    } else {
      karbo.removeClass('is-invalid'); // Hapus kelas invalid jika valid
    }
  })
  
  $("#modalPaketan").on("change", "#selectKota", function () {
    $(".invalid-feedback, .valid-feedback").remove();
    var kota = $("#modalPaketan select[name=kota]");
    console.log(kota.val());
    if (kota.val() === null || kota.val() === "") {
      kota.removeClass('is-valid').addClass('is-invalid');
      kota.parent().append(`<div class="invalid-feedback invalid-kota">
                Kota belum diisi
            </div>`);
        return; // Berhenti jika validasi gagal
    } else {
      kota.removeClass('is-invalid'); // Hapus kelas invalid jika valid
    }
  })
  
  $("#modalPaketan").on('keyup', "#txtAlamat", function () {
    console.log($(this).val());
    $(".invalid-feedback, .valid-feedback").remove();
    var alamat = $("#modalPaketan input[name=alamat]");
    if (alamat.val() === null || alamat.val() === "") {
      alamat.removeClass('is-valid').addClass('is-invalid');
      alamat.parent().append(`<div class="invalid-feedback invalid-alamat">
                Alamat belum diisi
            </div>`);
        return; // Berhenti jika validasi gagal
    } else {
      alamat.removeClass('is-invalid'); // Hapus kelas invalid jika valid
    }
  })

  $(".btnLanjutBayar").on('click', function() {
    var karbo = $("#modalPaketan select[name=karbo]");
    var kota = $("#modalPaketan select[name=kota]");
    var alamat = $("#modalPaketan input[name=alamat]");
    var tanggal = $("#modalPaketan input[name=tanggal]");
    var checkedBoxes = $(".cbkPaketMenu:checked"); // Ambil semua checkbox yang dicentang
    var multiselect = $(".multiselect"); // Ambil semua checkbox yang dicentang

    $(".invalid-feedback, .valid-feedback").remove();

    if (checkedBoxes.length === 0) {
      multiselect.append(`<div class="text-danger invalid-paket-menu">
                Paket Menu belum diisi
            </div>`);
        return; // Berhenti jika validasi gagal
    } else {
      multiselect.find(".invalid-paket-menu").remove(); // Hapus kelas invalid jika valid
    }

    // Validasi tanggal
    if (tanggal.val() === null || tanggal.val() === "") {
      // tanggal.removeClass('is-valid').addClass('is-invalid');
      tanggal.parent().append(`<div class="text-danger invalid-tanggal">
                Tanggal belum diisi
            </div>`);
        return; // Berhenti jika validasi gagal
    } else {
      tanggal.find(".invalid-tanggal").remove(); // Hapus kelas invalid jika valid
    }

    // Validasi karbo
    var paketPilihan = $("#modalPaketan #checkboxes input:checked").attr("data-idPaketMenu");
    if (paketPilihan == "1") {
      if (karbo.val() === null || karbo.val() === "" || karbo.val() === "-") {
        karbo.removeClass('is-valid').addClass('is-invalid');
        karbo.parent().append(`<div class="invalid-feedback invalid-karbo">
                  Karbo belum diisi
              </div>`);
        return; // Berhenti jika validasi gagal
      } else {
          karbo.removeClass('is-invalid'); // Hapus kelas invalid jika valid
      }
    }

    // Validasi kota
    if (kota.val() === null || kota.val() === "") {
      kota.removeClass('is-valid').addClass('is-invalid');
      kota.parent().append(`<div class="invalid-feedback invalid-kota">
                Kota belum diisi
            </div>`);
        return; // Berhenti jika validasi gagal
    } else {
        kota.removeClass('is-invalid'); // Hapus kelas invalid jika valid
    }
    
    // Validasi alamat
    if (alamat.val() === null || alamat.val() === "") {
      alamat.removeClass('is-valid').addClass('is-invalid');
      alamat.parent().append(`<div class="invalid-feedback invalid-alamat">
                Alamat belum diisi
            </div>`);
        return; // Berhenti jika validasi gagal
    } else {
      alamat.removeClass('is-invalid'); // Hapus kelas invalid jika valid
    }

    $(".my-collapse").css("display", "block");
    // Lakukan scroll ke bagian pembayaran di dalam modal
    $('#modalPaketan .modal-body').animate({
      scrollTop: $("#collapsePembayaran").offset().top - $('#modalPaketan .modal-body').offset().top
    }, 1000); // Durasi scroll: 1000ms (1 detik)
  });

  $(".bi-copy").on("click", function() {
    // Ambil teks dari elemen <span> di sebelah kiri ikon
    var textToCopy = $(this).closest(".row").find("span").text();

    // Salin teks ke clipboard
    navigator.clipboard.writeText(textToCopy)
    .then(function() {
        alert("Teks berhasil disalin: " + textToCopy); // Beri feedback ke pengguna
    })
    .catch(function(error) {
        console.error("Gagal menyalin teks: ", error);
        alert("Gagal menyalin teks");
    });
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

  $(".step-pembayaran #selectKota").on("change", function() {
    var stringTotalHargaMenu = $(".totalHargaMenu").text();
    var totalHargaMenu = stringTotalHargaMenu.split(".");
    var hargaOngkir = $('.step-pembayaran #selectKota option:selected').data('hargaongkir');
    $(".step-pembayaran .hargaOngkir").text("Rp. " + hargaOngkir);
    $(".step-pembayaran .totalHargaMenuKeseluruhan").text("Rp. " + (parseInt(totalHargaMenu[1])+parseInt(hargaOngkir)));
  })

  $(".step-pembayaran #cbkCekAlamatRumah").on("click", function() {
    var isChecked = $(this).prop('checked');
    if (isChecked) {
      var idAkun = $("#btnModalProfil").attr("data-id-akun");
      $.ajax({
        url: base_url + '/profil/getProfil',
        method: 'post',
        data: {
          idAkun: idAkun
        },
        dataType: 'json',
        success: function(data) {
          console.log(data);
          // Menghapus atribut selected dari semua option
          $('.step-pembayaran #selectKota option').removeAttr('selected');
          $(".step-pembayaran #selectKota").val(data.dataPelanggan.id_ongkir);
          $(".step-pembayaran #txtAlamat").val(data.dataPelanggan.alamat_pelanggan);
          // Cari objek yang sesuai dengan id_ongkir dalam dataKota
          var ongkir = data.dataKota.find(function(kota) {
            return kota.id_ongkir === data.dataPelanggan.id_ongkir;
          });
          if (ongkir) {
            var stringTotalHargaMenu = $(".step-pembayaran .totalHargaMenu").text();
            var totalHargaMenu = stringTotalHargaMenu.split(".");
            $(".step-pembayaran .hargaOngkir").text("Rp. " + ongkir.biaya_ongkir);
            $(".step-pembayaran .totalHargaMenuKeseluruhan").text("Rp. " + (parseInt(totalHargaMenu[1])+parseInt(ongkir.biaya_ongkir)));
          }
        }
      })
    } else {
      urlCek = base_url + '/daftarPesanan';
      $(".step-pembayaran .hargaOngkir").text("Rp. 0");
      if ($(location).attr('href') == urlCek) {
        $(".step-pembayaran .totalHargaMenuKeseluruhan").text($(".step-pembayaran .totalHargaMenu").text());
      } else {
        $(".step-pembayaran .totalHargaMenuKeseluruhan").text("Rp. " + nilaiHargaPaket);
      }
      $(".step-pembayaran #selectKota").val('');
      $(".step-pembayaran #txtAlamat").val('');
    }
  })

  // view profil
  $("#btnModalProfil").on('click', function() {
    $("#modalProfil select[name=kota] option:not(:nth-child(1))").remove();

    var idAkun = $(this).data('id');
    $.ajax({
      url: base_url + '/profil/getProfil',
      type: 'POST',
      data: {
        idAkun: idAkun
      },
      dataType: 'json',
      success: function (data) {
        $("#modalProfil input[name=idAkun]").val(data.dataAkun.id_akun);
        $("#modalProfil input[name=idPelanggan]").val(data.dataPelanggan.id_pelanggan);
        $("#modalProfil input[name=nama]").val(data.dataPelanggan.nama_pelanggan);
        $("#modalProfil input[name=alamat]").val(data.dataPelanggan.alamat_pelanggan);
        for (let i = 0; i < data.dataKota.length; i++) {
          var element
          if (data.dataKota[i].id_ongkir == data.dataPelanggan.id_ongkir) {
            element = `<option selected value="${data.dataKota[i].id_ongkir}">${data.dataKota[i].ongkir_kota}</option>`;
          } else {
            element = `<option value="${data.dataKota[i].id_ongkir}">${data.dataKota[i].ongkir_kota}</option>`;
          }
          $("#modalProfil select[name=kota]").append(element);
        }
        $("#modalProfil input[name=notelp]").val(data.dataPelanggan.notelp_pelanggan);
        $("#modalProfil input[name=email]").val(data.dataAkun.email_akun);
        $("#modalProfil input[name=username]").val(data.dataAkun.username_akun);
        $("#modalProfil input[name=password]").val(data.dataAkun.password_akun);
      }
    })
  })

  $("#modalProfil form").on('submit', function(e) {
    e.preventDefault();

    $.ajax({
      url: base_url + '/profil/update',
      type: 'post',
      data: {
        idAkun: $("#modalProfil input[name=idAkun]").val(),
        idPelanggan: $("#modalProfil input[name=idPelanggan]").val(),
        nama: $("#modalProfil input[name=nama]").val(),
        alamat: $("#modalProfil input[name=alamat]").val(),
        kota: $("#modalProfil select[name=kota]").val(),
        notelp: $("#modalProfil input[name=notelp]").val(),
        email: $("#modalProfil input[name=email]").val(),
        username: $("#modalProfil input[name=username]").val(),
        password: $("#modalProfil input[name=password]").val()
      },
      dataType: 'json',
      success: function (data) {
        // console.log(data);
        $("#modalProfil button").attr("data-bs-dismiss", "modal").click();
      }
    })
  })
  // view profil

  // auth
  $("#modalLogin input[name=username]").on('keyup', function() {
    $("#modalLogin input[name=username]").removeClass("is-invalid");
    $("#modalLogin input[name=username]").addClass("my-border-input");
  })
  $("#modalLogin input[name=password]").on('keyup', function() {
    $("#modalLogin input[name=password]").removeClass("is-invalid");
    $("#modalLogin input[name=password]").addClass("my-border-input");
  })

  $("#modalLogin #login").on('click', function() {
    var username = $("#modalLogin input[name=username]").val();
    var password = $("#modalLogin input[name=password]").val();

    if (username != '' && password != '') {
      $.ajax({
        url: base_url + '/authLogin',
        type: 'POST',
        data: {
          username: username,
          password: password
        },
        dataType: 'json',
        success: function (data) {
          console.log(data);
          if (data.statusLogin == "usernameTidakAda") {
            $("#modalLogin input[name=username]").removeClass("my-border-input");
            $("#modalLogin input[name=username]").addClass("is-invalid");
            $("#modalLogin .invalid-username").html("Username Tidak Ada");
          }
          if (data.statusLogin == "passwordSalah") {
            $("#modalLogin input[name=password]").removeClass("my-border-input");
            $("#modalLogin input[name=password]").addClass("is-invalid");
            $("#modalLogin .invalid-password").html("Password dan Username tidak sesuai");
          }
          if (data.statusLogin == "sukses") {
            window.location.href = base_url + '/';
          }
        }
      });
    } else {
      if (username == '') {
        console.log("username");
        $("#modalLogin input[name=username]").removeClass("my-border-input");
        $("#modalLogin input[name=username]").addClass("is-invalid");
        $("#modalLogin .invalid-username").html("Username Kosong");
      }
      if (password == '') {
        console.log("password");
        $("#modalLogin input[name=password]").removeClass("my-border-input");
        $("#modalLogin input[name=password]").addClass("is-invalid");
        $("#modalLogin .invalid-password").html("Password Kosong");
      }
    }
  })

  $("#logout").on('click', function() {
    $.ajax({
      url: base_url + '/authLogout',
      type: 'post',
      success: function (data) {
        window.location.href = base_url + '/';
      }
    });
  })
  // auth

  urlCek = base_url + '/daftarAkun';
  if ($(location).attr('href') == urlCek) {
    // view daftar
    var noTelp = $("form input[name=notelp]");

    $("form input[name=notelp]").on("keyup", function () {
      var noTelp = $("form input[name=notelp]");

      // Hapus pesan feedback sebelumnya
      $(".invalid-feedback, .valid-feedback").remove();

      // Validasi nomor telepon
      if (noTelp.val().length <= 10) {
          noTelp.removeClass('is-valid').addClass('is-invalid');
          noTelp.parent().append(`
              <div class="invalid-feedback invalid-noTelp">
                  Nomor telepon tidak sesuai (minimal 11 digit)
              </div>
          `);
          return; // Berhenti jika validasi gagal
      } else {
          noTelp.removeClass('is-invalid').addClass('my-border-input');
      }
    })
    
    $("form input[name=password]").on("keyup", function () {
      // Hapus pesan feedback sebelumnya
      $(".invalid-feedback, .valid-feedback").remove();

      const weakRegex = /^[a-zA-Z]{6,}$|^\d{6,}$/; // Password lemah
      const mediumRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; // Password sedang
      const strongRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/; // Password kuat
      
      var password = $("form input[name=password]");
      
      // Validasi password
      if (strongRegex.test(password.val())) {
        password.removeClass('is-invalid').addClass('my-border-input');
        password.parent().append(`
            <div class="valid-feedback valid-password">
                Password kuat
            </div>
        `);
      } else if (mediumRegex.test(password.val())) {
          password.removeClass('is-valid').addClass('is-invalid');
          password.parent().append(`
              <div class="invalid-feedback invalid-password">
                  Password sedang (gunakan kombinasi huruf, angka, dan karakter khusus)
              </div>
          `);
          return; // Berhenti jika password tidak kuat
      } else if (weakRegex.test(password.val())) {
          password.removeClass('is-valid').addClass('is-invalid');
          password.parent().append(`
              <div class="invalid-feedback invalid-password">
                  Password lemah (gunakan kombinasi huruf dan angka)
              </div>
          `);
          return; // Berhenti jika password lemah
      } else {
          password.removeClass('is-valid').addClass('is-invalid');
          password.parent().append(`
              <div class="invalid-feedback invalid-password">
                  Password tidak valid (minimal 6 karakter)
              </div>
          `);
          return; // Berhenti jika password tidak valid
      }
    })

    $("#formDaftar").on("submit", function(e) {
      e.preventDefault();
      // Regex untuk validasi password
      const weakRegex = /^[a-zA-Z]{6,}$|^\d{6,}$/; // Password lemah
      const mediumRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; // Password sedang
      const strongRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/; // Password kuat

      // Ambil input password dan nomor telepon
      var password = $("form input[name=password]");
      var noTelp = $("form input[name=notelp]");

      // Hapus pesan feedback sebelumnya
      $(".invalid-feedback, .valid-feedback").remove();

      // Validasi nomor telepon
      if (noTelp.val().length <= 10) {
          noTelp.removeClass('is-valid').addClass('is-invalid');
          noTelp.parent().append(`
              <div class="invalid-feedback invalid-noTelp">
                  Nomor telepon tidak sesuai (minimal 11 digit)
              </div>
          `);
          return; // Berhenti jika validasi gagal
      }

      // Validasi password
      if (strongRegex.test(password.val())) {
          password.removeClass('is-invalid').addClass('is-valid');
          password.parent().append(`
              <div class="valid-feedback valid-password">
                  Password kuat
              </div>
          `);
      } else if (mediumRegex.test(password.val())) {
          password.removeClass('is-valid').addClass('is-invalid');
          password.parent().append(`
              <div class="invalid-feedback invalid-password">
                  Password sedang (gunakan kombinasi huruf, angka, dan karakter khusus)
              </div>
          `);
          return; // Berhenti jika password tidak kuat
      } else if (weakRegex.test(password.val())) {
          password.removeClass('is-valid').addClass('is-invalid');
          password.parent().append(`
              <div class="invalid-feedback invalid-password">
                  Password lemah (gunakan kombinasi huruf dan angka)
              </div>
          `);
          return; // Berhenti jika password lemah
      } else {
          password.removeClass('is-valid').addClass('is-invalid');
          password.parent().append(`
              <div class="invalid-feedback invalid-password">
                  Password tidak valid (minimal 6 karakter)
              </div>
          `);
          return; // Berhenti jika password tidak valid
      }

      var formData = new FormData();
      formData.append('nama', $("form input[name=nama]").val());
      formData.append('alamat', $("form input[name=alamat]").val());
      formData.append('kota', $("form select[name=kota]").val());
      formData.append('notelp', $("form input[name=notelp]").val());
      formData.append('email', $("form input[name=email]").val());
      formData.append('username', $("form input[name=username]").val());
      formData.append('password', $("form input[name=password]").val());

      $.ajax({
        url: base_url + '/daftarAkun/save',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
          console.log(response);
            if (response.success) {
                alert("Form berhasil dikirim!");
            } else {
                alert("Terjadi kesalahan: " + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert("Terjadi kesalahan saat mengirim form.");
            console.error(xhr.responseText);
        }
      })
      window.location.href = base_url + '/';
    })

    $("form input[name=username]").on('keyup', function() {
      var username = $(this).val();
      $.ajax({
        url: base_url + '/cekUsername',
        type: 'post',
        data: {
          username: username
        },
        dataType: 'json',
        success: function (data) {
          if (data.statusUsername == "ada") {
            $("form input[name=username]").removeClass('my-border-input');
            $("form input[name=username]").addClass('is-invalid');
            // Cek apakah pesan error sudah ada
            if ($("form .invalid-username").length === 0) {
              $("form input[name=username]").parent().append(`
                  <div class="invalid-feedback invalid-username">
                      Username sudah ada
                  </div>
              `);
          }
          }
          if (data.statusUsername == "kosong") {
            $("form input[name=username]").removeClass('is-invalid');
            $("form .invalid-username").remove();
          }
        }
      })
    })
    
    $("form input[name=email]").on('keyup', function() {
      var email = $(this).val();
      $.ajax({
        url: base_url + '/cekEmail',
        type: 'post',
        data: {
          email: email
        },
        dataType: 'json',
        success: function (data) {
          if (data.statusEmail == "ada") {
            $("form input[name=email]").removeClass('my-border-input');
            $("form input[name=email]").addClass('is-invalid');
            // Cek apakah pesan error sudah ada
            if ($("form .invalid-email").length === 0) {
              $("form input[name=email]").parent().append(`
                  <div class="invalid-feedback invalid-email">
                    Email sudah ada
                  </div>
              `);
          }
          }
          if (data.statusEmail == "kosong") {
            $("form input[name=email]").removeClass('is-invalid');
            $("form .invalid-email").remove();
          }
        }
      })
    })
    // view daftar
  }

  urlCek = base_url + '/';
  if ($(location).attr('href') == urlCek) {
    const modalPaketan = document.getElementById('modalPaketan')    

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
      if (!$(this).hasClass("MenuTutup")) {
        if (!$(this).hasClass("aktifPilih")) {
          $(this).addClass("aktifPilih");
          $(this).parent().parent().parent().find("li:nth-child(1) span:nth-child(2)").text("Batal Pilih");
          $(this).parent().parent().parent().find("button").css("display", "block");
          $(this).parent().parent().parent().find("input").css("display", "block");
        } else {
          $(this).parent().parent().parent().find("input").prop('checked', false);
          $(this).parent().parent().parent().find(".my-form-checkbox").removeClass('checked');
          $(this).removeClass("aktifPilih");
          $(this).parent().parent().parent().find("li:nth-child(1) span:nth-child(2)").text("Pilih Menu");
          $(this).parent().parent().parent().find("button").css("display", "none");
          $(this).parent().parent().parent().find("input").css("display", "none");
        }
      }
    })
  
    $(".family .btnPilihMenu").on('click', function() {
      $(this).css("display", "none");
      $(this).parent().find("button:nth-child(2)").css("display", "block");
      $(this).parent().find("button:nth-child(3)").css("display", "block");
      $(this).parent().parent().parent().find("input").css("display", "block");
    })
  
    $(".family .btnBatalPilih").on('click', function() {
      $(this).css("display", "none");
      $(this).parent().find("button:nth-child(1)").css("display", "block");
      $(this).parent().find("button:nth-child(2)").css("display", "none");
      // $(this).parent().find("button:nth-child(1)").removeAttr("data-bs-toggle", "modal");
      // $(this).parent().find("button:nth-child(1)").removeAttr("data-bs-target", "modalPilihMenu");
      // $(this).parent().find("button:nth-child(1)").removeClass("modalPilihMenu");
      // $(this).parent().find("button:nth-child(1)").removeClass("modalFamily");
      $(this).parent().parent().parent().find("input").prop('checked', false);
      $(this).parent().parent().parent().find("input").css("display", "none");
      $(this).parent().parent().parent().find("input").parent().removeClass("checked");
      // $(this).parent().find("button:nth-child(1)").text("Pilih Menu");
      // $(this).parent().parent().parent().find("input").css("display", "none");
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
    var totalHargaPaket = 0;
    $("#modalPaketan #checkboxes input").on('click', function() {
      var multiselect = $(".multiselect");
      multiselect.find(".invalid-paket-menu").remove();
      // Mendapatkan harga dari elemen yang diklik
      var harga = parseInt($(this).attr("data-harga"));
      // Jika checkbox dicentang
      if ($(this).prop("checked") == true) {
        console.log($(this).attr("data-idPaketMenu"));
        if($(this).attr("data-idPaketMenu") == "1") {
          $("#selectKarbo").parent().css("display", "block");
        }
        hargaPaketTerpilih.push(harga);
        // Menghitung total harga
        nilaiHargaPaket = hargaPaketTerpilih.reduce(function(total, currentValue) {
            return total + currentValue;
        }, 0);
        var jumlahHari = $("#modalPaketan input[name=jumlahHari]").val();
        totalHargaPaket = parseInt(jumlahHari) * nilaiHargaPaket;
        $("#modalPaketan .totalHargaMenu").text("Rp. " + totalHargaPaket);
      } else {
        if($(this).attr("data-idPaketMenu") == "1") {
          $("#selectKarbo").parent().css("display", "none");
        }
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
        $("#modalPaketan .totalHargaMenu").text("Rp. " + nilaiHargaPaket);
      }
      var stringHargaOngkir = $(".hargaOngkir").text();
      var hargaOngkir = stringHargaOngkir.split(".");
      $(".totalHargaMenuKeseluruhan").text("Rp. " + (totalHargaPaket+parseInt(hargaOngkir[1])));
    });
  
    $("#modalPaketan input[name=jumlahHari]").on('keyup', function() {
      var totalHargaMenu = parseInt($(this).val()) * nilaiHargaPaket;
      var hargaOngkir;
      $(".totalHargaMenu").text("Rp. " + totalHargaMenu);
      // Mendapatkan data harga ongkir dari elemen <select>
      console.log(hargaOngkir);
      if ($("#modalPaketan #selectKota option:selected").val() == '') {
        hargaOngkir = 0;
      } else {
        hargaOngkir = $("#modalPaketan #selectKota option:selected").attr('data-hargaOngkir');
      }
      hargaOngkir = parseInt($(this).val()) * parseInt(hargaOngkir);
      // Menampilkan harga ongkir (jika perlu)
      $(".hargaOngkir").text("Rp. " + hargaOngkir);
      var stringHargaOngkir = $(".hargaOngkir").text();
      var hargaOngkir = stringHargaOngkir.split(".");
      $(".totalHargaMenuKeseluruhan").text("Rp. " + (totalHargaMenu+parseInt(hargaOngkir[1])));
    })
    
    $("#modalPaketan input[name=jumlahHari]").on('blur', function() {
      var jumlahHari;
      if ($(this).val() == "") {
        jumlahHari = $(this).val('1');
      } else {
        jumlahHari = $(this);
      }
      console.log(jumlahHari);
      (nilaiHargaPaket <= 0) ? nilaiHargaPaket = 0 : nilaiHargaPaket;
      var totalHargaMenu = parseInt(jumlahHari.val()) * nilaiHargaPaket;
      $(".totalHargaMenu").text("Rp. " + totalHargaMenu);
      // Mendapatkan data harga ongkir dari elemen <select>
      var hargaOngkir = $("#modalPaketan #selectKota option:selected").attr('data-hargaOngkir');
      (!hargaOngkir) ? hargaOngkir = 0 : hargaOngkir;
      hargaOngkir = parseInt(jumlahHari.val()) * parseInt(hargaOngkir);
      // Menampilkan harga ongkir (jika perlu)
      $(".hargaOngkir").text("Rp. " + hargaOngkir);
      var stringHargaOngkir = $(".hargaOngkir").text();
      var hargaOngkir = stringHargaOngkir.split(".");
      $(".totalHargaMenuKeseluruhan").text("Rp. " + (totalHargaMenu+parseInt(hargaOngkir[1])));
    })

    $("#btnModalPaketan").on("click", function() {
      $.ajax({
        url: base_url + '/dadmin/biayaOngkir/getAllOngkir',
        method: 'post',
        dataType: 'json',
        success: function(data) {
          console.log(data);
          // Mengosongkan option yang ada sebelumnya (kecuali option "Pilih Kota")
          $("#modalPaketan #selectKota").empty();

          // Menambahkan opsi default "Pilih Kota"
          $("#modalPaketan #selectKota").append('<option selected disabled value="">Pilih Kota</option>');

          // Menambahkan kota-kota ke dropdown berdasarkan data yang diterima
          data.dataOngkir.forEach(function(item) {
            var option = $(`<option data-hargaOngkir="${item.biaya_ongkir}"></option>`)
                .val(item.id_ongkir) // Menambahkan value berdasarkan id kota
                .text(item.ongkir_kota); // Menampilkan nama kota

            // Menambahkan option ke dalam select
            $("#modalPaketan #selectKota").append(option);
          });
        }
      })
    })
  
    modalPaketan.addEventListener('hidden.bs.modal', event => {
      totalHargaPaket = 0;
      nilaiHargaPaket = 0
      $("#modalPaketan #txtAtasNama").val('');
      $("#modalPaketan #txtAlamat").val('');
      $("#modalPaketan #txtNominal").val('');
      $("#modalPaketan #cbkCekAlamatRumah").prop('checked', false);
      $("#modalPaketan .txtPantangan").val('');
      $("#modalPaketan #txtGambar").val('');
      $("#modalPaketan #jumlahHari").val('1');
      $("#modalPaketan .totalHargaMenu").text('Rp. 0');
      $("#modalPaketan .txtDate").val('');
      $("#modalPaketan #selectKarbo").parent().css("display", "none");
      $("#modalPaketan #selectKarbo").val('-'); // Atur nilai ke opsi default
      $("#modalPaketan #selectKarbo").prop('selectedIndex', 0); // Atur ke opsi pertama
      $("#modalPaketan .my-collapse").css("display", "none");
      $("#modalPaketan #checkboxes").css("display", "none");
      $("#modalPaketan .hargaOngkir").text('Rp. 0');
      $("#modalPaketan .totalHargaMenuKeseluruhan").text('Rp. 0');
      var selectCheck = $("#modalPaketan #checkboxes");
      selectCheck.find("input").each(function (index, element) {
        $(element).prop("checked", false);
      });
      expanded = false;
    })
  
    $("#modalPilihMenu").on('click', '.btnHapusList', function(e) {
      var listPesanan = $(this).parent().parent().parent();
      var dataListPesanan = $(this).parent().parent().parent().parent();
      // var listPesanan = e.target.parentElement.parentElement.parentElement;
      // var dataListPesanan = e.target.parentElement.parentElement.parentElement.parentElement;
      listPesanan.remove();
      if (dataListPesanan.find('li').length == 0 ) {
        $("#modalPilihMenu .modal-footer").find("button")[1].click();
      }
    })

    $("#modalPilihMenu btnLanjutPilihMenu").on('click', function() {})

    $("#modalPilihMenu btnSelesai").on('click', function() {})
  
    $(".content-homepage #katalog-personal").on('click', '.modalPilihMenu', function() {
      $("#modalPilihMenu ul li").remove();
      $("#modalPilihMenu .modal-dialog").addClass('modal-lg');
      $("#modalPilihMenu .modal-dialog .modal-content").addClass('modalPersonal');
      var ul = $(this).parent().parent().parent().parent();
      var tanggalMenu = ul.find(".tanggalMenuPersonal").text();
      var idJadwalMenu = ul.find("input[name=idJadwalMenu]").val();
      $("#modalPilihMenu .modal-header h1").append(`
        <span>Personal Pack</span><br><span>${tanggalMenu}</span>
        <input type="text" name="idJadwalMenu" hidden value="${idJadwalMenu}">
      `);
      // console.log(ul.find("li input[type=checkbox]").prop("checked") == true);
      var menuTerpilih = false;
      ul.find("li").each(function (index, element) {
        if ($(element).find("input[type=checkbox]").prop("checked") == true) {
          menuTerpilih = true;
        }
      })
      if (menuTerpilih == true) {
        $("#modalPilihMenu .modal-footer button").css("display", "block");
        $("#modalPilihMenu .modal-footer span").remove();
        ul.find("li").each(function (index, element) {
          var jenisPaketMenu = $(element).find("span[class=jenisPaketMenu]").text();
          var idDetailJadwalMenu = $(element).find("input[name=idDetailJadwalMenu]").val();
          var optionInfuse = $(element).find("input[name=optionInfuse]").val();
          var menu = $(element).find("span[class=menuPersonal]").text();
          var hargaMenu = $(element).find("span[class=hargaMenuPersonal]").text();
          if ($(element).find("input[type=checkbox]").prop("checked") == true && index == 3) {
            $("#modalPilihMenu ul").append(
              `<li class="list-group-item">
                <input type="hidden" name="optionInfuse"  value="${optionInfuse}">
                <div class="row align-items-center">
                  <div class="col">
                    <p class="lh-sm m-0"><span class="fw-bold">` + jenisPaketMenu + ` ` + hargaMenu + `</span></p>
                    <div class="d-flex align-items-center mt-2">
                      <span class="mx-1">Qty</span>
                      <input class="form-control form-control-sm my-border-input border border-0 mx-1 px-1 py-0 qtyMenu" style="width: 6ch;" name="jumlahMenu" type="number" min="1" oninput="validity.valid||(value='');" name="" value="1">
                    </div>
                  </div>
                  <div class="col-auto">
                    <button type="button" class="btn btn-sm btn-light rounded-pill my-border-btn btnHapusList">Hapus</button>
                  </div>
                </div>
              </li>`);
          } else if ($(element).find("input[type=checkbox]").prop("checked") == true) {
            var element = `
                <li class="list-group-item">
                  <input type="hidden" name="idDetailJadwalMenu" value="${idDetailJadwalMenu}">
                  <div class="row align-items-center">
                    <div class="col">
                      <p class="lh-sm m-0"><span class="fw-bold">` + jenisPaketMenu + ` ` + hargaMenu + `</span><br>` + menu + `</p>
                      <div class="d-flex align-items-center mt-2">
                        <span class="mx-1">Qty</span>
                        <input class="form-control form-control-sm my-border-input border border-0 mx-1 px-1 py-0 qtyMenu" style="width: 6ch;" name="jumlahMenu" type="number" min="1" oninput="validity.valid||(value='');" name="" value="1">
                      </div>
                    </div>
                    <div class="col-4">`;
                    if (jenisPaketMenu == "lunch") {
                      element += `
                      <div class="mb-3">
                        <select class="form-select form-select-sm my-border-input w-auto" style="height:fit-content;" id="selectKarbo" name="karbo" required>
                          <option selected disabled>Pilih Karbo</option>
                          <option value="1">Nasi Merah</option>
                          <option value="2">Maspotato</option>
                        </select>
                      </div>`;
                    }
                      element += `
                      <div>
                        <input type="text" class="form-control form-control-sm my-border-input w-50 txtPantangan w-100" name="pantangan" placeholder="Masukkan Pantangan" required>
                      </div>
                    </div>
                    <div class="col-auto">
                      <button type="button" class="btn btn-sm btn-light rounded-pill my-border-btn btnHapusList">Hapus</button>
                    </div>
                  </div>
                </li>`;
            $("#modalPilihMenu ul").append(element);
          }
        });
      } else {
        $("#modalPilihMenu .modal-footer button").css("display", "none");
        $("#modalPilihMenu .modal-footer span").remove();
        $("#modalPilihMenu .modal-footer").append(`<span class="fw-normal fs-6 m-auto">Anda Belum Memilih Menu</span>`);
      }
    })

    $(".content-homepage #katalog-family").on('click', '.modalPilihMenu', function() {
      $("#modalPilihMenu ul li").remove();
      $("#modalPilihMenu .modal-dialog .modal-content").addClass('modalFamily');
      var ul = $(this).parent().parent().parent();
      var tanggalMenu = ul.find(".tanggalMenuFamily").text();
      var idJadwalMenu = ul.find("input[name=idJadwalMenu]").val();
      console.log($(this));
      $("#modalPilihMenu .modal-header h1").append(`
        <span>Family Pack</span><br><span>${tanggalMenu}</span>
        <input type="text" name="idJadwalMenu" hidden value="${idJadwalMenu}">
      `);
      var menuTerpilih = false;
      ul.find("li").each(function (index, element) {
        if ($(element).find("input[type=checkbox]").prop("checked") == true) {
          menuTerpilih = true;
        }
      })
      if (menuTerpilih == true) {
        $("#modalPilihMenu .modal-footer button").css("display", "block");
        $("#modalPilihMenu .modal-footer span").remove();
        ul.find("li").each(function (index, element) {
          // var jenisPaketMenu = $(element).find("span[class=jenisPaketMenu]").text();
          var menu = $(element).find("span[class=menuFamily]").text();
          var idDetailJadwalMenu = $(element).find("input[name=idDetailJadwalMenu]").val();
          var hargaMenu = $(element).find("span[class=hargaMenuFamily]").text();
          if ($(element).find("input[type=checkbox]").prop("checked") == true) {
            $("#modalPilihMenu ul").append(
              `<li class="list-group-item">
                <input type="text" name="idDetailJadwalMenu" hidden value="${idDetailJadwalMenu}">
                <div class="row align-items-center">
                  <div class="col">
                    <p class="my-0">` + menu + `<br><span class="fw-bold">` + hargaMenu + `</span></span></p>
                  </div>
                  <div class="col-auto d-flex flex-nowrap align-items-center">
                    <span class="mx-1">Qty</span>
                    <input class="form-control form-control-sm my-border-input border border-0 mx-1 px-1 py-0 qtyMenu" style="width: 6ch;" type="number" min="1" oninput="validity.valid||(value='');" name="jumlahMenu" value="1">
                    <div class="my-form-checkbox">
                      <input class="form-check-input my-border-input mx-1" type="checkbox" name="pedas">
                      <label class="form-check-label" for="cbPedas">Pedas</label>
                    </div>
                  </div>
                  <div class="col-auto">
                    <button type="button" class="btn btn-sm btn-light rounded-pill my-border-btn btnHapusList">Hapus</button>
                  </div>
                </div>
              </li>`);
          }
        });
      } else {
        $("#modalPilihMenu .modal-footer button").css("display", "none");
        $("#modalPilihMenu .modal-footer span").remove();
        $("#modalPilihMenu .modal-footer").append(`<span class="fw-normal fs-6 m-auto">Anda Belum Memilih Menu</span>`);
      }
    })

    $("#modalPilihMenu").on("change", "#selectKarbo", function () {
      $(".invalid-feedback, .valid-feedback").remove();
      var karbo = $("#modalPilihMenu select[name=karbo]");
      if (karbo.val() === null || karbo.val() === "") {
        karbo.removeClass('is-valid').addClass('is-invalid');
        karbo.parent().append(`<div class="invalid-feedback invalid-karbo">
                  Karbo belum diisi
              </div>`);
          return; // Berhenti jika validasi gagal
      } else {
        karbo.removeClass('is-invalid'); // Hapus kelas invalid jika valid
      }
    })

    $("#modalPilihMenu .btnTambahDaftarPesanan").on('click', function() {
      var modalContent = $("#modalPilihMenu .modal-dialog .modal-content");
      var idJadwalMenu = $("#modalPilihMenu .modal-header h1 input[name=idJadwalMenu]").val();
      var itemsMenu = []
      var idMenu, jumlahMenu, karbo, pantangan, pedas, pack, gagal = false;
      var ul = $("#modalPilihMenu ul");
      var li = ul.find('li');
      // Cek apakah tombol yang diklik adalah "Lanjut Pilih Menu" atau "Selesai"
      var isLanjutPilihMenu = $(this).hasClass("lanjutPilihMenu");
      var isSelesai = $(this).hasClass("selesaiPilihMenu");

      if (li.length > 0) {
        console.log(gagal);
        // var idAkun = $("#btnModalPofil").data('idAkun');
        ul.find("li").each(function (index, element) {
          if (modalContent.hasClass("modalPersonal")) {
            karbo = $(element).find("select[name=karbo]");
            // $(".invalid-feedback, .valid-feedback").remove();
            if (karbo.val() === null || karbo.val() === "") {
              karbo.removeClass('is-valid').addClass('is-invalid');
              karbo.parent().append(`<div class="invalid-feedback invalid-karbo">
                        karbo belum dipilih
                    </div>`);
              gagal = true;
              return;
            }
          }
        })

        if (!gagal) {
          ul.find("li").each(function (index, element) {
            if (modalContent.hasClass("modalPersonal")) {
              pack = 'personal';
              idMenuInfuse = $(element).find("input[name=optionInfuse]");
              idDetailJadwalMenu = $(element).find("input[name=idDetailJadwalMenu]").val();
              jumlahMenu = $(element).find("input[name=jumlahMenu]").val();
              karbo = $(element).find("select[name=karbo]").val();
              pantangan = $(element).find("input[name=pantangan]").val();
              itemsMenu.push({
                // pack: 'personal',
                infuse: (idMenuInfuse.length > 0) ? "y" : "n",
                idDetailJadwalMenu: (idMenuInfuse.length < 1) ? idDetailJadwalMenu : idMenuInfuse.val(), 
                jumlahMenu: jumlahMenu,
                karbo: (idMenuInfuse.length < 1) ? karbo : "-", 
                pantangan: (idMenuInfuse.length < 1) ? pantangan : "-"
              });
            }
            if (modalContent.hasClass("modalFamily")) {
              pack = 'family';
              idDetailJadwalMenu = $(element).find("input[name=idDetailJadwalMenu]").val();
              jumlahMenu = $(element).find("input[name=jumlahMenu]").val();
              pedas = $(element).find("input[name=pedas]").is(":checked") ? "p" : "t";
              itemsMenu.push({
                // pack: 'family',
                idDetailJadwalMenu: idDetailJadwalMenu, 
                jumlahMenu: jumlahMenu,
                pedas: pedas
              });
            }
          })
          
          $.ajax({
            url: base_url + '/tambahDaftarPesanan',
            method: 'post',
            data: {
              idJadwalMenu: idJadwalMenu,
              pack: pack,
              itemsMenu: itemsMenu
            },
            dataType: 'json',
            success: function(data) {
              console.log(data);
              // Jika tombol "Lanjut Pilih Menu" diklik, tutup modal
              if (isLanjutPilihMenu) {
                $("#modalPilihMenu .modal-footer").find("button:nth-child(3)").click();
                // console.log($("#modalPilihMenu .modal-footer").find("button:nth-child(3)"));
              }
              // Jika tombol "Selesai" diklik, arahkan ke halaman "Pesananku"
              if (isSelesai) {
                  window.location.href = base_url + "/daftarPesanan"; // Ganti dengan URL halaman "Pesananku"
              }
            },
            error: function(xhr, status, error) {
                console.error("Terjadi kesalahan saat mengirim data:", error);
                console.log("Respons dari server:", xhr.responseText);
            }
          })
        }
      }
    })

    $(".family-menu .lihatFotoMenu").on('click', function() {
      const detailMenu = $(this).parent().parent().parent();

      $("#modalLihatFotoMenu h1").text(detailMenu.find(".menuFamily").text());
      $("#modalLihatFotoMenu img").attr("src", $(this).data('gambar'));
    })
    
    $(".personal-menu .lihatFotoMenu").on('click', function() {
      const detailMenu = $(this).parent().parent();

      $("#modalLihatFotoMenu h1").text(detailMenu.find(".menuPersonal").text());
      $("#modalLihatFotoMenu img").attr("src", $(this).attr("src"));
    })

    // $("#modalPaketan #btnLanjutBayar").on("click", function() {
    //   var checkedBoxes = $(".cbkPaketMenu:checked"); // Ambil semua checkbox yang dicentang
    //   var multiselect = $(".multiselect"); // Ambil semua checkbox yang dicentang
    //   var tanggal = $("#modalPaketan input[name=tanggal]");
    //   // var karbo = ($("#modalPaketan #selectKarbo").val() == null) ? "-" : $("#modalPaketan #selectKarbo").val();
    //   var jumlahHari = $("#modalPaketan #jumlahHari").val();
    //   var karbo = $("#modalPaketan select[name=karbo]");
    //   var pantangan = $("#modalPaketan #txtPantangan").val();
    //   var kota = $("#modalPaketan select[name=kota]");
    //   var alamat = $("#modalPaketan input[name=alamat]");
    //   var nominal = $("#modalPaketan #txtNominal").val();
    //   var atasNama = $("#modalPaketan #txtAtasNama").val();
    //   var fileInput = $('#modalPaketan #fileGambar')[0];

    //   $(".invalid-feedback, .valid-feedback").remove();

    //   if (checkedBoxes.length === 0) {
    //     multiselect.append(`<div class="text-danger invalid-paket-menu">
    //               Paket Menu belum diisi
    //           </div>`);
    //       return; // Berhenti jika validasi gagal
    //   } else {
    //     multiselect.find(".invalid-paket-menu").remove(); // Hapus kelas invalid jika valid
    //   }

    //   // Validasi tanggal
    //   if (tanggal.val() === null || tanggal.val() === "") {
    //     // tanggal.removeClass('is-valid').addClass('is-invalid');
    //     tanggal.parent().append(`<div class="text-danger invalid-tanggal">
    //               Tanggal belum diisi
    //           </div>`);
    //       return; // Berhenti jika validasi gagal
    //   } else {
    //     tanggal.find(".invalid-tanggal").remove(); // Hapus kelas invalid jika valid
    //   }

    //   // Validasi karbo
    //   if (karbo.val() === null || karbo.val() === "" || karbo.val() === "-") {
    //     karbo.removeClass('is-valid').addClass('is-invalid');
    //     karbo.parent().append(`<div class="invalid-feedback invalid-karbo">
    //               Karbo belum diisi
    //           </div>`);
    //     return; // Berhenti jika validasi gagal
    //   } else {
    //       karbo.removeClass('is-invalid'); // Hapus kelas invalid jika valid
    //   }

    //   // Validasi kota
    //   if (kota.val() === null || kota.val() === "") {
    //     kota.removeClass('is-valid').addClass('is-invalid');
    //     kota.parent().append(`<div class="invalid-feedback invalid-kota">
    //               Kota belum diisi
    //           </div>`);
    //       return; // Berhenti jika validasi gagal
    //   } else {
    //       kota.removeClass('is-invalid'); // Hapus kelas invalid jika valid
    //   }
      
    //   // Validasi alamat
    //   if (alamat.val() === null || alamat.val() === "") {
    //     alamat.removeClass('is-valid').addClass('is-invalid');
    //     alamat.parent().append(`<div class="invalid-feedback invalid-alamat">
    //               Alamat belum diisi
    //           </div>`);
    //       return; // Berhenti jika validasi gagal
    //   } else {
    //     alamat.removeClass('is-invalid'); // Hapus kelas invalid jika valid
    //   }

    //   if (nominal === null || nominal === "") {
    //     nominal.removeClass('is-valid').addClass('is-invalid');
    //     nominal.parent().append(`<div class="invalid-feedback invalid-nominal">
    //               Nominal belum diisi
    //           </div>`);
    //       return; // Berhenti jika validasi gagal
    //   } else {
    //     nominal.removeClass('is-invalid'); // Hapus kelas invalid jika valid
    //   }
      
    //   if (atasNama === null || atasNama === "") {
    //     atasNama.removeClass('is-valid').addClass('is-invalid');
    //     atasNama.parent().append(`<div class="invalid-feedback invalid-atasNama">
    //               Nama Penarasfer belum diisi
    //           </div>`);
    //       return; // Berhenti jika validasi gagal
    //   } else {
    //     atasNama.removeClass('is-invalid'); // Hapus kelas invalid jika valid
    //   }

    //   const checkedCheckboxes = $('#modalPaketan .cbkPaketMenu:checked');

    //   // Iterasi atau penggunaan data dari checkbox yang tercentang
    //   var listPaketMenuNoInfuse = [];
    //   var listPaketMenuWithInfuse = [];
    //   var listPaketMenu = [];
    //   checkedCheckboxes.each(function () {
    //     const idPaketMenu = $(this).data('idpaketmenu'); // Mengambil atribut data-idPaketMenu
    //     listPaketMenu.push({
    //       idPaketMenu: idPaketMenu,
    //     })
    //     if (idPaketMenu != 4) {
    //       listPaketMenuNoInfuse.push({
    //         idPaketMenu: idPaketMenu,
    //       })
    //     }
    //     if (idPaketMenu == 4) {
    //       listPaketMenuWithInfuse.push({
    //         idPaketMenu: idPaketMenu,
    //       })
    //     }
    //   });

    //   var formData = new FormData();
    //   formData.append('listPaketMenu', JSON.stringify(listPaketMenu));
    //   formData.append('listPaketMenuNoInfuse', JSON.stringify(listPaketMenuNoInfuse));
    //   formData.append('listPaketMenuWithInfuse', JSON.stringify(listPaketMenuWithInfuse));
    //   formData.append('tanggal', tanggal);
    //   formData.append('jumlahHari', jumlahHari);
    //   formData.append('karbo', karbo);
    //   formData.append('pantangan', pantangan);
    //   formData.append('ongkir', ongkir);
    //   formData.append('alamat', alamat);
    //   formData.append('nominal', nominal);
    //   formData.append('atasNama', atasNama);
    //   formData.append('fileGambar', fileInput.files[0]);

    //   // Kirim data menggunakan AJAX
    //   $.ajax({
    //     url: base_url + '/pesananPaketan/bayar',
    //     type: 'POST',
    //     data: formData,
    //     dataType: 'json',
    //     contentType: false,  // Jangan set Content-Type, biar FormData yang mengatur
    //     processData: false,  // Jangan memproses data menjadi string
    //     success: function(response) {
    //         console.log(response);
    //         // window.location.href = base_url + '/pesananKu';
    //     },
    //     error: function(xhr, status, error) {
    //         // Menangani kesalahan
    //         alert('Terjadi kesalahan saat mengupload!');
    //     }
    //   });
    // })

    $("#modalPaketan").on('keyup', "#txtNominal", function () {
      console.log($(this).val());
      $(".invalid-feedback, .valid-feedback").remove();
      var nominal = $("#modalPaketan input[name=nominal]");
      if (nominal.val() === null || nominal.val() === "") {
        nominal.removeClass('is-valid').addClass('is-invalid');
        nominal.parent().append(`<div class="invalid-feedback invalid-nominal">
                  Nominal belum diisi
              </div>`);
          return; // Berhenti jika validasi gagal
      } else {
        nominal.removeClass('is-invalid'); // Hapus kelas invalid jika valid
      }
    })
    
    $("#modalPaketan").on('keyup', "#txtAtasNama", function () {
      console.log($(this).val());
      $(".invalid-feedback, .valid-feedback").remove();
      var atasNama = $("#modalPaketan input[name=atasNama]");
      if (atasNama.val() === null || atasNama.val() === "") {
        atasNama.removeClass('is-valid').addClass('is-invalid');
        atasNama.parent().append(`<div class="invalid-feedback invalid-atasNama">
                  Nama Peneransfer belum diisi
              </div>`);
          return; // Berhenti jika validasi gagal
      } else {
        atasNama.removeClass('is-invalid'); // Hapus kelas invalid jika valid
      }
    })
    
    $("#modalPaketan").on('change', "#fileGambar", function () {
      console.log($(this).val());
      $(".invalid-feedback, .valid-feedback").remove();
      var fileInput = $('#modalPaketan #fileGambar')[0];
      var file = fileInput.files[0];
      var allowedExtensions = ["jpg", "jpeg", "png"];
      var allowedMimeTypes = ["image/jpeg", "image/jpg", "image/png"];

      // Ambil ekstensi file
      var fileExtension = file.name.split('.').pop().toLowerCase();

      // Validasi ekstensi file
      if (!allowedExtensions.includes(fileExtension)) {
        $("#modalPaketan #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
            File harus dalam format JPG/JPEG
        </div>`);
        return;
      } else {
        $("#modalPaketan #fileGambar").parent().find(".invalid-fileGambar").remove();
      }

      // Validasi tipe MIME
      if (!allowedMimeTypes.includes(file.type)) {
        $("#modalPaketan #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
            File harus dalam format JPG/JPEG
        </div>`);
        return;
      } else {
        $("#modalPaketan #fileGambar").parent().find(".invalid-fileGambar").remove();
      }
    })

    $("#modalPaketan #btnLanjutBayar").on("click", function() {
    // Ambil semua input yang diperlukan
    var checkedBoxes = $(".cbkPaketMenu:checked");
    var multiselect = $(".multiselect");
    var tanggal = $("#modalPaketan input[name=tanggal]").val();
    var jumlahHari = $("#modalPaketan #jumlahHari").val();
    var karbo = $("#modalPaketan select[name=karbo]").val();
    var pantangan = $("#modalPaketan #txtPantangan").val();
    var kota = $("#modalPaketan select[name=kota]").val();
    var alamat = $("#modalPaketan input[name=alamat]").val();
    var nominal = $("#modalPaketan #txtNominal").val();
    var atasNama = $("#modalPaketan #txtAtasNama").val();
    var fileInput = $('#modalPaketan #fileGambar')[0];

    // Hapus pesan error sebelumnya
    $(".invalid-feedback, .valid-feedback, .text-danger").remove();

    // Validasi Paket Menu
    if (checkedBoxes.length === 0) {
      multiselect.append(`<div class="text-danger invalid-paket-menu">
          Paket Menu belum diisi
      </div>`);
      return; // Berhenti jika validasi gagal
    }

    // Validasi Tanggal
    if (!tanggal) {
      $("#modalPaketan input[name=tanggal]").parent().append(`<div class="text-danger invalid-tanggal">
          Tanggal belum diisi
      </div>`);
      return;
    }

    var paketPilihan = $("#modalPaketan #checkboxes input:checked").attr("data-idPaketMenu");
    if (paketPilihan == "1") {
      // Validasi Karbo
      if (!karbo || karbo === "-") {
        $("#modalPaketan select[name=karbo]").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-karbo">
            Karbo belum diisi
        </div>`);
        return;
      }
    }

    // Validasi Kota
    if (!kota) {
      $("#modalPaketan select[name=kota]").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-kota">
          Kota belum diisi
      </div>`);
      return;
    }

    // Validasi Alamat
    if (!alamat) {
      $("#modalPaketan input[name=alamat]").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-alamat">
          Alamat belum diisi
      </div>`);
      return;
    }

    // Validasi File Gambar
    if (!fileInput.files || fileInput.files.length === 0) {
      $("#modalPaketan #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
          File bukti transfer belum diupload
      </div>`);
      return;
    }

    var file = fileInput.files[0];
    var allowedExtensions = ["jpg", "jpeg"];
    var allowedMimeTypes = ["image/jpeg", "image/jpg"];

    // Ambil ekstensi file
    var fileExtension = file.name.split('.').pop().toLowerCase();

    // Validasi ekstensi file
    if (!allowedExtensions.includes(fileExtension)) {
      $("#modalPaketan #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
          File harus dalam format JPG/JPEG
      </div>`);
      return;
    }

    // Validasi tipe MIME
    if (!allowedMimeTypes.includes(file.type)) {
      $("#modalPaketan #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
          File harus dalam format JPG/JPEG
      </div>`);
      return;
    }

    // Validasi Nominal
    if (!nominal) {
      $("#modalPaketan #txtNominal").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-nominal">
          Nominal belum diisi
      </div>`);
      return;
    }

    // Validasi Atas Nama
    if (!atasNama) {
      $("#modalPaketan #txtAtasNama").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-atasNama">
          Nama Penarasfer belum diisi
      </div>`);
      return;
    }

    // Proses data checkbox yang dicentang
    var listPaketMenuNoInfuse = [];
    var listPaketMenuWithInfuse = [];
    var listPaketMenu = [];
    checkedBoxes.each(function() {
        var idPaketMenu = $(this).data('idpaketmenu');
        listPaketMenu.push({ idPaketMenu: idPaketMenu });
        if (idPaketMenu != 4) {
            listPaketMenuNoInfuse.push({ idPaketMenu: idPaketMenu });
        }
        if (idPaketMenu == 4) {
            listPaketMenuWithInfuse.push({ idPaketMenu: idPaketMenu });
        }
    });

    // Buat FormData untuk dikirim via AJAX
    var formData = new FormData();
    formData.append('listPaketMenu', JSON.stringify(listPaketMenu));
    formData.append('listPaketMenuNoInfuse', JSON.stringify(listPaketMenuNoInfuse));
    formData.append('listPaketMenuWithInfuse', JSON.stringify(listPaketMenuWithInfuse));
    formData.append('tanggal', tanggal);
    formData.append('jumlahHari', jumlahHari);
    formData.append('karbo', (karbo) ? karbo : "-");
    formData.append('pantangan', pantangan);
    formData.append('ongkir', kota);
    formData.append('alamat', alamat);
    formData.append('nominal', nominal);
    formData.append('atasNama', atasNama);
    formData.append('fileGambar', fileInput.files[0]);

    // Kirim data menggunakan AJAX
    $.ajax({
      url: base_url + '/pesananPaketan/bayar',
      type: 'POST',
      data: formData,
      dataType: 'json',
      contentType: false,  // Jangan set Content-Type, biar FormData yang mengatur
      processData: false,  // Jangan memproses data menjadi string
      success: function(response) {
        console.log(response);
          window.location.href = base_url + '/pesananKu'; // Redirect jika sukses
      },
      error: function(xhr, status, error) {
          alert('Terjadi kesalahan saat mengirim data. Silakan coba lagi.');
          console.error(xhr.responseText);
      }
    });
});
  
    const modalPilihMenu = document.getElementById('modalPilihMenu');
    modalPilihMenu.addEventListener('hidden.bs.modal', event => {
      $("#modalPilihMenu .modal-dialog").removeClass('modal-lg');
      $("#modalPilihMenu .modal-header h1 > *").remove();
      $("#modalPilihMenu .modal-dialog .modal-content").removeClass('modalFamily');
      $("#modalPilihMenu .modal-dialog .modal-content").removeClass('modalPersonal');
  
      var listMenuPersonal = $(".content-homepage .personal-menu ul");
      listMenuPersonal.find("li").each(function (index, element) {
        $(element).find(".btnPilihMenu span:nth-child(2)").text("Pilih Menu");
        $(element).find(".btnPilihMenu").removeClass("aktifPilih");
        $(element).find("input[type=checkbox]").prop("checked", false);
        $(element).find("input[type=checkbox]").parent().removeClass("checked");
        $(element).find("input").css("display", "none");
        $(element).find("button.modalPilihMenu").css("display", "none");
      });
  
      var listMenuFamily = $(".content-homepage .family-menu ul");
      listMenuFamily.find("li").each(function (index, element) {
        $(element).find(".my-form-checkbox").removeClass("checked");
        $(element).find("input[type=checkbox]").prop("checked", false);
        $(element).find("input").css("display", "none");
        $(element).find("button.btnPilihMenu").css("display", "block");
        $(element).find("button.btnBatalPilih").css("display", "none");
        $(element).find("button.btnLanjut").css("display", "none");
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

    $("#modalPilihMenu").on('blur', ".qtyMenu", function() {
      if ($(this).val() == '') {
        $(this).val("1");
      }
    })
    // view homepage
  }

  urlCek = base_url + '/daftarPesanan';
  if ($(location).attr('href') == urlCek) {
    $(".content-daftar-pesanan").on('change', "#selectKota", function () {
      $(".content-daftar-pesanan #cbkCekAlamatRumah").prop("checked", false);
      $(".invalid-feedback, .valid-feedback").remove();
      var alamat = $(".content-daftar-pesanan select[name=selectKota]");
      if (alamat.val() === null || alamat.val() === "") {
        alamat.removeClass('is-valid').addClass('is-invalid');
        alamat.parent().append(`<div class="invalid-feedback invalid-kota">
                  Kota belum diisi
              </div>`);
          return; // Berhenti jika validasi gagal
      } else {
        alamat.removeClass('is-invalid'); // Hapus kelas invalid jika valid
      }
    })

    $(".content-daftar-pesanan").on('keyup', "#txtAlamat", function () {
      $(".invalid-feedback, .valid-feedback").remove();
      var alamat = $(".content-daftar-pesanan input[name=txtAlamat]");
      if (alamat.val() === null || alamat.val() === "") {
        alamat.removeClass('is-valid').addClass('is-invalid');
        alamat.parent().append(`<div class="invalid-feedback invalid-alamat">
                  Alamat belum diisi
              </div>`);
          return; // Berhenti jika validasi gagal
      } else {
        alamat.removeClass('is-invalid'); // Hapus kelas invalid jika valid
      }
    })

    // view daftar pesanan
    $(".content-daftar-pesanan .btnLanjutBayar").on('click', function() {
      var kota = $(".content-daftar-pesanan select[name=selectKota]");
      var alamat = $(".content-daftar-pesanan input[name=txtAlamat]");

      // Validasi kota
      if (kota.val() === null || kota.val() === "") {
        kota.removeClass('is-valid').addClass('is-invalid');
        kota.parent().append(`<div class="invalid-feedback invalid-kota">
                  Kota belum diisi
              </div>`);
          return; // Berhenti jika validasi gagal
      } else {
          kota.removeClass('is-invalid'); // Hapus kelas invalid jika valid
      }
      
      // Validasi alamat
      if (alamat.val() === null || alamat.val() === "") {
        alamat.removeClass('is-valid').addClass('is-invalid');
        alamat.parent().append(`<div class="invalid-feedback invalid-alamat">
                  Alamat belum diisi
              </div>`);
          return; // Berhenti jika validasi gagal
      } else {
        alamat.removeClass('is-invalid'); // Hapus kelas invalid jika valid
      }

      $(".my-collapse").css("display", "block");
       // Periksa offset elemen
      const collapseOffset = $("#collapsePembayaran").offset().top;
      const containerOffset = $('.content-daftar-pesanan').offset().top;
      console.log("Offset collapsePembayaran:", collapseOffset);
      console.log("Offset content-daftar-pesanan:", containerOffset);

      // Lakukan scroll ke elemen pembayaran
      $('.content-daftar-pesanan').animate({
          scrollTop: collapseOffset - containerOffset
      }, 1000); // Durasi scroll: 1 detik
    })

    $(".content-daftar-pesanan .btnHapusList").on('click', function(e) {
      var idDetailMenuPesanan = $(this).closest(".list-group-item").find("input[name=idDetailMenuPesanan]").val();
      var namaPack = $(this).closest(".list-group-item").find("input[name=namaPack]").val();
      var idAkun = $("#btnModalProfil").attr("data-id-akun");
      $.ajax({
        url: base_url + '/daftarPesanan/hapusMenu',
        type: 'POST',
        data: {
          idDetailMenuPesanan: idDetailMenuPesanan,
          namaPack: namaPack,
          idAkun: idAkun
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

    $(".content-daftar-pesanan .qtyMenu").on('blur', function() {
      if ($(this).val() == '') {
        $(this).val("1");
        var totalHargaMenu = 0;
        var listItemsMenu = $(".list-daftar-pesanan");
        listItemsMenu.find("li").each(function (index, element) {
          var qtyMenu = parseInt($(element).find(".qtyMenu").val());
          var hargaMenu = parseInt($(element).find(".hargaMenu").text());
          totalHargaMenu = totalHargaMenu + (qtyMenu*hargaMenu);
        });
        $(".totalHargaMenu").text("Rp. " + totalHargaMenu);
        var stringHargaOngkir = $(".hargaOngkir").text();
        var hargaOngkir = stringHargaOngkir.split(".");
        $(".totalHargaMenuKeseluruhan").text("Rp. " + (totalHargaMenu+parseInt(hargaOngkir[1])));
      }
    })
  
    $(".content-daftar-pesanan .qtyMenu").on('keyup', function(e) {
      if (e.code == 'KeyE' || e.code == 'Minus' || $(this).val() == '') {
        $(this).val();
      } else {
        var totalHargaMenu = 0;
        var listItemsMenu = $(".list-daftar-pesanan");
        listItemsMenu.find("li").each(function (index, element) {
          var qtyMenu = parseInt($(element).find(".qtyMenu").val());
          var hargaMenu = parseInt($(element).find(".hargaMenu").text());
          totalHargaMenu = totalHargaMenu + (qtyMenu*hargaMenu);
        });
        $(".totalHargaMenu").text("Rp. " + totalHargaMenu);
        var stringHargaOngkir = $(".hargaOngkir").text();
        var hargaOngkir = stringHargaOngkir.split(".");
        $(".totalHargaMenuKeseluruhan").text("Rp. " + (totalHargaMenu+parseInt(hargaOngkir[1])));
      }
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

    $(".content-daftar-pesanan #txtNominal").on('blur', function(e) {
      var nominal = $(".content-daftar-pesanan input[name=txtNominal]");
      nominal.removeClass('is-invalid'); // Hapus kelas invalid jika valid
    })
    
    $(".content-daftar-pesanan #txtAtasNama").on('blur', function(e) {
      var atasNama = $(".content-daftar-pesanan input[name=txtAtasNama]");
      atasNama.removeClass('is-invalid'); // Hapus kelas invalid jika valid
    })
    
    $(".content-daftar-pesanan #txtNominal").on('keyup', function(e) {
      $(".invalid-feedback, .valid-feedback").remove();
      var nominal = $(".content-daftar-pesanan input[name=nominal]");
      if (nominal.val() === null || nominal.val() === "") {
        nominal.removeClass('is-valid').addClass('is-invalid');
        nominal.parent().append(`<div class="invalid-feedback invalid-nominal">
                  Nominal belum diisi
              </div>`);
          return; // Berhenti jika validasi gagal
      } else {
        nominal.removeClass('is-invalid'); // Hapus kelas invalid jika valid
      }
      if (e.code == 'KeyE' || e.code == 'Minus' || $(this).val() == '') {
        $(this).val();
      } 
    })
    
    $(".content-daftar-pesanan").on('keyup', "#txtAtasNama", function () {
      console.log($(this).val());
      $(".invalid-feedback, .valid-feedback").remove();
      var atasNama = $(".content-daftar-pesanan input[name=atasNama]");
      if (atasNama.val() === null || atasNama.val() === "") {
        atasNama.removeClass('is-valid').addClass('is-invalid');
        atasNama.parent().append(`<div class="invalid-feedback invalid-atasNama">
                  Nama Peneransfer belum diisi
              </div>`);
          return; // Berhenti jika validasi gagal
      } else {
        atasNama.removeClass('is-invalid'); // Hapus kelas invalid jika valid
      }
    })
    
    $(".content-daftar-pesanan").on('change', "#fileGambar", function () {
      console.log($(this).val());
      $(".invalid-feedback, .valid-feedback").remove();
      var fileInput = $('.content-daftar-pesanan #fileGambar')[0];
      var file = fileInput.files[0];
      var allowedExtensions = ["jpg", "jpeg", "png"];
      var allowedMimeTypes = ["image/jpeg", "image/jpg", "image/png"];

      // Ambil ekstensi file
      var fileExtension = file.name.split('.').pop().toLowerCase();

      // Validasi ekstensi file
      if (!allowedExtensions.includes(fileExtension)) {
        $(".content-daftar-pesanan #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
            File harus dalam format JPG/JPEG
        </div>`);
        return;
      } else {
        $(".content-daftar-pesanan #fileGambar").parent().find(".invalid-fileGambar").remove();
      }

      // Validasi tipe MIME
      if (!allowedMimeTypes.includes(file.type)) {
        $(".content-daftar-pesanan #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
            File harus dalam format JPG/JPEG
        </div>`);
        return;
      } else {
        $(".content-daftar-pesanan #fileGambar").parent().find(".invalid-fileGambar").remove();
      }
    })

    $(".content-daftar-pesanan #btnBayarPesananan").on("click", function() {
      var kota = $(".content-daftar-pesanan select[name=selectKota]");
      var alamat = $(".content-daftar-pesanan input[name=txtAlamat]");
      var nominal = $(".content-daftar-pesanan #txtNominal").val();
      var atasNama = $(".content-daftar-pesanan #txtAtasNama").val();
      var fileInput = $('.content-daftar-pesanan #fileGambar')[0];
      // Hapus pesan error sebelumnya
      $(".invalid-feedback, .valid-feedback, .text-danger").remove();

      // Validasi kota
      if (kota.val() === null || kota.val() === "") {
        kota.removeClass('is-valid').addClass('is-invalid');
        kota.parent().append(`<div class="invalid-feedback invalid-kota">
                  Kota belum diisi
              </div>`);
          return; // Berhenti jika validasi gagal
      } else {
          kota.removeClass('is-invalid'); // Hapus kelas invalid jika valid
      }
      
      // Validasi alamat
      if (alamat.val() === null || alamat.val() === "") {
        alamat.removeClass('is-valid').addClass('is-invalid');
        alamat.parent().append(`<div class="invalid-feedback invalid-alamat">
                  Alamat belum diisi
              </div>`);
          return; // Berhenti jika validasi gagal
      } else {
        alamat.removeClass('is-invalid'); // Hapus kelas invalid jika valid
      }

      // Validasi File Gambar
      if (!fileInput.files || fileInput.files.length === 0) {
        $(".content-daftar-pesanan #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
            File bukti transfer belum diupload
        </div>`);
        return;
      }

      var file = fileInput.files[0];
      var allowedExtensions = ["jpg", "jpeg"];
      var allowedMimeTypes = ["image/jpeg", "image/jpg"];

      // Ambil ekstensi file
      var fileExtension = file.name.split('.').pop().toLowerCase();

      // Validasi ekstensi file
      if (!allowedExtensions.includes(fileExtension)) {
        $(".content-daftar-pesanan #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
            File harus dalam format JPG/JPEG
        </div>`);
        return;
      }
      // Validasi tipe MIME
      if (!allowedMimeTypes.includes(file.type)) {
        $(".content-daftar-pesanan #fileGambar").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-fileGambar">
            File harus dalam format JPG/JPEG
        </div>`);
        return;
      }

      // Validasi Nominal
      if (!nominal) {
        $(".content-daftar-pesanan #txtNominal").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-nominal">
            Nominal belum diisi
        </div>`);
        return;
      } else {
        $(".content-daftar-pesanan #txtNominal").removeClass('is-invalid')
      }

      // Validasi Atas Nama
      if (!atasNama) {
        $(".content-daftar-pesanan #txtAtasNama").addClass('is-invalid').parent().append(`<div class="invalid-feedback invalid-atasNama">
            Nama Penarasfer belum diisi
        </div>`);
        return;
      } else {
        $(".content-daftar-pesanan #txtAtasNama").removeClass('is-invalid')
      }
      
      // Ambil data
      var listItemsMenu = $(".list-daftar-pesanan");
      var dataPesanan = []
      listItemsMenu.find("li").each(function (index, element) {
        var idDetailMenuPesanan = $(element).find("input[name=idDetailMenuPesanan]").val();
        var pack = $(element).find("input[name=pack]").val();
        var textQtyMenu = $(element).find("input[name=textQtyMenu]").val();
        var keteranganPedas = $(element).find("input[name=cbkPedas]").is(":checked") ? "p" : "t";
        var karbo = $(element).find("select[name=selectKarbo]").val();
        var pantangan = $(element).find("input[name=txtPantangan]").val();
        dataPesanan.push({
          idDetailMenuPesanan: idDetailMenuPesanan, 
          pack: pack, 
          textQtyMenu: textQtyMenu,
          keteranganPedas: keteranganPedas, 
          karbo: karbo,
          pantangan: pantangan
        });
      });

      var ongkir = $(".content-daftar-pesanan #selectKota").val();
      var alamat = $(".content-daftar-pesanan #txtAlamat").val();
      var nominal = $(".content-daftar-pesanan #txtNominal").val();
      var atasNama = $(".content-daftar-pesanan #txtAtasNama").val();
      var fileInput = $('.content-daftar-pesanan #fileGambar')[0];

      var formData = new FormData();
      formData.append('ongkir', ongkir);
      formData.append('alamat', alamat);
      formData.append('nominal', nominal);
      formData.append('atasNama', atasNama);
      formData.append('dataPesanan', JSON.stringify(dataPesanan));
      formData.append('fileGambar', fileInput.files[0]);

      // Kirim data menggunakan AJAX
      $.ajax({
        url: base_url + '/pesanan/bayar',
        type: 'POST',
        data: formData,
        dataType: 'json',
        contentType: false,  // Jangan set Content-Type, biar FormData yang mengatur
        processData: false,  // Jangan memproses data menjadi string
        success: function(response) {
            console.log(response);
            window.location.href = base_url + '/pesananKu';
        },
        error: function(xhr, status, error) {
            // Menangani kesalahan
            alert('Terjadi kesalahan saat mengupload!');
        }
      });
    })
    // view daftar pesanan
  }

  urlCek = base_url + '/pesananKu';
  if ($(location).attr('href') == urlCek) {
    $(".content-pesananku .btnBerhentiPaketan").on("click", function() {
      var idPesanan = $(this).attr("data-idPesanan");
      var indexBaris = $(this).attr("data-indexBaris");

      $("#modalBerhentiPaketan #modalBtnBerhentiPaketan").attr("data-IdPesanan", idPesanan);
      $("#modalBerhentiPaketan #modalBtnBerhentiPaketan").attr("data-indexBaris", indexBaris);
    })

    $("#modalBerhentiPaketan #modalBtnBerhentiPaketan").on("click", function() {
      var idPesanan = $(this).attr("data-idPesanan");
      var indexBaris = $(this).attr("data-indexBaris");

      $.ajax({
        url: base_url + '/pesanan/berhentiPaketan',
        type: 'POST',
        data: {
          idPesanan: idPesanan
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
      const modalBerhentiPaketan = document.getElementById('modalBerhentiPaketan');    
      const modalInstance = bootstrap.Modal.getInstance(modalBerhentiPaketan);
      modalInstance.hide();
      $(".modal-backdrop").remove();
      var btnBerhentiPaketan = $("table tr").find(`.btnBerhentiPaketan[data-indexBaris="${indexBaris}"]`);
      btnBerhentiPaketan.after(`<span class="badge text-bg-danger">Berhenti</span>`);
      btnBerhentiPaketan.remove();
    })

    $(".content-pesananku .btnBatalPesanan").on("click", function() {
      var idPesanan = $(this).attr("data-idPesanan");
      var idJadwalMenu = $(this).attr("data-idJadwalMenu");
      var indexBaris = $(this).attr("data-indexBaris");

      $("#modalBatalPesan #modalBtnBatal").attr("data-IdPesanan", idPesanan);
      $("#modalBatalPesan #modalBtnBatal").attr("data-idJadwalMenu", idJadwalMenu);
      $("#modalBatalPesan #modalBtnBatal").attr("data-indexBaris", indexBaris);
    })

    $("#modalBatalPesan #modalBtnBatal").on("click", function() {
      var idPesanan = $(this).attr("data-idPesanan");
      var idJadwalMenu = $(this).attr("data-idJadwalMenu");
      var indexBaris = $(this).attr("data-indexBaris");

      $.ajax({
        url: base_url + '/pesanan/batal',
        type: 'POST',
        data: {
          idPesanan: idPesanan,
          idJadwalMenu: idJadwalMenu
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
      const modalBatalPesan = document.getElementById('modalBatalPesan');    
      const modalInstance = bootstrap.Modal.getInstance(modalBatalPesan);
      modalInstance.hide();
      $(".modal-backdrop").remove();
      var btnTolakPesanan = $("table tr").find(`.btnBatalPesanan[data-indexBaris="${indexBaris}"]`);
      btnTolakPesanan.after(`<span class="badge text-bg-danger">Di Batalkan</span>`);
      btnTolakPesanan.remove();
    })
  }

  var currentUrl = window.location.href;
  // Periksa apakah URL mengandung 'pesananDetailPaketan'
  if (currentUrl.includes("pesananDetailPaketan")) {
    modalGantiMasa.addEventListener('hidden.bs.modal', event => {
      $("#modalGantiMasa input").val('');
    })

    modalGantiMasa.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget;
      // Extract info from data-bs-* attributes
      const idPesanan = button.getAttribute('data-idPesanan');
      const idCatatanPesanan = button.getAttribute('data-idCatatanPesanan');

      // Update the modal's content.
      const modalBtnTolak = modalGantiMasa.querySelector('#btnGantiMasaHari');
      modalBtnTolak.setAttribute('data-idPesanan', idPesanan);
      modalBtnTolak.setAttribute('data-idCatatanPesanan', idCatatanPesanan);
    })

    $("#modalGantiMasa #btnGantiMasaHari").on("click", function() {
      var idPesanan = $(this).attr("data-idPesanan");
      var idCatatanPesanan = $(this).attr("data-idCatatanPesanan");
      var masaHariBaru = $("#modalGantiMasa input").val();

      $.ajax({
        url: base_url + '/pesanan/gantiMasaHariPaketan',
        type: 'POST',
        data: {
          idPesanan: idPesanan,
          idCatatanPesanan: idCatatanPesanan,
          masaHariBaru: masaHariBaru
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
  }

  $(".content-pesanan-datang #btnTerima").on("click", function() {
    var idAkun = $("#btnModalProfil").attr("data-id-akun");
    
    $.ajax({
      url: base_url + '/pesanan/terima',
      type: 'POST',
      data: {
        idAkun: idAkun
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
    window.location.href = base_url + '/pesananSelesai';
  })

  $(".content-pesanan-selesai .btnReview").on("click", function() {
    var idPesanan = $(this).attr("data-idPesanan");
    var idMenuPesanan = $(this).attr("data-idMenuPesanan");
    var indexBaris = $(this).attr("data-indexBaris");
    
    $("#modalReview #modalBtnReview").attr("data-IdPesanan", idPesanan);
    $("#modalReview #modalBtnReview").attr("data-idMenuPesanan", idMenuPesanan);
    $("#modalReview #modalBtnReview").attr("data-indexBaris", indexBaris);
  })

  $("#modalReview #modalBtnReview").on("click", function() {
    var idPesanan = $(this).attr("data-idPesanan");
    var idMenuPesanan = $(this).attr("data-idMenuPesanan");
    var indexBaris = $(this).attr("data-indexBaris");
    var review = $("#modalReview input").val();
    
    $.ajax({
      url: base_url + '/pesanan/reviewPesanan',
      type: 'POST',
      data: {
        idPesanan: idPesanan,
        idMenuPesanan: idMenuPesanan,
        review: review
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
    const modalReview = document.getElementById('modalReview');    
    const modalInstance = bootstrap.Modal.getInstance(modalReview);
    modalInstance.hide();
    $(".modal-backdrop").remove();
    var btnReview = $("table tr").find(`.btnReview[data-indexBaris="${indexBaris}"]`);
    btnReview.remove();
  })

  $(".content-detail-pesanan-p .btnTunda").on("click", function() {
    var idMenuPesanan = $(this).attr("data-idMenuPesanan");
    var idPesanan = $(this).attr("data-idPesanan");
    var indexBaris = $(this).attr("data-indexBaris");
    
    $("#modalTundaPesanan #modalBtnTunda").attr("data-idMenuPesanan", idMenuPesanan);
    $("#modalTundaPesanan #modalBtnTunda").attr("data-idPesanan", idPesanan);
    $("#modalTundaPesanan #modalBtnTunda").attr("data-indexBaris", indexBaris);
  })

  $("#modalTundaPesanan #modalBtnTunda").on("click", function() {
    var idMenuPesanan = $(this).attr("data-idMenuPesanan");
    var idPesanan = $(this).attr("data-idPesanan");
    var indexBaris = $(this).attr("data-indexBaris");
    
    $.ajax({
      url: base_url + '/pesanan/tundaPesanan',
      type: 'POST',
      data: {
        idMenuPesanan: idMenuPesanan,
        idPesanan: idPesanan,
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
    // const modalTundaPesanan = document.getElementById('modalTundaPesanan');    
    // const modalInstance = bootstrap.Modal.getInstance(modalTundaPesanan);
    // modalInstance.hide();
    // $(".modal-backdrop").remove();
    // var listPesanan = $(`li[data-indexBaris="${indexBaris}"]`);
    // console.log(listPesanan);
    // listPesanan.remove();
  })


});