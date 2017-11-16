using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Html5Guide
{
    /// <summary>
    /// UploadHandler 的摘要说明
    /// </summary>
    public class UploadHandler : IHttpHandler
    {

        public void ProcessRequest(HttpContext context)
        {
            int count = context.Request.Files.Count;
            context.Response.Write("{\"total\":\"" + count + "\"}");
        }

        public bool IsReusable
        {
            get
            {
                return false;
            }
        }
    }
}