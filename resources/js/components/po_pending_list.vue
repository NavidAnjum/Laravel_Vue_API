<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">PO Pending List</h6>
        </div>
        <div class="card-body">
            <p >Please Checkout All the pending List of PO.</p>

            <table class="table table-striped table-dark responsive">
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
                    <th scope="col">Approve</th>
                    <th scope="col">Reject</th>
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
                    <td>{{data.name_of_mats}}</td>

                    <td><button v-bind:value="data.id" @click="approve" type="button" class="btn btn-secondary">Approve</button>
                    </td>
                    <td><button v-bind:value="data.id" @click="reject" type="button" class="btn btn-secondary">Reject</button>
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
            const pr_numbers_get= fetch("api/po_pending_list")
                .then(response=>{
                    let material = response.json();
                    material.then((value) => {
                        console.log(value)
                        this.datas=value
                    });
                });


        },
        methods:{
            async approve(e){
                console.log(e.srcElement.value)
                const res=await fetch('api/po_creation_approve', {
                    method: 'POST',
                    headers: {'Content-Type': 'Application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        id: e.srcElement.value,
                        csrf:this.csrf
                    })
                }).then(response=>{
                    let newsData = response.json();
                    newsData.then((value) => {

                       alert(value.name)
                        console.log(value);
                        var url = window.location.href;
                       window.location.href = url;

                    });
                })

            },
            async reject(e){
                console.log(e.srcElement.value)
                const res=await fetch('api/po_creation_remove', {
                    method: 'POST',
                    headers: {'Content-Type': 'Application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        id: e.srcElement.value,
                        csrf:this.csrf
                    })
                }).then(response=>{
                    let newsData = response.json();
                    newsData.then((value) => {
                        alert(value.name)
                        console.log(value);
                        var url = window.location.href;
                        window.location.href = url;

                    });
                })

            }
        }
    }

</script>

<style scoped>

</style>
