<template>
    <div>
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
         <!-- <div class="form-check" v-for="service in services" :key="service.id">
            <input class="form-check-input" type="checkbox" :value="service.id"
                :id="'service-'+service.id" v-model="checkedService">
             <label class="form-check-label" :for="'service-'+service.id">
                {{service.name}}
            </label>
        </div>  -->

        
        <!-- <label for="services" class="col-12">Servizi:</label>
        <div class="form-group d-flex flex-wrap pl-3"  v-for="service in apartmentsArr" :key="service.id">
            <div class="form-check-form-check-inline col-6 col-md-4">
              <input v-model="checkedService" class="form-check-input" type="checkbox" :value="service.id" :id="'service-' + service.id" name="services[]">
              <label :for="'service-' + service.id" class="form-check-label">{{ service.name }}</label>
            </div>
        </div> -->
   
                                

            <div v-for="apartment in apartmentsArr" :key="apartment.id">
            
              <ul v-for="element in resultsapi" :key="element.index"  > 
                
                <li v-if="element == apartment.id && apartment.rooms >= rooms && apartment.beds >= beds ">
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

                </li>

              </ul>
            
            </div>
                
            
        
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
            address: [],
            poilist:[],
            position:[],
            resultsapi:[],
            latlon: ""
            
        }
    },

    methods: {
        getApartments() {
            axios.get(`http://127.0.0.1:8000/api/apartments`)
                .then((res) => {
                console.log(res.data);
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
                    this.searchText= [];
                    console.log("Svuptato TEXT",this.searchText);
                    this.latlon= [];
                    console.log("Svuptato LatLon",this.latlon);
                    this.address= [];
                    console.log("Svuptato address",this.address);
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
            axios.get(`https://api.tomtom.com/search/2/geometryFilter.json?key=PsUYA2pnhpu22nLOAzS8KbMCWHziEWf3&geometryList=[{"type":"CIRCLE","position":"${this.latlon}","radius":${this.searchRadius}}]&poiList=`+ JSON.stringify(this.poilist))
                .then((res) => {
                    this.resultsapi= [];
                    console.log("Svuptato",this.resultsapi);
                    res.data.results.forEach(element => {
                        this.resultsapi.push(element.poi)    
                    });
                    console.log("RISULTATI",this.resultsapi);
                    console.log(this.searchText);
                    console.log(this.searchRadius,"metri di radius");
                    console.log("FINAL",this.latlon)
                }).catch((err) => {
                   this.isError = true;
                });
        }
    },
    mounted() {
        this.getApartments(); 
        this.getServices(); 
        this.getPoilist(); 
        
   
    },
}



</script>

<style scoped>
</style>
