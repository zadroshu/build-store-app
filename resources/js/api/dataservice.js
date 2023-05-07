import axios from "axios";

export default class Dataservice {
    api_url = 'http://localhost:8000';
    dataservice = {
        products: {
            async get() {
                return await axios.get('http://localhost/api/getProducts');
            },
        },
        product: {
            async get(id) {
                return await axios.get(`http://localhost/api/getProduct/${id}`);
            },

        },
    }
    
}

