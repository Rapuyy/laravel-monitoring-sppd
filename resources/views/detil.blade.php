@extends('layouts.main')

@section('container')
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
                        <label for="masukSPPD" class="form-label">Tanggal Masuk SPPD</label>
                        <span>*</span>
                        <input type="date" name="sppd_tgl_msk" class="form-control @error('nomorSPPD') is-invalid @enderror" id="masukSPPD" required readonly value="{{ $sppd->sppd_tgl_msk }}">
                        @error('masukSPPD')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="unitKerja" class="form-label">Unit Kerja</label>
                        <span>*</span>
                        <input type="text" name="unit_kerja" class="form-control  @error('unitKerja') is-invalid @enderror" id="unitKerja" required readonly value="{{ $sppd->unit_kerja }}">
                        @error('unitKerja')
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
                        <div class="mb-3">
                              <p>Lama waktu perjalanan : <b>{{ $progres->lama_perjalanan }}</b> hari </p>
                        </div>
                </div>
                <div class="col-sm-8 mt-2">
                      <div class="mb-3">
                        <label for="sppd_no" class="form-label">Nomor SPPD</label>
                        <span>*</span>
                        <input type="text" name="sppd_no" class="form-control @error('sppd_no') is-invalid @enderror" id="sppd_no" required readonly value="{{ $sppd->sppd_no }}">
                        @error('sppd_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                          <label for="pegawai" class="form-label">Nama Pegawai</label>
                          <span>*</span>
                          <input type="text" name="pegawai[]" class="form-control  @error('pegawai') is-invalid @enderror" id="pegawai" required readonly value="{{ $sppd->pegawai }}">
                          @error('pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                      <label for="operatorPengisi" class="form-label">Nama Operator Pengisi</label>
                            <span>*</span>
                            <select aria-label="Default select example" name="op_pengisi" class="form-select  @error('operatorPengisi') is-invalid @enderror" id="operatorPengisi" required disabled>
                              <option selected>{{ $sppd->op_pengisi }}</option>
                              <option value="1">Ady</option>
                              <option value="2">Rika</option>
                            </select>
                            @error('operatorPengisi')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="mb-3">
                        <label for="ajukanIPA" class="form-label">Tanggal IPA diajukan</label>
                        <input type="date" name="ipa_tgl_diajukan" class="form-control" id="ajukanIPA" value="{{ $sppd->ipa_tgl_diajukan }}" readonly>
                      </div>
                      <div class="mb-3">
                         <label for="selesaiIPA" class="form-label">Tanggal IPA Selesai</label>
                         <input type="date" name="ipa_tgl_selesai" class="form-control" id="selesaiIPA" value="{{ $sppd->ipa_tgl_selesai }}" readonly>
                      </div>
                </div>
                <div class="col-sm-4 mt-2">
                      <div class="mb-3">
                        <label for="nomorIPA" class="form-label">Nomor IPA</label>
                        <input type="text" name="ipa_no" class="form-control" id="nomorIPA" value="{{ $sppd->ipa_no }}">
                        <select name="ipa_no" id="ipa">
                          <option value="0" selected>IPA</option>
                          @foreach ($ipa_list as $ipa)
                            <option value="{{ $ipa->ipa_no }}">{{ $ipa->ipa_no }}</option>
                          @endforeach
                        </select>
                      </div>
                        <div class="mb-3">
                           <label for="approveIPA" class="form-label">Tanggal IPA disetujui</label>
                           <input type="date" name="ipa_tgl_approval" class="form-control" id="approveIPA" value="{{ $sppd->ipa_tgl_approval }}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="nilaiIPA" class="form-label">Nilai IPA</label>
                          <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input type="text" name="ipa_nilai" class="form-control  @error('nilaiIPA') is-invalid @enderror" id="nilaiIPA" value="{{ $sppd->ipa_nilai }}">
                          </div>
                          @error('nilaiIPA')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                </div>
                <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                            <label for="buatIPA" class="form-label">Tanggal IPA dibuat</label>
                            <input type="date" name="ipa_tgl_dibuat" class="form-control" id="dateIPA" value="{{ $sppd->ipa_tgl_dibuat }}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="financeIPA" class="form-label">Tanggal IPA masuk ke Finance</label>
                          <input type="date" name="ipa_tgl_msk_finance" class="form-control" id="financeIPA" value="{{ $sppd->ipa_tgl_msk_finance }}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="sumberDana" class="form-label">Sumber Dana</label>
                          <input type="text" name="sumber_dana" class="form-control  @error('sumberDana') is-invalid @enderror" id="sumberDana" value="{{ $sppd->sumber_dana }}">
                          @error('sumberDana')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
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
                          <select name="pp_no" id="pp">
                            <option value="0" selected>PP</option>
                            @foreach ($pp_list as $pp)
                              <option value="{{ $pp->pp_no }}">{{ $pp->pp_no }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="approvePP" class="form-label">Tanggal PP disetujui</label>
                          <input type="date" name="pp_tgl_approval" class="form-control" id="approvePP" value="{{ $sppd->pp_tgl_approval }}" readonly>
                        </div>
                </div>
                <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                           <label for="buatPP" class="form-label">Tanggal PP dibuat</label>
                           <input type="date" name="pp_tgl_dibuat" class="form-control" id="buatPP" value="{{ $sppd->pp_tgl_dibuat }}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="financePP" class="form-label">Tanggal PP masuk ke Finance</label>
                          <input type="date" name="pp_tgl_msk_finance" class="form-control" id="financePP" value="{{ $sppd->pp_tgl_msk_finance }}" readonly>
                        </div>
                </div>
                <div class="col-sm-4 mt-2">
                        <div class="mb-3">
                          <label for="ajukanPP" class="form-label">Tanggal PP diajukan</label>
                          <input type="date" name="pp_tgl_diajukan" class="form-control" id="ajukanPP" value="{{ $sppd->pp_tgl_diajukan }}" readonly>
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
        <table class="table table-bordered ket-status text-center table-ipa">
          <tr>
            <td colspan="5">IPA</td>
          </tr>
          <tr>
            <td class="table-status-ipa">Diajukan</td>
            <td class="table-status-ipa">Disetujui</td>
            <td class="table-status-ipa">Di Finance</td>
            <td class="table-status-ipa">Selesai</td>
            <td>Total</td>
          </tr>
          <tr>
            <td class="table-hari-ipa">{{ $progres->ipa_1 }} hari</td>
            <td class="table-hari-ipa">{{ $progres->ipa_2 }} hari</td>
            <td class="table-hari-ipa">{{ $progres->ipa_3 }} hari</td>
            <td class="table-hari-ipa">{{ $progres->ipa_4 }} hari</td>
            <td class="table-hari-ipa">{{ $progres->ipa }} hari</td>
          </tr>
        </table>
        <table class="table table-bordered ket-status text-center table-pp">
          <tr>
            <td colspan="6">PP</td>
          </tr>
          <tr>
            <td class="table-status-pp">Dibuat</td>
            <td class="table-status-pp">Diajukan</td>
            <td class="table-status-pp">Disetujui</td>
            <td class="table-status-pp">Di Finance</td>
            <td class="table-status-pp">Selesai</td>
            <td>Total</td>
          </tr>
          <tr>
            <td class="table-hari-pp">{{ $progres->ipa_pp }} hari</td>
            <td class="table-hari-pp">{{ $progres->pp_1 }} hari</td>
            <td class="table-hari-pp">{{ $progres->pp_2 }} hari</td>
            <td class="table-hari-pp">{{ $progres->pp_3 }} hari</td>
            <td class="table-hari-pp">{{ $progres->pp_4 }} hari</td>
            <td class="table-hari-pp">{{ $progres->pp }} hari</td>
          </tr>
      </table>
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

        @section('script')
        <script type="text/javascript" src="/js/script.js"></script>
        @endsection
        
@endsection