/*
  Creación de una función personalizada para jQuery que detecta cuando se detiene el scroll en la página
*/
$.fn.scrollEnd = function(callback, timeout) {
  $(this).scroll(function(){
    var $this = $(this);
    if ($this.data('scrollTimeout')) {
      clearTimeout($this.data('scrollTimeout'));
    }
    $this.data('scrollTimeout', setTimeout(callback,timeout));
  });
};
/*
  Función que inicializa el elemento Slider
*/

function inicializarSlider(){
  $("#rangoPrecio").ionRangeSlider({
    type: "double",
    grid: false,
    min: 0,
    max: 100000,
    from: 200,
    to: 80000,
    prefix: "$"
  });
}
/*
  Función que reproduce el video de fondo al hacer scroll, y deteiene la reproducción al detener el scroll
*/
function playVideoOnScroll(){
  var ultimoScroll = 0,
      intervalRewind;
  var video = document.getElementById('vidFondo');
  $(window)
    .scroll((event)=>{
      var scrollActual = $(window).scrollTop();
      if (scrollActual > ultimoScroll){
       video.play();
     } else {
        //this.rewind(1.0, video, intervalRewind);
        video.play();
     }
     ultimoScroll = scrollActual;
    })
    .scrollEnd(()=>{
      video.pause();
    }, 10)
}

inicializarSlider();
playVideoOnScroll();

$.get("server/caragarMenus.php", {menu: "Tipo"}, function (res){
  
    $("#selectTipo").append(res);
} );


$.get("server/caragarMenus.php", {menu: "Ciudad"}, function (res){
  
    $("#selectCiudad").append(res);
} );


$("#mostrarTodos").click(function() {

  filtro();

});
$("#formulario").submit(function(event) {
  event.preventDefault();
  var rango=$("#rangoPrecio").data("ionRangeSlider");
  
  filtro($("#selectCiudad").val(), $("#selectTipo").val(), rango.result.from , rango.result.to  );

});
function filtro (ciudad, tipo, rangoD, rangoH){ 
  if (!ciudad || ciudad== ""){ciudad="no";}
  if (!tipo || tipo == ""){tipo="no";}
  if (!rangoD){rangoD="no";}
  if (!rangoH){rangoH="no";}
  $("#resultados").html("");
  $.get('server/buscar.php', {Ciudad: ciudad, Tipo:tipo, rangod: rangoD, rangoh:rangoH},function(data) {
    console.log(data);

    var casa = JSON.parse (data);
    if (casa.mensaje){$("#resultados").html('<div class="col s12 blue ">'
                                              
                                                +casa.mensaje 
                                                
                                              +'</div>'
    )}else{
    for (var i = 0 ; i < casa.length; i++){      
      $("#resultados").append(''+
        '<div class="col s12 ">'
           +'<div class="card horizontal">'
            +'<div class="row">' 
            +'<div class="card-image col s4  ">'
              +'<img class="responsive-img" src="img/home.jpg">'
            +'</div>'
            +'<div class="card-stacked col s8">'
              +'<div class="card-content">'
                +'<p> <strong>Dirección: </strong>'+casa[i].Direccion+'</p>'
                 +'<p> <strong>Ciudad: </strong>'+casa[i].Ciudad+'</p>'
                 +'<p> <strong>Teléfono: </strong>'+casa[i].Telefono+'</p>'
                  +'<p> <strong>Codigo Postal: </strong>'+casa[i].Codigo_Postal+'</p>'
                   +'<p> <strong>Tipo: </strong>'+casa[i].Tipo+'</p>'
                    +'<p> <strong>Precio: </strong>'+casa[i].Precio+'</p>'
              +'</div>'
              +'<div class="card-action">'
                +'<a href="#">Ver más</a>'
              +'</div>'
            +'</div>'
          +'</div>'
          +'<div>'
        +'</div>');
    }
  }
   });
}