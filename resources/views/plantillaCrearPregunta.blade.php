
<div class = "container p-4   mt-5 shadow-sm rounded-lg bg-white" style="width: 25rem;">
        <form >
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
                    <select class="form-control" placeholder="Tema" >
                        <option disabled selected>Tema</option>
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="mercedes">Mercedes</option>
                        <option value="audi">Audi</option>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-4">
                    <input type="text" class="form-control" placeholder="Día">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control" placeholder="Mes">
                 </div>
                 <div class="col-4">
                        <input type="text" class="form-control" placeholder="Año">
                </div>
            </div>
          <a href = "{{route('inicioSesion')}}"  class="btn btn-primary btn-block">
                Crear
               </a>
        </form>
        </div>