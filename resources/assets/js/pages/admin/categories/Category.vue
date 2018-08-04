<template>  
        <tr>
            <td>
                <input type="checkbox" :checked="checked ? 'checked' :''" :id="category.id" @click="select">
            </td>
            <td>{{category.id}}</td> 
            <td>{{category.name}}</td>
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
            if(!this.selected){
                this.$emit('selected', this.category)
                this.selected = true 
            }
                
        }
    },
    watch: {
        deletedItem () {  
            this.selected = false 
            this.deletedItem =false
            return          
        },
        edited () {
            this.selected = false 
            this.deletedItem =false
            return  
        }

    },
}
</script>
<style> 
</style>

