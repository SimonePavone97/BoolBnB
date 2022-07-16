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

        <ul class="row my-3">

            <li class="card col-lg-3 col-md-4 col-sm-12 marg" v-for="apartment in apartmentsArr" :key="apartment.id" v-show="!searchStatus">
                <div>
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
            </li>

            <li v-for="apartment in risultati" :key="apartment.index" v-show="searchStatus" class="card col-lg-3 col-md-4 col-sm-12 marg">
                <div>
                    <router-link :to="{name: 'apartment-detail', params: {id: apartment.id}}">
                        <img class="card-img-top img-fluid" :src="(`../../../images/apartments/${apartment.image}`)"
                        alt="Card image cap">
                        <div class="card-body">
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
            </li>
            
        </ul>

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

                isError: false,
                apartmentsArr: [],
                searchText: "",
                address: [],
                poilist:[],
                position:[],
                resultsapi:[],
                latlon: "",
                risultati: []
            }
        },
        created() {
            this.sponsoredApartments();
        },
        methods: {
            getApartments() {
                axios.get("http://127.0.0.1:8000/api/apartments")
                    .then((res) => {
                    this.apartmentsArr = res.data.apartments;
                    console.log('Appartamenti:', this.apartmentsArr);
                    })
                    .catch((error) => {
                    console.log(error)
                    });
            },
            getPoilist(){
                axios.get("http://127.0.0.1:8000/api/positions")
                    .then((res) => {
                        this.poilist = res.data;
                        console.log("POILIST",this.poilist);
                    }).catch((err) => {
                        this.isError = true;
                    });
            },
            getAddress(){
                axios.get(`https://api.tomtom.com/search/2/geocode/${this.searchText}.json?key=PsUYA2pnhpu22nLOAzS8KbMCWHziEWf3`)
                    .then((res) => {
                        this.latlon= [];
                        // console.log("Svuptato LatLon",this.latlon);
                        this.address= [];
                        // console.log("Svuptato address",this.address);
                        this.position= [];
                        this.address = res.data.results;
                        this.position.push(this.address[0].position)
                        this.latlon = this.position[0].lat + "," + this.position[0].lon
                        console.log("POSITION",this.position,typeof(this.position))
                        console.log("LAT",this.position[0].lat);
                        console.log("LON",this.position[0].lon);
                        console.log("Sdighidi",this.latlon);
                    })
                    .then(this.Risultato)
                    .catch((err) => {
                    this.isError = true;
                    });
                
                    
            }, 
            Risultato(){
                axios.get(`https://api.tomtom.com/search/2/geometryFilter.json?key=PsUYA2pnhpu22nLOAzS8KbMCWHziEWf3&geometryList=[{"type":"CIRCLE","position":"${this.latlon}","radius":20000}]&poiList=`+ JSON.stringify(this.poilist))
                    .then((res) => {
                        this.resultsapi= [];
                        // console.log("Svuptato",this.resultsapi);
                        res.data.results.forEach(element => {
                            this.resultsapi.push(element.poi)    
                        });
                        console.log("RISULTATI",this.resultsapi);
                        console.log(this.searchText);
                        console.log("FINAL",this.latlon)
                        this.apartmentsArr.forEach(elm =>{
                            if (this.resultsapi.includes(elm.id)) {
                                this.risultati.push(elm)
                            }
                        })

                    }).catch((err) => {
                    this.isError = true;
                });
            },
            search(searchedText) {
                this.searchText = searchedText;
                console.log(this.searchText);
                this.searchStatus = true;
                this.getAddress();
                this.Risultato();
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
        mounted(){
            this.getApartments(); 
            this.getPoilist();
            console.log(this.risultati)
        }
    }

</script>

<style lang="scss" scoped>

   .marg {
        margin-bottom: 0.8em;
    }

</style>


// getApartments(searchedText) {
//     axios.get(`http://127.0.0.1:8000/api/apartments`)
//         .then((res) => {
//             console.log(res.data);
//             this.apartmentsArr = res.data.apartments;
//             console.log('Appartamenti:', this.apartmentsArr);
//         })
//         .catch((error) => {
//             console.log(error)
//         });

//     axios.get(`http://127.0.0.1:8000/api/apartments?title=${searchedText}`)
//         .then((res) => {
//             this.searchApartmentsArr = res.data.apartments;
//             console.log('Appartamenti cercati:', this.searchedApartmentsArr);
//         })
//         .catch((error) => {
//             console.log(error)
//         });
// },