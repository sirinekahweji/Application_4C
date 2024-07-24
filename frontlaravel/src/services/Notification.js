import Axios from "axios";
import "../plugins/axios.js";

export default {
    getNotificationUser(IdUser){
        return Axios.get(`/Notification/GetNotificationUser/${IdUser}`);
    },
}