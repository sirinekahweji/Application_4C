import Axios from "axios";
import "../plugins/axios.js";

export default {
    getCertificat4c() {
        return Axios.get("/Certificat4c/Certificat4c");
    },

    getDetailCertificat4c(Certificat4cID) {
        return Axios.get(`/Certificat4c/Certificat4c/${Certificat4cID}`);
    },

    addCertificat4c(Certificat4cData) {
        return Axios.post("/Certificat4c/AddCertificat4c", Certificat4cData);
    },

    updateCertificat4c(Certificat4cID, Certificat4cData) {
        return Axios.put(`/Certificat4c/update/${Certificat4cID}`, Certificat4cData);
    },

    deleteCertificat4c(Certificat4cID) {
        return Axios.delete(`/Certificat4c/destroy/${Certificat4cID}`);
    },

    GetParticipantsCertif(Certificat4cID) {
        return Axios.get(`/Certificat4c/GetParticipantsCertif/${Certificat4cID}`);
    },

    GetPresenceCertif(Certificat4cID) {
        return Axios.get(`/Certificat4c/GetPresenceCertif/${Certificat4cID}`);
    },

    GetUser(UserId) {
        return Axios.get(`/Certificat4c/GetUser/${UserId}`);
    },

    getCertificat4cDisponible() {
        return Axios.get("/Certificat4c/GetCertificat4cDisponible");
    },

    getCertificat4cNonDisponible() {
        return Axios.get("/Certificat4c/GetCertificat4cNonDisponible");
    },
};
