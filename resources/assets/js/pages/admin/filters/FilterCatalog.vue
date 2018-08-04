<template> 
        <div class="col-auto" style="margin-top:10px; margin-bottom:10px">
            <select class="custom-select custom-select-sm" @click="handle" v-model="selected">
                <option value="0" disabled>Категории</option> 
                <option v-for="catalog in allCatalogs" :value="catalog.id">{{catalog.name_ru}}</option>  
            </select>
            <FilterCatalog :bus="bus" v-if="value && value.child_catalogs.length > 0" :catalogs="value.child_catalogs"></FilterCatalog>
            
        </div> 
</template>
<script>  
export default { 
    data () {
        return {
            selected: 0,
            allCatalogs : this.catalogs,
            value:'',
            vueBus: this.bus
        }
    },
    props:['catalogs','bus'],
    methods : {
        handle () {
            this.allCatalogs.map((item, key)=>{ 
               if(item.id == this.selected) { 
                   this.vueBus.$emit('value', item); 
                    this.value = item              
                }
            })
        }
    } 

}
</script>
