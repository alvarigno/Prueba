<%@ Page Title=" ReadyFiles" Language="C#" MasterPageFile="~/Site.Master" AutoEventWireup="true" CodeBehind="ReadyFiles.aspx.cs" Inherits="WebAppUploadFiles.ReadyFiles" %>

<asp:Content ID="BodyContent" ContentPlaceHolderID="MainContent" runat="server">

    <h2><%: Title %>. <small>Sitio = <span id="IdSitio">1</span> | Estado = Leido (<span id="IdEstado">1</span>)</small></h2>

    <div class="row">
        <div id="IdTablaRegistros"></div>
    </div>
    <script type="text/javascript" src="Scripts/ListarDocumentos.js"></script>

</asp:Content>