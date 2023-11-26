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
                        <form method="post" @submit="submitForm($event)" ref="issueForm">
                          <div class="form-group">
                            <label>Project</label>
                            <select class="form-control" v-model="issue.project" required>
                              <option value="0">Select</option>
                              <option value="1">Remine</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Subject</label>
                            <input type="text" class="form-control" v-model="issue.subject" required />
                          </div>
                          <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" v-model="issue.description" required/>
                          </div>
                          <div class="form-group">
                            <label>Due Date</label>
                            <input type="date" class="form-control" v-model="issue.due_date"  required/>
                          </div>
                          <div class="form-group mt-2">
                            <button class="btn btn-primary" type="submit">Submit</button>
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
      isLoading: true,
      issue: {
        project: '',
        subject: '',
        description: '',
        due_date: '',
        category: '',
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
      let self = this;
      await axios.get('/api/issues/show/' + this.$route.params.id)
        .then(response => {
          let data = response.data;
          self.issue = {
            project: response.data.project_id,
            subject: response.data.subject,
            description: response.data.description,
            due_date: response.data.due_date,
            category: response.data.category,
          };

          self.isLoading = false;
        })
        .catch(error => {
          console.error('Error fetching data:', error);
          // Handle errors here
        });
    }
  },
  methods: {
    submitForm(event) {
      event.preventDefault();
      if (!this.isNewProduct) {
        axios.patch('/api/issues/update/' + this.$route.params.id, this.issue);
      } else {
        axios.post('/api/issues/', this.issue);
      }
      //  this.$router.push({ path: `/` });
    }
  }
}
</script>