import Axios from "axios";
import "../plugins/axios.js";
export default {
   
    getAllFormationsAcd(idcv){
        return Axios.get(`/formationsAcademiques/getAllFormationsAcd/${idcv}`);
    },
    deleteFormationAcd(id)
    {
        return Axios.delete(`/formationsAcademiques/delete/${id}`);

    },
    addFormationAcd(formation)
    {
        return Axios.post(`/formationsAcademiques/AddFormationAcd`,formation);
    }
    ,
    updateFormationAcd(idformation,formationAcd)
    {
        return Axios.put(`/formationsAcademiques/update/${idformation}`,formationAcd);
    }
    
   


   
 
}