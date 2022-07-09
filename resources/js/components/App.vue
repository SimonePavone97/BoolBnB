<template>
    <div>
        <div class="container-bnb">
            <router-view></router-view>
        </div>
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
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

li{
    list-style-type: none;
}

a{
    text-decoration: none;
}

.container-bnb{
    width: 85%;
    margin: 0 auto;
}

</style>
