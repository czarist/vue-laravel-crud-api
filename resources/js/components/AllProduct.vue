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
                            <button class="btn btn-danger" @click="deleteProduct(product.id)">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
 
<script>
export default {
    data() {
        return {
            products: [],
            categories: []
        }
    },
    created() {
        this.axios
            .get('http://localhost:8000/api/products/')
            .then(response => {
                this.products = response.data;
            });
        this.axios
            .get('http://localhost:8000/api/categories/')
            .then(response => {
                this.categories = response.data;
            });
    },
    methods: {
        deleteProduct(id) {
            this.axios
                .delete(`http://localhost:8000/api/products/${id}`)
                .then(response => {
                    let i = this.products.map(data => data.id).indexOf(id);
                    this.products.splice(i, 1);
                    alert(response.data);
                })
                .catch(error => {
                    alert(error.response.data.message);
                });
        }
    }
}
</script>