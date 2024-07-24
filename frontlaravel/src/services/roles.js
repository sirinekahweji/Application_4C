import Axios from "axios";
import "../plugins/axios.js";

export default {
    findById(id){
        return Axios.get(`/roles/finById/${id}`);
    },

    getAll(){
        return Axios.get("roles/getAll");
    },

    delete(role){
        return Axios.delete(`/roles/delete/${role}`);
    },

    addRole(data){
        return Axios.post("/roles/add", data);
    },

    updateRole(id){
        return Axios.put(`/roles/update/${id}`);
    },

    findIdManager(){
        return Axios.get("roles/findIdManager");
    },

    findIdResponsable(){
        return Axios.get("roles/findIdResponsable");
    },

    findIdAdmin(){
        return Axios.get("roles/findIdAdmin");
    },
}