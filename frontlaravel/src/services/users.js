import Axios from "axios";
import "../plugins/axios.js";

export default {
    countManagers(){
        return Axios.get("/users/countManagers");
    },

    getAll(){
        return Axios.get("/users/getAll");
    },
    getAllHisqtorique(){
        return Axios.get("/users/getAllHisqtorique");
    },
    getAllEtudiant(){
        return Axios.get("/users/getAllEtudiant");
    },
    getUser(id){
        return Axios.get(`/users/findById/${id}`);
    },

    Delete(id){
        return Axios.delete(`/users/delete/${id}`);
    },
    updateCredentials(idUser,user)
    {
        return Axios.put(`/users/updateCredentials/${idUser}`,user);
    },
    addUser(data){
        return Axios.post("/users/addUser", data);
    },

    UpdatePassword(email, tempPassword, newPassword){
        return Axios.post("/users/reset-password", { email, tempPassword, newPassword});
    },

    checkPassword(data,id){
        return Axios.post(`/users/checkPassword/${id}`, data);
    },

    acceptUserAccess(userId, data) {
        return Axios.post(`/users/acceptAccess/${userId}`, data);
    },
    getUsersWithoutAttestation(idAttestation){
        return Axios.get(`/users/getUsersWithoutAttestation/${idAttestation}`);
    },

    getUsersWithAttestation(idAttestation){
        return Axios.get(`/users/getUsersWithAttestation/${idAttestation}`);
    },

    getUsersWithoutBadge(idBadge){
        return Axios.get(`/users/getUsersWithoutBadge/${idBadge}`);
    },

    getUsersWithBadge(idBadge){
        return Axios.get(`/users/getUsersWithBadge/${idBadge}`);
    },

    getUserRole(roleId){
        return Axios.get(`/users/getUserRole/${roleId}`);
    },

    evaluer(userId, data) {
        return Axios.post(`/users/evaluer/${userId}`, data);
    }
}