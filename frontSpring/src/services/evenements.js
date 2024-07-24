import Axios from "axios";
import "../plugins/axios.js";

export default {
    getDetailEvenement(EvenementID) {
        return Axios.get(`/Evenement/Evenement/${EvenementID}`);
    },

    updateEvenement(EvenementID, EvenementData) {
        return Axios.put(`/Evenement/update/${EvenementID}`, EvenementData);
    },

    deleteEvenement(EvenementID) {
        return Axios.delete(`/Evenement/destroy/${EvenementID}`);
    },

    GetUser(UserId) {
        return Axios.get(`/Evenement/GetUser/${UserId}`);
    },

    addEvenement(EvenementData) {
        return Axios.post("/Evenement/AddEvenement", EvenementData);
    },

    getEvent(){
        return Axios.get("/evenements/index");
    },

    count(){
        return Axios.get("http://localhost:9090/api/evenements/count");
    },

    getEvenementDisponible() {
        return Axios.get("/Evenement/GetEvenementDisponible");
    },

    getEvenementNonDisponible() {
        return Axios.get("/Evenement/GetEvenementNonDisponible");
    },
}