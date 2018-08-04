<template>
<div>
    <div class="toolbar d-flex justify-content-between">
  <aside class="form-row">
    <div class="col-auto input-group input-group-sm">
      <select v-model="value" class="custom-select">
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
      <button class="btn btn-sm btn-blue" type="button" data-toggle="modal" data-target="#newProduct">Добавить</button>
    </div>
  </aside>
</div>
<div class="page-body">
  <table class="table table-striped table-hover table-sm">
    <thead>
      <tr>
        <th class="col-auto">
          <input type="checkbox" @click="selectAll">
        </th>
        <th class="col-auto">ID</th>
        <th class="col-4">Категория</th>
        <th class="col-4">Производитель</th>
        <th class="col-4">Статус</th>
      </tr>
    </thead>
    <tbody>
      <Product v-for="(product,index) in allProducts" :deletedItem="deleted" @selected="markSelected" @unselected="unselect" :checked="allItems" :key="index" :product="product" />
    </tbody>
  </table>
</div>
    <EditProduct v-if="product" @edited="edited" :pro="product" :products="allProducts" :filters="filters" :categories="categories" :manufacturers="manufacturers" />  
  
  <AddProduct @added="add" :filters="filters" :categories="categories" :manufacturers="manufacturers" />

</div>

</template>
<script>
import Product from './Product'
import AddProduct from './AddProduct'
import EditProduct from './EditProduct'
export default {
  components:{Product, AddProduct, EditProduct},
  props:['products', 'manufacturers','filters', 'categories'],
  data(){
    return {
      allProducts: this.products, 
      allItems: false,
      value:0,
      selectedItems: [],
      product:'',
      deleted : false,
      editedVar:false
    }
  },
  methods:{
    add(data){
      this.allProducts.push(data)
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
                    axios.delete('/api/remove/products')
                    .then((response)=>{
                        this.allProducts=[]
                        this.selectedItems=[]
                        this.checked = false
                        flash('Удалены все товары!', 'danger')
                        return
                    })
                }
            }
            if(this.selectedItems.length >= 1){
                if(this.value == 1 && this.selectedItems.length > 1) {
                    flash('Пожалуйста выберите только один товар!','danger')

                    return
                }else if(this.value == 1 && this.selectedItems.length == 1){
           
                   return $('#editProduct').modal('show');            
                }
                if(this.value == 2) { 
                    self = this
                    this.selectedItems.map((item, key) => {  
                        this.allProducts.map((man, index) =>{
                            if(man.id == item.id){
                                    self.allProducts.splice(index,1)
                                
                                axios.delete('/api/products/' + item.id).then(()=>
                                {
                                    flash('Товар удален!', 'danger')
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
                flash('Пожалуйста выберите хотябы один товар','danger')
            }
        },
        markSelected (product) { 
            self = this     
            this.deleted = false        
            this.selectedItems.map((value, key) => {
                if(value.id == product.id){ 
                    self.selectedItems.splice(0,1) 
                }
                return
            }) 
            this.product = product
            this.selectedItems.push(product);
        },
        unselect (product) {
          self = this            
            this.selectedItems.map((value, key) => {
                if(value.id == product.id){ 
                    self.selectedItems.splice(key,1)  
                    if(self.selectedItems.length < 1)
                    {
                        this.product = ''
                    }else if (self.selectedItems.length == 1)
                    {
                        self.selectedItems.map((value,key)=>{

                            this.product = value                        
                        })
                    }
                } 
                return
            }) 

        }, 
  }
}
</script>
