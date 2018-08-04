<template>
    <div class="modal animated fadeInUp" id="newCategory" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form  @submit.prevent="addCategory"  class="modal-content" method="post" >
                    <div class="modal-header">
                        <h5 class="modal-title">Новая Категория</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> 
                        <div class="form-group">
                            <label class="form-label" for="manufacturer_name">Название категории (UZ)</label>
                            <input class="form-control" type="text" id="manufacturer_name" name="manufacturer_name" v-model="name">
                            <div v-if="errors.name">
                                <p style="color:red" v-text="errors.name[0]"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="manufacturer_name">Название категории (RU)</label>
                            <input class="form-control" type="text" id="manufacturer_name" name="manufacturer_name" v-model="name_ru">
                            <div v-if="errors.name_ru">
                                <p style="color:red" v-text="errors.name_ru[0]"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Закрыть</button>
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
            name: '',
            name_ru: '',
            logo: '',
            errors:''
        }
    },
    methods:{
        addCategory () { 
            axios.post('/api/categories', {name : this.name, name_ru: this.name_ru} )
                .then((response)=>{
                   this.$emit('added', response.data);
                        $('#newCategory').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                   flash('Производитель добавлен');

                }).catch((error)=>{
                    this.errors = error.response.data.errors
                })
        },   
    }
}
</script>
