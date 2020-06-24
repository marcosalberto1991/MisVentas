<template>

<div class=''>
        
    <div class='col-lg-4 card mesa'>
        <!--
            -->
        
        <blockquote class='mesa blockquote mb-0'>
        <div class='card-header'>nombre</div>
        <div class='card-body'>
            <table class='table table-striped table-bordered table-hover compact nowrap'>
                <tr>
                    <th>Productos</th>
                    <th>precios</th>
                    <th>Cantidad</th>
                    <th>Operaciones</th>
                </tr>
                <tr>
                    <td>coca cola</td>
                    <td>$2300</td> 
                    <td>3</td>
                    <td>
                        <button type='button' class='btn btn-outline-danger'>Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <th>Total</th>
                    <th>$2300</th>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            
        </div>
        <div class='form-group row'>
            <div class='col-lg-6'>
                <label class='control-label' for='descripcion'>nombre:</label>
                <input type='text' name='nombre' class='form-control'   required='required' autofocus/>
                <p class='errornombre text-center alert alert-danger d-none'></p>
            </div>
            <div class='col-lg-2'>
                <label class='control-label' for='descripcion'>cantidad:</label>
                <input type='number' name='cantida' class='form-control' value='1' required='required' autofocus/>
                <p class='errornombre text-center alert alert-danger d-none'></p>
            </div>
            <div class='col-lg-3'>
                <label class='control-label' for='descripcion'> </label>
                <input type='submit' value='Añadir' class='boton_add form-control btn btn-info ' name='como'/>
            </div>
        </div>
        <!--
    -->
        </blockquote>

    </div>
</div>
   
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>