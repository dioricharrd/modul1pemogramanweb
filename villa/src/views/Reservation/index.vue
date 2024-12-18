<script setup>
// Import ref and onMounted
import { ref, onMounted } from 'vue';

// Import api
import api from '../../api';

// Define state
const reservations = ref([]);

// Method fetchReservations
const fetchReservations = async () => {
  // Fetch data
  try {
    const response = await api.get('/reservations'); // Make sure the endpoint is correct
    reservations.value = response.data; // Assign response data to "reservations"
  } catch (error) {
    console.error('Error fetching reservations:', error);
  }
};

// Run hook "onMounted"
onMounted(() => {
  // Call method "fetchReservations"
  fetchReservations();
});

// Method deleteReservation
const deleteReservation = async (id) => {
  // Delete reservation with API
  try {
    await api.delete(`/reservations/${id}`); // Make sure the endpoint is correct
    // Call method "fetchReservations" to refresh the list
    fetchReservations();
  } catch (error) {
    console.error('Error deleting reservation:', error);
  }
};
</script>

<template>
  <div class="container mt-5 mb-5">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <router-link :to="{ name: 'reservations.create' }" class="btn btn-md btn-success rounded shadow mb-3">
          <i class="bi bi-plus-circle me-2"></i> Add New Reservation
        </router-link>
        <div class="card border-0 rounded shadow-lg">
          <div class="card-body p-4">
            <h4 class="card-title text-center mb-4">Reservation Management</h4>
            <table class="table table-hover align-middle">
              <thead class="table-dark text-center">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Customer Name</th>
                  <th scope="col">Check-in</th>
                  <th scope="col">Check-out</th>
                  <th scope="col" style="width:15%">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="reservations.length === 0">
                  <td colspan="5" class="text-center">
                    <div class="alert alert-danger mb-0">
                      <i class="bi bi-exclamation-circle me-2"></i> No Reservations Found!
                    </div>
                  </td>
                </tr>
                <tr v-else v-for="reservation in reservations" :key="reservation.id">
                  <td>{{ reservation.id }}</td>
                  <td>{{ reservation.customer_name }}</td>
                  <td>{{ reservation.check_in }}</td>
                  <td>{{ reservation.check_out }}</td>
                  <td class="text-center">
                    <router-link :to="{ name: 'reservations.edit', params: { id: reservation.id } }" 
                      class="btn btn-sm btn-primary rounded-pill shadow me-2">
                      <i class="bi bi-pencil-square"></i> Edit
                    </router-link>
                    <button @click.prevent="deleteReservation(reservation.id)" 
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
