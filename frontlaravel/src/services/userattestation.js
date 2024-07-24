import Axios from "axios";
import "../plugins/axios.js";

export default {
    getallAttestationes(userId) {
        return Axios.get(`/userAttestations/getAttestationByUserId/${userId}`);
    }
}
