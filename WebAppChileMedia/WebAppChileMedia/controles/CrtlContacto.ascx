<%@ Control Language="C#" AutoEventWireup="true" CodeBehind="CrtlContacto.ascx.cs" Inherits="WebAppChileMedia.controles.CrtlContacto" %>

              <div id="IdFormulario" class="col-md-7 mostrar">

                  <form id="IdFormMensaje" style="margin-top:150px" runat="server" action="index.aspx#contacto">
                      <input type="hidden" id="Prova" runat="server" />
                      <div id="IdPanelAlertFormulario" class="form-group alert alert-danger ocultar">
                          <p>Hay campos vacios.</p>
                      </div>
                      <div class="form-group">
                          <label for="nombre">Nombre</label>
                          <asp:TextBox CssClass="form-control" id="IdNombre" runat="server" /> 
                      </div>
                      <div class="form-group">
                          <label for="apellido">Apellido</label>
                          <asp:TextBox CssClass="form-control" id="IdApellido" runat="server" /> 
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Empresa</label>
                          <asp:TextBox CssClass="form-control" id="IdNombreEmpresa" runat="server" /> 
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Correo Electr&oacute;nico</label>
                          <asp:TextBox CssClass="form-control" id="IdMail" runat="server" /> 
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Correo Electr&oacute;nico</label>
                          <asp:TextBox  id="IdMensaje" CssClass=" form-control" TextMode="MultiLine" runat="server" /> 
                      </div>
                      <div class="form-group">
                          <asp:Button ID="IdSendMail" runat="server" OnClick="btnENviar_Click_Click" Text="Enviar Mensaje" Cssclass="btn btn-success btn-lg" />
                      </div>
                  </form>

              </div>

              <div id="IdFormularioEnviado" class="col-md-7 ocultar">

                  <div style="margin-top:150px" class="alert alert-warning">
                      <h2>&Eacute;xito, tu mensaje ha sido enviado.</h2>
                      <p>Sr.(a). <strong><span class="IdClassNombreCompleto">nombre y apellido</span></strong>, de <span class="IdClassEmpresa">nombre empresa</span>, con correo <span class="IdClassMail">mail</span>.</p>
                      <p>Su mensaje: <br /><strong><span class="IdClassMensaje">mensaje</span></strong></p>
                      <p>Fue enviado a ChileMedia.cl</p>
                      <button id="IdBtnReEnviar" class="btn btn-default">Volvar a enviar mail</button>
                  </div>

              </div>