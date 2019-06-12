window.onload= () =>{
    //alert('hello;');
}

function showUser(str){
   // alert('hello;');
    if(str.length == 0){
        document.getElementById('unameHint').innerHTML = "";
        return;
    }else{
        var httprequest = XMLHttpRequest();
        httprequest.onreadystatechange = function(){
            if(httprequest.readyState == 4 && httprequest.status == 200){
                document.getElementById('unameHint').innerHTML = httprequest.responseText;
            }
        }
        httprequest.open('GET',"homePg.php? q="+str,true);
        httprequest.send();
    }
}