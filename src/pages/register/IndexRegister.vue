<template>
  <ReturnPage return-to="/login" />

  <h2 class="text-h4 q-pa-lg text-weight-bold">Registrar-se</h2>

  <div class="row flex justify-center items-center">
    <div class="col-10">
      <q-form
        @submit.prevent="onRegister"
        class="form-container"
        ref="registerForm"
      >
        <label class="text-h6" for="">Usuário</label>
        <q-input
          v-model="username"
          class="q-pb-md q-pt-sm"
          outlined
          bg-color="dark"
          color="primary"
          placeholder="Entre com o seu usuário"
          :rules="[
            (val) => (val && val.length > 0) || 'Campo Usuário é obrigatório!',
          ]"
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
          :rules="[
            (val) => (val && val.length > 0) || 'Campo Senha é obrigatório!',
          ]"
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
          :rules="[
            (val) =>
              (val && val.length > 0 && val === this.password) ||
              'Senhas não coincidem!',
          ]"
        />
        <q-btn
          class="full-width q-mb-md q-mt-xl"
          color="primary"
          type="submit"
          label="Registrar"
          :disabled="!isComplete"
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
import { useQuasar } from "quasar";
import LoginWithGoogle from "src/components/LoginWithGoogle.vue";

export default defineComponent({
  components: {
    LoginWithGoogle,
  },
  data() {
    return {
      q: useQuasar(),
      registerForm: ref(null),
      username: ref(null),
      password: ref(null),
      confirmPassword: ref(null),
      isDisabled: true,
    };
  },
  computed: {
    isComplete() {
      return (
        this.username && this.password && this.confirmPassword === this.password
      );
    },
  },
  methods: {
    async onRegister() {
      this.q.loading.show({
        spinnerColor: "primary",
      });

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
        "https://makemerememberapi.azurewebsites.net/api/register/",
        options
      );

      const responseJson = await response.json();

      if (response.status === 200 || response.status === 201) {
        this.q.notify({
          message: responseJson.msg,
          color: "positive",
          timeout: 2000,
          position: "top",
        });
      } else {
        this.q.notify({
          message: responseJson.msg,
          color: "negative",
          timeout: 2000,
          position: "top",
        });
      }

      this.username = "";
      this.password = "";
      this.confirmPassword = "";

      this.$refs.registerForm.reset();

      this.q.loading.hide();
    },
  },
});
</script>
