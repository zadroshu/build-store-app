export default class Dataservice {
    dataservice = {
        product: {
            get: async () => {
                return await fetch('/');
            }
        }
    }
    
}

