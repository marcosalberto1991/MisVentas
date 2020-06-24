<template>
  <div><p>como esta</p>
        <div class='col-lg-6 card mesa' v-for="venta in ventas_2" v-bind:key="venta.id" >
            <blockquote class='mesa blockquote mb-0'>
            <div class='card-header'>sssss</div>
            <div class='card-body'>
                
                <table class='table table-striped table-bordered table-hover compact nowrap'>
                    <tr>
                        <th>Productos</th>
                        <th>precios</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                   <tr>
<!--
                        <td>{{data.producto_id_pk.nombre}}</td>
                        <td>{{data.producto_id_pk.precio_venta}}</td>
                        <td>{{data.cantidad}}</td>
                        <td>{{data.producto_id_pk.precio_venta*data.cantidad}}</td>
    -->
                    </tr>
                    
                    <tr>
                        <th>Total</th>
                        <th>$2300</th>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
                
            </div>
            <form action="" v-on:submit.prevent="addArticle()">
            <div class='form-group row'>
              
                <div class='col-lg-6'>
                    <label class='control-label' for='descripcion'>cantidad:</label>
                    <!--
                    <vue-single-select
                        v-on:keyup="autoComplete_2"
                        name="producto"
                        placeholder="producto"
                        you-want-to-select-a-post="ok"
                        v-model="thought.producto"
                        out-of-all-these-posts="makes sense"
                        :options="productos_all"
                        a-post-has-an-id="good for search and display"
                        the-post-has-a-title="make sure to show these"
                        option-label="nombre"
                        :required="true"
                    ></vue-single-select>
                    -->
                    <!--option-key="id"-->
                </div>
               
                <div class='col-lg-2'>
                    <label class='control-label' for='descripcion'>cantidad:</label>
                    <input type='number' name='cantidad' class='form-control' value='1' required='required' autofocus v-model="thought.cantidad" />
                    <p class='errornombre text-center alert alert-danger d-none'></p>
                </div>
                <div class='col-lg-3'>
                    <button  class="btn btn-success" >
                        Añadir
                    </button>
                </div>
            </div>
            </form>
            </blockquote>

    </div>

  </div>
<!--
  <div>
    <h2>Articles</h2>
    <form @submit.prevent="addArticle" class="mb-3">
      <div class="form-group">
        <input type="text" name="_token" :value="csrf">
        <input type="text" class="form-control" placeholder="Title" v-model="article.title">
      </div>
      <div class="form-group">
        <textarea class="form-control" placeholder="Body" v-model="article.body"></textarea>
      </div>
      <button type="submit" class="btn btn-light btn-block">Save</button>
    </form>
    <button @click="clearForm()" class="btn btn-danger btn-block">Cancel</button>
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.next_page_url)">Next</a></li>
      </ul> 
    </nav>
    <div class="card card-body mb-2" v-for="article in articles" v-bind:key="article.id">
      <h3>{{ article.title }}</h3>
      <p>{{ article.body }}</p>
      <hr>
      <button @click="editArticle(article)" class="btn btn-warning mb-2">Edit</button>
      <button @click="deleteArticle(article.id)" class="btn btn-danger">Delete</button>
    </div>
  </div>
  -->
</template>

<script>
export default {
  data() {
    return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      articles: [],
      produtos: [],
      ventas: [],
      ventas_2: [{'id':1,mesa_id:1},{'id':2,mesa_id:1}],
      venta: {
        id: '',
        mesa_id: '',
        precio: '',
        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      venta_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchArticles();
  },
  methods: {
    fetchArticles(page_url) {
      let vm = this;
      page_url = page_url || 'punto';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.puntos = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };
      this.pagination = pagination;
    },
    deleteArticle(id) {
      if (confirm('Are You Sure?')) {
        fetch(`punto/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            alert('Article Removed');
            this.fetchArticles();
          })
          .catch(err => console.log(err));
      }
    },
    addArticle() {
      if (this.edit === false) {
        // Add
        //this.fetchArticles();
        fetch('punto', {
          method: 'post',
          body: JSON.stringify(this.article),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Article Added');
            this.fetchArticles();
          })
          .catch(err => console.log(err));
      } else {
        // Update
        fetch('api/article', {
          method: 'put',
          body: JSON.stringify(this.article),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Article Updated');
            this.fetchArticles();
          })
          .catch(err => console.log(err));
      }
    },
    editArticle(article) {
      this.edit = true;
      this.article.id = article.id;
      this.article.article_id = article.id;
      this.article.title = article.title;
      this.article.body = article.body;
    },
    clearForm() {
      this.edit = false;
      this.article.id = null;
      this.article.article_id = null;
      this.article.title = '';
      this.article.body = '';
    }
  }
};
</script>