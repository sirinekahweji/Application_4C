import Axios from "axios";
import "../plugins/axios.js";

export default {
    countparticipant(){
        return Axios.get("/participantsFormations/countParticipants");
    },
}