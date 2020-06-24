<template>
<div class="row">
    <div v-if="formulario_Facturacion_Producto" class="col-lg-12 ">
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
                                <input type="hidden" v-model="input_Facturacion_Producto_id">
                                <!--
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="exampleInputEmail1"><b>id</b></label>
                                    <input type="text" v-model="input_id" placeholder="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <b-alert show v-if="validacion.id" variant="danger">{{validacion.id[0]}}</b-alert>

                                </div>
                                
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="exampleInputEmail1">facturacion_id</label>
                                    <Select2 v-model="input_facturacion_id" :options="data_foraneo_facturacion_id" :settings="{ settingOption: value, settingOption: value }" />
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                    <b-alert show v-if="validacion.facturacion_id" variant="danger">{{validacion.facturacion_id[0]}}</b-alert>
                                </div>
                                -->
                                <div class="form-group col-md-3 col-sm-12">
                                    <label for="exampleInputEmail1"><b>Codigo producto</b></label>
                                    <input type="text" v-on:change="buscar_producto_descricion()" v-model="input_codigo_producto" placeholder="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <b-alert show v-if="validacion.input_codigo_producto" variant="danger">{{validacion.input_codigo_producto[0]}}</b-alert>
                                </div>
                                <div class="form-group col-md-3 col-sm-12">
                                    <label for="exampleInputEmail1">Producto</label>
                                    <Select2 v-model="input_producto_id" v-on:change="buscar_producto_descricion()" :options="data_foraneo_producto_id" 
                                     />
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                    <b-alert show v-if="validacion.producto_id" variant="danger">{{validacion.producto_id[0]}}</b-alert>
                                </div>
                                
                              
                                
                                <div class="form-group col-md-2 col-sm-12">
                                    <label for="exampleInputEmail1"><b>Unidad de Medida</b></label>
                                    <input type="text" v-model="input_unidad_de_medida" placeholder="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <b-alert show v-if="validacion.input_unidad_de_medida" variant="danger">{{validacion.input_unidad_de_medida[0]}}</b-alert>
                                </div>
                                <div class="form-group col-md-2 col-sm-12">
                                    <label for="exampleInputEmail1"><b>Cantidad por Unidad</b></label>
                                    <input type="text" v-model="input_cantidad_por_unidad" v-on:change="calcular_producto()" placeholder="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <b-alert show v-if="validacion.input_cantidad_por_unidad" variant="danger">{{validacion.input_cantidad_por_unidad[0]}}</b-alert>
                                </div>
                                <div class="form-group col-md-2 col-sm-12">
                                    <label for="exampleInputEmail1"><b>IVA</b></label>
                                    <input type="text" v-model="input_iva" placeholder="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <b-alert show v-if="validacion.id" variant="danger">{{validacion.id[0]}}</b-alert>
                                </div>
                                <div class="form-group col-md-2 col-sm-12">
                                    <label for="exampleInputEmail1"><b>Porcentaje de Ganancia</b></label>
                                    <input type="text" v-model="input_porcentaje_de_ganancia" v-on:change="calcular_producto()" placeholder="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <b-alert show v-if="validacion.id" variant="danger">{{validacion.id[0]}}</b-alert>
                                </div>
                                
                                
                            </div>
                            <div class="col-md-12 row">
                              <div class="form-group col-md-2 col-sm-12">
                                    <label for="exampleInputEmail1"><b>cantidad</b></label>
                                    <input type="text" v-model="input_cantidad" v-on:change="calcular_producto()" placeholder="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <b-alert show v-if="validacion.input_cantidad" variant="danger">{{validacion.input_cantidad[0]}}</b-alert>
                              </div>
                              <div class="form-group col-md-2 col-sm-12">
                                    <label for="exampleInputEmail1"><b>Valor Unitario sin iva</b></label>
                                    <!--
                                    <input type="text" v-model="input_valor_unitario_sin_iva" v-money="money" placeholder="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    -->
                                    <money v-model="input_valor_unitario_sin_iva" v-bind="money" v-on:change="calcular_producto()" class="form-control" ></money>
                                    <b-alert show v-if="validacion.id" variant="danger">{{validacion.id[0]}}</b-alert>
                                </div>
                                <div class="form-group col-md-2 col-sm-12">
                                    <label for="exampleInputEmail1"><b>Valor Unitario con iva</b></label>
                                    <money v-model="input_valor_unitario_con_iva" v-on:change="calcular_producto()" v-bind="money" class="form-control" ></money>
                                    <!--
                                    <input type="text" v-model="input_valor_unitario_con_iva" v-on:change="calcular_producto()" placeholder="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    -->
                                    <b-alert show v-if="validacion.id" variant="danger">{{validacion.id[0]}}</b-alert>
                                </div>
                                
                                <div class="form-group col-md-2 col-sm-12">
                                    <label for="exampleInputEmail1"><b>Valor de venta calculado</b></label>
                                    <!--
                                    <input type="text" v-model="input_Valor_de_venta_calculado" placeholder="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    -->
                                    <money v-model="input_Valor_de_venta_calculado" v-bind="money" class="form-control" ></money>
 
                                    <b-alert show v-if="validacion.id" variant="danger">{{validacion.id[0]}}</b-alert>
                                </div>
                                <div class="form-group col-md-2 col-sm-12">
                                    <label for="exampleInputEmail1"><b>Valor de venta</b></label>
                                    <!--
                                    <input type="text" v-model="input_valor_de_venta" placeholder="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    -->
                                    <money v-model="input_valor_de_venta" v-bind="money" class="form-control" ></money>
 
                                    <b-alert show v-if="validacion.id" variant="danger">{{validacion.id[0]}}</b-alert>
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

    <div v-else class='col-lg-12'>
        <div class='main-card mb-3 card'>
            <div class='card-body'>
                <h1 class=''>Lista de Facturacion_Producto </h1>

                <nav>
                    <pagination :data='consulta_datos' @pagination-change-page='consulta'></pagination>
                </nav>

                <div class='col-12'>
                    <b-button v-if="$can('Facturacion_Producto Anadir')" @click='anadir_registro()' type='button' class='btn btn-wangir btn-lg' data-toggle='button' size='sm' aria-pressed='false' variant='success' style='margin-bottom: 5px; margin: 5px;'>Añadir registro
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
                <b-table :items='consulta_datos.data' :fields='fields' responsive='sm' :sticky-header='stickyHeader' :no-border-collapse='noCollapse'>
                    <template v-slot:cell(Acciones)='data'>

                        <b-button-group>
                            <b-button v-if="$can('Facturacion_Producto Editar')" v-b-modal.moda-registro size='sm' variant='warning' @click='editar_registro(data.item.id)' type='button' class='btn-sm btn btn-wangir mr-1' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 5px;'>Editar
                            </b-button>
                            <b-button v-if="$can('Facturacion_Producto Eliminar')" v-b-modal.moda-eliminar @click='eliminar_registro(data.item.id)' type='button' class='btn-sm btn btn-danger mr-1' size='sm' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 5px;'>Eliminar
                            </b-button>
                            <!--  
                          <a v-bind:href=" data.item.id+'/Sucursale'"  class='btn-sm btn btn-success mr-1' size='sm'  style='margin-bottom: 5px; margin: 5px;'>Surcusales </a>
                          -->
                        </b-button-group>

                    </template>
                    <template v-slot:cell(valor_unitario_sin_iva)='data'>
                        {{ formatPrice(data.item.valor_unitario_sin_iva) }}
                    </template>
                    <template v-slot:cell(valor_unitario_con_iva)='data'>
                        {{ formatPrice(data.item.valor_unitario_con_iva) }}
                    </template>
                    <template v-slot:cell(Valor_de_venta_calculado)='data'>
                        {{ formatPrice(data.item.Valor_de_venta_calculado) }}
                    </template>
                    <template v-slot:cell(valor_de_venta)='data'>
                        {{ formatPrice(data.item.valor_de_venta) }}
                    </template>
                    
                    <template v-slot:head(Acciones)='scope'>
                        <div class='text-nowrap'>Acciones</div>
                    </template>
                    <template v-slot:head(Acciones)='scope'>
                        <div class='text-nowrap'>Acciones</div>
                    </template>

                    
                </b-table>

                <div class='col-12'>
                        <div class="row">

                        <h3>
                            {{ formatPrice(input_suma_total) }}
                        </h3>
                        </div>
                </div>
<!--
                <div class='col-12'>
                    <form ref="form" v-on:submit.prevent="formulario()">
                        <div class="row">
                            <div class="form-group col-md-3 col-sm-12">
                                <label for="exampleInputEmail1">producto_id</label>
                                <Select2 v-model="input_producto_id" :options="data_foraneo_producto_id" :settings="{ settingOption: value, settingOption: value,width:'100%' }" />
                                <small id="emailHelp" class="form-text text-muted"></small>
                                <b-alert show v-if="validacion.producto_id" variant="danger">{{validacion.producto_id[0]}}</b-alert>
                            </div>
                            <div class="form-group col-md-3 col-sm-12" v-for="data in input_campo">
                                <label for="exampleInputEmail1">{{data.nombre }}</label>

                                <input type="text" v-model="data.valor" class="form-control">

                            </div>
                            <div class="form-group col-md-3 col-sm-12">
                                <button type="submit" @click="formulario()" class="btn btn-primary">Guardar </button>
                            </div>
                        </div>

                    </form>
                </div>
                -->
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
import {Money} from 'v-money'

export default {
    components: {
        VueSingleSelect,
        VueToastr2,
        Select2,
        Money
    },
    props: ["input_Facturacion_id"],
    data() {

        return {
            //input_Facturacion_id: [],
            formulario_Facturacion_Producto: false,
            validacion: [],
            editar_dato_FP: false,
            data: [],
            datas: [],
            input_consulta_data: "",
            stickyHeader: true,
            noCollapse: false,

            money: {
                decimal: ',',
                thousands: '.',
                prefix: '$ ',
                suffix: '',
                precision: 0,
                masked: false
            },


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
                    label:'Codigo',
                    key: 'codigo_producto',
                    sortable: true
                },
                {
                    label:'Producto',

                    key: 'producto_id.nombre_proveedor',
                    sortable: true
                },
                {
                    label:'Producto',
                    key: 'producto_id.nombre',
                    sortable: true
                },
                {
                    label:'cantidad',
                    key: 'cantidad',
                    sortable: true
                },
                {
                    label:'cant Unit',
                    key: 'cantidad_por_unidad',
                    sortable: true
                },
                {
                    label:'v unit S IVA',
                    key: 'valor_unitario_sin_iva',
                    sortable: true
                },
                {
                    label:'Iva',
                    key: 'iva',
                    sortable: true
                },
                {   label:'Valor C IVA',
                    key: 'valor_unitario_con_iva',
                    sortable: true
                },
                {
                    label:'precio calculado',
                    key: 'Valor_de_venta_calculado',
                    sortable: true
                },
                {
                    label:'precio',
                    key: 'valor_de_venta',
                    sortable: true
                },
                

            ],

            

            input_Facturacion_Producto_id: [],
            data_foraneo_facturacion_id: [],
            data_foraneo_producto_id: [],

            input_id: [],
            input_facturacion_id: [],
            input_producto_id: [],
            input_cantidad: [],
            input_unidad_de_medida: [],
            input_cantidad_por_unidad: [],
            input_valor_unitario_sin_iva: [],
            input_iva: [],
            input_valor_unitario_con_iva: [],
            input_porcentaje_de_ganancia: [],
            input_Valor_de_venta_calculado: [],
            input_valor_de_venta: [],
            input_codigo_producto:'', 
            input_campo: [],

            consulta_tabla: [],
            consulta_datos: [],
            errors: {},
            mensaje_formulario: "",
            page: 1,
            input_suma_total:[],

        };
    },
    mounted() {
        this.consulta();
        this.data_foraneo();
    },
    methods: {

        consulta(page = 1) {
            this.page = page;
            //alert(this.input_Facturacion_id);
            axios.get("Facturacion_Producto/consulta/" + this.input_Facturacion_id + "/?page=" + page + "&consulta_data=" + this.input_consulta_data)
                .then(response => {
                    this.consulta_datos = response.data.consulta;
                    this.input_campo = response.data.campo;
                    this.input_suma_total = response.data.suma_total;

                    
                    //this.datas = response.data.data;
                    //this.items = response.data.data;
                    //this.consulta_tabla = response.data.data;
                });
        },
        data_foraneo() {
            axios.get("Facturacion_Producto/create").then(response => {
                this.productos_all = response.data;
                this.data_foraneo_facturacion_id = response.data.facturacion_id
                this.data_foraneo_producto_id = response.data.producto_id

            });
        },
        buscar_producto(){
            axios.get(`Facturacion_Producto/buscar_producto/${this.input_codigo_producto}`).then(response => {
               const data = response.data;

                this.input_Facturacion_Producto_id = data.id

                //this.productos_all = response.data;
                //this.data_foraneo_facturacion_id = response.data.facturacion_id
                //this.data_foraneo_producto_id = response.data.producto_id

            });
        },
        eliminar_registro(data_id) {
            this.input_Facturacion_Producto_id = data_id;
        },
        eliminar_registro_delete() {
            var data_id = this.input_Facturacion_Producto_id;
            axios.delete(`Facturacion_Producto/${this.input_Facturacion_Producto_id}`).then(response => {
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
            this.formulario_Facturacion_Producto = true;
            this.editar_dato_FP = false;
            this.limpiar_form();
            this.mensaje_formulario = "Añadir un nuevo registro"
        },
        formulario() {

            const data = {

                id: this.input_Facturacion_Producto_id,
                id: this.input_id,
                codigo_producto: this.input_codigo_producto,
                facturacion_id: this.input_Facturacion_id,
                producto_id: this.input_producto_id,
                campos: this.input_campo,
                cantidad: this.input_cantidad,
                unidad_de_medida: this.input_unidad_de_medida,
                cantidad_por_unidad: this.input_cantidad_por_unidad,
                valor_unitario_sin_iva: this.input_valor_unitario_sin_iva,
                iva: this.input_iva,
                valor_unitario_con_iva: this.input_valor_unitario_con_iva,
                porcentaje_de_ganancia: this.input_porcentaje_de_ganancia,
                Valor_de_venta_calculado: this.input_Valor_de_venta_calculado,
                valor_de_venta: this.input_valor_de_venta,
                //name: this.input_name,
                //email: this.input_email
            };

            if (this.editar_dato_FP == true) {
                axios.put(`Facturacion_Producto/${this.input_Facturacion_Producto_id}`, data)
                    .then(response => {
                            alert('editar');
                            const datos = response.data;
                            if (response.data.errors) {
                                this.$toastr.warning("Verifique los datos", "Verifique los datos");
                                this.validacion = response.data.errors;
                            }
                            if (response.data.id) {
                                this.validacion = "";
                                this.$toastr.success("Operacio exitosa", "Datos modificados");
                                this.consulta(this.page);
                                this.formulario_Facturacion_Producto = false;

                            }
                        },
                        (err) => {
                            console.log("Err", err);
                            this.$toastr.warning(err, "Error en el servidor");
                            this.$toastr.warning(err.message, "Error en el servidor");
                        });

            } else {

                axios.post("Facturacion_Producto", data).then(response => {
                        const datos = response.data;
                        if (response.data.errors) {
                            this.$toastr.warning("Verifique los datos", "Verifique los datos");
                            this.validacion = response.data.errors;
                        }
                        if (response.data.id) {
                            this.validacion = "";
                            this.$toastr.success("Operacio exitosa", "Datos modificados");
                            this.consulta(this.page);
                            this.formulario_Facturacion_Producto = false;
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
            this.formulario_Facturacion_Producto = false;
        },
        $can(permissionName) {
            return Permissions.indexOf(permissionName) !== -1;
        },
        calcular_producto(){
            console.info(this.valor_unitario_con_iva);
            console.info(this.porcentaje_de_ganancia);
            console.info(this.cantidad_por_unidad);

            //this.cantidad_por_unidad

            this.input_Valor_de_venta_calculado=( (this.input_valor_unitario_con_iva * ((this.input_porcentaje_de_ganancia/100)+1) )/ this.input_cantidad_por_unidad)
            console.info( (this.valor_unitario_con_iva * (this.porcentaje_de_ganancia/100) )/ this.cantidad_por_unidad) 
        },
        buscar_producto_descricion(){
             const data = {
                codigo_producto: this.input_codigo_producto,
                producto_id: this.input_producto_id,
                }

                axios.post(`Facturacion_Producto/buscar_producto_descricion`, data)
                    .then(response => {
                            const datos = response.data;
                            if (response.data.id) {
                                this.validacion = "";
                                this.$toastr.success("Operacio exitosa", "Datos modificados");
                                 this.input_cantidad= datos.cantidad
                                this.input_unidad_de_medida=datos.unidad_de_medida
                                this.input_cantidad_por_unidad=datos.cantidad_por_unidad
                                this.input_valor_unitario_sin_iva=datos.valor_unitario_sin_iva
                                this.input_iva=datos.iva
                                this.input_valor_unitario_con_iva=datos.valor_unitario_con_iva
                                this.input_porcentaje_de_ganancia=datos.porcentaje_de_ganancia
                                this.input_Valor_de_venta_calculado=datos.Valor_de_venta_calculado
                                this.input_valor_de_venta=datos.valor_de_venta
                                //this.consulta(this.page);
                                //this.formulario_Facturacion_Producto = false;

                            }
                        },
                        (err) => {
                            console.log("Err", err);
                            this.$toastr.warning(err, "Error en el servidor");
                            this.$toastr.warning(err.message, "Error en el servidor");
                });


        },
        editar_registro(data_id) { //show 
            this.validacion = "";
            this.formulario_Facturacion_Producto = true;
            this.mensaje_formulario = "Editar un registro"
            axios.get(`Facturacion_Producto/${data_id}`).then(response => {
                const data = response.data;
                if (!response.data) {
                    this.$toastr.warning("Operacio no exitosa", "Regitro no obtenido");
                } else {
                    this.$toastr.success("Operacio exitosa", "Regitro obtenido");
                    this.editar_dato_FP = true;
                    this.input_Facturacion_Producto_id = data.id
                    this.input_id = data.id;
                    this.input_facturacion_id = data.facturacion_id;
                    this.input_producto_id = data.producto_id;
                    this.input_cantidad = data.cantidad;
                    this.input_unidad_de_medida = data.unidad_de_medida;
                    this.input_cantidad_por_unidad = data.cantidad_por_unidad;
                    this.input_valor_unitario_sin_iva = data.valor_unitario_sin_iva;
                    this.input_iva = data.iva;
                    this.input_valor_unitario_con_iva = data.valor_unitario_con_iva;
                    this.input_porcentaje_de_ganancia = data.porcentaje_de_ganancia;
                    this.input_Valor_de_venta_calculado = data.Valor_de_venta_calculado;
                    this.input_valor_de_venta = data.valor_de_venta;
                    this.input_codigo_producto = data.codigo_producto;

                    //this.input_user_id = data.id;
                    //this.input_name = data.name;
                }
            });
        },
        limpiar_form() {
            this.input_id = '';
            // this.input_facturacion_id = '';
            this.input_codigo_producto = ''
            this.input_producto_id = ''
            this.input_cantidad = ''
            this.input_unidad_de_medida = ''
            this.input_cantidad_por_unidad = ''
            this.input_valor_unitario_sin_iva = ''
            this.input_iva = ''
            this.input_valor_unitario_con_iva = ''
            this.input_porcentaje_de_ganancia = ''
            this.input_Valor_de_venta_calculado = ''
            this.input_valor_de_venta = ''

            this.validacion = "";

        },
        formatPrice(value) {
            let val = (value / 1).toFixed(0).replace(".", ",");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },

    }
};
</script>
