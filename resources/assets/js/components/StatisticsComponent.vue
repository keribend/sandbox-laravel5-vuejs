<template>
  <v-container>
    <v-layout row wrap align-center>
      <v-flex xs>
        <v-tabs v-model="active">
          <v-tabs-bar class="blue" dark>
            <v-tabs-item ripple href="#tab-1">Item 1</v-tabs-item>
            <v-tabs-item ripple href="#tab-2">Item 2</v-tabs-item>
            <v-tabs-item ripple href="#tab-3">Item 3</v-tabs-item>
            <v-tabs-slider color="white"></v-tabs-slider>
          </v-tabs-bar>
          <v-tabs-items>
            <v-tabs-content id="tab-1">
              <v-card flat height="500px">
                <v-card-text>
                  <line-chart></line-chart>
                </v-card-text>
              </v-card>
            </v-tabs-content>
            <v-tabs-content id="tab-2">
              <v-card flat height="500px">
                <v-card-text>{{ text }}</v-card-text>
              </v-card>
            </v-tabs-content>
            <v-tabs-content id="tab-3">
              <v-card flat height="500px">
                <v-card-text>{{ text }}</v-card-text>
              </v-card>
            </v-tabs-content>
          </v-tabs-items>
        </v-tabs>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import LineChart from './data/LineChart.vue'

export default {
  components: {
    LineChart
  },
  data () {
    return {
      active: null,
      text: ''
    }
  }
}
</script>