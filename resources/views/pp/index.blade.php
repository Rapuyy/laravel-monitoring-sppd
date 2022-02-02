@extends('layouts.main')

@section('container')
<div class="container">
    <h2 class="mt-3 text-center fw-bold">Data Izin Permohonan Pembayaran</h2>  
    <!--Tabel Data-->
    <div class="tabel-list mt-3 table-responsive">
        <table class="table table-bordered tab align-middle text-center cell-border" id="tablesppd">
            <thead class="text-center">
                <tr>
                    <th>Nomor</th>
                    <th>Nomor PP</th>
                    <th>Tanggal Dibuat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead> 
            
            <tbody>
            @foreach ($pp_list as $pp)  
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pp->pp_no ? $pp->pp_no : "pp Belum diisi" }}</td>
                    <td>{{ $pp->pp_tgl_dibuat }}</td>
                    <td>
                        @if ($pp->status == "0")
                            {{ __('IPA Belum Dibuat') }}
                        @elseif ($pp->status == "1")
                            {{ __('IPA Belum Diajukan') }}
                        @elseif ($pp->status == "2")
                            {{ __('IPA Menunggu Tanda Tangan Approval') }}
                        @elseif ($pp->status == "3")
                            {{ __('IPA Menunggu Dikirim ke Unit Finance') }}
                        @elseif ($pp->status == "4")
                            {{ __('IPA Menunggu Kembali dari Unit Finance') }}    
                        @elseif ($pp->status == "10")
                            {{ __('IPA Sudah Selesai, PP Belum Dibuat') }}   
                        @elseif ($pp->status == "11")
                            {{ __('PP Belum Diajukan') }}
                        @elseif ($pp->status == "12")
                            {{ __('PP Menunggu Tanda Tangan Approval') }}
                        @elseif ($pp->status == "13")
                            {{ __('PP Menunggu Dikirim ke Unit Finance') }}  
                        @elseif ($pp->status == "14")
                            {{ __('PP Menunggu Kembali dari Unit Finance') }}   
                        @elseif ($pp->status == "15")
                            {{ __('PP Selesai') }}  
                        @endif
                    </td>
                    <td align="center">
                        <a href=" {{ route('pp.detail', ['id' => $pp->id]) }}" class="btn btn-info">Detail</a>
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
                <p>Beberapa PP sudah hampir melewati tenggat waktu, ingatkan pihak terkait agar dapat menyelesaikan tepat waktu.</p>
                <table class="table table-borderless table-condensed table-hover">
                    @foreach ($pp_list as $pp)
                        @if ($pp->diff > 3 && $pp->status < 15)
                        {{-- @if ($pp->diff > 3 && $pp->status < 10) --}}
                        <tr class="align-middle text-center">
                            <td class="warningpp" id="warningpp">{{ $pp->pp_no }}</td>
                            <td class="daypp">{{ $pp->diff }} hari</td>
                            <td>
                            @if ($pp->status == "11")
                                {{ __('PP Belum Diajukan') }}
                            @elseif ($pp->status == "12")
                                {{ __('PP Menunggu Tanda Tangan Approval') }}
                            @elseif ($pp->status == "13")
                                {{ __('PP Menunggu Dikirim ke Unit Finance') }}  
                            @elseif ($pp->status == "14")
                                {{ __('PP Menunggu Kembali dari Unit Finance') }}   
                            @elseif ($pp->status == "15")
                                {{ __('PP Selesai') }}  
                            @endif
                            </td>
                            <td>
                                <a href="{{ route('pp.detail', ['id' => $pp->id]) }}" class="btn btn-primary">Perbarui</a>
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
<script>
$(".daypp").each(function () {
    var hari = parseInt($(this).text());
    var el = $(this).siblings('.warningpp');
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