<style>
.error {
  color: red;
}
</style>
<template>
  <div>
    <v-card
        class="mx-auto my-12"
        max-width="374"
    >
      <template slot="progress">
        <v-progress-linear
            color="deep-purple"
            height="10"
            indeterminate
        ></v-progress-linear>
      </template>


      <v-card-title>Se connecter</v-card-title>


      <v-divider class="mx-4"></v-divider>


      <v-card-text>
        <v-form name="login" @submit.prevent="login">
          <v-text-field label="Email" v-model="email" id="email" name="email" type="email"></v-text-field>
          <v-text-field label="Mot de passe" v-model="password" id="password" name="password" type="password"></v-text-field>
          <div v-if="error" class="error">{{ error }}</div>
        </v-form>
      </v-card-text>

      <v-card-actions>
        <v-btn
            color="primary"
            text
            @click="login"
        >
          Me connecter
        </v-btn>
      </v-card-actions>
    </v-card>


  </div>
</template>

<script>
import ApiCLient from "../ApiClient";

export default {
  name: 'Home',
  data() {
    return {
      email: '',
      password: '',
      error: null,
    }
  },
  methods: {
    login() {
      // Reset errors
      this.error = null;

      ApiCLient.post('login_check', {
        email: this.email,
        password: this.password,
      })
      .then((response) => {
        localStorage.setItem('token', response.data.token);
        this.$router.push({ name: 'userIndex' });
      })
      .catch((error) => {
        if (error.response.status === 401) {
          this.error = 'Email ou mot de passe invalide !';
        } else {
          this.error = 'Oops, something went wrong on our end ! Please try again later !';
        }
      });
    }
  }
}
</script>