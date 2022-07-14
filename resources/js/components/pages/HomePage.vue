<template>
    <div id="container-apartments">
        <div class="d-flex align-content-center">
            <div class="mx-3 col-4">
                <img src="../../../images/logo.png" alt="logo-Airbnb" width="150px">
            </div>
            <div class="col-4">
                <SearchComp @searchFunction="search" />
            </div>
            <div class="col-4"></div>
        </div>

        <div class="row my-3">

            <div v-if="sponsoredApartmentsArr.length != 0 && this.searchedApartmentsArr == ''">
                <div>
                    <h2 v-if="sponsoredApartmentsArr != ''">In evidenza</h2>
                </div>
                <div class="card d-flex justify-content-center align-items-center apartment-card"
                    v-for="(apartment,index) in sponsoredApartmentsArr" :key="'sponsored' + index"
                    :apartment="apartment" v-show="!searchStatus">
                    <router-link :to="{name: 'apartment-detail', params: {id: apartment.id}}" class="text-dark">
                        <img class="card-img-top" :src="apartment.image" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{apartment.title}}</h5>
                            <p class="card-text">{{apartment.description}}</p>
                            <div>
                                <span class="card-text">Stanze: {{apartment.rooms}}</span>
                                ciao
                                <span class="card-text">Bagni: {{apartment.bathrooms}}</span>
                                <span class="card-text">Mq: {{apartment.mq}}</span>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>

            <div class="card d-flex justify-content-center align-items-center apartment-card"
                v-for="apartment in apartmentsArr" :key="apartment.id" v-show="!searchStatus">
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
            searchStatus : false,
            sponsoredApartmentsArr:[],
        }
    },
    created(){
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
        search( searchedText ){
            this.searchText = searchedText;
            console.log(this.searchText);
            this.searchStatus = true;
            this.getApartments(this.searchText);
        },
        sponsoredApartments(){
            axios.get('http://127.0.0.1:8000/api/sponsored/apartments')
                .then((res)=>{
                    for(let i = res.data.length-1; i>=0; i--){
                        res.data[i].forEach(element =>{
                            this.sponsoredApartmentsArr.push(element);
                            console.log(this.sponsoredApartmentsArr);
                        });
                    }
                    
                }).catch((error)=>{
                    console.warn(error);
                })
        }
    },

}

</script>

<style lang="scss" scoped>

#container-apartments{
    width: 100%;
    .apartment-card{
        width: calc(100%/10 * 2 - 1em);
        margin: 0.5em 0.5em;
        .card-body{
            height: 25vh;
        }
    }
}
</style>
