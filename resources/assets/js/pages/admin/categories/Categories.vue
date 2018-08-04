<template> 
    <div>
        <div class="toolbar d-flex justify-content-between">
            <aside class="form-row">
                <div class="col-auto input-group input-group-sm">
                    <select class="custom-select" v-model="value">
                        <option value="0" disabled selected>Действие</option>
                        <option value="1">Редактировать</option>
                        <option value="2">Удалить</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-dark" @click="change" type="button">OK</button>
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
                    <button class="btn btn-sm btn-blue" type="button" data-toggle="modal" data-target="#newCategory">Добавить</button>
                </div>
            </aside>
        </div>
        <div class="page-body">
            <table  v-if="all.length > 0" id="myTable" class="table table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th class="col-auto">
                            <input type="checkbox"  @click="selectAll">
                        </th>
                        <th class="col-auto">ID</th> 
                        <th class="col-12">Название Категории</th>
                    </tr>
                </thead>
                <tbody>
                    <Category :edited="editedVar" @render="render" :deletedItem="deleted" @selected="markSelected" @unselected="unselect" :checked="allItems" v-for="(category,index) in all" :key="index" :category="category" /> 
                </tbody>
                 
                 
            </table>
                   <h4 style="margin-left:20px" v-else>Нет доступных категорий</h4>
            
        </div>

        <AddCategory @added="add" />
        <EditCategory v-if="category" @edited="edited" :cat="category" :categories="all" />

    </div>  

</template>
<script>
import AddCategory from './AddCategory'
import EditCategory from './EditCategory'
import Category from './Category'
export default {
    props:['categories'],
    data () {
        return {
            all: this.categories, 
            allItems: false,
            value:0,
            selectedItems: [],
            category:'',
            deleted : false,
            editedVar:false
        }
    },
    components:{ Category, AddCategory, EditCategory },
    watch:{
        deleted () {
            this.deleted = true
        }
    },  
    methods: {
        add(data){
            this.all.push(data)
        },
        edited () { 
            this.selectedItems = [],
            this.editedVar = true
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
                    axios.delete('/api/remove/categories')
                    .then((response)=>{
                        this.all=[]
                        this.selectedItems=[]
                        this.checked = false
                        flash('Удалены все категории!', 'danger')
                        return
                    })
                }
            }
            if(this.selectedItems.length >= 1){
                if(this.value == 1 && this.selectedItems.length > 1) {
                    flash('Пожалуйста выберите только одного производителя!','danger')

                    return
                }else if(this.value == 1 && this.selectedItems.length == 1){
                   return $('#editCategory').modal('show');            
                }
                if(this.value == 2) { 
                    self = this
                    this.selectedItems.map((item, key) => {  
                        this.all.map((man, index) =>{
                            if(man.id == item.id){
                                    self.all.splice(index,1)
                                
                                axios.delete('/api/categories/' + item.slug).then(()=>
                                {
                                    flash('Владелец удален!', 'danger')
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
                flash('Пожалуйста выберите хотябы одну категорию','danger')
            }
        },
        markSelected (category) { 
            self = this    
            this.deleted = false        
            this.selectedItems.map((value, key) => {
                if(value.id == category.id){ 
                    self.selectedItems.splice(0,1) 
                }
                return
            }) 
            this.category = category
            this.selectedItems.push(category);
        },
        unselect (category) {
          self = this            
            this.selectedItems.map((value, key) => {
                if(value.id == category.id){ 
                    self.selectedItems.splice(key,1)  
                    if(self.selectedItems.length < 1)
                    {
                        this.category = ''
                    }else if (self.selectedItems.length == 1)
                    {
                        self.selectedItems.map((value,key)=>{

                            this.category = value                        
                        })
                    }
                } 
                return
            }) 

        }, 
    }, 

}
</script>

