<template>
    <div>
        <Header class="sticky-top"/>
        <h2>{{ apartment.title }}</h2>
        <span>{{ apartment.address }}</span>
        <img :src="(`${apartment.image}`)" alt="">

        <div class="row">
            <div class="col-7">
                <p>{{ apartment.description }}</p>
                <ul>
                    <li v-for="(element, index) in apartment.services">{{ element.name }}</li>
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
                <div class="prova_riquadro_prenota sticky-top mt-3"></div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from '../Header'
import axios from 'axios';

export default {
    name: 'ApartmentDetailPage',

    components: {
        Header
    },

    data() {
        return {
            apartment: [],
            isError: false,
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
    },
    mounted() {
        this.getApartment();
        console.log("this.$route");
    },
}



</script>

<style scoped>
.prova_riquadro_prenota {
    height: 500px;
    width: 100%;
    background-color: red;
}
</style>
