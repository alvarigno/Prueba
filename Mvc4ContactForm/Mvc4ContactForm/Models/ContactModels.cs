using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.ComponentModel.DataAnnotations;
namespace Mvc4ContactForm.Models
{
    public class ContactModels
    {

        public string Nombre { get; set; }

        public string Apellido { get; set; }

        public string Email { get; set; }

        public string Comentario { get; set; }

        public string destinatario { get; set;  }
    }
}