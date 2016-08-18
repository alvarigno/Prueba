using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;

namespace ProcesaDocumentos
{
    public class myConnection
    {

        public static SqlConnection GetConnection()
        {
            string str = "Data Source=ALVARO-PC\\SQLEXPRESS; Initial Catalog = Procesarmails; User ID=jesus; Password=12345";
            //string str = "Data Source=10.0.0.158; Initial Catalog=bdmailparser;User ID=usdes; Password=Su_4320$.x";
            SqlConnection con = new SqlConnection(str);
            con.Open();
            return con;
        }

        private SqlConnection _con;


        public SqlConnection Conexion()
        {
            string str = "Data Source=ALVARO-PC\\SQLEXPRESS; Initial Catalog = Procesarmails; User ID=jesus; Password=12345";
            //string strCadenaConexion = ConfigurationManager.ConnectionStrings["bdMailParser"].ToString();

            _con = new SqlConnection(str);
            return _con;
        }


        public void Abrir()
        {
            _con.Open();

        }

        public void Cerrar()
        {
            _con.Close();
        }

    }
}