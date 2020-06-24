<template>
<div class="row">
    <!--
  ALTER TABLE `ventas` ADD `lista_precio_id` INT NOT NULL AFTER `mesa_id`;

-->
    <div v-if="formulario_Producto" class="col-lg-12 ">
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
                                <input type="hidden" v-model="input_Producto_id">
                                
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="exampleInputEmail1"><b>Codigo Producto</b></label>
                                    <input type="text" v-model="input_codigo_producto" placeholder="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <b-alert show v-if="validacion.codigo_producto" variant="danger">{{validacion.codigo_producto[0]}}</b-alert>

                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="exampleInputEmail1"><b>Nombre de Proveedor</b></label>
                                    <input type="text" v-model="input_nombre_proveedor" placeholder="nombre_proveedor" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <b-alert show v-if="validacion.nombre_proveedor" variant="danger">{{validacion.nombre_proveedor[0]}}</b-alert>

                                </div>

                                

                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="exampleInputEmail1"><b>Nombre</b></label>
                                    <input type="text" v-model="input_nombre" placeholder="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <b-alert show v-if="validacion.nombre" variant="danger">{{validacion.nombre[0]}}</b-alert>

                                </div>

                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="exampleInputEmail1"><b>imagen</b></label>

                                    <b-form-file v-model="input_imagen" browse-text='Archivo' class="color-back" id="file-default">Archivo</b-form-file>
                                    <!--
                <input type="text" v-model="input_imagen" placeholder="imagen" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                -->
                                    <b-alert show v-if="validacion.imagen" variant="danger">{{validacion.imagen[0]}}</b-alert>

                                </div>

                                <!--
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>precio_caja</b></label>
                <input type="text" v-model="input_precio_caja" placeholder="precio_caja" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.precio_caja" variant="danger" >{{validacion.precio_caja[0]}}</b-alert>

            </div>

            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>cantidad_caja</b></label>
                <input type="text" v-model="input_cantidad_caja" placeholder="cantidad_caja" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.cantidad_caja" variant="danger" >{{validacion.cantidad_caja[0]}}</b-alert>

            </div>
            -->

                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="exampleInputEmail1"><b>precio_unidad</b></label>
                                    <input type="text" v-model="input_precio_unidad" v-money="money" placeholder="precio_unidad" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <b-alert show v-if="validacion.precio_unidad" variant="danger">{{validacion.precio_unidad[0]}}</b-alert>

                                </div>

                                <!--
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>iva</b></label>
                <input type="text" v-model="input_iva" placeholder="iva" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.iva" variant="danger" >{{validacion.iva[0]}}</b-alert>

            </div>
     -->
                                <!-- 
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>porcentaje_ganacia</b></label>
                <input type="text" v-model="input_porcentaje_ganacia" placeholder="porcentaje_ganacia" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.porcentaje_ganacia" variant="danger" >{{validacion.porcentaje_ganacia[0]}}</b-alert>

            </div>
    -->
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="exampleInputEmail1"><b>precio_venta</b></label>
                                    <money v-model="input_precio_venta" v-bind="money" class="form-control" ></money>
                                    <b-alert show v-if="validacion.precio_venta" variant="danger">{{validacion.precio_venta[0]}}</b-alert>
                                </div>

                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="exampleInputEmail1"><b>precio_venta_2</b></label>
                                    <money v-model="input_precio_venta_2" v-bind="money" class="form-control" ></money>
                                    <b-alert show v-if="validacion.precio_venta_2" variant="danger">{{validacion.precio_venta_2[0]}}</b-alert>
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="exampleInputEmail1"><b>Stock</b></label>
                                    <input type="text" v-model="input_stock" v-money="money" placeholder="stock" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <b-alert show v-if="validacion.stock" variant="danger">{{validacion.stock[0]}}</b-alert>
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="exampleInputEmail1"><b>Cantidad Disponible</b></label>
                                    <input type="text" v-model="input_cantidad_disponible" v-money="money" placeholder="cantidad_disponible" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <b-alert show v-if="validacion.cantidad_disponible" variant="danger">{{validacion.cantidad_disponible[0]}}</b-alert>
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="exampleInputEmail1">Proveedor</label>
                                    <Select2 v-model="input_proveedor_id" :options="data_foraneo_proveedor_id" />
                                    <small id="emailHelp" class="form-text text-muted"></small>
                                    <b-alert show v-if="validacion.proveedor_id" variant="danger">{{validacion.proveedor_id[0]}}</b-alert>
                                </div>

                                <!--  
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>ganacia</b></label>
                <input type="text" v-model="input_ganacia" placeholder="ganacia" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.ganacia" variant="danger" >{{validacion.ganacia[0]}}</b-alert>
            </div>

            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>created_at</b></label>
                <input type="text" v-model="input_created_at" placeholder="created_at" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.created_at" variant="danger" >{{validacion.created_at[0]}}</b-alert>

            </div>

            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>updated_at</b></label>
                <input type="text" v-model="input_updated_at" placeholder="updated_at" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.updated_at" variant="danger" >{{validacion.updated_at[0]}}</b-alert>

            </div>
-->
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
    <div v-if="formulario_Producto" class="col-lg-12 ">
        <div class="main-card mb-3 card formulario">
            <div class="card-body">
                <h1 class="card-title"></h1>
                <h2>Formulario </h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="data in auditoria_data" v-bind:key="data.id">
                            <th scope="row">{{data.user_id}}</th>
                            <td>{{data.old_values}}</td>
                            <td>{{data.old_values['precio_venta_2']}}</td>
                            <td>{{data.old_values.precio_unidad}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div v-else class='col-lg-12'>
        <div class='main-card mb-3 card'>
            <div class='card-body'>
                <h1 class=''>Lista de Producto </h1>

                <nav>
                    <pagination :data='consulta_datos' @pagination-change-page='consulta'></pagination>
                </nav>
                <b-form-select v-model="input_lista_data" :options="lista_data" size="sm" class="mt-3">
                </b-form-select>

                <div class='col-12'>
                    <b-button v-if="$can('Producto Anadir')" @click='anadir_registro()' type='button' class='btn btn-wangir btn-lg' data-toggle='button' size='sm' aria-pressed='false' variant='success' style='margin-bottom: 5px; margin: 5px;'>Añadir registro
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

                <b-table v-if="input_lista_data==1" :items='consulta_tabla' :fields='fields' small responsive='sm'  :no-border-collapse='noCollapse'>
                    <template v-slot:cell(precio_venta)='data'>
                        $ {{formatPrice(data.item.precio_venta) }}
                    </template>
                    <template v-slot:cell(precio_venta_2)='data'>
                        $ {{formatPrice(data.item.precio_venta_2) }}
                    </template>
                    <template v-slot:cell(barra)='data'>

                        <b-progress class="mt-12" :max="100" show-value style="max-width:300px">
                            <b-progress-bar :value="data.item.stock" variant="success"></b-progress-bar>
                            <b-progress-bar :value="(data.item.cantidad_disponible)" variant="warning"></b-progress-bar>
                        </b-progress>
                    </template>
                    <template v-slot:cell(imagen)='data'>

                        <img v-if="data.item.imagen" height="30px" width="30px" :src="'intervenir/'+data.item.imagen" alt="">

                    </template>
                    <template v-slot:cell(Acciones)='data'>

                        <b-button v-b-modal.moda-registro size='sm' variant='warning' @click='editar_registro(data.item.id)' type='button' class='btn-sm btn btn-wangir mr-1 one-linea' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 5px;'>
                            <b-icon icon="pencil-square"></b-icon>
                        <!--    
                            <span class="d-none d-sm-none d-md-block one-linea">
                                Editar
                            </span>
              -->              
                        </b-button>
                        <b-button v-if="$can('Producto Eliminar')" v-b-modal.moda-eliminar @click='eliminar_registro(data.item.id)' type='button' class='btn-sm btn btn-danger mr-1' size='sm' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 5px;'>

                            <b-icon icon="Trash-fill"></b-icon>
<!--
                            <div class="d-none d-sm-none d-md-block ml-2 d-none d-md-inline-block">

                                Eliminar
                            </div>
              -->              

                        </b-button>
                        <!--  
              <a v-bind:href=" data.item.id+'/Sucursale'"  class='btn-sm btn btn-success mr-1' size='sm'  style='margin-bottom: 5px; margin: 5px;'>Surcusales </a>
              -->
                        <b-button-group>

                        </b-button-group>

                    </template>

                </b-table>

                <b-table v-if="input_lista_data==2" :items='consulta_tabla' Fixed :fields='fields_list' small responsive='sm'  :no-border-collapse='noCollapse'>
                    <template v-slot:cell(precio_venta)='data'>
                        $ {{formatPrice(data.item.precio_venta) }}
                    </template>
                    <template v-slot:cell(precio_venta_2)='data'>
                        $ {{formatPrice(data.item.precio_venta_2) }}
                    </template>
                    <template v-slot:cell(barra)='data'>
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left mr-3">
                                    <div class="widget-content-left">
                                        <img width="50" height="50" class="rounded-circle" :src="'intervenir/'+data.item.imagen" alt="">
                                    </div>
                                </div>
                                <div class="widget-content-left flex2">
                                    <div class="widget-heading">{{data.item.nombre}}</div>
                                    <div class="widget-subheading opacity-7">$ {{data.item.precio_venta}}</div>
                                </div>
                            </div>
                        </div>

                    </template>

                    <template v-slot:cell(Acciones)='data'>
                        <b-button-group>
                            <button class="mb-2 mr-2 btn-icon btn-square btn btn-warning"><i class="lnr-magic-wand btn-icon-wrapper"> </i>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Advertencia</font>
                                </font>
                            </button>
                            <b-button v-if="$can('Producto Editar')" v-b-modal.moda-registro size='sm' variant='warning' @click='editar_registro(data.item.id)' type='button' class='btn-sm btn btn-wangir mr-1' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 5px;'>Editar

                            </b-button>
                            <b-button v-if="$can('Producto Eliminar')" v-b-modal.moda-eliminar @click='eliminar_registro(data.item.id)' type='button' class='btn-sm btn btn-danger mr-1' size='sm' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 5px;'>Eliminar
                            </b-button>
                            <!--  
              <a v-bind:href=" data.item.id+'/Sucursale'"  class='btn-sm btn btn-success mr-1' size='sm'  style='margin-bottom: 5px; margin: 5px;'>Surcusales </a>
              -->
                        </b-button-group>

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
import {Money} from 'v-money'

export default {
    components: {
        VueSingleSelect,
        VueToastr2,
        Select2,
        Money
    },
    data() {

        return {
            formulario_Producto: false,
            validacion: [],
            editar_dato: false,
            data: [],
            datas: [],
            input_consulta_data: "",
            stickyHeader: true,
            noCollapse: false,
            money: {
                decimal: ",",
                thousands: ".",
                prefix: "$ ",
                suffix: "",
                precision: 0,
                masked: true /* doesn't work with directive */
            },
            fields: [{
                    key: 'Acciones',
                    label: "Acciones",
                    class: 'one-linea',
                    sortable: false
                },
                {
                    key: 'nombre',
                    sortable: true
                },
                {
                    key: 'imagen',
                    sortable: true
                },
                {
                    key: 'precio_venta',
                    sortable: true,
                    variant: 'success'
                },
                {
                    key: 'precio_venta_2',
                    sortable: true,
                    variant: 'info'
                },
                {
                    key: 'stock',
                    sortable: true
                },
                {
                    key: 'cantidad_disponible',
                    label: 'Cant Dis',
                    sortable: true
                },
                {
                    key: 'barra',
                    sortable: true
                },
                {
                    key: 'proveedor_id',
                    sortable: true,
                    variant: 'search_icon'
                },
            ],
            fields_list: [{
                    key: "Acciones",
                    stickyColumn: true,
                    label: "Acciones",
                    sortable: false
                },
                {
                    key: 'barra',
                    sortable: true
                },
                //{ key: 'nombre', sortable:true},
                //{ key: 'imagen', sortable:true},
                //{ key: 'precio_venta', sortable:true,variant: 'success' },
                //{ key: 'precio_venta_2', sortable:true,variant: 'info'},
                {
                    key: 'stock',
                    sortable: true
                },
                {
                    key: 'cantidad_disponible',
                    label: 'Cant Dis',
                    sortable: true
                },

                //{ key: 'proveedor_id', sortable:true,variant:'search_icon'},
            ],

            auditoria_data: [],
            input_Producto_id: [],
            data_foraneo_proveedor_id: [],
            input_id: [],
            input_nombre_proveedor: [],
            input_nombre: [],
            input_imagen: [],
            input_precio_caja: [],
            input_cantidad_caja: [],
            input_precio_unidad: [],

            input_iva: [],
            input_porcentaje_ganacia: [],
            input_precio_venta: [],
            input_precio_venta_2: [],
            input_ganacia: [],
            input_proveedor_id: [],
            input_stock: [],
            input_codigo_producto:[],
            input_cantidad_disponible: [],
            input_created_at: [],
            input_updated_at: [],

            consulta_tabla: [],
            consulta_datos: {},
            errors: {},
            mensaje_formulario: "",
            page: 1,
            input_lista_data: 1,
            lista_data: [{
                    value: 1,
                    text: 'lista'
                },
                {
                    value: 2,
                    text: 'lista grupo'
                },
                {
                    value: 3,
                    text: 'lista detalle'
                },

            ]

        };
    },
    mounted() {
        this.consulta();
        this.data_foraneo();
    },
    methods: {

        consulta(page = 1) {
            this.page = page;
            axios.get("Producto/consulta?page=" + page + "&consulta_data=" + this.input_consulta_data)
                .then(response => {
                    this.consulta_datos = response.data;
                    this.datas = response.data.data;
                    this.items = response.data.data;
                    this.consulta_tabla = response.data.data;
                });
        },
        data_foraneo() {
            axios.get("Producto/create").then(response => {
                this.productos_all = response.data;
                this.data_foraneo_proveedor_id = response.data.proveedor_id

            });
        },
        eliminar_registro(data_id) {
            this.input_Producto_id = data_id;
        },
        eliminar_registro_delete() {
            var data_id = this.input_Producto_id;
            axios.delete(`Producto/${this.input_Producto_id}`).then(response => {
                const data = response.data;
                if (response.data.id) {
                    this.validacion = "";
                    this.$toastr.info("Operacio exitosa", "Datos Eliminados");
                    this.consulta(this.page);
                }
            });

        },
        formatPrice(value) {
            let val = (value / 1).toFixed(0).replace(".", ",");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },
        anadir_registro() {
            this.validacion = "";
            this.formulario_Producto = true;
            this.editar_dato = false;
            this.limpiar_form();
            this.mensaje_formulario = "Añadir un nuevo registro"
        },
        formulario() {

            const data = {
                id: this.input_Producto_id,
                id: this.input_id,
                codigo_producto: this.input_codigo_producto,
                nombre_proveedor: this.input_nombre_proveedor,
                nombre: this.input_nombre,
                imagen: this.input_imagen,
                precio_caja: this.input_precio_caja,
                cantidad_caja: this.input_cantidad_caja,
                precio_unidad: this.input_precio_unidad,
                iva: this.input_iva,
                porcentaje_ganacia: this.input_porcentaje_ganacia,
                precio_venta: this.input_precio_venta,
                precio_venta_2: this.input_precio_venta_2,
                ganacia: this.input_ganacia,
                proveedor_id: this.input_proveedor_id,
                stock: this.input_stock,
                cantidad_disponible: this.input_cantidad_disponible,
                created_at: this.input_created_at,
                updated_at: this.input_updated_at,
                //npm install node-sass
                //name: this.input_name,
                //email: this.input_email
            };
            const formData = new FormData();
            formData.append("nombre_proveedor", this.input_nombre_proveedor);
            formData.append("codigo_producto", this.input_codigo_producto);
            formData.append("nombre", this.input_nombre);
            formData.append("imagen", this.input_imagen);
            formData.append("precio_caja", this.input_precio_caja);
            formData.append("precio_venta", this.input_precio_venta);
            formData.append("precio_venta_2", this.input_precio_venta_2);
            formData.append("proveedor_id", this.input_proveedor_id);
            formData.append("cantidad_disponible", this.input_cantidad_disponible);
            formData.append("stock", this.input_stock);

            if (this.editar_dato == true) {
                //axios.put(`Producto/${this.input_Producto_id}`, data)
                axios.post(`Producto/update/${this.input_Producto_id}`, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
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
                                this.formulario_Producto = false;

                            }
                        },
                        (err) => {
                            console.log("Err", err);
                            this.$toastr.warning(err, "Error en el servidor");
                            this.$toastr.warning(err.message, "Error en el servidor");
                        });

            } else {
                axios.post("Producto", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {

                        //axios.post("Producto", data).then(response => {
                        const datos = response.data;
                        if (response.data.errors) {
                            this.$toastr.warning("Verifique los datos", "Verifique los datos");
                            this.validacion = response.data.errors;
                        }
                        if (response.data.id) {
                            this.validacion = "";
                            this.$toastr.success("Operacio exitosa", "Datos modificados");
                            this.consulta(this.page);
                            this.formulario_Producto = false;
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
            this.formulario_Producto = false;
        },
        $can(permissionName) {
            return true;
            return Permissions.indexOf(permissionName) !== -1;

        },
        editar_registro(data_id) { //show 
            this.validacion = "";
            this.formulario_Producto = true;
            this.mensaje_formulario = "Editar un registro"
            axios.get(`Producto/${data_id}`).then(response => {
                const data = response.data;
                if (!response.data) {
                    this.$toastr.warning("Operacio no exitosa", "Regitro no obtenido");
                } else {
                    this.$toastr.success("Operacio exitosa", "Regitro obtenido");
                    this.editar_dato = true;
                    this.input_Producto_id = data.id
                    this.input_id = data.id;
                    this.input_nombre_proveedor = data.nombre_proveedor;
                    this.input_nombre = data.nombre;
                    this.input_imagen = data.imagen;
                    this.input_precio_caja = data.precio_caja;
                    this.input_cantidad_caja = data.cantidad_caja;
                    this.input_precio_unidad = data.precio_unidad;
                    this.input_iva = data.iva;
                    this.input_porcentaje_ganacia = data.porcentaje_ganacia;
                    this.input_precio_venta = data.precio_venta;
                    this.input_precio_venta_2 = data.precio_venta_2;
                    this.input_ganacia = data.ganacia;
                    this.input_stock = data.stock;
                    this.input_cantidad_disponible = data.cantidad_disponible;
                    this.input_proveedor_id = data.proveedor_id;
                    this.input_created_at = data.created_at;
                    this.input_updated_at = data.updated_at;
                    this.auditoria_data = data.auditoria;
                    this.input_codigo_producto = data.codigo_producto;

                    //this.input_user_id = data.id;
                    //this.input_name = data.name;
                }
            });
        },
        limpiar_form() {
            this.input_id = '';
            this.input_nombre_proveedor = '';
            this.input_nombre = '';
            this.input_imagen = '';
            this.input_precio_caja = '';
            this.input_cantidad_caja = '';
            this.input_precio_unidad = '';
            this.input_iva = '';
            this.input_porcentaje_ganacia = '';
            this.input_precio_venta = '';
            this.input_precio_venta_2 = '';
            this.input_ganacia = '';
            this.input_proveedor_id = '';
            this.input_codigo_producto = '';
            this.input_created_at = '';
            this.input_updated_at = '';

            this.validacion = "";

        },

    }
};
</script>

<style>
button {
    margin: 0px !important;
    padding-bottom: 0px !important;
    padding-top: 0px !important;
}

.table-b-table-default {

    padding-top: 0px !important;
    padding-bottom: 0px !important;

}
</style>
