<template>
  <q-btn
    class="footer-btn"
    color="primary"
    size="lg"
    round
    @click="showDialogAddTask"
  >
    <q-icon size="1.5rem" name="add" />
  </q-btn>
  <q-form class="form-container">
    <q-dialog v-model="dialog" :position="position">
      <q-card style="width: 350px" dark flat>
        <q-card-section class="bg-dark row items-center no-wrap">
          <div class="col-12">
            <span class="text-weight-bold">Adicionar tarefa</span>
            <div>
              <q-input
                class="q-pt-sm"
                outlined
                color="primary"
                label-color="white"
                placeholder="Arrumar o quarto"
                v-model="enteredTitle"
                :rules="[
                  (val) =>
                    (val && val.length > 0) ||
                    'O Titulo da taréfa é obrigatório.',
                ]"
              />
              <q-input
                class="q-pt-sm"
                outlined
                color="primary"
                label-color="white"
                placeholder="Descrição"
                v-model="enteredDesc"
              />
            </div>
          </div>
        </q-card-section>

        <q-card-actions align="right" class="row justify-between">
          <div class="row q-gutter-md q-pl-sm">
            <q-btn
              flat
              color="primary"
              icon="img:images/icons/timer.svg"
              padding="0"
            />
            <q-btn
              flat
              color="primary"
              icon="img:images/icons/tag.svg"
              padding="0"
              @click="showDialogChooseCategory"
            >
              <q-badge v-show="!nameCategorie" floating color="red" rounded />
            </q-btn>
            <q-btn
              flat
              color="primary"
              icon="img:images/icons/flag.svg"
              padding="0"
            />
          </div>
          <q-btn
            flat
            color="primary"
            v-close-popup
            icon="img:images/icons/send.svg"
            type="submit"
            @click="addTasks"
            :disable="!isComplete"
          />
        </q-card-actions>
      </q-card>
    </q-dialog>

    <q-dialog
      v-model="dialogChooseCategory"
      persistent
      transition-show="scale"
      transition-hide="scale"
    >
      <q-card class="bg-dark text-white" style="width: 300px">
        <q-card-section>
          <div class="text-h6 text-center">Escolher categoria</div>
          <q-separator color="white" />
        </q-card-section>

        <q-card-section class="q-pt-none">
          <div class="row justify-between q-gutter-lg">
            <div
              class="flex column q-gutter-xs items-center"
              v-for="categorie in categorieButtons"
              :key="categorie.id"
            >
              <q-btn
                padding="md"
                :color="categorie.color"
                :icon="categorie.icon"
                @click="setCategorie(categorie.name)"
              />
              <label
                :rules="[
                  (val) =>
                    (val && val.length > 0) ||
                    'É necessário vincular a taréfa a alguma tag.',
                ]"
                >{{ categorie.name }}</label
              >
            </div>
          </div>
        </q-card-section>

        <q-card-actions align="right" class="dark text-teal">
          <q-btn flat label="OK" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </q-form>
</template>

<script>
import { ref } from "vue";

export default {
  data() {
    return {
      dialog: false,
      dialogChooseCategory: false,
      position: "bottom",
      enteredTitle: ref(""),
      enteredDesc: ref(""),
      nameCategorie: ref(""),
      categorieButtons: [
        {
          id: 0,
          color: "green-1",
          icon: "img:images/icons/task-categorys/food.svg",
          name: "Mercado",
        },
        {
          id: 1,
          color: "red-1",
          icon: "img:images/icons/task-categorys/work.svg",
          name: "Trabalho",
        },
        {
          id: 2,
          color: "blue-1",
          icon: "img:images/icons/task-categorys/sport.svg",
          name: "Esporte",
        },
        {
          id: 3,
          color: "green-3",
          icon: "img:images/icons/task-categorys/design.svg",
          name: "Projeto",
        },
        {
          id: 4,
          color: "blue-2",
          icon: "img:images/icons/task-categorys/university.svg",
          name: "Universidade",
        },
        {
          id: 5,
          color: "red-2",
          icon: "img:images/icons/task-categorys/social.svg",
          name: "Social",
        },
        {
          id: 6,
          color: "red-3",
          icon: "img:images/icons/task-categorys/music.svg",
          name: "Música",
        },
        {
          id: 7,
          color: "green-2",
          icon: "img:images/icons/task-categorys/health.svg",
          name: "Saúde",
        },
        {
          id: 8,
          color: "blue-3",
          icon: "img:images/icons/task-categorys/movie.svg",
          name: "Filme",
        },
        {
          id: 8,
          color: "red-1",
          icon: "img:images/icons/task-categorys/home.svg",
          name: "Casa",
        },
      ],
    };
  },
  computed: {
    isComplete() {
      return this.enteredTitle && this.nameCategorie;
    },
  },
  methods: {
    showDialogAddTask() {
      this.dialog = true;
    },
    showDialogChooseCategory() {
      this.dialogChooseCategory = true;
    },
    setCategorie(categorieName) {
      this.nameCategorie = categorieName;
    },
    async addTasks() {
      const userToken = localStorage.getItem("user");

      const responseObject = {
        method: "POST",
        headers: {
          "Content-Type": "application/json;charset=utf-8",
          Authorization: JSON.parse(userToken),
        },
        body: JSON.stringify({
          title: this.enteredTitle,
          content: this.enteredDesc,
          tag: this.nameCategorie,
          priority: 1,
          url: "https://www.google.com.br",
          completed: false,
        }),
      };

      const response = await fetch(
        "https://makemerememberapi.azurewebsites.net/api/task/add/",
        responseObject
      );
      const responseJson = await response.json();

      console.log(responseJson);
      console.log("Enviou");
    },
  },
};
</script>
