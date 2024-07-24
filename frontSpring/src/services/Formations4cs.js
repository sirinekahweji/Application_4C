import Axios from "axios";
import "../plugins/axios.js";

export default {
    getFormation4c() {
        return Axios.get("/Formation4c/Formation4c");
    },

    getDetailFormation4c(Formation4cID) {
        return Axios.get(`/Formation4c/Formation4c/${Formation4cID}`);
    },

    addFormation4c(Formation4cData) {
        return Axios.post("/Formation4c/AddFormation4c", Formation4cData);
    },

    updateFormation4c(Formation4cID, Formation4cData) {
        return Axios.put(`/Formation4c/update/${Formation4cID}`, Formation4cData);
    },

    deleteFormation4c(Formation4cID) {
        return Axios.delete(`/Formation4c/destroy/${Formation4cID}`);
    },

    GetParticipantsCertif(Formation4cID) {
        return Axios.get(`/Formation4c/GetParticipantsCertif/${Formation4cID}`);
    },

    GetPresenceCertif(Formation4cID) {
        return Axios.get(`/Formation4c/GetPresenceCertif/${Formation4cID}`);
    },

    GetUser(UserId) {
        return Axios.get(`/Formation4c/GetUser/${UserId}`);
    },

    getFormation4cDisponible() {
        return Axios.get("/Formation4c/GetFormation4cDisponible");
    },

    getFormation4cNonDisponible() {
        return Axios.get("/Formation4c/GetFormation4cNonDisponible");
    },
};
