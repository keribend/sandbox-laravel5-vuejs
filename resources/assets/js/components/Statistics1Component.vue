<template>
  <v-container>
    <v-layout row wrap align-center>
      <v-flex xs2>
        <v-btn color="primary" @click="statistics1">Bullet 1</v-btn>
      </v-flex>
      <v-flex xs2>
        <v-btn color="secondary" @click="statistics2">Bullet 2</v-btn>
      </v-flex>
      <v-flex xs2>
        <v-btn color="info" @click="statistics3">Bullet 3</v-btn>
      </v-flex>
      <v-flex xs2>
        <v-btn color="success" @click="statistics4">Bullet 4</v-btn>
      </v-flex>
      <v-flex xs2>
        <v-btn color="warning" @click="statistics5">Bullet 5</v-btn>
      </v-flex>
      <v-flex xs2>
        <v-btn color="danger" @click="statistics6">Bullet 6</v-btn>
      </v-flex>
    </v-layout>
    <v-layout row wrap align-center>
      <v-flex xs>
        <v-card flat height="450px">
          <v-card-text>
            <doughnut-chart v-if="loaded" :chart-data="data" :chart-labels="labels"></doughnut-chart>
          </v-card-text>
          <v-card-text text-justify v-if="lastRequestData == 'bullet5'">
            Average cars: {{ average }}
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
      url: '',
      average: 0,
      lastRequestData: 'bullet1'
    }
  },
  mounted() {
    this.requestData()
  },
  methods: {
    requestData () {
      this.loading = true
      this.loaded = false
        this.url = 'http://localhost:8000/api/pollingexecutions/stats/' + this.lastRequestData
        if (this.lastRequestData == 'bullet5') {
          axios.get(this.url)
            .then(response => {
              if (response.data && response.data.status) {
                this.average = response.data.average
              }
            })
            .catch(err => {
              this.errorMessage = err
              this.showError = true
            })
        } else {
          axios.get(this.url)
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
    },
    statistics1 () {
      this.lastRequestData = 'bullet1'
      this.requestData()
    },
    statistics2 () {
      this.lastRequestData = 'bullet2'
      this.requestData()
    },
    statistics3 () {
      this.lastRequestData = 'bullet3'
      this.requestData()
    },
    statistics4 () {
      this.lastRequestData = 'bullet4'
      this.requestData()
    },
    statistics5 () {
      this.lastRequestData = 'bullet5'
      this.requestData()
    },
    statistics6 () {
      this.lastRequestData = 'bullet6'
      this.requestData()
    }
  }
}
</script>