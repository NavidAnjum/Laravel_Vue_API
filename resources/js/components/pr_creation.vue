<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">PR Creation</h6>
        </div>
        <div class="card-body">
            <p >Please add all information about PR.</p>

            <form @submit.prevent="add_products">
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" required class="form-control" v-model="date" placeholder="">
                    <input type="hidden" class="form-control" v-model="pr_number" placeholder="">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Type of Raw Martial</label>
                    <select class="select2class form-control" v-model="name_of_raw_matrial">
                        <option v-for="option in options" v-bind:value="option">{{option}}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Quantity</label>
                    <input type="text" required class="form-control" v-model="quantity" placeholder="">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Quality</label>

                    <select class="select2class form-control" v-model="quality">
                        <option value="Length">Length
                        </option>
                        <option value="Length">Strength
                        </option>
                        <option value="Length">MIC
                        </option>
                    </select>

                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Remarks</label>
                    <input type="hidden" name="_token" :value="csrf">

                    <textarea type="text"  class="form-control" v-model="remarks" placeholder="">
                    </textarea>
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
               });

            const pr_number_get= fetch("api/pr_number")
                .then(response=>{
                    let material = response.json();
                    material.then((value) => {
                        console.log(value);
                        this.pr_number = "PI-TSML-"+value;
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
