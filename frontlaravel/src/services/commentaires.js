import Axios from "axios";
import "../plugins/axios.js";

export default {
    getComments(publicationID) {
        return Axios.get(`/commentaires/${publicationID}`);
    },

    addComment(commentData) {
        return Axios.post("/commentaires/AddCommentaire", commentData);
    },

    updateComment(commentID, commentData) {
        return Axios.put(`/commentaires/${commentID}`, commentData);
    },

    deleteComment(commentID, publicationID) {
        return Axios.delete(`/commentaires/destroy/${commentID}/${publicationID}`);
    },
};
