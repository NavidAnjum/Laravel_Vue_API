
require('./bootstrap');
import {createApp} from 'vue'
import PRCreation from './components/pr_creation.vue'
import NameofRawMaterial from './components/raw_material.vue'
import NameofMaterial from './components/name_of_material.vue'


import LCBuyer from './components/lc_buyer.vue'
import Seller from './components/supplier.vue'
import POCreation from './components/po_creation.vue'
import POReceive from './components/po_receive.vue'

import barcode from "./components/barcode";

const app=createApp({});
app.component('po-creation',POCreation);
app.component('pr-creation',PRCreation)
app.component('raw-material',NameofRawMaterial);
app.component('name-material',NameofMaterial);
app.component('lc-buyer',LCBuyer);
app.component('seller',Seller);
app.component('po-receive',POReceive);
app.component('bar-code',barcode);
app.mount('#app')

