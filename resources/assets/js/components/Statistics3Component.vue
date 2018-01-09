<template>
  <v-container>
    <v-layout row wrap align-center>
      <v-flex xs>
        <v-card flat height="500px">
          <v-card-text>
            <doughnut-chart v-if="loaded" :chart-data="data" :chart-labels="labels"></doughnut-chart>
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
      loaded: false,
      loading: false,
      rawData: '',
      data: [],
      labels: [],
      showError: false,
      showSettings: false,
      errorMessage: '',
      url: ''
    }
  },
  mounted() {
    this.requestData()
  },
  methods: {
    requestData () {
      this.loading = true
      this.loaded = false
        this.url = 'http://localhost:8000/api/pollingexecutions/stats/bullet3'
        axios.get('http://localhost:8000/api/pollingexecutions/stats/bullet3')
          .then(response => {
            if (response.data && response.data.status) {
              this.rawData = response.data.data
              this.data = response.data.data.map(entry => entry.data)
              this.labels = response.data.data.map(entry => entry.label)
              this.loaded = true
              this.loading = false
            }
          })
          .catch(err => {
            this.errorMessage = err
            this.showError = true
          })
    }
  }
}
</script>