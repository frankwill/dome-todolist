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
    <div class="full-width">
      <base-button title="Entrar" page="/login"></base-button>
      <base-button
        title="Criar uma conta"
        page="/register"
        outline
      ></base-button>
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "IndexPage",
});
</script>
