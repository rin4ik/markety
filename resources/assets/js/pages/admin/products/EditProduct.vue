<template>
    <div class="modal animated fadeInDown" id="editProduct" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form @submit.prevent="editProduct" class="modal-content" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Изменение карточка товара</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group"> 
                            <label class="form-label" for="name">Категория</label>
                            <select class="form-control" v-model="product.category_id">
                                <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                            </select> 
                            <div v-if="errors.category_id">
                                <p style="color:red" v-text="errors.category_id[0]"></p>
                            </div>
                    </div>
                    <div class="form-group"> 
                            <label class="form-label" for="name">Производитель</label>

                            <select class="form-control" v-model="product.manufacturer_id">
                                <option v-for="manufacturer in manufacturers" :value="manufacturer.id">{{manufacturer.name}}</option>
                            </select> 
                            <div v-if="errors.manufacturer_id">
                                <p style="color:red" v-text="errors.manufacturer_id[0]"></p>
                            </div>
                    </div>
                   <div class="form-group" v-if="charactSet">
                        <label class="form-label">Характеристика</label>
                        <div class="form-row"  v-for="filter in categoryFilters">
                            <label class="col col-form-label" for="filter"><h5>{{filter.name}}</h5></label> 
                                <div class="col" >
                                    <select class="form-control"    @change="call($event,filter)"  :name="`filter_${filter.id}`">  
                                        <option value="0" >не выбрано</option>
                                        <option v-for="item in filter.options"   :value="`filter_${filter.id+ '_option_'+item[0]}`"  >{{item[1]}}
                                        </option> 
                                    </select>   
                                </div>  
                        </div> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Закрыть</button>
                    <button type="sumbit" class="btn btn-blue">Изменить</button>
                </div>
            </form>
            </div>
        </div>
</template>
<script>

export default {
    props : ['products','pro', 'filters', 'categories', 'manufacturers'],

    data () {
        return {
            product: '', 
            errors:'', 
            list:[],
            categoryFilters: '',
            charactSet: false, 
        }
    }, 
watch : {
        'product.category_id' () { 
            this.product.list = []
            this.categories.map((item, key)=> { 
                if(item.id == this.product.category_id)
                {
                    if(item.filters.length > 0){
                        this.categoryFilters = item.filters                        
                        this.charactSet = true                    
                        return
                    }
                    else{
                        this.categoryFilters = []
                        this.charactSet = false    
                    }
                }
            }) 
        }
    }, 
    methods: {
        // selectOption (filter,item){
        //     this.product.characs.filter((value,key)=>{ 
        //     var fil =  value.split('=')
        //     var log = `filter_${fil[0 ]+ '_option_'+fil[1]}` 
        //     var til = `filter_${filter.id + '_option_'+ item[0]}`
        //             if(log ==til){  
        //                 return true
        //             }
        //     })  
        // },
        call(e,filter){ 
             if( e.target.value ==  0)
            { 
                this.product.characs.map((value,key)=>{
                   var cut = value.split('=')
                   if(cut[0] == filter.id){
                       this.product.characs.splice(key,1)
                   } 
                })
                
                return
            }
            if(this.product.characs.length > 0 ){
                this.product.characs.map((value, key)=>{ 
                    var cons = e.target.value.split('_') 
                    var old = value.split('=')
                    if(old[0] == cons[1]){ 
                        this.product.characs.splice(key,1)
                    } 
                })
            } 
            let split = e.target.value.split('_')
            let item = split[1] + '=' + split[3]
            this.product.characs.push(item) 
        },
         editProduct () { 
            axios.patch(`/api/products/${this.product.id}`, this.product )
                .then((response) => { 
                    console.log(response.data)
                    this.product = response.data
                    $('#editProduct').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    this.$emit('edited');
                    flash('Производитель обновлен');
                }).catch((error)=> {
                    this.errors = error.response.data.errors 
                })
        }, 
    }, 
    mounted() {
        this.product = this.pro;  
        this.categories.map((item, key)=> { 
            if(item.id == this.product.category_id)
            {
                if(item.filters.length > 0){
                    this.categoryFilters = item.filters                        
                    this.charactSet = true                    
                    return
                }
                else{
                    this.categoryFilters = []
                    this.charactSet = false    
                }

            }
        })  
    },

}
</script>
<style>
.image{
    margin-left:10px
}
</style> 