var cariteman = document.getElementById('cariteman');
var listteman = document.getElementById('listteman');

cariteman.addEventListener('keyup', function(){
    
    //var ajax
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200) {
            listteman.innerHTML = xhr.responseText;
        }
    }

    //eksekusi ajax
    xhr.open('GET','../../../public/ajax/teman.txt',true);
    xhr.send();

});