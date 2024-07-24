import Axios from "axios";
import "../plugins/axios.js";

export default {
    countFormations4c(){
        return Axios.get(`/formations4c/count`);
    },
    getAll(){
        return Axios.get("/formations4c/index");
    },
}