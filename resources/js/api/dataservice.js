import axios from "axios";

export default class Dataservice {
    dataservice = {
        products: {
            async get() {
                return await axios.get(`${window.apiUrl}/api/getProducts`);
            },
            async getByName(name) {
                return await axios.get(`${window.apiUrl}/api/getProductByName/${name}`);
            }
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
    }
}

