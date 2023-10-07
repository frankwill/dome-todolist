<template>
  <ReturnPage return-to="/" />

  <h2 class="text-h4 q-pa-lg text-weight-bold">Conecte-se</h2>

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
        />
        <label class="text-h6" for="">Senha</label>
        <q-input
          v-model="password"
          class="q-pt-sm"
          outlined
          type="password"
          hide-bottom-space
          bg-color="dark"
          color="primary"
          placeholder="Entre com a sua senha"
        />
        <q-btn
          to="/home"
          class="full-width q-mb-md q-mt-xl"
          color="primary"
          label="Entrar"
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
      <span>Não possui uma conta?</span>
      <q-btn
        flat
        color="primary"
        to="/register"
        label="Registre-se"
        no-caps
        class="btn-register"
      />
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { ref } from "vue";
import LoginWithGoogle from "src/components/LoginWithGoogle.vue";

export default defineComponent({
  components: {
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
