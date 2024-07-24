import Axios from "axios";
import "../plugins/axios.js";

export default {
    async Login(email,password){
      const res=await Axios.post("/auth/login",{email,password});
      if(res.status==200){
        localStorage.setItem("user",JSON.stringify(res.data.user));
        localStorage.setItem('token', JSON.stringify(res.data.token));
      }
      return res;
    },
    
}