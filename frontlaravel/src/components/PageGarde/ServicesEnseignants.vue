
<template>
    <div class="ServiceEnseignants">
        <h2>Services Enseignants<br>
            <span class="decription">Façonnez la prochaine génération de leaders avec nous !</span>
        </h2>
        <div class="service-icons-container">
            <div v-for="(item, index) in ServicesEnseignants" :key="index" class="service-icon-container">
                <div class="circle-wrapper">
                    <div class="service-icon-background1" :style="{ backgroundColor: item.borderColor }"></div>
                    <div class="service-icon-background2" :style="{ backgroundColor: item.backgroundColor }"></div>
                    <img :src="item.img" class="service-icon" alt="ServiceEnseignant-icon">
                </div>
                <p class="serviceDescription">
                    {{ item.title }}
                </p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.service-icons-container {
     display: flex;
    justify-content: center;
    gap: 30px;
}
.serviceDescription {
    font-family: 'Calibri';
    font-weight: bolder;
    font-size: 15px;
    text-align: center;
    
}
.service-icon-background1,
.service-icon-background2 {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 50%;
}
.service-icon-background2 {
    width: 100px;
    height: 100px;
}
.service-icon-background1 {
    width: 120px;
    height: 120px;
}
.service-icon-background2 {
    width: 100px;
    height: 100px;
}
.service-icon {
    width: 60px;
    height: 60px;
    margin: 35px;
    position: relative;
    z-index:2;
    cursor:pointer;

}
.circle-wrapper {
    position: relative;
    width: 130px;
    height: 130px;
    cursor:pointer;
    

}

.service-icon-container {
      display: flex;
    flex-direction: column;
    align-items: center;
}
.decription {
    font-size: 15px;
    color: rgb(65, 64, 64);
}
.ServiceEnseignants h2 {
    font-family: 'Calibri';
}
.ServiceEnseignants {
    background-color: rgb(255, 255, 255);
    margin: 80px 0px;
    text-align: center;
    padding: 30px;
}
@media screen and (max-width: 700px) {

.service-icons-container {
flex-direction: column; 
align-items: center;
justify-content: center; 
margin: 0 auto; 
max-width: 150px; 
}

.service-icon-container {
width: 100%;
text-align: center; 
margin-bottom: 10px;
}
}
</style>

<script>
export default {
    data() {
        return {
            ServicesEnseignants: [
                { 
                    img: require("../../assets/PageGarde/iconscertificate.png"), 
                    title: "Formation et certification",
                    backgroundColor: "rgb(51,154,240)",
                    borderColor: "rgba(51, 154, 240, 0.5)" 
              
                },
                { 
                    img: require("../../assets/PageGarde/iconsdeal.png"), 
                    title: "Collaborer avec  4C Iset Bizerte",
                    backgroundColor: "rgb(251, 196, 70)", 
                    borderColor: "rgba(251, 196, 70, 0.8)"
                  
                },
                { 
                    img: require("../../assets/PageGarde/passeport.png"), 
                    title: "Passeport 4C",
                    backgroundColor: "rgb(232,219,219)", 
                    borderColor: "rgba(232,219,219,0.5)" 
                }
               
            ],
        };
    },
    mounted() {
    },
    methods: {
        
    }
};
</script>
