<template>
    <div>
        <h3 class="text-center">Edit Category</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateCategory">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="category.name">
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
            category: {},
        }
    },
    created() {
        this.axios
            .get(`${API_URL}/categories/${this.$route.params.id}`)
            .then((res) => {
                this.category = res.data;
            });
    },
    methods: {
        updateCategory() {
            this.axios
                .patch(`${API_URL}/categories/${this.$route.params.id}`, this.category)
                .then((res) => {
                    // Se a requisição for bem sucedida, redireciona para a página de categorias
                    this.$router.push({ name: 'Categories' });
                    // Exibe uma mensagem de sucesso
                    alert('Category updated successfully.');
                })
                .catch((err) => {
                    // Exibe uma mensagem de erro com base no status da resposta
                    if (err.response && err.response.status === 404) {
                        alert('Category not found.');
                    } else {
                        alert('An error occurred while updating the category.');
                    }
                });
        }

    }
}
</script>