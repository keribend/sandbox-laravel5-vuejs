<template>
  <v-app dark>
    <v-navigation-drawer
      clipped
      fixed
      v-model="drawer"
      app
    >
      <v-list dense>
        <v-list-tile to="/pollings" @click="">
          <v-list-tile-action>
            <v-icon>question_answer</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>
              Pollings
            </v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile to="/statistics1" @click="">
          <v-list-tile-action>
            <v-icon>show_chart</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>
              Statistics 1
            </v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile to="/statistics2" @click="">
          <v-list-tile-action>
            <v-icon>show_chart</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>
              Statistics 2
            </v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile to="/statistics3" @click="">
          <v-list-tile-action>
            <v-icon>show_chart</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>
              Statistics 3
            </v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar app fixed clipped-left>
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title>Preeo Software</v-toolbar-title>
    </v-toolbar>
    <v-content>
      <v-container fluid fill-height>
        <v-layout justify-center align-center>
          <router-view></router-view>
        </v-layout>
      </v-container>
    </v-content>
    <v-footer app fixed>
      <span>&copy; 2018 - Neil Marvin Nicotra</span>
    </v-footer>
  </v-app>
</template>

<script>
  export default {
    data: () => ({
      drawer: true
    })
  }
</script>
