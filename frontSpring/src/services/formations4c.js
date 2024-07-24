import Axios from "axios";
import "../plugins/axios.js";

export default {
    countFormations4c(){
        return Axios.get(`http://localhost:9090/api/Formation4c/count`);
    },
    getAll(){
        return Axios.get("/formations4c/index");
    },
}