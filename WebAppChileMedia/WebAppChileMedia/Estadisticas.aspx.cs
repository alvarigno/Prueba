using System;
using System.Collections.Generic;
using System.Globalization;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace WebAppChileMedia
{
    public partial class Estadisticas : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            DateTime now = DateTime.Now;
            //IdFechaTitulo.InnerHtml = now.ToString("MMMM") + " " + now.ToString("yyyy");
            //IdFecha2.InnerHtml = now.ToString("MMMM") +" "+ now.ToString("yyyy");
            //IdFechaPeriodoCargando.InnerHtml = now.ToString("MMMM") + " - " + now.ToString("yyyy") + " - " + now.Date;
            //IdFechaPeriodoCargando.InnerHtml = now.ToString("MMMM") + " de " + now.ToString("yyyy");

            int month = System.DateTime.Now.Month -1;
            int year = System.DateTime.Now.Year - 1;
            IdFechaPeriodoCargando.InnerHtml = obtenerNombreMesNumero(month) + " de " + now.ToString("yyyy");
            IdFechaTitulo.InnerHtml = obtenerNombreMesNumero(month) + " " + now.ToString("yyyy");
            IdFecha2.InnerHtml = obtenerNombreMesNumero(month + 1) + "  " + year + " - " + obtenerNombreMesNumero(month) + " " + now.ToString("yyyy");

        }

        private string obtenerNombreMesNumero(int numeroMes)
        {
            try
            {
                DateTimeFormatInfo formatoFecha = CultureInfo.CurrentCulture.DateTimeFormat;
                string nombreMes = formatoFecha.GetMonthName(numeroMes);
                return nombreMes;
            }
            catch
            {
                return "Desconocido";
            }
        }


    }
}