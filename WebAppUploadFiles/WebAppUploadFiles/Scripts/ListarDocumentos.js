$(document).ready(function () {

    cargalistado();
    $('#MainContent_IdStatus').val("");
    var sitio;
    var estado;
    var datanull;
    var count = 0;

    function cargalistado() {

        sitio = $('#IdSitio').text();
        estado = $('#IdEstado').text();

        var cad = ("<table class='table table-striped'>");
        cad += ("<thead><tr>");
        cad += ("<th class='ocultar-columna'>id</th>");
        cad += ("<th class='ocultar-columna'>idemail</th>");
        cad += ("<th class='ocultar-columna'>Nombre Archivo</th>");
        cad += ("<th class='ocultar-columna'>Sitio</th>");
        cad += ("<th class='ocultar-columna'>Estado</th>");
        cad += ("</tr></thead><tbody>");


        $.ajax({ url: "http://172.16.0.103:9090/ServiceUpLoadFiles.svc/findBySitio/"+sitio+"/"+estado }).then(function (data) {

            sortJson(data, "id_num", "int", false);

                    for (l in data.slice(0,20)) {
                        
                        cad += ("<tr>");
                        cad += ("<td>" + data[l].id_num + "</td>");
                        cad += ("<td>" + data[l].idemail + "</td>");
                        cad += ("<td>" + data[l].fnombre + "</td>");
                        cad += ("<td>" + data[l].sitio + "</td>");

                        if (data[l].estado == 0) { datanull = "sin leer (0)" } else { datanull = "Leído (1)" }

                        cad += ("<td class='ocultar-columna'>" + datanull + "</td>");
                        cad += ("</tr>");
                    
                        count++;

                 }


            cad += ("</tbody></table>");
            $("#IdTablaRegistros").html(cad);

        });

    };

    function sortJson(element, prop, propType, asc) {
        switch (propType) {
            case "int":
                element = element.sort(function (a, b) {
                    if (asc) {
                        return (parseInt(a[prop]) > parseInt(b[prop])) ? 1 : ((parseInt(a[prop]) < parseInt(b[prop])) ? -1 : 0);
                    } else {
                        return (parseInt(b[prop]) > parseInt(a[prop])) ? 1 : ((parseInt(b[prop]) < parseInt(a[prop])) ? -1 : 0);
                    }
                });
                break;
            default:
                element = element.sort(function (a, b) {
                    if (asc) {
                        return (a[prop].toLowerCase() > b[prop].toLowerCase()) ? 1 : ((a[prop].toLowerCase() < b[prop].toLowerCase()) ? -1 : 0);
                    } else {
                        return (b[prop].toLowerCase() > a[prop].toLowerCase()) ? 1 : ((b[prop].toLowerCase() < a[prop].toLowerCase()) ? -1 : 0);
                    }
                });
        }
    }

});