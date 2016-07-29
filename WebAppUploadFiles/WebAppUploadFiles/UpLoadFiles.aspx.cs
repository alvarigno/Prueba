using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace WebAppUploadFiles
{
    public partial class UpLoadFiles : Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            Button1.Click += new EventHandler(Button1_Click);
        }

        void Button1_Click(object sender, EventArgs e)
        {
           
            byte[] bytearray = null;
            string name = "";
            //throw new NotImplementedException();
            if (FileUpload1.HasFile)
            {
                name = FileUpload1.FileName;
                Stream stream = FileUpload1.FileContent;
                stream.Seek(0, SeekOrigin.Begin);
                bytearray = new byte[stream.Length];
                int count = 0;
                while (count < stream.Length)
                {
                    bytearray[count++] = Convert.ToByte(stream.ReadByte());
                }

            }

            string baseAddress = "http://" + Environment.MachineName + ":9090/ServiceUpLoadFiles.svc/UploadFile/";
            //string baseAddress = "http://172.16.0.103:9090/ServiceUpLoadFiles.svc/UploadFile/";
            string sitio = "1";
            HttpWebRequest request = (HttpWebRequest)HttpWebRequest.Create(baseAddress + name + "/" + sitio);
            request.Method = "POST";
            request.ContentType = "text/plain";
            Stream serverStream = request.GetRequestStream();
            serverStream.Write(bytearray, 0, bytearray.Length);
            serverStream.Close();
            using (HttpWebResponse response = request.GetResponse() as HttpWebResponse)
            {
                int statusCode = (int)response.StatusCode;
                StreamReader reader = new StreamReader(response.GetResponseStream());
                String datarespuesta = response.StatusDescription;
                IdStatus.Text = datarespuesta;
            }

        }

    }
}