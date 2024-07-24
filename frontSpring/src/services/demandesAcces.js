import Axios from "axios";
import "../plugins/axios.js";

export default {
    index(){
        return Axios.get("/demandes/index");
    },

    delete(id){
        return Axios.delete(`/demandes/delete/${id}`);
    },

    findByIdUser(id){
        return Axios.get(`/demandes/finByIdUser/${id}`);
    },
  
      addDemande(data){
        return Axios.post("/demandes/store", data);
    },
}