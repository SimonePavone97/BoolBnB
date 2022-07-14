<template>
    <div>
        <!-- <SearchComp class="sticky-top" /> -->
        <h2>{{ apartment.title }}</h2>

        <span>{{ apartment.address }}</span>
        <img :src="(`../../../images/apartments/${apartment.image}`)" alt="img-apartment" class="w-50 rounded">

        <div class="row justify-content-between mt-4">
            <div class="col-6">
                <h3>{{ apartment.description }}</h3>
                <div>
                    <!-- <span>{{ apartment.rooms }} camere - {{ apartment.beds }} letti - {{ apartment.bathrooms }} bagni - {{ apartment.mq }} mq</span> -->

                    <span v-if="`${apartment.rooms}` == 1">{{ apartment.rooms }} camera - </span>
                    <span v-else>{{ apartment.rooms }} camere - </span>

                    <span v-if="`${apartment.beds}` == 1">{{ apartment.beds }} letto - </span>
                    <span v-else>{{ apartment.beds }} letti - </span>

                    <span v-if="`${apartment.bathrooms}` == 1">{{ apartment.bathrooms }} bagno - </span>
                    <span v-else>{{ apartment.bathrooms }} bagni</span>

                    <span>{{ apartment.mq }} mq</span>

                </div>

                <hr>

                <h3>Servizi</h3>
                <ul>
                    <li v-for="(element, index) in apartment.services" :key="index">{{ element.name }}</li>
                </ul>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia repellat eum sint earum aut itaque
                    ratione pariatur harum temporibus delectus, cumque rem commodi nemo numquam omnis doloribus minus
                    dolore expedita! Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi distinctio
                    voluptates doloremque illum, consectetur nobis inventore, nostrum porro nisi laudantium unde
                    eligendi explicabo voluptas sint debitis provident nemo ea ipsam?Lorem ipsum dolor sit amet
                    consectetur, adipisicing elit. Iusto cupiditate vitae ad in officiis, hic optio fugiat molestiae,
                    unde esse velit quam vero ipsum, nesciunt deleniti? Consectetur voluptas commodi molestiae!log Lorem
                    ipsum dolor sit amet consectetur adipisicing elit. Ullam recusandae, dolore hic quo voluptas, sit
                    quod totam maxime animi provident vero rem porro libero consectetur cumque dolores consequatur
                    quidem facilis.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia repellat eum sint earum aut itaque
                    ratione pariatur harum temporibus delectus, cumque rem commodi nemo numquam omnis doloribus minus
                    dolore expedita! Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi distinctio
                    voluptates doloremque illum, consectetur nobis inventore, nostrum porro nisi laudantium unde
                    eligendi explicabo voluptas sint debitis provident nemo ea ipsam?Lorem ipsum dolor sit amet
                    consectetur, adipisicing elit. Iusto cupiditate vitae ad in officiis, hic optio fugiat molestiae,
                    unde esse velit quam vero ipsum, nesciunt deleniti? Consectetur voluptas commodi molestiae!log Lorem
                    ipsum dolor sit amet consectetur adipisicing elit. Ullam recusandae, dolore hic quo voluptas, sit
                    quod totam maxime animi provident vero rem porro libero consectetur cumque dolores consequatur
                    quidem facilis.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia repellat eum sint earum aut itaque
                    ratione pariatur harum temporibus delectus, cumque rem commodi nemo numquam omnis doloribus minus
                    dolore expedita! Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi distinctio
                    voluptates doloremque illum, consectetur nobis inventore, nostrum porro nisi laudantium unde
                    eligendi explicabo voluptas sint debitis provident nemo ea ipsam?Lorem ipsum dolor sit amet
                    consectetur, adipisicing elit. Iusto cupiditate vitae ad in officiis, hic optio fugiat molestiae,
                    unde esse velit quam vero ipsum, nesciunt deleniti? Consectetur voluptas commodi molestiae!log Lorem
                    ipsum dolor sit amet consectetur adipisicing elit. Ullam recusandae, dolore hic quo voluptas, sit
                    quod totam maxime animi provident vero rem porro libero consectetur cumque dolores consequatur
                    quidem facilis.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia repellat eum sint earum aut itaque
                    ratione pariatur harum temporibus delectus, cumque rem commodi nemo numquam omnis doloribus minus
                    dolore expedita! Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi distinctio
                    voluptates doloremque illum, consectetur nobis inventore, nostrum porro nisi laudantium unde
                    eligendi explicabo voluptas sint debitis provident nemo ea ipsam?Lorem ipsum dolor sit amet
                    consectetur, adipisicing elit. Iusto cupiditate vitae ad in officiis, hic optio fugiat molestiae,
                    unde esse velit quam vero ipsum, nesciunt deleniti? Consectetur voluptas commodi molestiae!log Lorem
                    ipsum dolor sit amet consectetur adipisicing elit. Ullam recusandae, dolore hic quo voluptas, sit
                    quod totam maxime animi provident vero rem porro libero consectetur cumque dolores consequatur
                    quidem facilis.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia repellat eum sint earum aut itaque
                    ratione pariatur harum temporibus delectus, cumque rem commodi nemo numquam omnis doloribus minus
                    dolore expedita! Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi distinctio
                    voluptates doloremque illum, consectetur nobis inventore, nostrum porro nisi laudantium unde
                    eligendi explicabo voluptas sint debitis provident nemo ea ipsam?Lorem ipsum dolor sit amet
                    consectetur, adipisicing elit. Iusto cupiditate vitae ad in officiis, hic optio fugiat molestiae,
                    unde esse velit quam vero ipsum, nesciunt deleniti? Consectetur voluptas commodi molestiae!log Lorem
                    ipsum dolor sit amet consectetur adipisicing elit. Ullam recusandae, dolore hic quo voluptas, sit
                    quod totam maxime animi provident vero rem porro libero consectetur cumque dolores consequatur
                    quidem facilis.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia repellat eum sint earum aut itaque
                    ratione pariatur harum temporibus delectus, cumque rem commodi nemo numquam omnis doloribus minus
                    dolore expedita! Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi distinctio
                    voluptates doloremque illum, consectetur nobis inventore, nostrum porro nisi laudantium unde
                    eligendi explicabo voluptas sint debitis provident nemo ea ipsam?Lorem ipsum dolor sit amet
                    consectetur, adipisicing elit. Iusto cupiditate vitae ad in officiis, hic optio fugiat molestiae,
                    unde esse velit quam vero ipsum, nesciunt deleniti? Consectetur voluptas commodi molestiae!log Lorem
                    ipsum dolor sit amet consectetur adipisicing elit. Ullam recusandae, dolore hic quo voluptas, sit
                    quod totam maxime animi provident vero rem porro libero consectetur cumque dolores consequatur
                    quidem facilis.
                </p>
            </div>

            <div class="col-5">
                <div class="prova_riquadro_prenota rounded mt-1"></div>
            </div>

        </div>

        <div>
            <h5>Mappa</h5>
            <div id="map" class="map mb-3"></div>
        </div>
        <h3>Invia un messaggio alla struttura</h3>
        <form @submit.prevent="sendMessage">
            <div class="d-flex flex-column justify-content-start">
                <div class="d-flex col-12 px-0 my-2">
                    <h6 class="col-3 mr-1">Mittente</h6>
                    <input class=" col-9" type="text" id="name" v-model="sender" placeholder="Nome e cognome">
                </div>
                <div class="d-flex px-0 col-12 my-2">
                    <h6 class="col-3">E-mail</h6>
                    <input type="email" id="email" class="ms_email col-9" v-model="email" placeholder="E-mail">
                </div>
            </div>
            <div class=" col-12 my-3">
                <h6>Messaggio</h6>
                <textarea name="content" id="content" class="col-12 form-control mt-3" v-model="content"
                    placeholder="Inserisci il testo del tuo messaggio"></textarea>
            </div>
            <div v-if="formErrors.content">
                <ul>
                    <li v-for="(error,index) in formErrors.content" :key="index">
                        {{error}}
                    </li>
                </ul>
            </div>
            <button class="mt-2 ml-2" type="submit">Invia</button>
        </form>
    </div>


</template>

<script>
// import SearchComp from './partials/SearchComp'
import axios from 'axios';
export default {
    name: 'ApartmentDetailPage',
    components: {
        // SearchComp
    },
    data() {
        return {
            apartment: [],
            isError: false,
            sender: "",
            email: "",
            content: "",
            apartment_id: "",
            formErrors: {},
        }
    },
    methods: {
        getApartment() {
            // il routing mi permette di usare $route che mi da determinate info (this.$route è parte di vue)
            axios.get(`http://127.0.0.1:8000/api/apartments/${this.$route.params.id}`)
                .then((res) => {
                    console.log(res.data);
                    this.apartment = res.data;
                }).catch((err) => {
                    console.log(err);
                    this.isError = true;
                });
        },
        sendMessage(){
            console.log(this.formData);
            axios.post("api/messages", {
                sender: this.sender,
                email: this.email,
                content: this.content,
                apartment_id: this.apartment.id,
            })
                
        }
    },
    created() {
        this.getApartment();
    },
    mounted() {

        setTimeout(() => {
            console.log(this.apartment);
            // Tomtom
            let center = [this.apartment.longitude, this.apartment.latitude];
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
        }, 500);

    },
}
</script>

<style scoped>
.prova_riquadro_prenota {
    height: 500px;
    width: 100%;
    background-color: red;
    position: sticky;
    top: 50px;
}
.map {
    height: 400px;
    width: 35%;
}
</style>