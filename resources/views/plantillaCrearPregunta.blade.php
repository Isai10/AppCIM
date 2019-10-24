
<div class = "container p-4   mt-5 shadow-sm rounded-lg bg-white" style="width: 25rem;">
        <form action="{{route('curso.actividad.examen.pregunta.crear',$examen['idExamen'])}}" method="POST">
                @csrf
                <div >
                       
                      <h1 class = "mt-1 h5 mb-3 text-muted">Crear pregunta</h1>
                    </div>  
            <div class="row mb-4">
                <div class="col">
                    <textarea type="text" name="pregunta" rows = "3"class="form-control" placeholder="Enunciado pregunta"></textarea>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <select class="form-control select-tipo-pregunta" placeholder="Tipo"  name = "tipo" onclick="ActivarControlesOpcionMult();">
                        <option disabled selected >Tipo</option>
                        <option value="opcion_multiple">Opcion multiple</option>
                        <option value="abierta">Abierta</option>
                        <option value="falso_verdadero">Falso o verdadero</option>
                    </select>
                </div>
            </div>
            

            <div class="opcionesExamenes" >
                    
            </div>
           
            <button type="submit" class="btn btn-primary btn-block">Crear</button>
        </form>
        </div>