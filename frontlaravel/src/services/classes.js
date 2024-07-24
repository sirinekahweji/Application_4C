import Axios from "axios";
import "../plugins/axios.js";

export default {
    getAll(){
        return Axios.get("/classes/index");
    },
    getClasse(id){
        return Axios.get(`/classes/getClasse/${id}`);
    },

    addClasse(data){
        return Axios.post("/classes/store", data);
    },

    deleteClasse(classe){
        return Axios.delete(`/classes/delete/${classe}`);
    },
}