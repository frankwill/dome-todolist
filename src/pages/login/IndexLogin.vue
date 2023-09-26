<template>
  <div class="row">
    <q-btn
      to="/"
      flat
      class="q-pa-none"
      color="primary"
      icon="chevron_left"
      label="Voltar"
    />
  </div>
  <h2 class="text-h4 q-pa-lg text-weight-bold">Login</h2>

  <div class="row flex justify-center items-center">
    <div class="col-10">
      <q-form class="form-container">
        <label class="text-h6" for="">Usuário</label>
        <q-input
          v-model="username"
          class="q-pb-lg q-pt-sm"
          outlined
          bg-color="dark"
          color="primary"
          placeholder="Entre com o seu usuário"
          hide-bottom-space="true"
        />
        <label class="text-h6" for="">Senha</label>
        <q-input
          v-model="password"
          class="q-pt-sm"
          outlined
          type="password"
          bg-color="dark"
          color="primary"
          placeholder="Entre com a sua senha"
          hide-bottom-space="true"
        />
        <q-btn
          to="/login"
          class="full-width q-mb-md q-mt-xl"
          size="lg"
          color="primary"
          label="Entrar"
          no-caps
        />
      </q-form>
    </div>
  </div>

  <SeparatorLine />

  <LoginWithGoogle />

  <div
    class="register-container row flex justify-center items-center text-center"
  >
    <div class="col-12">
      <span
        >Não possui uma conta?
        <a href="" class="register-link">Registre-se</a></span
      >
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { ref } from "vue";
import SeparatorLine from "src/components/SeparatorLine.vue";
import LoginWithGoogle from "src/components/LoginWithGoogle.vue";

export default defineComponent({
  components: {
    SeparatorLine,
    LoginWithGoogle,
  },
  data() {
    return {
      username: ref(""),
      password: ref(""),
    };
  },
});
</script>
