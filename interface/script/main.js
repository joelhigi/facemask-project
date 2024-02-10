function nextSelect(arr){
    document.querySelector('.main').classList.remove('hide');
    document.querySelector('.main').classList.add('disp');

    // alert('umuturage');
    var s2 = document.getElementById('slct2');
    s2.innerHTML = " ";
    for( var opt in arr) {
        var pair = arr[opt].split('|');
        var newOption = document.createElement('option');
        // alert(opt);
        newOption.value = pair[0];
        newOption.innerHTML = pair[1];
        s2.options.add(newOption);
    }
}




function populate(){
    var s1 = document.getElementById('slct1');
    switch(s1.value){
        case 'previous':
            var optionArray = ["yesterday|Yesterday","currentweek|Current Week","lastsevendays|Last 7 Days","previousweek|Previous Week","currentmonth|Current Month","lastthirtydays|Last 30 Days","previousmonth|Previous Month"];
            nextSelect(optionArray);
            break;
        case 'todaycases':
            var optionArray = ["today|Today"];
            nextSelect(optionArray);
            break;
        case 'unmmaskedtodaycases':
            var optionArray = ["today|Today"];
            nextSelect(optionArray);
            break;
        case 'maskedtodaycases':
            var optionArray = ["today|Today"];
            nextSelect(optionArray);
            break;
        case 'all':
            var optionArray = ["alltime|All Time"];
            nextSelect(optionArray);
            break;
        default:
    }
}
