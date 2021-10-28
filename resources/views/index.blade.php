<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Web Monitoring SPPD</title>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <body>
        <!-- Navigation Bar-->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
              <a class="navbar-brand ms-2" href="#" style="color: aliceblue;">Web Monitoring SPPD</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <div class="container">
                
                <!--Tabel-->
                <div class="row tabel-data">
                    <div class="col-7 mt-4 table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th class="table-danger">Lebih dari 10 hari</th>
                                    <th class="table-warning">4 - 10 hari</th>
                                    <th class="table-success">< 4 hari</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>x dokumen</td>
                                    <td>x dokumen</td>
                                    <td>x dokumen</td>
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

                <!--Tabel Data-->
                <div class="tabel-list mt-4 table-responsive">
                    <table id="table-sppd" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>Nomor</th>
                                <th>Nomor SPPD <br> Nomor IPA <br> Nomor PP</th>
                                <th>Perihal</th>
                                <th>Status Sekarang</th>
                                <th>Keterangan Status</th>
                                <th>Jumlah Hari dari Ajuan Dimulai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @foreach ($sppd_list as $sppd)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $sppd->sppd_no ? $sppd->sppd_no : "SPPD Belum diisi" }} <br><hr>
                                    {{ $sppd->ipa_no ? $sppd->ipa_no : "IPA Belum diisi" }} <br><hr>
                                    {{ $sppd->pp_no ? $sppd->pp_no : "PP Belum diisi" }}
                                </td>
                                <td>{{ $sppd->sppd_alasan }}</td>
                                <td>
                                    @if ($sppd->status == "0")
                                        {{ __('IPA Belum dibuat') }}
                                    @elseif ($sppd->status == "1")
                                        {{ __('IPA Sudah dibuat') }}
                                    @elseif ($sppd->status == "2")
                                        {{ __('IPA Sudah diapprove') }}
                                    @elseif ($sppd->status == "3")
                                        {{ __('IPA Sudah selesai') }}    
                                    @elseif ($sppd->status == "10")
                                        {{ __('PP Belum dibuat') }}   
                                    @elseif ($sppd->status == "11")
                                        {{ __('PP Sudah dibuat') }}
                                    @elseif ($sppd->status == "12")
                                        {{ __('PP Sudah diapprove') }}
                                    @elseif ($sppd->status == "13")
                                        {{ __('PP Sudah selesai') }}     
                                    @endif
                                </td>
                                <td>
                                    <table class="table table-borderless">
                                        <tr><td class="table-status-1">IPA dibuat</td></tr>
                                        <tr><td>IPA selesai</td></tr>
                                        <tr><td class="table-status-2">PP dibuat</td></tr>
                                        <tr><td>PP selesai</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-borderless">
                                        <tr><td class="table-hari-1">5</td></tr>
                                        <tr><td class="table-hari-2">11</td></tr>
                                    </table>
                                </td>
                                <td align="center"><a href=" {{ route('sppd.edit', ['id' => $sppd->id]) }}" class="badge bg-info">Perbarui Status</a></td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
        </div>

        <!--Footer-->
        <div class="footer footer-index">
            <p class="text-center">©2021 PT Jasamarga Tollroad Maintenance</p>
        </div>   
    </body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        $('.table-hari-1').each(function(i, n) {
            if($(n).text() < 5) $('.table-status-1').css('background-color', 'lightgreen');
            if(4 < $(n).text() && $(n).text() < 10) $('.table-status-1').css('background-color', 'lightgoldenrodyellow');
            if($(n).text() > 9) $('.table-status-1').css('background-color', 'lightred');
         });
         $('.table-hari-2').each(function(i, n) {
            if($(n).text() < 5) $('.table-status-2').css('background-color', 'lightgreen');
            if(4 < $(n).text() && $(n).text() < 10) $('.table-status-2').css('background-color', 'lightyellow');
            if($(n).text() > 9) $('.table-status-2').css('background-color', 'lightpink');
         });
    </script>
</html>