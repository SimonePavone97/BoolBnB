<template>
    <div>
        <div class="row bg-dark mb-4">
            <div class="col-12 ">
                <div class="d-flex justify-content-around align-items-center">
                    <img src="../../../images/logo.png" alt="Logo BoolBnB" width="180px">

                    <SearchComp @searchFunction="search" />
                </div>
            </div>
        </div>

       <div class="container">

            <div v-if="sponsoredApartmentsArr.length != 0 && this.searchedApartmentsArr == ''">
            <div class="text-center">
                <h2 v-if="sponsoredApartmentsArr != ''">In evidenza</h2>
            </div>
            <div class="d-flex justify-content-center">
                <div class="card d-flex justify-content-center align-items-center apartment-card"
                    v-for="(apartment,index) in sponsoredApartmentsArr" :key="index" :apartment="apartment"
                    v-show="!searchStatus">
                    <router-link :to="{name: 'apartment-detail', params: {id: apartment.id}}" class="text-dark">
                        <img class="card-img-top" :src="(`../../../images/apartments/${apartment.image}`)"
                            alt="Card image cap">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{apartment.title}}</h5>
                            <!--<p class="card-text">{{apartment.description}}</p>-->
                            <div>
                                <span class="card-text">Stanze: {{apartment.rooms}}</span>
                                <span class="card-text">Bagni: {{apartment.bathrooms}}</span>
                                <span class="card-text">Mq: {{apartment.mq}}</span>
                            </div>
                            <div class="text-center">
                                <h4>Sponsorizzato</h4>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>

        <div class="row my-3">

                <div class="card col-lg-3 col-md-4 col-sm-12 marg" v-for="apartment in apartmentsArr"
                    :key="apartment.id" v-show="!searchStatus">
                    <router-link :to="{name: 'apartment-detail', params: {id: apartment.id}}" class="text-dark">
                        <img class="card-img-top img-fluid" :src="(`../../../images/apartments/${apartment.image}`)" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{apartment.title}}</h5>
                            <!--<p class="card-text">{{apartment.description}}</p>-->
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
                    <img class="card-img-top" :src="(`../../../images/apartments/${apartment.image}`)"
                        alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title ">{{apartment.title}}</h5>
                        <!--<p class="card-text">{{apartment.description}}</p>-->
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
                sponsoredApartmentsArr: [],
            }
        },
        created() {
            this.getApartments('a');
            this.sponsoredApartments();
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
            sponsoredApartments() {
                axios.get('http://127.0.0.1:8000/api/sponsored/apartments')
                    .then((res) => {
                        for (let i = res.data.length - 1; i >= 0; i--) {
                            res.data[i].forEach(element => {
                                this.sponsoredApartmentsArr.push(element);
                                console.log(this.sponsoredApartmentsArr);
                            });
                        }

                    }).catch((error) => {
                        console.warn(error);
                    })
            }
        },

    }

</script>

<style lang="scss" scoped>

   .marg {
        margin-bottom: 0.8em;
    }

</style>
