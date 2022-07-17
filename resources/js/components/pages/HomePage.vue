<template>
    <div>

        <SearchComp/>
        
       <div id="container-home">

            <div v-if="sponsoredApartmentsArr.length != 0 && this.searchedApartmentsArr == ''">
            <div class="text-center">
                <h2 v-if="sponsoredApartmentsArr != ''">In evidenza</h2>
            </div>
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center align-items-center apartment-card rounded"
                    v-for="(apartment,index) in sponsoredApartmentsArr" :key="index" :apartment="apartment"
                    v-show="!searchStatus">
                    <router-link :to="{name: 'apartment-detail', params: {id: apartment.id}}" class="text-dark row justify-content-center w-100">
                        <div class="apartment-img border_sponsor" :style="{backgroundImage : `url(../../../images/apartments/${apartment.image})`}"></div>
                        <div class="apartment-details">
                            <h5 class="apartment-title text-center"><strong>{{apartment.title}}</strong></h5>
                            <!--<p class="apartment-text">{{apartment.description}}</p>-->
                            <div>
                                <span class="apartment-text" v-if="`${apartment.rooms}` == 1">{{ apartment.rooms }} camera - </span>
                                <span class="apartment-text" v-else>{{ apartment.rooms }} camere - </span>
        
                                <span class="apartment-text" v-if="`${apartment.beds}` == 1">{{ apartment.beds }} letto - </span>
                                <span class="apartment-text" v-else>{{ apartment.beds }} letti - </span>
        
                                <span class="apartment-text" v-if="`${apartment.bathrooms}` == 1">{{ apartment.bathrooms }} bagno - </span>
                                <span class="apartment-text" v-else>{{ apartment.bathrooms }} bagni - </span>
        
                                <span>{{ apartment.mq }} mq</span>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>

        <ul class="row my-3">

            <li class="d-flex justify-content-center align-items-center apartment-card" v-for="apartment in apartmentsArr" :key="apartment.id" v-show="!searchStatus">
                <div>
                    <router-link :to="{name: 'apartment-detail', params: {id: apartment.id}}" class="text-dark row justify-content-center w-100">
                        <div class="apartment-img" :style="{backgroundImage : `url(../../../images/apartments/${apartment.image})`}"></div>
                        <div class="apartment-details">
                            <h5 class="apartment-title text-center"><strong>{{apartment.title}}</strong></h5>
                            <!--<p class="apartment-text">{{apartment.description}}</p>-->
                            <div>
                                <span class="apartment-text" v-if="`${apartment.rooms}` == 1">{{ apartment.rooms }} camera - </span>
                                <span class="apartment-text" v-else>{{ apartment.rooms }} camere - </span>
        
                                <span class="apartment-text" v-if="`${apartment.beds}` == 1">{{ apartment.beds }} letto - </span>
                                <span class="apartment-text" v-else>{{ apartment.beds }} letti - </span>
        
                                <span class="apartment-text" v-if="`${apartment.bathrooms}` == 1">{{ apartment.bathrooms }} bagno - </span>
                                <span class="apartment-text" v-else>{{ apartment.bathrooms }} bagni - </span>
        
                                <span>{{ apartment.mq }} mq</span>
                            </div>
                        </div>
                    </router-link>
                </div>
            </li>

            <li v-for="apartment in risultati" :key="apartment.index" v-show="searchStatus" class="d-flex justify-content-center align-items-center apartment-card">
                <div>
                    <router-link :to="{name: 'apartment-detail', params: {id: apartment.id}}" class="text-dark row w-100 justify-content-center">
                        <div class="apartment-img" :style="{backgroundImage : `url(../../../images/apartments/${apartment.image})`}"></div>
                        <div class="apartment-details">
                            <h5 class="apartment-title text-center"><strong>{{apartment.title}}</strong></h5>
                            <!--<p class="apartment-text">{{apartment.description}}</p>-->
                            <div>
                                <span class="apartment-text" v-if="`${apartment.rooms}` == 1">{{ apartment.rooms }} camera - </span>
                                <span class="apartment-text" v-else>{{ apartment.rooms }} camere - </span>
        
                                <span class="apartment-text" v-if="`${apartment.beds}` == 1">{{ apartment.beds }} letto - </span>
                                <span class="apartment-text" v-else>{{ apartment.beds }} letti - </span>
        
                                <span class="apartment-text" v-if="`${apartment.bathrooms}` == 1">{{ apartment.bathrooms }} bagno - </span>
                                <span class="apartment-text" v-else>{{ apartment.bathrooms }} bagni - </span>
        
                                <span>{{ apartment.mq }} mq</span>
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
                        this.apartmentsArr =  [];
                    }).catch((err) => {
                        this.isError = true;
                });
            },
            search(searchedText) {
                this.searchText = searchedText;
                console.log(this.searchText);
                this.searchStatus = true;
                this.getApartments();
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
        }
    }

</script>

<style lang="scss" scoped>

.border_sponsor{
    border: 3px solid #ff385c;
}

#container-home{
    width: 80%;
    margin: 0 auto;
    .apartment-card{
        width: calc(100%/10 * 2 - 1em);
        margin: 1em 0.5em;
        .apartment-img{
            height: 25vh;
            width: 25vh;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 15px;
        }
        .apartment-details{
            height: 8vh;
            margin-top: 0.8em;
            .apartment-title{
                font-size: 1.1em;
            }
            .apartment-text{
                font-size: 0.9em;
            }
        }
    }
}

// xs
@media screen and (max-width: 575.90px) {
    
    #container-home{
        width: 95%;
        .apartment-card{
            width: calc(100%/12 * 12 - 1em);
            .apartment-img{
                height: 40vh;
                width: 40vh;
            }
            .apartment-details{
                height: 7vh;
            .apartment-title{
                text-align: center;
                font-size: 1.2em;
            }
            .apartment-text{
                font-size: 1em;
            }
        }
        }
    }

}

// sm
@media screen and (min-width: 576px) and (max-width: 768.90px) {
    
    #container-home{
        .apartment-card{
            width: calc(100%/12 * 6 - 1em);
        }
    }

}

// md
@media screen and (min-width: 768px) and (max-width: 991.90px) {
    
    #container-home{
        .apartment-card{
            width: calc(100%/12 * 4 - 1em);
            .apartment-details{
                height: 10vh;
            }
        }
    }

}

// lg
@media screen and (min-width: 992px) and (max-width: 1999.90px) {
    
    #container-home{
        .apartment-card{
            width: calc(100%/12 * 3 - 1em);
            .apartment-details{
                height: 10vh;
            }
        }
    }

}

// xl
@media screen and (min-width: 1200px) and (max-width: 1399.90px) {
    
    #container-home{
        .apartment-card{
            .apartment-details{
                height: 10vh;
            }
        }
    }
}

// xxl
@media screen and (min-width: 1400px){
    
    #container-home{
        .apartment-card{
            width: calc(100%/10 * 2 - 1em);
            .apartment-details{
                height: 8vh;
            }
        }
    }
}

</style>