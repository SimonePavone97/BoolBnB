<template>
  <div id="not-found">
    <div>
      <div id="not-found__text">
        <h2>Ops!</h2>
        <h3>Non troviamo la pagina che stai cercando.</h3>  
        <p>Codice errore: 404</p>
        <span>Ecco qualche link utile:</span>
        <ul>
          <li><span class="text-black" @click="$router.back()">Indietro</span></li>
          <li><router-link class="td-none text-black" :to="{name: 'home'}">Home</router-link></li>
        </ul>
      </div>
      <div id="omino-404">
        <img src="../../../../public/assets/img/404.png" alt="page not found">
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
// text decoration none
.td-none{text-decoration: none;}
.text-black{color: #000;}

#not-found{
  &__text{
    flex-basis: 60%;
    text-align: left;
    h2{font-size: 3.5rem;}
    h3{font-size: 1.5rem;}
    p{font-weight: bold;}
    ul{
      li{
        list-style-type: none;
        margin-left: -2em;
        text-decoration: none;
        color: #000;
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
    flex-basis: 40%;
  }
}

#not-found > div{
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>