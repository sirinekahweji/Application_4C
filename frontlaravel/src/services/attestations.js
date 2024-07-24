import Axios from "axios";
import "../plugins/axios.js";

export default {
    getAll(){
        return Axios.get("/attestations/index");
    },

    addAttestation(attestationsData) {
        return Axios.post("/attestations/store", attestationsData);
    },

    getDetailAttestation(AttestationID) {
        return Axios.get(`/attestations/attestation/${AttestationID}`);
    },

    updateAttestation(AttestationID, AttestationData) {
        return Axios.put(`/attestations/update/${AttestationID}`, AttestationData);
    },

    UserAttestation(AttestationID,UserId) {
        return Axios.post(`/UserAttestation/store/${AttestationID}/${UserId}`);
    },
}