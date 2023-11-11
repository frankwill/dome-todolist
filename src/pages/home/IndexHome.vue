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
      <q-page
        class="page-info column justify-center items-center"
        v-if="tasks.length === 0"
      >
        <img src="images/home/vector-1.svg" />
        <p>O que você quer fazer hoje?</p>
        <p>Toque em + para adicionar suas tarefas</p>
      </q-page>
    </q-page-container>

    <div class="page-info q-pa-lg">
      <q-card class="bg-dark row" flat v-for="task in tasks" :key="task.id">
        <q-radio v-model="shape" value="line" />
        <q-card-section class="text-white q-py-sm col">
          <span class="text-h6">{{ task.title }}</span>
          <div class="text-subtitle2 flex items-center justify-between q-pt-sm">
            <span>Hoje às 16h45</span>
            <div class="flex q-gutter-sm">
              <q-badge class="badge-task-university">
                <q-icon
                  name="img:images/icons/task-categorys/university.svg"
                  color="white"
                  size="1.2rem"
                  class="q-mr-sm"
                />
                <label class="badge-text">{{ task.tag }}</label>
              </q-badge>
              <q-badge outline class="badge-task q-pa-sm">
                <q-icon
                  name="img:images/icons/flag.svg"
                  color="white"
                  size="1.2rem"
                  class="q-mr-sm"
                />
                <label class="badge-text">{{ task.priority }}</label>
              </q-badge>
            </div>
          </div>
        </q-card-section>
      </q-card>
    </div>

    <q-footer class="bg-dark q-pa-md">
      <q-toolbar class="justify-center">
        <dialog-add-task-home></dialog-add-task-home>
      </q-toolbar>
    </q-footer>
  </q-layout>
</template>

<script>
import DialogAddTaskHome from "../../components/home/DialogAddTaskHome.vue";
import { ref } from "vue";

export default {
  data() {
    return {
      tasks: [],
      shape: ref(false),
    };
  },
  components: {
    DialogAddTaskHome,
  },
  methods: {
    async getTaks() {
      const userToken = localStorage.getItem("user");

      const response = await fetch(
        "https://makemerememberapi.azurewebsites.net/api/tasks/",
        {
          headers: {
            Authorization: JSON.parse(userToken),
          },
        }
      );

      const responseJson = await response.json();
      responseJson.map((task) => this.tasks.push(task));
      console.log(this.tasks);
    },
  },
  created() {
    this.getTaks();
  },
};
</script>
