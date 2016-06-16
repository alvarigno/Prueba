using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.ServiceModel.Web;
using System.Text;
using System.IO;
using System.Web.Script.Serialization;
using System.Data;

namespace WcfServiceCRUD
{
    // NOTE: You can use the "Rename" command on the "Refactor" menu to change the class name "ServiceTasacion" in code, svc and config file together.
    // NOTE: In order to launch WCF Test Client for testing this service, please select ServiceTasacion.svc or ServiceTasacion.svc.cs at the Solution Explorer and start debugging.
    public class ServiceTasacion : IServiceTasacion
    {
        public bool create(persona persona)
        {

            using (Tasacion2016Entities mde = new Tasacion2016Entities())
            {

                try {

                    persona pe = new persona();
                    pe.nombre = persona.nombre;
                    pe.apellido = persona.apellido;
                    mde.personas.Add(pe);
                    mde.SaveChanges();
                    return true;

                } catch {
                    return false;
                }

            };

        }

        public bool delete(persona persona)
        {
            using (Tasacion2016Entities mde = new Tasacion2016Entities())
            {

                try
                {
                    int nid = Convert.ToInt32(persona.idTasa);
                    persona pe = mde.personas.Single(p => p.idTasa == nid);
                    mde.personas.Remove(pe);
                    mde.SaveChanges();
                    return true;

                }
                catch
                {
                    return false;
                }

            };
        }

        public bool edit(persona persona)
        {
            using (Tasacion2016Entities mde = new Tasacion2016Entities())
            {

                try
                {
                    int nid = Convert.ToInt32(persona.idTasa);
                    persona pe = mde.personas.Single(p => p.idTasa == nid);
                    pe.nombre = persona.nombre;
                    pe.apellido = persona.apellido;
                    mde.SaveChanges();
                    return true;

                }
                catch
                {
                    return false;
                }

            };
        }

        public List<persona> findAll() {

            List<persona> resultados4 = new List<persona>();
            Tasacion2016Entities mde = new Tasacion2016Entities();
            
            foreach (persona two3 in mde.personas)
            {

                resultados4.Add(new persona()
                {

                    nombre = two3.nombre,
                    apellido = two3.apellido,
                    idTasa = two3.idTasa

                });

            }

            return resultados4;

        }

        public persona find(string id) {

            int nidTasa = Convert.ToInt32(id);
            persona resultados = new persona();
            Tasacion2016Entities mde = new Tasacion2016Entities();

            foreach (persona two in mde.personas.Where(pe => pe.idTasa == nidTasa))
            {

                resultados.idTasa = two.idTasa;
                resultados.nombre = two.nombre;
                resultados.apellido = two.apellido;

            }

            return resultados;

        }

        public void DoWork()
        {
        }

    }
}
