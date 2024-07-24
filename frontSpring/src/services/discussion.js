import Axios from "axios";
import "../plugins/axios.js";
Axios.defaults.baseURL = "http://127.0.0.1:8000/api";

export default {
    getManagers(id) {
        return Axios.get(`/discussion/GetManagers/${id}`);
    },

    getMessages(emmetteurID, recepteurID) {
        return Axios.get(`/discussion/GetChat/${emmetteurID}/${recepteurID}`);
    },

    addMessage(messageData) {
        return Axios.post("/discussion/AddDiscussion", messageData);
    },

    deleteMessage(messageID) {
        return Axios.delete(`/discussion/destroy/${messageID}`);
    },

    GetMessagesGroup(){
        return Axios.get("/discussion/GetMessagesGroup");
    },

    AddMessageGroup(messageData) {
        return Axios.post("/discussion/AddMessageGroup", messageData);
    },
};
