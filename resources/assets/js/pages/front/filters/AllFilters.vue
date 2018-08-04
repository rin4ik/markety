<template>
<div>
    <h2>{{catalog.name}}</h2>
    <ul v-for="filter in filters" style="margin:20px">
        <li>
            <h4  style="margin-bottom:10px">{{filter.name}}</h4>  
            <checkbox v-if="filter.type == 'checkbox'" :option="filter"></checkbox> 
            <radiobox v-if="filter.type == 'radio'" :option="filter"></radiobox> 
            <inputcheck v-if="filter.type == 'input'" :option="filter"></inputcheck> 
        </li>
    </ul>
</div>
</template>
<script>
import Checkbox from './options/Checkbox'
import Radiobox from './options/Radiobox'
import Inputcheck from './options/Inputcheck'
export default {
    props:['catalog', 'filters'],
    components:{ Checkbox, Radiobox, Inputcheck }
}
</script>
