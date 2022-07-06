<template>
    <div>
        <Header 
        @queryFunSon="queryFunDad"/>
        <Apartment v-for="(element, index) in saveArrayApartments" :key="index" :apartment="element"/>
        <!-- :apartment="element" props (vedi Apartment.vue) -->
        <!-- <p>{{ saveArrayApartments.title }}</p> -->
    </div>
</template>

<script>
import Header from '../../components/Header'
import Apartment from '../subFolder/Apartment'
import axios from 'axios'

export default {
    name: 'HomePage',

    components: {
        Header,
        Apartment
    },

    data: {
        saveArrayApartments: [],
    },

    methods: {
        queryFunDad(query) {
            axios.get(`http://127.0.0.1:8000/api/apartments/${query}`).then((res) => {
                console.log(res);
                this.saveArrayApartments = res.data;
            })
        },
    },

}

</script>

<style scoped>
</style>
