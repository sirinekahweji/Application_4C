import Axios from "axios";
import "../plugins/axios.js";
export default {
    getAllCompetences(idcv){
        return Axios.get(`/competences/getAll/${idcv}`);
    },
    deleteCompetence(id)
    {
        return Axios.delete(`/competences/delete/${id}`);

    }
    ,
    addCompetence(comptence)
    {
        return Axios.post(`/competences/AddCompetence`,comptence);
    }
    ,
    updateCompetence(id,comptence)
    {
        return Axios.put(`/competences/update/${id}`,comptence);
    }
}