using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using WebAppCRUD.Models;
using WebAppCRUD.ViewModel;

namespace WebAppCRUD.Controllers
{
    public class PersonaController : Controller
    {

        public ActionResult Index()
        {
            PersonaServicesClient psc = new PersonaServicesClient();
            ViewBag.listPersonas = psc.findAll();
            return View();
        }

        [HttpGet]
        public ActionResult Create()
        {
            return View("Create");
        }

        [HttpPost]
        public ActionResult Create( PersonaViewModel npc)
        {
            PersonaServicesClient psc = new PersonaServicesClient();
            psc.create(npc.Persona);
            return RedirectToAction("index");
        }

        public ActionResult delete(string id)
        {

            PersonaServicesClient psc = new PersonaServicesClient();
            psc.delete(psc.find(id));
            return RedirectToAction("index");

        }

        [HttpGet]
        public ActionResult edit(string id)
        {

            PersonaServicesClient psc = new PersonaServicesClient();
            PersonaViewModel pvm = new PersonaViewModel();
            pvm.Persona = psc.find(id);
            return View("edit", pvm);

        }

        [HttpPost]
        public ActionResult edit( PersonaViewModel pvm)
        {

            PersonaServicesClient psc = new PersonaServicesClient();
            psc.edit(pvm.Persona);
            return RedirectToAction("index");

        }


    }
}