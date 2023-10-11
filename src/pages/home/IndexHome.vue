<template>
  <q-layout>
    <q-header class="header-container q-pa-sm">
      <q-toolbar class="row justify-between items-center content-center">
        <q-btn flat round icon="filter_list" />
        <q-toolbar-title shrink>Índice</q-toolbar-title>
        <q-avatar>
          <img src="images/home/profile-default.png" />
        </q-avatar>
      </q-toolbar>
    </q-header>

    <q-page-container class="row justify-center items-center">
      <q-page class="page-info column justify-center items-center">
        <img src="images/home/vector-1.svg" />
        <p>O que você quer fazer hoje?</p>
        <p>Toque em + para adicionar suas tarefas</p>
      </q-page>
    </q-page-container>

    <q-footer class="bg-dark q-pa-md">
      <q-toolbar class="justify-center">
        <q-btn class="footer-btn" color="primary" size="lg" round disable>
          <q-icon size="1.5rem" name="add" />
        </q-btn>
        <q-tooltip anchor="top middle" self="bottom middle" :offset="[10, 60]">
          Em construção...🔥
        </q-tooltip>
      </q-toolbar>
    </q-footer>
  </q-layout>
</template>

<script>
export default {};
</script>
