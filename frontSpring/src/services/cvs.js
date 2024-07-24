import Axios from "axios";
import "../plugins/axios.js";

export default {
    getCV(iduser){
        return Axios.get(`/CVs/getcv/${iduser}`);
    },

    addCv(data){
        return Axios.post("/CVs/store", data);
    },
}