<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Supplier or Seller</h6>
        </div>
        <div class="card-body">
            <p >Please add Supplier/Seller</p>
            <form @submit.prevent="raw_material">
                <div class="mb-3">
                    <input type="text" required class="form-control" v-model="supplier" placeholder="">
                    <input type="hidden" name="_token" :value="csrf" >

                    <div class="mt-2 mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
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
                supplier:""
            }
        },
        methods:{
            async raw_material(){
                const res=await fetch('api/name_of_supplier', {
                    method: 'POST',
                    headers: {'Content-Type': 'Application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        supplier: this.supplier,
                        csrf:this.csrf
                    })
                })
                    .then(response=>{
                            let newval = response.json()
                            newval.then((value => {
                                alert(value.name)
                                this.supplier=''
                            }))

                        }
                    )

            }
        }
    }
</script>
