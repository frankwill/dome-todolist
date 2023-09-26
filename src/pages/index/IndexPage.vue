<template>
  <q-page class="start-container flex justify-center items-center">
    <div class="row flex justify-center items-center">
      <div class="col col-sm-6 col-md-6 flex justify-center items-center">
        <img
          alt="Quasar logo"
          src="/images/todo-logo.svg"
          style="width: 200px; height: 200px"
        />
        <h2 class="start-title">Bem-vindo ao UpTodo</h2>
        <p class="start-info text-center">
          Faça login em sua conta ou crie uma nova conta para continuar
        </p>
      </div>
    </div>

    <div class="row full-width">
      <div class="col">
        <q-btn
          to="/login"
          class="full-width q-mb-md"
          color="primary"
          label="Entrar"
        />
        <q-btn
          class="full-width"
          outline
          color="primary"
          label="Criar uma conta"
        />
      </div>
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "IndexPage",
});
</script>
