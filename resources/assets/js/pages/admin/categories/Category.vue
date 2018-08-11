<template>  
        <tr>
            <td>
                <input type="checkbox" :checked="checked|| selected   ? 'checked' :''" :id="category.id" @click="select">
            </td>
            <td>{{category.id}}</td> 
            <td>{{category.name_ru}}</td>
        </tr> 
</template>
<script> 
export default {
    data () {
        return {
            selected: false, 
            deleted: this.deletedItem
        }
    },
    props:['category', 'checked','state','deletedItem','edited'],

    methods:{
        select () { 
            if(this.selected){ 
                this.$emit('unselected', this.category) 
                this.selected = false  
                return
            } 
                this.$emit('selected', this.category)
                this.selected = true 
        }
    },
    watch: {
        deletedItem () {  
            this.selected = false 
            this.deletedItem =true
            return          
        },
        edited () { 
            this.deletedItem =false
            return  
        }

    },
}
</script>
<style> 
</style>

