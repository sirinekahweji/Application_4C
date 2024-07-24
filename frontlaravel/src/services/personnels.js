import Axios from "axios";
import "../plugins/axios.js";

export default {
    getAll(){
        return Axios.get("personnels/index");
    },

    delete(personnel){
        return Axios.delete(`/personnels/delete/${personnel}`);
    },
    addPersonnel(data){
        return Axios.post("/personnels/store", data);
    },
    getPersonnel(iduser){
        return Axios.get(`/personnels/getPersonnel/${iduser}`);
    },
    update(id,personnels)
    {
        return Axios.put(`/personnels/update/${id}`,personnels);
    }

}