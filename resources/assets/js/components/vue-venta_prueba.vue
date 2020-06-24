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
                <b-input v-model="input_id" class="form-control-sm" :class="{ 'is-invalid': validacion.id }" placeholder="id"  id="feedback-user"></b-input>
                <!--
                <input type="text" v-model="input_id" placeholder="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                -->
                <b-form-invalid-feedback  v-if="validacion.id">
                  {{validacion.id[0]}}
                </b-form-invalid-feedback>
                <!--
                <b-alert show  v-if="validacion.id" variant="danger" >{{validacion.id[0]}}</b-alert>
                -->
            </div>
                
  
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>fecha_venta</b></label>
                <b-input v-model="input_fecha_venta" class="form-control-sm" :class="{ 'is-invalid': validacion.fecha_venta }" placeholder="fecha_venta"  id="feedback-user"></b-input>
                <!--
                <input type="text" v-model="input_fecha_venta" placeholder="fecha_venta" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                -->
                <b-form-invalid-feedback  v-if="validacion.fecha_venta">
                  {{validacion.fecha_venta[0]}}
                </b-form-invalid-feedback>
                <!--
                <b-alert show  v-if="validacion.fecha_venta" variant="danger" >{{validacion.fecha_venta[0]}}</b-alert>
                -->
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
                <b-input v-model="input_created_at" class="form-control-sm" :class="{ 'is-invalid': validacion.created_at }" placeholder="created_at"  id="feedback-user"></b-input>
                <!--
                <input type="text" v-model="input_created_at" placeholder="created_at" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                -->
                <b-form-invalid-feedback  v-if="validacion.created_at">
                  {{validacion.created_at[0]}}
                </b-form-invalid-feedback>
                <!--
                <b-alert show  v-if="validacion.created_at" variant="danger" >{{validacion.created_at[0]}}</b-alert>
                -->
            </div>
                
  
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>updated_at</b></label>
                <b-input v-model="input_updated_at" class="form-control-sm" :class="{ 'is-invalid': validacion.updated_at }" placeholder="updated_at"  id="feedback-user"></b-input>
                <!--
                <input type="text" v-model="input_updated_at" placeholder="updated_at" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                -->
                <b-form-invalid-feedback  v-if="validacion.updated_at">
                  {{validacion.updated_at[0]}}
                </b-form-invalid-feedback>
                <!--
                <b-alert show  v-if="validacion.updated_at" variant="danger" >{{validacion.updated_at[0]}}</b-alert>
                -->
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
  <div class='card-body'><h1 class=''>Lista de venta_prueba </h1>  
  
    <nav>
      <pagination :data='consulta_datos' @pagination-change-page='consulta'></pagination>
    </nav>
    <nav class='row'> 
 
    <div class='col-md-8 col-sm-12'>
      <b-button v-if="$can('venta_prueba Anadir')"  @click='anadir_registro()' type='button' class='btn btn-wangir btn-lg' data-toggle='button' size='sm' aria-pressed='false' variant='success' style='margin-bottom: 5px; margin: 5px;'>
      <i class='fas fa-address-book'></i>
      Añadir registro
      </b-button>
    </div>
    <div class='col-md-1 col-sm-12'>
        <b-form-select v-model="input_vista" :options="data_vista" size="sm" class="mt-3"></b-form-select>
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
            


              <b-button @click='consulta()' size='sm' text='Button' variant='success'><i class='fas fa-search'></i> Buscar</b-button>
            </b-input-group-append>
          </b-input-group>
        </form>
      </div>
      </nav>

<div v-if="input_vista==2" class="col-md-12 row">
      <div class="col-md-12 " style="background-color:#272c33">
        <h1>
          A
        </h1>
      </div>
      <span class="col-md-12 row"  >
      

      <div v-for="data in consulta_tabla" :key="id" class="widget-content p-2 col-md-3" >
          <div class="widget-content-wrapper" style="background-color: #FFEB3B;">
              <div class="widget-content-left mr-3">
                  <img width="42" class="rounded-circle" src="assets/images/avatars/9.jpg" alt="">
              </div>
              <div class="widget-content-left">
                  <div class="widget-heading">{{data.fecha_venta}}</div>
                  <div class="widget-subheading">Web Developer</div>
                  <div class="badge badge-pill badge-dark">$381</div>
                  <div class="badge badge-pill badge-dark" v-b-modal.moda-eliminar @click='eliminar_registro(data.id)'>
                    <i class='fas fa-trash-alt'></i>
                  </div>
                  <a type='button' class="badge badge-pill badge-dark" @click='editar_registro(data.id)'>
                    <i class='fas fa-edit'></i>

                  </a>

              </div>
          </div>
      </div>
      </span>
      
    </div>


      <b-table v-if="input_vista==1" :items='consulta_tabla' :fields='fields' 
      responsive='sm'  :no-border-collapse='noCollapse'>
      <template v-slot:cell(Acciones)='data'>


            <b-button   size='sm' variant='warning' @click='editar_registro(data.item.id)' type='button' class='btn-sm  btn-wangir mr-2 btn-sm-mass' data-toggle='button'  style='margin: 0px;height: 22px;'>
            <i class='fas fa-edit'></i>
            <span class='d-none d-sm-none d-md-block float-right'>Editar</span>
            </b-button>

            <b-button   v-b-modal.moda-eliminar @click='eliminar_registro(data.item.id)'
                type='button' class='btn-sm btn btn-danger mr-1 btn-sm-mass' size='sm' data-toggle='button' aria-pressed='false' >
                
                <i class='fas fa-trash-alt'></i>
                <span class='d-none d-sm-none d-md-block float-right'>Eliminar</span>
            </b-button>
            <b-button size='sm' @click='data.toggleDetails' style='margin-bottom: 5px; margin: 5px;height: 22px;' class='btn-sm mr-2 btn-sm-mass'>
            <i class="fas fa-plus-circle"></i>
            <!--
            {{ data.detailsShowing ? 'Menos' : 'Mas' }} Detalle
          -->
          <!--
          <i class="fas fa-plus-circle"></i>
          -->
          </b-button>

            <!--  
            <a v-bind:href=" data.item.id+'/Sucursale'"  class='btn-sm btn btn-success mr-1' size='sm'  style='margin: 0px;height: 15px;'>Surcusales </a>
            -->


        


        </template>
        <template v-slot:head(Acciones)='scope'>
          <div class='text-nowrap'>Acciones</div>
        </template>
        <template v-slot:row-details='row'>
          <b-card class='color-table'>
            
            <b-row class='mb-2'>
              <b-col sm='3' class='text-sm-right'><b>Age:</b></b-col><hr>
              <b-col sm='9'>{{row.item.id}}</b-col>
            </b-row>
          

          </b-card>
  

        
        
        <b-card class='bg-arielle-edyconst'>
          <b-row 
          v-for='data in row.item' v-bind:key='data.id'
          >
          {{data}}
          </b-row>
          </b-card>
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
      { key: "Acciones",stickyColumn: true,class:' one-linea', label:"Acciones" ,sortable: false },
      { key: 'id', sortable:true,class:' one-linea'},
      { key: 'fecha_venta', sortable:true,class:' one-linea'},
      { key: 'users_id', sortable:true,class:' one-linea'},
      { key: 'estado_venta_id', sortable:true,class:' one-linea'},
      { key: 'created_at', sortable:true,class:' one-linea'},
      { key: 'updated_at', sortable:true,class:' one-linea'},
      
      ],


      input_venta_prueba_id:[],
      data_foraneo_users_id:[],data_foraneo_estado_venta_id:[],
      input_id:[],
      //input_fecha_venta:[],
      //input_users_id:[],
      //input_estado_venta_id:[],
      //input_created_at:[],
      //input_updated_at:[],
      //
      input_vista:1,
      data_vista:[
        { value:1, text:'Tabla'},
        { value:2, text:'Cuadros'}
      ],
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



