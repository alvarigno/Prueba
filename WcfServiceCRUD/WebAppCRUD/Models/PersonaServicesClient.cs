using System.Collections.Generic;
using System.Text;
using System.Net;
using System.Web.Script.Serialization;
using System.Runtime.Serialization.Json;
using System.IO;

namespace WebAppCRUD.Models
{
    public class PersonaServicesClient
    {
        private string URL_BASE = "http://localhost:54297/ServiceTasacion.svc/";

        public List<Persona> findAll() {

            try {

                //WebClient wc = new WebClient();
                //string json = URL_BASE + "findAll";

                //WebClient client = new WebClient();
                //string json = client.DownloadString(URL_BASE);

                //var js = new JavaScriptSerializer();
                //return js.Deserialize<List<Persona>>(json + "findall");

                using (WebClient wc = new WebClient())
                {

                    string HtmlResult = wc.DownloadString(URL_BASE + "findall");
                    var js = new JavaScriptSerializer();
                    return js.Deserialize<List<Persona>>(HtmlResult);

                }


            } catch {

                return null;

            }

        }

        public Persona find(string id)
        {
            try
            {

                //var webClient = new WebClient();
                //string URL = string.Format(URL_BASE + "find/{0}", id);
                //var json = webClient.DownloadString(URL);
                //var javascriptjson = new JavaScriptSerializer();
                //return javascriptjson.Deserialize<Persona>(json);


                using (WebClient wc = new WebClient())
                {

                    //string HtmlResult = string.Format(URL_BASE + "find/{0}", id);
                    string HtmlResult = wc.DownloadString(URL_BASE + "find/"+ id);
                    var js = new JavaScriptSerializer();
                    return js.Deserialize<Persona>(HtmlResult);

                }


              }
            catch
            {

                return null;

            }

        }

        public bool create(Persona persona)
        {
            try
            {

                DataContractJsonSerializer ser = new DataContractJsonSerializer(typeof (Persona));
                MemoryStream mem = new MemoryStream();
                ser.WriteObject(mem, persona);
                string data = Encoding.UTF8.GetString(mem.ToArray(), 0, (int)mem.Length);
                WebClient webClient = new WebClient();
                webClient.Headers["Content-type"] = "application/json" ;
                webClient.Encoding = Encoding.UTF8;
                webClient.UploadString(URL_BASE + "create", "POST", data);
                return true;

            }
            catch
            {

                return false;

            }

        }

        public bool edit(Persona persona)
        {
            try
            {

                DataContractJsonSerializer ser = new DataContractJsonSerializer(typeof(Persona));
                MemoryStream mem = new MemoryStream();
                ser.WriteObject(mem, persona);
                string data = Encoding.UTF8.GetString(mem.ToArray(), 0, (int)mem.Length);
                WebClient webClient = new WebClient();
                webClient.Headers["Content-type"] = "application/json";
                webClient.Encoding = Encoding.UTF8;
                webClient.UploadString(URL_BASE + "edit", "PUT", data);
                return true;

            }
            catch
            {

                return false;

            }

        }

        public bool delete(Persona persona)
        {
            try
            {

                DataContractJsonSerializer ser = new DataContractJsonSerializer(typeof(Persona));
                MemoryStream mem = new MemoryStream();
                ser.WriteObject(mem, persona);
                string data = Encoding.UTF8.GetString(mem.ToArray(), 0, (int)mem.Length);
                WebClient webClient = new WebClient();
                webClient.Headers["Content-type"] = "application/json";
                webClient.Encoding = Encoding.UTF8;
                webClient.UploadString(URL_BASE + "delete", "DELETE", data);
                return true;

            }
            catch
            {

                return false;

            }

        }


    }
}
