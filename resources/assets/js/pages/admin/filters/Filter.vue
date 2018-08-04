<template> 
      <tr :style="[filter.status == 'inactive' ? {'color':'#c73030' } : '']">
        <td>
          <input type="checkbox" :checked="checked ? 'checked' :''" :id="filter.id" @click="select">
        </td>
        <td>{{filter.id}}</td>
        <td>{{filter.name_ru}}</td>
        <td>{{filter.category.name}}</td>
        <td>{{filter.position}}</td>
        <td>{{filter.type}}</td>
        <td>{{filter.use}}</td>
        <td>{{filter.status}}</td>
      </tr>  
</ul> 
     

</template>
<script>
import EditFilter from './EditFilter'
export default {
    components:{EditFilter},
    props:['currentFilter', 'checked', 'deletedItem','filters', 'catalogs', 'edited'],
    data () {
        return {
            filter : this.currentFilter,
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
            if(!this.selected){
                this.$emit('selected', this.filter)
                this.selected = true 
                
            }
                
        }
    },  
    watch : {
        edited () { 
            this.selected = false
            this.deleted = false           
            return     
            }
        }
    } 
</script> 