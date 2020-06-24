<template>
  <div>
    <div class='col-lg-12'>
      <nav>
        <pagination :data='consulta_datos' @pagination-change-page='consulta'></pagination>
      </nav>
      <nav class='nav'>
      <b-button v-b-modal.moda-registro @click='anadir_registro()' type='button' class='btn btn-wangir btn-lg' data-toggle='button' size='sm' aria-pressed='false' variant='success' style='margin-bottom: 5px; margin: 5px;'>Añadir registro
      </b-button>
      </nav>
      <div class='panel-body' style='overflow-x:auto;'>
        <table class='table   table-striped table-bordered table-hover compact nowrap' id='myTable_' >
          <thead>
            <tr>
            
            <th>id</th>
        <th>numero_factura</th>
        <th>fecha</th>
        <th>proveedor_id</th>
        <th>estados_id</th>
        <th>users_id</th>
        <th>updated_at</th>
        <th>created_at</th>
        
            <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for='data in datas' v-bind:key='data.id'>
        <td>{{data.id }}</td>
            <td>{{data.numero_factura }}</td>
            <td>{{data.fecha }}</td>
            <td>{{data.proveedor_id }}</td>
            <td>{{data.estados_id }}</td>
            <td>{{data.users_id }}</td>
            <td>{{data.updated_at }}</td>
            <td>{{data.created_at }}</td>
            
          <td>
            <b-button v-b-modal.moda-registro size='sm'
            variant='warning' @click='editar_registro(data.id)'
              type='button' class='btn btn-wangir btn-lg' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 5px;'>Editar
            </b-button>
            <b-button v-b-modal.moda-eliminar @click='eliminar_registro(data.id)'
              type='button' class='btn btn-danger btn-lg' size='sm' data-toggle='button' aria-pressed='false' style='margin-bottom: 5px; margin: 5px;'>Eliminar
            </b-button>

          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


<b-modal id="moda-registro"  size="xl" >
  <template slot="modal-title">{{mensaje_formulario}} </template>
    <!--
    <div v-if="editar_producto==true"><form ref="form" action v-on:submit.prevent="newproducto(venta.id)"></div>
    -->
    <div >
    </div>
    <form ref="form"   v-on:submit.prevent="formulario()">
      <div class="row"> 
        <div class="col-md-12">
          <input type="text" v-model="input_Factura_id">   


          <div class="form-group">
              <label for="exampleInputEmail1">id</label>
              <input type="text" v-model="input_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">Informacion de los datos</small>
              <div v-if="errors && errors.id" class="text-danger">{{ errors.id[0] }}</div>
          </div>
              

          <div class="form-group">
              <label for="exampleInputEmail1">numero_factura</label>
              <input type="text" v-model="input_numero_factura" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">Informacion de los datos</small>
              <div v-if="errors && errors.numero_factura" class="text-danger">{{ errors.numero_factura[0] }}</div>
          </div>
              

          <div class="form-group">
              <label for="exampleInputEmail1">fecha</label>
              <input type="text" v-model="input_fecha" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">Informacion de los datos</small>
              <div v-if="errors && errors.fecha" class="text-danger">{{ errors.fecha[0] }}</div>
          </div>
              
          <div class="form-group">
              <label for="exampleInputEmail1">proveedor_id</label>
              <Select2
                class=""
                v-model="input_proveedor_id"
                :options="data_foraneo_proveedor_id"
                :settings="{ settingOption: value, settingOption: value }"
              />
              <!--
              <Select2 v-model="input_proveedor_id" 
                class="" id="exampleInputEmail1" 
                v-model="input_proveedor_id"
                aria-describedby="emailHelp" placeholder="Seleccionar una opcion">
              
              />
              -->
              <small id="emailHelp" class="form-text text-muted"></small>
              <div v-if="errors && errors.proveedor_id" class="text-danger">{{ errors.proveedor_id[0] }}</div>
          </div>
        
          <div class="form-group">
              <label for="exampleInputEmail1">estados_id</label>
              <Select2
                class=""
                v-model="input_estados_id"
                :options="data_foraneo_proveedor_id"
                :settings="{ settingOption: value, settingOption: value }"
              />
              <!--
              <Select2 v-model="input_estados_id" 
                class="" id="exampleInputEmail1" 
                v-model="input_estados_id"
                aria-describedby="emailHelp" placeholder="Seleccionar una opcion">
              
              />
              -->
              <small id="emailHelp" class="form-text text-muted"></small>
              <div v-if="errors && errors.estados_id" class="text-danger">{{ errors.estados_id[0] }}</div>
          </div>
        
          <div class="form-group">
              <label for="exampleInputEmail1">users_id</label>
              <Select2
                class=""
                v-model="input_users_id"
                :options="data_foraneo_proveedor_id"
                :settings="{ settingOption: value, settingOption: value }"
              />
              <!--
              <Select2 v-model="input_users_id" 
                class="" id="exampleInputEmail1" 
                v-model="input_users_id"
                aria-describedby="emailHelp" placeholder="Seleccionar una opcion">
              
              />
              -->
              <small id="emailHelp" class="form-text text-muted"></small>
              <div v-if="errors && errors.users_id" class="text-danger">{{ errors.users_id[0] }}</div>
          </div>
        

          <div class="form-group">
              <label for="exampleInputEmail1">updated_at</label>
              <input type="text" v-model="input_updated_at" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">Informacion de los datos</small>
              <div v-if="errors && errors.updated_at" class="text-danger">{{ errors.updated_at[0] }}</div>
          </div>
              

          <div class="form-group">
              <label for="exampleInputEmail1">created_at</label>
              <input type="text" v-model="input_created_at" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">Informacion de los datos</small>
              <div v-if="errors && errors.created_at" class="text-danger">{{ errors.created_at[0] }}</div>
          </div>
              


          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
  </form>
</b-modal>

<b-modal id="moda-eliminar"  size="xl" >
  <div class="d-block text-center">
  <!--  
  <input type="text" v-model="input_user_id">
  -->  
    <h3>¿Desea eliminar el registro permanente?</h3>
  </div>
  <b-button class="mt-3 btn btn-danger " @click="eliminar_registro_delete()">Eliminar</b-button>
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
  data() {

    return {
      validacion: [],
      editar_dato: false,
      data: [],
      datas: [],
      input_Factura_id:[],
      data_foraneo_proveedor_id:[],data_foraneo_estados_id:[],data_foraneo_users_id:[],
      input_id:[],
        input_numero_factura:[],
        input_fecha:[],
        input_proveedor_id:[],
        input_estados_id:[],
        input_users_id:[],
        input_updated_at:[],
        input_created_at:[],
        
      consulta_datos: {},
      errors: {},
      mensaje_formulario: "",
      
    };
  },
  mounted() {
    //this.fetchArticles();
    this.consulta();
    axios.get("Factura/create").then(response => {
      this.data_foraneo_proveedor_id= response.data.proveedor_id
   this.data_foraneo_estados_id= response.data.estados_id
   this.data_foraneo_users_id= response.data.users_id
   
      //this.productos_all = response.data;
      //this.data_foraneo_estado_id = response.data.estado_id;
    });
    /*
    axios.get("productos_all").then(response => {
      this.productos_all = response.data;
    });
    axios.get("mesa/lista_mesa").then(response => {
      this.lista_mesa = response.data;
    });
    */
  },
  components: {
    VueSingleSelect,
    VueToastr2,
    Select2
  },
  methods: {
    /*
    axios.get(Factura/created).then(response => {
      this.productos_all = response.data;
    });
    */

    consulta(page = 1){
      axios.get("Factura/consulta?page=" +page)
      .then(response => {
        this.consulta_datos = response.data;
        this.datas=response.data.data;
      });
    },
    eliminar_registro(data_id){
    this.input_Factura_id=data_id;
    },
    eliminar_registro_delete(){
      var data_id=this.input_Factura_id;
      axios.delete(`users/${this.input_Factura_id}`).then(response => {
        const data = response.data;
        if(response.data.id){
              this.validacion="";
              this.$toastr.info("Operacio exitosa", "Datos Eliminados");
              this.consulta();
        }
      });
      
    },
    anadir_registro(){
      this.editar_dato = false;
      this.mensaje_formulario="Añadir un nuevo registro"
    },
    formulario(){

      const data = {
        id: this.input_Factura_id,
        id :this.input_id,
        numero_factura :this.input_numero_factura,
        fecha :this.input_fecha,
        proveedor_id :this.input_proveedor_id,
        estados_id :this.input_estados_id,
        users_id :this.input_users_id,
        updated_at :this.input_updated_at,
        created_at :this.input_created_at,
        
        //name: this.input_name,
        //email: this.input_email
      };
      
      if(this.editar_dato == true){
        axios.put(`Factura/${this.input_Factura_id}`, data)
        .then(response => {

            const datos = response.data;
            if(response.data.errors){
              this.$toastr.warning("Verifique los datos", "Verifique los datos");
              this.validacion=response.data.errors;
            }
            if(response.data.id){
              this.validacion="";
              this.$toastr.success("Operacio exitosa", "Datos modificados");
              this.consulta();

            }
        },
        (err) => {
          console.log("Err", err);
            this.$toastr.warning(err, "Error en el servidor");
            this.$toastr.warning(err.message, "Error en el servidor");
        });

      }else{
        
        axios.post("users", data).then(response => {
            const datos = response.data;
            if(response.data.errors){
              this.$toastr.warning("Verifique los datos", "Verifique los datos");
              this.validacion=response.data.errors;
            }
            if(response.data.id){
              this.validacion="";
              this.$toastr.success("Operacio exitosa", "Datos modificados");
              this.consulta();

            }
        });

      }

    },
   
    editar_registro(data_id){//show 
        this.mensaje_formulario="Editar un registro"
        axios.get(`Factura/${data_id}`).then(response => {
            const data = response.data;
            if(!response.data){
              this.$toastr.warning("Operacio no exitosa", "Regitro no obtenido");
            }else{
              this.$toastr.success("Operacio exitosa", "Regitro obtenido");
              this.editar_dato = true;
              this.input_Factura_id = data.id
              this.input_id = data.id;
        this.input_numero_factura = data.numero_factura;
        this.input_fecha = data.fecha;
        this.input_proveedor_id = data.proveedor_id;
        this.input_estados_id = data.estados_id;
        this.input_users_id = data.users_id;
        this.input_updated_at = data.updated_at;
        this.input_created_at = data.created_at;
        
              //this.input_user_id = data.id;
              //this.input_name = data.name;
            }
        });
    },
   
  }
};


</script>



