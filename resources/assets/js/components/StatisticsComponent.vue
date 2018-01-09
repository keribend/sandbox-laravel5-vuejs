<template>
  <v-tabs v-model="active">
    <v-tabs-bar class="blue" dark>
      <v-tabs-item ripple href="#tab-1">Item 1</v-tabs-item>
      <v-tabs-item ripple href="#tab-2">Item 2</v-tabs-item>
      <v-tabs-item ripple href="#tab-3">Item 3</v-tabs-item>
      <v-tabs-slider color="white"></v-tabs-slider>
    </v-tabs-bar>
    <v-tabs-items>
      <v-tabs-content id="tab-1">
        <v-card flat>
          <v-card-text>{{ text }}</v-card-text>
        </v-card>
      </v-tabs-content>
      <v-tabs-content id="tab-2">
        <v-card flat>
          <v-card-text>{{ text }}</v-card-text>
        </v-card>
      </v-tabs-content>
      <v-tabs-content id="tab-3">
        <v-card flat>
          <v-card-text>{{ text }}</v-card-text>
        </v-card>
      </v-tabs-content>
    </v-tabs-items>
  </v-tabs>
</template>

<script>
export default {
  data () {
    return {
      active: null,
      text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
    }
  }
}
</script>