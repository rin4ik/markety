<template>
  <div>
    <li class="dd-item" style="margin-left:20px">
      <div class="dd-content">
        <div>
          <button class="btn btn-sm" type="button" @click="toggleVisible(index)" v-if="self.child_categories.length">{{isOpen ? '-' : '+'}}</button>
         <span :style="[self.status == 'inactive' ? {'color':'#c73030' } : '']"> <b>{{self.id}}</b> {{self.name_ru}}</span>
        </div>
        <div>
          <button class="btn btn-sm" type="button" data-toggle="modal" :data-target="`#editCategory${self.id}`">Правка</button>
          <button class="btn btn-sm" @click.prevent="deleteCategory(self.id)" :disabled="self.child_categories.length > 0">Удалить</button>
        </div>
      </div>
      <Category v-show="activeItemIndex == index" v-for="(sub,indexOf) in self.child_categories" :all="all" :categories="categories" :category="sub" :key="indexOf" :index="indexOf" />
    </li>

    <div class="modal animated fadeInUp" :id="`editCategory${self.id}`" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <form @submit.prevent="changeCategory" class="modal-content" method="post">
          <div class="modal-header">
            <h5 class="modal-title">Изменить категорию</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <p aria-hidden="true">&times;</p>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label class="form-label" for="name">Наименование (RU)</label>
                  <input class="form-control" type="text" id="category_name_ru" v-model="form.name_ru" name="name_ru">
                  <div v-if="errors.name_ru">
                    <p style="color:red" v-text="errors.name_ru[0]"></p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label" for="name">Полное наименование (RU)</label>
                  <input class="form-control" type="text" id="category_full_name_ru" v-model="form.fullname_ru" name="fullname_ru">
                  <div v-if="errors.fullName_ru">
                    <p style="color:red" v-text="errors.fullName_ru[0]"></p>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label class="form-label" for="name">Наименование (UZ)</label>
                  <input class="form-control" type="text" id="category_name_uz" v-model="form.name">
                  <div v-if="errors.name">
                    <p style="color:red" v-text="errors.name[0]"></p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label" for="name">Полное наименование (UZ)</label>
                  <input class="form-control" type="text" id="category_full_name_uz" v-model="form.fullname">
                   <div v-if="errors.fullName">
                    <p style="color:red" v-text="errors.fullName[0]"></p>
                  </div>
                </div>
              </div>
              
            </div>
            <div>
            <label class="form-label" for="name">Статус</label>
            <select class="form-control" v-model="form.status"> 
              <option value="0" disabled selected>Невыбранный!</option>
              
              <option v-for="visibility in ['active','inactive']">{{visibility}}</option>             
            </select>
             <div v-if="errors.status">
                    <p style="color:red" v-text="errors.status[0]"></p>
                </div>
          </div>
            <div>
              <label class="form-label" for="name"> Основная категория</label>
              <select class="form-control" v-model="form.parent_id">
                <option disabled selected>Невыбранный!</option>
                <option v-for="category in all" :value="category.id">{{category.name_ru}}</option>
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
  </div>
</template>
<script> 
export default { 
    props:['categories','category', 'all', 'index'],
    data() {
        return {
            activeItemIndex: null,
            self: this.category,
            form : {
                name: this.category.name,
                name_ru: this.category.name_ru,
                fullname: this.category.fullName,
                fullname_ru: this.category.fullName_ru,
                parent_id: this.category.parent_id,
                status: this.category.status
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
        changeCategory() {
            axios.patch(`/admin/categories/${this.self.id}`, this.form)
                .then(response =>{
                  this.self = response.data
                    $(`#editCategory${this.self.id}`).modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    flash("Категория успешно Обновлена!", "success");  
                    this.errors = '';
                }).catch( error => {
                    this.errors = error.response.data.errors
                })
        },
    deleteCategory(id) {
      if (!confirm("Are you sure you want to delete this comment?")) {
        return;
      }
      axios.delete("/admin/categories/" + this.self.id)
        .then(() => {
          location.reload();
          flash("Категория успешно удалена", 'danger');
          
        });
    },
    }
}
</script>
