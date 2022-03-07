@extends('dashboard.layout.main')

@section('container')
        <!--Content-->

        <div class="container mt-3">
            <h2>Detail Permohonan Pembayaran</h2>

            <div class="row mt-2">
                <h4 class=" border-bottom">Permohonan Pembayaran (PP)</h4> 
                <span><p class="text-muted">Kosongkan Bila Belum Memiliki PP</p>
                  @if($pp->pp_status == "10")
                  <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">PP dibuat</a></span>
                  @elseif($pp->pp_status == "11")
                  <a href="/" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">PP diajukan</a></span>
                  @elseif($pp->pp_status == "12")
                  <a href="/" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">PP disetujui</a></span>
                  @elseif($pp->pp_status == "13")
                  <a href="/" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">PP masuk Finance</a></span>
                  @elseif($pp->pp_status == "14")
                  <a class="btn btn-secondary" disabled>PP Telah dikirim ke Finance</a></span>
                  {{-- @else
                  <button class="btn btn-secondary" disabled>PP Selesai dari Finance</button></span> --}}
                  @endif
                <div class="col-sm-4 mt-2">
                  <div class="mb-3">
                    <label for="nomorpp" class="form-label">Nomor PP</label>
                    <input type="text" name="pp_no" class="form-control" id="nomorpp" value="{{ $pp->pp_no }}">
                    @if (!$pp->pp_no)
                      <select name="pp_no" id="pp">
                        <option value="0" selected>PP</option>
                        @foreach ($pp_list as $pp)
                          <option value="{{ $pp->pp_no }}">{{ $pp->pp_no }}</option>
                        @endforeach
                      </select>
                    @endif
                  </div>
                    <div class="mb-3">
                      <label for="approvepp" class="form-label">Tanggal PP disetujui</label>
                      <input type="date" name="pp_tgl_approval" class="form-control" id="approvepp" value="{{ $pp->pp_tgl_approval }}" readonly>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="selesaipp" class="form-label">Tanggal PP Selesai dari Finance</label>
                        <input type="date" name="pp_tgl_selesai" class="form-control" id="selesaipp" value="{{ $pp->pp_tgl_selesai }}" readonly>
                    </div> --}}
                </div>
                <div class="col-sm-4 mt-2">
                      <div class="mb-3">
                        <label for="buatpp" class="form-label">Tanggal PP dibuat</label>
                        <input type="date" name="pp_tgl_dibuat" class="form-control" id="datepp" value="{{ $pp->pp_tgl_dibuat }}" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="financepp" class="form-label">Tanggal PP masuk ke Finance</label>
                        <input type="date" name="pp_tgl_msk_finance" class="form-control" id="financepp" value="{{ $pp->pp_tgl_msk_finance }}" readonly>
                      </div>
                        <div class="mb-3">
                      </div>
                </div>
                <div class="col-sm-4 mt-2">
                  <div class="mb-3">
                    <label for="ajukanpp" class="form-label">Tanggal PP diajukan</label>
                    <input type="date" name="pp_tgl_diajukan" class="form-control" id="ajukanpp" value="{{ $pp->pp_tgl_diajukan }}" readonly>
                  </div>
                  <div class="mb-3">
                  </div>
                </div>
            </div>
        </div>
        <div class="container">
                <h3>Status PP</h3>
                <table class="table table-bordered ket-status text-center table-pp">
                  <tr>
                    <td colspan="5">PP</td>
                  </tr>
                  <tr>
                    <td class="table-status-pp">Diajukan</td>
                    <td class="table-status-pp">Disetujui</td>
                    <td class="table-status-pp">Pengajuan ke Finance</td>
                    {{-- <td class="table-status-pp">Selesai</td> --}}
                    <td>Total</td>
                  </tr>
                  <tr>
                    <td class="table-hari-pp">{{ $progres->pp_1 }} hari</td>
                    <td class="table-hari-pp">{{ $progres->pp_2 }} hari</td>
                    <td class="table-hari-pp">{{ $progres->pp_3 }} hari</td>
                    {{-- <td class="table-hari-pp">{{ $progres->pp_4 }} hari</td> --}}
                    @if ($pp->pp_status == "14")
                      <td class="table-hari-pp">{{ $progres->pp_selesai }} hari</td>
                    @else
                      <td class="table-hari-pp">{{ $progres->pp }} hari</td>
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
                <a href="/pp/detail/{{$pp->id}}/{{$pp->pp_status}}" type="button" class="btn btn-primary">Ya</a>
              </div>
            </div>
          </div>
        </div>

@endsection