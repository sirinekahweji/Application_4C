import Axios from "axios";
import "../plugins/axios.js";

export default {
    countEtudiants(){
        return Axios.get("/etudiants/count");
    },

    addEtudiant(data){
        return Axios.post("/etudiants/AddEtudiant", data);
    },
    
    getEtudiant(iduser){
        return Axios.get(`/etudiants/getEtudiant/${iduser}`);
    },
    update(id,etudient)
    {
        return Axios.put(`/etudiants/update/${id}`,etudient);


    }
}