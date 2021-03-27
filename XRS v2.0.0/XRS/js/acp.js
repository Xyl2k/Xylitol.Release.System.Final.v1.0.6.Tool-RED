function inputClick(valeur, obj)
{
    if(valeur == obj.value) obj.value = '';
}

function getXhr()
{
    var xhr = null;
    if(window.XMLHttpRequest) // Firefox et autres
    xhr = new XMLHttpRequest();
    else if(window.ActiveXObject){ // Internet Explorer
        try {
            xhr = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xhr;
}

function delrow(id)
{
    var xhr = getXhr();

    xhr.onreadystatechange = function()
    {
        if(xhr.readyState == 4 && xhr.status == 200){
            document.getElementById('update' + id).style.display = 'none';
            document.getElementById('sure' + id).style.display = 'inline';
        }
    }
    xhr.open("GET","acpajax.php",true);
    xhr.send(null);
}

function delrowsure(id)
{
    var xhr   = getXhr();
    var token = document.getElementById('token').value;

    xhr.onreadystatechange = function()
    {
        if(xhr.readyState == 4 && xhr.status == 200){
            document.getElementById('sure' + id).style.display = 'none';
            document.getElementById('hide' + id).style.display = 'none';
        }
    }
    xhr.open("GET","acpajax.php?id=" + encodeURI(id) +  "&token=" + encodeURI(token) + "&delete",true);
    xhr.send(null);
}

function notsure(id)
{
    document.getElementById('update' + id).style.display = 'inline';
    document.getElementById('sure' + id).style.display = 'none';
}
