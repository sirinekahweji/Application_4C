<template>
  <div>
    <span id="top"></span>
    <navBar></navBar>
    <section>
      <div class="row" style="margin-right: 0px">
        <div class="col-md-4" style="width: 18%">
          <information_personnel></information_personnel>
        </div>
        <div class="liste-post col-md-5" style="width: 48%">
          <div class="publier" v-if="role.nomRole === 'administrateur' || role.nomRole === 'responsablemanager'">
            <form @submit.prevent="addNewPublication">
              <div style="display: flex;align-items: center;justify-content: center;">
                <img src="@/assets/logo1.png" style="
                    width: 35px;
                    height: 35px;
                    border-radius: 50%;" />
                <input type="text" v-model="description" class="search__input"
                  placeholder="Quoi de neuf, 4C Iset Bizerte" style="margin-left: 10px; font-size: 13px" />
                <button style="margin-left: 10px" type="submit">
                  <div class="svg-wrapper-1">
                    <div class="svg-wrapper">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path fill="currentColor"
                          d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"
                          style="color: aliceblue"></path>
                      </svg>
                    </div>
                  </div>
                  <span class="pub-titre">Publier</span>
                </button>
              </div>
              <hr />
              <div class="choix">
                <div>
                  <label for="videoInput">
                    <img src="@/assets/video.png" alt="" style="height: 25px" />
                    <input id="videoInput" type="file" accept="video/*" name="file" style="display: none" multiple />
                    <span class="text-j">Vidéo</span>
                  </label>
                </div>
                <div>
                  <label for="photoInput">
                    <img src="@/assets/icons8-photo-48.png" alt="" style="height: 25px" />
                    <input id="photoInput" type="file" name="image" style="display: none" multiple />
                    <span class="text-j">Photo</span>
                  </label>
                </div>
                <div></div>
              </div>
            </form>
          </div>
          <div class="posts" v-if="role.nomRole === 'administrateur' || role.nomRole === 'responsablemanager'">
            <div v-for="post in posts" :key="post.id" class="facebook-post">
              <div class="post-header">
                <div class="post-header">
                  <div class="user-profile-image">
                    <img src="@/assets/logo1.png" />
                  </div>
                  <div class="user-info">
                    <span>4C Iset Bizerte</span>
                    <span>{{ formatDate(post.created_at) }}</span>
                  </div>
                </div>
                <div class="icons-container"
                  v-if="role.nomRole === 'administrateur' || role.nomRole === 'responsablemanager'">
                  <!-- <i class="bi bi-three-dots icon"></i> -->
                  <i class="bi bi-x-lg" @click="deletePublication(post.id)"></i>
                </div>
              </div>
              <div class="post">
                <div v-if="post.description" class="discription">
                  <p>{{ post.description }}</p>
                </div>

                <div :id="'carouselExampleAutoplaying' + post.id" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                    <div v-for="(video, index) in getFilteredVideos(post.id)" :key="video.id"
                      :class="['carousel-item', { active: index === 0 }]">
                      <video :src="require(`@/${video.video}`)" class="d-block w-100" alt="Video" autoplay loop controls
                        muted></video>
                    </div>
                    <div v-for="(image, index) in getFilteredImages(post.id)" :key="image.id"
                      :class="['carousel-item', { active: index === 0 && getFilteredVideos(post.id).length === 0 }]">
                      <img :src="require(`@/${image.image}`)" class="d-block w-100" alt="Image" />
                    </div>
                  </div>
                  <template v-if="getTotalItems(post.id) > 1">
                    <button class="carousel-control-prev" type="button"
                      :data-bs-target="'#carouselExampleAutoplaying' + post.id" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button"
                      :data-bs-target="'#carouselExampleAutoplaying' + post.id" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </template>
                </div>
              </div>
              <div>
                <img src="@/assets/like.gif" height="25" width="30" alt="like" style="margin-right: 10px">
                {{ nbReactsMap[post.id] }}
              </div>
              <div class="post-interactions">
                <button @click.stop="likeButton('', post.id)">
                  <div v-if="hasReact(post.id, 'Jaime')">
                    <img src="@/assets/like.gif" height="30" width="35" alt="like" style="margin-right: 10px"
                      :class="'graylike-' + post.id">
                    <text :class="'NameLike-' + post.id">J'aime</text>
                  </div>
                  <div v-else-if="hasReact(post.id, 'Jadore')">
                    <img src="@/assets/heart.gif" height="30" width="35" alt="like" style="margin-right: 10px"
                      :class="'graylike-' + post.id">
                    <text :class="'NameLike-' + post.id">J'adore</text>
                  </div>
                  <div v-else-if="hasReact(post.id, 'Wouah')">
                    <img src="@/assets/wow.gif" height="30" width="35" alt="like" style="margin-right: 10px"
                      :class="'graylike-' + post.id">
                    <text :class="'NameLike-' + post.id">Wouah</text>
                  </div>
                  <div v-else-if="hasReact(post.id, 'Haha')">
                    <img src="@/assets/laugh.gif" height="30" width="35" alt="like" style="margin-right: 10px"
                      :class="'graylike-' + post.id">
                    <text :class="'NameLike-' + post.id">Haha</text>
                  </div>
                  <div v-else-if="hasReact(post.id, 'Triste')">
                    <img src="@/assets/sad.gif" height="30" width="35" alt="like" style="margin-right: 10px"
                      :class="'graylike-' + post.id">
                    <text :class="'NameLike-' + post.id">Triste</text>
                  </div>
                  <div v-else-if="hasReact(post.id, 'Encolére')">
                    <img src="@/assets/angry.gif" height="30" width="35" alt="like" style="margin-right: 10px"
                      :class="'graylike-' + post.id">
                    <text :class="'NameLike-' + post.id">En colére</text>
                  </div>
                  <div v-else>
                    <img src="@/assets/gray_like.png" height="30" width="35" alt="like" style="margin-right: 10px"
                      :class="'graylike-' + post.id">
                    <text :class="'NameLike-' + post.id">J'aime</text>
                  </div>
                  <span>
                    <img src="@/assets/like.gif" @click.stop="likeButton('Jaime', post.id)">
                    <img src="@/assets/heart.gif" @click.stop="likeButton('Jadore', post.id)">
                    <img src="@/assets/wow.gif" @click.stop="likeButton('Wouah', post.id)">
                    <img src="@/assets/laugh.gif" @click.stop="likeButton('Haha', post.id)">
                    <img src="@/assets/sad.gif" @click.stop="likeButton('Triste', post.id)">
                    <img src="@/assets/angry.gif" @click.stop="likeButton('Encolére', post.id)">
                  </span>
                </button>
                <button class="modal-trigger" @click="handleButtonClick(post.id)">comment</button>
              </div>
            </div>
          </div>
          <div class="posts" v-else style="margin-top: 50px;">
            <div v-for="post in posts" :key="post.id" class="facebook-post">
              <div class="post-header">
                <div class="post-header">
                  <div class="user-profile-image">
                    <img src="@/assets/logo1.png" />
                  </div>
                  <div class="user-info">
                    <span>4C Iset Bizerte</span>
                    <span>{{ formatDate(post.created_at) }}</span>
                  </div>
                </div>
                <div class="icons-container"
                  v-if="role.nomRole === 'administrateur' || role.nomRole === 'responsablemanager'">
                  <!-- <i class="bi bi-three-dots icon"></i> -->
                  <i class="bi bi-x-lg" @click="deletePublication(post.id)"></i>
                </div>
              </div>
              <div class="post">
                <div v-if="post.description" class="discription">
                  <p>{{ post.description }}</p>
                </div>

                <div :id="'carouselExampleAutoplaying' + post.id" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                    <div v-for="(video, index) in getFilteredVideos(post.id)" :key="video.id"
                      :class="['carousel-item', { active: index === 0 }]">
                      <video :src="require(`@/${video.video}`)" class="d-block w-100" alt="Video" autoplay loop controls
                        muted></video>
                    </div>
                    <div v-for="(image, index) in getFilteredImages(post.id)" :key="image.id"
                      :class="['carousel-item', { active: index === 0 && getFilteredVideos(post.id).length === 0 }]">
                      <img :src="require(`@/${image.image}`)" class="d-block w-100" alt="Image" />
                    </div>
                  </div>
                  <template v-if="getTotalItems(post.id) > 1">
                    <button class="carousel-control-prev" type="button"
                      :data-bs-target="'#carouselExampleAutoplaying' + post.id" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button"
                      :data-bs-target="'#carouselExampleAutoplaying' + post.id" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </template>
                </div>
              </div>
              <div>
                <img src="@/assets/like.gif" height="25" width="30" alt="like" style="margin-right: 10px">
                {{ nbReactsMap[post.id] }}
              </div>
              <div class="post-interactions">
                <button @click.stop="likeButton('', post.id)">
                  <div v-if="hasReact(post.id, 'Jaime')">
                    <img src="@/assets/like.gif" height="30" width="35" alt="like" style="margin-right: 10px"
                      :class="'graylike-' + post.id">
                    <text :class="'NameLike-' + post.id">J'aime</text>
                  </div>
                  <div v-else-if="hasReact(post.id, 'Jadore')">
                    <img src="@/assets/heart.gif" height="30" width="35" alt="like" style="margin-right: 10px"
                      :class="'graylike-' + post.id">
                    <text :class="'NameLike-' + post.id">J'adore</text>
                  </div>
                  <div v-else-if="hasReact(post.id, 'Wouah')">
                    <img src="@/assets/wow.gif" height="30" width="35" alt="like" style="margin-right: 10px"
                      :class="'graylike-' + post.id">
                    <text :class="'NameLike-' + post.id">Wouah</text>
                  </div>
                  <div v-else-if="hasReact(post.id, 'Haha')">
                    <img src="@/assets/laugh.gif" height="30" width="35" alt="like" style="margin-right: 10px"
                      :class="'graylike-' + post.id">
                    <text :class="'NameLike-' + post.id">Haha</text>
                  </div>
                  <div v-else-if="hasReact(post.id, 'Triste')">
                    <img src="@/assets/sad.gif" height="30" width="35" alt="like" style="margin-right: 10px"
                      :class="'graylike-' + post.id">
                    <text :class="'NameLike-' + post.id">Triste</text>
                  </div>
                  <div v-else-if="hasReact(post.id, 'Encolére')">
                    <img src="@/assets/angry.gif" height="30" width="35" alt="like" style="margin-right: 10px"
                      :class="'graylike-' + post.id">
                    <text :class="'NameLike-' + post.id">En colére</text>
                  </div>
                  <div v-else>
                    <img src="@/assets/gray_like.png" height="30" width="35" alt="like" style="margin-right: 10px"
                      :class="'graylike-' + post.id">
                    <text :class="'NameLike-' + post.id">J'aime</text>
                  </div>
                  <span>
                    <img src="@/assets/like.gif" @click.stop="likeButton('Jaime', post.id)">
                    <img src="@/assets/heart.gif" @click.stop="likeButton('Jadore', post.id)">
                    <img src="@/assets/wow.gif" @click.stop="likeButton('Wouah', post.id)">
                    <img src="@/assets/laugh.gif" @click.stop="likeButton('Haha', post.id)">
                    <img src="@/assets/sad.gif" @click.stop="likeButton('Triste', post.id)">
                    <img src="@/assets/angry.gif" @click.stop="likeButton('Encolére', post.id)">
                  </span>
                </button>
                <button class="modal-trigger" @click="handleButtonClick(post.id)">comment</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div style="position: fixed;">
            <div class="information-etudiant">
              <div class="Nouvelleinscrit" id="inscrit"
                v-if="role.nomRole === 'administrateur' || role.nomRole === 'responsablemanager'">
                <div class="flex-container">
                  <div class="flex-item">
                    <h5>Les Nouvelles Inscriptions</h5>
                    <img src="@/assets/icons8-inscription-48.png" alt="" />
                  </div>
                  <a>Voir Tout</a>
                </div>
                <hr />
                <div class="inscrit">
                  <div class="user-info">
                    <img src="@/assets/mourad.png" alt="" class="profile-image" />
                    <div class="info">
                      <h6>Mourad Soltan</h6>
                      <span>Inscrit le 02/05/2023</span>
                    </div>
                  </div>
                  <button class="btn btn-primary">Voir Profile</button>
                </div>
                <div class="inscrit">
                  <div class="user-info">
                    <img src="@/assets/mourad.png" alt="" class="profile-image" />
                    <div class="info">
                      <h6>Mourad Soltan</h6>
                      <span>Inscrit le 02/05/2023</span>
                    </div>
                  </div>
                  <button class="btn btn-primary">Voir Profile</button>
                </div>
                <div class="inscrit">
                  <div class="user-info">
                    <img src="@/assets/mourad.png" alt="" class="profile-image" />
                    <div class="info">
                      <h6>Mourad Soltan</h6>
                      <span>Inscrit le 02/05/2023</span>
                    </div>
                  </div>
                  <button class="btn btn-primary">Voir Profile</button>
                </div>
              </div>
              <div class="Jardin" id="jardin" v-if="badges.length>0 & UserBadge.length>0">
                <div class="flex-container">
                  <div class="flex-item">
                    <h5>Jardin Des Badges</h5>
                    <img style="margin-top: -10px;" src="@/assets/icons8-badge-48.png" alt="" />
                  </div>
                  <a>Voir Tout</a>
                </div>
                <hr />
                <div  class="badge-container">
                  <div v-for="(badge, index) in badges" :key="badge.id" class="badge-info">
                    <div class="to">
                      <div class="position-relative">
                        <img :src="require(`@/${badge.image}`)" alt="Badge Image" />
                        <span class="badge rounded-pill">
                          <img src="@/assets/mourad.png" alt="Owner Image" />
                        </span>
                      </div>
                      <!-- Display nom and prenom from UserBadge if available -->
                      <span v-if="UserBadge[index]">{{ UserBadge[index].nom }} {{ UserBadge[index].prenom }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="button">
      <a href="#top"><i class="fa-solid fa-arrow-up"></i></a>
    </div>

    <div class="modal-container" :class="{ active: isModalActive }">
      <div class="overlay" @click="toggleModal"></div>
      <div class="modal1">
        <button aria-label="close modal" class="close-modal" @click="toggleModal">
          X
        </button>
        <div>
          <div class="head">
            <h1>Ajouter un Commentaire</h1>
          </div>
          <div><span id="comment">{{ this.comments.length }}</span> Comments</div>
          <div class="comments">
            <div class="parents" v-for="comment in comments" :key="comment.id">
              <img src="@/assets/mourad.png">
              <div>
                <h1>{{ this.user.prenom + ' ' + this.user.nom }}</h1>
                <p>{{ comment.description }}</p>
                <span class="date">{{ formatDate(comment.created_at) }}</span>
              </div>
            </div>
          </div>
          <div class="commentbox">
            <img src="@/assets/mourad.png" alt="" />
            <div class="content">
              <form @submit.prevent="addComment">
                <div class="commentinput">
                  <input type="text" v-model="descCommentaire" placeholder="Enter comment" class="usercomment" />
                  <div class="buttons">
                    <button type="submit" disabled id="publish">
                      Commenter
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import navBar from "@/components/navbar.vue";
import information_personnel from "@/components/Accueil/information-personnel.vue";
import Swal from "sweetalert2";
import PublicationServices from "@/services/publications.js";
import commentairesServices from "@/services/commentaires.js";
import imagesServices from "@/services/image.js";
import VideosServices from "@/services/video.js";
import axios from "axios";
import moment from 'moment';
import UserService from '../services/users.js'
import 'moment/locale/fr';
import BadgesService from '@/services/badges';

export default {
  name: "app",
  components: {
    navBar,
    information_personnel,
  },
  data() {
    return {
      posts: [],
      comments: [],
      images: [],
      videos: [],
      description: "",
      descCommentaire: "",
      responsable_id: 19,
      isModalActive: false,
      postID: 0,
      idUser: 0,
      user: {},
      reacts: [],
      nbReactsMap: {},
      role: {},
      badges: [],
      UserBadge: [],
    }
  },
  mounted() {
    const modalTriggers = document.querySelectorAll(".modal-trigger");

    modalTriggers.forEach((trigger) =>
      trigger.addEventListener("click", () => {
        this.toggleModal(); // Assuming toggleModal is a method in your Vue component
      })
    );

    const userComment = document.querySelector(".usercomment");
    const publishBtn = document.querySelector("#publish");

    userComment.addEventListener("input", () => {
      if (!userComment.value) {
        publishBtn.setAttribute("disabled", "disabled");
        publishBtn.classList.remove("abled");
      } else {
        publishBtn.removeAttribute("disabled");
        publishBtn.classList.add("abled");
      }
    });

    publishBtn.addEventListener("click", this.addPost);
  },
  created() {
    this.getPublications();
    this.loadFromLocalStorage();
    this.getUserRole();
    this.getLastSixBadges();
  },
  computed: {},
  methods: {
    getUserById() {
      for (let i = 0; i < 6; i++) {
        UserService.getUser(this.badges[i].user_id).then(res => {
          this.UserBadge.push(res.data.data);
        }).catch(error => {
          console.error("Error retrieving user with ID ", error);
        });
      };
    },
    getLastSixBadges() {
      BadgesService.getLastSixBadges().then(res => {
        this.badges = res.data;
        this.getUserById();
      });
    },
    getUserRole() {
      UserService.getUserRole(this.user.role_id).then(res => {
        this.role = res.data;
      })
    },
    getFilteredVideos(postId) {
      return this.videos.filter(video => video && video.publication_id === postId);
    },
    getFilteredImages(postId) {
      return this.images.filter(image => image && image.publication_id === postId);
    },
    getTotalItems(postId) {
      return this.getFilteredVideos(postId).length + this.getFilteredImages(postId).length;
    },
    isActiveItem(index) {
      return index === 0;
    },
    fetchNbReactsForPost(post) {
      PublicationServices.NbReact(post.id)
        .then((res) => {
          this.nbReactsMap[post.id] = res.data;
          //console.log(this.nbReactsMap);
        })
        .catch((error) => {
          console.error('Erreur lors de la récupération du nombre de réactions pour le post', post.id, ':', error);
        });
    },
    formatDate(created_at) {
      return moment(created_at).fromNow();
    },
    hasReact(publicationId, type) {
      return this.reacts.some(react => react.publication_id === publicationId && react.type === type);
    },
    loadFromLocalStorage() {
      const userData = localStorage.getItem("user");
      if (userData) {
        this.user = JSON.parse(userData);
      }
    },
    likeButton(likeType, postId) {
      let graylike = document.querySelector(`.graylike-${postId}`);
      let NameLike = document.querySelector(`.NameLike-${postId}`);
      let react = {
        publication_id: postId,
        user_id: this.user.id,
        type: ''
      }
      switch (likeType) {
        case "Jaime":
          if (graylike.src.includes(require("@/assets/gray_like.png"))) {
            graylike.src = require("@/assets/like.gif");
            NameLike.innerHTML = "J'aime";
            react.type = "Jaime";
            PublicationServices.AddReact(react);
            this.nbReactsMap[postId]++;
          } else {
            graylike.src = require("@/assets/like.gif");
            NameLike.innerHTML = "J'aime";
            react.type = "Jaime";
            PublicationServices.deleteReact(postId, this.user.id);
            PublicationServices.AddReact(react);
            this.nbReactsMap[postId]++;
          }
          break;
        case "Jadore":
          if (graylike.src.includes(require("@/assets/gray_like.png"))) {
            graylike.src = require("@/assets/heart.gif");
            NameLike.innerHTML = "J'adore";
            react.type = "Jadore";
            this.nbReactsMap[postId]++;
            PublicationServices.AddReact(react);
          } else {
            graylike.src = require("@/assets/heart.gif");
            NameLike.innerHTML = "J'adore";
            react.type = "Jadore";
            PublicationServices.deleteReact(postId, this.user.id);
            this.nbReactsMap[postId]++;
            PublicationServices.AddReact(react);
          }
          break;
        case "Wouah":
          if (graylike.src.includes(require("@/assets/gray_like.png"))) {
            graylike.src = require("@/assets/wow.gif");
            NameLike.innerHTML = "Wouah";
            react.type = "Wouah";
            this.nbReactsMap[postId]++;
            PublicationServices.AddReact(react);
          } else {
            graylike.src = require("@/assets/wow.gif");
            NameLike.innerHTML = "Wouah";
            react.type = "Wouah";
            PublicationServices.deleteReact(postId, this.user.id);
            this.nbReactsMap[postId]++;
            PublicationServices.AddReact(react);
          }
          break;
        case "Haha":
          if (graylike.src.includes(require("@/assets/gray_like.png"))) {
            graylike.src = require("@/assets/laugh.gif");
            NameLike.innerHTML = "Haha";
            react.type = "Haha";
            this.nbReactsMap[postId]++;
            PublicationServices.AddReact(react);
          } else {
            graylike.src = require("@/assets/laugh.gif");
            NameLike.innerHTML = "Haha";
            react.type = "Haha";
            PublicationServices.deleteReact(postId, this.user.id);
            this.nbReactsMap[postId]++;
            PublicationServices.AddReact(react);
          }
          break;
        case "Triste":
          if (graylike.src.includes(require("@/assets/gray_like.png"))) {
            graylike.src = require("@/assets/sad.gif");
            NameLike.innerHTML = "Triste";
            react.type = "Triste";
            this.nbReactsMap[postId]++;
            PublicationServices.AddReact(react);
          } else {
            graylike.src = require("@/assets/sad.gif");
            NameLike.innerHTML = "Triste";
            react.type = "Triste";
            PublicationServices.deleteReact(postId, this.user.id);
            this.nbReactsMap[postId]++;
            PublicationServices.AddReact(react);
          }
          break;
        case "Encolére":
          if (graylike.src.includes(require("@/assets/gray_like.png"))) {
            graylike.src = require("@/assets/angry.gif");
            NameLike.innerHTML = "En colére";
            react.type = "Encolére";
            this.nbReactsMap[postId]++;
            PublicationServices.AddReact(react);
          } else {
            graylike.src = require("@/assets/angry.gif");
            NameLike.innerHTML = "En colére";
            react.type = "Encolére";
            PublicationServices.deleteReact(postId, this.user.id);
            this.nbReactsMap[postId]++;
            PublicationServices.AddReact(react);
          }
          break;
        default:
          if (graylike.src.includes(require("@/assets/gray_like.png"))) {
            graylike.src = require("@/assets/like.gif");
            NameLike.innerHTML = "J'aime";
            react.type = "Jaime";
            PublicationServices.AddReact(react);
          } else {
            graylike.src = require("@/assets/gray_like.png");
            NameLike.innerHTML = "J'aime";
            PublicationServices.deleteReact(postId, this.user.id);
            this.nbReactsMap[postId]--;
          }
          break;
      }
      this.posts.forEach(post => {
        this.fetchNbReactsForPost(post);
      });
    },
    getReact(publicationId) {
      PublicationServices.getReact(publicationId, this.user.id)
        .then((res) => {
          this.reacts.push(res.data);
        })
        .catch((error) => {
          console.error('Error fetching reacts:', error);
        });
    },

    hasImages(postId) {
      return this.images.some((image) => image.publication_id === postId);
    },
    addImages(publication_id, imageSrc) {
      let image = {
        image: imageSrc,
        publication_id: publication_id,
      };
      imagesServices.addImages(image);
    },
    addVideos(publication_id, videoSrc) {
      let video = {
        video: videoSrc,
        publication_id: publication_id,
      };
      VideosServices.addVideos(video);
    },
    getImages() {
      this.images = [];
      for (let i = 0; i < this.posts.length; i++) {
        imagesServices
          .getImages(this.posts[i].id)
          .then((res) => {
            this.images.push(...res.data);
          })
          .catch((error) => {
            console.error("Error fetching images:", error);
          });
      }
    },
    getVideos() {
      this.videos = [];
      for (let i = 0; i < this.posts.length; i++) {
        VideosServices
          .getVideos(this.posts[i].id)
          .then((res) => {
            this.videos.push(...res.data);
          })
          .catch((error) => {
            console.error("Error fetching images:", error);
          });
      }
    },
    handleButtonClick(postId) {
      this.toggleModal();
      this.getComments(postId);
      this.postID = postId;
    },
    getPublications() {
      PublicationServices.getPublications(this.responsable_id).then((res) => {
        this.posts = res.data;
        this.getImages();
        this.getVideos();
        //console.log(this.videos);
        this.posts.forEach(post => {
          this.getReact(post.id);
        });
        this.posts.forEach(post => {
          this.fetchNbReactsForPost(post);
        });
      }).catch((error) => {
        console.error('Error fetching messages:', error);
      });
    },
    addNewPublication() {
      let post = {
        description: this.description,
        responsable_id: this.responsable_id,
      };

      Swal.fire({
        title: "Confirmer l'ajout de la publication",
        text: "Êtes-vous sûr(e) de vouloir ajouter cette publication sur Facebook ?",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Oui, ajouter",
        cancelButtonText: "Annuler",
      }).then((result) => {
        if (result.isConfirmed) {
          this.publishOnFacebook();
        } else {
          PublicationServices.addPublication(post)
            .then((response) => {
              const post_id = response.data.id;

              const imageFiles =
                document.getElementById("photoInput").files;

              if (imageFiles.length > 0) {
                imageFiles.forEach((file) => {
                  const reader = new FileReader();
                  reader.readAsDataURL(file);

                  reader.onload = (e) => {
                    const imageSrc = e.target.result;
                    this.addImages(post_id, imageSrc);
                  };
                });
              }

              const videoFiles =
                document.getElementById("videoInput").files;

              if (videoFiles.length > 0) {
                videoFiles.forEach((file) => {
                  const reader = new FileReader();
                  reader.readAsDataURL(file);

                  reader.onload = (e) => {
                    const VideoSrc = e.target.result;
                    this.addVideos(post_id, VideoSrc);
                  };
                });
              }

              Swal.fire({
                title: "Publication ajoutée",
                text: "La nouvelle publication a été ajoutée avec succès.",
                icon: "success",
              });
              this.getPublications();
              this.description = "";
            })
            .catch((error) => {
              console.error(
                "Erreur lors de l'ajout de la publication :",
                error
              );
              Swal.fire({
                title: "Erreur",
                text: "Une erreur s'est produite lors de l'ajout de la publication.",
                icon: "error",
              });
            });
        }
      });
    },
    deletePublication(publicationID) {
      Swal.fire({
        title: "Êtes-vous sûr(e) ?",
        text: "Vous ne pourrez pas revenir en arrière !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Oui, supprimez-le !",
      }).then((result) => {
        if (result.isConfirmed) {
          PublicationServices.deletePublication(publicationID)
            .then(() => {
              this.posts = this.posts.filter(
                (post) => post.id !== publicationID
              );
              Swal.fire({
                title: "Supprimé !",
                text: "Votre publication a été supprimée.",
                icon: "success",
              });
            })
            .catch((error) => {
              console.error(
                "Erreur lors de la suppression de la publication :",
                error
              );
              Swal.fire({
                title: "Erreur !",
                text: "Une erreur s'est produite lors de la suppression de la publication.",
                icon: "error",
              });
            });
        }
      });
    },

    /*publishOnFacebook() {
      const message = 'Hello, world!'; // Le message à publier
      this.publishOnFacebooke(message);
    },*/
    getTokenFromLocalStorage() {
      const token = localStorage.getItem("token");
      return token;
    },

    async publishOnFacebook() {
      const facebookAuthUrl = 'https://www.facebook.com/dialog/oauth?client_id=960934052353025&redirect_uri=https://graph.facebook.com/&response_type=EABonunGQrgEBO68QXmxg7ZB00xBUZAhvZCQm1ZCj6WIQ9RRGyLDxfCkGHa2f1kxHs2NG2lAzbVb2xztOwfIvCknAru7Ax2kla86oNoaR2BvIo5KO3ZAdnIGM2M8p2KVCwJlxPN2oOLtssFjVoH3AQ09bZCWZBf4GXxPymgI82CdDRCe5FSdCQsIUnEqBv5P5fvaob0oRkAPgQhsnWLHOW6SspcZD';
      window.open(facebookAuthUrl, '_blank');
    },

    async getFacebookPost() {
      try {
        const response = await axios.get("/page/posts", {
          params: {
            access_token:
              "EABonunGQrgEBO5zVmR9tVIw0DJA9GTkGZCZCAHfWVrkZB7mcqKBCSbdpp9PzrV8ClIgNf3ghXTQ1kY2QbbFAX0TZCQynw4G3bExkRpKzgnG6OCSCvKiEGauilvIpgFAdDULatdxNiHo0nQ6Kj1fQVutCMULQc72Q2POfSREZB5VzjmZAxuKYIImSypedEGMU9FvVLU1MLUjk6YIS4J22mI91kZD",
            fields: "message,created_time",
            limit: 1,
          },
        });

        const facebookPost = response.data.data[0];

        console.log(facebookPost);
      } catch (error) {
        console.error(
          "Erreur lors de la récupération de la publication sur Facebook :",
          error
        );
      }
    },

    getComments(publicationID) {
      commentairesServices.getComments(publicationID).then((res) => {
        this.comments = res.data;
      }).catch((error) => {
        console.error('Error fetching messages:', error);
      });
    },
    addComment() {
      let commentaire = {
        description: this.descCommentaire,
        publication_id: this.postID,
        user_id: this.responsable_id,
      };
      commentairesServices
        .addComment(commentaire)
        .then(() => {
          // Optionally, refresh the list of comments for the publication
          this.getComments(this.postID);
          this.descCommentaire = "";
        })
        .catch((error) => {
          console.error("Erreur lors de l'ajout du commentaire :", error);
          Swal.fire({
            title: "Erreur",
            text: "Une erreur s'est produite lors de l'ajout du commentaire.",
            icon: "error",
          });
        });
    },
    toggleModal() {
      this.isModalActive = !this.isModalActive;
    },
  },
};
</script>



<style scoped>
.to span {
  font-size: 13px;
}

section {
  padding-top: 80px;
}

.text-j {
  font-size: 13px;
  padding-left: 3px;
}

.publier {
  width: 90%;
  height: 105px;
  background-color: var(--nav-bar-color);
  box-shadow: 1px 2px 4px #cacaca;
  margin-top: 10px;
  margin-left: 50px;
  margin-right: 50px;
  padding: 15px;
  border-radius: 10px;
  border: 1px solid #e9e9e9;
  margin-bottom: 20px;
  color: var(--text-color);
}

.publier input {
  width: 60%;
  margin-left: 10px;
  margin-right: 5px;
  height: 35px;
}

.pub-titre {
  color: #fff;
}

.search__input {
  font-family: inherit;
  font-size: inherit;
  background-color: #f8f9fa;
  border: none;
  color: #646464;
  padding: 0.7rem 1rem;
  border-radius: 30px;
  width: 12em;
  transition: all ease-in-out 0.5s;
  margin-right: -2rem;
}

.search__input:hover,
.search__input:focus {
  box-shadow: 0 0 1em #00000013;
}

.search__input:focus {
  outline: none;
  background-color: #f0eeee;
}

.search__input::-webkit-input-placeholder {
  font-weight: 100;
  color: #ccc;
}

.search__input:focus+.search__button {
  background-color: #f0eeee;
}

.publier hr {
  margin-left: 40px;
  margin-right: 40px;
  margin-top: 10px;
  margin-bottom: 9px;
}

.choix {
  display: flex;
  justify-content: center;
  gap: 50px;
}

label {
  cursor: pointer;
  color: var(--text-color);
}

.publier button {
  height: 32px;
  font-family: inherit;
  font-size: 10px;
  background: #1168eb;
  color: white;
  padding: 0.7em 1em;
  padding-left: 0.9em;
  display: flex;
  align-items: center;
  border: none;
  border-radius: 16px;
  overflow: hidden;
  transition: all 0.2s;
  cursor: pointer;
}

.publier button span {
  display: block;
  margin-left: 0.3em;
  transition: all 0.3s ease-in-out;
}

.publier button svg {
  display: block;
  transform-origin: center center;
  transition: transform 0.3s ease-in-out;
}

.publier button:hover .svg-wrapper {
  animation: fly-1 0.6s ease-in-out infinite alternate;
}

.publier button:hover svg {
  transform: translateX(1.2em) rotate(45deg) scale(1.1);
}

.publier button:hover span {
  transform: translateX(5em);
}

.publier button:active {
  transform: scale(0.95);
}

@keyframes fly-1 {
  from {
    transform: translateY(0.1em);
  }

  to {
    transform: translateY(-0.1em);
  }
}

.facebook-post {
  background-color: var(--nav-bar-color);
  color: var(--text-color);
  margin-left: 50px;
  margin-right: 20px;
  margin-bottom: 20px;
  border-radius: 10px;
  padding: 1.5rem;
  border: 1px solid black;
  box-shadow: 3px 3px 10px grey;
}

.facebook-post .post-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.facebook-post .post-header .user-profile-image img {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  margin-right: 0.5rem;
}

.facebook-post .post-header .user-info span {
  display: block;
  margin-left: 7px;
}

.facebook-post .post-header .user-info span:last-of-type {
  font-size: 0.7rem;
  margin-top: -0.33rem;
}

.facebook-post .post-header img.icon {
  max-width: 15px;
}

.facebook-post .post-header img.icon:first-of-type {
  margin-left: auto;
  margin-right: 1rem;
}

.icons-container {
  margin-right: 10px;
}

.icons-container i {
  margin-left: 10px;
  cursor: pointer;
  font-size: 18px;
}

.facebook-post .post img {
  height: 400px;
  width: 100%;
  background-color: var(--fb-post);
  margin: 1rem 0px;
  border-radius: 2rem;
}

.facebook-post .post p {
  text-align: justify;
}

.facebook-post .post .discription p {
  padding: 15px 10px 0px 10px;
  color: var(--text-color);
}

.facebook-post .post-interactions {
  display: flex;
  align-items: center;
  position: relative;
  gap: 0 0.25rem;
}

.facebook-post .post-interactions button {
  width: 100%;
  padding: 0.5rem 0.33rem;
  border-radius: 0.5rem;
  border: none;
  background-color: var(--fb-post-btn-bg);
  color: var(--fb-post-btn-color);
  cursor: pointer;
  transition: background 0.3s ease;
  margin-top: 25px;
  align-items: center;
}

.facebook-post .post-interactions button:hover {
  background-color: var(--fb-post-btn-bg-hover);
}

.facebook-post .post-interactions button:hover span {
  top: -15px;
  opacity: 1;
  pointer-events: auto;
}

.facebook-post .post-interactions button span {
  position: absolute;
  pointer-events: none;
  opacity: 0;
  top: 0;
  left: 0;
  background-color: var(--body-color);
  border-radius: 5rem;
  display: flex;
  padding: 0.33rem;
  gap: 0.25rem;
  transition: top 0.3s 0.5s ease, opacity 0.3s 0.5s ease;
}

.facebook-post .post-interactions button span img {
  width: 40px;
  cursor: pointer;
  transition: transform 0.3s ease;
}

.facebook-post .post-interactions button span img:hover {
  transform: scale(1.3) translateY(-1rem);
}

.modal-container {
  /* display: none; */
  visibility: hidden;
  position: fixed;
  top: 0;
  width: 100vw;
  height: 100vh;
  transition: visibility 0.4s;
  z-index: 100;
}

.modal-container.active {
  /* display: block; */
  visibility: visible;
}

.overlay {
  opacity: 0;
  position: absolute;
  width: 100%;
  height: 100%;
  background: #333333d3;
  transition: opacity 0.4s 0.2s ease-out;
}

.modal-container.active .overlay {
  opacity: 1;
  transition: opacity 0.4s ease-out;
}

.modal1 {
  opacity: 0;
  width: 95%;
  max-width: 500px;
  min-width: 300px;
  padding: 30px;
  background: #fff;
  border-radius: 5px;
  position: relative;
  height: 70vh;
  transition: opacity 0.4s ease-out, transform 0.4s ease-out;
  top: 40%;
  left: 50%;
}

.modal-container.active .modal1 {
  opacity: 1;
  transform: translate(-50%, -50%);
  transition: opacity 0.4s 0.2s ease-out, transform 0.4s 0.2s ease-out;
}

.close-modal {
  padding: 8px 10px;
  border: none;
  border-radius: 5px;
  font-size: 18px;
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
  background: #ff365e;
  color: #fff;
}

.modal1 h1 {
  margin-bottom: 10px;
  font-family: Montserrat, sans-serif;
  font-weight: 500;
}

.modal1 p {
  line-height: 1.4;
  margin-bottom: 5px;
}

.head {
  text-transform: uppercase;
  margin-bottom: 20px;
}

.text {
  margin: 10px 0;
  font-family: sans-serif;
  font-size: 0.9em;
}

.commentbox {
  display: flex;
  justify-content: flex-start;
  padding: 10px;
  position: fixed;
  bottom: 0;
  width: 90%;
  background-color: #ffffff;
  border-top: 1px solid #cccccc;
  z-index: 999;
}

.commentbox>img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  /* float: left; */
  margin-right: 20px;
  object-fit: cover;
  object-position: center;
}

.content {
  width: 100%;
}

.user {
  border: none;
  outline: none;
  margin: 5px 0;
  color: #808080;
  margin-left: 20px;
  padding: 10px;
}

.commentinput>input {
  border: none;
  padding: 10px;
  padding-left: 0;
  outline: none;
  border-bottom: 2px solid blue;
  margin-bottom: 10px;
  width: 95%;
}

.buttons {
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: #808080;
}

.buttons>button {
  padding: 5px 10px;
  background: lightgrey;
  color: #808080;
  text-transform: uppercase;
  border: none;
  outline: none;
  border-radius: 3px;
  cursor: pointer;
}

.buttons>button.abled {
  background: blue;
  color: #fff;
}

.parents {
  font-family: Arial, sans-serif;
  display: flex;
  margin-bottom: 30px;
}

.parents h1 {
  font-size: 0.9em;
}

.parents p {
  margin: 10px 0;
  font-size: 0.9em;
}

.parents>img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 20px;
  object-fit: cover;
  object-position: center;
}

.engagements {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.engagements img {
  width: 20px;
}

.engagements img:nth-child(1) {
  margin-right: 10px;
  width: 25px;
}

.date {
  color: #808080;
  font-size: 0.8em;
}

.comments {
  overflow-y: auto;
  max-height: 250px;
  padding-top: 20px;
}

.information-etudiant {
  display: block;
  margin-right: 20px;
}

.Nouvelleinscrit {
  width: 100%;
  background-color: var(--nav-bar-color);
  box-shadow: 1px 2px 4px #cacaca;
  margin: 10px;
  padding: 20px;
  border-radius: 10px;
  border: 1px solid #e9e9e9;
  margin-bottom: 20px;
  color: var(--text-color);
}

.voir-tout-link {
  color: royalblue;
  font-size: small;
  text-transform: lowercase;
  text-decoration: underline;
  cursor: pointer;
  display: flex;
  align-items: center;
  font-weight: 400;
}

.flex-container {
  display: flex;
  justify-content: space-between;
  margin-bottom: 0;
}

.flex-item {
  display: inline-flex;
}

.flex-item img {
  padding-bottom: 2px;
  padding-left: 2px;
}

hr {
  margin-top: 0;
  height: 1px;
}

.Nouvelleinscrit h5 {
  font-size: 14px;
}

.Nouvelleinscrit h6 {
  font-size: 15;
}

.inscrit {
  padding: 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #ccc;
}

.user-info {
  display: flex;
  align-items: center;
}

.profile-image {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  margin-right: 10px;
}

.info {
  padding-left: 10px;
}

.info h6 {
  font-size: 13px;
  margin: 0;
}

.info span {
  color: grey;
  font-size: 12px;
  margin: 0;
}

.btn {
  border-radius: 50px;
  font-size: 10px;
}

.Jardin {
  width: 100%;
  background-color: var(--nav-bar-color);
  box-shadow: 1px 2px 4px #cacaca;
  margin: 10px;
  padding: 20px;
  border-radius: 10px;
  border: 1px solid #e9e9e9;
  margin-bottom: 20px;
  color: var(--text-color);
}

.flex-item h5 {
  font-size: 14px;
}

.flex-container {
  display: flex;
  justify-content: space-between;
}

.badge-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.badge-info {
  width: calc(33.33% - 10px);
  margin-bottom: 20px;
  text-align: center;
}

.to .badge {
  position: absolute;
  top: -20px;
  left: 0px;
}

.to img {
  width: 60%;
}

.to {
  padding: 10px;
}

.button a {
  position: fixed;
  bottom: 20px;
  right: 20px;
  color: #fff;
  background: #2980b9;
  padding: 7px 12px;
  font-size: 18px;
  border-radius: 6px;
  box-shadow: rgba(0, 0, 0, 0.15);
}

.to .badge img {
  height: 32px;
  width: 32px;
  border-radius: 50%;
}

@media (max-width: 1024px) {
  .facebook-post .post img {
    height: 270px;
    width: 100%;
    background-color: var(--fb-post);
    margin: 1rem 0px;
    border-radius: 2rem;
  }

  .facebook-post .post p {
    font-size: 15px;
  }

  .information-personnel .photo-profile {
    width: 100px;
    height: 100px;
  }

  .information-personnel a {
    font-size: 15px;
  }

  .information-personnel h4 {
    font-size: 16px;
  }

  .user-info span {
    padding-left: 10px;
  }

  .Nouvelleinscrit h5 {
    font-size: 15px;
  }

  .Nouvelleinscrit .flex-item img {
    display: none;
  }

  .Nouvelleinscrit .flex-container a {
    font-size: 14px;
  }

  .inscrit .user-info img {
    height: 40px;
    width: 40px;
  }

  .inscrit .info h6 {
    font-size: 13px;
  }

  .info span {
    font-size: 9px;
    padding-left: 0;
  }

  .inscrit button {
    width: 90px;
    height: 40px;
    font-size: 10px;
  }

  .Jardin h5 {
    font-size: 15px;
  }

  .Jardin .flex-item img {
    display: none;
  }

  .to .badge img {
    height: 25px;
    width: 25px;
  }

  .to .badge {
    left: -10px;
  }
}

@media (max-width: 790px) {
  .information-personnel {
    display: none;
  }

  .information {
    display: block;
    color: white;
    font-size: 15px;
  }

  .facebook-post .post img {
    height: 250px;
    width: 100%;
    background-color: var(--fb-post);
    margin: 1rem 0px;
    border-radius: 2rem;
  }
}
</style>