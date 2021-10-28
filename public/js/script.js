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