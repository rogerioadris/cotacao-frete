<template>
  <div class="card shadow-sm">
    <div class="card-header">Cadastro cotação de frete</div>
    <div class="card-body">
      <div v-if="loading" class="spinner-border text-danger" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      <form
        v-if="!loading"
        @submit.prevent="adicionarCotacao"
        class="row g-3 text-start"
      >
        <div class="col-md-12">
          <label for="inputState" class="form-label">Transportadora</label>
          <select
            v-model="form.transportadora_id"
            id="inputState"
            class="form-select"
            placeholder="Selecione a trasportadora"
          >
            <option
              v-for="cotacao of cotacoes"
              :key="cotacao.id"
              v-bind:value="cotacao.id"
            >
              {{ cotacao.nome }}
            </option>
          </select>
        </div>

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
          <label for="inputPercentual" class="form-label">
            Percentual cotação (%)
          </label>
          <input
            v-model="form.percentual_cotacao"
            type="number"
            min="0"
            step="0.01"
            max="100"
            class="form-control"
            id="inputPercentual"
          />
        </div>
        <div class="col-12">
          <label for="inputValor" class="form-label">Valor extra (R$)</label>
          <input
            v-model="form.valor_extra"
            type="number"
            min="0"
            step="0.01"
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
        <div class="col-12 text-end">
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
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
      cotacoes: [],
      estados: [],
      errors: [],
      form: {
        transportadora_id: null,
        uf: null,
        percentual_cotacao: null,
        valor_extra: null,
      },
    };
  },
  mounted() {
    Promise.all([Estados.listar(), Cotacao.trasnportadoras()]).then(
      (values) => {
        this.estados = values[0];
        this.cotacoes = values[1].data;
        this.loading = false;
      }
    );
  },
  methods: {
    adicionarCotacao: function () {
      this.errors = [];

      if (!this.form.transportadora_id) {
        this.errors.push("A Transportadora é obrigatória.");
      }
      if (!this.form.uf) {
        this.errors.push("O estado é obrigatório.");
      }
      if (!this.form.percentual_cotacao) {
        this.errors.push("O Percentual cotação é obrigatório.");
      }

      this.loading = true;
      Cotacao.cadastro(this.form)
        .then(() => this.$emit("atualizar", "lista"))
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
