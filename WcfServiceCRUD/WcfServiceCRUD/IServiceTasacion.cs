using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.ServiceModel.Web;
using System.Text;

namespace WcfServiceCRUD
{
    // NOTE: You can use the "Rename" command on the "Refactor" menu to change the interface name "IServiceTasacion" in both code and config file together.
    [ServiceContract]
    public interface IServiceTasacion
    {
        //Find All data on base
        [OperationContract]
        [WebInvoke(Method ="GET", UriTemplate ="findall", ResponseFormat = WebMessageFormat.Json)]
        List<persona> findAll();

        //Find specific Data on base
        [OperationContract]
        [WebInvoke(Method = "GET", UriTemplate = "find/{id}", ResponseFormat = WebMessageFormat.Json)]
        persona find(string id);

        //Create data on base
        [OperationContract]
        [WebInvoke(Method = "POST", UriTemplate = "create", ResponseFormat = WebMessageFormat.Json, RequestFormat = WebMessageFormat.Json)]
        bool create(persona persona);

        //Edit data on base
        [OperationContract]
        [WebInvoke(Method = "PUT", UriTemplate = "edit", ResponseFormat = WebMessageFormat.Json, RequestFormat = WebMessageFormat.Json)]
        bool edit(persona persona);

        //Edit data on base
        [OperationContract]
        [WebInvoke(Method = "DELETE", UriTemplate = "delete", ResponseFormat = WebMessageFormat.Json, RequestFormat = WebMessageFormat.Json)]
        bool delete(persona persona);

    }
}
