using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.ComponentModel.DataAnnotations;

namespace WebAppCRUD.Models
{
    public class Persona
    {
        [Display (Name = "idTasa")]
        public int idTasa
        {

            get;
            set;
        }
        [Display(Name = "nombre")]
        public string nombre
        {

            get;
            set;
        }
        [Display(Name = "apellido")]
        public string apellido
        {

            get;
            set;
        }

    }
}
