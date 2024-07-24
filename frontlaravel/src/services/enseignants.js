import Axios from "axios";
import "../plugins/axios.js";

export default {
    countEnseignants(){
        return Axios.get("/enseignants/count");
    },

    addEnseignant(data){
        return Axios.post("/enseignants/AddEnseignant", data);
    },
    getEnseignant(iduser){
        return Axios.get(`/enseignants/getEnseignant/${iduser}`);
    } ,
    update(id,enseignant)
    {
        return Axios.put(`/enseignants/update/${id}`,enseignant);


    }

}