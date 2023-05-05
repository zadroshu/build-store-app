import axios from "axios";

export default class Dataservice {
    api_url = import.meta.env.APP_URL;
    dataservice = {
        products: {
            async get() {
                return await fetch(`${api_url}/api/products`, { method: 'GET' });
            },
        },
        product: {
            async get(id) {
                return await fetch(`${api_url}/api/product/${id}`, { method: 'GET' });
            },

            async axiosget(id) {
                return await axios.get(`${api_url}/api/product/${id}`);
            }
        },
    }
    
}

