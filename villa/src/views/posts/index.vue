<script setup>
// Import ref and onMounted
import { ref, onMounted } from 'vue';

// Import api
import api from '../../api';

// Define state
const villas = ref([]);

// Method fetchDataVillas
const fetchDataVillas = async () => {
    // Fetch data
    await api.get('/villas') // Pastikan URL sesuai dengan API Laravel Anda
        .then(response => {
            // Set response data to state "villas"
            villas.value = response.data; // Sesuaikan dengan struktur response
        });
};

// Run hook "onMounted"
onMounted(() => {
    // Call method "fetchDataVillas"
    fetchDataVillas();
});

// Method deleteVilla
const deleteVilla = async (id) => {
    // Delete villa with API
    await api.delete(`/villas/${id}`) // Pastikan URL sesuai dengan API Laravel Anda
        .then(() => {
            // Call method "fetchDataVillas"
            fetchDataVillas();
        });
};
</script>

<template>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <router-link :to="{ name: 'villas.create' }" class="btn btn-md btn-success rounded shadow mb-3">
                    <i class="bi bi-plus-circle me-2"></i> Add New Villa
                </router-link>
                <div class="card border-0 rounded shadow-lg">
                    <div class="card-body p-4">
                        <h4 class="card-title text-center mb-4">Villa Management</h4>
                        <table class="table table-hover align-middle">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Capacity</th>
                                    <th scope="col" style="width:15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="villas.length === 0">
                                    <td colspan="5" class="text-center">
                                        <div class="alert alert-danger mb-0">
                                            <i class="bi bi-exclamation-circle me-2"></i> Data Belum Tersedia!
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else v-for="(villa, index) in villas" :key="index">
                                    <td class="fw-semibold">{{ villa.name }}</td>
                                    <td>{{ villa.description }}</td>
                                    <td>Rp {{ villa.price.toLocaleString() }}</td>
                                    <td>{{ villa.capacity }} Orang</td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'villas.edit', params: { id: villa.id } }" 
                                            class="btn btn-sm btn-primary rounded-pill shadow me-2">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </router-link>
                                        <button @click.prevent="deleteVilla(villa.id)" 
                                            class="btn btn-sm btn-danger rounded-pill shadow">
                                            <i class="bi bi-trash-fill"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
