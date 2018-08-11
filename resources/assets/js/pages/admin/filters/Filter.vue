<template> 
      <tr v-if="filter" :style="[filter.status == 'inactive' ? {'color':'#c73030' } : '']">
        <td>
          <input type="checkbox" :checked="checked || selected ? 'checked' :''" :id="filter.id" @click="select">
        </td>
        <td>{{filter.id}}</td>
        <td>{{filter.name_ru}}</td>
        <td>{{filter.category ? filter.category.name_ru: ''}}</td>
        <td>{{filter.position}}</td>
        <td>{{filter.type}}</td>
        <td>{{filter.use}}</td>
        <td>{{filter.status}}</td>
      </tr>   
</template>
<script>
import EditFilter from './EditFilter'
export default {
    components:{EditFilter},
    props:['filter', 'checked', 'deletedItem','filters', 'edited'],
    data () {
        return { 
            selected: false, 
            deleted: this.deletedItem
        }
    },
    methods:{
        select () { 
            if(this.selected){ 
                this.$emit('unselected', this.filter) 
                this.selected = false  
                
                return
            } 
                this.$emit('selected', this.filter)
                this.selected = true  
                
        }
    }, 
    watch : {
        edited () {  
            this.deleted = false           
            return     
            },
        }, 
    } 
</script> 