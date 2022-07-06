<template>
    <div class="">
        <div class="d-flex">
            <input type="text" v-model="searchText" @keydown.enter.prevent="$emit('queryFunSon', searchText)">
            <button @click.prevent="$emit('queryFunSon', searchText)" type="button" class="btn btn-danger mx-3">cerca</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Header',
    
    data() {
        return {
            searchText: ''
        }
    },
}
</script>

<style scoped lang="scss">

</style>