<template>
<div class="row">
    <div v-if="formulario_campo_has_factura_has_producto" class="col-lg-12 ">
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
            <input type="hidden" v-model="input_campo_has_factura_has_producto_id">   
  
  
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>id</b></label>
                <input type="text" v-model="input_id" placeholder="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.id" variant="danger" >{{validacion.id[0]}}</b-alert>
                
            </div>
                
            <div class="form-group col-md-4 col-sm-12">
              <label for="exampleInputEmail1">campo_id</label>
              <Select2 v-model="input_campo_id" :options="data_foraneo_campo_id" :settings="{ settingOption: value, settingOption: value }"/>
              <small id="emailHelp" class="form-text text-muted"></small>
              <b-alert show  v-if="validacion.campo_id" variant="danger" >{{validacion.campo_id[0]}}</b-alert>
            </div>
          
            <div class="form-group col-md-4 col-sm-12">
              <label for="exampleInputEmail1">factura_has_producto_id</label>
              <Select2 v-model="input_factura_has_producto_id" :options="data_foraneo_factura_has_producto_id" :settings="{ settingOption: value, settingOption: value }"/>
              <small id="emailHelp" class="form-text text-muted"></small>
              <b-alert show  v-if="validacion.factura_has_producto_id" variant="danger" >{{validacion.factura_has_producto_id[0]}}</b-alert>
            </div>
          
  
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>nombre</b></label>
                <input type="text" v-model="input_nombre" placeholder="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.nombre" variant="danger" >{{validacion.nombre[0]}}</b-alert>
                
            </div>
                
  
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>operacion</b></label>
                <input type="text" v-model="input_operacion" placeholder="operacion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.operacion" variant="danger" >{{validacion.operacion[0]}}</b-alert>
                
            </div>
                
  
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>valor</b></label>
                <input type="text" v-model="input_valor" placeholder="valor" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.valor" variant="danger" >{{validacion.valor[0]}}</b-alert>
                
            </div>
                
  
            <div class="form-group col-md-4 col-sm-12">
                <label for="exampleInputEmail1"><b>orden</b></label>
                <input type="text" v-model="input_orden" placeholder="orden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                <b-alert show  v-if="validacion.orden" variant="danger" >{{validacion.orden[0]}}</b-alert>
                
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
  <div class='card-body'><h1 class=''>Lista de campo_has_factura_has_producto </h1>  
  
    <nav>
      <pagination :data='consulta_datos' @pagination-change-page='consulta'></pagination>
    </nav>
      
    <div class='col-12'>
      <b-button v-if="$can('campo_has_factura_has_producto Anadir')"  @click='anadir_registro()' type='button' class='btn btn-wangir btn-lg' data-toggle='button' size='sm' aria-pressed='false' variant='success' style='margin-bottom: 5px; margin: 5px;'>Añadir registro
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
      responsive='sm' :sticky-header='stickyHeader' :no-border-collapse='noCollapse'>
      <template v-slot:cell(Acciones)='data'>

          <b-button-group>
            <b-button v-if="$can('campo_has_factura_has_producto Editar')"  v-b-modal.moda-registro size='sm' variant='warning' @click='editar_registro(data.item.id)' type='button' class='btn-sm btn btn-wangir mr-1' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 5px;'>Editar
            </b-button>
            <b-button v-if="$can('campo_has_factura_has_producto Eliminar')"  v-b-modal.moda-eliminar @click='eliminar_registro(data.item.id)'
                type='button' class='btn-sm btn btn-danger mr-1' size='sm' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 5px;'>Eliminar
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
      formulario_campo_has_factura_has_producto:false,
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
      { key: 'campo_id', sortable:true},
      { key: 'factura_has_producto_id', sortable:true},
      { key: 'nombre', sortable:true},
      { key: 'operacion', sortable:true},
      { key: 'valor', sortable:true},
      { key: 'orden', sortable:true},
      
      ],


      input_campo_has_factura_has_producto_id:[],
      data_foraneo_campo_id:[],data_foraneo_factura_has_producto_id:[],
      input_id:[],
      //input_campo_id:[],
      //input_factura_has_producto_id:[],
      //input_nombre:[],
      //input_operacion:[],
      //input_valor:[],
      //input_orden:[],
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
      axios.get("campo_has_factura_has_producto/consulta?page=" +page+"&consulta_data="+this.input_consulta_data)
      .then(response => {
        this.consulta_datos = response.data;
        this.datas=response.data.data;
        this.items=response.data.data;
        this.consulta_tabla=response.data.data;
      });
    },
    data_foraneo(){
      axios.get("campo_has_factura_has_producto/create").then(response => {
        this.productos_all = response.data;
        this.data_foraneo_campo_id= response.data.campo_id
        this.data_foraneo_factura_has_producto_id= response.data.factura_has_producto_id
        
      });
    },
    eliminar_registro(data_id){
    this.input_campo_has_factura_has_producto_id=data_id;
    },
    eliminar_registro_delete(){
      var data_id=this.input_campo_has_factura_has_producto_id;
      axios.delete(`campo_has_factura_has_producto/${this.input_campo_has_factura_has_producto_id}`).then(response => {
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
      this.formulario_campo_has_factura_has_producto=true;
      this.editar_dato = false;
      this.limpiar_form();
      this.mensaje_formulario="Añadir un nuevo registro"
    },
    formulario(){

      const data = {
        id: this.input_campo_has_factura_has_producto_id,
        id :this.input_id,
        campo_id :this.input_campo_id,
        factura_has_producto_id :this.input_factura_has_producto_id,
        nombre :this.input_nombre,
        operacion :this.input_operacion,
        valor :this.input_valor,
        orden :this.input_orden,
        
        //name: this.input_name,
        //email: this.input_email
      };
      
      if(this.editar_dato == true){
        axios.put(`campo_has_factura_has_producto/${this.input_campo_has_factura_has_producto_id}`, data)
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
              this.formulario_campo_has_factura_has_producto=false;


            }
        },
        (err) => {
          console.log("Err", err);
            this.$toastr.warning(err, "Error en el servidor");
            this.$toastr.warning(err.message, "Error en el servidor");
        });

      }else{
        
        axios.post("campo_has_factura_has_producto", data).then(response => {
            const datos = response.data;
            if(response.data.errors){
              this.$toastr.warning("Verifique los datos", "Verifique los datos");
              this.validacion=response.data.errors;
            }
            if(response.data.id){
              this.validacion="";
              this.$toastr.success("Operacio exitosa", "Datos modificados");
              this.consulta(this.page);
              this.formulario_campo_has_factura_has_producto=false;
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
      this.formulario_campo_has_factura_has_producto=false;
    },
    $can(permissionName) {
      return Permissions.indexOf(permissionName) !== -1;
    },
    editar_registro(data_id){//show 
      this.validacion="";
      this.formulario_campo_has_factura_has_producto=true;  
      this.mensaje_formulario="Editar un registro"
        axios.get(`campo_has_factura_has_producto/${data_id}`).then(response => {
            const data = response.data;
            if(!response.data){
              this.$toastr.warning("Operacio no exitosa", "Regitro no obtenido");
            }else{
              this.$toastr.success("Operacio exitosa", "Regitro obtenido");
              this.editar_dato = true;
              this.input_campo_has_factura_has_producto_id = data.id
              this.input_id = data.id;
              this.input_campo_id = data.campo_id;
              this.input_factura_has_producto_id = data.factura_has_producto_id;
              this.input_nombre = data.nombre;
              this.input_operacion = data.operacion;
              this.input_valor = data.valor;
              this.input_orden = data.orden;
              
              //this.input_user_id = data.id;
              //this.input_name = data.name;
            }
        });
    },
    limpiar_form(){
      this.input_id = '';
      this.input_campo_id = '';
      this.input_factura_has_producto_id = '';
      this.input_nombre = '';
      this.input_operacion = '';
      this.input_valor = '';
      this.input_orden = '';
      
      this.validacion="";

    },
   
  }
};


</script>



