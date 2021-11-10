<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="" content="width=device-width, initial-scale=1">

        <title>Web Monitoring SPPD - Update</title>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
                {{-- <p class="text-muted"><span>*</span> ➞ wajib diisi</p> --}}
                <div class="col-sm-4 mt-2">
                    <form action="{{ route('sppd.update') }}" method="post">
                      @csrf
                      @method('post')
                      <input  type="hidden" name="id" readonly value="{{ $sppd->id }}">
                        <div class="mb-3">
                          <label for="sppd_no" class="form-label">Nomor SPPD</label>
                          <span>*</span>
                          <input type="text" name="sppd_no" class="form-control @error('sppd_no') is-invalid @enderror" id="sppd_no" required readonly value="{{ $sppd->sppd_no }}">
                          @error('sppd_no')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-3">
                           <label for="tujuan" class="form-label">Tempat/Tujuan Perjalanan Dinas</label>
                           <span>*</span>
                           <input type="text" name="sppd_tujuan" class="form-control  @error('tujuan') is-invalid @enderror" id="tujuan" required readonly value="{{ $sppd->sppd_tujuan }}">
                           @error('tujuan')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-3">
                           <label for="angkutan" class="form-label">Alat Angkutan yang Dipergunakan</label>
                           <span>*</span>
                           <input type="text" name="sppd_kendaraan" class="form-control  @error('angkutan') is-invalid @enderror" id="angkutan" required readonly value="{{ $sppd->sppd_kendaraan }}">
                           @error('angkutan')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                </div>
                <div class="col-sm-8 mt-2">
                        <div class="mb-3">
                          <label for="pegawai" class="form-label">Nama Pegawai</label>
                          <span>*</span>
                          <input type="text" name="pegawai" class="form-control  @error('pegawai') is-invalid @enderror" id="pegawai" required readonly value="{{ $sppd->pegawai }}">
                          @error('pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="mb-3">
                          <label for="maksud" class="form-label">Maksud Perjalanan Dinas</label>
                          <span>*</span>
                          <input type="text" name="sppd_alasan" class="form-control  @error('maksud') is-invalid @enderror" id="maksud" required readonly value="{{ $sppd->sppd_alasan }}">
                          @error('maksud')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-3">
                           <label for="waktu" class="form-label">Lama Perjalanan Dinas</label>
                           <span>*</span>
                           <div class="input-group">
                                <input type="date" name="tgl_berangkat" class="form-control  @error('waktuawal') is-invalid @enderror" id="waktuawal" required readonly value="{{ $sppd->tgl_berangkat }}">
                                <span class="input-group-btn"></span>
                                @error('waktuawal')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <input type="date" name="tgl_pulang" class="form-control  @error('waktuakhir') is-invalid @enderror" id="waktuakhir" required readonly value="{{ $sppd->tgl_pulang }}">
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
                <span><p class="text-muted">Kosongkan Bila Belum Memiliki IPA</p>
                  @if($sppd->status == "0")
                  <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">IPA dibuat</a></span>
                  @elseif($sppd->status == "1")
                  <a href="/" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">IPA diajukan</a></span>
                  @elseif($sppd->status == "2")
                  <a href="/" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">IPA disetujui</a></span>
                  @elseif($sppd->status == "3")
                  <a href="/" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">IPA masuk Finance</a></span>
                  @elseif($sppd->status == "4")
                  <a href="/" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">IPA Selesai</a></span>
                  @else
                  <button class="btn btn-secondary" disabled>IPA Selesai</button></span>
                  @endif
                <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                          <label for="nomorIPA" class="form-label">Nomor IPA</label>
                          <input type="text" name="ipa_no" class="form-control" id="nomorIPA" value="{{ $sppd->ipa_no }}">
                        </div>
                        <div class="mb-3">
                           <label for="buatIPA" class="form-label">Tanggal IPA dibuat</label>
                           <input type="date" name="ipa_tgl_dibuat" class="form-control" id="dateIPA" value="{{ $sppd->ipa_tgl_dibuat }}" readonly>
                        </div>
                </div>
                <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                          <label for="ajukanIPA" class="form-label">Tanggal IPA diajukan</label>
                          <input type="date" name="ipa_tgl_diajukan" class="form-control" id="ajukanIPA" value="{{ $sppd->ipa_tgl_diajukan }}" readonly>
                        </div>
                        <div class="mb-3">
                           <label for="approveIPA" class="form-label">Tanggal IPA disetujui</label>
                           <input type="date" name="ipa_tgl_approval" class="form-control" id="approveIPA" value="{{ $sppd->ipa_tgl_approval }}" readonly>
                        </div>
                </div>
                <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                          <label for="financeIPA" class="form-label">Tanggal IPA masuk ke Finance</label>
                          <input type="date" name="ipa_tgl_msk_finance" class="form-control" id="financeIPA" value="{{ $sppd->ipa_tgl_msk_finance }}" readonly>
                        </div>
                        <div class="mb-3">
                           <label for="selesaiIPA" class="form-label">Tanggal IPA Selesai</label>
                           <input type="date" name="ipa_tgl_selesai" class="form-control" id="selesaiIPA" value="{{ $sppd->ipa_tgl_selesai }}" readonly>
                        </div>
                </div>
            </div>

            <div class="row mt-2">
                <h4 class=" border-bottom">Permohonan Pembayaran (PP)</h4>
                <span><p class="text-muted">Kosongkan Bila Belum Memiliki PP</p>
                @if($sppd->status == "10")
                  <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">PP dibuat</a></span>
                  @elseif($sppd->status == "11")
                  <a href="/" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">PP diajukan</a></span>
                  @elseif($sppd->status == "12")
                  <a href="/" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">PP disetujui</a></span>
                  @elseif($sppd->status == "13")
                  <a href="/" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">PP masuk Finance</a></span>
                  @elseif($sppd->status == "14")
                  <a href="/" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">PP Selesai</a></span>
                  @else
                  <button class="btn btn-secondary" disabled>PP Selesai</button></span>
                  @endif
                <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                          <label for="nomorPP" class="form-label">Nomor PP</label>
                          <input type="text" name="pp_no" class="form-control" id="nomorPP" value="{{ $sppd->pp_no }}">
                        </div>
                        <div class="mb-3">
                           <label for="buatPP" class="form-label">Tanggal PP dibuat</label>
                           <input type="date" name="pp_tgl_dibuat" class="form-control" id="buatPP" value="{{ $sppd->pp_tgl_dibuat }}" readonly>
                        </div>
                </div>
                <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                          <label for="ajukanPP" class="form-label">Tanggal PP diajukan</label>
                          <input type="date" name="pp_tgl_diajukan" class="form-control" id="ajukanPP" value="{{ $sppd->pp_tgl_diajukan }}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="approvePP" class="form-label">Tanggal PP disetujui</label>
                          <input type="date" name="pp_tgl_approval" class="form-control" id="approvePP" value="{{ $sppd->pp_tgl_approval }}" readonly>
                        </div>
                </div>
                <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                          <label for="financePP" class="form-label">Tanggal PP masuk ke Finance</label>
                          <input type="date" name="pp_tgl_msk_finance" class="form-control" id="financePP" value="{{ $sppd->pp_tgl_msk_finance }}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="selesaiPP" class="form-label">Tanggal PP selesai</label>
                          <input type="date" name="pp_tgl_selesai" class="form-control" id="selesaiPP" value="{{ $sppd->pp_tgl_selesai }}" readonly>
                        </div>
                </div>
            </div>

          <div class="text-center justify-content-center">
                <button class=" btn btn-lg btn-success button mt-3 mb-3" type="submit">Ajukan Perubahan Laporan SPPD</button>
            </div><br>
        </div>
        </form>

        <div class="container">
        <h3>Status SPPD</h3>
        <table class="table table-bordered ket-status text-center">
          <tr>
            <td colspan="5">IPA</td>
          </tr>
          <tr>
            <td class="table-status">Diajukan</td>
            <td class="table-status">Disetujui</td>
            <td class="table-status">Di Finance</td>
            <td class="table-status">Selesai</td>
            <td>Total</td>
          </tr>
          <tr>
            <td class="table-hari">{{ $progres->ipa_1 }} hari</td>
            <td class="table-hari">{{ $progres->ipa_2 }} hari</td>
            <td class="table-hari">{{ $progres->ipa_3 }} hari</td>
            <td class="table-hari">{{ $progres->ipa_4 }} hari</td>
            <td class="table-hari">{{ $progres->ipa }} hari</td>
          </tr>
          <tr>
            <td colspan="5">PP</td>
          </tr>
          <tr>
            <td class="table-status">Diajukan</td>
            <td class="table-status">Disetujui</td>
            <td class="table-status">Di Finance</td>
            <td class="table-status">Selesai</td>
            <td>Total</td>
          </tr>
          <tr>
            <td class="table-hari">{{ $progres->pp_1 }} hari</td>
            <td class="table-hari">{{ $progres->pp_2 }} hari</td>
            <td class="table-hari">{{ $progres->pp_3 }} hari</td>
            <td class="table-hari">{{ $progres->pp_4 }} hari</td>
            <td class="table-hari">{{ $progres->pp }} hari</td>
          </tr>
      </table>
      </div>

        <!--Footer-->
        <div class="footer">
            <p class="text-center">©2021 PT Jasamarga Tollroad Maintenance</p>
        </div>

        <!--Modal-->
        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-center">
                <h4>{{$tanggal}}</h4>
                <p>Apakah Anda Yakin Akan Mensubmit pada Hari Ini?</p>
              </div>
              <div class="modal-footer align-item-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                <a href="/detil/{{$sppd->id}}/{{$sppd->status}}" type="button" class="btn btn-primary">Ya</a>
              </div>
            </div>
          </div>
        </div>
    </body>

    <script>
      $('.table-hari').each(function () {
      var hari = parseInt($(this).text());
      if ((hari >= 0) && (hari <= 4)) {
        $(this).css('background-color', 'lightgreen');
      } else if ((hari > 4) && (hari <= 10)) {
        $(this).css('background-color', 'lightgoldenrodyellow');
      } else if (hari > 10) {
        $(this).css('background-color', 'lightpink');
      } else {
        $(this).css('background-color', 'grey');
      }
    });
  </script>
</html>