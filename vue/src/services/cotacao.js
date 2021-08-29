import { http } from "./config";

export default {
  trasnportadoras: () => {
    return http.get("transportadora");
  },
  listar: () => {
    return http.get("cotacao");
  },
  cadastro: (data) => {
    return http.post("cotacao", data);
  },
  consultar: (data) => {
    return http.put("cotacao", data);
  },
};
