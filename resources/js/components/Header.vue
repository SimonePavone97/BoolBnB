<template>
    <div>
        <nav class="mt-2 navbar-light bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <img src="../../images/logo.png" alt="logo-Airbnb" width="150px">
                <div>
                    <form class="form-inline">
                        <input type="text" v-model="querySon" @keydown.enter.prevent="$emit('queryFunSon', querySon)">
                        <button @click.prevent="$emit('queryFunSon', querySon)" type="button"
                            class="btn btn-danger mx-3">cerca</button>
                    </form>
                </div>

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
