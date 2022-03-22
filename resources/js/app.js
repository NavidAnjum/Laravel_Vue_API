
require('./bootstrap');
import {createApp} from 'vue'
import PRCreation from './components/pr_creation.vue'
import NameofRawMaterial from './components/raw_material.vue'
const app=createApp({});

app.component('pr-creation',PRCreation)
app.component('raw-material',NameofRawMaterial)
app.mount('#app')

