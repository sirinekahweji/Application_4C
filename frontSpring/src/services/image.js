import Axios from "axios";
import "../plugins/axios.js";
Axios.defaults.baseURL = "http://127.0.0.1:8000/api";

export default {
    getImages(publication_id) {
        return Axios.get(`/image/GetImages/${publication_id}`);
    },

    addImages(imageData) {
        return Axios.post("/image/AddImages", imageData);
    },

};
