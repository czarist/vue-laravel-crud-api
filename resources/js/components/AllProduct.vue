<template>
    <div>
      <h2 class="text-center">Products List</h2>
  
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Detail</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <td>{{ product.id }}</td>
            <td>{{ product.name }}</td>
            <td>
              <template v-if="product.category_id && categories[product.category_id]">
                {{ categories[product.category_id].name }}
              </template>
            </td>
            <td>{{ product.detail }}</td>
            <td>{{ product.price }}</td>
            <td>
              <div class="btn-group" role="group">
                <router-link :to="{ name: 'edit', params: { id: product.id } }"
                    class="btn btn-success">Edit</router-link>
                <button class="btn btn-danger" @click="showConfirmationModal(product)">Delete</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
  
      <div v-if="isConfirmationModalVisible" class="modal">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title">Confirm Deletion</h2>
            <span class="close" @click="hideConfirmationModal">&times;</span>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this product?</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" @click="hideConfirmationModal">Cancel</button>
            <button class="btn btn-danger" @click="deleteProduct()">Delete</button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { API_URL } from '../app.js';
  
  export default {
    data() {
      return {
        products: [],
        categories: [],
        isConfirmationModalVisible: false,
        productIdToDelete: null
      }
    },
    created() {
      this.axios
        .get(`${API_URL}/products/`)
        .then(response => {
          this.products = response.data;
        });
      this.axios
        .get(`${API_URL}/categories/`)
        .then(response => {
          this.categories = response.data;
        });
    },
    methods: {
      showConfirmationModal(product) {
        this.productIdToDelete = product.id;
        this.isConfirmationModalVisible = true;
      },
      hideConfirmationModal() {
        this.productIdToDelete = null;
        this.isConfirmationModalVisible = false;
      },
      deleteProduct() {
        if (!this.productIdToDelete) {
          return;
        }
        this.axios
          .delete(`${API_URL}/products/${this.productIdToDelete}`)
          .then(response => {
            let i = this.products.map(data => data.id).indexOf(this.productIdToDelete);
            this.products.splice(i, 1);
            alert(response.data);
            this.hideConfirmationModal();
          })
          .catch(error => {
            alert(error.response.data.message);
            this.hideConfirmationModal();
          });
      }
    }
  } 
  </script>
  