import Axios from "axios";
import "../plugins/axios.js";

export default {
    countFormations(){
        return Axios.get(`/formations/count`);
    },
    getAllformationExternes(idcv){
        return Axios.get(`/formations/formationsExterne/${idcv}`);
    },
    addFormation(formation)
    {
        return Axios.post(`/formations/addFormation`,formation);
    },
    deleteFormation(id)
    {
        return Axios.delete(`/formations/deleteFormation/${id}`);

    },
    updateFormation(idformation,formation)
    {
        return Axios.put(`/formations/updateformation/${idformation}`,formation);
    },
    getAllformation4C(userId){
        return Axios.get(`/formations/getFormations4cByUserId/${userId}`);
    }

}