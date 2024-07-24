import Axios from "axios";
import "../plugins/axios.js";

export default {
    countCertif(){
        return Axios.get("http://localhost:9090/api/certificat4cs/count");
    },
    getAll(){
        return Axios.get("/certificat4cs/index");
    },
}