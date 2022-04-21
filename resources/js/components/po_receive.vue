<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">PO Receive</h6>
        </div>
        <div class="card-body">
            <p >PO Number wise Receive</p>

            <form @submit.prevent="add_products">

                <div class="mb-3">
                    <label for="" class="form-label">PO Number</label>
                    <select class="form-control" v-model="po_number">
                        <option v-for="number in po_numbers" v-bind:value="number">{{number}}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">PO Receive Date</label>
                    <input type="date" required class="form-control" v-model="date" placeholder="">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">TC Number</label>
                    <input type="text" required class="form-control" v-model="tc_number">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">GMO Test Report</label>
                    <input type="text" required class="form-control" v-model="gmo">
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
                po_number:"",
                date:"",
                tc_number:"",
                gmo:"",
                po_numbers:""
            }
        },
        mounted() {
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
                const res=await fetch('api/po_receive', {
                    method: 'POST',
                    headers: {'Content-Type': 'Application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({

                        date: this.date,
                        po_number:this.po_number,
                        tc_number:this.tc_number,
                        gmo:this.gmo,
                        csrf:this.csrf
                    })
                }).then(response=>{
                    let newsData = response.json();
                    newsData.then((value) => {
                        alert(value.name)
                        console.log(value.name);
                        this.po_number="";
                        this.date = "";
                        this.tc_number="";
                        this.gmo="";
                        this.total_kgs="";
                    });
                })
            }
        }
    }

</script>

<style scoped>

</style>
