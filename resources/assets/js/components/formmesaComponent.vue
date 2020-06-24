<template>
     <div class='col-lg-4 card mesa'>
        <div class='form-group '>
            <form action="" v-on:submit.prevent="newproducto()">
                <div class='col-lg-6'>
                    <label class='control-label' for='descripcion'>Producto:</label>
                    <input type='text' name='producto' class='form-control'   required='required' v-model="producto" 
                    autofocus/>
                    <p class='errornombre text-center alert alert-danger d-none'></p>
                </div>
                <div class='col-lg-2'>
                    <label class='control-label' for='descripcion'>cantidad:</label>
                    <input type='number' name='cantidad' class='form-control' value='1' required='required' v-model="cantidad" 
                    autofocus/>
                    <p class='errornombre text-center alert alert-danger d-none'></p>
                </div>
                <div class='col-lg-3'>
                    <label class='control-label' for='descripcion'> </label>
                    <input type='submit' value='Añadir' class='boton_add form-control btn btn-info ' name='como'/>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                description: ''
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            newThought() {
                const params = {
                    description: this.description
                };
                this.description = '';
                axios.post('thoughts', params)
                    .then((response) => {
                        const thought = response.data;
                        this.$emit('new', thought);
                    });
            }
        }
    }
</script>