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
                    <label class="form-label">PO Number</label>
                    <input type="text" required class="form-control" v-model="po_number" placeholder="">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">LC Buyer</label>
                    <select class="form-control" v-model="lc_buyer">
                        <option v-for="buyer in buyers" v-bind:value="buyer">{{buyer}}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Name of Raw Martial</label>
                    <select class="form-control" v-model="name_of_raw_matrial">
                        <option v-for="option in options" v-bind:value="option">{{option}}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Supplier/Seller</label>
                    <select class="form-control" v-model="supplier">
                        <option v-for="supplier in suppliers" v-bind:value="suppplier">{{supplier}}</option>
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
                    <label for="" class="form-label">Total KGS</label>
                    <input type="text" required class="form-control" v-model="total_kgs">
                </div>


                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
                date:"",
                pr_number:"",
                name_of_raw_matrial:"",
                quantity:"",
                quality:"",
                remarks:"",
                selected:0,
                options:''
            }
        },
        mounted() {
            const name_of_raw= fetch("api/name_of_raw_material")
                .then(response=>{
                    let material = response.json();
                    material.then((value) => {
                        console.log(value);
                        this.options = value;
                    });
                })

            //  this.options=['new','old']
        },
        methods:{
            async add_products(){
                const res=await fetch('api/pr_creation', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({
                        date: this.date,
                        pr_number: this.pr_number,
                        name_of_raw_matrial: this.name_of_raw_matrial,
                        quantity: this.quantity,
                        quality: this.quality,
                        remarks: this.remarks,
                        csrf:this.csrf
                    })
                }).then(response=>{
                    let newsData = response.json();
                    newsData.then((value) => {
                        alert(value.name)
                        console.log(value.name);
                        this.date = "";
                        this.pr_number="";
                        this.name_of_raw_matrial="";
                        this.quality="",
                            this.quantity="",
                            this.remarks=""

                    });
                })
            }
        }
    }

</script>

<style scoped>

</style>
