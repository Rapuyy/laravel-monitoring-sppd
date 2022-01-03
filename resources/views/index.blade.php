@extends('layouts.main')

@section('container')
<div class="container">  
    <!--Tabel-->
    <div class="row tabel-data">
        <div class="col-7 mt-4 table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="table-success"><a href="{{ route('sppd.filter', ['filter' => "green"]) }}">< 4 hari</a></th>
                        <th class="table-warning"><a href="{{ route('sppd.filter', ['filter' => "yellow"]) }}">4 - 10 hari</a></th>
                        <th class="table-danger"><a href="{{ route('sppd.filter', ['filter' => "red"]) }}">Lebih dari 10 hari</a></th>
                        <th><a href="{{ route('sppd.filter', ['filter' => "done"]) }}">Sudah selesai</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td>{{ $status['green'] }} Dokumen</td>
                        <td>{{ $status['yellow'] }} Dokumen</td>
                        <td>{{ $status['red'] }} Dokumen</td>
                        <td>{{ $status['done'] }} Dokumen</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!--Button Opsi-->
    <div class="d-grid gap-2 d-md-block mt-2 mb-2">
        <a href="{{ route("sppd.add") }}" class="btn btn-primary" type="button">Tambah Ajuan SPPD</a>
        {{-- <button class="btn btn-secondary" type="button">Lihat Status Ajuan SPPD</button> --}}
    </div>
    <div class="row">
        <div class="col-6">
            <div id="piechartIPA" style="width: 900px; height: 500px;"></div>
        </div>
        <div class="col-6">
            <div id="piechartPP" style="width: 900px; height: 500px;"></div>
        </div>
    </div>
    {{-- <!--Tabel Data-->
    <div class="tabel-list mt-5 table-responsive">
        <table class="table table-bordered tab align-middle text-center cell-border" id="tablesppd">
            <thead class="text-center">
                <tr>
                    <th>Nomor</th>
                    <th>Nomor SPPD</th>
                    <th>Perihal</th>
                    <th>Pegawai</th>
                    <th>Status Sekarang</th>
                    <th>Dana</th>
                    <th>Sumber Dana</th>
                    <th>Aksi</th>
                </tr>
            </thead> 
            
            <tbody>
            @foreach ($sppd_list as $sppd)  
                <tr>
                    <td>{{ $sppd->id }}</td>
                    <td>{{ $sppd->sppd_no ? $sppd->sppd_no : "SPPD Belum diisi" }}</td>
                    <td>{{ $sppd->sppd_alasan }}</td>
                    <td>{{ $sppd->pegawai }}</td>
                    <td>
                        @if ($sppd->status == "0")
                            {{ __('IPA Belum Dibuat') }}
                        @elseif ($sppd->status == "1")
                            {{ __('IPA Belum Diajukan') }}
                        @elseif ($sppd->status == "2")
                            {{ __('IPA Menunggu Tanda Tangan Approval') }}
                        @elseif ($sppd->status == "3")
                            {{ __('IPA Menunggu Dikirim ke Divisi Finansial') }}
                        @elseif ($sppd->status == "4")
                            {{ __('IPA Menunggu Kembali dari Divisi Finansial') }}    
                        @elseif ($sppd->status == "10")
                            {{ __('IPA Sudah Selesai, PP Belum Dibuat') }}   
                        @elseif ($sppd->status == "11")
                            {{ __('PP Belum Diajukan') }}
                        @elseif ($sppd->status == "12")
                            {{ __('PP Menunggu Tanda Tangan Approval') }}
                        @elseif ($sppd->status == "13")
                            {{ __('PP Menunggu Dikirim ke Divisi Finansial') }}  
                        @elseif ($sppd->status == "14")
                            {{ __('PP Menunggu Kembali dari Divisi Finansial') }}   
                        @elseif ($sppd->status == "15")
                            {{ __('PP Selesai') }}  
                        @endif
                    </td>
                    <td>{{ $sppd->ipa_nilai }}</td>
                    <td>{{ $sppd->sumber_dana }}</td>
                    <td align="center">
                        <a href=" {{ route('sppd.detil', ['id' => $sppd->id]) }}" class="btn btn-info">Detail</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div> --}}
    <div id="entryModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Subscribe our Newsletter</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Subscribe to our mailing list to get the latest updates straight in your inbox.</p>
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email Address">
                        </div>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
<script>
    $(document).ready(function(){
        $("#entryModal").modal('show');
    });
</script>
<script type="text/javascript" src="/js/script.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChartIPA);
    google.charts.setOnLoadCallback(drawChartPP);

    function drawChartIPA() {
        var status = @json($status);

        var data = google.visualization.arrayToDataTable([
        ['Status', 'Jumlah'],
        ['Tepat Waktu', status.greenPP],
        ['Sedikit Telat', 2],
        ['Telat', 2],
        ]);

        var options = {
        title: 'Waktu Proses IPA',
        colors: ['#00ff00', '#ffff00', '#ff0000'],
        pieSliceText: 'value-and-percentage',
        pieSliceTextStyle: {
            color: 'black'
        }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechartIPA'));

        chart.draw(data, options);
    }

    function drawChartPP() {

    var data = google.visualization.arrayToDataTable([
        ['Status', 'Jumlah'],
        ['Tepat Waktu',     11],
        ['Sedikit Telat',      2],
        ['Telat',  2],
    ]);

    var options = {
        title: 'Waktu Proses PP',
        colors: ['#00ff00', '#ffff00', '#ff0000'],
        pieSliceText: 'value-and-percentage',
        pieSliceTextStyle: {
            color: 'black'
        }
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechartPP'));

    chart.draw(data, options);
    }
    </script>
@endsection

@endsection