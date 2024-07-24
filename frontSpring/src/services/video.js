import Axios from "axios";
import "../plugins/axios.js";
Axios.defaults.baseURL = "http://127.0.0.1:8000/api";

export default {
    getVideos(publication_id) {
        return Axios.get(`/Video/GetVideos/${publication_id}`);
    },

    addVideos(VideoData) {
        return Axios.post("/Video/AddVideos", VideoData);
    },

};
