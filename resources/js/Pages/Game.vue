<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Game" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Game</h2>
        </template>



        <div class="py-12" v-if="CreateON">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold">Créer une nouvelle catégorie</h2>
                    
                    <form @submit.prevent="createGame">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="name" v-model="newGame.name" placeholder="Nom" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        <div class="mb-4">
                            <label for="dateSortie" class="block text-sm font-medium text-gray-700">Date de Sortie</label>
                            <input type="datetime-local" id="dateSortie" v-model="newGame.dateSortie" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        <div class="mb-4">
                            <label for="developpement" class="block text-sm font-medium text-gray-700">Developpement</label>
                            <input type="text" id="developpement" v-model="newGame.developpement" placeholder="developpement" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        <div class="mb-4">
                            <label for="edition" class="block text-sm font-medium text-gray-700">Edition</label>
                            <input type="text" id="edition" v-model="newGame.edition" placeholder="edition" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea rows="5" cols="33" id="description" v-model="newGame.description" placeholder="Description" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required></textarea>
                        </div>
                        
                        <div class="mt-6">
                            <button type="submit" class="bg-purple-700 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded">
                                Créer le nouveau jeu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            </div>
        </div>

        <div class="py-12" v-else-if="EditON">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold">Modifier le jeu</h2>
                    
                    <form @submit.prevent="editeGame">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="name" v-model="EditGame.name" placeholder="Nom" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        <div class="mb-4">
                            <label for="dateSortie" class="block text-sm font-medium text-gray-700">Date de Sortie</label>
                            <input type="datetime-local" id="dateSortie" v-model="EditGame.dateSortie" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        <div class="mb-4">
                            <label for="developpement" class="block text-sm font-medium text-gray-700">Developpement</label>
                            <input type="text" id="developpement" v-model="EditGame.developpement" placeholder="developpement" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        <div class="mb-4">
                            <label for="edition" class="block text-sm font-medium text-gray-700">Edition</label>
                            <input type="text" id="edition" v-model="EditGame.edition" placeholder="edition" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea rows="5" cols="33" id="description" v-model="EditGame.description" placeholder="Description" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required></textarea>
                        </div>
                        
                        <div class="mt-6">
                            <button type="submit" class="bg-purple-700 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded">
                                Modifier le jeu
                            </button>
                        </div>
                    </form>
                </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12" v-else>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Liste des Jeux</h3>
                            <button @click="newCreateON()" class="bg-purple-700 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded">
                                Nouveau Jeu
                            </button>
                        </div>

                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Sortie</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Developpement</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Edition</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="game in games">
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ game.id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ game.name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ game.image }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ game.dateSortie }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ game.developpement }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ game.edition }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">. . .</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">
                                            <button @click="setEditGameslug(game.slug)" class="bg-blue-500 hover:bg-blue-400 text-white font-semibold py-2 px-4 rounded mr-2">
                                                Modifier
                                            </button>
                                            <button class="bg-red-500 hover:bg-red-400 text-white font-semibold py-2 px-4 rounded" @click="deleteGame(game.slug)">
                                                Supprimer
                                            </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <Pagination :total="totalPages" :current.sync="currentPage" @page-change="fetchGame"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import axios from "axios";
import { ref } from 'vue';

export default {
  async mounted() {
    this.fetchGame();
  },  
  methods: {
    async fetchGame() {

        const response = await axios
            .get("http://localhost:3000/api/games", {
                params: {
                    page: this.currentPage,
                    perPage: this.perPage,
                },
            })
            .then((response) => {
                this.games = response.data;
                this.totalGames = response.data.total;
            })
            .catch((error) => {
                console.log(error);
            });
    },
    async getEditGame(slug) {
        const token = localStorage.getItem("token");
        // const currentURL = window.location.pathname;
        // const slug = currentURL.substring(currentURL.lastIndexOf('/') + 1);
        
        const responseGame = await axios.get(`http://localhost:3000/api/games/${this.EditGameslug}`, {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        });
        this.EditGame = responseGame.data;
        console.log(responseGame.data);
    },
    async editeGame() {
        const token = localStorage.getItem("token");
        await axios.put(`http://localhost:3000/api/games/${this.EditGameslug}`, this.EditGame, {
            headers: {
            Authorization: `Bearer ${token}`,
            },
        });
        window.location.href = '/games';
        this.EditON = false;
    },
    async createGame() {
      try {
        const token = localStorage.getItem("token");
        const response = await axios.post("http://localhost:3000/api/games", this.newGame, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        window.location.href = '/games';
        console.log(response.data);
      } catch (error) {
        console.log(error);
      }
    },
    async deleteGame(Gameslug) {
        try {
        const token = localStorage.getItem("token");
        await axios.delete(`http://localhost:3000/api/games/${Gameslug}`, {
            headers: {
            Authorization: `Bearer ${token}`,
            },
        });
        this.fetchGame();
        } catch (error) {
            console.log(error);
        }
    },
    setEditGameslug(slug) {
        this.EditGameslug = slug;
        if(this.EditON == false){
            this.EditON = true;
        }else{
            this.EditON = false;
        }
        this.getEditGame(slug);
    },
    newCreateON() {
        
  this.CreateON = !this.CreateON;
  console.log(this.CreateON);
    },
  },

  computed: {
    totalPages() {
      return Math.ceil(this.totalGames / this.perPage);
    },
  },

  data() {
    return {
      CreateON: false,
      EditON: ref(false),
      EditGameslug: null,
      games: [],
      EditGame: {
        name: '',
        image: '',
        dateStortie: '',
        developpement: '',
        edition: '',
        description: ''
      },
      newGame: {
        name: '',
        image: '',
        dateStortie: '',
        developpement: '',
        edition: '',
        description: ''
      },
      currentPage: 1,
      perPage: 10,
      totalGames: 0,
    };
  },
};
</script>
