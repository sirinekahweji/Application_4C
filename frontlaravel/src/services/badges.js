import Axios from "axios";
import "../plugins/axios.js";

export default {
    countBadge(){
        return Axios.get("/badges/count");
    },
    getAll(){
        return Axios.get("/badges/index");
    },

    addBadge(BadgeData) {
        return Axios.post("/badges/store", BadgeData);
    },

    getDetailBadge(BadgeID) {
        return Axios.get(`/badges/badge/${BadgeID}`);
    },

    updateBadge(BadgeID, BadgeData) {
        return Axios.put(`/badges/update/${BadgeID}`, BadgeData);
    },
    
    UserBadge(BadgeID,UserId) {
        return Axios.post(`/userbadges/store/${BadgeID}/${UserId}`);
    },

    getLastSixBadges() {
        return Axios.get("/badges/getLastSixBadges");
    },
}
