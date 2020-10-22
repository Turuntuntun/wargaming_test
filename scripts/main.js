function getXmlHttp(){
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function sendingForm (formname) {
    var xmlhttp = getXmlHttp();
    var p = '';
    for(var i=0;i<document.forms[formname].elements.length;i++) {
        p += document.forms[formname].elements[i].name+"="+encodeURIComponent(document.forms[formname].elements[i].value) + '&' ;
    }
    xmlhttp.open('GET', '/api?' + p, true);
    xmlhttp.setRequestHeader('Content-Type', 'application/json');
    xmlhttp.send();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            if(xmlhttp.status == 200) {
                let data = JSON.parse(xmlhttp.responseText);
                console.log(data);
                if (data['values'] !== null) {
                    createResult(data);
                } else {
                    var div = document.querySelector(".result");
                    div.innerHTML = "";
                }
            }
        }
    } ;
}

function createResult(data) {
    let result = "";
    for (let i=0; i < data['values'].length; i++) {
        let formatter = new Intl.DateTimeFormat(data['lang']);
        let date = new Date(+data['values'][i]['date']);

        result += "<div class=\"result_elem\">\n" +
            "                <p class=\"result_elem_title\">" + data['values'][i]['nation'] + " / " + data['values'][i]['type'] + "</p>\n" +
            "                <p class=\"result_elem_values\">\n" +
            "                    " + data['values'][i]['level'] + " "  + data['values'][i]['name'] + " " + data['values'][i]['price'] + "" +
            "                </p>\n" +
            "                <p class=\"result_elem_year\">" + formatter.format(date) + "</p>\n" +
            "            </div>"
    }
    var div = document.querySelector(".result");
    div.innerHTML = result;
}