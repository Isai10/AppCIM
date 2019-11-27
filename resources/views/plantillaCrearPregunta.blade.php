

<div class = "container p-4   mt-5 shadow-sm rounded-lg bg-white" style="width: 25rem;">
        <form action="{{route('curso.actividad.examen.pregunta.crear',['idExam'=>$examen['idExamen'],'tipo'=>$tipo])}}" method="POST">
                @csrf
                <div class="">
                       
                      <h1 class = "mt-1 h5 mb-4 pb-2 border-bottom text-muted text-center"><strong>Pregunta</strong></h1>
                    </div>  
            <div class="row mb-4">
                <div class="col">
                    <textarea type="text" name="pregunta" rows = "3"class="form-control border-0  "  placeholder="Enunciado pregunta"></textarea>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <select class="form-control select-tipo-pregunta border-0  " placeholder="Tipo"  name = "tipo" onclick="ActivarControlesOpcionMult();">
                        <option disabled selected >Tipo</option>
                        <option value="opcion_multiple">Opcion multiple</option>
                        <!--<option value="abierta">Abierta</option>-->
                        <option value="falso_verdadero">Falso o verdadero</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <select class="form-control select-valor border-0  " placeholder="Valor"  name = "valor">
                        <option disabled selected >Valor en puntos</option>
                        <option value="01.00">1.0 puntos</option>
                        <option value="01.50">1.5 puntos</option>
                        <option value="02.00">2.0 puntos</option>
                        <option value="02.50">2.5 puntos</option>
                        <option value="03.00">3.0 puntos</option>
                        <option value="03.50">3.5 puntos</option>
                        <option value="04.00">4.0 puntos</option>
                        <option value="04.50">4.5 puntos</option>
                        <option value="05.00">5.0 puntos</option>
                        <option value="05.50">5.5 puntos</option>
                        <option value="06.00">6.0 puntos</option>
                        <option value="06.50">6.5 puntos</option>
                        <option value="07.00">7.0 puntos</option>
                        <option value="07.50">7.5 puntos</option>
                        <option value="08.00">8.0 puntos</option>
                        <option value="08.50">8.5 puntos</option>
                         <option value="09.00">9.0 puntos</option>
                        <option value="09.50">9.5 puntos</option>
                        <option value="10.00">10.0 puntos</option>
                    </select>
                </div>
            </div>

            <div class="opcionesExamenes" >
                    
            </div>
           
            <button type="submit" class="btn btn-primary btn-block">Crear</button>
        </form>
        </div>