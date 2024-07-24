
<template>
    <div class="ServiceEtudients">
        <h2>Services étudiants<br>
            <span class="decription">Lancez la prochaine étape de votre carrière....!</span>
        </h2>
        <div class="service-icons-container">
            <div v-for="(item, index) in ServicesEtudients" :key="index" class="service-icon-container">
                <div class="circle-wrapper">
                    <div class="service-icon-background1" :style="{ backgroundColor: item.borderColor }"></div>
                    <div class="service-icon-background2" :style="{ backgroundColor: item.backgroundColor }"></div>
                    <img :src="item.img" class="service-icon" alt="ServiceEtudient-icon">
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
    z-index: 1;
}
.service-icon-background1 {
    width: 120px;
    height: 120px;
}
.service-icon-container {
     display: flex;
    flex-direction: column;
    align-items: center;
   
}
.service-icon {
    width: 60px;
    height: 60px;
    margin: 35px;
    position: relative;
    z-index:2;
    cursor:pointer;

}

.decription {
    font-size: 15px;
    color: rgb(65, 64, 64);
}
.ServiceEtudients h2 {
    font-family: 'Calibri';
}
.ServiceEtudients {
    background-color: rgb(255, 255, 255);
    margin: 80px 0px;
    text-align: center;
    padding: 30px;
}
.circle-wrapper {
    position: relative;
    width: 130px;
    height: 130px;
    cursor:pointer;
    

}
.serviceDescription {
    font-family: 'Calibri';
    font-weight: bolder;
    font-size: 15px;
    text-align: center;
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
            //couleur:orange
            ServicesEtudients: [
                { 
                    img: require("../../assets/PageGarde/iconscertificate.png"), 
                    title: "Formation et certification",
                    backgroundColor: "rgb(251, 196, 70)", 
                    borderColor: "rgba(251, 196, 70, 0.8)"
                },
                //couleur:vert

                { 
                    img: require("../../assets/PageGarde/iconsemployee.png"), 
                    title: "Stage et Emploi",
                    backgroundColor: "rgb(128, 182, 39)", 
                    borderColor: "rgba(128, 182, 39, 0.7)" 
                },
              //couleur:grey

                { 
                    img: require("../../assets/PageGarde/iconInformations.png"), 
                    title: "Conseil et orientation",
                    backgroundColor: "rgb(232,219,219)", 
                    borderColor: "rgba(232,219,219,0.5)"
                },
            //couleur:bleu

                { 
                    img: require("../../assets/PageGarde/iconEvenement.png"), 
                    title: "Evènement",
                    backgroundColor: "rgb(51,154,240)",
                    borderColor: "rgba(51, 154, 240, 0.5)" 
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
