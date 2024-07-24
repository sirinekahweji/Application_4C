<template>
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="footer-col">
          <h4>Contact</h4>
          <div class="contact-item">
            <img src="../../assets/PageGarde/iconaddress.png" alt="" class="iconContact">
            <p class="textfooter"> Route Menzel Abderrahmen <br> Zarzouna 7021 Bizerte</p>
          </div>
          <div class="contact-item">
            <img src="../../assets/PageGarde/iconemail.png" alt="" class="iconContact">
            <p class="textfooter">4cisetb@gmail.com</p>
          </div>
          <div class="contact-item">
            <img src="../../assets/PageGarde/icontelephone.png" alt="" class="iconContact">
            <p class="textfooter">54014442</p>
          </div>
          <div class="contact-item">
            <img src="../../assets/PageGarde/icontelephone.png" alt="" class="iconContact">
            <p class="textfooter">54014442</p>
          </div>
        </div>
        <div class="footer-col">
          <h4>Responsables </h4>
          <ul>
            <li><span class="responsable-text">Directrice et Responsable relations exterieurs :</span> <br>
              nkhlifi2009@gmail.com</li>
            <li><span class="responsable-text">Responsable Formations : </span>rzaigui_chiraz@yahoo.fr</li>
            <li><span class="responsable-text">Responsable Communication :</span> boudour.baratli@gmail.com</li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Liens Utiles</h4>
          <ul>
            <li><a href="http://www.mes.tn">http://www.mes.tn</a></li>
            <li><a href="http://www.uni-renov.rnu.tn">http://www.uni-renov.rnu.tn</a></li>
            <li><a href="http://parcours-lmd.salima.tn">http://parcours-lmd.salima.tn</a></li>
            <li><a href="https://www.orientation.tn/orient" class="lien-item">https://www.orientation.tn/orient</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Reseaux Sociaux</h4>
          <div class="social-links">
            <a href="https://www.facebook.com/4cisetbizerte"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>
<style scoped>
.footer {
  background-color: rgb(2, 147, 205);
  padding: 70px 0;
}

.footer row {
  display: flex;
  align-items: center;
  gap: 50px;
}

.contact-item {
  display: flex;
  align-items: center;
  gap: 13px;

}

.contact-item img {
  width: 9%;
  margin-bottom: 20px;

}

.contact-item p {
  font-size: 16px;
  text-transform: capitalize;
  color: #ffffff;
  text-decoration: none;
  font-weight: 300;
  color: #ffffff;
  display: block;
  transition: all 0.3s ease;
}

.responsable-text {
  font-weight: 500;
  color: #ffffff;
}

.footer-col {
  width: 25%;
  padding: 0 30px;
}

.footer-col ul {
  list-style-type: none;
  /* Supprime les points noirs */
  padding: 0;
  /* Supprime le remplissage par défaut */
  margin: 0;
  /* Supprime la marge par défaut */
}

.footer-col h4 {
  font-size: 18px;
  color: #ffffff;
  text-transform: capitalize;
  margin-bottom: 35px;
  font-weight: 500;
  position: relative;
}

.footer-col h4::before {
  content: '';
  position: absolute;
  left: 0;
  bottom: -10px;
  background-color: #ffffff;
  height: 2px;
  box-sizing: border-box;
  width: 50px;
}

.footer-col ul li:not(:last-child) {
  margin-bottom: 10px;
}

.footer-col ul li a {
  font-size: 16px;
  text-transform: capitalize;
  color: #ffffff;
  text-decoration: none;
  font-weight: 300;
  color: #ffffff;
  display: block;
  transition: all 0.3s ease;
}

.footer-col ul li a:hover {
  color: #ffffff;
  padding-left: 8px;
}

.footer-col .social-links a {
  display: inline-block;
  height: 40px;
  width: 40px;
  background-color: rgba(255, 255, 255, 0.2);
  margin: 0 10px 10px 0;
  text-align: center;
  line-height: 40px;
  border-radius: 50%;
  color: #ffffff;
  transition: all 0.5s ease;
}

.footer-col .social-links a:hover {
  color: #24262b;
  background-color: #ffffff;
}

.footer-col ul li {
  font-size: 16px;
  text-transform: capitalize;
  color: #ffffff;
  text-decoration: none;
  font-weight: 300;
  color: #ffffff;
  display: block;
  transition: all 0.3s ease;
}

.footer-col ul li:hover {
  color: #ffffff;
  padding-left: 8px;
}

.footer-col .social-links {
  display: inline;
  height: 40px;
  width: 40px;
  margin: 0 10px 10px 0;
  text-align: center;
  line-height: 40px;
  border-radius: 50%;
  color: #ffffff;
  transition: all 0.5s ease;
}

.footer-col .social-links a:hover {
  color: #24262b;
  background-color: #ffffff;
}

/*responsive*/
@media(max-width: 767px) {
  .footer-col {
    width: 50%;
    margin-bottom: 30px;
  }
}

@media(max-width: 574px) {
  .footer-col {
    width: 100%;
  }
}






@media screen and (max-width: 1000px) and (min-width:700px) {
  .lien-item {
    font-size: 10px;
    ;
  }

  .iconReseauSociaux,
  .iconContact {
    width: 17px;
    height: 17px;
  }

  .footerPageGarde {
    padding: 13px;
  }

  .section {
    flex: 1;
    margin-right: 0px;
    margin-top: -20px;
    padding-left: 10px;

  }

  .sectionContact {
    margin-right: 17px;
    display: flex;
    flex-direction: row;
  }

  .textfooter {
    font-size: 10px;
  }

  .sub-section2 {
    display: flex;
    flex-direction: column;
    padding-left: 0px;
    width: 230px;

  }

  .sub-section1 {
    display: flex;
    flex-direction: column;
    width: 180px;
  }

  .titleContacts {
    text-align: left;
    padding-left: 100px;
  }

  .contact-item {
    display: flex;
    align-items: center;
  }

  .contact-item2 {
    display: flex;
    align-items: left;
    flex-direction: row;
    margin-left: -15px;
  }

}

@media screen and (max-width: 1000px) and (min-width:700px) {
  .lien-item {
    font-size: 10px;
    ;
  }

  .iconReseauSociaux,
  .iconContact {
    width: 17px;
    height: 17px;
  }

  .footerPageGarde {
    padding: 13px;
  }

  .section {
    flex: 1;
    margin-right: 0px;
    margin-top: -20px;
    padding-left: 10px;

  }

  .sectionContact {
    margin-right: 17px;
    display: flex;
    flex-direction: row;
  }

  .textfooter {
    font-size: 10px;
  }

  .sub-section2 {
    display: flex;
    flex-direction: column;
    padding-left: 0px;
    width: 230px;

  }

  .sub-section1 {
    display: flex;
    flex-direction: column;
    width: 180px;
  }

  .titleContacts {
    text-align: left;
    padding-left: 100px;
  }

  .contact-item {
    display: flex;
    align-items: center;
  }

  .contact-item2 {
    display: flex;
    align-items: left;
    flex-direction: row;
    margin-left: -15px;
  }

}

@media screen and (max-width: 1200px) and (min-width:1000px) {
  .footer {
    padding: 12px;
  }

  .section {
    margin-right: 20px;
  }

  .textfooter {
    font-size: 12px;
  }

  .sub-section2 {
    width: 320px;
  }

  .sub-section1 {
    width: 200px;
  }


}
</style>