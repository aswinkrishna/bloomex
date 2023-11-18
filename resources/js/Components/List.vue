<template>
    <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Tasks</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Task list</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container">
            
                <div class="row">
                    <div class="col-12">
                        <router-link to="/create" class="btn btn-primary" style="">Add Product</router-link>
                    </div>
                    <div class="col-12 mt-5">
                        <table class="table table-responsive">
                            <thead>
                                <th>Task</th>                                            
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ssafsf</td>
                                </tr>
                                <tr>
                                    <td>ssafsf</td>
                                </tr>
                                <tr>
                                    <td>ssafsf</td>
                                </tr>
                                <tr>
                                    <td>ssafsf</td>
                                </tr>
                                <tr>
                                    <td>ssafsf</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            
            </div>
        </section>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        product: {
          name: '',
          description: '',
          price: 0
        }
      }
    },
    computed: {
      isNewProduct() {
        return !this.$route.path.includes('edit');
      }
    },
    async created() {
      if (!this.isNewProduct) {
        const response = await axios.get(`/api/products/${this.$route.params.id}`);
        this.product = response.data;
      }
    },
    methods: {
      async submitForm() {
        try {
          if (this.isNewProduct) {
            await axios.post('/api/products', this.product);
          } else {
            await axios.put(`/api/products/${this.$route.params.id}`, this.product);
          }
          this.$router.push('/');
        } catch (error) {
          console.error(error);
        }
      }
    }
  }
  </script>