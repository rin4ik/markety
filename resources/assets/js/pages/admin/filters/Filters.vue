<template>
    <div>
        <!-- <FilterCatalog :bus="bus" :categories="categories" /> -->
        <div class="toolbar d-flex justify-content-between">
            
            <aside class="form-row">
                <div class="col-auto input-group input-group-sm">
                    <select class="custom-select" v-model="value">
                        <option value="0" disabled selected>Действие</option>
                        <option value="1">Редактировать</option>
                        <option value="2">Удалить</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-dark"  @click="change" type="button">OK</button>
                    </div>
                </div> 
            </aside>
            
            <aside class="form-row">
                <div class="col-auto input-group input-group-sm">
                    <input class="form-control" type="text" placeholder="Поиск">
                    <div class="input-group-append">
                        <button class="btn btn-dark" type="button">OK</button>
                    </div>
                </div>
                <div class="col-auto">
                    <button class="btn btn-sm btn-blue" type="button" data-toggle="modal" data-target="#newFilter">Добавить</button>
                </div>
            </aside>
        </div>
        <div v-if="allFilters">
 
        <div class="page-body">
            <table class="table table-striped table-hover table-sm" v-if="allFilters.length>0">
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
                    <FilterOn :edited="editedVar" :categories="categories" :filters="allFilters" @render="render" @selected="markSelected" :deletedItem="deleted" @unselected="unselect" v-for="(filter,index) in allFilters" :currentFilter="filter" :checked="allItems" :key="index" />
                </tbody>
                 
            </table>
                <h4 style="margin-left:20px" v-else>Нет доступных фильтров</h4>

        </div> 
        
        <EditFilter v-if="filter" :categories="categories" @edited="editedVar" :currentFilter="filter" :filters="allFilters" /> 
        </div>
        <h3 v-else> Нет фильтров</h3>
        <AddFilter :categories="categories" @filterAdded="filterAdded" :catalog="cat" :deletedItem="deleted"/>
    </div>
</template>
<script>
import AddFilter from './AddFilter'
import EditFilter from './EditFilter'
import FilterOn from './Filter'
import FilterCatalog from './FilterCatalog' 
export default {

    components: { AddFilter, FilterOn, EditFilter },
    props: ['filters','categories'],
    data () {
        return {
            doesntSub: true,
            selected:'',
            value:0,
            bus: new Vue(),
            allFilters: this.filters,
            allItems: false, 
            selectedItems: [],
            filter:'',
            deleted : false,
            cat:'',
            editedVar:false,
            el:[]
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
    methods :{
        filterAdded (item) { 
            location.reload()
            this.allFilters.push(item)
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
                    this.selectedItems = []
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