<template>
    <div class="modal" id="newProduct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form @submit.prevent="addProduct" class="modal-content" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Новая карточка товара</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group"> 
                            <label class="form-label" for="name">Категория</label>
                            <select class="selectpicker form-control" v-model="form.category_id"   data-live-search="true">
                               

                                <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                            </select> 
                            <div v-if="errors.category_id">
                                <p style="color:red" v-text="errors.category_id[0]"></p>
                            </div>
                            <div v-if="form.category_id && categoryFilters.length <= 0 ">
                                <p style="color:red">Нет доступных фильтров для этой категории</p>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Модель</label>
                        <input class="form-control" type="text" v-model="form.model">
                    </div>
                    <div class="form-group"> 
                            <label class="form-label" for="name">Производитель</label>

                            <select class="selectpicker form-control" v-model="form.manufacturer_id" data-live-search="true">
                                <option v-for="manufacturer in manufacturers" :value="manufacturer.id">{{manufacturer.name}}</option>
                            </select> 
                            <div v-if="errors.manufacturer_id">
                                <p style="color:red" v-text="errors.manufacturer_id[0]"></p>
                            </div>
                    </div>
                    <div class="form-group" v-if="charactSet">
                        <label class="form-label">Характеристика</label>
                        <div class="form-row" v-for="filter in categoryFilters">
                            <label class="col col-form-label" for="filter"><h5>{{filter.name}}</h5></label> 
                                <div class="col">
                                 <select class="form-control"  @change="call($event,filter)" :name="`filter_${filter.id}`">  
                                        <option value="0" selected>не выбрано</option>
                                        <option v-for="item in filter.options"
                                        :value="`filter_${filter.id+ '_option_'+item[0]}`">{{item[1]=item[2]}}</option> 
                                    </select>   
                                </div>  
                        </div> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal" @click="close">Закрыть</button>
                    <button type="sumbit" class="btn btn-blue">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    props:['categories', 'manufacturers', 'filters'],
    data(){
        return { 
            form:{
                manufacturer_id:'',
                list: [], 
                category_id : '',
                model:''
            },
            
            charactSet: false,            
            categoryFilters: [],
            errors:''

        }
    },
    watch : {
        'form.category_id' () { 
            this.form.list = []
            this.categories.map((item, key) => { 
                if(item.id == this.form.category_id)
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
    methods:{
        call(e,filter){ 
            if( e.target.value ==  0)
            { 
                this.form.list.map((value,key)=>{
                   var cut = value.split('=')
                   if(cut[0] == filter.id){
                       this.form.list.splice(key,1)
                   } 
                })
                
                return
            }
            if(this.form.list.length > 0 ){
                this.form.list.map((value, key)=>{
                    var cons = e.target.value.split('_') 
                    var old = value.split('=')
                    if(old[0] == cons[1]){ 
                        this.form.list.splice(key,1)
                    } 
                })
            } 
            let split = e.target.value.split('_')
            let item = split[1] + '=' + split[3]
            this.form.list.push(item) 
        },
        addProduct() {    
            axios.post('/api/products', this.form)
                .then(response =>{  
                    this.$emit('added', response.data)
                    flash("Продукт успешно добавлена!"); 
                             
                    
                    this.form.category_id = '';
                    this.form.manufacturer_id ='';
                    this.errors = '';
                    $('#newProduct').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    this.categoryFilters = []
                    this.charactSet = false  
                }).catch( error => { 
                    this.errors = error.response.data.errors
                })
        },
        close () {
            this.errors = '';
            this.form = {}
        },
        listItems (item) {
            // console.log(item)
        }
    }
}
</script>
<style lang="scss">
@import "~bootstrap-select/sass/bootstrap-select.scss";
</style>
