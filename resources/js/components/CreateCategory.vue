<template>
    <div>
        <h3 class="text-center">Create Category</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addCategory">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="category.name">
                    </div>

                    <button type="submit" class="btn btn-primary mt-5">Create</button>
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

    methods: {
        addCategory() {
            this.axios
                .post(`${API_URL}/categories`, this.category)
                .then(response => {
                    this.$router.push({ name: 'Categories' });
                    alert(response.data);
                })
                .catch(error => {
                    console.log(error);
                    alert('Error creating category');
                })
                .finally(() => this.loading = false);
        }
    }
}
</script>