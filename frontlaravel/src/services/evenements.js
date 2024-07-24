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

    GetParticipantsEvent(EventID) {
        return Axios.get(`/Evenement/GetParticipantsEvent/${EventID}`);
    },

    GetPresenceEvent(EventID) {
        return Axios.get(`/Evenement/GetPresenceEvent/${EventID}`);
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
        return Axios.get("/evenements/count");
    },

    getEvenementDisponible() {
        return Axios.get("/Evenement/GetEvenementDisponible");
    },

    getEvenementNonDisponible() {
        return Axios.get("/Evenement/GetEvenementNonDisponible");
    },

    GetParticipation(UserId,EventId) {
        return Axios.get(`/Evenement/GetParticipation/${UserId}/${EventId}`);
    },

    Participer(UserId,EventId) {
        return Axios.post(`/Evenement/Participer/${UserId}/${EventId}`);
    },

    AnnulerParticiper(UserId,EventId) {
        return Axios.delete(`/Evenement/AnnulerParticiper/${UserId}/${EventId}`);
    },
}