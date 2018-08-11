<template>
    <div class="modal animated fadeInDown" id="editManufacturer" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form @submit.prevent="editManufacturer" class="modal-content" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Новый производител</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="manufacturer_name">Логотип производителя</label><img class="image" :src="manufacturer.image">
                            <div class="custom-file">
                                <label>
                                   <input type="file" v-on:change="onImageChange"  >
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="manufacturer_name">Название производителя</label>
                            <input class="form-control" type="text" id="manufacturer_name" name="manufacturer_name" v-model='manufacturer.name'>
                            <div v-if="errors.name">
                                <p style="color:red" v-text="errors.name[0]"></p>
                            </div>
                        </div>
                        <div class="form-group" > 
                            <label class="form-label" for="category">Категории</label>
                            <select class="selectpicker show-tick form-control" v-model="categoryIds" title="Выберите опции"  multiple  data-style="btn-light">
                                <option v-for="category in categories" :value="category.id">{{category.name_ru}}</option>
                            </select>  
                            <div v-if="errors.name">
                                <p style="color:red" v-text="errors.categories[0]"></p>
                            </div>
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
    props : ['manufacturers','manufactur', 'categories'],

    data () {
        return {
            manufacturer: '', 
            logo: '',
            errors:'',
            categoryIds:[]
        }
    },
    watch : {
        manufactur () {
            this.manufacturer = this.manufactur   

        }
    }, 
    mounted () {
            this.manufacturer = this.manufactur   
        
        this.categoryIds = this.manufactur.categoryIds
        $('.selectpicker').selectpicker('refresh');
        $('.selectpicker').selectpicker('render');
    },
    methods: {
         editManufacturer () { 
            axios.patch(`/api/manufacturers/${this.manufacturer.id}`, {name : this.manufacturer.name, logo: this.logo, categoryIds: this.categoryIds })
                .then((response) => { 
                    this.manufacturer = response.data
                    $('#editManufacturer').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    this.$emit('edited', response.data);
                    flash('Производитель обновлен');
                }).catch((error)=> {
                    this.errors = error.response.data.errors 
                })
        },
         onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.logo = e.target.result;
                };
                reader.readAsDataURL(file);
            }, 
    }

}
</script>
<style>
.image{
    margin-left:10px
}
</style>

