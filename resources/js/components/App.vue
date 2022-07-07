<template>
    <div>
        <HeaderComp/>
        <div class="container">
            <ApartmentsComp/>
        </div>
    </div>
</template>

<script>
    import HeaderComp from './pages/HeaderComp.vue';
    import ApartmentsComp from './pages/ApartmentsComp.vue';
    
    export default {
        name: "App",
        components: {
            HeaderComp,
            ApartmentsComp
        }
    }

</script>

<style scoped>

</style>
