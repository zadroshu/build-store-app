import { toRaw } from 'vue';

export default {
    namespaced: true,

    state: {
        cart: [],
    },

    getters: {
        cart(state) {
            return state.cart;
        },

        totalQuantity(state) {
            if (state.cart?.length > 0) {
                return state.cart.reduce((accumulator, currentValue) => accumulator += currentValue.quantity, 0);
            }

            return 0;
        },

        productQuantity(state, product) {
            const item = state.cart.find(item => item?.product?.id === product?.id);
            if (item) {
                return item.quantity;
            } else {
                return null;
            }
        },
    },

    mutations : {
        addToCart(state, product) {
            let item = state.cart.find(item => item?.product?.id === product?.id);
            if (item) {
                item.quantity++;
                state.cart = state.cart.map(cartItem => {
                    if (cartItem.product.id === item.product.id) {
                        cartItem = item;
                    }
                    return cartItem;
                });
            } else {
                state.cart.push({product: product, quantity: 1 });
            }
        },

        deleteFromCart(state, cartItem) {
            let item = state.cart.find(item => item?.product?.id === cartItem?.product?.id);

            if (item.quantity > 1) {
                item.quantity--;
                state.cart = state.cart.map(cartItem => {
                    if (cartItem.product.id === item.product.id) {
                        cartItem = item;
                    }
                    return cartItem;
                }); 
            } else {
                state.cart = state.cart.filter(item => item?.product?.id !== cartItem?.product?.id);
            }
        },

        updateCartFromLocalStorage(state) {
            const cart = localStorage.getItem('cart');
            if(cart) {
                state.cart = JSON.parse(cart).cart;
            }
        },
    },
    actions : {
        updateLocalStorage(cart) {
            localStorage.setItem('cart', JSON.stringify(toRaw(cart.state)));
        },
        
        addToCart({state, dispatch, commit}, product) {
            commit('addToCart', product);
            dispatch('updateLocalStorage', state.cart);
        }, 

        deleteFromCart({state, dispatch, commit}, cartItem) {
            commit('deleteFromCart', cartItem);
            dispatch('updateLocalStorage', state.cart);
        }
    },
    modules : {},
};

  