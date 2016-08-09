// JavaScript Document

$(window).scroll(function () {

    var datobarra = $(document).scrollTop();

    if (datobarra > 35) {

        $('#IdBarraPasosLateral').addClass('mostrar').removeClass('ocultar');
        $('#idHeader').addClass('navbar-wrapper-fijo');

    } else {

        $('#idHeader').removeClass('navbar-wrapper-fijo');
        $('#IdBarraPasosLateral').addClass('ocultar').removeClass('mostrar');

    }

});

$(document).ready(function () {

    
    muestrabotonenviar();

    var borrame = $('#ContentPlaceHolder1_CrtlContacto_Prova').val();

    if (borrame == 'true') {

        alert('Funciona? '+$('#ContentPlaceHolder1_CrtlContacto_IdNombre').val() + ' ' + $('#ContentPlaceHolder1_CrtlContacto_IdApellido').val());
        //alert('mail fue enviado!!!!');
        $('#IdFormulario').addClass('ocultar').removeClass('mostrar');
        $('#IdFormularioEnviado').addClass('mostrar').removeClass('ocultar');

        $('.IdClassNombreCompleto').html($('#ContentPlaceHolder1_CrtlContacto_IdNombre').val() + ' ' + $('#ContentPlaceHolder1_CrtlContacto_IdApellido').val());
        $('.IdClassEmpresa').html('empresa '+$('#ContentPlaceHolder1_CrtlContacto_IdNombreEmpresa').val());
        Resetformulario();

    } else {
        // alert('No funciona!!!!');
    }


    $('#ContentPlaceHolder1_CrtlContacto_IdNombre').keyup(function () {

        var nombre = $(this).val();

        if (validacampovacio(nombre)) {

            $(this).addClass('alert-success').removeClass('alert-danger');
            $('.IdClassNombreCompleto').html(nombre);
            $('#IdPanelAlertFormulario').addClass('ocultar').removeClass('mostrar');
            muestrabotonenviar();

        } else {

            $(this).removeClass('alert-danger').removeClass('alert-success');

        }


    }).keyup();

    $('#ContentPlaceHolder1_CrtlContacto_IdApellido').keyup(function () {

        var nombre = $(this).val();

        if (validacampovacio(nombre)) {

            $(this).addClass('alert-success').removeClass('alert-danger');
            $('.IdClassNombreCompleto').html(nombre);
            $('#IdPanelAlertFormulario').addClass('ocultar').removeClass('mostrar');
            muestrabotonenviar();

        } else {

            $(this).removeClass('alert-danger').removeClass('alert-success');

        }


    }).keyup();

    $('#ContentPlaceHolder1_CrtlContacto_IdNombreEmpresa').keyup(function () {

        var empresa = $(this).val();

        if (validacampovacio(empresa)) {

            $(this).addClass('alert-success').removeClass('alert-danger');
            $('.IdClassEmpresa').html(empresa);
            $('#IdPanelAlertFormulario').addClass('ocultar').removeClass('mostrar');
            muestrabotonenviar();

        } else {

            $(this).removeClass('alert-danger').removeClass('alert-success');

        }


    }).keyup();

    $('#ContentPlaceHolder1_CrtlContacto_IdMail').keyup(function () {

        var mail = $(this).val();

        if (validacampovacio(mail)) {

            if (validamail(mail)) {

                $(this).addClass('alert-success').removeClass('alert-danger');
                $('.IdClassMail').html(mail);
                $('#IdPanelAlertFormulario p').html('Hay campos vacios.');
                muestrabotonenviar();

            } else {

                $(this).addClass('alert-danger').removeClass('alert-success');
                $('#IdPanelAlertFormulario p').html('Mail ingresado no es válido');
            }
            $('#IdPanelAlertFormulario').addClass('ocultar').removeClass('mostrar');

        } else {

            $(this).removeClass('alert-danger').removeClass('alert-success');

        }

    }).keyup();

    $('#ContentPlaceHolder1_CrtlContacto_IdMensaje').keyup(function () {

        var mensaje = $(this).val();

        if (validacampovacio(mensaje)) {

            $(this).addClass('alert-success').removeClass('alert-danger');
            $('.IdClassMensaje').html(mensaje);
            $('#IdPanelAlertFormulario').addClass('ocultar').removeClass('mostrar');
            muestrabotonenviar();

        } else {

            $(this).removeClass('alert-danger').removeClass('alert-success');

        }

    }).keyup();

    $('.id-btn-modal-home').click(function () {

        ventanamodal(IdModalHomeDescripcion);

    });

    $('.id-btn-modal-resultados').click(function () {

        ventanamodal(IdModalResultadosDescripcion);

    });

    $('.id-btn-modal-ficha').click(function () {

        ventanamodal(IdModalFichaDescripcion);

    });


    $('#IdBtnReEnviar').click(function () {
//        alert('funciona?');
        $('input[type=text]').attr('value', '');
        $('textarea').empty();
        $('#IdFormulario').addClass('mostrar').removeClass('ocultar');
        $('#IdFormularioEnviado').addClass('ocultar').removeClass('mostrar');
        

    });

});

function Resetformulario() {

    //$('#CrtlContacto_IdNombre')[0].reset();

    //$("#IdFormMensaje")[0].reset();
    $("#IdFormMensaje").get(0).reset();
    $('input[type = text]').val('');

 //   $('#CrtlContacto_IdNombre').val();
 //   $('#CrtlContacto_IdApellido').val();

    //if ($('#IdFormulario').hasClass('ocultar')) {

    //    $('#IdFormulario').addClass('mostrar').removeClass('ocultar');
    //    $('#IdFormularioEnviado').addClass('ocultar').removeClass('mostrar');
    //    $('input, textarea').removeClass('alert-success');

    //    $('#IdNombreEmpresa').val('');
    //    $('#IdMail').val('');
    //    $('#IdMensaje').val('');

    //}

}

function validacampovacio(datocampo) {

    if (datocampo) {

        return true;
    }
    else {

        return false;

    }

}

function validamail(datomail) {

    var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

    //Se utiliza la funcion test() nativa de JavaScript
    if (regex.test(datomail)) {
        return true;
    }
    else {

        return false;

    }

}

function ventanamodal(idventanamodal) {

    $(idventanamodal).modal('show');

}


function muestrabotonenviar() {

    if (validacampovacio($('#ContentPlaceHolder1_CrtlContacto_IdNombre').val()) && validacampovacio($('#ContentPlaceHolder1_CrtlContacto_IdApellido').val()) && validacampovacio($('#ContentPlaceHolder1_CrtlContacto_IdNombreEmpresa').val()) && validacampovacio($('#ContentPlaceHolder1_CrtlContacto_IdMail').val()) && validamail($('#ContentPlaceHolder1_CrtlContacto_IdMail').val()) && validacampovacio($('#ContentPlaceHolder1_CrtlContacto_IdMensaje').val())) {

        $("#ContentPlaceHolder1_CrtlContacto_IdSendMail").prop("disabled", false);

   //     $('#IdFormulario').addClass('ocultar').removeClass('mostrar');
   //     $('#IdFormularioEnviado').addClass('mostrar').removeClass('ocultar');
   //     $('#IdPanelAlertFormulario').addClass('ocultar').removeClass('mostrar');
   //     $('#IdFormMensaje').submit();

    } else {

        
        $("#ContentPlaceHolder1_CrtlContacto_IdSendMail").prop("disabled", true);
        
     //   $('#IdPanelAlertFormulario').addClass('mostrar').removeClass('ocultar');

    }




}

