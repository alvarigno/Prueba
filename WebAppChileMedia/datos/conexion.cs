using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

using System.Xml.Linq; 
using MongoDB.Bson; 
using MongoDB.Driver; 
using Newtonsoft.Json; 
using Newtonsoft.Json.Linq;
using MongoDB.Driver.Builders;


namespace datos
{
    public class conexion
    {
        public Array[] collection;
        public string db;

            MongoServer mongo = MongoServer.Create();
            mongo.Connect(); 

            db = mongo.GetDatabase("DBchilemedia");

            using (mongo.RequestStart(db)) 
            { 
                collection = db.GetCollection<BsonDocument>("prueba");

            }

            } 
    }
}