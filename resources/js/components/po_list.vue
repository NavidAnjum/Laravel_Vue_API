<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">PO Pending List</h6>
        </div>
        <div class="card-body">
            <p >Please Checkout All the pending List of PO.</p>

            <table class="table table-striped table-dark table-responsive">
                <thead>
                <tr>
                    <th scope="col">PO Number</th>
                    <th scope="col">PR Number</th>
                    <th scope="col">Date</th>
                    <th scope="col">lC Buyer</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">LC Number</th>
                    <th scope="col">Bales</th>
                    <th scope="col">Total Kgs</th>
                    <th scope="col">Name Of Material</th>
                    <th scope="col">Update</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="data in datas">
                    <td>{{data.po_number}}</td>
                    <td>{{data.pr_number}}</td>
                    <td>{{data.date}}</td>
                    <td>{{data.lc_buyer}}</td>
                    <td>{{data.supplier}}</td>
                    <td>{{data.invoice}}</td>
                    <td>{{data.lc_number}}</td>
                    <td>{{data.bales}}</td>
                    <td>{{data.total_kgs}}</td>
                    <td>{{data.name_of_mats}}</td>

                    <td><button v-bind:value="data.id" @click="update" type="button" class="btn btn-secondary">Update</button>
                    </td>

                </tr>

                </tbody>
            </table>

        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return {
                csrf:document.head.querySelector('meta[name="csrf-token"]').content,
                datas:[]
            }
        },
        mounted() {
            const pr_numbers_get= fetch("api/po_list")
                .then(response=>{
                    let material = response.json();
                    material.then((value) => {
                        console.log(value)
                        this.datas=value
                    });
                });


        },
        methods:{
            async update(e){
                await sessionStorage.setItem("po_number_id", e.srcElement.value);

                console.log(e.srcElement.value)
                var url = window.location.href;
                url= url.split('/');
                var ori=window.location.origin;
                ori=ori+"/"+url[url.length-2]+"/"+"po_creation";

                window.location.href = ori;

            }
        }
    }

</script>

<style scoped>

</style>
