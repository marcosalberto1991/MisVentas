<template>
<div class="row">
    <div v-if="formulario_Facturacion==true" class="col-lg-12 ">
        <div class="main-card mb-3 card formulario">
            <div class="card-body">
                <h1 class="card-title"></h1>
                <h2>Formulario de Facturación</h2>
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
                                <input type="hidden" v-model="input_Facturacion_id">

                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="exampleInputEmail1"><b>Fecha</b></label>
                                    <input type="text" v-model="input_fecha" placeholder="fecha" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <b-alert show v-if="validacion.fecha" variant="danger">{{validacion.fecha[0]}}</b-alert>

                                </div>

                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="exampleInputEmail1">proveedor_id</label>
                                    <Select2 v-model="input_proveedor_id" :options="data_foraneo_proveedor_id"  />
                                    <input type="text" v-model="input_proveedor_nombre" placeholder="Nuevo Proveedor" class="form-control">

                                    <small id="emailHelp" class="form-text text-muted"></small>
                                    <b-alert show v-if="validacion.proveedor_id" variant="danger">{{validacion.proveedor_id[0]}}</b-alert>
                                </div>

                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="exampleInputEmail1">metodo_pago_id</label>
                                    <Select2 v-model="input_metodo_pago_id" :options="data_foraneo_metodo_pago_id"  />
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                    <b-alert show v-if="validacion.metodo_pago_id" variant="danger">{{validacion.metodo_pago_id[0]}}</b-alert>
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



    <div v-if="formulario_Facturacion==true && input_Facturacion_id>=1" class="col-lg-12 ">
        <vue-facturacion_producto v-if="formulario_Facturacion==true" :input_Facturacion_id="input_Facturacion_id"></vue-facturacion_producto>

        <!--
        <div class="main-card mb-3 card formulario">
            <div class="card-body">
                <b-button v-if="$can('Facturacion Anadir')" @click='cargar_productos()' type='button' class='btn btn-wangir btn-lg' data-toggle='button' size='sm' aria-pressed='false' variant='success' style='margin-bottom: 5px; margin: 5px;'>Carga Producto mas comprado
                </b-button>

                <!--
                <h1 class="card-title"></h1>
                <h2>Formulario </h2>
                <div class="col-md-12 row">
                    <div class="form-group col-md-12 col-sm-12" style="margin-bottom: 6px;">
                        <button type="submit" @click="formulario()" class="btn btn-primary">Guardar </button>
                        <a class="btn btn-warning" @click="cancelar_registro()">Cancelar</a>
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="data in facturacion_has_producto_data" v-bind:key="facturacion_has_producto_data.id">

                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group col-md-3 col-sm-12">
                                        <label for="exampleInputEmail1">proveedor_id</label>
                                        <Select2 v-model="input_producto_id" :options="data_foraneo_producto_id" :settings="{ settingOption: value, settingOption: value }" />
                                        <small id="emailHelp" class="form-text text-muted"></small>
                                        <b-alert show v-if="validacion.producto_id" variant="danger">{{validacion.producto_id[0]}}</b-alert>
                                    </div>

                                    <div class="form-group col-md-4 col-sm-12">
                                        <b-button v-if="$can('Facturacion anadir')" size='sm' variant='warning' @click='facturacion_producto_id_add()' type='button' class='btn-sm btn btn-wangir mr-1' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 5px;'>Editar
                                        </b-button>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        -->
    </div>

    <div v-if="formulario_Facturacion==false" class='col-lg-12'>
        <div class='main-card mb-3 card'>
            <div class='card-body'>
                <h1 class=''>Lista de Facturacion </h1>

                <nav>
                    <pagination :data='consulta_datos' @pagination-change-page='consulta'></pagination>
                </nav>

                <div class='col-12'>
                    <b-button v-if="$can('Facturacion Anadir')" @click='anadir_registro()' type='button' class='btn btn-wangir btn-lg' data-toggle='button' size='sm' aria-pressed='false' variant='success' style='margin-bottom: 5px; margin: 5px;'>Añadir registro
                    </b-button>

                    <div class='flexbox  float-right'>
                        <form ref='form' v-on:submit.prevent='consulta()'>
                            <b-input-group size='sm' class='float-right  margin-bottom-0' prepend='' style='margin-bottom: 0px;'>
                                <b-form-input type='text' v-model='input_consulta_data'></b-form-input>
                                <b-input-group-append>
                                    <b-button @click='consulta()' size='sm' text='Button' variant='success'>Buscar</b-button>
                                </b-input-group-append>
                            </b-input-group>
                        </form>
                    </div><br><br>
                </div>

                <b-table :items='consulta_tabla' :fields='fields' responsive='sm' :sticky-header='stickyHeader' :no-border-collapse='noCollapse'>
                    <template v-slot:cell(Acciones)='data'>

                        <b-button-group>
                            <b-button v-if="$can('Facturacion Editar')" v-b-modal.moda-registro size='sm' variant='warning' @click='editar_registro(data.item.id)' type='button' class='btn-sm btn btn-wangir mr-1' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 5px;'>Editar
                            </b-button>
                            <b-button v-if="$can('Facturacion Eliminar')" v-b-modal.moda-eliminar @click='eliminar_registro(data.item.id)' type='button' class='btn-sm btn btn-danger mr-1' size='sm' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 5px;'>Eliminar
                            </b-button>
                            <!--  
            <a v-bind:href=" data.item.id+'/Sucursale'"  class='btn-sm btn btn-success mr-1' size='sm'  style='margin-bottom: 5px; margin: 5px;'>Surcusales </a>
            -->
                        </b-button-group>

                    </template>
                    <template v-slot:head(Acciones)='scope'>
                        <div class='text-nowrap'>Acciones</div>
                    </template>
                </b-table>

            </div>
        </div>
    </div>

    <b-modal id="moda-eliminar" size="xl" hide-footer>
        <template slot="modal-title">Eliminar un Registro </template>
        <div class="d-block text-center">
            <h3>¿Desea eliminar el registro permanente?</h3>
            <b-button class="mt-3 btn btn-danger " @click="eliminar_registro_delete()">Eliminar</b-button>
        </div>
    </b-modal>

</div>
</template>

<script>
import Vue from "vue";
import VueSingleSelect from "vue-single-select";

//import VueToast from "vue-toast-notification";
//import "vue-toast-notification/dist/index.css";
import Select2 from "v-select2-component";
//https://www.npmjs.com/package/vue-toastr-2
import VueToastr2 from "vue-toastr-2";
import "vue-toastr-2/dist/vue-toastr-2.min.css";
window.toastr = require("toastr");
Vue.use(VueToastr2);

export default {
    components: {
        VueSingleSelect,
        VueToastr2,
        Select2
    },
    data() {

        return {
            formulario_Facturacion: false,
            validacion: [],
            editar_dato: false,
            data: [],
            datas: [],
            input_consulta_data: "",
            stickyHeader: true,
            noCollapse: false,
            fields: [{
                    key: "Acciones",
                    stickyColumn: true,
                    label: "Acciones",
                    sortable: false
                },
                {
                    key: 'id',
                    sortable: true
                },
                {
                    key: 'fecha',
                    sortable: true
                },
                {
                    key: 'proveedor_id.nombre',
                    sortable: true
                },
                {
                    key: 'metodo_pago_id',
                    sortable: true
                },

            ],

            input_Facturacion_id: 0,
            data_foraneo_proveedor_id: [],
            data_foraneo_metodo_pago_id: [],
            input_id: [],
            input_fecha: [],
            input_proveedor_id: [],
            input_metodo_pago_id: [],
            input_proveedor_nombre:[],
            consulta_tabla: [],
            consulta_datos: {},
            errors: {},
            mensaje_formulario: "",
            page: 1,

            //
            facturacion_has_producto_data: [],
         //   data_foraneo_producto_id: [],
            input_producto_id: [],
            input_cantidad: [],

        };
    },
    mounted() {
        this.consulta();
        this.data_foraneo();
    },
    methods: {

        consulta(page = 1) {
            this.page = page;
            axios.get("Facturacion/consulta?page=" + page + "&consulta_data=" + this.input_consulta_data)
                .then(response => {
                    this.consulta_datos = response.data;
                    this.datas = response.data.data;
                    this.items = response.data.data;
                    this.consulta_tabla = response.data.data;
                });
        },
        data_foraneo() {
            axios.get("Facturacion/create").then(response => {
                this.productos_all = response.data;
                this.data_foraneo_proveedor_id = response.data.proveedor_id
                this.data_foraneo_metodo_pago_id = response.data.metodo_pago_id

            });
        },
        cargar_productos() {

            axios.put(`Facturacion/cargar_productos/${this.input_Facturacion_id}`).then(response => {
                this.facturacion_has_producto_data = response.data.proveedor_id
                //this.productos_all = response.data;
                //this.data_foraneo_proveedor_id = response.data.proveedor_id
                //this.data_foraneo_metodo_pago_id = response.data.metodo_pago_id

            });
        },
        facturacion_producto_id_add(){
           
            const data = {
                id: this.input_Facturacion_id,
                id: this.input_id,
                fecha: this.input_fecha,
                proveedor_id: this.input_proveedor_id,
                metodo_pago_id: this.input_metodo_pago_id,
                proveedor_nombre: this.input_proveedor_nombre,
                
                //name: this.input_name,
                //email: this.input_email
            };


           
           if (this.editar_dato == true) {
                axios.put(`Facturacion/${this.input_Facturacion_id}`, data)
                    .then(response => {

                            const datos = response.data;
                            if (response.data.errors) {
                                this.$toastr.warning("Verifique los datos", "Verifique los datos");
                                this.validacion = response.data.errors;
                            }
                            if (response.data.id) {
                                this.validacion = "";
                                this.$toastr.success("Operacio exitosa", "Datos modificados");
                                this.consulta(this.page);
                                //this.formulario_Facturacion = false;
                            }
                        },
                        (err) => {
                            console.log("Err", err);
                            this.$toastr.warning(err, "Error en el servidor");
                            this.$toastr.warning(err.message, "Error en el servidor");
                        });

            } else {

                axios.post("Facturacion", data).then(response => {
                        const datos = response.data;
                        if (response.data.errors) {
                            this.$toastr.warning("Verifique los datos", "Verifique los datos");
                            this.validacion = response.data.errors;
                        }
                        if (response.data.id) {
                            this.validacion = "";
                            this.$toastr.success("Operacio exitosa", "Datos modificados");
                            this.consulta(this.page);
                            this.input_Facturacion_id = response.data.id

                            //this.formulario_Facturacion = response.data.id
                            //this.formulario_Facturacion = false;
                            //this.limpiar_form();
                            

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

        eliminar_registro(data_id) {
            this.input_Facturacion_id = data_id;
        },
        eliminar_registro_delete() {
            var data_id = this.input_Facturacion_id;
            axios.delete(`Facturacion/${this.input_Facturacion_id}`).then(response => {
                const data = response.data;
                if (response.data.id) {
                    this.validacion = "";
                    this.$toastr.info("Operacio exitosa", "Datos Eliminados");
                    this.consulta(this.page);
                }
            });

        },
        anadir_registro() {
            this.validacion = "";
            this.formulario_Facturacion = true;
            this.editar_dato = false;
            this.limpiar_form();
            this.input_Facturacion_id = 0

            this.mensaje_formulario = "Añadir un nuevo registro"
        },
        formulario() {

            const data = {
                id: this.input_Facturacion_id,
                id: this.input_id,
                fecha: this.input_fecha,
                proveedor_id: this.input_proveedor_id,
                metodo_pago_id: this.input_metodo_pago_id,

                //name: this.input_name,
                //email: this.input_email
            };

            if (this.editar_dato == true) {
                axios.put(`Facturacion/${this.input_Facturacion_id}`, data)
                    .then(response => {

                            const datos = response.data;
                            if (response.data.errors) {
                                this.$toastr.warning("Verifique los datos", "Verifique los datos");
                                this.validacion = response.data.errors;
                            }
                            if (response.data.id) {
                                this.validacion = "";
                                this.$toastr.success("Operacio exitosa", "Datos modificados");
                                this.consulta(this.page);
                                this.formulario_Facturacion = false;

                            }
                        },
                        (err) => {
                            console.log("Err", err);
                            this.$toastr.warning(err, "Error en el servidor");
                            this.$toastr.warning(err.message, "Error en el servidor");
                        });

            } else {

                axios.post("Facturacion", data).then(response => {
                        const datos = response.data;
                        if (response.data.errors) {
                            this.$toastr.warning("Verifique los datos", "Verifique los datos");
                            this.validacion = response.data.errors;
                        }
                        if (response.data.id) {
                            this.validacion = "";
                            this.$toastr.success("Operacio exitosa", "Datos modificados");
                            this.consulta(this.page);
                            this.formulario_Facturacion = false;
                            this.limpiar_form();

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
            this.formulario_Facturacion = false;
        },
        $can(permissionName) {
            return Permissions.indexOf(permissionName) !== -1;
        },
        editar_registro(data_id) { //show 
            this.input_Facturacion_id=data_id;
            this.validacion = "";
            this.formulario_Facturacion = true;
            this.mensaje_formulario = "Editar un registro"
            axios.get(`Facturacion/${data_id}`).then(response => {
                const data = response.data;
                if (!response.data) {
                    this.$toastr.warning("Operacio no exitosa", "Regitro no obtenido");
                } else {
                    this.$toastr.success("Operacio exitosa", "Regitro obtenido");
                    this.editar_dato = true;
                    this.input_Facturacion_id = data.id
                    this.input_id = data.id;
                    this.input_fecha = data.fecha;
                    this.input_proveedor_id = data.proveedor_id;
                    this.input_metodo_pago_id = data.metodo_pago_id;

                    //this.input_user_id = data.id;
                    //this.input_name = data.name;
                }
            });
        },
        limpiar_form() {
            this.input_id = '';
            this.input_fecha = '';
            this.input_proveedor_id = '';
            this.input_metodo_pago_id = '';

            this.validacion = "";

        },

    }
};
</script>
