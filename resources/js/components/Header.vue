<template>
    <div>
        <nav class="d-flex justify-content-around align-items-center mt-2 navbar-light bg-light">
            <div class="d-flex">
                <img src="../../images/logo.png" alt="logo-Airbnb" width="70px">
                <form class="form-inline">
                    <input type="text" v-model="querySon" @keydown.enter.prevent="$emit('queryFunSon', querySon)">
                    <button @click.prevent="$emit('queryFunSon', querySon)" type="button"
                        class="btn btn-danger mx-3">cerca</button>
                </form>
            </div>
        </nav>
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
