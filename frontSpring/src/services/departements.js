import Axios from "axios";
import "../plugins/axios.js";

export default {
    getAll(){
        return Axios.get("/departements/index");
    },
    getDepartement(id){
        return Axios.get(`/departements/getDepartement/${id}`);
    },

    addDepartment(data){
        return Axios.post("/departements/store", data);
    },
    deleteDepartment(departement){
        return Axios.delete(`/departements/delete/${departement}`);
    },
}