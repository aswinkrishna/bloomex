<template>
    <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Task</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Add new</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5">
                        <form>
                          <div class="form-group">
                            <label>aa</label>
                            <input type="text" class="form-control" />
                          </div>
                          <div class="form-group">
                            <label>aa</label>
                            <input type="text" class="form-control" />
                          </div>
                          <div class="form-group">
                            <label>aa</label>
                            <input type="text" class="form-control" />
                          </div>
                          <div class="form-group">
                            <label>aa</label>
                            <input type="text" class="form-control" />
                          </div>
                          <div class="form-group">
                            <label>aa</label>
                            <input type="text" class="form-control" />
                          </div>
                          <div class="form-group">
                            <label>aa</label>
                            <input type="text" class="form-control" />
                          </div>
                          <div class="form-group">
                            <label>aa</label>
                            <input type="text" class="form-control" />
                          </div>
                        </form>
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