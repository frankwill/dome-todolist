// ARQUIVO DE COMPONENTES GLOBAIS
import ReturnPage from "../components/ReturnPage.vue";
import SeparatorLine from "../components/SeparatorLine.vue";

export default ({ app }) => {
  app.component("ReturnPage", ReturnPage);
  app.component("SeparatorLine", SeparatorLine);
};
