@extends('layouts.main')

@section('container')

<!--Content-->

        <div class="container mt-3">
            <h2>Formulir Input Laporan SPPD</h2>
                <h4 class="border-bottom">Surat Perintah Perjalanan Dinas (SPPD)</h4>
                <p class="text-muted mb-3"><span>*</span> ➞ wajib diisi</p>
                    <form action="{{ route('sppd.store') }}" method="post">
                      @csrf
                      @method('POST')
                      <div class="row">
                          <div class="col-sm-4">
                            <div class="mb-3">
                              <label for="masukSPPD" class="form-label">Tanggal Masuk SPPD</label>
                              <span class="required">*</span>
                              <input type="date" name="sppd_tgl_msk" class="form-control @error('nomorSPPD') is-invalid @enderror" id="masukSPPD" required>
                              @error('masukSPPD')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <label for="unitKerja" class="form-label">Unit Kerja</label>
                              <span class="required">*</span>
                              <input type="text" name="unit_kerja" class="form-control  @error('unitKerja') is-invalid @enderror" id="unitKerja" required>
                              @error('unitKerja')
                                <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <label for="tujuan" class="form-label">Tempat/Tujuan Perjalanan Dinas</label>
                              <span class="required">*</span>
                              <input type="text" name="sppd_tujuan" class="form-control  @error('tujuan') is-invalid @enderror" id="tujuan" required>
                              @error('tujuan')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <label for="angkutan" class="form-label">Alat Angkutan yang Dipergunakan</label>
                              <span class="required">*</span>
                              <select class="form-select @error('angkutan') is-invalid @enderror" aria-label="select example" name="sppd_kendaraan"  id="angkutan" required>
                                <option selected>Pilih Kendaraan</option>
                                <option value="1">Kendaraan Darat</option>
                                <option value="2">Kendaraan Udara</option>
                                <option value="3">Kendaraan Dinas / Pribadi</option>
                              </select>
                              @error('angkutan')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <label for="maksud" class="form-label">Maksud Perjalanan Dinas</label>
                              <span class="required">*</span>
                              <input type="text" name="sppd_alasan" class="form-control  @error('maksud') is-invalid @enderror" id="maksud" required>
                              @error('maksud')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                            <div class="mb-3">
                               <label for="waktu" class="form-label">Lama Perjalanan Dinas</label>
                               <span class="required">*</span>
                               <div class="input-group">
                                    <input type="date" name="tgl_berangkat" class="form-control  @error('waktuawal') is-invalid @enderror" id="waktuawal" required>
                                    <span class="input-group-btn"></span>
                                    @error('waktuawal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <input type="date" name="tgl_pulang" class="form-control  @error('waktuakhir') is-invalid @enderror" id="waktuakhir" required>
                                    <span class="input-group-btn"></span>
                                    @error('waktuakhir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="button" class="btn btn-outline-dark mt-3" onclick="tanggal();">Hitung Tanggal</button>
                            </div>
                            <div class="mb-3">
                              <p>Lama perjalanan <b class="hasilselisih"></b> hari</p>
                            </div>
                        </div>
                <div class="col-sm-8">
                          <div class="mb-3">
                              <label for="nomorSPPD" class="form-label">Nomor SPPD</label>
                              <span class="required">*</span>
                              <input type="text" name="sppd_no" class="form-control @error('nomorSPPD') is-invalid @enderror" id="nomorSPPD" required>
                              @error('nomorSPPD')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="mb-2">
                            <label for="pegawai" class="form-label">Nama Pegawai</label>
                            <span class="required">*</span>
                            <input type="text" name="pegawai[]" class="form-control  @error('pegawai') is-invalid @enderror" id="pegawai" required>
                            <div id="newElementId"></div>
                            <input type="button" class="btn btn-outline-dark mt-3" value="Tambah Pegawai" onclick="createNewPegawai();"/>
                            @error('pegawai')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                       
                </div>
                </div>

                <h4 class=" border-bottom">Izin Penggunaan Anggaran (IPA)</h4> 
                <p class="text-muted mb-3">Kosongkan Bila Belum Memiliki IPA</p>
                <div class="row">
                    <div class="col-sm-4 mb-2">
                      <label for="operatorPengisi" class="form-label">Nama Operator Pengisi</label>
                      <span class="required">*</span>
                      <select aria-label="Default select example" name="op_pengisi" class="form-select  @error('operatorPengisi') is-invalid @enderror" id="operatorPengisi" required>
                        <option selected disabled hidden>Pilih Nama Operator</option>
                        <option value="1">Ady</option>
                        <option value="2">Rika</option>
                      </select>
                      @error('operatorPengisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-4 mb-2">
                      <label for="nomorIPA" class="form-label">Nomor IPA</label>
                      <div id="ipaipa">
                        <select class="form-select" name="ipa_no" id="ipa">
                          <option value="0" selected>IPA</option>
                          @foreach ($ipa_list as $ipa)
                            <option value="{{ $ipa->ipa_no }}">{{ $ipa->ipa_no }}</option>
                          @endforeach
                        </select>
                        <button type="button" class="btn btn-outline-dark mt-3" onclick="createNewIPA();">IPA Belum Terdaftar</button>
                        <label>klik jika IPA belum terdaftar</label>
                      </div>
                      <input type="text" name="ipa_no" class="form-control" id="nomorIPA">
                      </div>
                  </div>

                <div class="row" id="newIPA"> 
                <div class="row">
                  <div class="col-sm-4 mt-2">
                          <div class="mb-3">
                            <label for="nilaiIPA" class="form-label">Nilai IPA</label>
                            <div class="input-group">
                              <span class="input-group-text" id="basic-addon1">Rp.</span>
                              <input type="text" name="ipa_nilai" class="form-control  @error('nilaiIPA') is-invalid @enderror" id="nilaiIPA">
                            </div>
                            @error('nilaiIPA')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>     
                  </div>
                  <div class="col-sm-4 mt-2">
                          <div class="mb-3">
                            <label for="sumberDana" class="form-label">Sumber Dana</label>
                            <input type="text" name="sumber_dana" class="form-control  @error('sumberDana') is-invalid @enderror" id="sumberDana">
                            @error('sumberDana')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                  </div>
            </div>
            <div class="row" id="newIPA">
                  <div class="col-sm-4 mt-2">
                          <div class="mb-3">
                            <label for="buatIPA" class="form-label">Tanggal IPA dibuat</label>
                            <input type="date" name="ipa_tgl_dibuat" class="form-control" id="buatIPA">
                          </div>
                          <div class="mb-3">
                            <label for="financeIPA" class="form-label">Tanggal IPA masuk Finance</label>
                            <input type="date" name="ipa_tgl_msk_finance" class="form-control" id="financeIPA">
                          </div>
                         
                  </div>
                  <div class="col-sm-4 mt-2">
                          <div class="mb-3">
                            <label for="ajukanIPA" class="form-label">Tanggal IPA diajukan</label>
                            <input type="date" name="ipa_tgl_diajukan" class="form-control" id="ajukanIPA">
                          </div>
                          <div class="mb-3">
                            <label for="selesaiIPA" class="form-label">Tanggal IPA Selesai</label>
                            <input type="date" name="ipa_tgl_selesai" class="form-control" id="selesaiIPA">
                          </div>
                  </div>
                  <div class="col-sm-4 mt-2">
                    <div class="mb-3">
                        <label for="approveIPA" class="form-label">Tanggal IPA disetujui</label>
                        <input type="date" name="ipa_tgl_approval" class="form-control" id="approveIPA">
                    </div>
                  </div>
            </div>
            </div>

            <div class="row mt-2">
                <h4 class=" border-bottom">Permohonan Pembayaran (PP)</h4>
                <p class="text-muted">Kosongkan Bila Belum Memiliki PP</p>
                <div class="col-sm-4 mt-2">
                  <div class="mb-3">
                    <label for="nomorPP" class="form-label">Nomor PP</label>
                    <div id="pppp">
                      <select class="form-select" name="pp_no" id="pp">
                        @foreach ($pp_list as $pp)
                          <option value="0" selected>PP</option>
                          <option value="{{ $pp->pp_no }}">{{ $pp->pp_no }}</option>
                        @endforeach
                      </select>
                      <button type="button" class="btn btn-outline-dark mt-3" onclick="createNewPP();">PP Belum Terdaftar</button>
                      <label>klik jika PP belum terdaftar</label>
                    </div>
                    <input type="text" name="pp_no" class="form-control" id="nomorPP">
                  </div>
                </div>
                <div class="row" id="newPP">
                  <div class="col-sm-4 mt-2">
                          <div class="mb-3">
                            <label for="buatPP" class="form-label">Tanggal PP dibuat</label>
                            <input type="date" name="pp_tgl_dibuat" class="form-control" id="buatPP">
                          </div>
                          <div class="mb-3">
                            <label for="financePP" class="form-label">Tanggal PP masuk Finance</label>
                            <input type="date" name="pp_tgl_msk_finance" class="form-control" id="financePP">
                          </div>
                  </div>
                  <div class="col-sm-4 mt-2">
                          <div class="mb-3">
                            <label for="ajukanPP" class="form-label">Tanggal PP diajukan</label>
                            <input type="date" name="pp_tgl_diajukan" class="form-control" id="ajukanPP">
                          </div>
                          <div class="mb-3">
                            <label for="selesaiPP" class="form-label">Tanggal PP Selesai</label>
                            <input type="date" name="pp_tgl_selesai" class="form-control" id="selesaiPP">
                          </div>
                  </div>
                  <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                          <label for="approvePP" class="form-label">Tanggal PP disetujui</label>
                          <input type="date" name="pp_tgl_approval" class="form-control" id="approvePP">
                        </div>
                  </div>
                </div>
            </div>

            <div class="text-center justify-content-center">
                <button class=" btn btn-lg btn-success button mt-3 mb-3" type="submit">Ajukan Laporan SPPD</button>
            </div>
        </div>
    </form>
    @section('script')
    <script>
      function createNewPegawai() {
          // First create a DIV element.
        var txtNewInputBox = document.createElement('div'); 
          // Then add the content (a new input box) of the element.
        txtNewInputBox.innerHTML = "<input type='text' name='pegawai[]' class='mt-2 form-control @error('pegawai[]') is-invalid @enderror' id='newInputBox'>";
          // Finally put it where it is supposed to appear.
        document.getElementById("newElementId").appendChild(txtNewInputBox);
      }

    </script>
    <script>
    var x = document.getElementById("newIPA");
    var y = document.getElementById("nomorIPA");
    var z = document.getElementById("ipaipa");
    var a = document.getElementById("newPP");
    var b = document.getElementById("nomorPP");
    var c = document.getElementById("pppp");
    window.onload = function() {

        x.style.display = "none";
        y.style.display = "none";
        z.style.display = "block";
        a.style.display = "none";
        b.style.display = "none";
        c.style.display = "block";

      };
    </script>
    <script>
    function createNewIPA(x,y,z) {
      var x = document.getElementById("newIPA");
      var y = document.getElementById("nomorIPA");
      var z = document.getElementById("ipaipa");

      if (x.style.display === "none") {
      x.style.display="flex";
      y.style.display="block";
      z.style.display="none";
      } else {
       x.style.display = "none";
       y.style.display = "none";
       z.style.display="block";
      }
    }
    </script>
    <script>
    function createNewPP(a,b,c) {
      var a = document.getElementById("newPP");
      var b = document.getElementById("nomorPP");
      var c = document.getElementById("pppp");

      if (a.style.display === "none") {
      a.style.display="flex";
      b.style.display="block";
      c.style.display="none";
      } else {
       a.style.display = "none";
       b.style.display = "none";
       c.style.display="block";
      }
    }
    </script>
    <script>
    function tanggal(){
    var startDate = $('#waktuawal').val()
    var endDate = $('#waktuakhir').val()
    if (startDate == '' || endDate == ''){
      return;
    }
      
    var awal = new Date(startDate);
    var akhir = new Date(endDate)
      
    if (akhir < awal){
      return;
    }
      
    var selisih = akhir - awal; 
    $('.hasilselisih').text(selisih / (1000 * 60 * 60 * 24));
    console.log(selisih / (1000 * 60 * 60 * 24));
  }
  </script>
    @endsection
@endsection