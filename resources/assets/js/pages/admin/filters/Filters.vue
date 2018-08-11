<template>
    <div>
        <!-- <FilterCatalog :bus="bus" :categories="categories" /> -->
        <div class="toolbar d-flex justify-content-between">
            
            <aside class="form-row">
                <div class="col-auto input-group input-group-sm">
                    <select class="custom-select" v-model="value">
                        <option value="0" selected>Действие</option>
                        <option value="1">Редактировать</option>
                        <option value="2">Удалить</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-light" :class="[value==1 ? 'btn-primary':'', value == 2 ? 'btn-danger':'']"  @click="change" type="button">OK</button>
                    </div>
                </div>
                <div class="col-auto">
                    <select  class="selectpicker" data-live-search="true" @change="categoryChange" >
                        <option value="0"  selected>Выберите категорию</option>
                        <option  v-for="category in categories"  :value="category.id">{{category.name_ru}}</option>
                    
                    </select> 
                </div>
            </aside>
            <aside class="form-row">
                <div class="col-auto input-group input-group-sm">
                    <input v-model="search" class="form-control" type="text" placeholder="Поиск">
                    <div class="input-group-append">
                        <button class="btn btn-light" type="button">OK</button>
                    </div>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#newFilter">Добавить</button>
                </div>
            </aside>
        </div> 
 
        <div class="page-body">
            <table class="table table-striped table-hover table-sm" v-if="filtered.length>0">
                   <tr>
                        <th class="col-auto">
                            <input type="checkbox" @click="selectAll">
                        </th>
                        <th class="col-auto">ID</th>
                        <th class="col-3">Название</th> 
                        <th class="col-3">Категория</th> 
                        <th class="col-3">Позиция</th>
                        <th class="col-3">Тип</th>
                        <th class="col-3">Использовать на сайте</th>
                        <th class="col-3">Статус</th>
                    </tr>
                <tbody>
                    <FilterOn v-if="filter" :edited="editedVar" :categories="categories" :filters="allFilters" @render="render" @selected="markSelected" :deletedItem="deleted" @unselected="unselect" v-for="(filter,index) in filtered" :filter="filter" :checked="allItems" :key="index" />
                </tbody>
                 
            </table>
                <h4 style="margin-left:20px" v-else>Выберите категорию</h4>

        </div> 
        
        <EditFilter v-if="filter" :categories="categories" @edited="edited" :currentFilter="filter" :filters="allFilters" />  
        <AddFilter :categories="categories" @filterAdded="filterAdded" :catalog="cat" :deletedItem="deleted"/>
    </div>
</template>
<script>
import AddFilter from './AddFilter'
import EditFilter from './EditFilter'
import FilterOn from './Filter' 
export default {

    components: { AddFilter, FilterOn, EditFilter },
    props: ['filters','categories'],
    data () {
        return {
            doesntSub: true,
            selected:'',
            value:0,
            bus: new Vue(),
            filteredList:[],
            allFilters: this.filters,
            allItems: false, 
            selectedItems: [],
            filter:'',
            deleted : false,
            cat:'',
            editedVar:false,
            el:[],
            search:'',
            categoryId: 0
        }
    },
    created () { 
        this.bus.$on('value', (item) => {
            this.cat = item
        });
    },
    watch : {
        cat () { 
           this.el = []
            
            this.allFilters.map((key,value)=>{
                if(key.category_id == this.cat.id){ 
                    this.el.push(key)
                }  
            })
        }
    },
    computed : {
        filtered() {
            return this.filteredList.filter(filter => {
                return filter.name_ru.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    },
    methods :{
        categoryChange(e){
            this.filteredList = []
            return this.allFilters.filter(filter => {
                if(filter.category_id == e.target.value){
                    this.filteredList.push(filter)
                } 
            })
        },
        edited (item) {  
            this.editedVar = true
            this.allFilters.map((value, key)=>{
                if(item.id == value.id){
                    console.log('item')
                    this.allFilters[key] = item
                    this.filter = item
                }
            })
        }, 
        filterAdded (item) { 
            this.allFilters.push(item)            
            this.filteredList.push(item)
        }, 
        selectAll() {
            if(this.allItems){
            this.selectedItems = []
            return this.allItems = !this.allItems
            }
            this.selectedItems = this.allFilters
            return this.allItems = !this.allItems
        },
        change() {
            if(this.allItems){
                if(this.value == 2){
                    axios.delete('/api/remove/filters')
                    .then((response)=>{
                        this.allFilters=''
                        flash('Удалены все Фильтры!', 'danger')
                        return
                    })
                }
            }
            if(this.selectedItems.length >= 1){
                if(this.value == 1 && this.selectedItems.length > 1) {
                    flash('Пожалуйста выберите только один фильтр!','danger')

                    return
                }else if(this.value == 1 && this.selectedItems.length == 1){ 
                   return $('#editFilter').modal('show');            
                }
                if(this.value == 2) { 
                    self = this
                    this.selectedItems.map((item, key) => {  
                        this.allFilters.map((man, index) =>{
                            if(man.id == item.id){  
                                
                                axios.delete('/api/filters/' + item.id).then(()=>
                                {    
                                    location.reload()
                                flash('Фильтр удален!', 'danger')
                                
                                })
 
                            }
                        })
                    return this.selectedItems = [] 
                });                      
                } 
                return
            } 

            if(this.selectedItems.length == 0){
                flash('Пожалуйста выберите хотябы один фильтр','danger')
            }
        },
        markSelected (filter) { 
            self = this    
            this.deleted = false        
            this.selectedItems.map((value, key) => {
                if(value.id == filter.id){ 
                    self.selectedItems.splice(key,1) 
                }
                return
            }) 
            this.filter = filter
            this.selectedItems.push(filter);
        },
        unselect (filter) {
          self = this            
            this.selectedItems.map((value, key) => {
                if(value.id == filter.id){ 
                    self.selectedItems.splice(key,1)  
                    if(self.selectedItems.length < 1)
                    {
                        this.filter = ''
                    }else if (self.selectedItems.length == 1)
                    {
                        self.selectedItems.map((value,key)=>{

                            this.filter = value                        
                        })
                    }
                } 
                return
            }) 

        }, 
    }
}
</script> 
<style lang="scss">
    @import '~bootstrap-select/sass/bootstrap-select.scss';
</style>