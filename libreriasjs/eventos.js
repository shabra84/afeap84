/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

contrario = true;


/**
 * 
 * @param {type} i
 * @returns {undefined}
 * 
 */
function mensajedeevento(i){
  
    try {
        
        //contenedor de info del evento
        div = document.getElementById("evento"+i);
        
        div.style.display = "none";
        

        if(contrario){
          div.style.display = "block";
        }
        
    }
    catch(err) {

    }

  //cambiamos al contrario
  contrario = !contrario;
}

$(document).ready(function(){
 
    //tope de dias
    dimension = 31;
    
    
    
    for(i=1;i<=dimension;i++){
   
        //ocultamos todos los eventos
        $("#evento"+i).css("display","none");
        
        //le pongo un evento
        $("#"+i).attr("onclick", "mensajedeevento("+i+");");
    } 
});

