<template>
    <div class="">
        <div class="d-flex">
            <input type="text" v-model="querySon" @keydown.enter.prevent="$emit('queryFunSon', querySon)">
            <button @click.prevent="$emit('queryFunSon', querySon)" type="button" class="btn btn-danger mx-3">cerca</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Header',
    
    data() {
        return {
            querySon: ''
        }
    },
}
</script>

<style scoped lang="scss">

</style>