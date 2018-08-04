<template>
    <div class="modal" id="editFilter" tabindex="-1" role="dialog" aria-hidden="true">
        <div v-if="filter" class="modal-dialog modal-lg" role="document">
            <form class="modal-content" @submit.prevent="editFilter" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Изменить фильтр</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <div class="form-group form-row">
                        <div class="col">
                            <label class="form-label" for="name">Название (UZ)</label>
                            <input class="form-control" type="text" id="filter-name" name="filter-name" v-model="filter.name">
                            <div v-if="errors.name">
                                <p style="color:red" v-text="errors.name[0]"></p>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label" for="name_ru">Название (RU)</label>
                            <input class="form-control" type="text" id="filter-name-ru" name="filter-name-ru" v-model="filter.name_ru">
                            <div v-if="errors.name_ru">
                                <p style="color:red" v-text="errors.name_ru[0]"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col">
                            <label class="form-label" for="name">Тип</label>
                            <select class="custom-select" name="type" id="sex" v-model="filter.type">
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
                            <select class="custom-select" name="sex" id="sex" v-model="filter.use">
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
                            <select class="custom-select" name="sex" id="sex" v-model="filter.status">
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
                            <input class="form-control" type="text" id="filter-name-ru" name="filter-name-ru" v-model="filter.position">
                            <div v-if="errors.position">
                                <p style="color:red" v-text="errors.position[0]"></p>
                            </div> 
                        </div>
                        
                    </div> 
                     <div class="form-group form-row">
                        <label class="form-label" for="category">Категория</label>
                    
                        <select class="form-control" v-model="filter.category_id" title="Выберите одну или несколько категорий..."  data-live-search="true">
                        <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                        </select> 
                    </div>
                    <div v-for="(item,index) in list">
                         <div class="form-group form-row">
                            <div class="col input-group">
                                <span class="input-group-addon">UZ</span>
                                <input class="form-control" type="text" :id="index" name="filter-name-ru" v-model="item.uz" required> 
                            </div>
                            
                            <div class="col input-group">
                                <span class="input-group-addon">RU</span>
                                <input  class="form-control" type="text" :id="index" name="filter-name-ru" v-model="item.ru" required> 
                            </div>
                            <span v-if="index==0" @click="plus" class="btn btn-success">+</span>
                            <span v-else  class="btn btn-danger" @click="remove(index)">-</span>
                        </div>
                        
                    </div>
                    <div v-if="errors.list">
                                <p style="color:red" v-text="errors.list[0]"></p>
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
    props : ['filters','currentFilter', 'categories'],

    data () {
        return {
            filter: '', 
            errors:'',
            list :[],
            listId:1, 
        }
    }, 

    methods: {
         editFilter () {  
            axios.patch(`/api/filters/${this.currentFilter.id}`,
            {
                list:this.list,
                name:this.filter.name,
                name_ru:this.filter.name_ru,
                status:this.filter.status,
                use:this.filter.use,
                type:this.filter.type,
                position:this.filter.position,
                category_id: this.filter.category_id
            })
                .then((response) => {  
                    this.filter = response.data
                    $('#editFilter').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    this.$emit('edited');
                    flash('Фильтр обновлен');
                }).catch((error)=> {
                    this.errors = error.response.data.errors 
                })
        },
        plus () {
        //    var option = this.listId + '/' + this.list;
        this.list.push({ru:'', uz:''})
           this.listId++; 
        },
        remove(index){
            this.list.splice(index,1)
        }
    },
    
    mounted () {
        self = this  
        this.filter = this.currentFilter          
        this.currentFilter.options.map((value,key)=>{
            this.list.push({uz: value[1], ru:value[2]})
        }) 
    }

}
</script> 