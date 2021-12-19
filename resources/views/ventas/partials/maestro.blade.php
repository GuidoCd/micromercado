<div class="card card-custom">
    <div class="card-header bg-secondary">
            <div class="row">
                <div class="col-md-6">
                     <label for="razon_social"> Nombre:  </label>
                        
                         <select name="razon_social" id="razon_social" class="form-control form-control-sm" onchange="llenarNit()">
                              <option value="">-</option>
                              @foreach($auxiliares as $auxiliar)
                                    <option value="{{$auxiliar->nit}}">{{$auxiliar->razon_social}}</option>
                              @endforeach

                         </select>
                    
                </div>
           
                <div class="col-md-4"> 
                        <label for="nit"> Nit: </label> 
                        <input type="text" name="nit" id="nit" readonly class="form-control form-control-sm">
                 </div>
          
            </div>
    </div>

</div>
    
