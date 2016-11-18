using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using System.Net.Mail;
using Mvc4ContactForm.Models;
using System.Text;
using System.Net;

namespace Mvc4ContactForm.Controllers
{
    public class HomeController : Controller
    {
        public ActionResult Index()
        {
            ViewBag.Message = "Modify this template to jump-start your ASP.NET MVC application.";

            return View();
        }

        public ActionResult About()
        {
            ViewBag.Message = "Your app description page.";

            return View();
        }

        public ActionResult Contact()
        {
            ViewBag.Message = "Your contact page.";

            return View();
        }
        [HttpPost]
        public ActionResult Contact(ContactModels c)
        {
            if (ModelState.IsValid)
            {
                //try
                //{
                //    MailMessage msg = new MailMessage();
                //    //SmtpClient smtp = new SmtpClient();
                //    MailAddress from = new MailAddress(c.Email.ToString());
                //    StringBuilder sb = new StringBuilder();

                //    SmtpClient smtp = new SmtpClient();
                //    NetworkCredential basicCredential =
                //        new NetworkCredential("alvaro.emparan@gmail.com", "Zajhae@22");
                //    //MailMessage message = new MailMessage();
                //    //MailAddress fromAddress = new MailAddress("from@yourdomain.com");

                //    //smtp.Host = "mail.mydomain.com";
                //    smtp.UseDefaultCredentials = false;
                //    smtp.Credentials = basicCredential;


                //    msg.IsBodyHtml = false;
                //    smtp.Host = "smtp.google.com";
                //    smtp.Port = 587;
                //    msg.To.Add("alvaro.emparan@gmail.com");
                //    msg.From = from;
                //    msg.Subject = "Contact Us";
                //    sb.Append("First name: " + c.FirstName);
                //    sb.Append(Environment.NewLine);
                //    sb.Append("Last name: " + c.LastName);
                //    sb.Append(Environment.NewLine);
                //    sb.Append("Email: " + c.Email);
                //    sb.Append(Environment.NewLine);
                //    sb.Append("Comments: " + c.Comment);
                //    msg.Body = sb.ToString();
                //    smtp.Send(msg);
                //    msg.Dispose();
                //    return View("Success");
                //}
                //catch (Exception)
                //{
                //    return View("Error");
                //}

                SmtpClient smtpClient = new SmtpClient();
                NetworkCredential basicCredential =
                    new NetworkCredential("alvaro.emparan@gmail.com", "Marcelo@flores22");
                MailMessage message = new MailMessage();
                MailAddress fromAddress = new MailAddress("alvaro.emparan@gmail.com");
                StringBuilder sb = new StringBuilder();

                smtpClient.Host = "smtp.gmail.com";
                smtpClient.Port = 587;
                smtpClient.UseDefaultCredentials = false;
                smtpClient.Credentials = basicCredential;
                smtpClient.EnableSsl = true;

                message.From = fromAddress;
                message.Subject = "prueba";
                sb.Append("First name: " + c.Nombre);
                sb.Append(Environment.NewLine);
                sb.Append("Last name: " + c.Apellido);
                sb.Append(Environment.NewLine);
                sb.Append("Email: " + c.Email);
                sb.Append(Environment.NewLine);
                sb.Append("Comments: " + c.Comentario);
                sb.Append(Environment.NewLine);
                sb.Append("Destinatario: " + c.destinatario);
                //Set IsBodyHtml to true means you can send HTML email.
                message.IsBodyHtml = true;
                message.Body = sb.ToString();
                message.To.Add(c.destinatario);

                try
                {
                    smtpClient.Send(message);
                    message.Dispose();
                    return View("Success");
                }
                catch (Exception ex)
                {
                    //Error, could not send the message
                    Response.Write(ex.Message);
                    return View("Error");
                }


            }
            return View();
        }
    }
}
