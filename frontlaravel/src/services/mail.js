import Axios from "axios";
import "../plugins/axios.js";
export default {

    forgetPassword(email) {
        return Axios.post(`/users/forgot-password`, { email: email });
    }    
}