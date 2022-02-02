@extends('layouts.main')

@section('container')
<div class="container">
    <h2 class="mt-3 text-center fw-bold">Data Izin Penggunaan Anggaran</h2>
    <!--Tabel Data-->
    <div class="tabel-list mt-3 table-responsive">
        <table class="table table-bordered tab align-middle text-center cell-border" id="tableipa">
            <thead class="text-center">
                <tr>
                    <th>Nomor</th>
                    <th>Nomor IPA</th>
                    <th>Tanggal Dibuat</th>
                    <th>Status</th>
                    <th>Dana</th>
                    <th>Sumber Dana</th>
                    <th>Aksi</th>
                </tr>
            </thead> 
            
            <tbody>
            @foreach ($ipa_list as $ipa)  
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ipa->ipa_no ? $ipa->ipa_no : "ipa Belum diisi" }}</td>
                    <td>{{ $ipa->ipa_tgl_dibuat }}</td>
                    <td>
                        @if ($ipa->status == "0")
                            {{ __('IPA Belum Dibuat') }}
                        @elseif ($ipa->status == "1")
                            {{ __('IPA Belum Diajukan') }}
                        @elseif ($ipa->status == "2")
                            {{ __('IPA Menunggu Tanda Tangan Approval') }}
                        @elseif ($ipa->status == "3")
                            {{ __('IPA Menunggu Dikirim ke Unit Finance') }}
                        @elseif ($ipa->status == "4")
                            {{ __('IPA Menunggu Kembali dari Unit Finance') }}    
                        @elseif ($ipa->status == "10")
                            {{ __('IPA Sudah Selesai, PP Belum Dibuat') }}   
                        @elseif ($ipa->status == "11")
                            {{ __('PP Belum Diajukan') }}
                        @elseif ($ipa->status == "12")
                            {{ __('PP Menunggu Tanda Tangan Approval') }}
                        @elseif ($ipa->status == "13")
                            {{ __('PP Menunggu Dikirim ke Unit Finance') }}  
                        @elseif ($ipa->status == "14")
                            {{ __('PP Menunggu Kembali dari Unit Finance') }}   
                        @elseif ($ipa->status == "15")
                            {{ __('PP Selesai dari Finance') }}  
                        @endif
                    </td>
                    <td>{{ $ipa->ipa_nilai }}</td>
                    <td>{{ $ipa->sumber_dana }}</td>
                    <td align="center">
                        <a href=" {{ route('ipa.detail', ['id' => $ipa->id]) }}" class="btn btn-info">Detail</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="entryModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
                <div class="text-center">
                    <h5 class="modal-title fw-bold ">TENGGAT WAKTU</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Beberapa IPA sudah hampir melewati tenggat waktu, ingatkan pihak terkait agar dapat menyelesaikan tepat waktu.</p>
                <table class="table table-borderless table-condensed table-hover">
                    @foreach ($ipa_list as $ipa)
                        @if ($ipa->ipa > 3 && $ipa->status < 10)
                        {{-- @if ($ipa->diff > 3 && $ipa->status < 10) --}}
                        <tr class="align-middle text-center">
                            <td class="warningipa" id="warningipa">{{ $ipa->ipa_no }}</td>
                            <td class="dayipa">{{ $ipa->ipa }} hari</td>
                            <td>
                            @if ($ipa->status == "1")
                                {{ __('IPA Belum Diajukan') }}
                            @elseif ($ipa->status == "2")
                                {{ __('IPA Menunggu Tanda Tangan Approval') }}
                            @elseif ($ipa->status == "3")
                                {{ __('IPA Menunggu Dikirim ke Unit Finance') }}
                            @elseif ($ipa->status == "4")
                                {{ __('IPA Menunggu Kembali dari Unit Finance') }}    
                            @elseif ($ipa->status == "10")
                                {{ __('IPA Sudah Selesai, PP Belum Dibuat') }}  
                            @endif
                            </td>
                            <td>
                                <a href="{{ route('ipa.detail', ['id' => $ipa->id]) }}" class="btn btn-primary">Perbarui</a>
                            </td>
                        </tr>                        
                        @endif
                    @endforeach
                </table>
                <div class="text-center">
                    <button type="button" class="mt-3 btn btn-outline-dark align-items-center" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="/js/script.js"></script>
<script>
    $(document).ready(function(){
        $("#entryModal").modal('show');
    });
</script>

{{--  <!-- <script>
  $('.dayipa').each(function () {
    var hari = parseInt($(this).text());
    var el = $(this).siblings('.warningipa');
    setInterval(function () {
      if (hari < 18) {
        el.toggleClass('bg-green');
      }
      else {
        el.toggleClass('bg-red');
      }
    }, 100)
  });
</script> -->  --}}
<script>
$(".dayipa").each(function () {
    var hari = parseInt($(this).text());
    var el = $(this).siblings('.warningipa');
    setInterval(function () {
      if (hari < 4) {
        var color = el.css('background-color');
        el.css('background-color', color == 'rgb(144, 238, 144)' ? 'white' : 'lightgreen');
      }
      else if((hari>3) && (hari<6)){
        var color = el.css('background-color');
        el.css('background-color', color == 'rgb(255, 165, 0)' ? 'white' : 'orange');
      }
      else if(hari > 5){
        var color = el.css('background-color');
        el.css('background-color', color == 'rgb(255, 0, 0)' ? 'white' : 'red');
      }
      else {
        var color = el.css('background-color');
        el.css('background-color', color == 'rgb(255, 255, 255)' ? 'white' : 'white');
      }
    }, 500)
  });
</script>
@endsection
