<template>
  <div class="container">
    <div class="row row-cols-1 row-cols-md-2 g-3">
      <div class="col">
        <CotacaoCadastro @atualizar="onAtualizar" />
      </div>

      <div class="col">
        <CotacaoConsulta />
      </div>
    </div>
    <main class="container">
      <CotacaoLista ref="childLista" />
    </main>
  </div>
</template>
<script>
import CotacaoCadastro from "./CotacaoCadastro.vue";
import CotacaoConsulta from "./CotacaoConsulta.vue";
import CotacaoLista from "./CotacaoLista.vue";
export default {
  methods: {
    onAtualizar(value) {
      console.log("atualizar", value);
      this.$refs.childLista.onAtualizar();
    },
  },
  components: {
    CotacaoCadastro,
    CotacaoConsulta,
    CotacaoLista,
  },
};
</script>
<style lang="scss">
</style>
