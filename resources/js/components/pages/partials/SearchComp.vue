<template>
    <div>
        <nav class="d-flex justify-content-around align-items-center mt-2 navbar-light bg-light">
            <div class="d-flex">
                <div class="mx-3">
                  <img src="../../../../images/logo.png" alt="logo-Airbnb" width="70px">
                </div>
                <form class="form-inline">
                    <input type="text" v-model="searchText" @keydown.enter.prevent="$emit('searchFunction', searchText)" placeholder="Cerca un appartamento">
                    <button @click.prevent="$emit('searchFunction', searchText)" type="submit"
                        class="btn btn-danger mx-3">Cerca</button>
                </form>
            </div>
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