<%@ Control Language="C#" AutoEventWireup="true" CodeBehind="CrtlMenuInterno.ascx.cs" Inherits="WebAppChileMedia.controles.CrtlMenuInterno" %>
<!-- NAVBAR
================================================== -->
  <a id="arribapagina"></a>
    <div class="navbar-wrapper">
      <div class="container">
        <nav id="idHeader"  class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <!-- span class="sr-only">Toggle navigation</-->
                <span class="icon-bar"><i class="glyphicon glyphicon-menu-hamburger white" aria-hidden="true"></i></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/index.aspx#arribapagina"><img class="css-logotipo" src="images/logotipos/logo_chilemedia.png" alt="Logotipo Chilemedia" /></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="/index.aspx#arribapagina"><i class="glyphicon glyphicon-home"></i></a></li>
                <li class="active"><a href="Estadisticas.aspx" target="_parent">Estadísticas</a></li>
                <li><a href="/index.aspx#about">Acerca de ChileMedia</a></li>
                <li><a href="/index.aspx#contacto">Cont&aacute;ctanos</a></li>
                <!-- li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Nav header</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li-->
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
<!-- ./NAVBAR -->