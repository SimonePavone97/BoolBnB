<template>
    <div>
        <nav class="d-flex align-items-center mt-2 navbar-light bg-light">
            <form class="form-inline d-flex align-items-center" >
                <input type="text" v-model="searchText" @keydown.enter.prevent="$emit('searchFunction', searchText)" placeholder="Cerca un appartamento">
                <button @click.prevent="$emit('searchFunction', searchText)" type="submit"
                    class="btn btn-danger mx-3">Cerca</button>
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