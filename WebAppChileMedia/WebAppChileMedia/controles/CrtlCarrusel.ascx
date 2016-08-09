<%@ Control Language="C#" AutoEventWireup="true" CodeBehind="CrtlCarrusel.ascx.cs" Inherits="WebAppChileMedia.controles.CrtlCarrusel" %>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" src="images/carrusel/cr_foto_01.png" alt="First slide">
          <div class="container">
            <div class=" col-lg-4 carousel-caption">
            	<div class="text-left" style=" margin-left:-70px; width:400px;">
                  <h1>Publicidad en Nuestra Red Chileautos Ltda.</h1>
                  <p>Utiliza nuestros espacios publicitarios para obtener mejores resultados en tus compras y ventas de veh&iacute;culos<br /> en nuestra red.</p>
                  <p><a class="ancla btn btn-lg btn-primary" href="#contacto" role="button">Consulta aqu&iacute;</a></p>
            	</div>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Mejora tu presencia en nuestra red.</h1>
              <p>Saber en qu&eacute; lugar mostrar tu publicidad, es esencial para mejorar tus resultados.</p>
              <p><a class="ancla btn btn-lg btn-primary" href="#IdDescripcion" role="button">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Te ayudamos a mejorar tus resultados en nuestra red.</h1>
              <p>No te vendemos un espacio en nuestra red, sino toda una experiencia en gesti&oacute;n de publicidad en nuestra red Chileautos.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>