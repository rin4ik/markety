<template>
    <div class="modal animated fadeInDown" id="editProduct" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form @submit.prevent="editProduct" class="modal-content" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Изменение карточка товара</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group"> 
                            <label class="form-label" for="name">Категория</label>
                            <select class="form-control" v-model="product.category_id">
                                <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                            </select> 
                            <div v-if="errors.category_id">
                                <p style="color:red" v-text="errors.category_id[0]"></p>
                            </div>
                    </div>
                    <div class="form-group"> 
                            <label class="form-label" for="name">Производитель</label>

                            <select class="form-control" v-model="product.manufacturer_id">
                                <option v-for="manufacturer in manufacturers" :value="manufacturer.id">{{manufacturer.name}}</option>
                            </select> 
                            <div v-if="errors.manufacturer_id">
                                <p style="color:red" v-text="errors.manufacturer_id[0]"></p>
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Характеристика</label>
                        <div class="form-row" v-for="filter in filters">
                            <label class="col col-form-label" for="filter">{{filter.name}}</label>
                            <div class="col form-group">
                                <select class="custom-select">
                                    <option value="0" disabled selected>не выбран</option>
                                    <option value="1">filter_list_name</option>
                                    <option value="2">filter_list_name</option>
                                </select>
                            </div>
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
    props : ['products','pro', 'filters', 'categories', 'manufacturers'],

    data () {
        return {
            product: '', 
            errors:''            
        }
    },
   

    methods: {
         editProduct () { 
            axios.patch(`/api/products/${this.product.id}`, this.product )
                .then((response) => { 
                    console.log(response.data)
                    this.product = response.data
                    $('#editProduct').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    this.$emit('edited');
                    flash('Производитель обновлен');
                }).catch((error)=> {
                    this.errors = error.response.data.errors 
                })
        }, 
    },
     mounted() {
        this.product = this.pro  
    },

}
</script>
<style>
.image{
    margin-left:10px
}
</style> 