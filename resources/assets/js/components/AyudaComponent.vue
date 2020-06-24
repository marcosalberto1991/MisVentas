<template>
    <div class="container">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Ejemplo de componates </div>
                    <div class="card-body">
                    <div>como esta tu</div> 
                        Yo soy un componete 2 en la cual .
                    </div>
                    <ul>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="/lang/es" ><b>Español</b></a>
                        </li>
                       
                    </ul>  
                </div>
            </div>
        <div class="row justify-content-center">
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
