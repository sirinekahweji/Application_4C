<template>
  <div class="card">
    <div class="card-icon">
      <img :src="getImageSource(affiche)" :alt="name" class="icon-overlay">
    </div>
    <div class="card-info">
      <h2>{{ name }}</h2>
      <router-link :to="'/Certificat/Detail/' + id"><i class="bi bi-list"></i></router-link>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    name: {
      type: String,
      required: true
    },
    affiche: {
      type: String,
      //required: true
    },
    id: {
      type: Number,
      //required: true
    },
  },
  methods: {
    getImageSource(image) {
      // Check if the image is an external URL
      if (image.startsWith('http://') || image.startsWith('https://')) {
        return image;
      } else {
        // Treat it as a local path
        return require(`@/${image}`);
      }
    }
  }
};
</script>
<style scoped>
.card {
  width: 25% !important;
  border-radius: 10px;
  margin-right: 20px;
  margin-bottom: 20px;
  display: flex;
  padding-left: 1%;
  padding-right: 1%;
  padding-top: 2%;
  box-shadow: #6e6e6e 3px 4px 8px;
  transition: all 0.3s ease-in-out;
  background-color: var(--card-color);
}

.card h2 {
  font-family: Agency FB;
  font-size: 16px;
  color: #6e6e6e;
  margin-bottom: 5%;
  margin-left: 4px;
  padding-top: 3px;
}

.card-info a {
  margin-right: 1%;
  cursor: pointer;
}

.card-info {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}

.card-icon {
  width: 170px;
  height: 100px;
}

.icon-overlay {
  border-radius: 3%;
  background-size: cover;
  background-repeat: no-repeat;
  position: absolute;
  width: 90%;
  height: 60%;
  opacity: 1;
  margin-left: 1%;
  margin-right: 1%;
  padding-top: 3px;
}

@media (max-width: 1050px) {
  .card {
    width: 30% !important;
    padding-right: 2%;
    margin-right: 20px;
    margin-bottom: 20px;
  }

  .card-icon {
    width: auto;
    height: auto;
    padding-top: 1%;
    margin-right: 0 !important;
    margin-left: -97% !important;
    padding-bottom: 2%;
    margin-bottom: 20%;
    text-align: center;
  }

  .icon-overlay {
    width: auto;
    height: 60%;
  }

  .card-info {
    font-size: 20px;
    margin-bottom: 0;
    margin-top: 35%;
  }
}



@media (max-width: 760px) {
  .card h2 {
    font-family: Agency FB;
    font-size: 15px;
    margin-bottom: 0;
  }

  .card {
    width: 90% !important;

  }

  .card-icon {
    width: auto;
    height: auto;
    padding-top: 1%;
    margin-right: 0 !important;
    margin-left: -97% !important;
    padding-bottom: 2%;
    margin-bottom: 20%;
    text-align: center;
  }

  .icon-overlay {
    width: auto;
    height: 72%;
    text-align: center;
  }

  .card-info {
    width: 100% !important;
    font-size: 20px;
    margin-bottom: 1% !important;
    margin-top: 35%;
    margin-right: auto;
  }

  .card-info a {
    padding-left: 1% !important;
  }
}

@media (max-width: 480px) {
  .card {
    width: 90% !important;

  }

  .card-icon {
    width: auto;
    height: auto;
    padding-top: 1%;
    margin-right: 0 !important;
    margin-left: -97% !important;
    padding-bottom: 2%;
    margin-bottom: 20%;
    text-align: center;
  }

  .icon-overlay {
    width: auto;
    height: 72%;
    text-align: center;
  }

  .card-info {
    width: 100% !important;
    font-size: 20px;
    margin-bottom: 1% !important;
    margin-top: 35%;
    margin-right: auto;
  }

  .card-info a {
    padding-left: 1% !important;
  }
}
</style>