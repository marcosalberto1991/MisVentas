<template>
    <div class="">
        <div class='col-lg-6 card mesa'>
            <blockquote class='mesa blockquote mb-0'>
            <div class='card-header'>{{ thought.mesa_id_pk.nombre }}</div>
            <div class='card-body'>
                
                <table class='table table-striped table-bordered table-hover compact nowrap'>
                    <tr>
                        <th>Productos</th>
                        <th>precios</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                   <tr v-for="data in thought.ventas_has_producto_all " v-bind:key="data.id">

                        <td>{{data.producto_id_pk.nombre}}</td>
                        <td>{{data.producto_id_pk.precio_venta}}</td>
                        <td>{{data.cantidad}}</td>
                        <td>{{data.producto_id_pk.precio_venta*data.cantidad}}</td>
                    </tr>
                    
                    <tr>
                        <th>Total</th>
                        <th>$2300</th>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
                
            </div>
            <form action="" v-on:submit.prevent="newproducto()">
            <div class='form-group row'>
              
                <div class='col-lg-6'>
                    <label class='control-label' for='descripcion'>cantidad:</label>
                    <vue-single-select
                        v-on:keyup="autoComplete_2"
                        name="producto"
                        placeholder="producto"
                        you-want-to-select-a-post="ok"
                        v-model="thought.producto"
                        out-of-all-these-posts="makes sense"
                        :options="productos_all"
                        a-post-has-an-id="good for search and display"
                        the-post-has-a-title="make sure to show these"
                        option-label="nombre"
                        :required="true"
                    ></vue-single-select>
                    <!--option-key="id"-->
                </div>
                <!--
                <select v-model="selected_game">
                    <option v-for="productos_all in games" :value="game.id">{{game.nombre}}</option>
                </select>
                -->
                <div class='col-lg-2'>
                    <label class='control-label' for='descripcion'>cantidad:</label>
                    <input type='number' name='cantidad' class='form-control' value='1' required='required' autofocus v-model="thought.cantidad" />
                    <p class='errornombre text-center alert alert-danger d-none'></p>
                </div>
                <div class='col-lg-3'>
                    <button  class="btn btn-success" >
                        Añadir
                    </button>
                </div>
            </div>
            </form>
            </blockquote>

        </div>

    </div>
    
   
</template>


<script> 
    import VueSingleSelect from "vue-single-select";

    export default {
        props: ['thought','productos_all'],
        data() {

            return {
                
                editMode: false,
                query: '',
                results: [],
                productos_all:[]
                //thought.ventas_has_producto_all

            };
        },
        components: {
            VueSingleSelect
        },
        mounted() {
            //console.log('Component mounted.')
            axios.get('productos_all').then((response) => {
                this.productos_all = response.data;
            });
        },
        methods: {
            autoComplete(){
                this.results = [];
                if(this.query.length > 2){
                    axios.get('Lista_mesa/1',{params: {query: this.query}}).then(response => {
                        this.results = response.data;
                        //alert(this.results)
                    });
                };
            },
            autoComplete_2(){
                this.results = [];
                if(this.query.length > 2){
                    axios.get('Lista_mesa/1',{params: {query: this.query}}).then(response => {
                        this.results = response.data;
                        //alert(this.results)
                    });
                };
            },
            onClickDelete() {
                axios.delete(`ventas_has_producto/${this.thought.id}`).then(() => {
                    this.$emit('delete');
                });
            },
            onClickEdit() {
                this.editMode = true;
            },
            newproducto() { //añadir un nuevo productos
                const params = {
                    producto_id: this.thought.producto.id,
                    cantidad: this.thought.cantidad,
                    ventas_id: this.thought.id
                };
                //this.producto_id = '';
                //this.cantidad = '';
                //this.ventas_id = '';
                axios.post('ventas_has_producto', params)
                    .then((response) => {
                        const thought = response.data;
                        this.$emit('new', thought);
                        alert(thought);
                    });
                //this.thought.ventas_has_producto_all=[{this.thought.id,this.thought.producto.id,this.thought.cantidad}];
                

                

            },
            
            newproducto_no() {
                
                //alert(this.thought.id);
                const params = {
                    producto_id: this.thought.producto,
                    cantidad: this.thought.cantidad,
                    ventas_id: this.thought.id
                };
                axios.put(`ventas_has_producto/${this.thought.id}`, params).then((response) => {
                    //this.editMode = false;
                    const thought = response.data;
                    this.$emit('update', thought);
                });



                //this.editMode = true;
            },
            onClickUpdate() {
                const params = {
                    producto_id: this.thought.producto,
                    cantidad: this.thought.cantidad,
                    cantidad: this.thought.cantidad
                };
                axios.put(`ventas_has_producto/${this.thought.id}`, params).then((response) => {
                    this.editMode = false;
                    const thought = response.data;
                    this.$emit('update', thought);
                });
            }
           
        }
    }

</script>