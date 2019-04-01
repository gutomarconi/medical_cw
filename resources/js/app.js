require('./bootstrap')
import BootstrapVue from "bootstrap-vue"
import Vue from 'vue'
import VueRouter from 'vue-router'
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'

Vue.use(VueMaterial);
Vue.use(VueRouter);
Vue.use(BootstrapVue);

import ViewPatients from './components/ViewPatients'
import MedicalRecords from './components/MedicalRecords'

Vue.component('modal', {
    template: '#modal-template'
});

Vue.component('modalCreate', {
    template: '#modalCreate-template'
});

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/patients',
            name: 'patients',
            component: ViewPatients,
        },
        {
            path: '/medicalrecords',
            name: 'MedicalRecords',
            component: MedicalRecords,
        },
    ]
});

const app = new Vue({
    el: '#app',
    router,
    components: {
        ViewPatients,
        MedicalRecords
    }
});

