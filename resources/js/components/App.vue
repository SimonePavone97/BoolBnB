<template>
    <div>
<<<<<<< HEAD
        <HomePage/>
        <div class="container">
            <ApartmentsComp/>
        </div>
=======
        <main>
            <div class="container">
                <router-view></router-view>
            </div>
        </main>
>>>>>>> a3d30ec979559a23091758eb66dc4011a9265d71
    </div>
</template>

<script>
<<<<<<< HEAD
    
    import ApartmentsComp from './pages/ApartmentsComp.vue';
    import HomePage from './pages/HomePage.vue';
    
    export default {
        name: "App",
        components: {
            ApartmentsComp,
            HomePage
}
=======
    import HomePage from './pages/HomePage.vue';

    export default {
        name: "App",
        components: {
            HomePage
        }
>>>>>>> a3d30ec979559a23091758eb66dc4011a9265d71
    }
</script>

<style scoped>
    
</style>
