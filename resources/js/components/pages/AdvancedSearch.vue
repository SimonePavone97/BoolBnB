<template>
    <div class="container" id="container-home">
        <!-- Ricerca città/indirizzo -->
        <div class="py-3 text-center">
            <input class="text-center" type="text" v-model="searchText" @keyup.enter="getAddress" placeholder="Cerca una città">
                <button @click="getAddress" type="submit"
                    class="btn cerca_color mx-2">Cerca</button>            
        </div>

        <div class="container">

            <div class="row justify-content-around">
            <!-- Filtro Stanze -->
            <div class="col-xl-3 col-lg-3 col-sm-6 col-xs-6 col-md-6">
                <label for="rooms">N° di stanze</label>
                <input type="number" v-model="rooms" name="rooms" min="1" class="text-center form-control " id="rooms" required>         
            </div>
            <!-- Filtro Bagni -->
            <div class="col-xl-3 col-lg-3 col-sm-6 col-xs-6 col-md-6">
                <label for="beds">N° di bagni</label>
                <input type="number" v-model="beds" name="beds" min="1" class="text-center form-control " id="beds" required>         
            </div>
            <!-- Filtro Radius km -->
            <div class="col-xl-3 col-lg-3 col-sm-6 col-xs-6 col-md-6">
                <label for="radius">Raggio di ricerca</label>
                <input type="range" v-model="searchRadius" name="radius" min="1000" max="50000" class="form-control " id="radius" required>         
            </div>
            <!-- Buttone Filtro Servizi -->  
            <button class="col-xl-3 col-lg-3 col-sm-6 col-xs-6 col-md-6 btn cerca_color my-4" type="button" data-toggle="collapse" data-target="#banana" aria-expanded="false" aria-controls="banana">
                Mostra filtro Servizi
            </button>
        </div>

        <!-- Filtro Servizi -->
        <div class="collapse py-3 " id="banana">
            <div class="d-flex flex-wrap">
                <div class="form-check col-6 col-md-4" v-for="service in services" :key="'service-'+service.id">
                    <input class="form-check-input" type="checkbox" :value="service.id"
                        :id="'service-'+service.id" v-model="checkedService">
                    <label class="form-check-label" :for="'service-'+service.id">
                        {{service.name}} 
                    </label>
                </div>  
            </div>      
        </div>

        </div>
        
        
        <div>
            <h5>Mappa da aggiustare</h5>
            <div id="map" class="map mb-3"></div>
        </div>

            <div v-if="sponsoredApartmentsArr.length != 0">
                <div class="text-center">
                    <h2 v-if="sponsoredApartmentsArr != ''">In evidenza</h2>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-center align-items-center apartment-card"
                        v-for="(apartment,index) in sponsoredApartmentsArr" :key="index" :apartment="apartment">
                        <router-link :to="{name: 'apartment-detail', params: {id: apartment.id}}" class="text-dark row justify-content-center w-100">
                            <div class="apartment-img" :style="{backgroundImage : `url(../../../images/apartments/${apartment.image})`}"></div>
                            <div class="apartment-details">
                                <h5 class="apartment-title"><strong>{{apartment.title}}</strong></h5>
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
                                <div class="text-center">
                                    <h4>Sponsorizzato</h4>
                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>

        <ul class="row my-3"> 
                
            <li class="d-flex justify-content-center align-items-center apartment-card" v-for="apartment in dioporco" :key="apartment.index" >

                <div v-show="apartment.rooms >= rooms && apartment.beds >= beds && getBanana(apartment.services)">
                <!-- Visualizzazione card apartment -->
                    <router-link :to="{name: 'apartment-detail', params: {id: apartment.id}}" class="text-dark row justify-content-center w-100">
                        <div class="apartment-img" :style="{backgroundImage : `url(../../../images/apartments/${apartment.image})`}"></div>
                        <div class="apartment-details">
                            <h5 class="apartment-title"><strong>{{apartment.title}}</strong></h5>
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
</template>

<script>
import axios from 'axios';

export default {
    name: 'AdvancedSearch',

    data() {
        return {
            isError: false,
            apartmentsArr: [],
            sponsoredApartmentsArr: [],
            searchText: "",
            searchRadius: 20000,
            rooms: "",
            beds: "",
            checkedService: [],
            services: [],
            apaservices: [],
            address: [],
            poilist:[],
            position:[],
            resultsapi:[],
            latlon: "",
            jabroni: [],
            dioporco: []         
        }
    },

    methods: {
        getBanana(gnigni){
            // console.log("GNIGNI",gnigni);
            console.log(typeof(gnigni));
            console.log("CHECK", this.checkedService);

            let madonna = [];
                     gnigni.forEach(element => {
                        madonna.push(element.id)
                        // console.log("BIGNI", element.id)
                        });

                        let checkedExist = this.checkedService.every(value =>{
                              return madonna.includes(value) 
                        });

                    console.log("existdio", checkedExist)
                    
                    console.log("Puattanala", madonna)
                    
                    return checkedExist
                    
            },
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
            },
        getServices() {
            axios.get(`http://127.0.0.1:8000/api/services`)
                .then((res) => {
                console.log(res.data);
                this.services = res.data.services;
                console.log('SERVIZI:', this.services);
                })
                .catch((error) => {
                    console.log(error)
                });
        },
        getApaservices() {
            axios.get(`http://127.0.0.1:8000/api/apaservice`)
                .then((res) => {
                this.apaservices = res.data.apaserviceid;
                console.log('APASERVIZI:', this.apaservices);
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
        getLatmap(){
                    let latmap = [];
                     this.dioporco.forEach(element => {
                        latmap.push(element.latitude)
                        console.log("latmap", element.latitude)
                        });
                    console.log("cristina",latmap);
                },
        getLongmap(){
                    let longmap = [];
                     this.dioporco.forEach(element => {
                        longmap.push(element.longitude)
                        console.log("longmap", element.longitude)
                        });
                    console.log("d'avena",longmap);
                },
        Risultato(){
            axios.get(`https://api.tomtom.com/search/2/geometryFilter.json?key=PsUYA2pnhpu22nLOAzS8KbMCWHziEWf3&geometryList=[{"type":"CIRCLE","position":"${this.latlon}","radius":${this.searchRadius}}]&poiList=`+ JSON.stringify(this.poilist))
                .then((res) => {
                    this.resultsapi= [];
                    this.dioporco= [];
                    // console.log("Svuptato",this.resultsapi);
                    res.data.results.forEach(element => {
                        this.resultsapi.push(element.poi)    
                    });
                    console.log("RISULTATI",this.resultsapi);
                    console.log(this.searchText);
                    console.log(this.searchRadius,"metri di radius");
                    console.log("FINAL",this.latlon)
                    this.apartmentsArr.forEach(cristo =>{
                        if (this.resultsapi.includes(cristo.id)) {
                            this.dioporco.push(cristo)
                        }
                    })   
                    console.log("AAAAAA",this.dioporco)                 
                })
                .then(this.sponsoredApartments)
                .then(this.getLatmap)
                .then(this.getLongmap)
                // .then(this.getMap)
                .catch((err) => {
                   this.isError = true;
                });
        },
        getMap() {
                let center = [this.latlon];
                const map = tt.map({
                    key: "cMTORuMrpmoMysQnNBGRyAx2g8Nmo8P9",
                    container: "map",
                    center: center,
                    zoom: 15
                })
                map.on('load', () => {
                 new tt.Marker()
              .setLngLat(center)
              .addTo(map);
      })
            //      for (let i = 0; i < this.dioporco.length; i++) {
            //      new tt.Marker()
                 
            //          .setLngLat([
            //              longmap[i],
            //              latmap[i],
            //          ])
            //          .addTo(map);
            //  }
            },
    },
    mounted() {
        this.getApartments(); 
        this.getServices(); 
        this.getApaservices(); 
        this.getPoilist();  
    },
}

</script>

<style lang="scss" scoped>

    #container-home{
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
    .map {
        height: 400px;
        width: 90vw;
        margin: 0 auto;
    }

    .cerca_color{
        background-color: #ff385c;
        color: white;
    }
    .widht_10{
        width: 15%;
    }

    

</style>
