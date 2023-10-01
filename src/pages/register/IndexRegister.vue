<template>
  <ReturnPage return-to="/login" />

  <h2 class="text-h4 q-pa-lg text-weight-bold">Registrar-se</h2>

  <div class="row flex justify-center items-center">
    <div class="col-10">
      <q-form class="form-container">
        <label class="text-h6" for="">Usuário</label>
        <q-input
          v-model="username"
          class="q-pb-md q-pt-sm"
          outlined
          bg-color="dark"
          color="primary"
          placeholder="Entre com o seu usuário"
        />
        <label class="text-h6" for="">Senha</label>
        <q-input
          v-model="password"
          class="q-pt-sm q-pb-md"
          outlined
          type="password"
          bg-color="dark"
          color="primary"
          placeholder="Entre com a sua senha"
        />
        <label class="text-h6" for="">Confirmar senha</label>
        <q-input
          v-model="confirmPassword"
          class="q-pt-sm"
          outlined
          type="password"
          bg-color="dark"
          color="primary"
          placeholder="Confirme sua senha"
        />
        <q-btn
          to="/login"
          class="full-width q-mb-md q-mt-xl"
          color="primary"
          label="Registrar"
        />
      </q-form>
    </div>
  </div>

  <SeparatorLine />

  <LoginWithGoogle />

  <div
    class="login-link-container row flex justify-center items-center text-center"
  >
    <div class="col-12">
      <span>Já possui uma conta? </span>
      <q-btn
        flat
        color="primary"
        to="/login"
        label="Faça login!"
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
      confirmPassword: ref(""),
    };
  },
});
</script>
