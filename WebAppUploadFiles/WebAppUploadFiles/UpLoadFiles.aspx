<%@ Page Title="UpLoad Files" Language="C#" MasterPageFile="~/Site.Master" AutoEventWireup="true" CodeBehind="UpLoadFiles.aspx.cs" Inherits="WebAppUploadFiles.UpLoadFiles" %>

<asp:Content ID="BodyContent" ContentPlaceHolderID="MainContent" runat="server">

    <h2><%: Title %>. <small>Sitio = <span id="IdSitio">1</span> | Estado = No leido (<span id="IdEstado">0</span>)</small></h2>

    <div class="row">
        <asp:FileUpload ID="FileUpload1" runat="server" /> <asp:Button ID="Button1" runat="server" Text="Upload File" />
        <asp:TextBox ID="IdStatus" runat="server"></asp:TextBox>
    </div>
    <div class="row">
        <div id="IdTablaRegistros"></div>
    </div>
    <script type="text/javascript" src="Scripts/ListarDocumentos.js"></script>

</asp:Content>
