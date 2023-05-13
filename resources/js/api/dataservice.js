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

        },
        cart: {
            async get() {
                return await axios.get(`${window.apiUrl}/api/getCart`);
            },
            async post(id) {
                return await axios.post(`${window.apiUrl}/api/addToCart/${id}`);
            },
        },
        categories: {
            async get() {
                return await axios.get(`${window.apiUrl}/api/getCategories`);
            },
        },
    }
}

