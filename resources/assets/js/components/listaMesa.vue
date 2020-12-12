<template>
<div>
    <div class="row">
        <input type="hidden" class="form-control" value="1" required="required" autofocus v-model="actualiza_id">

        <div class="col-md-12">
            <div class="col-md-12">
                <!-- 
          <div v-bind:style="{ color: activeColor, fontSize: fontSize + 'px' }"></div>
         v-bind:style={   
            margin-bottom: 5px, 
            margin: 5px,
            background-color:lista_mesas.elemento_color_id_pk.background-color,
            color:lista_mesas.elemento_color_id_pk.color,
            border-color:lista_mesas.elemento_color_id_pk.border-color
          }
        -->
                <div v-bind:style="{ display: ['margin: 5px', '-ms-flexbox', 'flex'] }">
                    <button v-for="lista_mesas in lista_mesa" v-bind:key="lista_mesas.id" @click="lista_mesa_add(lista_mesas.id)" type="button" class="btn btn-success btn-lg" data-toggle="button" aria-pressed="false">{{ lista_mesas.nombre }}
                    </button>

                    <Select2 width="80px" placeholder="producto" :required="true" v-model="input_lista_precio_id" :options="lista_precio" :myOptions="lista_precio" />

                </div>
            </div>
            <br>
        </div>
        <div v-for="venta in ventas" v-bind:key="venta.id" class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <h3><b>{{ venta.mesa_id_pk.nombre }}</b></h3>
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button @click="cobra_todo(venta.id)" class="btn btn-focus">Cerrar</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Productos</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="producto in venta.ventas_has_producto_all" v-bind:key="producto.id">
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="widget-content-left">
                                                    <a v-b-modal.modal-1 @click="Edita_producto(producto)">
                                                        <img width="40" class="rounded-circle" v-bind:src="'intervenir/' + producto.producto_id_pk.imagen">
                                                    </a>
                                                </div>
                                            </div>
                                            <Select2 v-if="editar_producto && producto.id == actualiza_id" placeholder="producto" :required="true" v-model="actualiza_producto_id" :options="productos_all" :myOptions="productos_all" />

                                            <div v-else class="widget-content-left flex2">
                                                <div class="widget-heading">{{ producto.producto_id_pk.nombre }}</div>
                                                <div class="widget-subheading opacity-7"><span class="precio-color">{{ formatPrice(producto.precio) }}</span> - <span class="color-hora"> {{ producto.created_at.substr(11,18)}}</span>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </td>

                                <td v-if="editar_producto && producto.id == actualiza_id" class="text-center">
                                    <input type="number" name="cantidad" class="form-control" value="1" required="required" autofocus v-model="actualiza_cantidad">
                                </td>
                                <td v-else class="text-center">

                                    <b-form-spinbutton id="demo-sb" v-model="producto.cantidad" v-on:change="editarCatidad(producto)" min="1" max="100"></b-form-spinbutton>

                                </td>

                                <td v-if="editar_producto && producto.id == actualiza_id" class="text-center">
                                    <div v-if="editar_producto && producto.id == actualiza_id">
                                        <input type="text" class="form-control" value="1" min="1" required="required" autofocus v-model="input_producto_precio" style="width: 100%;">
                                    </div>

                                </td>

                                <td v-else class="text-center">
                                    <div class="font-size-xlg text-muted">
                                        <small class="opacity-5 pr-1">$</small>
                                        <span>{{ formatPrice(producto.cantidad*producto.precio) }}</span>
                                        <small class="text-warning pl-2">
                                            <i class="fa fa-dot-circle"></i>
                                        </small>
                                    </div>
                                </td>

                                <td class="text-center" v-if="editar_producto && producto.id == actualiza_id">
                                    <button @click="post_editar_producto()" class="btn btn-info btn-sm">Modificar</button>
                                    <button @click="cancelar_editar_producto()" class="btn btn-danger btn-sm">Cancelar</button>
                                </td>
                                <td class="text-center" v-else>
                                    <button @click="Editar_producto(producto)" class="btn btn-info btn-sm" title="Editar">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                    </button>
                                    <button @click="duplicar_producto(producto.producto_id_pk.id,venta.id,producto.cantidad,producto.precio )" class="btn btn-success" title="Duplicar producto">
                                        <i class="fa fa-clone" aria-hidden="true"></i>
                                    </button>
                                    <button @click="Eliminar_producto(producto.id)" class="btn btn-danger" title="Eliminar producto">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td></td>
                                <th class="text-center">
                                    <div class="font-size-xlg text-muted">
                                        <small class="opacity-5 pr-1">$</small>
                                        <span>{{ formatPrice(venta.total_ventas) }}</span>
                                        <small class="text-warning pl-2">
                                            <i class="fa fa-dot-circle"></i>
                                        </small>
                                    </div>
                                </th>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-block text-center card-footer">
                    <form class="form-inline" action v-on:submit.prevent="newproducto(venta.id)">
                        <div class="col-md-5 mr-sm-6 mb-sm-6  form-group">

                            <Select2 @change="buscar_productos()" style="width:100%" placeholder="producto" :required="true" v-model="producto_id" :options="productos_all" :myOptions="productos_all" :settings="{ placeholder: 'Producto', width: '100%' }">
                                <template slot="selected-option" slot-scope="options">
                                    <div class="flex">
                                        <div class="col">
                                            <span class="fa" :class="options.icon"></span>
                                            <span>Selected item: {{ options.titles }}</span>
                                        </div>
                                    </div>
                                </template>
                                <template slot="options" slot-scope="options">
                                    <span class="fa" :class="options.icon"></span>
                                    {{ options.titles }}
                                </template>
                            </Select2>

                        </div> 
                        <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                            <label for="examplePassword22" class="mr-sm-2">$</label>
                            <money class="form-control" v-model="input_producto_precio" v-bind="money"></money>
                        </div>
                        <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                            <label for="examplePassword22" class="mr-sm-2">Cant </label>
                            <b-form-spinbutton id="demo-sb" v-model="cantidad" min="1" max="100"></b-form-spinbutton>

                        </div>
                        <button class="btn-wide btn btn-success" style="margin-left: 10px;">Añadir</button>
                    </form>
                </div>
                <div>
                    <b-button v-b-toggle.collapse-4 class="m-1">Grupacion de productos</b-button>
                    <b-collapse  id="collapse-4">
                        <span>


                  <div class="table-responsive">
                    
                    <table  class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Productos</th>
                                <th class="text-center">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                            <tr v-for="producto in venta.grupo_venta" v-bind:key="producto.producto_id">
                                <td style="padding-top: 1px;padding-bottom: 1px;">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="widget-content-left">
                                                    <a v-b-modal.modal-1 @click="Edita_producto(producto)">
                                                        <img width="40" class="rounded-circle" v-bind:src="'intervenir/' + producto.producto_id_pk.imagen">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                  {{producto.producto_id_pk.nombre}}
                                </td>
                                <td>
                                  <div class="widget-heading">{{ producto.cantidad_grupa }}</div>
                                </td>
                            </tr></tbody></table></div>




                        </span>

                        <b-card></b-card>
                    </b-collapse>
                </div>
                <div>
                    <b-button v-b-toggle.collapse-3 class="m-1">Lista Producto</b-button>
                    <b-collapse visible id="collapse-3">
                        <span v-for="data in dataForaneoListaProducto" v-bind:key="data.id">

                            <img width="40" class="rounded-circle" v-on:click="selecionar_productos(data.producto_id_pk, venta.id)" v-bind:src="'intervenir/' + data.producto_id_pk.imagen">

                        </span>

                        <b-card></b-card>
                    </b-collapse>
                </div>
            </div>

        </div>
    </div>

    <b-modal id="modal-1" size="xl" title="BootstrapVue">

        <form action v-on:submit.prevent="formulario_producto()">

            <div class="row">

                <div class="form-group col-4">
                    <label for="exampleInputEmail1">Nombre Proveedor</label>
                    <input type="text" class="form-control" v-model="input_nombre_proveedor" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group col-4">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" v-model="input_nombre" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group col-2">
                    <label for="exampleInputEmail1">Precio 1</label>
                    <input type="text" class="form-control" v-model="input_precio_1" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group col-2">
                    <label for="exampleInputEmail1">Precio 2</label>
                    <input type="text" class="form-control" v-model="input_precio_2" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>

                <div class="form-group col-4">
                    <label for="exampleInputEmail1">Proveedor</label>
                    <Select2 style="width:100%" :required="true" v-model="input_proveedor_id" :options="data_foraneo_proveedor_id" :myOptions="data_foraneo_proveedor_id" />
                </div>
                <div class="form-group col-4">
                    <label for="exampleInputEmail1">Imagen</label>
                    <b-form-file v-model="input_imagen" class="mt-3" plain></b-form-file>
                </div>
              
            </div>

        </form>
      <template #modal-footer="{ }">
         
            <b-button size="sm" variant="success" @click="formulario_producto()">
              Actualizar
            </b-button>
        
    </template>
    </b-modal>
</div>
<!--

<script src="https://unpkg.com/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/vue-toastr-2/dist/vue-toastr-2.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/vue-toastr-2/dist/vue-toastr-2.min.css">
  -->
</template>

<script type="application/javascript">
import Vue from "vue";
import VueSingleSelect from "vue-single-select";
import Select2 from 'v-select2-component';
import {Money} from 'v-money'

//import VueToast from "vue-toast-notification";
//import "vue-toast-notification/dist/index.css"; 

//https://www.npmjs.com/package/vue-toastr-2
import VueToastr2 from "vue-toastr-2";
import "vue-toastr-2/dist/vue-toastr-2.min.css";
window.toastr = require("toastr");
Vue.use(VueToastr2);

export default {
  data() {
    venta_id: "";
    operacion: "";
    //form para actualizar

    actualiza_producto_id: "";
    actualiza_cantidad: "";

    return {
      editar_producto: false,
      ventas: [],
      thoughts: [],
      thought: [],
      venta: [],
      actualiza_id: "",
      producto_id: "",
      cantidad: "1",
      productos_all: [],
      input_producto_precio:[],
      lista_mesa: [],
      input_precio_1:[],
      input_precio_2:[],
      grupa_ventas:[],
      input_nombre_proveedor:[],
      input_nombre:[],
      input_imagen:[],
      input_precio_1:[],
      input_precio_2:[],
      input_proveedor_id:[],
      input_lista_precio_id:1,
      data_foraneo_proveedor_id:[],
      dataForaneoListaProducto:[],
      money: {
          decimal: ',',
          thousands: '.',
          prefix: '$',
          suffix: '',
          precision: 0,
          masked: false
      },
      lista_precio:[
        {id:1,text:'1'},
        {id:2,text:'2'}
        ]
    };
  },
  mounted() {
    this.fetchArticles();
    axios.get("productos_all").then(response => {
      this.productos_all = response.data;
    });
    axios.get("mesa/lista_mesa").then(response => {
      this.lista_mesa = response.data;
    });
    axios.get("mesa/proveedores").then(response => {
      this.data_foraneo_proveedor_id = response.data;
    });
    axios.get("mesa/listaProducto").then(response => {
      this.dataForaneoListaProducto = response.data;
    });
  },
  components: {
    VueSingleSelect,
    VueToastr2,
    Select2,
    Money
  },
  methods: {
    formatPrice(value) {
      let val = (value / 1).toFixed(0).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
    selecionar_productos(producto,venta_id){
      if(this.input_lista_precio_id==1){
        this.input_producto_precio = producto.precio_venta;
      }
      if(this.input_lista_precio_id==2){
        this.input_producto_precio = producto.precio_venta_2;
      }
      this.producto_id=producto.id
    },
    buscar_productos(){

      axios.get(`Producto/${this.producto_id}`).then(response => {
          const datas = response.data;
          if(this.input_lista_precio_id==1){
            this.input_producto_precio = datas.precio_venta;
          }
          if(this.input_lista_precio_id==2){
            this.input_producto_precio = datas.precio_venta_2;
          }

      });

    },
    editarCatidad(producto) {
      const params = {
        id: producto.id,
        producto_id: producto.producto_id,
        cantidad: producto.cantidad,
        precio: producto.precio
      }; 

      axios.put(`ventas_has_producto/${producto.id}`, params)
        .then(response => {
          const venta = response.data;

          this.fetchArticles();
      });
    },
    fetchArticles(page_url) {
      let vm = this;
      page_url = page_url || "venta/obtener_data";
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.ventas = res.data;
        //  this.grupa_ventas= res.data.grupa_ventas
          //vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    Eliminar_producto(id) {
      if (confirm("Esta seguro que desea eliminar?")) {
        const params = {
          _token: "sweedee"
        };
        axios.delete(`ventas_has_producto/${id}`, params).then(response => {
          const venta = response.data;
          console.info(response.data);
          this.fetchArticles();
        });
      }
    },
    cobra_todo(venta_id) {
      axios
        .post(`ventas_has_producto/cobra_todo/${venta_id}`)
        .then(response => {
          const venta = response.data;
          console.info(response.data);
          this.fetchArticles();
        });
    },
    duplicar_producto(producto_id,venta_id,cantidad,precio){
      const params = {
        producto_id: producto_id,
        ventas_id: venta_id,
        cantidad: cantidad,
        precio: precio,

      };
      axios
        .post(`ventas_has_producto/duplicar_productos`, params)
        .then(response => {
          const venta = response.data;
          this.fetchArticles();
        });
    },

    Editar_producto(producto) {
      this.editar_producto = true;

      this.input_producto_precio = producto.precio;
      this.actualiza_id = producto.id;
      this.actualiza_producto_id = producto.producto_id_pk.id;
      this.actualiza_cantidad = producto.cantidad;
    },
    lista_mesa_add(mesa_id) {
      axios.get(`ventas_has_producto/lista_mesa_add/${mesa_id}`).then(response => {
          const venta = response.data;

          if (venta.nombre == false) {
            this.$toastr.info("mesa ocupada", "mesa creada");
          } else {
            this.$toastr.success("mesa creada con exito", "mesa creada");
          }
          this.fetchArticles();
      });
    },
    post_editar_producto() {
      this.editar_producto = false;

      const params = {
        id: this.actualiza_id,
        producto_id: this.actualiza_producto_id,
        cantidad: this.actualiza_cantidad,
        precio: this.input_producto_precio

      }; 
      axios.put(`ventas_has_producto/${this.actualiza_id}`, params)
        .then(response => {
          const venta = response.data;

          this.fetchArticles();
      });
    },
    cancelar_editar_producto() {
      this.editar_producto = false;
    },
    Edita_producto(producto){

      axios.get(`Producto/${producto.producto_id}`).then(response => {
            const data = response.data;
            if(!response.data){
            }else{

              this.input_producto_id = data.id
              this.input_nombre_proveedor = data.nombre_proveedor
              this.input_nombre = data.nombre
              this.input_precio_1 = data.precio_venta
              this.input_precio_2 = data.precio_venta_2
              this.input_proveedor_id = data.proveedor_id

            }
      });

    },
    formulario_producto(){
      const data = {
        nombre_proveedor:this.input_nombre_proveedor,
        imagen:this.input_imagen,
        nombre:this.input_nombre,
        precio_venta:this.input_precio_1,
        precio_venta_2:this.input_precio_2,
        proveedor_id:this.input_proveedor_id,

        };
          const formData = new FormData();
            formData.append("nombre_proveedor", this.input_nombre_proveedor);
            formData.append("nombre", this.input_nombre);
            formData.append("imagen", this.input_imagen);
            formData.append("precio_venta", this.precio_venta);
            formData.append("precio_venta_2", this.precio_venta_2);
            formData.append("proveedor_id", this.input_proveedor_id);
            

       axios.post(`Producto/update/${this.input_producto_id}`, formData, {
            headers: {'Content-Type': 'multipart/form-data'
  }
        }).then(response => {
        const venta = response.data;
        if(response.data.id){
          this.$toastr.success("Operacio exitosa", "Datos modificados");
        }
      //  this.fetchArticles();
      });

    },
    newproducto(venta_id) {
      //añadir un nuevo productos
      console.info(venta_id);
      console.info(this.ventas);
      console.info(this.venta[0]);
      const params = {
        producto_id: this.producto_id,
        cantidad: this.cantidad,
        ventas_id: venta_id,
        precio:this.input_producto_precio
      };
      this.producto_id = "";
      this.cantidad = 1;
      //this.ventas_id = '';
      axios.post("ventas_has_producto", params).then(response => {
        const venta = response.data;

        this.fetchArticles();
      });
    },
    clearForm() {
      //this.edit = false;
      this.producto_id.id = null;
      this.this.cantidad = 1;
      //this.article.title = '';
    }
  }
};

</script>

<style>
.precio-color {
    color: #0c08eeec;
    font-weight: bold;
}

.color-hora {
    color: #f11e1eec;
    font-weight: bold;
}

.select2-container {
    width: 100%;
}
</style>
