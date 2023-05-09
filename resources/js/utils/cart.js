import dataservice from "../../js/App.vue";

class Cart {
    totalCount = 0;
    items = [];
    totalQuantity = 0;

    constructor() {
      if (Cart._instance) {
        return Cart._instance
      }
      Cart._instance = this;
  
      // ... Your rest of the constructor code goes after this
    }
  }
  
    async function getCart() {
        return await dataservice.cart.get();
    }
export default cart = new Cart();