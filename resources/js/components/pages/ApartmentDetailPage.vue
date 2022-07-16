<template>
    <div>
        <!-- <SearchComp class="sticky-top" /> -->
        <div class="details-container d-flex flex-wrap my-4">

            <div class="col-12 text-center">
                <h2>{{ apartment.title }}</h2>
                <span><u>{{ apartment.address }}</u></span>
            </div>

            <div class="col-12 my-3 text-center">
                <img :src="(`../../../images/apartments/${apartment.image}`)" alt="img-apartment" class="w-50 rounded"> 
            </div>

            <div class="col-8">
                <div class="my-3">
                    <h4 class="my-2"><strong>Descrizione</strong></h4>
                    <p>{{ apartment.description }}</p>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia repellat eum sint earum aut itaque
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
                    <div>
                        <strong>
                            <span v-if="`${apartment.rooms}` == 1">{{ apartment.rooms }} camera - </span>
                            <span v-else>{{ apartment.rooms }} camere - </span>
    
                            <span v-if="`${apartment.beds}` == 1">{{ apartment.beds }} letto - </span>
                            <span v-else>{{ apartment.beds }} letti - </span>
    
                            <span v-if="`${apartment.bathrooms}` == 1">{{ apartment.bathrooms }} bagno - </span>
                            <span v-else>{{ apartment.bathrooms }} bagni - </span>
    
                            <span>{{ apartment.mq }} mq</span>
                        </strong>
                    </div>

                </div>
    
                <div class="my-3">
                    <h4><strong>Servizi inclusi</strong></h4>
                    <ul>
                        <li v-for="(element, index) in apartment.services" :key="index">- {{ element.name }}</li>
                    </ul>
                </div>
            </div>

            <div class="col-4 text-center">
                <div class="prova_riquadro_prenota rounded mt-1"></div>
            </div>

            <div>
                <h4><strong>Dove ti troverai</strong></h4>
                <div id="map" class="map mb-3"></div>
            </div>

        </div>


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
                    console.log(res.data);
                    this.apartment = res.data;
                }).catch((err) => {
                    console.log(err);
                    this.isError = true;
                });
        },
    },
    created() {
        this.getApartment();
    },
    mounted() {
        setTimeout(() => {
            console.log(this.apartment);
            // Tomtom
            let center = [this.apartment.longitude, this.apartment.latitude];
            const map = tt.map({
                key: "cMTORuMrpmoMysQnNBGRyAx2g8Nmo8P9",
                container: "map",
                center: center,
                zoom: 15
            })
            map.on('load', () => {
                var marker = new tt.Marker()
                    .setLngLat(center)
                    .addTo(map);
            })
        }, 500);
    },
}
</script>

<style lang="scss" scoped>
.details-container{
    width: 85%;
    margin: 0 auto;
    .prova_riquadro_prenota {
        height: 500px;
        width: 100%;
        background-color: red;
        position: sticky;
        top: 50px;
    }

    .map {
        height: 400px;
        width: 35%;
    }
}

</style>
