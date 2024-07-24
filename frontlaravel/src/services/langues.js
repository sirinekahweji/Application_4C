import Axios from "axios";
import "../plugins/axios.js";
export default {
   
    getAllLangues(idcv){
        return Axios.get(`/langues/getAll/${idcv}`);
    }
    ,
    deleteLangue(id)
    {
        return Axios.delete(`/langues/delete/${id}`);

    }
    ,
    addLangue(langue)
    {
        return Axios.post(`/langues/AddLangue`,langue);
    }
    ,
    updateLangue(id,langue)
    {
        return Axios.put(`/langues/update/${id}`,langue);
    }
}