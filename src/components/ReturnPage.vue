<template>
  <div class="row">
    <q-btn
      :to="returnTo"
      flat
      class="q-pa-none"
      color="primary"
      icon="chevron_left"
      label="Voltar"
    />
  </div>
</template>

<script>
export default {
  props: ["returnTo"],
};
</script>
