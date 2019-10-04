
<br><br>
<div class ="container   bg-light p-3 rounded-lg">
        @php
            $numCursos = 4
        @endphp
        <div class = "row">
                @for ($i = 0; $i < $numCursos ; $i++)  
                <div class="card mb-auto m-2 bd-highlight m-1 text-center col-sm shadow-sm border-0" style="width: 18rem;">  
                        <div class="card-body">
                                <h5 class="card-title">Nombre del curso</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Profesor del curso</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="{{route('cursoAlumno')}}" class="btn btn-info">Ver curso</a>
                        </div>
                </div>
                @endfor
        </div>
        <div class = "row">
                @for ($i = 0; $i < $numCursos ; $i++)  
                <div class="card mb-auto m-2 bd-highlight m-1 text-center col-sm shadow-sm border-0" style="width: 18rem;">  
                        <div class="card-body">
                                <h5 class="card-title">Nombre del curso</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Profesor del curso</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="{{route('cursoAlumno')}}" class="btn btn-info">Ver curso</a>
                        </div>
                </div>
                @endfor
        </div>
        <div class = "row">
                @for ($i = 0; $i < $numCursos ; $i++)
                @if ($i < $numCursos-1)
                <div class="card mb-auto m-2 bd-highlight m-1 text-center col-sm shadow-sm border-0" style="width: 18rem;">  
                        <div class="card-body">
                                <h5 class="card-title">Nombre del curso</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Profesor del curso</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="{{route('cursoAlumno')}}" class="btn btn-info">Ver curso</a>
                        </div>
                </div>
                @else
                <div class="card mb-auto m-2 bd-highlight m-1 text-center col-sm shadow-sm border-0" style="width: 18rem;">  
                    <br><br><br>
                        <div class="card-body">
                                <a href="#" class="btn btn-success">Agregar curso</a>
                        </div>
                        <br><br><br><br>
                </div> 
                @endif
               
                
                    
               
                @endfor
        </div>
       
       

        
</div>
<br><br>      
