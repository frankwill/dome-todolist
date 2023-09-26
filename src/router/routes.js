const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      { path: "", component: () => import("pages/index/IndexPage.vue") },
      { path: "/login", component: () => import("pages/login/IndexLogin.vue") },
      {
        path: "/register",
        component: () => import("pages/register/IndexRegister.vue"),
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
