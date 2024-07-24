import Axios from "axios";
import "../plugins/axios.js";

export default {
    getBadges(userId) {
        return Axios.get(`/userbadges/getBadgeByUserId/${userId}`);
    }
}
