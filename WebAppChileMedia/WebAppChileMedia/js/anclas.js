        $(document).ready(function(){
            //nos desplazamos entre todos los divs
            $('a.ancla').click(function(e){
            e.preventDefault();
            enlace  = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(enlace).offset().top
            }, 1000);
            });
            //vamos al principio o al final de la página
            $('a.arriba').click(function(e){
            e.preventDefault();
            volver  = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(volver).offset().top
            }, 2000);
            });
            //pasando la cantidad de pixeles que queremos a scrollTop
            $('.subir-top').click(function(){
                $('html, body').animate({scrollTop:0}, 850); return false;
            });
        });