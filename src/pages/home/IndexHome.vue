<template>
  <q-layout>
    <q-header class="header-container q-pa-sm">
      <q-toolbar class="row justify-between items-center content-center">
        <q-btn flat round icon="filter_list" />
        <q-toolbar-title shrink>Índice</q-toolbar-title>
        <q-avatar>
          <img src="images/home/profile-default.png" />
        </q-avatar>
      </q-toolbar>
    </q-header>

    <q-page-container class="row justify-center items-center">
      <q-page class="page-info column justify-center items-center">
        <img src="images/home/vector-1.svg" />
        <p>O que você quer fazer hoje?</p>
        <p>Toque em + para adicionar suas tarefas</p>
      </q-page>
    </q-page-container>

    <q-footer class="bg-dark q-pa-md">
      <q-toolbar class="justify-center">
        <dialog-add-task-home></dialog-add-task-home>
      </q-toolbar>
    </q-footer>
  </q-layout>
</template>

<script>
import DialogAddTaskHome from "../../components/home/DialogAddTaskHome.vue";

export default {
  components: {
    DialogAddTaskHome,
  },
  methods: {
    async getTaks() {
      const userToken = localStorage.getItem("user");

      const response = await fetch(
        "https://makemerememberapi.azurewebsites.net/api/task/",
        {
          headers: {
            Authorization: JSON.parse(userToken),
          },
        }
      );

      const responseJson = await response.json();
      console.log(responseJson);
    },
  },
  created() {
    this.getTaks();
  },
};
</script>
