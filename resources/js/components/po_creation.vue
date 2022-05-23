<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">PO Creation</h6>
        </div>
        <div class="card-body">
            <p >Please add all information about PO.</p>

            <form @submit.prevent="add_products">

                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" required class="form-control" v-model="date" placeholder="">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">PR Number</label>
                    <select class="form-control" v-model="pr_number">
                        <option v-for="pr in pr_numbers" v-bind:value="pr">{{pr}}</option>
                    </select>
                </div>

                    <input type="hidden" required class="form-control" v-model="po_number" placeholder="">

                <div class="mb-3">
                    <label for="" class="form-label">LC Buyer</label>
                    <select class="form-control" v-model="lc_buyer">
                        <option v-for="buyer in buyers" v-bind:value="buyer">{{buyer}}</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Name of Material</label>
                    <select class="form-control" v-model="name_of_mat">
                        <option v-for="name in name_of_mats" v-bind:value="name">{{name}}</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Supplier/Seller</label>
                    <select class="form-control" v-model="supplier">
                        <option v-for="sup in loopsuppliers" v-bind:value="sup">{{sup}}</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Invoice Number</label>
                    <input type="text" required class="form-control" v-model="invoice">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">LC Number</label>
                    <input type="text" required class="form-control" v-model="lc_number">
                </div>


                <div class="mb-3">
                    <label for="" class="form-label">Total Number of Bales</label>
                    <input type="text" required class="form-control" v-model="bales">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Total KGS</label>
                    <input type="text" required class="form-control" v-model="total_kgs">
                </div>


                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">{{save}}</button>
                </div>
            </form>
        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return {
                csrf:document.head.querySelector('meta[name="csrf-token"]').content,
                po_number:"",
                date:"",
                lc_buyer:"",
                supplier:"",
                invoice:"",
                lc_number:"",
                bales:"",
                total_kgs:"",
                buyers:"",
                loopsuppliers:"",
                name_of_mat:"",
                name_of_mats:"",
                pr_numbers:"",
                pr_number:"",
                po_number_id:"",
                save:"Save",
                pr_number_id:""
            }
        },
        mounted() {

            this.po_number_id=sessionStorage.getItem('po_number_id');
            var r=sessionStorage.getItem('po_number_id');
            sessionStorage.clear();
            if(r==null){
                const po_number_get= fetch("api/po_number")
                    .then(response=>{
                        let material = response.json();
                        material.then((value) => {
                            console.log(value.po_number);
                            this.po_number = "PO-TSML-"+value.po_number;
                        });
                    });
            }
            else{
                const pr_update=fetch('api/po_creation_update/'+r)
                    .then(response=>{
                        let pr=response.json();
                        pr.then(value => {

                            console.log(value)
                            this.pr_number=value[0].pr_number;
                            this.date=value[0].date;
                            this.po_number=value[0].po_number;
                            this.lc_buyer=value[0].lc_buyer;
                            this.supplier=value[0].supplier;
                            this.name_of_mat=value[0].name_of_mats;

                            this.invoice = value[0].invoice;
                            this.lc_number = value[0].lc_number;
                            this.bales = value[0].bales;
                            this.total_kgs = value[0].total_kgs;
                            this.save="Update"
                            alert(this.po_number)
                        })
                    })
            }

            const pr_numbers_get= fetch("api/pr_numbers_list")
                .then(response=>{
                    let material = response.json();
                    material.then((value) => {
                        this.pr_numbers = value;
                    });
                });




            const lc_buyer_get= fetch("api/lc_buyer")
                .then(response=>{
                    let material = response.json();
                    material.then((value) => {
                        this.buyers = value;
                    });
                });


            const supplier_get= fetch("api/supplier")
                .then(response=>{
                    let material = response.json();
                    material.then((value) => {
                        console.log(value);
                        this.loopsuppliers = value;
                    });
                });

            const mats= fetch("api/name_of_mats")
                .then(response=>{
                    let material = response.json();
                    material.then((value) => {
                        console.log(value);
                        this.name_of_mats = value;
                    });
                });
        },
        methods:{
            async add_products(){
                if(this.save==="Save") {
                    const res = await fetch('api/po_creation', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'Application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body: JSON.stringify({
                            pr_number: this.pr_number,
                            date: this.date,
                            po_number: this.po_number,
                            lc_buyer: this.lc_buyer,
                            supplier: this.supplier,
                            invoice: this.invoice,
                            lc_number: this.lc_number,
                            bales: this.bales,
                            total_kgs: this.total_kgs,
                            name_of_mat: this.name_of_mat,
                            csrf: this.csrf
                        })
                    }).then(response => {
                        let newsData = response.json();
                        newsData.then((value) => {
                            alert(value.name)
                            var url = window.location.href;
                            window.location.href = url;

                        });
                    })
                }
                else{

                    const po_update = await fetch('api/po_number_update', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'Application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body: JSON.stringify({
                            pr_number: this.pr_number,
                            date: this.date,
                            po_number: this.po_number,
                            lc_buyer: this.lc_buyer,
                            supplier: this.supplier,
                            invoice: this.invoice,
                            lc_number: this.lc_number,
                            bales: this.bales,
                            total_kgs: this.total_kgs,
                            name_of_mat: this.name_of_mat,
                            csrf: this.csrf
                        })
                    }).then(response => {
                        let newsData = response.json();
                        newsData.then((value) => {
                            alert(value.name)
                            var url = window.location.href;
                            window.location.href = url;

                        });
                    })
                }
            }
        }
    }

</script>

<style scoped>

</style>
