@extends('layouts.base_html')
@section('tittle') CONFIGURACIÓN @endsection 


@section('body')
<div class="row">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
        PERMISOS
        </h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4 style="color:gray;font-size:20px;">-Agregar permisos</h4>
        <hr style="color: orange;">
        <p>
        </p>
    </div>
</div>
<a type="button" class="btn btn-warning" href="{{url("/configuracion/listado")}}" style="color:white;">Listado de Usuarios</a>
<a type="button" class="btn btn-danger" href="#" onclick="savePermisos();"  style="color:white;">Guardar</a>
<form>
<hr style="color: orange;">
    <div class="form-row" >
        <div class="col-md-6" style="text-align:center">
        <select class="form-select" id="id_usuario" name="id_usuario" onchange="check_permisos(this.value);">
            <option value="0"selected required disabled >Seleccione usuario</option>
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
        </div>
    </div>
    <p></p>
    <div class="form-row">
        <div class="form-group">

            @foreach($pantallas as $pantalla)
                <div class="form-check">
                    <input type="checkbox" name="checkbox" class="form-check-input" id="{{$pantalla->id}}" value="{{$pantalla->id}}">
                    <label class="form-check-label">
                        {{$pantalla->nombre}}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

</form>

@endsection

@section('scripts')
<script>

    function resetChecked(){
        let checkbox = document.getElementsByName("checkbox");
        for (let i = 0; i < checkbox.length; i++) {
            checkbox[i].checked = false;
        }
    }

   var checkbox = document.querySelectorAll("input[type=checkbox]").forEach(checkbox=>{
        checkbox.addEventListener('change', async function() {
            if( document.getElementById("id_usuario").value == "0"){
            this.checked = false;
            alert("Favor de seleccionar usuario");
       }
        let url='{{url("/permisos")}}';
        form = new FormData();
        form.append('id_usuario', document.getElementById("id_usuario").value);
        form.append("id_pantalla",this.value);

        if (this.checked) {
            init = {
                method:'POST',
                body:form,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            }

            let req = await fetch(url,init);

            if (req.ok){
                let res = await req.json();
            }
            else{
                alert("permisos no guardados")
            }
            
        } 
        else {
            init = {
                method:'POST',
                body:form,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            }
            url = '{{url("/permisos/remove")}}'
            let req = await fetch(url,init);

        }
        
        });
    });

    
    async function check_permisos(id_usuario){
        resetChecked();
        url="{{url('permisos/{id_usuario}')}}".replace("{id_usuario}",id_usuario);
        init = {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            }
            let req = await fetch(url,init);
            let res = await req.json();
            res.forEach(element => {
                document.getElementById(element.id_pantalla).checked =true;
            });
            
        
    }
function savePermisos() {
    Swal.fire(
        'Permisos Actualizados',
        '',
        'success'
    ).then(()=>{
        window.location.href=("{{url("/")}}");
    });
}
</script>

@endsection