<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="Estadisticas.aspx.cs" Inherits="WebAppChileMedia.Estadisticas" MasterPageFile="~/SiteChileMedia.Master" %>

<%@ Register Src="~/controles/CrtlMenuInterno.ascx" TagPrefix="uc1" TagName="CrtlMenuInterno" %>


<asp:Content ContentPlaceHolderID="head" runat="server">

        <link href="/css/Css_Estadisticas.css" rel="stylesheet" type="text/css" />

</asp:Content>


<asp:Content ContentPlaceHolderID="ContentPlaceHolder1" runat="server">
    <uc1:CrtlMenuInterno runat="server" id="CrtlMenuInterno" />

	<div id="load" style="display:block; position:absolute; top:40%; left:40%; right:40%; bottom:40%;  text-align:center;">
        <img src="images/logotipos/logo_chilemedia_opuesto.png" style="width:150px; " />
        <h3>Descargando datos de <span id="IdFechaPeriodoCargando" runat="server"></span></h3>
        <img src="images/icons/procesando.gif" style="width:50px;" />
	</div>



	<div id="container" class="font-color" style="display:none; margin-top:150px;">
    <!-- arquitectura info -->
      <div class="container marketing" style=" margin-top:100px;">

          <div class="row featurette">
              
              <div class="col-md-7 col-md-push-5" style="background-image:url('images/logotipos/logo_chileautos.png'); background-position:center center; background-size:contain; background-repeat:no-repeat;">

                <div class="col-lg-4" style="padding-top:125px; ">
                    <div class="circle1 circle2 estilos-numeros">Visitas<br /> <span id="total-visitas-mes"></span></div>
                </div>
                <div class="col-lg-4" style="padding-top:30px; ">
                    <div class="circle1 circle2 estilos-numeros" style="margin-bottom:70px;">Páginas Vistas<br /> <span id="total-paginas-vistas-mes" class="titulonumeros"></span></div>
                    <div class="circle1 circle2 estilos-numeros" style=" margin-top:20px;">Visitantes únicos<br /> <span id="total-visitantes-unicos-mes" class="titulonumeros"></span></div>
                </div>

              </div>
              
              <div class="col-md-5 col-md-pull-7">
                  
                  <h2>Información del período <span id="IdFechaTitulo" runat="server"></span></h2>
                  <p class="text-lowercase">Datos de visitas son registrados en las aplicaciones de Google para estos fines, teniendo en consideración accesos por buscadores, enlaces directos desde terceros o páginas directas.</p>
                    <p class="text-lowercase">Las estádisticas están agrupadas por páginas, perfiles de personas (grupo etáreo, tipo de usuario y sexo), WSistemas Operativos y tipos de dispositivos.</p>
              </div>
          </div>

          <hr class="featurette-divider">

        <div class="row featurette">
            <h2>Páginas Vistas</h2>
            <p class="text-lowercase">Datos de visitas son registrados en las aplicaciones de Google para estos fines, teniendo en consideración accesos por buscadores, enlaces directos desde terceros o páginas directas.</p>
            <p class="text-lowercase">Las estádisticas están agrupadas por páginas, perfiles de personas (grupo etáreo, tipo de usuario y sexo), WSistemas Operativos y tipos de dispositivos.</p>


			<div class="datos2info">			
				<div class="datos2">
					<div class="titulo">Home</div>
					<div id="porcentaje-visitas-portada-graf" class="graficoh"></div>
					<p id="porcentaje-visitas-portada"></p>
					<div class="graficohfondo"></div>
					<div id="total-visitas-portada" class="titulonumeros"></div>
				</div>			
				<div class="datos2">
					<div class="titulo">Listado vehículos</div>
					<div id="porcentaje-visitas-cemagic-graf" class="graficoh"></div>
					<p id="porcentaje-visitas-cemagic"></p>
					<div class="graficohfondo"></div>
					<div id="total-visitas-cemagic" class="titulonumeros"></div>
				</div>			
				<div class="datos2">
					<div class="titulo">Ficha vehículos</div>
					<div id="porcentaje-visitas-auto-graf" class="graficoh"></div>
					<p id="porcentaje-visitas-auto"></p>
					<div class="graficohfondo"></div>
					<div id="total-visitas-auto" class="titulonumeros"></div>
				</div>			
				<div class="datos2">
					<div class="titulo">Otras</div>
					<div id="porcentaje-visitas-otras-graf" class="graficoh"></div>
					<p id="porcentaje-visitas-otras"></p>
					<div class="graficohfondo"></div>
					<div id="total-visitas-otras" class="titulonumeros"></div>
				</div>			
				<div class="datos2">
					<div class="titulo">Total</div>
					<div id="porcentaje-visitas-graf" class="graficohfondofinal"></div>
					<p id="porcentaje-visitas"></p>
					<div id="total-visitas" class="titulonumeros"></div>
				</div>			
			</div>


        </div>

        <div class="row featurette">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Detalle Diario
                    </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" style="border:#ccc 1px solid; border-radius:4px;">
                    <div class="col-md-12 panel-body">
                        <h2 class="featurette-heading"></h2>
			            <div class="" id="barchart" style="padding:0px;  margin:0px; width:450px; float:left; overflow:hidden; "></div>
			            <div class="" id="barchart2" style="padding:0px;  margin:0px; width:450px; float:left; "></div>
                    </div>
                </div>
                </div>




            </div>
        </div>

          <hr class="featurette-divider">

          <div class="row featurette">
              <div class="col-md-7 col-md-push-5">

			<div class="datos5bloque">
		
				<div class="datos5">
					<div id="porcentaje-edad-18-24" class="titulo"></div>
					<div class="wrap-graf-edad">
						<div class="graficohfondo"></div>
						<div id="porcentaje-edad-18-24-graf" class="graficoh"></div>
					</div>
					<div class="titulonumeros">18-24</div>
				</div>				
				<div class="datos5">
					<div id="porcentaje-edad-25-34" class="titulo"></div>
					<div class="wrap-graf-edad">
						<div class="graficohfondo"></div>
						<div id="porcentaje-edad-25-34-graf" class="graficoh"></div>
					</div>
					<div class="titulonumeros">25-34</div>
				</div>				
				<div class="datos5">
					<div id="porcentaje-edad-35-44" class="titulo"></div>
					<div class="wrap-graf-edad">
						<div class="graficohfondo"></div>
						<div id="porcentaje-edad-35-44-graf" class="graficoh"></div>
					</div>
					<div class="titulonumeros">35-44</div>
				</div>				
				<div class="datos5">
					<div id="porcentaje-edad-45-54" class="titulo"></div>
					<div class="wrap-graf-edad">
						<div class="graficohfondo"></div>
						<div id="porcentaje-edad-45-54-graf" class="graficoh"></div>
					</div>
					<div class="titulonumeros">45-54</div>
				</div>				
				<div class="datos5">
					<div id="porcentaje-edad-55-64" class="titulo"></div>
					<div class="wrap-graf-edad">
						<div class="graficohfondo"></div>
						<div id="porcentaje-edad-55-64-graf" class="graficoh"></div>
					</div>
					<div class="titulonumeros">55-64</div>
				</div>				
				<div class="datos5">
					<div id="porcentaje-edad-mas-65" class="titulo"></div>
					<div class="wrap-graf-edad">
						<div class="graficohfondo"></div>
						<div id="porcentaje-edad-mas-65-graf" class="graficoh"></div>
					</div>
					<div class="titulonumeros">+ 65</div>
				</div>			
			</div>	

              </div>
              <div class="col-md-5 col-md-pull-7">

                  <h2 class="featurette-heading">Grupo Etario <span class="tituloporcentajes">100% del total de visitas</span></h2>
                  <p class="text-lowercase">Datos de visitas son registrados en las aplicaciones de Google para estos fines, teniendo en consideración accesos por buscadores, enlaces directos desde terceros o páginas directas.</p>
                    <p class="text-lowercase">Las estádisticas están agrupadas por páginas, perfiles de personas (grupo etáreo, tipo de usuario y sexo), WSistemas Operativos y tipos de dispositivos.</p>
              </div>
          </div>

          <hr class="featurette-divider">

          <div class="row featurette">

              <div class="col-md-5 col-md-push-7">

                  <h2 class="featurette-heading">Genero de Visitantes</h2>
                  <p class="text-lowercase">Datos de visitas son registrados en las aplicaciones de Google para estos fines, teniendo en consideración accesos por buscadores, enlaces directos desde terceros o páginas directas.</p>
                    <p class="text-lowercase">Las estádisticas están agrupadas por páginas, perfiles de personas (grupo etáreo, tipo de usuario y sexo), WSistemas Operativos y tipos de dispositivos.</p>
					<div class="info6">
						<div class="titulo">Visitante Hombres <span id="total-usuarios-hombres" class="titulonumeros"></span></div>						
					</div>
					<div class="info6">
						<div class="titulo">Visitantes Mujeres <span id="total-usuarios-mujeres" class="titulonumeros2"></span></div>
					</div>
              </div>


              <div class="col-md-7 col-md-pull-5">

			    <div class="datos6bloque">
				    <div class="datos6">
					    <div id="pie-chart-usuaros-sexo" style=" width:500px; height:300px;">
					    </div>
				    </div>			
			    </div>

              </div>

          </div>

          <hr class="featurette-divider">

          <div class="row featurette">

              <div class="col-md-7 col-md-push-5">

                <div class="datos6">
					<div id="pie-chart-tipos-usuarios" style=" width:500px; height:300px;"></div>
				</div>		

              </div>

              <div class="col-md-5 col-md-pull-7">
                  <h2 class="featurette-heading">Tipo de Usuarios</h2>
                  <p class="text-lowercase">Datos de visitas son registrados en las aplicaciones de Google para estos fines, teniendo en consideración accesos por buscadores, enlaces directos desde terceros o páginas directas.</p>
                    <p class="text-lowercase">Las estádisticas están agrupadas por páginas, perfiles de personas (grupo etáreo, tipo de usuario y sexo), WSistemas Operativos y tipos de dispositivos.</p>
					<div class="info6">
						<div class="titulo">Número de Visitante recurrentes
						    <span id="total-usuarios-recurrentes" class="titulonumeros"></span>, representan el
						    <span id="porcentaje-usuarios-recurrentes" class="tituloporcentaje"></span>
						</div>
					</div>
					<div class="info6">
						<div class="titulo">Número de Nuevos Visitantes
						    <span id="total-usuarios-nuevos" class="titulonumeros2"></span>, representan el 
						    <span id="porcentaje-usuarios-nuevos" class="tituloporcentaje2"></span>
						</div>
					</div>
              </div>

          </div>

            <hr class="featurette-divider">

          <div class="row featurette">

              <div class="col-md-5 col-md-push-7">

                  <h2 class="featurette-heading">Dispositivos</h2>
                  <p class="text-lowercase">Datos de visitas son registrados en las aplicaciones de Google para estos fines, teniendo en consideración accesos por buscadores, enlaces directos desde terceros o páginas directas.</p>
					<div class="info6">
						<div class="titulo">Equipos de Escritorio <span id="dispositivo-desktop-total" class="titulonumeros"></span></div>						
					</div>
					<div class="info6">
						<div class="titulo">Equipos Celulares <span id="dispositivo-mobile-total" class="titulonumeros2"></span></div>
					</div>
					<div class="info6">
						<div class="titulo">Equipos Tablas <span id="dispositivo-tablet-total" class="titulonumeros2"></span></div>
					</div>
              </div>


              <div class="col-md-7 col-md-pull-5">

			    <div class="datos6bloque">
				    <div class="datos6">
              <div id="pie-chart-devices" style=" width:500px; height:300px;"></div>
				    </div>			
			    </div>

              </div>

         </div>

          <hr class="featurette-divider">

          <div class="row featurette">

              <div class="col-md-7 col-md-push-5">

                <div class="datos6">
					<div id="pie-chart-OS" style=" width:500px; height:300px;"></div>
				</div>		

              </div>

              <div class="col-md-5 col-md-pull-7">
                  <h2 class="featurette-heading">Sistemas Operativos</h2>
                  <p class="text-lowercase">Datos de visitas son registrados en las aplicaciones de Google para estos fines, teniendo en consideración accesos por buscadores, enlaces directos desde terceros o páginas directas.</p>
					<div class="info6">
						<div class="titulo">Equipos con Android <span id="os-android" class="titulonumeros"></span></div>						
					</div>
					<div class="info6">
						<div class="titulo">Equipos con IOS <span id="os-ios" class="titulonumeros2"></span></div>
					</div>
					<div class="info6">
						<div class="titulo">Equipos con WindosPhone <span id="os-windows-phone" class="titulonumeros2"></span></div>
					</div>
					<div class="info6">
						<div class="titulo">Equipos con Otros OS <span id="os-otros" class="titulonumeros2"></span></div>
					</div>
              </div>

         </div>

          <hr class="featurette-divider">

          <div class="row featurette">

              <div class="col-md-5 col-md-push-7">

                  <h2 class="featurette-heading">Navegadores</h2>
                  <p class="text-lowercase">Datos de visitas son registrados en las aplicaciones de Google para estos fines, teniendo en consideración accesos por buscadores, enlaces directos desde terceros o páginas directas.</p>
					<div class="info6">
						<div class="titulo">Cant. Chrome: <span id="id-cantidad-chorme" class="titulonumeros"></span></div>						
					</div>
					<div class="info6">
						<div class="titulo">Cant. Safari: <span id="id-cantidad-safari" class="titulonumeros2"></span></div>
					</div>
					<div class="info6">
						<div class="titulo">Cant. IE: <span id="id-cantidad-ie" class="titulonumeros2"></span></div>
					</div>
					<div class="info6">
						<div class="titulo">Cant. Firefox: <span id="id-cantidad-firefox" class="titulonumeros2"></span></div>
					</div>
					<div class="info6">
						<div class="titulo">Cant. Ópera: <span id="id-cantidad-opera" class="titulonumeros2"></span></div>
					</div>
					<div class="info6">
						<div class="titulo">Cant. Otros: <span id="id-cantidad-otros" class="titulonumeros2"></span></div>
					</div>
              </div>


              <div class="col-md-7 col-md-pull-5">

			    <div class="datos6bloque">
				    <div class="datos6">
                        <div id="pie-chart-browsers" style=" width:500px; height:300px;"></div>
				    </div>			
			    </div>

              </div>

         </div>

          <hr class="featurette-divider">

          <div class="row featurette">
              <div class="col-md-7 col-md-push-5" style="background-image:url('images/logotipos/logo_chileautos.png'); background-position:center center; background-size:contain; background-repeat:no-repeat;">

                <div class="col-lg-4" style="padding-top:125px; ">
                    <div class="circle1 circle2 estilos-numeros">Visitas<br /> <span id="total-visitas-anio"></span></div>
                </div>
                <div class="col-lg-4" style="padding-top:30px; ">
                    <div class="circle1 circle2 estilos-numeros" style="margin-bottom:70px;">Páginas Vistas<br /> <span id="total-paginas-vistas-anio" class="titulonumeros"></span></div>
                    <div class="circle1 circle2 estilos-numeros" style=" margin-top:20px;">Visitantes únicos<br /> <span id="total-visitantes-unicos-anio" class="titulonumeros"></span></div>
                </div>

              </div>
              <div class="col-md-5 col-md-pull-7">

                  <h2>Período <span id="IdFecha2" runat="server"></span>.</h2>
                  <p class="text-lowercase">Datos de visitas son registrados en las aplicaciones de Google para estos fines, teniendo en consideración accesos por buscadores, enlaces directos desde terceros o páginas directas.</p>
                    <p class="text-lowercase">Las estádisticas están agrupadas por páginas, perfiles de personas (grupo etáreo, tipo de usuario y sexo), WSistemas Operativos y tipos de dispositivos.</p>
                    <div> Páginas / Visitas <span id="total-paginas-visitas-anio"></span>% </div>
                    <div> Tiempo de permanencia en páginas <span id="promedio-tiempo-visita-anio"></span></div>
             </div>
          </div>


          <hr class="featurette-divider">

            <div class="row featurette">
                <h2 class="featurette-heading">Datos Principales</h2>
                <p class="text-lowercase">Datos de visitas son registrados en las aplicaciones de Google para estos fines, teniendo en consideración accesos por buscadores, enlaces directos desde terceros o páginas directas.</p>
                <p class="text-lowercase">Las estádisticas están agrupadas por páginas, perfiles de personas (grupo etáreo, tipo de usuario y sexo), WSistemas Operativos y tipos de dispositivos.</p>


				<div id="areachart"></div>

			        <h5 style="margin: 5px 0px 0px 0px;text-align:left;">Definiciones:</h5>
			        <ul class="def">
				        <li>
					        <b>Visitas:</b> Número de visitas del sitio.
				        </li>
				        <li>
					        <b>Visitantes únicos:</b> Número de visitantes no duplicados (contabilizados una sola vez) que han accedido al sitio en un período de tiempo determinado.
				        </li>
				        <li>
					        <b>Páginas vistas:</b> Número total de páginas vistas; las visitas repetidas a una misma página también son contadas.
				        </li>
				        <li>
					        <b>Páginas / Visitas:</b> Número promedio de páginas vistas durante una visita en el sitio. Las visitas repetidas a una única página también son contadas.
				        </li>
				        <li>
					        <b>Duración promedio visitas:</b> Tiempo promedio de una sesión.
				        </li>
			        </ul>

          </div>


    </div>
    <!-- ./arquitectura info -->



		<div style="font-size:14px; font-weight:bold; text-align:right;"><span>Fuente: Google Analytics.</span></div>
    </div>
</asp:Content>

<asp:Content ContentPlaceHolderID="ContentPlaceHolderScript" runat="server">

	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://desanew.chileautos.cl/recurrentes/estadisticas/gachileautosjs_ChileMedia.php"></script>

</asp:Content>