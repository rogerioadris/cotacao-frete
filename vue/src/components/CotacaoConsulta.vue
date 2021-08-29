<template>
  <div class="card shadow-sm">
    <div class="card-header">Cotar frete</div>
    <div class="card-body">
      <form @submit.prevent="onConsultar" class="row g-3 text-start">
        <div class="col-md-12">
          <label for="inputState" class="form-label">UF</label>
          <select v-model="form.uf" id="inputState" class="form-select">
            <option
              v-for="estado of estados"
              :key="estado.sigla"
              v-bind:value="estado.sigla"
            >
              {{ estado.nome }}
            </option>
          </select>
        </div>

        <div class="col-12">
          <label for="inputValor" class="form-label">Valor pedido (R$)</label>
          <input
            v-model="form.valor_pedido"
            type="number"
            min="0"
            step="0.1"
            class="form-control"
            id="inputValor"
          />
        </div>
        <div v-if="errors.length" class="alert alert-danger" role="alert">
          Por favor, corrija o(s) seguinte(s) erro(s):
          <ul>
            <li v-for="error in errors" :key="error">{{ error }}</li>
          </ul>
        </div>

        <div class="col-12 text-start">
          <button type="submit" class="btn btn-primary">Cotar</button>
        </div>
      </form>

      <div v-if="loading" class="spinner-border text-danger" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>

      <table v-if="!loading && cotacoes.length > 0" class="table">
        <thead>
          <tr>
            <th scope="col">Rank</th>
            <th scope="col">Transportadora</th>
            <th scope="col">Valor Cotação</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(cotacao, index) of cotacoes" :key="index">
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ cotacao.transportadora_id }}</td>
            <td>{{ cotacao.valor_cotacao | toReal }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
import Cotacao from "@/services/cotacao";
import Estados from "@/services/estado";
export default {
  data() {
    return {
      loading: true,
      estados: [],
      errors: [],
      cotacoes: [],
      form: {
        valor_pedido: null,
        uf: null,
      },
    };
  },
  mounted() {
    Promise.all([Estados.listar()]).then((values) => {
      this.estados = values[0];
      this.loading = false;
    });
  },
  filters: {
    toReal(value) {
      return parseFloat(value).toFixed(2);
    },
  },
  methods: {
    onConsultar: function () {
      this.errors = [];

      if (!this.form.valor_pedido) {
        this.errors.push("O Valor do pedido é obrigatório.");
      }

      if (this.form.valor_pedido <= 0) {
        this.errors.push("O Valor do pedido deve ser maior que 0.");
      }

      if (!this.form.uf) {
        this.errors.push("O estado é obrigatório.");
      }

      this.loading = true;
      Cotacao.consultar(this.form)
        .then(({ data }) => (this.cotacoes = data))
        .catch((error) =>
          this.errors.push(
            error.response
              ? error.response.data.mensagem
              : "Ocorreu um erro tente novamente."
          )
        )
        .finally(() => (this.loading = false));
    },
  },
};
</script>
<style lang="scss">
</style>
