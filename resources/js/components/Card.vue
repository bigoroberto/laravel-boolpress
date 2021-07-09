<template>
  <div class="card mb-3">

    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h5 class="card-title">{{ title }}</h5>
        <span class="badge badge-success custom-badge">{{category}}</span>
      </div>
      <i>{{ date }}</i>
      <p class="card-text">{{ truncateTex }}</p>    <!-- content con quello che abbiamo scritto a riga 23, mostrerà al massimo 150 caratteri  -->
      <router-link class="btn btn-primary" :to="{ name: 'postDetail', params:{ slug } }">Vedi post</router-link>
    </div>

  </div>
</template>

<script>
export default {
  name: "Card",
  props:['title','category','date','content','slug'],
  data(){
      return{
          maxLengthText:150,
      }
  },
  computed:{   /*le computed sono una funzione che vengono attivate nel momento in cui viene modificata una delle variabili in essa contenuta e devono avere per forza un ritorno*/
      truncateTex(){
          let text = this.content;
          if(text.length > this.maxLengthText){
              text = text.substr(0, this.maxLengthText) + '...';
          }
          return text;
      }
  }
};
</script>

<style>
.custom-badge{
    display: inline-block;
    height: 2rem;
    line-height: 2rem;
}
</style>
