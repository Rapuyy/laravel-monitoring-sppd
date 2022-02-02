@extends('layouts.main')

@section('container')
        <!--Content-->
        <div class="container mt-3">
            <h2>Detail Izin Penggunaan Anggaran</h2>
            <div class="row mt-2">
                <h4 class=" border-bottom">Izin Penggunaan Anggaran (IPA)</h4> 
                <span><p class="text-muted">Kosongkan Bila Belum Memiliki IPA</p>
                  @if($ipa->ipa_status == "0")
                  <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">IPA dibuat</a></span>
                  @elseif($ipa->ipa_status == "1")
                  <a href="/" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">IPA diajukan</a></span>
                  @elseif($ipa->ipa_status == "2")
                  <a href="/" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">IPA disetujui</a></span>
                  @elseif($ipa->ipa_status == "3")
                  <a href="/" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">IPA masuk Finance</a></span>
                  @elseif($ipa->ipa_status == "4")
                  <a href="/" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">IPA Selesai</a></span>
                  @else
                  <button class="btn btn-secondary" disabled>IPA Selesai</button></span>
                  @endif
                <div class="col-sm-4 mt-2">
                    <div class="mb-3">
                        <label for="nomorIPA" class="form-label">Nomor IPA</label>
                        <input type="text" name="ipa_no" class="form-control" id="nomorIPA" value="{{ $ipa->ipa_no }}">
                        @if (!$ipa->ipa_no)
                          <select name="ipa_no" id="ipa">
                            <option value="0" selected>IPA</option>
                            @foreach ($ipa_list as $ipa)
                              <option value="{{ $ipa->ipa_no }}">{{ $ipa->ipa_no }}</option>
                            @endforeach
                          </select>
                        @endif
                      </div>
                        <div class="mb-3">
                           <label for="approveIPA" class="form-label">Tanggal IPA disetujui</label>
                           <input type="date" name="ipa_tgl_approval" class="form-control" id="approveIPA" value="{{ $ipa->ipa_tgl_approval }}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="nilaiIPA" class="form-label">Nilai IPA</label>
                          <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input type="text" name="ipa_nilai" class="form-control  @error('nilaiIPA') is-invalid @enderror" id="nilaiIPA" value="{{ $ipa->ipa_nilai }}" readonly>
                          </div>
                          @error('nilaiIPA')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                </div>
                <div class="col-sm-4 mt-2">
                      <div class="mb-3">
                            <label for="buatIPA" class="form-label">Tanggal IPA dibuat</label>
                            <input type="date" name="ipa_tgl_dibuat" class="form-control" id="dateIPA" value="{{ $ipa->ipa_tgl_dibuat }}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="financeIPA" class="form-label">Tanggal IPA masuk ke Finance</label>
                          <input type="date" name="ipa_tgl_msk_finance" class="form-control" id="financeIPA" value="{{ $ipa->ipa_tgl_msk_finance }}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="sumberDana" class="form-label">Sumber Dana</label>
                          <input type="text" name="sumber_dana" class="form-control  @error('sumberDana') is-invalid @enderror" id="sumberDana" value="{{ $ipa->sumber_dana }}" readonly>
                          @error('sumberDana')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                       </div>
                </div>
                <div class="col-sm-4 mt-2">
                      <div class="mb-3">
                        <label for="ajukanIPA" class="form-label">Tanggal IPA diajukan</label>
                        <input type="date" name="ipa_tgl_diajukan" class="form-control" id="ajukanIPA" value="{{ $ipa->ipa_tgl_diajukan }}" readonly>
                      </div>
                        <div class="mb-3">
                            <label for="selesaiIPA" class="form-label">Tanggal IPA Selesai</label>
                            <input type="date" name="ipa_tgl_selesai" class="form-control" id="selesaiIPA" value="{{ $ipa->ipa_tgl_selesai }}" readonly>
                        </div>
                </div>
            </div>
</div>
<div class="container">
        <h3>Status IPA</h3>
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
            @if ($ipa->ipa_status == "10")
              <td class="table-hari-pp">{{ $progres->ipa_selesai }} hari</td>
            @else
              <td class="table-hari-pp">{{ $progres->ipa }} hari</td>
            @endif
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
                <a href="/ipa/detail/{{$ipa->id}}/{{$ipa->ipa_status}}" type="button" class="btn btn-primary">Ya</a>
              </div>
            </div>
          </div>
        </div>
@endsection