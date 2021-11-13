<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Web Monitoring SPPD</title>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
            <div class="navbar-nav ml-auto" >
                <a class="btn btn-primary" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>\
        </nav>

        <div class="container">
            
            <!--Tabel-->
            <div class="row tabel-data">
                <div class="col-7 mt-4 table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="table-success"><a href="{{ route('sppd.filter', ['filter' => "green"]) }}">< 4 hari</a></th>
                                <th class="table-warning">4 - 10 hari</th>
                                <th class="table-danger">Lebih dari 10 hari</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>{{ $day_status->green1 + $day_status->green2 }} proses</td>
                                <td>{{ $day_status->yellow1 + $day_status->yellow2 }} proses</td>
                                <td>{{ $day_status->red1 + $day_status->red2 }} proses</td>
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
            <div class="tabel-list mt-5 table-responsive">
                <table class="table table-bordered tab align-middle text-center cell-border" id="tablesppd">
                    <thead class="text-center">
                        <tr>
                            <th>Nomor</th>
                            <th>Nomor SPPD</th>
                            <th>PerihalPegawai</th>
                            <th>Pegawai</th>
                            <th>Status Sekarang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    @foreach ($sppd_list as $sppd)  
                        <tr>
                            <td>{{ $loop->iteration }}</td>
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
                            <td align="center">
                                <a href=" {{ route('sppd.detil', ['id' => $sppd->id]) }}" class="btn btn-info">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <!--Footer-->
        <div class="footer mt-5">
            <p class="text-center">©2021 PT Jasamarga Tollroad Maintenance</p>
        </div>   
    </body>


    <script>
            $('.table-hari').each(function () {
            var hari = parseInt($(this).text());
            if ((hari >= 0) && (hari <= 4)) {
              $(this).siblings().css('background-color', 'lightgreen');
            } else if ((hari > 4) && (hari <= 10)) {
              $(this).siblings().css('background-color', 'lightgoldenrodyellow');
            } else if (hari > 10) {
              $(this).siblings().css('background-color', 'lightpink');
            } else {
              $(this).siblings().css('background-color', 'default');
            }
          });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#tablesppd').DataTable();
        });
    </script>
    
</html>