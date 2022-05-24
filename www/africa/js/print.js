jQuery.fn.print = function(){

            var printContent = document.getElementById(66);
            var windowUrl = 'about:blank';
            var uniqueName = new Date();
            var windowName = 'Impresion' + uniqueName.getTime();
            
            printWindow = window.open(windowUrl, windowName, "left=0,top=0,width=800,height=600");
            var strContent = "<html><head>"; // If you use this script inside <head> on the page, there might be error. So keep inside body (becaue of <head>)
            strContent = strContent + "<title>Print Preview</title>";
            
            strContent = strContent + "</head><body>";
            strContent = strContent + this.html();
            strContent = strContent + "</body><script>window.print()</script>";
            printWindow.document.write(strContent);
            printWindow.document.close();
            printWindow.focus();

}