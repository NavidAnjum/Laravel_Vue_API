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
                    <label for="" class="form-label">Length</label>
                    <input type="text" required class="form-control" v-model="length_quantity" placeholder="">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Strength</label>
                    <input type="text" required class="form-control" v-model="strength_quantity" placeholder="">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">MIC</label>
                    <input type="text" required class="form-control" v-model="mic_quantity" placeholder="">
                </div>


                <div class="mb-3">
                    <label for="" class="form-label">Remarks</label>
                    <input type="hidden" name="_token" :value="csrf">

                    <textarea type="text"  class="form-control" v-model="remarks" placeholder="">
                    </textarea>
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
                date:"",
                pr_number:"",
                name_of_raw_matrial:"",
                type_of_raw_matrial:"",
                length_quantity:"",
                strength_quantity:"",
                mic_quantity:"",
                remarks:"",
                selected:0,
                options:'',
                pr_number_id:'',
                pr_updates:{},
                raw_mat:'',
                save:"Save"
            }
        },
        mounted() {

            this.pr_number_id=sessionStorage.getItem('pr_number_id');
            sessionStorage.removeItem('pr_number_id');
            let url= window.location.href;
            let org=url.split('/');
            const name_of_raw= fetch("api/get_type_of_raw_material")
               .then(response=>{
                   let material = response.json();
                   material.then((value) => {

                       this.options = value;
                   });
               });


            if(this.pr_number_id==='' || this.pr_number_id==null){

                const pr_number_get= fetch("api/pr_number")
                    .then(response=>{
                        let material = response.json();
                        material.then((value) => {

                            this.pr_number = "PR-"+org[3]+"-"+value.pr_number;

                        });
                    })
            }
            else{
                const pr_update=fetch('api/pr_creation_update/'+this.pr_number_id)
                    .then(response=>{
                        let pr=response.json();
                        pr.then(value => {
                            console.log(value)
                            this.date=value[0].date;
                            this.length_quantity=value[0].l_quantity;
                            this.strength_quantity=value[0].s_quantity;
                            this.mic_quantity=value[0].m_quantity;
                            this.remarks=value[0].remarks;
                            this.pr_number = "PR-TSML-"+value[0].id;
                            if(typeof(value[0].name_of_raw_matrial) !== 'undefined'){
                                this.raw_mat=" : "+value[0].name_of_raw_matrial;
                                this.name_of_raw_matrial=value[0].name_of_raw_matrial;

                            }else{
                                this.raw_mat=" : "+value[0].type_of_raw_matrial;
                                this.name_of_raw_matrial=value[0].type_of_raw_matrial;

                            }

                            this.save="Update"
                            alert(this.pr_number)


                        })
                    })
            }

          //  this.options=['new','old']
        },
        methods:{
            async add_products(){

                if(this.save==="Save"){
                    const res=await fetch('api/pr_creation', {
                        method: 'POST',
                        headers: {'Content-Type': 'Application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body: JSON.stringify({
                            date: this.date,
                            pr_number: this.pr_number,
                            name_of_raw_matrial: this.name_of_raw_matrial,
                            length_quantity: this.length_quantity,
                            strength_quantity: this.strength_quantity,
                            mic_quantity: this.mic_quantity,
                            remarks: this.remarks,
                            csrf:this.csrf
                        })
                    }).then(response=>{
                        let newsData = response.json();
                        newsData.then((value) => {
                            alert(value.name)

                            var url = window.location.href;
                            window.location.href = url;

                        });
                    })
                }
                else  if(this.save==="Update"){
                    if(this.name_of_raw_matrial===''){
                        this.name_of_raw_matrial=(this.raw_mat).slice(3,this.raw_mat.length);
                    }
                    const res=await fetch('api/pr_number_update', {
                        method: 'POST',
                        headers: {'Content-Type': 'Application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body: JSON.stringify({
                            date: this.date,
                            pr_number: this.pr_number,
                            name_of_raw_matrial: this.name_of_raw_matrial,
                            length_quantity: this.length_quantity,
                            strength_quantity: this.strength_quantity,
                            mic_quantity: this.mic_quantity,
                            remarks: this.remarks,
                            csrf:this.csrf
                        })
                    }).then(response=>{
                        let newsData = response.json();
                        newsData.then((value) => {
                            console.log(value)
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
