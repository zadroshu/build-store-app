import './bootstrap';
import { createApp } from 'vue';
import VueAxios from 'vue-axios';
import router from './router/index.js';
import axios from 'axios';
import store from "./store";

import App from './App.vue';
import StButton from './components/primitives/st-button.vue';
import StInput from './components/primitives/st-input.vue';
import StLabel from './components/primitives/st-label.vue';
import StLoad from './components/primitives/st-load.vue';
import StCombobox from './components/primitives/st-combobox.vue';
import StModalNotification from './components/primitives/modals/st-modal-notification.vue';
import StPagination from './components/primitives/st-pagination.vue';
import StTabel from './components/primitives/st-tabel.vue';
import StConfirmationModal from './components/primitives/modals/st-confirmation-modal.vue';
import StProductCreateModal from './components/primitives/modals/st-product-create-modal.vue';
import StProductUpdateModal from './components/primitives/modals/st-product-update-modal.vue';
import StAdminHeader from './components/primitives/st-admin-header.vue';

window.apiUrl = 'http://localhost';

const app = createApp(App);


app
    .component('StButton', StButton)
    .component('StInput', StInput)
    .component('StLabel', StLabel)
    .component('StCombobox', StCombobox)
    .component('StModalNotification', StModalNotification)
    .component('StPagination', StPagination)
    .component('StTabel', StTabel)
    .component('StConfirmationModal', StConfirmationModal)
    .component('StProductCreateModal', StProductCreateModal)
    .component('StProductUpdateModal', StProductUpdateModal)
    .component('StAdminHeader', StAdminHeader)
    .component('StLoad', StLoad);

app
    .use(router)
    .use(store)
    .use(VueAxios, axios)
    .mount('#app');


