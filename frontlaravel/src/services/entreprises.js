import Axios from "axios";
import "../plugins/axios.js";

export default {
    countEntreprise(){
        return Axios.get("/entreprises/count");
    },

    getEntreprises(){
        return Axios.get("/entreprises/getAll");
    },
    getEntreprise(id){
        return Axios.get(`/entreprises/getById/${id}`);
    },

    getEntreprisesHistorique(){
        return Axios.get("/entreprises/getAllHisqtorique");
    },

    addEntreprise(data){
        return Axios.post("/entreprises/addCompany", data);
    },

    delete(id){
        return Axios.delete(`/entreprises/delete/${id}`);
    },

    updateEntreprise(data, id) {
        return Axios.put(`/entreprises/update/${id}`, data);
    },
}