import Axios from "axios";
import "../plugins/axios.js";

export default {
  
    getinfoPresenceEvent(userId){
        return Axios.get(`/presenceEvents/getevenementByUserId/${userId}`);
    }
}