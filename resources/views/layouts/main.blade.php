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

        @include('partials.navbar')

        @yield('container')

        @include('partials.footer')

    </body>


    <script>
        $('.table-hari').each(function () {
            var hari = parseInt($(this).text());
            var index = $(this).index();
          
            if ((hari >= 0) && (hari <= 4)) {
              $('.table-status').eq(index).css('background-color', 'lightgreen');
            } else if ((hari > 4) && (hari <= 10)) {
              $('.table-status').eq(index).css('background-color', 'lightgoldenrodyellow');
            } else if (hari > 10) {
              $('.table-status').eq(index).css('background-color', 'lightpink');
            } else {
              $('.table-status').eq(index).css('background-color', 'default');
            }
          });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#tablesppd').DataTable();
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
          function createNewElement() {
            // First create a DIV element.
          var txtNewInputBox = document.createElement('div'); 
            // Then add the content (a new input box) of the element.
          txtNewInputBox.innerHTML = "<input type='text' name='pegawai[]' class='mt-2 form-control @error('pegawai[]') is-invalid @enderror' id='newInputBox'>";
            // Finally put it where it is supposed to appear.
          document.getElementById("newElementId").appendChild(txtNewInputBox);
        }
        </script>
    
</html>