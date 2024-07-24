import Axios from "axios";
import "../plugins/axios.js";
export default {
   
    getAllExperiences(idcv){
        return Axios.get(`/experiences/getAllExperiences/${idcv}`);
    },
    deleteExperience(id)
    {
        return Axios.delete(`/experiences/delete/${id}`);

    },
    addExperience(experience)
    {
        return Axios.post(`/experiences/AddExperience`,experience);

    }
    ,
    updateExperience(idexperience,experience)
    {
        return Axios.put(`/experiences/update/${idexperience}`,experience);


    }
    
   


   
 
}