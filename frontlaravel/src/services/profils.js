import Axios from "axios";
import "../plugins/axios.js";

export default {
    getProfil(iduser){
        return Axios.get(`/profils/getProfil/${iduser}`);
    },
}
