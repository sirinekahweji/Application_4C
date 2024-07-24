import Axios from "axios";
import "../plugins/axios.js";

export default {

    getAll(){
        return Axios.get(`/contacts/getAll`);
    },

    addContact(data){
        return Axios.post("/contacts/addContact", data);
    },
}