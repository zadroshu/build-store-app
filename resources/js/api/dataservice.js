import axios from "axios";

export default class Dataservice {
    dataservice = {
        products: {
            async get() {
                return await axios.get(`${window.apiUrl}/api/getProducts`);
            },
            async getByName(name) {
                return await axios.get(`${window.apiUrl}/api/getProductByName/${name}`);
            },
            async sortProducts(categoryId, sortId) {
                return await axios.get(`${window.apiUrl}/api/sortProducts/${categoryId}/${sortId}`);
            },


            async searchByCategory(categoryId) {
                return await axios.get(`${window.apiUrl}/api/searchByCategory/${categoryId}`);
            },
            async sortByCostLowToHight(categoryId) {
                return await axios.get(`${window.apiUrl}/api/sortProductLowToHight/${categoryId}`);
            },
            async sortByCostHightToLow(categoryId) {
                return await axios.get(`${window.apiUrl}/api/sortProductHightToLow/${categoryId}`);
            },
        },
        product: {
            async get(id) {
                return await axios.get(`${window.apiUrl}/api/getProduct/${id}`);
            },
            async delete(id) {
                return await axios.post(`${window.apiUrl}/api/deleteProduct/${id}`);
            },
            async update(product) {
                return await axios.post(`${window.apiUrl}/api/updateProduct`, product);
            },
            async create(product) {
                return await axios.post(`${window.apiUrl}/api/createProduct`, product);
            }

        },
        categories: {
            async get() {
                return await axios.get(`${window.apiUrl}/api/getCategories`);
            },
        },
        category: {
            async get(id) {
                return await axios.get(`${window.apiUrl}/api/getCategory/${id}`);
            },
            async create(category) {
                return await axios.post(`${window.apiUrl}/api/createCategory`, category);
            },
            async update(category) {
                return await axios.post(`${window.apiUrl}/api/updateCategory`, category);
            },
            async delete(id) {
                return await axios.post(`${window.apiUrl}/api/deleteCategory/${id}`);
            },
        },
        order: {
            async create(order) {
                return await axios.post(`${window.apiUrl}/api/createOrder`, order);
            },
            async delete(id) {
                return await axios.post(`${window.apiUrl}/api/deleteOrder/${id}`);
            },
            async update(order) {
                return await axios.post(`${window.apiUrl}/api/updateOrder`, order);
            },
        },
        orders: {
            async get() {
                return await axios.get(`${window.apiUrl}/api/getOrders`);
            },
        },
        admins: {
            async get() {
                return await axios.get(`${window.apiUrl}/api/getAdmins`);
            },
        },
        admin: {
            async create(admin) {
                return await axios.post(`${window.apiUrl}/api/createAdmin`, admin);
            },
            async update(admin) {
                return await axios.post(`${window.apiUrl}/api/updateAdmin`, admin);
            },
        },
    }
}

