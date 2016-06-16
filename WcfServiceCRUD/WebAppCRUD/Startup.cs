using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(WebAppCRUD.Startup))]
namespace WebAppCRUD
{
    public partial class Startup
    {
        public void Configuration(IAppBuilder app)
        {
            ConfigureAuth(app);
        }
    }
}
