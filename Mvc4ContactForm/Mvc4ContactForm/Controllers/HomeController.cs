using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using System.Net.Mail;
using Mvc4ContactForm.Models;
using System.Text;
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
                try
                {
                    MailMessage msg = new MailMessage();
                    SmtpClient smtp = new SmtpClient();
                    MailAddress from = new MailAddress(c.Email.ToString());
                    StringBuilder sb = new StringBuilder();
                    msg.IsBodyHtml = false;
                    smtp.Host = "mail.yourdomain.com";
                    smtp.Port = 25;
                    msg.To.Add("youremail@email.com");
                    msg.From = from;
                    msg.Subject = "Contact Us";
                    sb.Append("First name: " + c.FirstName);
                    sb.Append(Environment.NewLine);
                    sb.Append("Last name: " + c.LastName);
                    sb.Append(Environment.NewLine);
                    sb.Append("Email: " + c.Email);
                    sb.Append(Environment.NewLine);
                    sb.Append("Comments: " + c.Comment);
                    msg.Body = sb.ToString();
                    smtp.Send(msg);
                    msg.Dispose();
                    return View("Success");
                }
                catch (Exception)
                {
                    return View("Error");
                }
            }
            return View();
        }
    }
}
