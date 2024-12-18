<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import api from '../../api';

// State untuk form input
const customerName = ref('');
const checkIn = ref('');
const checkOut = ref('');
const reservationId = ref(null);

// Ambil parameter route
const route = useRoute();
const router = useRouter();

// Fungsi untuk mengambil data reservation berdasarkan ID
const fetchReservation = async () => {
  try {
    const response = await api.get(`/reservations/${route.params.id}`);
    const reservation = response.data;
    customerName.value = reservation.customer_name;
    checkIn.value = reservation.check_in;
    checkOut.value = reservation.check_out;
    reservationId.value = reservation.id;
  } catch (error) {
    console.error('Error fetching reservation:', error);
  }
};

// Fungsi untuk mengupdate reservation
const updateReservation = async () => {
  try {
    await api.put(`/reservations/${reservationId.value}`, {
      customer_name: customerName.value,
      check_in: checkIn.value,
      check_out: checkOut.value,
    });
    // Redirect setelah sukses update
    router.push({ name: 'reservations.index' });
  } catch (error) {
    console.error('Error updating reservation:', error);
  }
};

// Fetch data saat komponen di-mount
onMounted(() => {
  fetchReservation();
});
</script>

<template>
  <div class="container mt-5">
    <div class="card border-0 rounded shadow">
      <div class="card-header bg-primary text-white">Edit Reservation</div>
      <div class="card-body">
        <form @submit.prevent="updateReservation">
          <div class="mb-3">
            <label for="customerName" class="form-label">Customer Name</label>
            <input type="text" id="customerName" v-model="customerName" class="form-control" required />
          </div>
          <div class="mb-3">
            <label for="checkIn" class="form-label">Check-in Date</label>
            <input type="date" id="checkIn" v-model="checkIn" class="form-control" required />
          </div>
          <div class="mb-3">
            <label for="checkOut" class="form-label">Check-out Date</label>
            <input type="date" id="checkOut" v-model="checkOut" class="form-control" required />
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</template>
