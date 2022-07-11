<template>
    <div>

        <router-view></router-view>

    </div>
</template>

<script>
    export default {
        name: "App",
        components: {

        }
    }

</script>

<style lang="scss">
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    li {
        list-style-type: none;
    }

    a {
        text-decoration: none;
    }

</style>
