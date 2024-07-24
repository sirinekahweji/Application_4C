import Axios from "axios";
import "../plugins/axios.js";

export default {
    countCertificats(){
        return Axios.get("/certificats/count");
    },
    GetCertificatsExternes(idcv){
        return Axios.get(`/certificats/getCertificatsExternes/${idcv}`);
    },
    deleteCertificat(id){
        return Axios.delete(`/certificats/deleteCertificat/${id}`);
    },
    addCertificat(certificat){
        return Axios.post(`/certificats/addcertificat`,certificat);
    },
    updateCertificat(id,certificat){
        return Axios.put(`/certificats/updatecertificat/${id}`,certificat);
    },
    getAllCertificats(userId) {
        return Axios.get(`/certificats/getCertificatsByUserId/${userId}`);
    },
}