<template>


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
<!--
            <formmesa-component @new="addThought"></formmesa-component>

            <listamesa-component
                v-for="(ventas_has_producto, index) in ventas_has_producto"
                :key="ventas_has_producto.id"
                :thought="ventas_has_producto"
                @update="update_ventas_has_producto(index, ...arguments)"
                @delete="delete_ventas_has_producto(index)">
            </listamesa-component> 
--> 
        
        
        
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                ventas_has_producto: []
            }
        },
        mounted() {
            axios.get('ventas').then((response) => {
                this.ventas_has_producto = response.data;
            });
            axios.get('productos_all').then((response) => {
                this.productos_all = response.data;
            });
           
        },
        methods: {
            addThought(thought) {
                this.thoughts.push(thought);
            },
            update_ventas_has_producto(index, thought) {
                this.thoughts[index] = thought;
            },
            delete_ventas_has_producto(index) {
                this.thoughts.splice(index, 1);
            }
        }
    }
</script>