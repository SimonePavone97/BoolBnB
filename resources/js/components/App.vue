<template>
    <div>
        <main>
            <div class="container">
            <HomePage/>
            <router-view></router-view>
            </div>
        </main>
    </div>
</template>

<script>
import HomePage from './pages/HomePage.vue';

export default {
    name: "App",
    components: {
        HomePage
    }
}
</script>

<style scoped>
    
</style>
