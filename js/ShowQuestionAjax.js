function mostrarpreguntas(){
	xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function()
        {
            if (this.readyState==4 && this.status==200)
            {
                (document.getElementById("preguntas").innerHTML=this.responseText); 
            }
        }
        xmlhttp.open("GET","ShowXmlQuestions.php",true);
        xmlhttp.send();

}