
<template>
    <div>

    
        <h3 class="themeoptions-heading">
        </h3>
        <h3 class="themeoptions-heading">
            <div>
                Configuración de tabla
            </div>
            
        </h3>
        <div class="p-3">
            <div>
            <b-form-group label="Opcion en tablas" label-cols-lg="2" v-on:change="config_tabla()">
            <b-form-checkbox v-model="striped" inline>Striped</b-form-checkbox>
            <b-form-checkbox v-model="bordered" inline>Bordered</b-form-checkbox>
            <b-form-checkbox v-model="borderless" inline>Borderless</b-form-checkbox>
            <b-form-checkbox v-model="outlined" inline>Outlined</b-form-checkbox>
            <b-form-checkbox v-model="small" inline>Small</b-form-checkbox>
            <b-form-checkbox v-model="hover" inline>Hover</b-form-checkbox>
            <b-form-checkbox v-model="dark" inline>Dark</b-form-checkbox>
            <b-form-checkbox v-model="fixed" inline>Fixed</b-form-checkbox>
            <b-form-checkbox v-model="footClone" inline>Foot Clone</b-form-checkbox>
            <b-form-checkbox v-model="noCollapse" inline>No border collapse</b-form-checkbox>
            </b-form-group>
            <b-form-group label="Head Variant" label-cols-lg="2">
            <b-form-radio-group v-model="headVariant" class="mt-lg-2">
                <b-form-radio :value="null" inline>None</b-form-radio>
                <b-form-radio value="light" inline>Light</b-form-radio>
                <b-form-radio value="dark" inline>Dark</b-form-radio>
                <b-form-radio value="dark 12" inline>Dark-12</b-form-radio>
            </b-form-radio-group>
            </b-form-group>
            <b-form-group label="Table Variant" label-for="table-style-variant" label-cols-lg="2">
            <b-form-select
                v-model="tableVariant"
                :options="tableVariants"
                id="table-style-variant"
            >
                <template v-slot:first>
                <option value="">-- None --</option>
                </template>
            </b-form-select>
            </b-form-group>

            <b-table
            :striped="striped"
            :bordered="bordered"
            :borderless="borderless"
            :outlined="outlined"
            :small="small"
            :hover="hover"
            :dark="dark"
            :fixed="fixed"
            :foot-clone="footClone"
            :no-border-collapse="noCollapse"
            :items="items"
            :fields="fields"
            :head-variant="headVariant"
            :table-variant="tableVariant"
            >
            </b-table>
        </div>

    
    </div>
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
import { Money } from "v-money";


export default {
  components: {
    VueSingleSelect,
    VueToastr2,
    Select2,
    Money
  },
  data() {

    return {
      fields: ['first_name', 'last_name', 'age'],
        items: [
          { age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
          { age: 21, first_name: 'Larsen', last_name: 'Shaw' },
          { age: 89, first_name: 'Geneva', last_name: 'Wilson' }
        ],
        tableVariants: [
          'primary',
          'secondary',
          'info',
          'danger',
          'warning',
          'success',
          'light',
          'dark'
        ],
        striped: false,
        bordered: false,
        borderless: false,
        outlined: false,
        small: false,
        hover: false,
        dark: false,
        fixed: false,
        footClone: false,
        headVariant: null,
        tableVariant: '',
        noCollapse: false
     

      
    };
  },
  mounted() {
   // this.consulta();
   // this.data_foraneo();
  },
  methods: {
      config_tabla(){
      
     
      const data = {
        striped:this.striped,
        bordered:this.bordered,
        borderless:this.borderless,
        outlined:this.outlined,
        small:this.small,
        hover:this.hover,
        dark:this.dark,
        fixed:this.fixed,
        footClone:this.footClone,
        headVariant:this.headVariant,
        tableVariant:this.tableVariant,
        noCollapse:this.noCollapse
      }    
             // axios.get(`Producto/${data_id}`).then(response => {
                 
      axios.post(`configuracion/configuracion_tabla`,data).then(response => {
            /*
            const datos = response.data;
            if(response.data.errors){
              this.$toastr.warning("Verifique los datos", "Verifique los datos");
              this.validacion=response.data.errors;
            }
            if(response.data.id){
              this.validacion="";
              this.$toastr.success("Operacio exitosa", "Datos modificados");
              this.consulta(this.page);
              this.formulario_Producto=false;


            }
            */

        },
        (err) => {
          console.log("Err", err);
            this.$toastr.warning(err, "Error en el servidor");
            this.$toastr.warning(err.message, "Error en el servidor");
        });
      
      },
    



    consulta(page = 1){
      this.page=page;
      axios.get("Producto/consulta?page=" +page+"&consulta_data="+this.input_consulta_data)
      .then(response => {
        this.consulta_datos = response.data;
        this.datas=response.data.data;
        this.items=response.data.data;
        this.consulta_tabla=response.data.data;
      });
    },
    /*
    data_foraneo(){
      axios.get("Producto/create").then(response => {
        this.productos_all = response.data;
        this.data_foraneo_proveedor_id= response.data.proveedor_id
        
      });
    },
    eliminar_registro(data_id){
    this.input_Producto_id=data_id;
    },
    eliminar_registro_delete(){
      var data_id=this.input_Producto_id;
      axios.delete(`Producto/${this.input_Producto_id}`).then(response => {
        const data = response.data;
        if(response.data.id){
          this.validacion="";
          this.$toastr.info("Operacio exitosa", "Datos Eliminados");
          this.consulta(this.page);
        }
      });
      
    },
    formatPrice(value) {
      let val = (value / 1).toFixed(0).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
    anadir_registro(){
      this.validacion="";
      this.formulario_Producto=true;
      this.editar_dato = false;
      this.limpiar_form();
      this.mensaje_formulario="Añadir un nuevo registro"
    },
    formulario(){

      const data = {
        id: this.input_Producto_id,
        id :this.input_id,
        nombre_proveedor :this.input_nombre_proveedor,
        nombre :this.input_nombre,
        imagen :this.input_imagen,
        precio_caja :this.input_precio_caja,
        cantidad_caja :this.input_cantidad_caja,
        precio_unidad :this.input_precio_unidad,
        iva :this.input_iva,
        porcentaje_ganacia :this.input_porcentaje_ganacia,
        precio_venta :this.input_precio_venta,
        precio_venta_2 :this.input_precio_venta_2,
        ganacia :this.input_ganacia,
        proveedor_id :this.input_proveedor_id,
        stock :this.input_stock,
        cantidad_disponible :this.input_cantidad_disponible,
        created_at :this.input_created_at,
        updated_at :this.input_updated_at,
        //npm install node-sass
        //name: this.input_name,
        //email: this.input_email
      };
      const formData = new FormData();
      formData.append("nombre_proveedor", this.input_nombre_proveedor);
      formData.append("nombre", this.input_nombre);
      formData.append("imagen", this.input_imagen);
      formData.append("precio_caja", this.input_precio_caja);
      formData.append("precio_venta", this.input_precio_venta);
      formData.append("precio_venta_2", this.input_precio_venta_2);
      formData.append("proveedor_id", this.input_proveedor_id);
      formData.append("cantidad_disponible", this.input_cantidad_disponible);
      formData.append("stock", this.input_stock);
      
      
     
      
      if(this.editar_dato == true){
        //axios.put(`Producto/${this.input_Producto_id}`, data)
        axios.post(`Producto/update/${this.input_Producto_id}`, formData,{ headers:{'Content-Type':'multipart/form-data'}})
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
              this.formulario_Producto=false;


            }
        },
        (err) => {
          console.log("Err", err);
            this.$toastr.warning(err, "Error en el servidor");
            this.$toastr.warning(err.message, "Error en el servidor");
        });

      }else{
        axios.post("Producto", formData,{ headers:{'Content-Type':'multipart/form-data'} } ).then(response => {

        //axios.post("Producto", data).then(response => {
            const datos = response.data;
            if(response.data.errors){
              this.$toastr.warning("Verifique los datos", "Verifique los datos");
              this.validacion=response.data.errors;
            }
            if(response.data.id){
              this.validacion="";
              this.$toastr.success("Operacio exitosa", "Datos modificados");
              this.consulta(this.page);
              this.formulario_Producto=false;
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
      this.formulario_Producto=false;
    },
    $can(permissionName) {
      return true;
      return Permissions.indexOf(permissionName) !== -1;
    
    },
    editar_registro(data_id){//show 
      this.validacion="";
      this.formulario_Producto=true;  
      this.mensaje_formulario="Editar un registro"
        axios.get(`Producto/${data_id}`).then(response => {
            const data = response.data;
            if(!response.data){
              this.$toastr.warning("Operacio no exitosa", "Regitro no obtenido");
            }else{
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
              
              //this.input_user_id = data.id;
              //this.input_name = data.name;
            }
        });
    },
    limpiar_form(){
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
      this.input_created_at = '';
      this.input_updated_at = '';
      
      this.validacion="";

    },
    */ 
   
  }
};


</script>
<style>
 button{margin: 0px!important ;padding-bottom: 0px!important;padding-top: 0px!important;
}
.table-b-table-default{
  
    padding-top: 0px!important;
    padding-bottom: 0px!important;


}

</style>


