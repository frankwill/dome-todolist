<!-- INDEXLOGIN -->
<template>
  <ReturnPage return-to="/" />

  <h2 class="text-h4 q-pa-lg text-weight-bold">Conecte-se</h2>

  <div class="row flex justify-center items-center">
    <div class="col-10">
      <q-form @submit.prevent="onSubmit" class="form-container">
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
        <base-button
          class="full-width q-mb-md q-mt-xl"
          title="Entrar"
          type="submit"
        ></base-button>
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

import { useQuasar } from "quasar";

export default defineComponent({
  components: {
    LoginWithGoogle,
  },
  data() {
    return {
      q: useQuasar(),
      username: ref(""),
      password: ref(""),
    };
  },
  methods: {
    async onSubmit() {
      const options = {
        method: "POST",
        headers: {
          "Content-Type": "application/json;charset=utf-8",
        },
        body: JSON.stringify({
          username: this.username,
          password: this.password,
        }),
      };

      const response = await fetch(
        "https://makemerememberapi.azurewebsites.net/api/login/",
        options
      );

      const responseJson = await response.json();
      if (responseJson.access) {
        localStorage.setItem("user", JSON.stringify(responseJson.access));
        this.$router.push("/home");
      } else {
        let customError = responseJson.detail;
        customError = "Usuário ou senha inválidos.";
        this.q.notify({
          message: customError,
          color: "negative",
          timeout: 2000,
          position: "top",
        });
      }
    },
  },
});
</script>
