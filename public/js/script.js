 $('.table-hari-ipa').each(function () {
  var hari = parseInt($(this).text());
  var index = $(this).index();

  if ((hari >= 0) && (hari <= 4)) {
    $('.table-status-ipa').eq(index).css('background-color', '#32CD32');
  } else if ((hari > 4) && (hari <= 10)) {
    $('.table-status-ipa').eq(index).css('background-color', '#FFA500'); //'lightgoldenrodyellow');
  } else if (hari > 10) {
    $('.table-status-ipa').eq(index).css('background-color', '#CD5C5C');
  } else {
    $('.table-status-ipa').eq(index).css('background-color', 'default');
  }
});


$('.table-hari-pp').each(function () {
  var hari = parseInt($(this).text());
  var index = $(this).index();

  if ((hari >= 0) && (hari <= 4)) {
    $('.table-status-pp').eq(index).css('background-color', '#32CD32');
  } else if ((hari > 4) && (hari <= 10)) {
    $('.table-status-pp').eq(index).css('background-color', '#FFA500'); //'lightgoldenrodyellow');
  } else if (hari > 10) {
    $('.table-status-pp').eq(index).css('background-color', '#CD5C5C');
  } else {
    $('.table-status-pp').eq(index).css('background-color', 'default');
  }
});

 $(document).ready(function () {
   $('#tablesppd').DataTable();
});

function tanggal(){
  var startDate = $('#waktuawal').val()
  var endDate = $('#waktuakhir').val()
  if (startDate == '' || endDate == ''){
    return;
  }
    
  var awal = new Date(startDate);
  var akhir = new Date(endDate)
    
  if (akhir < awal){
    return;
  }
    
  var selisih = akhir - awal; 
  $('.hasilselisih').text(selisih / (1000 * 60 * 60 * 24));
  console.log(selisih / (1000 * 60 * 60 * 24));
}