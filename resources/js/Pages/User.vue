<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">User</h2>
        </template>



        <div class="py-12" v-if="CreateON">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold">Créer un nouvel utilisateur</h2>
                    
                    <form @submit.prevent="createUser">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="name" v-model="newUser.name" placeholder="Nom" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>

                        <div class="mb-4">
                            <label for="pseudo" class="block text-sm font-medium text-gray-700">Pseudo</label>
                            <input type="text" id="pseudo" v-model="newUser.pseudo" placeholder="Pseudo" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" v-model="newUser.email" placeholder="Email" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                            <input type="password" id="password" v-model="newUser.password" placeholder="Mot de passe" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        
                        <div class="mt-6">
                            <button type="submit" class="bg-purple-700 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded">
                                Créer l'utilisateur
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
                    <h2 class="text-lg font-semibold">Modifier un utilisateur</h2>
                    
                    <form @submit.prevent="editeUser">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="name" v-model="EditUser.name" placeholder="Nom" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>

                        <div class="mb-4">
                            <label for="pseudo" class="block text-sm font-medium text-gray-700">Pseudo</label>
                            <input type="text" id="pseudo" v-model="EditUser.pseudo" placeholder="Pseudo" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" v-model="EditUser.email" placeholder="Email" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                            <input type="password" id="password" v-model="EditUser.password" placeholder="Mot de passe" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        
                        <div class="mt-6">
                            <button type="submit" class="bg-purple-700 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded">
                                Modifier l'utilisateur
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
                            <h3 class="text-lg font-semibold">Liste des utilisateurs</h3>
                            <button @click="newCreateON()" class="bg-purple-700 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded">
                                Nouvel utilisateur
                            </button>
                        </div>

                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pseudo</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Password</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IsAdmin</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user in users">
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ user.id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ user.image }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ user.name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ user.pseudo }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ user.email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">. . .</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ user.isAdmin }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">
                                            <button @click="setEditUserUuid(user.uuid)" class="bg-blue-500 hover:bg-blue-400 text-white font-semibold py-2 px-4 rounded mr-2">
                                                Modifier
                                            </button>
                                            <button class="bg-red-500 hover:bg-red-400 text-white font-semibold py-2 px-4 rounded" @click="deleteUser(user.uuid)">
                                                Supprimer
                                            </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <Pagination :total="totalPages" :current.sync="currentPage" @page-change="fetchUsers"/>
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
    this.fetchUsers();
  },  
  methods: {
    async fetchUsers() { 
        const token = localStorage.getItem("token");

        const response = await axios
            .get("http://localhost:3000/api/users", {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
                params: {
                    page: this.currentPage,
                    perPage: this.perPage,
                },
            })
            .then((response) => {
                this.users = response.data;
                this.totalUsers = response.data.total;
            })
            .catch((error) => {
                console.log(error);
            });
    },
    async getEditUser(uuid) {
        const token = localStorage.getItem("token");
        // const currentURL = window.location.pathname;
        // const uuid = currentURL.substring(currentURL.lastIndexOf('/') + 1);
        
        const responseUser = await axios.get(`http://localhost:3000/api/users/${this.EditUserUuid}`, {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        });
        this.EditUser = responseUser.data;
        console.log(responseUser.data);
    },
    async editeUser() {
        const token = localStorage.getItem("token");
        await axios.put(`http://localhost:3000/api/users/${this.EditUserUuid}`, this.EditUser, {
            headers: {
            Authorization: `Bearer ${token}`,
            },
        });
        window.location.href = '/user';
        this.EditON = false;
    },
    async createUser() {
      try {
        const token = localStorage.getItem("token");
        const response = await axios.post("http://localhost:3000/api/users", this.newUser, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        window.location.href = '/user';
        console.log(response.data);
      } catch (error) {
        console.log(error);
      }
    },
    async deleteUser(UserUuid) {
        try {
        const token = localStorage.getItem("token");
        await axios.delete(`http://localhost:3000/api/users/${UserUuid}`, {
            headers: {
            Authorization: `Bearer ${token}`,
            },
        });
        this.fetchUsers();
        } catch (error) {
            if (error.response && error.response.status === 400) {
                const errorMessage = error.response.data.error;
                if (errorMessage === 'You cannot delete the last admin user.') {
                alert('Impossible de supprimer le dernier utilisateur administrateur.');
                }
            } else {
                console.log(error);
            }
        }
    },
    setEditUserUuid(uuid) {
        this.EditUserUuid = uuid;
        if(this.EditON == false){
            this.EditON = true;
        }else{
            this.EditON = false;
        }
        this.getEditUser();
    },
    newCreateON() {
        
  this.CreateON = !this.CreateON;
  console.log(this.CreateON);
    },
  },

  computed: {
    totalPages() {
      return Math.ceil(this.totalUsers / this.perPage);
    },
  },

  data() {
    return {
      CreateON: false,
      EditON: ref(false),
      EditUserUuid: null,
      users: [],
      EditUser: {
        name: '',
        pseudo: '',
        email: '',
        password: '',
      },
      newUser: {
        name: '',
        pseudo: '',
        email: '',
        password: '',
      },
      currentPage: 1,
      perPage: 10,
      totalUsers: 0,
    };
  },
};
</script>
