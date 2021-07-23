<template>
  <div>
    <h3>Liste des utilisateurs</h3>
    <div v-if="error">
      <p>Veuillez vous connecter pour avoir accès à la liste des utilisateurs</p>
      <v-btn depressed color="primary" @click="login">OK</v-btn>
    </div>
    <div v-else>
      <v-btn depressed color="error" @click="logout">Déconnexion</v-btn>
      <v-data-table
          :headers="headers"
          :items="users"
          :fixed-header="true"
          class="elevation-1"
      ></v-data-table>
    </div>
  </div>
</template>

<script>
import ApiCLient from "../../ApiClient";

export default {
  data() {
    return {
      error: false,
      headers: [
        { text: 'Email', value: 'email' },
        { text: 'Nom', value: 'lastname' },
        { text: 'Prénom', value: 'firstname' },
      ],
      users: [],
      usersCount: 0,
    }
  },
  beforeCreate() {
    ApiCLient.get('users')
    .then((response) => {
      this.users = response.data['hydra:member'];
      this.usersCount = response.data['hydra:totalItems'];
    })
    .catch((error) => {
        this.error = true;
    });
  },
  methods: {
    logout() {
      localStorage.setItem('token', null);
      this.$router.push({ name: 'home' });
    },
    login() {
      this.$router.push({ name: 'home' });
    }
  }
}
</script>