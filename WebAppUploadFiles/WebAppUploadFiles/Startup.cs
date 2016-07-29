using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(WebAppUploadFiles.Startup))]
namespace WebAppUploadFiles
{
    public partial class Startup {
        public void Configuration(IAppBuilder app) {
            ConfigureAuth(app);
        }
    }
}
