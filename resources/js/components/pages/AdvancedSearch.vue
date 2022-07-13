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
          <input type="number" v-model="searchRadius" name="radius" min="1" class="form-control" id="radius" required>         
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

            <div v-for="banana in apartmentsArr" :key="banana.id">
            
              <ul v-for="element in resultsapi" :key="element.index"  > 
                
                <li v-if="element == banana.id && banana.rooms >= rooms && banana.beds >= beds">

                    <router-link :to="{name: 'apartment-detail', params: {id: banana.id}}">
                    <img class="card-img-top" :src="banana.image" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{banana.title}}</h5>
                        <p class="card-text">{{banana.description}}</p>
                        <div>
                            <span class="card-text">Stanze: {{banana.rooms}}</span>
                            <span class="card-text">Bagni: {{banana.bathrooms}}</span>
                            <span class="card-text">Mq: {{banana.mq}}</span>
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
        this.getPoilist(); 
        
   
    },
}



</script>

<style scoped>
</style>
