<template>
    <tr v-if="product">
        <td>
          <input type="checkbox" :checked="checked ? 'checked' :''" :id="product.id" @click="select">
        </td>
        <td>{{product.id}}</td>
        <td>{{product.category.name}}</td>
        <td>{{product.manufacturer.name}}</td>
        <td>active</td>
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
     props:['product', 'checked','state','deletedItem','edited'],
    methods:{
        select () { 
          
            if(this.selected){ 
                this.$emit('unselected', this.product) 
                this.selected = false  
                return
            }
            if(!this.selected){
                this.$emit('selected', this.product)
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