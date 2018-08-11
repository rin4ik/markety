<template>
    <div>
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
            </aside>
            <aside class="form-row">
                <div class="col-auto input-group input-group-sm">
                    <input v-model="search" class="form-control" type="text" placeholder="Поиск">
                    <div class="input-group-append">
                        <button class="btn btn-light" type="button">OK</button>
                    </div>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#newManufacturer">Добавить</button>
                </div>
            </aside>
        </div>
        <div class="page-body">
            <table v-if="filteredList.length > 0" id="myTable" class="table table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th class="col-auto">
                            <input type="checkbox"  @click="selectAll">
                        </th>
                        <th class="col-auto">ID</th>
                        <th class="col-auto">Логотип</th>
                        <th class="col-12">Название производителя</th>
                    </tr>
                </thead>
                <tbody>
                    <Manufacturer :edited="editedVar" @render="render" :deletedItem="deleted" @selected="markSelected" @unselected="unselect" :checked="allItems" v-for="(manufacturer,index) in filteredList" :key="index" :manufacturer="manufacturer" /> 
                    
                </tbody>
                 
                 
            </table>

            <h4 style="margin-left:20px" v-else>Нет доступных производителей</h4> 
        </div>

        <AddManufacturer :categories="categories" @added="add" />
        <EditManufacturer v-if="manufacturer" :categories="categories" @edited="edited" :manufactur="manufacturer" :manufacturers="all" />

    </div>
</template>
<script>
import AddManufacturer from './AddManufacturer'
import EditManufacturer from './EditManufacturer'
import Manufacturer from './Manufacturer'
export default {
    props:['manufacturers', 'categories'],
    data () {
        return {
            all: this.manufacturers, 
            allItems: false,
            value:0,
            selectedItems: [],
            manufacturer:'',
            deleted : false,
            editedVar:false,
            search:''
        }
    },
    components:{ Manufacturer, AddManufacturer, EditManufacturer },
    watch:{
        deleted () {
            this.deleted = true
        }
    }, 
    computed : {
        filteredList() {
            return this.all.filter(manufacturer => {
                return manufacturer.name.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    }, 
    methods: {
        add(data){
            this.all.push(data)
        },
        edited (item) {  
            this.editedVar = true
            this.filteredList.map((value, key)=>{
                if(item.id == value.id){
                    this.filteredList[key] = item
                    this.manufacturer = item
                }
            })

        }, 
        selectAll() {
            if(this.allItems){
            this.selectedItems = []
            return this.allItems = !this.allItems
            }
            this.selectedItems = this.all
            return this.allItems = !this.allItems
        }, 
        change() {
            if(this.allItems){
                if(this.value == 2){
                    axios.delete('/api/remove/manufacturers')
                    .then((response)=>{
                        this.all=''
                        flash('Удалены все производители!', 'danger')
                        return
                    })
                }
            }
            if(this.selectedItems.length >= 1){
                if(this.value == 1 && this.selectedItems.length > 1) {
                    flash('Пожалуйста выберите только одного производителя!','danger')

                    return
                }else if(this.value == 1 && this.selectedItems.length == 1){
                   return $('#editManufacturer').modal('show');            
                }
                if(this.value == 2) { 
                    self = this
                    this.selectedItems.map((item, key) => {  
                        this.all.map((man, index) =>{
                            if(man.id == item.id){
                                    self.all.splice(index,1)
                                
                                axios.delete('/api/manufacturers/' + item.id).then(()=>
                                {
                                    flash('Производитель удален!', 'danger')
                                })
                                this.deleted = true
                            }
                        })
                         return this.selectedItems = [] 
                });
                                        
                } 
                return
            } 

            if(this.selectedItems.length == 0){
                flash('Пожалуйста выберите хотябы одного производителя','danger')
            }
        },
        markSelected (manufacturer) { 
            self = this    
            this.deleted = false        
            this.selectedItems.map((value, key) => {
                if(value.id == manufacturer.id){ 
                    self.selectedItems.splice(0,1) 
                }
                return
            }) 
            this.manufacturer = manufacturer
            this.selectedItems.push(manufacturer);
        },
        unselect (manufacturer) {
          self = this            
            this.selectedItems.map((value, key) => {
                if(value.id == manufacturer.id){ 
                    self.selectedItems.splice(key,1)  
                    if(self.selectedItems.length < 1)
                    {
                        this.manufacturer = ''
                    }else if (self.selectedItems.length == 1)
                    {
                        self.selectedItems.map((value,key)=>{

                            this.manufacturer = value                        
                        })
                    }
                } 
                return
            }) 

        }, 
    }, 

}
</script>
<style lang="scss">
    @import '~bootstrap-select/sass/bootstrap-select.scss';
</style>