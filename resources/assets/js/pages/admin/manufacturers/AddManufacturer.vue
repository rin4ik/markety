<template>
    <div class="modal animated fadeInUp" id="newManufacturer" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form  @submit.prevent="addManufacturer"  class="modal-content" method="post" >
                    <div class="modal-header">
                        <h5 class="modal-title">Новый производитель</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="manufacturer_name">Логотип производителя</label>
                            <div class="custom-file">
                                <label>
                                   <input type="file" v-on:change="onImageChange"  >
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="manufacturer_name">Название производителя</label>
                            <input class="form-control" type="text" id="manufacturer_name" name="manufacturer_name" v-model="name">
                            <div v-if="errors.name">
                                <p style="color:red" v-text="errors.name[0]"></p>
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
            logo: '',
            errors:''
        }
    },
    methods:{
        addManufacturer () { 
            axios.post('/api/manufacturers', {name : this.name, logo: this.logo} )
                .then((response)=>{
                   this.$emit('added', response.data);
                        $('#newManufacturer').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                   flash('Производитель добавлен');

                }).catch((error)=>{
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
