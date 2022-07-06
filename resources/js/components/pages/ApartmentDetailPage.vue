<template>
    <div>
        ciaooooooooooooooo
        <h2>{{ apartment.title }}</h2>
        <p>{{ apartment.service.name }}</p>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'ApartmentDetailPage',

    data() {
        return {
            apartment: [],
            isError: false,
        }
    },

    methods: {
        getApartment() {
            // il routing mi permette di usare $route che mi da determinate info (this.$route è parte di vue)
            axios.get(`http://127.0.0.1:8000/api/apartments/${this.$route.params.id}`)
                .then((res) => {
                    console.log("res.data");
                    this.apartment = res.data;
                }).catch((err) => {
                    console.log(err);
                    this.isError = true;
                });
        },
    },
    mounted() {
        this.getApartment();
        console.log("this.$route");
    },
}



</script>

<style scoped>
</style>
