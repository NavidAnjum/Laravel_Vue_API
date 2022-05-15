<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">PR Pending List</h6>
        </div>
        <div class="card-body">
            <p >Please Checkout All the pending List of PR.</p>

            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">PR Number</th>
                    <th scope="col">Date</th>
                    <th scope="col">Name Of Raw Material</th>
                    <th scope="col">Length</th>
                    <th scope="col">Strength</th>
                    <th scope="col">MIC</th>
                    <th scope="col">Remarks</th>
                    <th scope="col">Approve</th>
                    <th scope="col">Reject</th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="data in datas">
                    <th scope="row">1</th>
                    <td>{{data.pr_number}}</td>
                    <td>{{data.date}}</td>
                    <td>{{data.name_of_raw_matrial}}</td>
                    <td>{{data.l_quantity}}</td>
                    <td>{{data.s_quantity}}</td>
                    <td>{{data.m_quantity}}</td>
                    <td>{{data.remarks}}</td>
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
            const pr_numbers_get= fetch("api/pr_pending_list")
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
                    const res=await fetch('api/pr_creation_approve', {
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
                const res=await fetch('api/pr_creation_remove', {
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
