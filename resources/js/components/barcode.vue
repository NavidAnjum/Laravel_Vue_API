<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Barcode</h6>
        </div>
        <div class="card-body">
            <p >Select PR and PO Number to generate Barcode</p>

            <form @submit.prevent="add_products">
<!--                <div class="mb-3">-->
<!--                    <label for="" class="form-label">PR Number</label>-->
<!--                    <select class="form-control" v-model="pr_number">-->
<!--                        <option v-for="pr in pr_numbers" v-bind:value="pr">{{pr}}</option>-->
<!--                    </select>-->
<!--                </div>-->

                <div class="mb-3">
                    <label for="" class="form-label">PO Number</label>
                    <select class="form-control" v-model="po_number">
                        <option v-for="number in po_numbers" v-bind:value="number">{{number}}</option>
                    </select>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Generate Barcode</button>
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
                po_numbers:"",
                pr_number:"",
                pr_numbers:"",
            }
        },
        mounted() {
            const pr_numbers_get= fetch("api/pr_numbers_list")
                .then(response=>{
                    let material = response.json();
                    material.then((value) => {
                        this.pr_numbers = value;
                    });
                });
            const po_number_get= fetch("api/po_number_list")
                .then(response=>{
                    let material = response.json();
                    material.then((value) => {
                        console.log(value);
                        this.po_numbers = value;
                    });
                });
        },
        methods:{
            async add_products(){
                fetch("https://api.npms.io/v2/search?q=vue")
                    .then(response => response.json())
                    .then(data => (this.totalVuePackages = data.total));

            }
        }
    }

</script>

<style scoped>

</style>
