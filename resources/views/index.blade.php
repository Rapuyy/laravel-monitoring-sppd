@extends('layouts.main')

@section('container')
<div class="container">  
    <!--Tabel-->
    <div class="row tabel-data">
        <div class="col-7 mt-4 table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="table-success"><a href="{{ route('sppd.filter', ['filter' => "green"]) }}">< 3 hari</a></th>
                        <th class="table-warning"><a href="{{ route('sppd.filter', ['filter' => "yellow"]) }}">3 - 10 hari</a></th>
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
</div>
@section('script')
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
        ['Tepat Waktu', status.greenIPA],
        ['Sedikit Telat', status.yellowIPA],
        ['Telat', status.redIPA],
        ]);

        var options = {
        title: 'Waktu Proses IPA', 'width':500, 'height':500,
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
        var status = @json($status);
        var data = google.visualization.arrayToDataTable([
            ['Status', 'Jumlah'],
            ['Tepat Waktu', status.greenPP],
            ['Sedikit Telat', status.yellowPP],
            ['Telat', status.redPP],
        ]);

        var options = {
            title: 'Waktu Proses PP', 'width':500, 'height':500,
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