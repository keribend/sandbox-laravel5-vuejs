<template>
  <v-container>
    <v-layout row wrap align-center>
      <v-flex xs>
        <v-card flat height="500px">
          <v-card-text>
            <doughnut-chart></doughnut-chart>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import DoughnutChart from './data/DoughnutChart.vue'

export default {
  components: {
    DoughnutChart
  },
  data () {
    return {
      active: null,
      text: ''
    }
  }
}
</script>