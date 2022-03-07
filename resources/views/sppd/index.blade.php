@extends('dashboard.layout.main')

@section('container')
<div class="container">  

    <!--Button Opsi-->
    <div class="d-grid gap-2 d-md-block mt-3 mb-2">
        <a href="{{ route("sppd.add") }}" class="btn btn-primary" type="button">Tambah Ajuan SPPD</a>
        {{-- <button class="btn btn-secondary" type="button">Lihat Status Ajuan SPPD</button> --}}
    </div>

    <h3 class="mt-3 text-center fw-bold">Data Surat Permohonan Melakukan Perjalanan Dinas</h3>
    <!--Tabel Data-->
    <div class="tabel-list mt-3 table-responsive mb-5">
        <table class="table table-bordered tab align-middle text-center cell-border mb-2" id="tablesppd">
            <thead class="text-center">
                <tr>
                    <th>Nomor</th>
                    <th>Nomor SPMPD</th>
                    <th>Tanggal Masuk</th>
                    <th>Unit</th>
                    <th>Tujuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead> 
            
            <tbody>
            @foreach ($sppd_list as $sppd)  
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sppd->sppd_no ? $sppd->sppd_no : "SPPD Belum diisi" }}</td>
                    <td>{{ $sppd->sppd_tgl_msk }}</td>
                    <td>{{ $sppd->unit_kerja }}</td>
                    <td>{{ $sppd->sppd_tujuan }}</td>
                    <td>
                        @if ($sppd->status == "0")
                            {{ __('IPA Belum Dibuat') }}
                        @elseif ($sppd->status == "1")
                            {{ __('IPA Belum Diajukan') }}
                        @elseif ($sppd->status == "2")
                            {{ __('IPA Menunggu Tanda Tangan Approval') }}
                        @elseif ($sppd->status == "3")
                            {{ __('IPA Menunggu Dikirim ke Unit Finance') }}
                        @elseif ($sppd->status == "4")
                            {{ __('IPA Menunggu Kembali dari Unit Finance') }}    
                        @elseif ($sppd->status == "10")
                            {{ __('IPA Sudah Selesai, PP Belum Dibuat') }}   
                        @elseif ($sppd->status == "11")
                            {{ __('PP Belum Diajukan') }}
                        @elseif ($sppd->status == "12")
                            {{ __('PP Menunggu Tanda Tangan Approval') }}
                        @elseif ($sppd->status == "13")
                            {{ __('PP Menunggu Dikirim ke Unit Finance') }}  
                        @elseif ($sppd->status == "14" || $sppd->status == "15")
                            {{ __('PP Sudah Dikirim ke Unit Finance') }}   
                        {{-- @elseif ($sppd->status == "15")
                            {{ __('PP Selesai dari Finance') }}   --}}
                        @endif
                    </td>
                    <td class="btn-group">
                        <a id="detail" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" 
                        data-id="<?=$sppd->id?>"
                        data-sppd_no="<?=$sppd->sppd_no?>"
                        data-sppd_tgl_msk="<?=$sppd->sppd_tgl_msk?>"
                        data-pegawai="<?=$sppd->pegawai?>"
                        data-unit_kerja="<?=$sppd->unit_kerja?>"
                        data-sppd_tujuan="<?=$sppd->sppd_tujuan?>"
                        data-sppd_alasan="<?=$sppd->sppd_alasan?>"
                        data-sppd_kendaraan="<?=$sppd->sppd_kendaraan?>"
                        data-ipa_no = "<?=$sppd->ipa_no?>">Detail</a>
                        <a href=" {{ route('sppd.detil', ['id' => $sppd->id]) }}" class="btn btn-info ms-2 btn-sm">Perbarui</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <div class="text-center">
            <h5 class="modal-title fw-bold" id="exampleModalLabel">Detail SPPD</h5>
        </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="exampleModalBody">
            <table class="table table-borderless">
                <tr>
                    <td class="fw-bold">Nomor SPMPD : </td>
                    <td id="sppd_no">{{ $sppd->sppd_no}}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Tanggal Masuk SPPD : </td>
                    <td id="sppd_tgl_msk">{{ $sppd->sppd_tgl_msk}}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Nama Pegawai : </td>
                    <td id="pegawai">{{ $sppd->pegawai}}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Unit Kerja : </td>
                    <td id="unit_kerja">{{ $sppd->unit_kerja}}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Tujuan Perjalanan : </td>
                    <td id="sppd_tujuan">{{ $sppd->sppd_tujuan}}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Maksud Perjalanan : </td>
                    <td id="sppd_alasan">{{ $sppd->sppd_alasan}}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Kendaraan : </td>
                    <td id="sppd_kendaraan">{{ $sppd->sppd_kendaraan}}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Nomor IPA : </td>
                    <td id="ipa_no">{{ $sppd->ipa_no}}</td>
                </tr>
            </table>
        </div>
        <div class="modal-footer text-center">
                <button type="button" class="btn btn-outline-dark align-items-center" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
        </div>
        </div>
    </div>
    </div>
</div>
@endsection
@section('script')
{{--  <!-- <script>
   $(document).on('click', '#exampleModal', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-bs-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#exampleModal').modal("show");
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        }); 
</script> -->  --}}
<script type="text/javascript" src="/js/script.js"></script>
<script>
$(document).ready(function(){
    $(document).on('click', '#detail', function(){
        var id = $(this).data('id');
        var nosppd = $(this).data('sppd_no');
        var tglmasuk = $(this).data('sppd_tgl_msk');
        var pegawai = $(this).data('pegawai');
        var tujuan = $(this).data('sppd_tujuan');
        var unit = $(this).data('unit_kerja');
        var alasan = $(this).data('sppd_alasan');
        var kendaraan = $(this).data('sppd_kendaraan');
        var ipa = $(this).data('ipa_no');
        $('#id').text(id);
        $('#sppd_no').text(nosppd);
        $('#sppd_tgl_msk').text(tglmasuk);
        $('#pegawai').text(pegawai);
        $('#sppd_tujuan').text(tujuan);
        $('#unit_kerja').text(unit);
        $('#sppd_alasan').text(alasan);
        $('#sppd_kendaraan').text(kendaraan);
        $('#ipa_no').text(ipa);
    })
})
</script>

@endsection