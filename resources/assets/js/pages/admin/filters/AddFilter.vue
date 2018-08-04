<template>
    <div class="modal" id="newFilter" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" @submit.prevent="add" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Новый филтер
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group form-row">
                        <div class="col">
                            <label class="form-label" for="name">Название (RU)</label>
                            <input class="form-control" type="text" id="filter-name-ru" name="filter-name-ru" v-model="form.name">
                            <div v-if="errors.name">
                                <p style="color:red" v-text="errors.name[0]"></p>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label" for="name">Название (UZ)</label>
                            <input class="form-control" type="text" id="filter-name-uz" name="filter-name-ru" v-model="form.name_ru">
                            <div v-if="errors.name_ru">
                                <p style="color:red" v-text="errors.name_ru[0]"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col">
                            <label class="form-label" for="name">Тип</label>
                            <select class="custom-select" name="sex" id="sex" v-model="form.type">
                                <option value="0" selected disabled>Не выбран</option>
                                <option value="radio">Radio</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="select">Select</option>
                                <option value="input">Input</option>
                            </select>
                            <div v-if="errors.type">
                                <p style="color:red" v-text="errors.type[0]"></p>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label" for="name">Использовать на сайте</label>
                            <select class="custom-select" name="sex" id="sex" v-model="form.use">
                                <option value="0" selected disabled>Не выбран</option>
                                <option value="Да">Да</option>
                                <option value="Нет">Нет</option>
                            </select>
                            <div v-if="errors.use">
                                <p style="color:red" v-text="errors.use[0]"></p>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label" for="name">Статус</label>
                            <select class="custom-select" name="sex" id="sex" v-model="form.status">
                                <option value="0" selected disabled>Не выбран</option>
                                <option value="active">Активен</option>
                                <option value="inactive">Неактивен</option>
                            </select>
                            <div v-if="errors.status">
                                <p style="color:red" v-text="errors.status[0]"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col">
                            <label class="form-label" for="name">Позиция</label>
                            <input class="form-control" type="text" id="filter-name-ru" name="filter-name-ru" v-model="form.position">
                            <div v-if="errors.position">
                                <p style="color:red" v-text="errors.position[0]"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="name">Категория</label>
                    
                        <select class="selectpicker form-control" v-model="form.category_id" title="Выберите одну категорию..."  data-live-search="true">
                        <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                        </select> 
                        <div v-if="errors.category_id">
                                <p style="color:red" v-text="errors.category_id[0]"></p>
                            </div>
                    </div>
                    <div v-for="(item,index) in list">
                         <div class="form-group form-row">
                            <div class="col input-group">
                                <span class="input-group-addon">UZ</span>
                                <input class="form-control" type="text" :id="index" name="filter-name-ru" v-model="item.uz"> 
                            </div>
                            
                            <div class="col input-group">
                                <span class="input-group-addon">RU</span>
                                <input  class="form-control" type="text" :id="index" name="filter-name-ru" v-model="item.ru"> 
                            </div>
                            <span v-if="index==0" @click="plus" class="btn btn-success">+</span>
                            <span v-else  class="btn btn-danger" @click="remove(index)">-</span>
                        </div>
                            <div v-if="errors.list">
                                <p style="color:red" v-text="errors.list[0]"></p>
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
    data () {
        return {
            form: {
                name:'',
                name_ru:'',
                type:'',
                use:'',
                status:'',
                position:'',
                list:[],
                category_id:''
            },
            list: [
                {
                    uz: '',
                    ru: ''
                }
            ],
            listId:1,
            errors: '',
            show: false
        }        
    },
    methods:{
        add () {   
            axios.post('/api/filters',  { category_id: this.form.category_id, name:this.form.name, name_ru:this.form.name_ru, type: this.form.type, use: this.form.use, status:this.form.status, position: this.form.position, list: this.list}).then((response)=>{
                this.$emit('filterAdded', response.data)
                $('#newFilter').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                this.form = {};
                this.form.category_id = ''
                this.list = [{
                    uz:'', ru:''                    
                }
                ]; 
                this.errors = '';
             flash('Новый фильтр добавлен!');
            }).catch((error)=>{
                this.errors = error.response.data.errors
            })
        },
        plus () {
        //    var option = this.listId + '/' + this.list;
        this.list.push({ru:'', uz:''})
           this.listId++;
        //    this.form.list = option 
        //    this.show = true
        },
        remove(index){
            this.list.splice(index,1)
        }
    },
    props:['category','categories'] 
}
</script>
<style lang="scss">
    @import '~bootstrap-select/sass/bootstrap-select.scss';
</style>