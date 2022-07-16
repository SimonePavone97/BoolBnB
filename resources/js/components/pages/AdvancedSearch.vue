<template>
    <div class="container">
        <!-- Ricerca città/indirizzo -->
        <div>
            <input type="text" v-model="searchText" @keyup.enter="getAddress" placeholder="Cerca una città">
                <button @click="getAddress" type="submit"
                    class="btn btn-secondary mx-2">Cerca</button>            
        </div>
        <!-- Filtro Radius km -->
        <div>
          <label for="radius">Raggio di ricerca</label>
          <input type="range" v-model="searchRadius" name="radius" min="1" max="20000" class="form-control" id="radius" required>         
        </div>
        <!-- Filtro Stanze -->
        <div>
          <label for="rooms">N° di stanze</label>
          <input type="number" v-model="rooms" name="rooms" min="1" class="form-control" id="rooms" required>         
        </div>
        <!-- Filtro Bagni -->
        <div>
          <label for="beds">N° di bagni</label>
          <input type="number" v-model="beds" name="beds" min="1" class="form-control" id="beds" required>         
        </div>
        <!-- Filtro Servizi -->
        <div class="form-check-form-check-inline col-6 col-md-4" v-for="service in services" :key="'service-'+service.id">
            <input class="form-check-input" type="checkbox" :value="service.id"
                :id="'service-'+service.id" v-model="checkedService">
             <label class="form-check-label" :for="'service-'+service.id">
                {{service.name}} 
            </label>
        </div>  

        <div>
            <h5>Mappa</h5>
            <div id="map" class="map mb-3"></div>
        </div>

              <ul> 
                
                <li v-for="apartment in dioporco" :key="apartment.index" >

                    <div v-show="apartment.rooms >= rooms && apartment.beds >= beds && getBanana(apartment.services)">
                <!-- Visualizzazione card apartment -->
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
            searchText: "",
            searchRadius: "",
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
                .then(this.getLatmap)
                .then(this.getLongmap)
                .then(this.getMap)
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
          var marker = new tt.Marker()
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

<style scoped>
    .map {
        height: 400px;
        width: 35%;
    }

</style>
