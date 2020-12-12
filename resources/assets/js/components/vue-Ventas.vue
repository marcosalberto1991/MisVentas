<template>
<div class="row">
    <div v-if="formulario_Ventas" class="col-lg-12 ">
        <div class="main-card mb-3 card formulario">
            <div class="card-body"><h1 class="card-title"></h1>
                  <h2>Formulario </h2>
                    <div class="col-md-12 row">
                      <div class="form-group col-md-12 col-sm-12" style="margin-bottom: 6px;">
                        <button type="submit"  @click="formulario()" class="btn btn-primary">Guardar </button> 
                        <a class="btn btn-warning" @click="cancelar_registro()" >Cancelar</a>
                      </div>
                    </div>
                    <div class="col-lg-12">

      <form ref="form"   v-on:submit.prevent="formulario()">
        <div class="row"> 
          <div class="col-md-12 row">
            <input type="hidden" v-model="input_Ventas_id">   
  
  
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>id</b></label>
                <input type="text" v-model="input_id" placeholder="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.id" variant="danger" >{{validacion.id[0]}}</b-alert>
                
            </div>
                
  
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>precio</b></label>
                <input type="text" v-model="input_precio" placeholder="precio" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.precio" variant="danger" >{{validacion.precio[0]}}</b-alert>
                
            </div>
                
            <div class="form-group col-md-4 col-sm-12">
              <label for="exampleInputEmail1">mesa_id</label>
              <Select2 v-model="input_mesa_id" :options="data_foraneo_mesa_id" :settings="{ settingOption: value, settingOption: value }"/>
              <small id="emailHelp" class="form-text text-muted"></small>
              <b-alert show  v-if="validacion.mesa_id" variant="danger" >{{validacion.mesa_id[0]}}</b-alert>
            </div>
          
  
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>lista_precio_id</b></label>
                <input type="text" v-model="input_lista_precio_id" placeholder="lista_precio_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.lista_precio_id" variant="danger" >{{validacion.lista_precio_id[0]}}</b-alert>
                
            </div>
                
  
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>estado_id</b></label>
                <input type="text" v-model="input_estado_id" placeholder="estado_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.estado_id" variant="danger" >{{validacion.estado_id[0]}}</b-alert>
                
            </div>
                
  
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>updated_at</b></label>
                <input type="text" v-model="input_updated_at" placeholder="updated_at" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.updated_at" variant="danger" >{{validacion.updated_at[0]}}</b-alert>
                
            </div>
                
  
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>created_at</b></label>
                <input type="text" v-model="input_created_at" placeholder="created_at" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.created_at" variant="danger" >{{validacion.created_at[0]}}</b-alert>
                
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
  <div class='card-body'><h1 class=''>Lista de Ventas </h1>  
  
    <nav>
      <pagination :data='consulta_datos' @pagination-change-page='consulta'></pagination>
    </nav>
      
    <div class='col-12'>
      <b-button v-if="$can('Ventas Anadir')"  @click='anadir_registro()' type='button' class='btn btn-wangir btn-lg' data-toggle='button' size='sm' aria-pressed='false' variant='success' style='margin-bottom: 5px; margin: 5px;'>Añadir registro
      </b-button>
      <div class='flexbox  float-right' >
        <form ref='form'    v-on:submit.prevent='consulta()'>
          <b-input-group size='sm' class='float-right  margin-bottom-0' prepend=''  style='margin-bottom: 0px;'>
            <b-form-input type='text' v-model='input_consulta_data' ></b-form-input>
            <b-input-group-append>
              <b-button @click='consulta()' size='sm' text='Button' variant='success'>Buscar</b-button>
            </b-input-group-append>
          </b-input-group>
        </form>
      </div><br><br>
    </div>
      
      <b-table :items='consulta_tabla' :fields='fields' 
      responsive='sm'  :no-border-collapse='noCollapse'>
      
      <template v-slot:cell(suma_total)='data'>
       $ {{ formatPrice(data.item.suma_total)}}
      </template>
      <template v-slot:cell(Acciones)='data'>

          <b-button-group>
            <b-button v-if="$can('Ventas Eliminar')"  v-b-modal.moda-registro size='sm' variant='warning' @click='editar_registro(data.item.id)' type='button' class='btn-sm btn btn-wangir mr-1' data-toggle='button' aria-pressed='false' style='margin: 0px;'>
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>

            </b-button>
            <b-button v-if="$can('Ventas Eliminar')"  v-b-modal.moda-eliminar @click='eliminar_registro(data.item.id)'
                type='button' class='btn-sm btn btn-danger mr-1' size='sm' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 0px;'><i class="fa fa-trash-o" aria-hidden="true"></i>

            </b-button>
            <!--  
            <a v-bind:href=" data.item.id+'/Sucursale'"  class='btn-sm btn btn-success mr-1' size='sm'  style='margin-bottom: 5px; margin: 5px;'>Surcusales </a>
            -->
          </b-button-group>

         <b-button size="sm" @click="data.toggleDetails" style='margin-bottom: 5px; margin: 5px;' class="btn-sm mr-2 btn-sm-mass">
            {{ data.detailsShowing ? 'Menos' : 'Mas'}} Detalle
          </b-button>


        </template>
        <template v-slot:cell(show_details)="row">
                
        </template>
        <template v-slot:row-details="row">
          <table class="table b-table table-striped producto-t ">
            <thead>
                <tr>
                  <th scope="col">Producto</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="producto in row.item.ventas_has_producto_all_ventas" v-bind:key="producto.id">
                  <td scope="row">{{producto.producto_id.nombre}}</td>
                  <td>{{producto.cantidad}}</td>
                  <td>$ {{ formatPrice(producto.precio) }}</td>
                  <td>$ {{ formatPrice(producto.precio*producto.cantidad)}}</td>
                </tr>
                <tr>

                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <b><span style="">$ {{ formatPrice(row.item.suma_total)}}</span></b>
                  </td>
                  </tr>
              </tbody>
          </table>
          <!--
          <b-card class="bg-arielle-edyconst">
            <b-row>
              <b-col cols="3"><b>Producto</b></b-col>
              <b-col cols="1"><b>Cantidad</b></b-col>
              <b-col cols="1"><b>Precio</b></b-col>
              <b-col cols="1"><b>Total</b></b-col>
            </b-row>
            <b-row style="border-top-width: 2px;" 
            striped class="col-mb-12" 
            v-for="producto in row.item.ventas_has_producto_all_ventas" v-bind:key="producto.id"
            >
              <b-col cols="3"  >
                {{producto.producto_id.nombre}}                     
              </b-col>
              <b-col sm="1" class="text-sm-right" >
                {{producto.cantidad}}
              </b-col>
              <b-col sm="1" class="text-sm-right" >
                $ {{ formatPrice(producto.precio) }}
              </b-col>
              <b-col sm="1" class="text-sm-right" >
                $ {{ formatPrice(producto.precio*producto.cantidad)}}
              </b-col>
              

            </b-row>
            
   
            <b-row>
              <b-col sm="3" class="text-sm-right" >
              </b-col>
              <b-col sm="1" class="text-sm-right" >
              </b-col>
              <b-col sm="1" class="text-sm-right" >
              </b-col>
   
              <b-col sm="1" class="text-sm-right" >
                <b><span style="">$ {{ formatPrice(row.item.suma_total)}}</span></b>
              </b-col>
            
            </b-row>
           -->
           <!-- 
            <b-row class="mb-2">
              <b-col sm="3" class="text-sm-right"><b>Tercero:</b></b-col>
              <b-col style="white-space: none">{{ row.item.users_id.primer_nombre }}</b-col>
            </b-row>
            <b-row class="mb-2">
              <b-col sm="3" class="text-sm-right"><b>Estado:</b></b-col>
              <b-col style="white-space: none">{{ row.item.estado_id.nombre }}</b-col>
            </b-row>

            <b-row class="mb-2">
              <b-col sm="3" class="text-sm-right"><b>Nombre Proyecto:</b></b-col>
              <b-col style="white-space: none">{{ row.item.proyecto_id.nombre }}</b-col>
            </b-row>

            <b-button size="sm" @click="row.toggleDetails">Menos Detalle</b-button>

            <b-button target="_blank" v-if="$can('enviar notificacion')" class='btn-sm btn btn-info mr-1' v-bind:href=" +row.item.id+'/mail/enviar_informe_lista/'"   size="sm" @click="row.toggleDetails">Enviar Notificacion por correo </b-button>
          
          </b-card>
          -->
        </template>
        <template v-slot:head(Acciones)='scope'>
          <div class='text-nowrap'>Acciones</div>
        </template>
      </b-table>
            
</div>
</div>
</div>




<b-modal id="moda-eliminar"  size="xl" hide-footer >
  <template slot="modal-title">Eliminar un Registro </template>
  <div class="d-block text-center">
    <h3>¿Desea eliminar el registro permanente?</h3>
    <b-button class="mt-3 btn btn-danger " @click="eliminar_registro_delete()">Eliminar</b-button>
  </div>
</b-modal>


</div>
</template>




<script type="application/javascript">
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
      formulario_Ventas:false,
      validacion: [],
      editar_dato: false,
      data: [],
      datas: [],
      input_consulta_data:"",
      stickyHeader: true,
      noCollapse: false,
      fields: [
      { key: "Acciones",stickyColumn: true, label:"Acciones" ,sortable: false },
      { key: 'id', sortable:true},
      { key: 'precio', sortable:true},
      { key: 'mesa_id.nombre', sortable:true},
      { key: 'suma_total', sortable:true},
      { key: 'estado_id.nombre', sortable:true},
      { key: 'updated_at', sortable:true},
      { key: 'created_at', sortable:true},
      
      ],


      input_Ventas_id:[],
      data_foraneo_mesa_id:[],
      input_id:[],
      //input_precio:[],
      //input_mesa_id:[],
      //input_lista_precio_id:[],
      //input_estado_id:[],
      //input_updated_at:[],
      //input_created_at:[],
      //
      consulta_tabla:[],
      consulta_datos: {},
      errors: {},
      mensaje_formulario: "",
      page:1,
      
    };
  },
  mounted() {
    this.consulta();
    this.data_foraneo();
  },
  methods: {
    
    consulta(page = 1){
      this.page=page;
      axios.get("Ventas/consulta?page=" +page+"&consulta_data="+this.input_consulta_data)
      .then(response => {
        this.consulta_datos = response.data;
        this.datas=response.data.data;
        this.items=response.data.data;
        this.consulta_tabla=response.data.data;
      });
    },
    data_foraneo(){
      axios.get("Ventas/create").then(response => {
        this.productos_all = response.data;
        this.data_foraneo_mesa_id= response.data.mesa_id
        
      });
    },
    eliminar_registro(data_id){
    this.input_Ventas_id=data_id;
    },
    eliminar_registro_delete(){
      var data_id=this.input_Ventas_id;
      axios.delete(`Ventas/${this.input_Ventas_id}`).then(response => {
        const data = response.data;
        if(response.data.id){
          this.validacion="";
          this.$toastr.info("Operacio exitosa", "Datos Eliminados");
          this.consulta(this.page);
        }
      });
      
    },
    anadir_registro(){
      this.validacion="";
      this.formulario_Ventas=true;
      this.editar_dato = false;
      this.limpiar_form();
      this.mensaje_formulario="Añadir un nuevo registro"
    },
    formulario(){

      const data = {
        id: this.input_Ventas_id,
        id :this.input_id,
        precio :this.input_precio,
        mesa_id :this.input_mesa_id,
        lista_precio_id :this.input_lista_precio_id,
        estado_id :this.input_estado_id,
        updated_at :this.input_updated_at,
        created_at :this.input_created_at,
        
        //name: this.input_name,
        //email: this.input_email
      };
      
      if(this.editar_dato == true){
        axios.put(`Ventas/${this.input_Ventas_id}`, data)
        .then(response => {

            const datos = response.data;
            if(response.data.errors){
              this.$toastr.warning("Verifique los datos", "Verifique los datos");
              this.validacion=response.data.errors;
            }
            if(response.data.id){
              this.validacion="";
              this.$toastr.success("Operacio exitosa", "Datos modificados");
              this.consulta(this.page);
              this.formulario_Ventas=false;


            }
        },
        (err) => {
          console.log("Err", err);
            this.$toastr.warning(err, "Error en el servidor");
            this.$toastr.warning(err.message, "Error en el servidor");
        });

      }else{
        
        axios.post("Ventas", data).then(response => {
            const datos = response.data;
            if(response.data.errors){
              this.$toastr.warning("Verifique los datos", "Verifique los datos");
              this.validacion=response.data.errors;
            }
            if(response.data.id){
              this.validacion="";
              this.$toastr.success("Operacio exitosa", "Datos modificados");
              this.consulta(this.page);
              this.formulario_Ventas=false;
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
    cancelar_registro(){
      this.formulario_Ventas=false;
    },
    $can(permissionName) {
      return true;
      return Permissions.indexOf(permissionName) !== -1;
    },
    editar_registro(data_id){//show 
      this.validacion="";
      this.formulario_Ventas=true;  
      this.mensaje_formulario="Editar un registro"
        axios.get(`Ventas/${data_id}`).then(response => {
            const data = response.data;
            if(!response.data){
              this.$toastr.warning("Operacio no exitosa", "Regitro no obtenido");
            }else{
              this.$toastr.success("Operacio exitosa", "Regitro obtenido");
              this.editar_dato = true;
              this.input_Ventas_id = data.id
              this.input_id = data.id;
              this.input_precio = data.precio;
              this.input_mesa_id = data.mesa_id;
              this.input_lista_precio_id = data.lista_precio_id;
              this.input_estado_id = data.estado_id;
              this.input_updated_at = data.updated_at;
              this.input_created_at = data.created_at;
              
              //this.input_user_id = data.id;
              //this.input_name = data.name;
            }
        });
    },
    limpiar_form(){
      this.input_id = '';
      this.input_precio = '';
      this.input_mesa_id = '';
      this.input_lista_precio_id = '';
      this.input_estado_id = '';
      this.input_updated_at = '';
      this.input_created_at = '';
      
      this.validacion="";

    },
    formatPrice(value) {
      let val = (value / 1).toFixed(0).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
   
  }
};


</script>
<style>
.producto-t{
    background-color: #dcdcdc!important;
}
</style>



