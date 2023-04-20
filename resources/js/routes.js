import AllProduct from './components/AllProduct.vue';
import CreateProduct from './components/CreateProduct.vue';
import EditProduct from './components/EditProduct.vue';
import AllCategories from './components/AllCategories.vue';
import CreateCategory from './components/CreateCategory.vue';
import EditCategory from './components/EditCategory.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllProduct
    },
    {
        name: 'create',
        path: '/create',
        component: CreateProduct
    },
    {
        name: 'CreateCategory',
        path: '/createCategory',
        component: CreateCategory
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditProduct
    },
    {
        name: 'edit_category',
        path: '/edit_category/:id',
        component: EditCategory
    },
    {
        name: 'Categories',
        path: '/categories',
        component: AllCategories
    }
];