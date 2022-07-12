<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class=" col-4">
            
                <img src="../../../images/logo.png" alt="logo-Airbnb" width="150px">
            </div>
            <div class="col-4">
                <SearchComp @searchFunction="search" />
            </div>

        </div>



        <div class="row my-3">

            <div class="card col-lg-3 col-md-4 col-sm-12" v-for="apartment in apartmentsArr" :key="apartment.id"
                v-show="!searchStatus">
                <router-link :to="{name: 'apartment-detail', params: {id: apartment.id}}" class="text-dark">
                    <img class="card-img-top" :src="apartment.image" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{apartment.title}}</h5>
                        <p class="card-text">{{apartment.description}}</p>
                        <div>
                            <span class="card-text">Stanze: {{apartment.rooms}}</span>
                            <span class="card-text">Bagni: {{apartment.bathrooms}}</span>
                            <span class="card-text">Mq: {{apartment.mq}}</span>
                        </div>
                    </div>
                </router-link>
            </div>

            <div class="card d-flex justify-content-center align-items-center apartment-card" 
            v-for="apartment in searchedApartmentsArr" :key="apartment.id" v-show="searchStatus">
                <router-link :to="{name: 'apartment-detail', params: {id: apartment.id}}">
                    <img class="card-img-top" :src="apartment.image" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{apartment.title}}</h5>
                        <p class="card-text">{{apartment.description}}</p>
                        <div>
                            <span class="card-text">Stanze: {{apartment.rooms}}</span>
                            <span class="card-text">Bagni: {{apartment.bathrooms}}</span>
                            <span class="card-text">Mq: {{apartment.mq}}</span>
                        </div>
                    </div>
                </router-link>
            </div>


        </div>




    </div>
</template>

<script>
    import axios from 'axios';
    import SearchComp from './partials/SearchComp.vue';

    export default {
        name: 'HomePage',
        components: {
            SearchComp,
        },
        data() {
            return {
                apartmentsArr: [],
                searchedApartmentsArr: [],
                searchStatus: false,
            }
        },
        created() {
            this.getApartments('a');
        },
        methods: {
            getApartments(searchedText) {
                axios.get(`http://127.0.0.1:8000/api/apartments`)
                    .then((res) => {
                        console.log(res.data);
                        this.apartmentsArr = res.data.apartments;
                        console.log('Appartamenti:', this.apartmentsArr);
                    })
                    .catch((error) => {
                        console.log(error)
                    });

                axios.get(`http://127.0.0.1:8000/api/apartments?title=${searchedText}`)
                    .then((res) => {
                        this.searchApartmentsArr = res.data.apartments;
                        console.log('Appartamenti cercati:', this.searchedApartmentsArr);
                    })
                    .catch((error) => {
                        console.log(error)
                    });
            },
            search(searchedText) {
                this.searchText = searchedText;
                console.log(this.searchText);
                this.searchStatus = true;
                this.getApartments(this.searchText);
            },
        },

    }

</script>

<style>

</style>
