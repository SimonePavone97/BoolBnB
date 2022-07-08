<template>
    <div>
        <div class="card" style="width: 18rem;">
            <img src="" class="card-img-top" alt="">
            <div class="card-body">
                <h5 class="card-title">Titolo</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        
        
    </div>
</template>



<script>

import axios from 'axios';

    export default {
        name: "Apartments",
        data(){
            return{
                apartmentsArray: [],
            }
        },

        methods:{
            getApartments(){
                axios.get(`http://127.0.0.1:8000/api/apartments`)
                .then((res) => {
                    console.log(res)
                    this.apartmentsArray = res.data;
                    console.log(res.data);
                })
            }
        },

        mounted(){
            this.getApartments();
        }
    }



</script>


<style>

</style>
