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
    props : ['manufacturers','manufactur'],

    data () {
        return {
            manufacturer: '', 
            logo: '',
            errors:''            
        }
    },
    watch : {
        manufactur () {
            this.manufacturer = this.manufactur
        }
    },

    methods: {
         editManufacturer () { 
            axios.patch(`/admin/manufacturers/${this.manufacturer.id}`, {name : this.manufacturer.name, logo: this.logo })
                .then((response) => { 
                    this.manufacturer = response.data
                    $('#editManufacturer').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    this.$emit('edited');
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

