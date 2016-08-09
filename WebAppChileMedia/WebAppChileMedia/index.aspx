<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="index.aspx.cs" Inherits="WebAppChileMedia.index" MasterPageFile="~/SiteChileMedia.Master" %>

<%@ Register Src="~/controles/CrtlContacto.ascx" TagPrefix="uc1" TagName="CrtlContacto" %>
<%@ Register Src="~/controles/CrtlCarrusel.ascx" TagPrefix="uc1" TagName="CrtlCarrusel" %>
<%@ Register Src="~/controles/MenuPrincipal.ascx" TagPrefix="uc1" TagName="MenuPrincipal" %>



<asp:Content ContentPlaceHolderID="head" runat="server">
    <!-- Custom styles for this template -->
    <link href="/css/carousel.css" rel="stylesheet">
</asp:Content>

<asp:Content ContentPlaceHolderID="ContentPlaceHolder1" runat="server">

    <uc1:MenuPrincipal runat="server" ID="MenuPrincipal" />
    <!-- Carousel
    ================================================== -->
      <uc1:CrtlCarrusel runat="server" id="CrtlCarrusel" />
    <!-- /.carousel -->


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

      <div class="container marketing">
          <a id="IdDescripcion"></a>
          <!-- Three columns of text below the carousel -->


          <div class="row" style="margin-top:150px">
              <div class="col-lg-4">
                  <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
                  <h2>Home</h2>
                  <p>Publica tus banners publicitarios de campañas transverzales de forma tal que todos los visitantes puedan ver lo que ofreces.</p>
                  <p><a class="id-btn-modal-home btn btn-default" href="#" role="button" data-toggle="modal">Ver detalles &raquo;</a></p>
              </div><!-- /.col-lg-4 -->
              <div class="col-lg-4">
                  <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
                  <h2>Resultados de B&uacute;queda</h2>
                  <p>Anucia tus publicidad relacionada con criterios de búsqueda, de esta forma, usuarios quer buscan un conepto en común podrán ver tus anuncios.</p>
                  <p><a class="id-btn-modal-resultados btn btn-default" href="#" role="button" data-toggle="modal">Ver detalles &raquo;</a></p>
              </div><!-- /.col-lg-4 -->
              <div class="col-lg-4">
                  <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
                  <h2>Ficha de Veh&iacute;culo</h2>
                  <p>Muestra los especifico de los mensajes de tus banners de forma tal, estén relacionados con las fichas de los vehículos que son publicados en la red Chileautos.</p>
                  <p><a class="id-btn-modal-ficha btn btn-default" href="#" role="button" data-toggle="modal">Ver detalles &raquo;</a></p>
              </div><!-- /.col-lg-4 -->
          </div><!-- /.row -->

          <!-- START THE FEATURETTES -->

          <hr class="featurette-divider">

          <a id="contacto"></a>
          <div class="row featurette">

              <div class="col-md-5">
                  <h2 class="featurette-heading">Cont&aacute;ctanos. <span class="text-muted">Publica tus banners con nosotros.</span></h2>
                  <p class="lead">Cuéntanos acerca de tus planes estrat&eacute;gicos, nosotros ayudaremos a sacar el mejor provecho a tus planes publicitarios en nuestra red<br /> Chileautos Ltda.</p>
              </div>

              <uc1:CrtlContacto runat="server" id="CrtlContacto" />

          </div>

          <hr class="featurette-divider">

          <div class="row featurette">
              <div class="col-md-7 col-md-push-5">
                  <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
                  <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
              </div>
              <div class="col-md-5 col-md-pull-7">
                  <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
              </div>
          </div>

          <hr class="featurette-divider">

          <div class="row featurette">
              <div class="col-md-7">
                  <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
                  <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
              </div>
              <div class="col-md-5">
                  <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
              </div>
          </div>

          <hr class="featurette-divider">

          <!-- /END THE FEATURETTES -->
          <!-- FOOTER -->
          <footer>
              <p class="pull-right"><a href="#">Back to top</a></p>
              <p>&copy; 2014 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
          </footer>

      </div>

    </asp:Content>
    <asp:Content ContentPlaceHolderID="ContentPlaceHolderScript" runat="server">

        <script type="text/javascript" src="/js/anclas.js"></script>
        <!--  Aquí van más codigo Javsascript de ser necesario -->

    </asp:Content>

    <asp:Content ContentPlaceHolderID="ContentPlaceHolderModalView" runat="server">

      <!-- Modal Setting -->
      <div id="IdModalHomeDescripcion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header ocultar">
                  </div>
                  <div class="container modal-descripcion-esquemas">
                      <div class="right">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="col-lg-8 left">
                          <img alt="esquema de banners en home" class="img-responsive" src="images/esquemas/img_home.png" />
                      </div>
                      <div class="col-lg-4 left">
                          <h2 class="modal-title" id="myModalLabel">Esquema de Banners en Home</h2>
                          <p>Descripción de la imagen, mostrando las posiciones que actualmente maneja el sitio para colocar publicidad en la página principal de chileautos.cl</p>
                          <p>Descarga el documento que describe los estándares de formato y tamaños de los banners para publicar.</p>
                          <button class="btn btn-primary btn-lg">Descarga Pdf <i class="glyphicon glyphicon-download-alt"></i></button>
                      </div>
                  </div>
                  <div class="modal-footer ocultar">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      <!-- button type="button" class="btn btn-primary">Save changes</button -->
                  </div>
              </div>
          </div>
      </div>

      <div id="IdModalResultadosDescripcion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="" role="document">
              <div class="" style="position:absolute; left:0px; right:0px;">
                  <div class="modal-header ocultar">
                  </div>
                  <div class="container modal-descripcion-esquemas">
                      <div class="right">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="col-lg-8 left">
                          <img alt="esquema de banners en home" class="img-responsive" src="images/esquemas/img_pag_resultados.png" />
                      </div>
                      <div class="col-lg-4 left">
                          <h2 class="modal-title" id="myModalLabel">Esquema de Banners en Resultados</h2>
                          <p>Descripción de la imagen, mostrando las posiciones que actualmente maneja el sitio para colocar publicidad en la página principal de chileautos.cl</p>
                          <p>Descarga el documento que describe los estándares de formato y tamaños de los banners para publicar.</p>
                          <button class="btn btn-primary btn-lg">Descarga Pdf <i class="glyphicon glyphicon-download-alt"></i></button>
                      </div>
                  </div>
                  <div class="modal-footer ocultar">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      <!-- button type="button" class="btn btn-primary">Save changes</button -->
                  </div>
              </div>
          </div>
      </div>

      <div id="IdModalFichaDescripcion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="" role="document">
              <div class="" style="position:absolute; left:0px; right:0px;">
                  <div class="modal-header ocultar">
                  </div>
                  <div class="container modal-descripcion-esquemas">
                      <div class="right">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="col-lg-8 left">
                          <img alt="esquema de banners en home" class="img-responsive" src="images/esquemas/img_ficha.png" />
                      </div>
                      <div class="col-lg-4 left">
                          <h2 class="modal-title" id="myModalLabel">Esquema de Banners en Ficha</h2>
                          <p>Descripción de la imagen, mostrando las posiciones que actualmente maneja el sitio para colocar publicidad en la página principal de chileautos.cl</p>
                          <p>Descarga el documento que describe los estándares de formato y tamaños de los banners para publicar.</p>
                          <button class="btn btn-primary btn-lg">Descarga Pdf <i class="glyphicon glyphicon-download-alt"></i></button>
                      </div>
                  </div>
                  <div class="modal-footer ocultar">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      <!-- button type="button" class="btn btn-primary">Save changes</button -->
                  </div>
              </div>
          </div>
      </div>

    </asp:Content>




