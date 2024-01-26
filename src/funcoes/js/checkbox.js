function checkboxConcluido(checkbox, $id) 
{
   if (checkbox.checked) {
         console.log('Checkbox marcado', $id);

         // Fazer uma solicitação AJAX para atualizar o banco de dados
         var xhttp = new XMLHttpRequest();
         xhttp.onreadystatechange = function() {
             if (this.readyState == 4 && this.status == 200) {
                 console.log(this.responseText);
             }
         };
         xhttp.open("POST", "./funcoes/js/concluido_if.php?id=" + $id, true);
         xhttp.send();      

         checkbox.setAttribute('checked', 'checked');
     } else {
       console.log('Checkbox desmarcado', $id);

       // Fazer uma nova solicitação AJAX para atualizar o banco de dados com os mesmos dados
       var xhttp = new XMLHttpRequest();
       xhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
               console.log(this.responseText);
           }
       };
       xhttp.open("POST", "./funcoes/js/concluido_else.php?id=" + $id, true);
       xhttp.send();

       checkbox.removeAttribute('checked');
     }
}

