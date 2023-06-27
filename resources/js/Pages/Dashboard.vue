<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">User</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Liste des utilisateurs</h3>
                            <Link :href="route('user.store')" class="bg-purple-700 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded">
                                Nouvel utilisateur
                            </Link>
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
                                            <Link :href="`/user/update/${user.uuid}`"  class="bg-blue-500 hover:bg-blue-400 text-white font-semibold py-2 px-4 rounded mr-2">
                                                Modifier
                                            </Link>
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

export default {
  mounted() {
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
            })
            .catch((error) => {
                console.log(error);
            });

      this.users = response.data.data;
      this.totalUsers = response.data.total;
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
  },

  computed: {
    totalPages() {
      return Math.ceil(this.totalUsers / this.perPage);
    },
  },
  data() {
    return {
      users: [],
      currentPage: 1,
      perPage: 10,
      totalUsers: 0,
    };
  },
};
</script>
