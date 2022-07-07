<template>
    <div>
        <HomePage/>
        <div class="container">
            <ApartmentsComp/>
        </div>
    </div>
</template>

<script>
    
    import ApartmentsComp from './pages/ApartmentsComp.vue';
    import HomePage from './pages/HomePage.vue';
    
    export default {
        name: "App",
        components: {
            ApartmentsComp,
            HomePage
}
    }

</script>

<style scoped>

</style>
