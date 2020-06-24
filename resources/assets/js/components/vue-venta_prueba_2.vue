<template>
<div class="row">
    <div v-if="formulario_venta_prueba" class="col-lg-12 ">
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
            <input type="hidden" v-model="input_venta_prueba_id">   
  
  
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>id</b></label>
                <input type="text" v-model="input_id" placeholder="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.id" variant="danger" >{{validacion.id[0]}}</b-alert>
                
            </div>
                
  
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>fecha_venta</b></label>
                <input type="text" v-model="input_fecha_venta" placeholder="fecha_venta" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.fecha_venta" variant="danger" >{{validacion.fecha_venta[0]}}</b-alert>
                
            </div>
                
            <div class="form-group col-md-4 col-sm-12">
              <label for="exampleInputEmail1">users_id</label>
              <Select2 v-model="input_users_id" :options="data_foraneo_users_id" :settings="{ settingOption: value, settingOption: value }"/>
              <small id="emailHelp" class="form-text text-muted"></small>
              <b-alert show  v-if="validacion.users_id" variant="danger" >{{validacion.users_id[0]}}</b-alert>
            </div>
          
            <div class="form-group col-md-4 col-sm-12">
              <label for="exampleInputEmail1">estado_venta_id</label>
              <Select2 v-model="input_estado_venta_id" :options="data_foraneo_estado_venta_id" :settings="{ settingOption: value, settingOption: value }"/>
              <small id="emailHelp" class="form-text text-muted"></small>
              <b-alert show  v-if="validacion.estado_venta_id" variant="danger" >{{validacion.estado_venta_id[0]}}</b-alert>
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
  <div class='card-body'><h2 class=''>Lista de venta_prueba </h2>  
    <nav>
      <pagination :data='consulta_datos' @pagination-change-page='consulta'></pagination>
    </nav>
  <nav class='row'> 
    <div class='col-md-9 col-sm-12'>
      <b-button v-if="$can('venta_prueba Anadir')"  @click='anadir_registro()' type='button' class='btn btn-wangir btn-lg' data-toggle='button' size='sm' aria-pressed='false' variant='success' style='margin-bottom: 0px; margin: 0px;'>Añadir registro
      </b-button>
    </div>
    <div class='col-md-3 col-sm-12'>
      

        <form ref='form'    v-on:submit.prevent='consulta()'>
          <b-input-group size='sm' class='float-right  margin-bottom-0' prepend=''  style='margin-bottom: 0px;'>
          <!--  
          <b-form-input type='text'  v-model='input_consulta_data' ></b-form-input>
            -->
            <b-form-input
              v-model='input_consulta_data'
              type='search'
              @change='consulta()'
              id='filterInput'
              placeholder='Buscar'
            ></b-form-input>
            <b-input-group-append>
            


              <b-button @click='consulta()' size='sm' text='Button' variant='success'>Buscar</b-button>
            </b-input-group-append>
          </b-input-group>
        </form>
      <!--
      </div>
      -->
      
    </div>
    </nav><br>
      
      
      <b-table :items='consulta_tabla' :fields='fields' 
      responsive='sm' :sticky-header='stickyHeader' :no-border-collapse='noCollapse'>
      <template v-slot:cell(Acciones)='data'>

          <b-button-group class="one-linea">
            <b-button  size='sm' variant='warning' @click='editar_registro(data.item.id)' type='button' class='btn-sm btn btn-wangir mr-1' data-toggle='button' aria-pressed='false'>Editar
            </b-button>
            <b-button v-if="$can('venta_prueba Eliminar')"  v-b-modal.moda-eliminar @click='eliminar_registro(data.item.id)'
                type='button' class='btn-sm btn btn-danger mr-1 ' size='sm' data-toggle='button' aria-pressed='false' ><img width="15px" src="svg/trash-can_115312.svg"  style="margin-right: 5px;float: left;" > <span class="d-none d-sm-none d-md-block"> Eliminar</span>
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
      formulario_venta_prueba:false,
      validacion: [],
      editar_dato: false,
      data: [],
      datas: [],
      input_consulta_data:"",
      stickyHeader: true,
      noCollapse: false,
      fields: [
      { key: "Acciones",stickyColumn: true, label:"Acciones" ,sortable: false },
      { key: 'id', sortable:true,class:'truncate one-linea'},
      { key: 'fecha_venta', sortable:true,class:'truncate one-linea'},
      { key: 'users_id', sortable:true,class:'truncate one-linea'},
      { key: 'estado_venta_id', sortable:true,class:'truncate one-linea'},
      { key: 'created_at', sortable:true,class:'truncate one-linea'},
      { key: 'updated_at', sortable:true,class:'truncate one-linea'},
      
      ],


      input_venta_prueba_id:[],
      data_foraneo_users_id:[],data_foraneo_estado_venta_id:[],
      input_id:[],
      input_fecha_venta:[],
      input_users_id:[],
      input_estado_venta_id:[],
      input_created_at:[],
      input_updated_at:[],
      
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
      axios.get("venta_prueba/consulta?page=" +page+"&consulta_data="+this.input_consulta_data)
      .then(response => {
        this.consulta_datos = response.data;
        this.datas=response.data.data;
        this.items=response.data.data;
        this.consulta_tabla=response.data.data;
      });
    },
    data_foraneo(){
      axios.get("venta_prueba/create").then(response => {
        this.productos_all = response.data;
        this.data_foraneo_users_id= response.data.users_id
        this.data_foraneo_estado_venta_id= response.data.estado_venta_id
        
      });
    },
    eliminar_registro(data_id){
    this.input_venta_prueba_id=data_id;
    },
    eliminar_registro_delete(){
      var data_id=this.input_venta_prueba_id;
      axios.delete(`venta_prueba/${this.input_venta_prueba_id}`).then(response => {
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
      this.formulario_venta_prueba=true;
      this.editar_dato = false;
      this.limpiar_form();
      this.mensaje_formulario="Añadir un nuevo registro"
    },
    formulario(){

      const data = {
        id: this.input_venta_prueba_id,
        id :this.input_id,
        fecha_venta :this.input_fecha_venta,
        users_id :this.input_users_id,
        estado_venta_id :this.input_estado_venta_id,
        created_at :this.input_created_at,
        updated_at :this.input_updated_at,
        
        //name: this.input_name,
        //email: this.input_email
      };
      
      if(this.editar_dato == true){
        axios.put(`venta_prueba/${this.input_venta_prueba_id}`, data)
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
              this.formulario_venta_prueba=false;


            }
        },
        (err) => {
          console.log("Err", err);
            this.$toastr.warning(err, "Error en el servidor");
            this.$toastr.warning(err.message, "Error en el servidor");
        });

      }else{
        
        axios.post("venta_prueba", data).then(response => {
            const datos = response.data;
            if(response.data.errors){
              this.$toastr.warning("Verifique los datos", "Verifique los datos");
              this.validacion=response.data.errors;
            }
            if(response.data.id){
              this.validacion="";
              this.$toastr.success("Operacio exitosa", "Datos modificados");
              this.consulta(this.page);
              this.formulario_venta_prueba=false;
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
      this.formulario_venta_prueba=false;
    },
    $can(permissionName) {
      //return true;
      return Permissions.indexOf(permissionName) !== -1;
    },
    editar_registro(data_id){//show 
      this.validacion="";
      this.formulario_venta_prueba=true;  
      this.mensaje_formulario="Editar un registro"
        axios.get(`venta_prueba/${data_id}`).then(response => {
            const data = response.data;
            if(!response.data){
              this.$toastr.warning("Operacio no exitosa", "Regitro no obtenido");
            }else{
              this.$toastr.success("Operacio exitosa", "Regitro obtenido");
              this.editar_dato = true;
              this.input_venta_prueba_id = data.id
              this.input_id = data.id;
              this.input_fecha_venta = data.fecha_venta;
              this.input_users_id = data.users_id;
              this.input_estado_venta_id = data.estado_venta_id;
              this.input_created_at = data.created_at;
              this.input_updated_at = data.updated_at;
              
              //this.input_user_id = data.id;
              //this.input_name = data.name;
            }
        });
    },
    limpiar_form(){
      this.input_id = '';
      this.input_fecha_venta = '';
      this.input_users_id = '';
      this.input_estado_venta_id = '';
      this.input_created_at = '';
      this.input_updated_at = '';
      
      this.validacion="";

    },
   
  }
};


</script>



