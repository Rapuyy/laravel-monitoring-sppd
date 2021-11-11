<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="sppd_no" content="width=device-width, initial-scale=1">

        <title>Web Monitoring SPPD - Formulir</title>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="/css/style.css">

    </head>
    <body>
        <!-- Navigation Bar-->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
              <a class="navbar-brand ms-2" href="/" style="color: aliceblue;">Web Monitoring SPPD</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <!--Content-->

        <div class="container mt-3">
            <h2>Formulir Input Laporan SPPD</h2>

            {{-- lupa mau ditaronya dimana
              <div class="mb-3">
                          <label for="unitKerja" class="form-label">Unit Kerja</label>
                          <span>*</span>
                          <input type="text" name="unit_kerja" class="form-control  @error('unitKerja') is-invalid @enderror" id="unitKerja" required>
                          @error('unitKerja')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
              --}}

                <h4 class="border-bottom">Surat Perintah Perjalanan Dinas (SPPD)</h4>
                <p class="text-muted mb-3"><span>*</span> ➞ wajib diisi</p>
                    <form action="{{ route('sppd.store') }}" method="post">
                      @csrf
                      @method('POST')
                        <div class="mb-3">
                          <label for="masukSPPD" class="form-label">Tanggal Masuk SPPD</label>
                          <span>*</span>
                          <input type="date" name="sppd_tgl_masuk" class="form-control @error('nomorSPPD') is-invalid @enderror" id="masukSPPD" required>
                          @error('masukSPPD')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="mb-3">
                              <label for="nomorSPPD" class="form-label">Nomor SPPD</label>
                              <span>*</span>
                              <input type="text" name="sppd_no" class="form-control @error('nomorSPPD') is-invalid @enderror" id="nomorSPPD" required>
                              @error('nomorSPPD')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <label for="tujuan" class="form-label">Tempat/Tujuan Perjalanan Dinas</label>
                              <span>*</span>
                              <input type="text" name="sppd_tujuan" class="form-control  @error('tujuan') is-invalid @enderror" id="tujuan" required>
                              @error('tujuan')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <label for="angkutan" class="form-label">Alat Angkutan yang Dipergunakan</label>
                              <span>*</span>
                              <input type="text" name="sppd_kendaraan" class="form-control  @error('angkutan') is-invalid @enderror" id="angkutan" required>
                              @error('angkutan')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>
                        </div>
                <div class="col-sm-8">
                          <div class="mb-3">
                            <label for="pegawai" class="form-label">Nama Pegawai</label>
                            <span>*</span>
                            <input type="text" name="pegawai" class="form-control  @error('pegawai') is-invalid @enderror" id="pegawai" required>
                            @error('pegawai')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="maksud" class="form-label">Maksud Perjalanan Dinas</label>
                          <span>*</span>
                          <input type="text" name="sppd_alasan" class="form-control  @error('maksud') is-invalid @enderror" id="maksud" required>
                          @error('maksud')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-3">
                           <label for="waktu" class="form-label">Lama Perjalanan Dinas</label>
                           <span>*</span>
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
                        </div>
                </div>
                </div>

                <h4 class=" border-bottom">Izin Penggunaan Anggaran (IPA)</h4> 
                <p class="text-muted mb-3">Kosongkan Bila Belum Memiliki IPA</p>
                <div class="row">
                    <div class="col-sm-4 mb-2">
                      <label for="operatorPengisi" class="form-label">Nama Operator Pengisi</label>
                      <span>*</span>
                      <input type="text" name="op_pengisi" class="form-control  @error('operatorPengisi') is-invalid @enderror" id="operatorPengisi" required>
                      @error('operatorPengisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-4 mb-2">
                        <label for="nomorIPA" class="form-label">Nomor IPA</label>
                        <input type="text" name="ipa_no" class="form-control" id="nomorIPA">
                      </div>
                  </div>

                <div class="row">
                  <div class="col-sm-4 mt-2">
                          <div class="mb-3">
                            <label for="buatIPA" class="form-label">Tanggal IPA dibuat</label>
                            <input type="date" name="ipa_tgl_dibuat" class="form-control" id="buatIPA">
                          </div>
                          <div class="mb-3">
                            <label for="ajukanIPA" class="form-label">Tanggal IPA diajukan</label>
                            <input type="date" name="ipa_tgl_diajukan" class="form-control" id="ajukanIPA">
                          </div>
                          <div class="mb-3">
                            <label for="nilaiIPA" class="form-label">Nilai IPA</label>
                            <span>*</span>
                            <input type="text" name="ipa_nilai" class="form-control  @error('nilaiIPA') is-invalid @enderror" id="nilaiIPA" required>
                            @error('nilaiIPA')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                  </div>
                  <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                          <label for="approveIPA" class="form-label">Tanggal IPA disetujui</label>
                          <input type="date" name="ipa_tgl_approval" class="form-control" id="approveIPA">
                        </div>
                          <div class="mb-3">
                            <label for="financeIPA" class="form-label">Tanggal IPA masuk Finance</label>
                            <input type="date" name="ipa_tgl_msk_finance" class="form-control" id="financeIPA">
                          </div>
                          <div class="mb-3">
                            <label for="sumberDana" class="form-label">Sumber Dana</label>
                            <span>*</span>
                            <input type="text" name="sumber_dana" class="form-control  @error('sumberDana') is-invalid @enderror" id="sumberDana" required>
                            @error('sumberDana')
                               <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                         </div>
                  </div>
                  <div class="col-sm-4 mt-2">
                      <div class="mb-3">
                        <label for="selesaiIPA" class="form-label">Tanggal IPA Selesai</label>
                        <input type="date" name="ipa_tgl_selesai" class="form-control" id="selesaiIPA">
                      </div>
              </div>
                </div>

            <div class="row mt-2">
                <h4 class=" border-bottom">Permohonan Pembayaran (PP)</h4>
                <p class="text-muted">Kosongkan Bila Belum Memiliki PP</p>
                <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                          <label for="nomorPP" class="form-label">Nomor PP</label>
                          <input type="text" name="pp_no" class="form-control" id="nomorPP">
                        </div>
                        <div class="mb-3">
                           <label for="buatPP" class="form-label">Tanggal PP dibuat</label>
                           <input type="date" name="pp_tgl_dibuat" class="form-control" id="buatPP">
                        </div>
                </div>
                <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                          <label for="ajukanPP" class="form-label">Tanggal PP diajukan</label>
                          <input type="date" name="pp_tgl_diajukan" class="form-control" id="ajukanPP">
                        </div>
                        <div class="mb-3">
                          <label for="approvePP" class="form-label">Tanggal PP disetujui</label>
                          <input type="date" name="pp_tgl_approval" class="form-control" id="approvePP">
                        </div>
                </div>
                <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                          <label for="financePP" class="form-label">Tanggal PP masuk Finance</label>
                          <input type="date" name="pp_tgl_msk_finance" class="form-control" id="financePP">
                        </div>
                        <div class="mb-3">
                          <label for="selesaiPP" class="form-label">Tanggal PP Selesai</label>
                          <input type="date" name="pp_tgl_selesai" class="form-control" id="selesaiPP">
                        </div>
                </div>
            </div>

            <div class="text-center justify-content-center">
                <button class=" btn btn-lg btn-success button mt-3 mb-3" type="submit">Ajukan Laporan SPPD</button>
            </div>
        </div>
        </form>

        <!--Footer-->
        <div class="footer">
            <p class="text-center">©2021 PT Jasamarga Tollroad Maintenance</p>
        </div>
    </body>
</html>