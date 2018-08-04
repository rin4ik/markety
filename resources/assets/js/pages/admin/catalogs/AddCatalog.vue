<template>
  <div class="modal animated fadeInUp" id="newCatalog" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <form @submit.prevent="addCatalog" class="modal-content" method="post">
        <div class="modal-header">
          <h5 class="modal-title">Новый Каталог</h5>
          <button type="button" @click.prevent="close" class="close" data-dismiss="modal" aria-label="Close">
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
                <input class="form-control" type="text" id="catalog_full_name_ru" v-model="form.fullName_ru" name="fullName_ru">
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
                <input class="form-control" type="text" id="catalog_full_name_uz" v-model="form.fullName">
                <div v-if="errors.fullName">
                  <p style="color:red" v-text="errors.fullName[0]"></p>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label" for="name">Статус</label>
            <select class="form-control" v-model="form.status">
              <option disabled selected>Невыбранный!</option>

              <option v-for="visibility in ['active','inactive']">{{visibility}}</option>
            </select>
            <div v-if="errors.status">
              <p style="color:red" v-text="errors.status[0]"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label" for="name">Основной каталог</label>
            <select class="form-control selectpicker" data-live-search="true" title="Родительский Каталог..." v-model="form.parent_id">
              <option value="0" selected>Невыбранный!</option>
              
              <option v-for="catalog in catalogs" :value="catalog.id">{{catalog.name_ru}}</option>
            </select>
            

          </div>
          <div class="form-group">
            <label class="form-label" for="name">Категории</label>
        
              <select class="selectpicker form-control" v-model="form.category_id"    title="Выберите одну категорию..."  data-live-search="true">
              <option v-for="category in categories" :value="category.id">{{category.name}}</option>
            </select> 
          </div> 
        </div>
        <div class="modal-footer">
          <button type="button" @click.prevent="close" class="btn btn-light" data-dismiss="modal">Закрыть</button>
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
            form : {
                name: '',
                name_ru: '',
                fullName: '',
                fullName_ru: '',
                status:'active',
                parent_id: null,
                category_id: '',
                filter_id: ''
            },
            errors: ''
        }
    },
    
    props: ['all','categories', 'catalogs'],

    methods: {
        addCatalog () { 
          if(this.form.parent_id == 0){
            this.form.parent_id = ''
          }
            axios.post('/api/catalogs', this.form)
                .then(response =>{ 
                    if(this.form.parent_id){
                      
                      this.$emit('push', response.data, this.form.parent_id, this.form)
                        $('#newCatalog').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                      return
                    } 
                    
                    this.$emit('added', response.data)
                    flash("Каталог успешно добавлена!", "success"); 
                    this.form = {};
                    this.errors = '';
                    $('#newCatalog').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                }).catch( error => { 
                    this.errors = error.response.data.errors
                })
        },
        close () {
            this.errors = '';
            this.form = {}
        }
    }
}
</script>

<style lang="scss">
@import '~bootstrap-select/sass/bootstrap-select.scss';
</style>
