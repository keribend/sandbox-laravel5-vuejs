<template>
  <v-stepper v-model="step">
    <v-stepper-header>
      <v-stepper-step step="1" :complete="step > 1">Generics</v-stepper-step>
      <v-divider></v-divider>
      <v-stepper-step step="2" :complete="step > 2">License</v-stepper-step>
      <v-divider></v-divider>
      <v-stepper-step step="3" :complete="step > 3">Interests</v-stepper-step>
      <v-divider></v-divider>
      <v-stepper-step step="4" :complete="step > 4">Experiences</v-stepper-step>
      <v-divider></v-divider>
      <v-stepper-step step="5">Summary</v-stepper-step>
    </v-stepper-header>
    <v-stepper-items>
      <v-stepper-content step="1">
        <v-card class="mb-5" with="400px" height="400px">
          <v-container fluid>
            <v-layout row wrap align-center>
              <v-flex xs4>
                <v-subheader>Your age</v-subheader>
              </v-flex>
              <v-flex xs8>
                <v-text-field
                  label="Age"
                  v-model="age"
                  :min="0"
                  :max="100"
                  type="number"
                  mask="###"
                  single-line
                ></v-text-field>
              </v-flex>
            </v-layout>
            <v-layout row wrap align-center>
              <v-flex xs4>
                <v-subheader>Gender</v-subheader>
              </v-flex>
              <v-flex xs8>
                <v-select
                  :items="genders"
                  v-model="gender"
                  label="Select"
                  single-line
                  bottom
                ></v-select>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card>
        <v-btn color="primary" @click.native="checkStep1">Continue</v-btn>
      </v-stepper-content>
      <v-stepper-content step="2">
        <v-card class="mb-5" with="400px" height="400px">
          <v-container fluid>
            <v-layout row wrap align-center>
              <v-flex xs8>
                <v-subheader>Do you own a car driving license?</v-subheader>
              </v-flex>
              <v-flex xs4>
                <v-checkbox
                  v-bind:label="`${(drivingLicenseOwned) ? 'Yes' : 'No' }`"
                  v-model="drivingLicenseOwned"
                  hide-details
                ></v-checkbox>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card>
        <v-btn color="primary" @click.native="checkStep2">Continue</v-btn>
      </v-stepper-content>
      <v-stepper-content step="3">
        <v-card class="mb-5" with="400px" height="400px">
          <v-container fluid>
            <v-layout row wrap align-center>
              <v-flex xs12>
                <v-subheader>Which drivetrain do you prefer?</v-subheader>
              </v-flex>
            </v-layout>
            <v-radio-group v-model="drivetrain" :mandatory="true" row>
              <v-radio label="FWD" value="FWD"></v-radio>
              <v-radio label="RWD" value="RWD"></v-radio>
              <v-radio label="I don't know" default></v-radio>
            </v-radio-group>
            <v-layout row wrap align-center>
              <v-flex xs8>
                <v-subheader>Do you care about drifting?</v-subheader>
              </v-flex>
              <v-flex xs4>
                <v-checkbox
                  v-bind:label="`${(drifting) ? 'Yes' : 'No' }`"
                  v-model="drifting"
                  hide-details
                ></v-checkbox>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card>
        <v-btn color="primary" @click.native="step = 4">Continue</v-btn>
      </v-stepper-content>
      <v-stepper-content step="4">
        <v-card class="mb-5" with="400px" height="400px">
          <v-container fluid>
            <v-layout row wrap align-center>
              <v-flex xs12>
                <v-subheader>Insert model names you have driven:</v-subheader>
              </v-flex>
            </v-layout>
            <v-layout row wrap align-center>
              <v-flex xs10>
                <v-text-field
                  v-model="newCar"
                  :rules="[ carNameValidateCheck || !carNameExistCheck ]"
                  label="Inser a BMW model name"
                ></v-text-field>
              </v-flex>
              <v-flex xs2>
                <v-btn color="primary" @click="addCar">+</v-btn>
              </v-flex>
            </v-layout>
            <v-layout row wrap align-center>
              <v-flex xs12>
                <v-list>
                  <v-list-tile avatar v-for="car in cars" v-bind:key="car.name" @click="">
                    <v-list-tile-content>
                      <v-list-tile-title v-text="car.name"></v-list-tile-title>
                    </v-list-tile-content>
                  </v-list-tile>
                </v-list>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card>
        <v-btn color="primary" @click.native="step = 5">Continue</v-btn>
      </v-stepper-content>
      <v-stepper-content step="5">
        <v-card class="mb-5" with="400px" height="400px"></v-card>
        <v-btn color="primary" @click.native="step = 5">Send</v-btn>
      </v-stepper-content>
    </v-stepper-items>
  </v-stepper>
</template>

<script>
  export default {
    data () {
      return {
        step: 0,
        age: 0,
        drivingLicenseOwned: false,
        drivetrain: "FWD",
        drivetrains: ["FWD", "RWD"],
        drifting: false,
        genders: ["F", "M","Other"],
        gender: "M",
        cars: [],
        newCar: '',
        carNamePattern: /^(M?[0-9]{3}(d|i)?)$|(^(X|Z)[0-9]$)/i
      }
    },
    methods: {
      checkStep1: function () {
        if (this.age < 18) {
          this.step = 5
        } else {
          this.step = 2
        }
      },
      checkStep2: function () {
        if (!this.drivingLicenseOwned) {
          this.step = 5
        } else {
          this.step = 3
        }
      },
      carNameValidateCheck: function () {
        if (!this.newCar.match(this.carNamePattern)) {
          return ['Model name is incorrect.']
        }
        return ['']
      },
      carNameExistCheck: function (newCar) {
        if (this.cars.some(function (car) { return car.name == newCar })) {
          return ['Model name already present.']
        }
        return ['']
      },
      addCar: function () {
        if (this.carNameValidateCheck() && !this.carNameExistCheck(this.newCar)) {
          this.cars.push({name: this.newCar})
          this.newCar = ''
        }
      }
    }
  }
</script>
