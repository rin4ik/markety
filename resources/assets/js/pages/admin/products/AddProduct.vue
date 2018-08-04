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
                            <label class="selectpicker form-label" for="name">Категория</label>
                            <select class="form-control"  title="Выберите категорию..." v-model="form.category_id"   data-live-search="true">
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
                            <label class="form-label" for="name">Производитель</label>

                            <select class="selectpicker form-control" v-model="form.manufacturer_id" title="Выберите производителя..." data-live-search="true">
                                <option v-for="manufacturer in manufacturers" :value="manufacturer.id">{{manufacturer.name}}</option>
                            </select> 
                            <div v-if="errors.manufacturer_id">
                                <p style="color:red" v-text="errors.manufacturer_id[0]"></p>
                            </div>
                    </div>
                    <div class="form-group" v-if="charactSet">
                        <label class="form-label">Характеристика</label>
                        <div class="form-row" v-for="filter in categoryFilters">
                            <label class="col col-form-label" for="filter">{{filter.name}}</label>
                            <div class="col form-group" >
                                <select class="custom-select" name="list[]" @click="listItems(filter)" v-model="form.list">
                                    <option value="0" selected>не выбран</option>
                                    <option v-for="item in filter.options" :value="item[0]">{{item[2]}}</option> 
                                </select>
                            </div>
                        </div> 
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Закрыть</button>
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
            },
           

            charactSet: false,            
            categoryFilters: [],
            errors:''

        }
    },
    watch : {
        'form.category_id' () { 
            this.categories.map((item, key)=> { 
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
        addProduct() {  
        //      if(this.form.parent_id == 0){
        //     this.form.parent_id = ''
        //   }
            axios.post('/api/products', {})
                .then(response =>{  
                    this.$emit('added', response.data)
                    flash("Продукт успешно добавлена!", "success"); 
                    // this.form = {};
                    this.errors = '';
                    $('#newProduct').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                }).catch( error => { 
                    this.errors = error.response.data.errors
                })
        },
        close () {
            this.errors = '';
            this.form = {}
        },
        listItems (item) {
            console.log(item)
        }
    }
}
</script>
<style lang="scss">
@import "~bootstrap-select/sass/bootstrap-select.scss";
</style>
