import Axios from "axios";
import "../plugins/axios.js";

export default {
    getPublications(responsableID) {
        return Axios.get(`/publications/posts/${responsableID}`);
    },

    addPublication(publicationData) {
        return Axios.post("/publications/AddPublication", publicationData);
    },

    updatePublication(publicationID, publicationData) {
        return Axios.put(`/publications/update/${publicationID}`, publicationData);
    },

    deletePublication(publicationID) {
        return Axios.delete(`/publications/destroy/${publicationID}`);
    },

    getReact(PublicationId,UserId) {
        return Axios.get(`/publications/GetReact/${PublicationId}/${UserId}`);
    },

    AddReact(Reactdata) {
        return Axios.post("/publications/AddReact", Reactdata);
    },

    deleteReact(PublicationId,UserId) {
        return Axios.delete(`/publications/deleteReact/${PublicationId}/${UserId}`);
    },

    NbReact(PublicationId){
        return Axios.get(`/publications/NbReact/${PublicationId}`);
    },
};
