<template>
  <q-btn :to="page" class="full-width q-mb-md" color="primary" :label="title" />
</template>

<script>
export default {
  props: ["page", "title"],
};
</script>
