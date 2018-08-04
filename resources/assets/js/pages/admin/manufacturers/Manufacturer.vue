<template>  
        <tr>
            <td>
                <input type="checkbox" :checked="checked ? 'checked' :''" id="manufacturer.id" @click="select">
            </td>
            <td>{{manufacturer.id}}</td>
            <td><img class="image" :src="manufacturer.image"></td>
            <td>{{manufacturer.name}}</td>
        </tr> 
</template>
<script>
import EditManufacturer from './EditManufacturer'
export default {
    data () {
        return {
            selected: false, 
            deleted: this.deletedItem
        }
    },
    props:['manufacturer', 'checked','state','deletedItem','edited'],

    methods:{
        select () { 
          
            if(this.selected){ 
                this.$emit('unselected', this.manufacturer) 
                this.selected = false  
                return
            }
            if(!this.selected){
                this.$emit('selected', this.manufacturer)
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

