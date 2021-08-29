<template>
  <div class="mt-5">
    <div v-if="loading" class="spinner-border text-danger" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
    <table v-if="!loading" class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">UF</th>
          <th scope="col">Percentual Frete</th>
          <th scope="col">Valor Taxa</th>
          <th scope="col">Transportadora</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="cotacao of cotacoes" :key="cotacao.id">
          <th scope="row">{{ cotacao.id }}</th>
          <td>{{ cotacao.uf }}</td>
          <td>{{ cotacao.percentual_cotacao }}</td>
          <td>{{ cotacao.valor_extra }}</td>
          <td>{{ cotacao.transportadora_id }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import Cotacao from "@/services/cotacao";
export default {
  data() {
    return {
      loading: true,
      cotacoes: [],
    };
  },
  mounted() {
    this.onAtualizar();
  },
  methods: {
    onAtualizar: function () {
      this.loading = true;
      Cotacao.listar()
        .then(({ data }) => (this.cotacoes = data))
        .finally(() => (this.loading = false));
    },
  },
};
</script>
<style lang="scss">
</style>
