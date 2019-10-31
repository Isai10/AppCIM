var texto="";
function CrearPregRellTemp()
{
    const buttonAdd = document.querySelector('.preg-relleno');
    
    

        buttonAdd.addEventListener('click', evento=> {
            const contenido = document.querySelector('.cont-resp-relleno');
                texto.push
                contenido.innerHTML=  
                `
                <div class = "row ml-2 mr-1 mt-1">
                <ul class="list-group list-group-horizontal  border-0  col ">
                        <li class="list-group-item border-0 "><h6 class = "font-weight-bold text-left"> ${texto}</h5></li>
                </ul>
                <div class="w-100"></div>
                </div>
            
                `
        });

}

function LeerInputText()
{
    const respRelleno = document.querySelector('.resp-relleno');
    respRelleno.addEventListener('keydown', evento=> {
       texto = evento.target.value.toString();
    });
}
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
                                <input type="text" class="form-control" placeholder="Respuesta" name = "respuesta">
                            </div>
                        </div>
                        <div class="row mb-4">
                                <div class="col-md-8 ">
                                    <input type="text" class="form-control resp-relleno" placeholder="Respuesta de relleno" name = "resp-erroneas" onkeydown="LeerInputText();" >
                                </div>
                                <div class = "col">
                                        <a href = "#"  class="btn btn btn-light preg-relleno" onclick="CrearPregRellTemp();">
                                               +
                                        </a>
                                </div>
                                <div class="cont-resp-relleno">
                                </div>
                                
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
                <input class="form-check-input " type="radio" name="bool" id="inlineRadio1" value="true">
                <label class="form-check-label" for="inlineRadio1">Falso</label>
                 </div>
                 <div class="form-check form-check-inline ">
                <input class="form-check-input" type="radio" name="bool" id="inlineRadio2" value="false">
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
            var exmaenDatosInput = document.getElementById("exmaenDatosInput");
            exmaenDatosInput.style.display = "none";
            
        }
    });
    
   /* var controlesExamen = document.getElementById("examenItems");		
    controlesExamen.style.display = "block";*/

    return true;
}