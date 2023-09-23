<template>
  <q-layout view="lHh Lpr lFf">
    <!-- <EssentialLink
      v-for="link in essentialLinks"
      :key="link.title"
      v-bind="link"
    /> -->

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from "vue";
// import EssentialLink from "components/EssentialLink.vue";

export default defineComponent({
  name: "MainLayout",
});
</script>
