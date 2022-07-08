<template>
  <div id="not-found" class="d-flex justify-content-center align-items-center">
    <div class="text-left d-flex justify-content-center align-items-center">
      <div id="not-found__text" class="col-8">
        <h2>Ops!</h2>
        <h3>Non troviamo la pagina che stai cercando.</h3>  
        <p class="font-weight-bold">Codice errore: 404</p>
        <span>Ecco qualche link utile:</span>
        <ul>
          <li><span class="text-dark" @click="$router.back()">Indietro</span></li>
          <li><router-link class="text-dark" :to="{name: 'home'}">Home</router-link></li>
        </ul>
      </div>
      <div id="omino-404" class="col-4">
        <img src="../../../images/404.png" alt="page not found">
      </div>
    </div>
  </div>
</template>

<script>
export default{
  name: 'NotFound',
}
</script>

<style lang="scss" scoped>

#not-found{
  height: 100vh;
  &__text{
    h2{font-size: 3.5rem;}
    h3{font-size: 1.5rem;}
    ul{
      li{
        cursor: pointer;
        background-color: transparent;
        padding: 0.5em;
        :hover{
          padding: 0.5em;
          color: #fff;
          background-color: rgba(0, 0, 0, 0.600);
        }
      }
    }
  }
  #omino-404{
    display: none;
  }
}

@media screen and (min-width:  700px) {

#not-found{
  #omino-404{
    display: unset;
  }
}
}

</style>