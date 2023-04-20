<template>
    <div>
        <h2 class="text-center">Categories List</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.id">
                    <td>{{ category.id }}</td>
                    <td>{{ category.name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{ name: 'edit_category', params: { id: category.id } }"
                                class="btn btn-success">Edit</router-link>
                            <button class="btn btn-danger" @click="showDeleteConfirmation(category.id)">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal -->
        <div v-if="showModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="close" @click="hideModal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete this category?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="hideModal">Cancel</button>
                    <button type="button" class="btn btn-danger" @click="deleteCategory">Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import { API_URL } from "../app.js";

export default {
    data() {
        return {
            categories: [],
            categoryToDelete: null,
            showModal: false
        };
    },
    created() {
        this.axios.get(`${API_URL}/categories/`).then((response) => {
            this.categories = response.data;
        });
    },
    methods: {
        showDeleteConfirmation(categoryId) {
            this.categoryToDelete = categoryId;
            this.showModal = true;
        },
        deleteCategory() {
            this.axios
                .delete(`${API_URL}/categories/${this.categoryToDelete}`)
                .then((response) => {
                    let i = this.categories
                        .map((data) => data.id)
                        .indexOf(this.categoryToDelete);
                    this.categories.splice(i, 1);
                    this.hideModal();
                    alert(response.data.message);
                })
                .catch((error) => {
                    alert(error.response.data.message);
                });
        },
        hideModal() {
            this.showModal = false;
        }
    }
};
</script>
  
 