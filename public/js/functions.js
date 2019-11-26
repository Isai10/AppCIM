

var texto="";


btnPrev = document.getElementById('button-prev');
if(btnPrev!=null)
{
btnPrev.addEventListener('click', evento=> {
    var inputUrl = document.getElementById('urlPage');
    inputUrl.value = evento.target.href;
    document.getElementById('form-resp').submit();
    console.log(evento);
});
}
btnNext = document.getElementById('button-next');
if(btnNext!=null)
{
btnNext.addEventListener('click', evento=> {
    var inputUrl = document.getElementById('urlPage');
    inputUrl.value = evento.target.href;
    document.getElementById('form-resp').submit();
    console.log(evento);
});
}

btnFin = document.getElementById('button-fin');
if(btnFin!=null)
{
    btnFin.addEventListener('click', evento=> {
    var inputUrl = document.getElementById('urlPage');
    inputUrl.value = evento.target.href;
    document.getElementById('form-resp').submit();
    console.log(evento);
});
}

function CrearInputRespRelleno()
{
    const buttonAdd = document.querySelector('.resp-relleno');
    

        buttonAdd.addEventListener('click', evento=> {
        console.log(evento);

            const contenido = document.querySelector('.cont-resp-relleno');
                texto.push
                contenido.innerHTML=  
                 `
                <input type="text" class="form-control resp-relleno" placeholder="Respuesta de relleno" name = "resp-erronea">
                <div class="w-100"></div>
                `       
        });

}
//Inicializa y asocia eventos par cada boton de mostrar respuestas de pregunta
//function MuestraPreguntaCompleta(){
    var buttons = document.getElementsByClassName('button-ver-preg');
    for(let i = 0; i<buttons.length;i++)
    {
        buttons[i].addEventListener('mousedown', evento=> {
            evento.preventDefault();
            name_cont = 'cont-resp' + new String(evento.target.id);
            const idResp = evento.target.id;
            document.getElementById(name_cont).style.display ='inline';
        });
    }
//}
//Inicializa y asocia eventos par cada boton ocultar respuestas de pregunta
//function OcultaRespuestas()
//{
    var buttons = document.getElementsByClassName('button-hide-resp');
    for(let i = 0; i<buttons.length;i++)
    {
        buttons[i].addEventListener('click', evento=> {
            evento.preventDefault();
            name_cont = 'cont-resp' + new String(evento.target.id);
            const idResp = evento.target.id;
            document.getElementById(name_cont).style.display ='none';
            console.log(name_cont);
        });
    }
//}
function ActivarControlesOpcionMult()
{  
    const select = document.querySelector('.select-tipo-pregunta');
   
    select.addEventListener('click', evento=> {
        evento.preventDefault();
        if(evento.target.value == "opcion_multiple")
        {
            const contenido = document.querySelector('.opcionesExamenes');
            contenido.innerHTML=  
            `
            <div id = "op-multiple">
            <div class="row mb-4 " >
                            <div class="col ">
                                <input type="text" class="form-control border-0 " placeholder="Respuesta" name = "respuesta">
                            </div>
                        </div>
                        <div class="row mb-4">
                                <div class="col-md-8 ">
                                    <input type="text" class="form-control resp-relleno border-0  " placeholder="Respuesta de relleno" name = "resp_erronea1">
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-8 mt-2 ">
                                    <input type="text" class="form-control resp-relleno border-0  " placeholder="Respuesta de relleno(opcional)" name = "resp_erronea2">
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-8 mt-2">
                                     <input type="text" class="form-control resp-relleno border-0  " placeholder="Respuesta de relleno(opcional)" name = "resp_erronea3">
                                 </div>
                                 <div class="w-100"></div>
                                 <div class="col-md-8 mt-2">
                                     <input type="text" class="form-control resp-relleno border-0 " placeholder="Respuesta de relleno(opcional)" name = "resp_erronea4">
                                 </div>
                                

                                
                            </div>
                        <div class = "row mb-4 cont-resp-relleno">
                        </div>
            </div>
            `
        }
        else if(evento.target.value == "falso_verdadero"){
            console.log("Hola")
            
            const contenido = document.querySelector('.opcionesExamenes');
            contenido.innerHTML=  
            `
            <div id = "op-falso-verdadero " class = "mb-4">
            
                <div class="form-check form-check-inline">
                <input class="form-check-input border-0  " type="radio" name="bool" id="inlineRadio1" value="true">
                <label class="form-check-label" for="inlineRadio1">Falso</label>
                 </div>
                 <div class="form-check form-check-inline ">
                <input class="form-check-input border-0  " type="radio" name="bool" id="inlineRadio2" value="false">
                <label class="form-check-label" for="inlineRadio2">Verdadero</label>
                    </div>

            </div>
            `
        }
        else{
            const contenido = document.querySelector('.opcionesExamenes');
            contenido.innerHTML=  "";
        }
    });
}

function ActivarControlesAct(){		
    const select = document.querySelector('.select');
   
    select.addEventListener('click', evento=> {
        evento.preventDefault();
        if(evento.target.value == "examen")
        {
            const contenido = document.querySelector('.actividadControles');
            contenido.innerHTML=  
            `
            <div id= "exmaenDatosInput" class="mt-4" >
            
            <div class="row mb-4">
                <div class ="col">
                    <label for="descripcion">Descripcion:</label>
                    <textarea class="form-control" rows="4" id="descripcion" name = "descripcion"></textarea>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <select class="form-control"  placeholder="Tema" name = "id_tema">
                        <option disabled selected>Tema</option>
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="mercedes">Mercedes</option>
                        <option value="audi">Audi</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                    <div class="col">
                            <div class="form-group">
                        <label for="fecha" class="form-text text-muted">Fecha de examen</label>
                        <input type="date" name="fecha"  class="form-control" >
                        </div>
                    </div>
            </div>
            <div class="row mb-4">
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="hora_inicio" class="form-text text-muted">Hora de inicio</label>
                        <input type="time"  value="10:45:00"class="form-control" name ="hora_inicio">
                        </div>
                    </div>
                    <div class="col-sm-6">
                            <div class="form-group">
                            <label for="hora_fin" class="form-text text-muted">Hora de cierre</label>
                            <input type="time" value="11:45:00" class="form-control" name ="hora_fin">
                            </div>
                    </div>
            </div> 
            </div>`
        }
        else{
          //  var exmaenDatosInput = document.getElementById("exmaenDatosInput");
          //  exmaenDatosInput.style.display = "none";
            const contenido = document.querySelector('.actividadControles');
            contenido.innerHTML= 
            `
            <div id= "tareaDatosInput" class="mt-4" >
            
            <div class="row mb-4">
                <div class ="col">
                    <label for="descripcion">Descripcion de la tarea:</label>
                    <textarea class="form-control" rows="4" id="descripcion" name = "descripcion"></textarea>
                </div>
            </div>
            <div class="row mb-4">
                    <div class="col">
                            <div class="form-group">
                        <label for="fecha" class="form-text text-muted">Fecha limite de carga</label>
                        <input type="date" name="fecha"  class="form-control" >
                        </div>
                    </div>
            </div>
                <div class="row mb-4">
                    <div class="col-sm-6">
                            <div class="form-group">
                            <label for="hora_fin" class="form-text text-muted">Hora de cierre</label>
                            <input type="time" value="11:45:00" class="form-control" name ="hora_fin">
                            </div>
                    </div>
                </div> 
            </div>`
        }
    });
    
   /* var controlesExamen = document.getElementById("examenItems");		
    controlesExamen.style.display = "block";*/

    return true;
}