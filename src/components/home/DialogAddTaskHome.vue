<template>
  <q-btn class="footer-btn" color="primary" size="lg" round @click="addTask">
    <q-icon size="1.5rem" name="add" />
  </q-btn>
  <q-form class="form-container">
    <q-dialog v-model="dialog" :position="position">
      <q-card style="width: 350px" dark flat>
        <q-card-section class="row items-center no-wrap">
          <div class="col-12">
            <span class="text-weight-bold">Adicionar tarefa</span>
            <q-input
              class="q-pt-sm"
              outlined
              color="primary"
              label-color="white"
              placeholder="Arrumar o quarto"
            />
            <q-input
              class="q-pt-sm"
              outlined
              color="primary"
              label-color="white"
              placeholder="Descrição"
            />
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
            />
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
          />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </q-form>
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      position: "bottom",
    };
  },
  methods: {
    addTask() {
      this.dialog = true;
    },
  },
};
</script>
