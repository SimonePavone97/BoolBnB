<template>
    <div>


        <Header @queryFunSon="queryFunDad" />
        <!-- <Apartment v-for="(element, index) in saveArrayApartments" :key="index" :apartment="element" /> -->
        <!-- :apartment="element" props (vedi Apartment.vue) -->

        <!-- <div v-for="(element, index) in saveArrayApartments" :key="index">
            <p>{{ element.title }}</p>
        </div> -->
        <main>
            <Apartments />
        </main>
        

    </div>
</template>

<script>
    import Header from '../Header.vue';
    //import Apartment from '../subFolder/Apartment'
    import axios from 'axios';
    import Apartments from '../pages/Apartments.vue';

    export default {
        name: 'HomePage',

        components: {
            Header,
            Apartments
        },

        data() {
            return {
                saveArrayApartments: [],
            }
        },

        methods: {
            queryFunDad(query) {
                axios.get(`http://127.0.0.1:8000/api/apartments/${query}`).then((res) => {
                    console.log(res);
                    this.saveArrayApartments = res.data;
                    console.log(this.saveArrayApartments);
                })
            }
        },

    }

</script>

<style scoped>
</style>
