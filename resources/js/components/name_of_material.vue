<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Name of Material</h6>
        </div>
        <div class="card-body">
            <p >Please add Name of material</p>
            <form @submit.prevent="raw_material">

                <div class="mb-3">
                    <label class="form-label">Material Name</label>
                    <input type="text" required class="form-control" v-model="name_of_material" placeholder="">
                    <input type="hidden" name="_token" :value="csrf" >

                </div>
                <div class="mt-2 mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                csrf:document.head.querySelector('meta[name="csrf-token"]').content,
                name_of_material:""
            }
        },
        methods:{
            async raw_material(){
                const res=await fetch('api/name_of_material', {
                    method: 'POST',
                    headers: {'Content-Type': 'Application/json'},
                    body: JSON.stringify({
                        name_of_material: this.name_of_material,
                        csrf: this.csrf
                    })
                })
                    .then(response=>{
                            let newval = response.json()
                            newval.then((value => {
                                alert(value.name);
                                this.name_of_material='';
                            }))

                        }
                    )

            }
        }
    }
</script>
