<template>
    <div>
        <span v-for="item in option.options">
            <p>
                <input type="radio" :value="item[0]"  v-model="radio"> {{item[1]}}                </p>
        </span>
    </div>
</template>
<script>
export default {
    props:['option'],
    data () {
        return {
            radio:''
        }
    },
    methods :{ 
    }
}
</script>
