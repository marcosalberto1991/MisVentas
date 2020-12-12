<template>
<div class="row">
    <div class="col-lg-12 ">
        <div class="main-card mb-3 card formulario">
            <div class="card-body">
                <h1 class="card-title"></h1>
                <h2>Formulario </h2>
                <div class="col-md-12 row">
                    <div class="form-group col-md-12 col-sm-12" style="margin-bottom: 6px;">
                        <button type="submit" @click="formulario()" class="btn btn-primary">Guardar </button>
                        <a class="btn btn-warning" @click="cancelar_registro()">Cancelar</a>
                    </div>
                </div>
                <div class="col-lg-12">

                    <form ref="form" v-on:submit.prevent="formulario()">
                        <div class="row">
                            <div class="col-md-12 row">
                                <input type="hidden" v-model="input_ListaProducto_id">

                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="exampleInputEmail1"><b>id</b></label>
                                    <input type="text" v-model="input_id" placeholder="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div class="invalid-feedback" style="display:block" v-for="data in validacion.id" v-bind:key="data.id">
                                        <b>{{data}}</b>
                                    </div>
                                </div>

                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="exampleInputEmail1"><b>orden</b></label>
                                    <input type="text" v-model="input_orden" placeholder="orden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div class="invalid-feedback" style="display:block" v-for="data in validacion.orden" v-bind:key="data.orden">
                                        <b>{{data}}</b>
                                    </div>
                                </div>

                                <div class="form-group col-md-3 col-sm-12">
                                    <label for="exampleInputEmail1">producto_id</label>
                                        <b-form-select v-model="input_productos_id" :options="data_foraneo_producto_id"></b-form-select>
<!--
                                    <Select2 v-model="input_productos_id" :options="data_foraneo_producto_id" width="100%" />
   -->                                 
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                    <b-alert show v-for="data in validacion.producto_id" v-bind:key="data.producto_id" variant="danger">
                                        {{data}}
                                    </b-alert>

                                    <div class="invalid-feedback" style="display:block" v-for="data in validacion.producto_id" v-bind:key="data.producto_id">
                                        <b>{{data}}</b>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 col-sm-12 text-center">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</template>

<script>
import Vue from "vue";
import Select2 from "v-select2-component";
//https://www.npmjs.com/package/vue-toastr-2
import VueToastr2 from "vue-toastr-2";
import "vue-toastr-2/dist/vue-toastr-2.min.css";
window.toastr = require("toastr");
Vue.use(VueToastr2);

export default {
    components: {

        VueToastr2,
        Select2
    },
    data() {

        return {
            formulario_ListaProducto: false,
            validacion: [],
            editar_dato: false,
            data: [],
            datas: [],
            input_consulta_data: "",
            stickyHeader: true,
            noCollapse: false,

            input_ListaProducto_id: [],
            data_foraneo_producto_id: [],
            input_id: [],
            input_orden: [],
            input_created_at: [],
            input_updated_at: [],
            input_productos_id:'',

            consulta_datos: [],
            errors: {},
            mensaje_formulario: "",
            page: 1,

        };
    },
    mounted() {
        //this.consulta();
        this.data_foraneo();
        if (this.$route.params.id > 0) {
            this.show_registro(this.$route.params.id);
        } else {
            this.anadir_registro()
        }
    },
    methods: {

        anadir_registro() {
            this.validacion = "";
            this.formulario_ListaProducto = true;
            this.editar_dato = false;
            this.limpiar_form();
            this.mensaje_formulario = "Añadir un nuevo registro"
        },
        data_foraneo() {
            axios.get(`/ListaProducto/data_foraneo`)
                .then(response => {
                    this.data_foraneo_producto_id = response.data.producto_id;
                });
        },
        formulario() {

            const data = {
                id: this.input_ListaProducto_id,
                id: this.input_id,
                orden: this.input_orden,
                created_at: this.input_created_at,
                updated_at: this.input_updated_at,
                producto_id: this.input_productos_id,

                //name: this.input_name,
                //email: this.input_email
            };

            if (this.editar_dato == true) {
                axios.put(`/ListaProducto/${this.input_ListaProducto_id}`, data)
                    .then(response => {

                            const datos = response.data;
                            if (response.data.errors) {
                                this.$toastr.warning("Verifique los datos", "Verifique los datos");
                                this.validacion = response.data.errors;
                            }
                            if (response.data.id) {
                                this.validacion = "";
                                this.$toastr.success("Operacio exitosa", "Datos modificados");
                                //this.consulta(this.page);
                                this.formulario_ListaProducto = false;
                                window.history.back();

                            }
                        },
                        (err) => {
                            console.log("Err", err);
                            this.$toastr.warning(err, "Error en el servidor");
                            this.$toastr.warning(err.message, "Error en el servidor");
                        });

            } else {

                axios.post(`/ListaProducto`, data).then(response => {
                        const datos = response.data;
                        if (response.data.errors) {
                            this.$toastr.warning("Verifique los datos", "Verifique los datos");
                            this.validacion = response.data.errors;
                        }
                        if (response.data.id) {
                            this.validacion = "";
                            this.$toastr.success("Operacio exitosa", "Datos modificados");
                            //this.consulta(this.page);
                            this.formulario_ListaProducto = false;
                            this.limpiar_form();
                            window.history.back();

                        }
                    },
                    (err) => {
                        console.log("Err", err);
                        this.$toastr.warning(err, "Error en el servidor");
                        this.$toastr.warning(err.message, "Error en el servidor");
                    }

                );

            }

        },
        cancelar_registro() {
            //this.formulario_ListaProducto=false;
            window.history.back();
        },
        $can(permissionName) {
            return true;
            return Permissions.indexOf(permissionName) !== -1;
        },
        show_registro(data_id) { //show_registro
            this.validacion = "";
            this.formulario_ListaProducto = true;
            this.mensaje_formulario = "Editar un registro"

            axios.get(`/ListaProducto/${data_id}`).then(response => {
                const data = response.data;
                if (!response.data) {
                    this.$toastr.warning("Operacio no exitosa", "Regitro no obtenido");
                } else {
                    this.$toastr.success("Operacio exitosa", "Regitro obtenido");
                    this.editar_dato = true;
                    this.input_ListaProducto_id = data.id
                    this.input_id = data.id;
                    this.input_orden = data.orden;
                    this.input_created_at = data.created_at;
                    this.input_updated_at = data.updated_at;
                    this.input_productos_id = data.producto_id;

                }
            });
        },
        limpiar_form() {
            this.input_id = '';
            this.input_orden = '';
            this.input_created_at = '';
            this.input_updated_at = '';
            this.input_productos_id = '';

            this.validacion = "";

        },

    }
};
</script>
