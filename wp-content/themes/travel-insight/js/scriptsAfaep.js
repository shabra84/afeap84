function evento(x) {
  	x.firstChild.style.display = "block";
}

function eventoFuera(x) {
  	x.firstChild.style.display = "none";
}


jQuery(document).ready(function($){



var flag = true;
var flag2 = true;

        $("#menu-item-150").click(function(){
        if(flag)
              $("#menu-item-150 .sub-menu").css("display","block");
        else
              $("#menu-item-150 .sub-menu").css("display","none");

        flag = !flag;

        });

        $("#menu-item-192").click(function(){
        if(flag2)
              $("#menu-item-192 .sub-menu").css("display","block");
        else
              $("#menu-item-192 .sub-menu").css("display","none");

        flag2 = !flag2;

        });

	$("#menu-item-150 > a").removeAttr("href");
        $("#menu-item-192 > a").removeAttr("href");


        $("#calendar-9").css("display","none");
        
        //alto para las vistas que no son el home
        $("#breadcrumb-list").css("height","379px");

/*ESTO HAY QUE CAMBIARLO CUANDO SE CUELGUE EN EL SERVIDOR!!!*/
    var url = "http://127.0.0.1/afeap84/";
    if(location.href==url){

            $("#divevento").css("display","none");
            $("#colophon").css("margin-top","131px");

            //arreglo margen y alto en la vista principal
            $(".wrapper.page-section.no-padding-bottom").css("margin-top","-15%");



        var ancho = $(window).width();

        //varia el margen dependiendo de la resolución
        if(ancho<=768){
            $("#content").removeAttr("style");
            $("#content").css("margin-top","14%");
        }
        else{
            $("#content").removeAttr("style");
            /*$("#content").css("margin-top","5%");*/
         }
            $("#calendar-9").css("display","block");

    }


});