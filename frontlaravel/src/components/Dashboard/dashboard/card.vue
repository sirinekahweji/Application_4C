<template>
  <div class="card">
    <div class="card-icon" :style="{ backgroundColor: background }">
      <img :src="icone" :alt="name" class="icon-overlay">
    </div>
    <div class="card-info">
      <h2>{{ nombre }}</h2>
      <p>{{ name }}</p>
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
    nombre: {
      type: Number,
      required: true
    },
    icone: {
      type: String,
      required: true
    },
    background: {
      type: String,
      required: true
    }
  }
};
</script>

<style scoped>
.card {
  border-radius: 10px;
  padding-top: 10px;
  width: calc(25% - 20px);
  margin-right: 20px;
  margin-bottom: 20px;
  display: flex;
  flex-direction: row-reverse;
  align-items: center;
  padding-left: 2%;
  padding-top: 2%;
  box-shadow: #6e6e6e 3px 4px 8px;
  transition: all 0.3s ease-in-out;
  background-color: var(--card-color);
}

.card h2 {
  font-family: Agency FB;
  font-size: 40px;
  margin-bottom: 0;
}

.card p {
  font-family: Agency FB;
  font-size: 20px;
  margin-top: 0;
}

.card-info {
  flex: 1;
  text-align: left;
}

.card-icon {
  width: 65px;
  height: 65px;
  background-size: cover;
  background-repeat: no-repeat;
  position: relative;
  border-radius: 50%;
  box-shadow: #6e6e6e 0px 0px 5px;
  margin-right: 15px;
  margin-bottom: 30%;
}

.icon-overlay {
  position: absolute;
  top: 0;
  width: 50%;
  height: 50%;
  opacity: 1;
  margin-top: 25%;
  margin-left: 25%;
}

@media (max-width: 1000px) {
  .card {
    padding-right: 2%;
  }

  .card-icon {
    width: 35%;
    height: 35%;
    padding-top: 30%;
    margin-right: 0;
    margin-bottom: 10px;
  }

  .card h2 {
    font-family: Agency FB;
    font-size: 20px;
    margin-bottom: 0;
  }

  .card p {
    font-family: Agency FB;
    font-size: 15px;
    margin-top: 0;
  }
}

@media (max-width: 760px) {
  .card h2 {
    font-family: Agency FB;
    font-size: 15px;
    margin-bottom: 0;
  }

  .card p {
    font-family: Agency FB;
    font-size: 10px;
    margin-top: 0;
  }
}

@media (max-width: 480px) {
  .card-icon {
    width: 30%;
    height: 20%;
  }

  .card {
    padding: 5%;
  }
}
</style>
