<template>
    <div>
        <span v-for="item in option.options">
            <p>
                <input type="checkbox" :value="item[0]"> {{item[1]}}                
            </p>
        </span>
    </div>
</template>
<script>
export default {
    props:['option'],
    methods :{ 
    }
}
</script>
