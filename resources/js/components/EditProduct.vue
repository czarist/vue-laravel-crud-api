<template>
    <div>
        <h3 class="text-center">Edit Product</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateProduct">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="product.name">
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <input type="text" class="form-control" v-model="product.detail">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control" v-model="product.price" step="0.01" min="0">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" v-model="product.category_id">
                            <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5">Update</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
import { API_URL } from '../app.js';

export default {
    data() {
        return {
            product: {},
            categories: []
        }
    },
    created() {
        this.axios
            .get(`${API_URL}/products/${this.$route.params.id}`)
            .then((res) => {
                this.product = res.data;
            });
        this.axios
            .get(`${API_URL}/categories/`)
            .then(response => {
                this.categories = response.data;
            });
    },
    methods: {
        updateProduct() {
            this.axios
                .patch(`${API_URL}/products/${this.$route.params.id}`, this.product)
                .then((res) => {
                    this.$router.push({ name: 'home' });
                    alert("Product updated successfully.");
                })
                .catch((error) => {
                    alert("Error updating product: " + error.response.data.message);
                });
        }
    }
}
</script>