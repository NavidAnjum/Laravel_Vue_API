<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">PR Pending List</h6>
        </div>
        <div class="card-body">
            <p >Please Checkout All List of PR and Update if Needed.</p>

            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">PR Number</th>
                    <th scope="col">Date</th>
                    <th scope="col">Name Of Raw Material</th>
                    <th scope="col">Length</th>
                    <th scope="col">Strength</th>
                    <th scope="col">MIC</th>
                    <th scope="col">Remarks</th>
                    <th scope="col">Update</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="data in datas">
                    <td>{{data.pr_number}}</td>
                    <td>{{data.date}}</td>
                    <td v-if="data.name_of_raw_matrial">{{data.name_of_raw_matrial}}</td>
                    <td v-if="data.type_of_raw_matrial">{{data.type_of_raw_matrial}}</td>
                    <td>{{data.l_quantity}}</td>
                    <td>{{data.s_quantity}}</td>
                    <td>{{data.m_quantity}}</td>
                    <td>{{data.remarks}}</td>
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
                datas:[],

            }
        },
        mounted() {
            const pr_numbers_get= fetch("api/pr_list")
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
                console.log(e.srcElement.value)
                const res=await fetch('api/pr_update', {
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
                        var url = window.location.href;
                        url= url.split('/');
                        var ori=window.location.origin;
                        ori=ori+"/"+url[url.length-2]+"/"+"pr_creation";
                        sessionStorage.setItem("pr_number_id", value.name);
                        window.location.href = ori;
//                        ori=ori+"/"+url[url.length-2]+"/"+"pr_creation"+value.name;

                    });
                })


            }
        }
    }

</script>

<style scoped>

</style>
