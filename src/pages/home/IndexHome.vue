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

    <q-page-container class="page-container row justify-center items-center">
      <q-page
        class="page-info column justify-center items-center"
        v-if="tasks.length === 0"
      >
        <img src="images/home/vector-1.svg" />
        <p>O que você quer fazer hoje?</p>
        <p>Toque em + para adicionar suas tarefas</p>
      </q-page>
    </q-page-container>

    <q-scroll-area
      style="height: 750px"
      :bar-style="barStyle"
      :thumb-style="thumbStyle"
    >
      <div class="page-info q-pa-lg q-gutter-md">
        <q-card class="bg-dark row" flat v-for="task in tasks" :key="task.id">
          <q-card-section
            @click="infoCard(task)"
            class="text-white q-py-sm col"
          >
            <span class="text-h6">{{ task.title }}</span>
            <div
              class="text-subtitle2 flex items-center justify-between q-pt-sm"
            >
              <span>{{ task.dateTime }}</span>
              <div class="flex q-gutter-sm">
                <q-badge :color="dynamicColor(task)">
                  <q-icon
                    :name="dynamicIcon(task)"
                    size="1.2rem"
                    class="q-mr-sm"
                  />
                  <label class="text-weight-medium">{{ task.tag }}</label>
                </q-badge>
                <q-badge outline class="badge-task q-pa-sm">
                  <q-icon
                    name="img:images/icons/flag.svg"
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
    </q-scroll-area>

    <q-footer class="bg-dark q-pa-md">
      <q-toolbar class="justify-center">
        <dialog-add-task-home></dialog-add-task-home>
      </q-toolbar>
    </q-footer>

    <q-dialog v-model="showModalTask">
      <q-card dark flat>
        <q-card-section class="row items-center q-pb-none">
          <span class="text-h6">{{ taskDialogInfo.title }}</span>
          <q-space />
          <q-btn icon="close" flat round dense v-close-popup />
        </q-card-section>

        <q-card-section>
          Tem certeza de que deseja excluir esta tarefa? Essa ação não poderá
          ser desfeita.
        </q-card-section>
        <q-card-actions align="right">
          <q-btn
            flat
            label="Sim, tenho certeza"
            color="primary"
            v-close-popup
            @click="deleteTask(taskDialogInfo.id)"
          />
          <q-btn flat label="Cancelar" color="primary" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </q-layout>
</template>

<script>
import DialogAddTaskHome from "../../components/home/DialogAddTaskHome.vue";
import { ref, nextTick } from "vue";
import { useQuasar } from "quasar";

export default {
  data() {
    return {
      q: useQuasar(),
      tasks: [],
      taskDialogInfo: null,
      shape: ref(false),
      showModalTask: false,
      thumbStyle: {
        right: "4px",
        borderRadius: "5px",
        backgroundColor: "#8875ff",
        width: "5px",
        opacity: 0.75,
      },
      barStyle: {
        right: "2px",
        borderRadius: "9px",
        backgroundColor: "#8875ff",
        width: "9px",
        opacity: 0.2,
      },
      categorieColors: {
        Mercado: "green-1",
        Trabalho: "red-1",
        Esporte: "blue-1",
        Projeto: "green-3",
        Universidade: "blue-2",
        Social: "red-2",
        Musica: "red-3",
        Saúde: "green-2",
        Filme: "blue-3",
        Casa: "red-4",
      },
      categorieIcons: {
        Mercado: "img:images/icons/task-categorys/food.svg",
        Trabalho: "img:images/icons/task-categorys/work.svg",
        Esporte: "img:images/icons/task-categorys/sport.svg",
        Projeto: "img:images/icons/task-categorys/design.svg",
        Universidade: "img:images/icons/task-categorys/university.svg",
        Social: "img:images/icons/task-categorys/social.svg",
        Música: "img:images/icons/task-categorys/music.svg",
        Saúde: "img:images/icons/task-categorys/health.svg",
        Filme: "img:images/icons/task-categorys/movie.svg",
        Casa: "img:images/icons/task-categorys/home.svg",
      },
    };
  },
  provide() {
    return {
      allTasks: this.tasks,
    };
  },
  components: {
    DialogAddTaskHome,
  },
  methods: {
    infoCard(task) {
      console.log(task);
      this.taskDialogInfo = task;
      this.showModalTask = true;
    },
    dynamicColor(task) {
      return this.categorieColors[task.tag] || "primary";
    },
    dynamicIcon(task) {
      // img:images/icons/flag.svg
      return this.categorieIcons[task.tag] || null;
    },
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
    },
    async deleteTask(idTask) {
      const userToken = localStorage.getItem("user");
      const response = await fetch(
        `https://makemerememberapi.azurewebsites.net/api/task/${idTask}/`,
        {
          method: "DELETE",
          headers: {
            Authorization: JSON.parse(userToken),
          },
        }
      );

      if (response.ok) {
        // Remova o item do DOM
        const indexToRemove = this.tasks.findIndex(
          (task) => task.id === idTask
        );
        if (indexToRemove !== -1) {
          this.tasks.splice(indexToRemove, 1);
        }

        this.q.notify({
          message: "Tarefa excluída com sucesso.",
          color: "positive",
          timeout: 2000,
          position: "top",
        });
      } else {
        const errorJson = await response.json();
        this.q.notify({
          message: `Erro ao excluir a tarefa: ${errorJson.msg}`,
          color: "negative",
          timeout: 2000,
          position: "top",
        });
      }
    },
  },
  mounted() {
    this.getTaks();
  },
};
</script>
