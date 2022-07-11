<template>
    <div>
        <!-- <SearchComp class="sticky-top" /> -->

        <img :src="(`${apartment.image}`)" alt="img-apartment" class="w-100 rounded">

        <div class="row justify-content-between mt-4">
            <div class="col-6">

                <h2>{{ apartment.title }}</h2>

                <span>{{ apartment.address }}</span>

                <h3>{{ apartment.description }}</h3>

                <div>
                    <!-- <span>{{ apartment.rooms }} camere - {{ apartment.beds }} letti - {{ apartment.bathrooms }} bagni - {{ apartment.mq }} mq</span> -->

                    <span v-if="`${apartment.rooms}` == 1">{{ apartment.rooms }} camera - </span>
                    <span v-else>{{ apartment.rooms }} camere - </span>

                    <span v-if="`${apartment.beds}` == 1">{{ apartment.beds }} letto - </span>
                    <span v-else>{{ apartment.beds }} letti - </span>

                    <span v-if="`${apartment.bathrooms}` == 1">{{ apartment.bathrooms }} bagno - </span>
                    <span v-else>{{ apartment.bathrooms }} bagni</span>

                    <span>{{ apartment.mq }} mq</span>

                </div>

                <hr>

                <h3>Servizi</h3>
                <ul>
                    <li v-for="(element, index) in apartment.services" :key="element.id">{{ element.name }}</li>
                </ul>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia repellat eum sint earum aut itaque
                    ratione pariatur harum temporibus delectus, cumque rem commodi nemo numquam omnis doloribus minus
                    dolore expedita! Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi distinctio
                    voluptates doloremque illum, consectetur nobis inventore, nostrum porro nisi laudantium unde
                    eligendi explicabo voluptas sint debitis provident nemo ea ipsam?Lorem ipsum dolor sit amet
                    consectetur, adipisicing elit. Iusto cupiditate vitae ad in officiis, hic optio fugiat molestiae,
                    unde esse velit quam vero ipsum, nesciunt deleniti? Consectetur voluptas commodi molestiae!log Lorem
                    ipsum dolor sit amet consectetur adipisicing elit. Ullam recusandae, dolore hic quo voluptas, sit
                    quod totam maxime animi provident vero rem porro libero consectetur cumque dolores consequatur
                    quidem facilis.
                    
                </p>
            </div>

            <div class="col-5">
                <div class="prova_riquadro_prenota rounded mt-1"></div>
            </div>
        </div>

    </div>
</template>

<script>
    // import SearchComp from './partials/SearchComp'
    import axios from 'axios';

    export default {
        name: 'ApartmentDetailPage',

        components: {
            // SearchComp
        },

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
                        console.log(res.data);
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
    .prova_riquadro_prenota {
        height: 500px;
        width: 100%;
        background-color: red;
        position: sticky;
        top: 50px;
    }

</style>
