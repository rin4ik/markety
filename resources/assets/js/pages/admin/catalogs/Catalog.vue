<template> 
    <li v-if="catalog" class="dd-item" style="margin-left:20px">
      <div class="dd-content">
        <div>
          <button class="btn btn-sm" type="button" @click="toggleVisible(index)" v-if="self.children.length">{{isOpen ? '-' : '+'}}</button>
         <span :style="[self.status == 'inactive' ? {'color':'#c73030' } : '']"> <b>{{self.id}}</b> {{self.name_ru}}</span>
        </div>
        <div>           
          <button class="btn btn-sm btn-light" type="button" data-toggle="modal" :data-target="`#editCatalog${self.id}`">Правка</button>
          <button class="btn btn-sm btn-danger" @click.prevent="deleteCatalog(self.id)" :disabled="self.children.length > 0">Удалить</button>
        </div>
      </div>
      <Catalog :all="all" :categories="categories" v-show="activeItemIndex == index" v-for="(sub,indexOf) in self.children" :catalogs="catalogs" :catalog="sub" :key="indexOf" :index="indexOf" />
          <div class="modal animated fadeInUp" :id="`editCatalog${self.id}`" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <form @submit.prevent="changeCatalog" class="modal-content" method="post">
          <div class="modal-header">
            <h5 class="modal-title">Изменить каталог</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <p aria-hidden="true">&times;</p>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label class="form-label" for="name">Наименование (RU)</label>
                  <input class="form-control" type="text" id="catalog_name_ru" v-model="form.name_ru" name="name_ru">
                  <div v-if="errors.name_ru">
                    <p style="color:red" v-text="errors.name_ru[0]"></p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label" for="name">Полное наименование (RU)</label>
                  <input class="form-control" type="text" id="catalog_full_name_ru" v-model="form.fullname_ru" name="fullname_ru">
                  <div v-if="errors.fullName_ru">
                    <p style="color:red" v-text="errors.fullName_ru[0]"></p>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label class="form-label" for="name">Наименование (UZ)</label>
                  <input class="form-control" type="text" id="catalog_name_uz" v-model="form.name">
                  <div v-if="errors.name">
                    <p style="color:red" v-text="errors.name[0]"></p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label" for="name">Полное наименование (UZ)</label>
                  <input class="form-control" type="text" id="catalog_full_name_uz" v-model="form.fullname">
                   <div v-if="errors.fullName">
                    <p style="color:red" v-text="errors.fullName[0]"></p>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="form-group">
            <label class="form-label" for="name">Статус</label>
            <select class="form-control" v-model="form.status"> 
              <option value="0" disabled selected>Невыбранный!</option>
              
              <option v-for="visibility in ['active','inactive']">{{visibility}}</option>             
            </select>
             <div v-if="errors.status">
                    <p style="color:red" v-text="errors.status[0]"></p>
                </div>
          </div>
            <div class="form-group">  
              <label class="form-label" for="name"> Основной каталог</label>
              <select class="selectpicker form-control" v-model="form.parent_id">
                <option value="0" selected>Невыбранный</option>
                <option v-for="catalog in all" :value="catalog.id">{{catalog.name_ru}}</option>
              </select>
            </div> 
            <div class="form-group">
            <label class="form-label" for="name">Категории</label>
        
              <select class="form-control" v-model="form.category_id"   data-live-search="true">
              <option v-for="category in categories" :value="category.id">{{category.name}}</option>
            </select> 
          </div>
          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Закрыть</button>
            <button type="sumbit" class="btn btn-blue">Изменить</button>
          </div>
        </form>
      </div>
    </div>
    </li>

 
</template>
<script> 
export default { 
    props:['catalogs', 'categories', 'catalog', 'all', 'index'],
    data() {
        return {
            activeItemIndex: null,
            self: this.catalog,
            form : {
              name: this.catalog.name,
              name_ru: this.catalog.name_ru,
              fullname: this.catalog.fullName,
              fullname_ru: this.catalog.fullName_ru,
              parent_id: this.catalog.parent_id,
              status: this.catalog.status,             
              category_id: this.catalog.category_id,
            },
            errors: '',
            isOpen:false
        }
    },
    methods: {
        toggleVisible(key){ 
            if(this.activeItemIndex == key) {
               this.isOpen = !this.isOpen
               return this.activeItemIndex = null
            }
            this.isOpen = !this.isOpen;
            return this.activeItemIndex = key
        },
        changeCatalog() { 
            axios.patch(`/api/catalogs/${this.self.id}`, this.form)
              .then(response =>{ 
                if(this.form.parent_id){
                  location.reload()
                }
                this.self = response.data
                this.self.children = response.data.descendants
                  $(`#editCatalog${this.self.id}`).modal('hide');
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();
                  flash("Каталог успешно Обновлена!", "success");  
                  this.errors = '';
              }).catch( error => {
                  this.errors = error.response.data.errors
              })
        },
    deleteCatalog(id) {
      if (!confirm("Are you sure you want to delete this comment?")) {
        return;
      }
      axios.delete("/api/catalogs/" + this.self.id)
        .then(() => {
          location.reload();
          flash("Каталог успешно удалена", 'danger');
          
        });
    },
    }
}
</script>
