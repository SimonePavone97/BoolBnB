<template>
    <div>
        <nav class="navbar-dark bg-dark">
            <form class="form-inline d-flex justify-content-center" >
                <input class="" type="text" v-model="searchText" @keydown.enter.prevent="$emit('searchFunction', searchText)" placeholder="Cerca un appartamento">
                <button @click.prevent="$emit('searchFunction', searchText)" type="submit"
                    class="btn btn-danger">Cerca</button>
            </form>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'SearchComp',

    data() {
        return {
            searchText: "", 
        }
    },
}
</script>

<style scoped lang="scss">

</style>