
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

import YSMLPRCreation from './components/ysml/ysml_pr_creation.vue'

import PendingList from './components/pr_pending_list.vue'
import POPendingList from './components/po_pending_list.vue'
import PRpending from './components/pr_list.vue'
import POpending from './components/po_list.vue'

const app=createApp({});
app.component('po-creation',POCreation);
app.component('pr-creation',PRCreation)
app.component('raw-material',NameofRawMaterial);
app.component('name-material',NameofMaterial);
app.component('lc-buyer',LCBuyer);
app.component('seller',Seller);
app.component('po-receive',POReceive);
app.component('bar-code',barcode);
//ysml
app.component('ysml-pr-creation',YSMLPRCreation);
app.component('pr-pending',PendingList);
app.component('po-pending',POPendingList);
app.component('pr-list',PRpending);
app.component('po-list',POpending);

app.mount('#app')

