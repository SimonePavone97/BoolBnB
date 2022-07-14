<template>
    <div>
        <div class="d-flex justify-content-center">
            <div class="card mx-2" style="width: 18rem;">
                <img class="card-img-top"
                    src="https://play-lh.googleusercontent.com/1zfN_BL13q20v0wvBzMWiZ_sL_t4KcCJBeAMRpOZeT3p34quM-4-pO-VcLj8PJNXPA0"
                    alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title">{{sponsorship.name}}</h4>
                    <h5 class="card-title">{{sponsorship.price}}€</h5>
                    <h5 class="card-title">{{sponsorship.duration}}h</h5>
                    <a href="#" class="btn btn-danger">Acquista</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Sponsorship",

    props: {
        sponsorship : {
            required: true,
            type: Object
        }
    }
}

</script>

<style>

</style>