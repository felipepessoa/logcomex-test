import api from "@/plugins/axios";

const getCsrfCookie = async () => {
  try {
    await api.get("/sanctum/csrf-cookie");
  } catch (error) {
    console.error("Falha ao obter o token CSRF", error);
  }
};
