import Axios from "axios";
import "../plugins/axios.js";

export default {
    getAll(){
        return Axios.get("/specialites/index");
    },
    getSpecialite(id){
        return Axios.get(`/specialites/getSpecialite/${id}`);
    },

    addSpecailite(data){
        return Axios.post("/specialites/store", data);
    },

    deleteSpecialite(specialite){
        return Axios.delete(`/specialites/delete/${specialite}`);
    },
}