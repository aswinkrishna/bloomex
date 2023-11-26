<template>
    <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Issues</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Issue list</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container">

                <div class="row">
                    <div class="col-12">
                        <router-link to="/create" class="btn btn-primary" style="">Create New</router-link>
                    </div>
                    <div class="col-12 mt-5">
                      <input type="text" class="form-control mb-5" placeholder="Search" v-model="search" @keyup="loadData(1)">
                      <table id="dataTable" class="table" >
                        <thead>
                          <tr>
                            <th class="border-bottom-0">#</th>
                            <th class="border-bottom-0">Subject</th>
                            <th class="border-bottom-0">Description</th>
                            <th class="border-bottom-0">Due Date</th>
                            <th class="border-bottom-0">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="item in items" :key="item.id">
                            <td>{{ item.id }}</td>
                            <td>{{ item.subject }}</td>
                            <td>{{ item.description }}</td>
                            <td>{{ item.due_date }}</td>
                            <td>
                              <router-link :to="'/edit/' + item.id" class="btn btn-primary" style="">Edit</router-link>
                              <button class="btn btn-danger ml-2" @click="deleteItem(item.id)">Delete</button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <pagination :data="items" @pagination-change-page="loadData"></pagination>
                    </div>
                </div>

            </div>
        </section>
  </template>

  <script>
  import 'datatables.net';
  import $ from 'jquery';
  import axios from 'axios';

  export default {
    data() {
      return {
        search: "",
        items: [],
      }
    },
    methods: {
      redirectToEdit(id) {
        alert("sd");
        this.$router.push({ path: `edit/${id}` });
      },
      loadData(page = 1) {
        axios.get(`/api/issues/list?page=${page}&search=${this.search}`)
          .then(response => {
            this.items = response.data.data;
          })
          .catch(error => {
            console.error('Error fetching data:', error);
          });
      },
      deleteItem(id) {
        if (confirm('Are you sure you want to delete this item?')) {
          axios.delete(`/api/issues/delete/${id}`)
            .then(response => {
              this.loadData();
            })
            .catch(error => {
              console.error('Error deleting item:', error);
            });
        }

      }
    },
    mounted () {
      // this.dataTable();
      this.loadData();
    },
  beforeDestroy() {
    $('#dataTable').DataTable().destroy();
  }
  }
  </script>