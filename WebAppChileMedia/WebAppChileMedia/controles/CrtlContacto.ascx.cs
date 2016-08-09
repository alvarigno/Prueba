using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Mail;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace WebAppChileMedia.controles
{
    public partial class CrtlContacto : System.Web.UI.UserControl
    {
        protected void Page_Load(object sender, EventArgs e)
        {

        }

        protected void btnENviar_Click_Click(object sender, EventArgs e)
        {

             string mailrepositorio = "alvaro.emparan@gmail.com";
             string asuntomail = "Mail enviado desde www.chilemedia.cl";

            try
            {
                MailMessage mail = new MailMessage();
                SmtpClient SmtpServer = new SmtpClient("smtp.gmail.com");

                mail.From = new MailAddress("alvaro.emparan@gmail.com");
                mail.To.Add(mailrepositorio);
                mail.Subject = asuntomail;

                mail.IsBodyHtml = true;
                string htmlBody;

                htmlBody = "<table align='center' width='100%' style='background-color:#8e8ad8; color:#666;'><tr><td>";
                htmlBody += "<table align='left' width='468px'><tr><td align='left'>";
                htmlBody += "<img src='http://media.chileautos.cl/images/logotipos/logo_chilemedia.png' height='10px' style='height:10px; text-align:left;' />";
                //htmlBody += "<h2>Entrega de informe de patente número " + txtPatente.Text + "</h2>";
                htmlBody += "</td></tr></table>";
                htmlBody += "<table align='center' width='680px' style='background-color:#fff; padding:10px; border-radius:4px;'><tr><td>";
                htmlBody += "<h3>Estimado " + IdNombre.Text + " " + IdApellido.Text + "</h3>";
                htmlBody += "<p>Chileautos ha confirmado su pago vía webpay. Adjuntamos un enlace, donde podrá descargar el informe solicitado.</p>";
                htmlBody += "<a href='#'>Descargar informe aquí</a>";
                htmlBody += "<br /><br />";
                htmlBody += "<table align='center' width='680px'><tr><td align='left'>";
                htmlBody += "<span> Gracias por usar nuestra AppWeb de informes. <br /><br />Saluda<br /> Equipo Chileautos</span>";
                htmlBody += "</td></tr></table>";
                htmlBody += "</td></tr></table>";
                htmlBody += "<table align='center' width='680px'><tr><td align='center'>";
                htmlBody += "<span style='font-size:10px;'><a href='http://www.chileautos.cl/'>www.Chileautos.cl</a> -  Chileautos Limitada Huérfanos 1178 Oficina 221, Santiago, Chile Teléfono (56 2) 2688 4836 - Fax (56 2) 2671 5517 - Email <a href='mailto:info@chileautos.cl'>info@chileautos.cl</a> - Todo el material contenido en estas páginas pertenece a Chileautos.cl®. Prohibida su reproducción total o parcial sin previa autorización.</span>";
                htmlBody += "</td></tr></table>";
                htmlBody += "</td></tr></table>";


                mail.Body = htmlBody;

                SmtpServer.Port = 25;
                SmtpServer.Credentials = new System.Net.NetworkCredential("alvaro.emparan@gmail.com", "zajhae22");
                SmtpServer.EnableSsl = true;

                //string url = HttpContext.Current.Request.Url.AbsoluteUri;

                //Response.Redirect(url + "#contacto");

                SmtpServer.Send(mail);

                Prova.Value = "true";

                ResetAllControls(this);

            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.ToString());
            }

        }

        public static void ResetAllControls(Control form)
        {
            foreach (Control control in form.Controls)
            {
                if (control is TextBox)
                {
                    TextBox textBox = (TextBox)control;
                    textBox.Text = null;
                }

                //if (control is ComboBox)
                //{
                //    ComboBox comboBox = (ComboBox)control;
                //    if (comboBox.Items.Count > 0)
                //        comboBox.SelectedIndex = 0;
                //}

                if (control is CheckBox)
                {
                    CheckBox checkBox = (CheckBox)control;
                    checkBox.Checked = false;
                }

                //if (control is ListBox)
                //{
                //    ListBox listBox = (ListBox)control;
                //    listBox.ClearSelected();
                //}
            }
        } 

    }



}