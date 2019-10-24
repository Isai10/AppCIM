

<div class = "container p-4    mt-5 shadow-sm rounded-lg bg-white" style="width: 25rem;">
        <form>
          <div>
            <h1 class = "mt-1 display-4 text-center">Crea Examen</h1>
          </div>  
          <br>
          
            <div class="row mb-4">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Título">
                </div>
                
            </div>
            
            
            <div class="row mb-4">
                <div class="col">
                    <select class="form-control"  placeholder="Tema" >
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
          <a href = "{{route('inicioSesion')}}"  class="btn btn-primary btn-block">
                Crear
               </a>
        </form>
        </div>