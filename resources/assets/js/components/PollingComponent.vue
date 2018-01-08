<template>
  <v-stepper v-model="e1">
    <v-stepper-header>
      <v-stepper-step step="1" :complete="e1 > 1">Generics</v-stepper-step>
      <v-divider></v-divider>
      <v-stepper-step step="2" :complete="e1 > 2">Driving license</v-stepper-step>
      <v-divider></v-divider>
      <v-stepper-step step="3" :complete="e1 > 3">Driving experience</v-stepper-step>
      <v-divider></v-divider>
      <v-stepper-step step="4">Summary</v-stepper-step>
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
                  name="input-1-3"
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
              <v-radio label="Radio 1" value="radio-1"></v-radio>
              <v-radio label="Radio 2" value="radio-2"></v-radio>
            </v-radio-group>
            <v-layout row wrap align-center>
              <v-flex xs8>
                <v-subheader>Do you care about drifting?</v-subheader>
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
        <v-btn color="primary" @click.native="e1 = 4">Continue</v-btn>
      </v-stepper-content>
      <v-stepper-content step="4">
        <v-card class="mb-5" with="400px" height="400px"></v-card>
        <v-btn color="primary" @click.native="e1 = 4">Send</v-btn>
      </v-stepper-content>
    </v-stepper-items>
  </v-stepper>
</template>

<script>
  export default {
    data () {
      return {
        e1: 0,
        age: 0,
        drivingLicenseOwned: false,
        drivetrain: "FWD",
        drivetrains: ["FWD", "RWD", "I don't know"],
        genders: ["F", "M","Other"],
        gender: "M"
      }
    },
    methods: {
      checkStep1: function () {
        if (this.age < 18) {
          this.e1 = 4
        } else {
          this.e1 = 2
        }
      },
      checkStep2: function () {
        if (!this.drivingLicenseOwned) {
          this.e1 = 4
        } else {
          this.e1 = 3
        }
      }
    }
  }
</script>
