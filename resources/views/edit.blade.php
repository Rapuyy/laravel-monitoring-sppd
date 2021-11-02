<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="sppd_no" content="width=device-width, initial-scale=1">

        <title>Web Monitoring SPPD - Update</title>

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
            <h2>Formulir Update Laporan SPPD</h2>

            <div class="row mt-4">
                <h4 class="border-bottom">Surat Perintah Perjalanan Dinas (SPPD)</h4>
                <p class="text-muted"><span>*</span> ➞ wajib diisi</p>
                <div class="col-sm-4 mt-2">
                    <form action="{{ route('sppd.update') }}" method="post">
                      @csrf
                      @method('POST')
                      <input disabled type="hidden" name="id" value="{{ $sppd->id }}">
                        <div class="mb-3">
                          <label for="nomorSPPD" class="form-label">Nomor SPPD</label>
                          <span>*</span>
                          <input disabled type="text" name="sppd_no" class="form-control @error('nomorSPPD') is-invalid @enderror" id="nomorSPPD" required value="{{ $sppd->sppd_no }}">
                          @error('nomorSPPD')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-3">
                           <label for="tujuan" class="form-label">Tempat/Tujuan Perjalanan Dinas</label>
                           <span>*</span>
                           <input disabled type="text" name="sppd_tujuan" class="form-control  @error('tujuan') is-invalid @enderror" id="tujuan" required value="{{ $sppd->sppd_tujuan }}">
                           @error('tujuan')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-3">
                           <label for="angkutan" class="form-label">Alat Angkutan yang Dipergunakan</label>
                           <span>*</span>
                           <input disabled type="text" name="sppd_kendaraan" class="form-control  @error('angkutan') is-invalid @enderror" id="angkutan" required value="{{ $sppd->sppd_kendaraan }}">
                           @error('angkutan')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                </div>
                <div class="col-sm-8 mt-2">
                        <div class="mb-3">
                          <label for="pegawai" class="form-label">Nama Pegawai</label>
                          <span>*</span>
                          <input disabled type="text" name="pegawai" class="form-control  @error('pegawai') is-invalid @enderror" id="pegawai" required value="{{ $sppd->pegawai }}">
                          @error('pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="mb-3">
                          <label for="maksud" class="form-label">Maksud Perjalanan Dinas</label>
                          <span>*</span>
                          <input disabled type="text" name="sppd_alasan" class="form-control  @error('maksud') is-invalid @enderror" id="maksud" required value="{{ $sppd->sppd_alasan }}">
                          @error('maksud')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-3">
                           <label for="waktu" class="form-label">Lama Perjalanan Dinas</label>
                           <span>*</span>
                           <div class="input-group">
                                <input disabled type="date" name="tgl_berangkat" class="form-control  @error('waktuawal') is-invalid @enderror" id="waktuawal" required value="{{ $sppd->tgl_berangkat }}">
                                <span class="input-group-btn"></span>
                                @error('waktuawal')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <input disabled type="date" name="tgl_pulang" class="form-control  @error('waktuakhir') is-invalid @enderror" id="waktuakhir" required value="{{ $sppd->tgl_pulang }}">
                                <span class="input-group-btn"></span>
                                @error('waktuakhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                           </div>
                        </div>
                </div>
            </div>

            <div class="row mt-2">
                <h4 class=" border-bottom">Izin Penggunaan Anggaran (IPA)</h4> 
                <p class="text-muted">Kosongkan Bila Belum Memiliki IPA</p>
                <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                          <label for="nomorIPA" class="form-label">Nomor IPA</label>
                          <input type="text" name="ipa_no" class="form-control" id="nomorIPA" value="{{ $sppd->ipa_no }}">
                        </div>
                        <div class="mb-3">
                           <label for="ajukanIPA" class="form-label">Tanggal IPA dibuat</label>
                           <input type="date" name="ipa_tgl_dibuat" class="form-control" id="ajukanIPA" value="{{ $sppd->ipa_tgl_dibuat }}">
                        </div>
                </div>
                <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                          <label for="buatIPA" class="form-label">Tanggal IPA diajukan</label>
                          <input type="date" name="ipa_tgl_approval" class="form-control" id="buatIPA" value="{{ $sppd->ipa_tgl_approval }}">
                        </div>
                        <div class="mb-3">
                           <label for="selesaiIPA" class="form-label">Tanggal IPA selesai</label>
                           <input type="date" name="ipa_tgl_selesai" class="form-control" id="selesaiIPA" value="{{ $sppd->ipa_tgl_selesai }}">
                        </div>
                </div>
            </div>

            <div class="row mt-2">
                <h4 class=" border-bottom">Permohonan Pembayaran (PP)</h4>
                <p class="text-muted">Kosongkan Bila Belum Memiliki PP</p>
                <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                          <label for="nomorPP" class="form-label">Nomor PP</label>
                          <input type="text" name="pp_no" class="form-control" id="nomorPP" value="{{ $sppd->pp_no }}">
                        </div>
                        <div class="mb-3">
                           <label for="ajukanPP" class="form-label">Tanggal PP dibuat</label>
                           <input type="date" name="pp_tgl_dibuat" class="form-control" id="ajukanPP" value="{{ $sppd->pp_tgl_dibuat }}">
                        </div>
                </div>
                <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                          <label for="buatPP" class="form-label">Tanggal IPA diajukan</label>
                          <input type="date" name="pp_tgl_dibuat" class="form-control" id="buatPP" value="{{ $sppd->pp_tgl_approval }}">
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