<template>
    <div class="modal animated fadeInDown" id="editCategory" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form @submit.prevent="editCategory" class="modal-content" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Изменить Категорию</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> 
                        <div class="form-group">
                            <label class="form-label" for="category_name">Название категории(UZ)</label>
                            <input class="form-control" type="text" id="category_name" name="category_name" v-model='category.name'>
                            <div v-if="errors.name">
                                <p style="color:red" v-text="errors.name[0]"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="category_name">Название категории(RU)</label>
                            <input class="form-control" type="text" id="category_name" name="category_name" v-model='category.name_ru'>
                            <div v-if="errors.name_ru">
                                <p style="color:red" v-text="errors.name_ru[0]"></p>
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
    props : ['categories','cat'],

    data () {
        return {
            category: '', 
            logo: '',
            errors:''            
        }
    }, 

    methods: {
         editCategory () { 
            axios.patch(`/api/categories/${this.category.slug}`, {name : this.category.name, name_ru: this.category.name_ru })
                .then((response) => { 
                    this.category = response.data
                    $('#editCategory').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    this.$emit('edited',response.data);
                    flash('Производитель обновлен');
                }).catch((error)=> {
                    this.errors = error.response.data.errors 
                })
        } 
    },
    mounted () {
            this.category = this.cat
    }

}
</script>
<style>
.image{
    margin-left:10px
}
</style>

