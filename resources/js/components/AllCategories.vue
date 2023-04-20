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
                            <button class="btn btn-danger" @click="deleteCategory(category.id)">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
 
<script>
import { API_URL } from '../app.js';

export default {
    data() {
        return {
            categories: []
        }
    },
    created() {
        this.axios
            .get(`${API_URL}/categories/`)
            .then(response => {
                this.categories = response.data;
            });
    },
    methods: {
        deleteCategory(id) {
            this.axios
                .delete(`${API_URL}/categories/${id}`)
                .then(response => {
                    let i = this.categories.map(data => data.id).indexOf(id);
                    this.categories.splice(i, 1);
                    alert(response.data.message);
                })
                .catch(error => {
                    alert(error.response.data.message);
                });

        }
    }
}
</script>