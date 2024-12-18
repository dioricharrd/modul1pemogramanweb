<script setup>
    // Import ref
    import { ref } from "vue";

    // Import router
    import { useRouter } from 'vue-router';

    // Import api
    import api from "../../api";

    // Init router
    const router = useRouter();

    // Define state sesuai dengan ReservationController
    const villa_id = ref(""); 
    const customer_name = ref("");
    const check_in = ref("");
    const check_out = ref("");
    const number_of_guests = ref("");
    const errors = ref({});

    // Method "storeReservation"
    const storeReservation = async () => {
        // Init formData
        let formData = new FormData();

        // Assign state value to formData
        formData.append("villa_id", villa_id.value);
        formData.append("customer_name", customer_name.value);
        formData.append("check_in", check_in.value);
        formData.append("check_out", check_out.value);
        formData.append("number_of_guests", number_of_guests.value);

        try {
            // Store data with API
            const response = await api.post('/reservations', formData);

            // Check if response is successful
            if (response.status === 201) {
                // Redirect after success
                router.push({ path: "/reservations" });
            }
        } catch (error) {
            // Handle errors and display error messages
            if (error.response && error.response.data.errors) {
                errors.value = error.response.data.errors;
            } else {
                console.error("An unexpected error occurred:", error);
            }
        }
    };
</script>

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <form @submit.prevent="storeReservation()">
                            <!-- Villa ID -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Villa ID</label>
                                <input type="text" class="form-control" v-model="villa_id" placeholder="Villa ID">
                                <div v-if="errors.villa_id" class="alert alert-danger mt-2">
                                    <span>{{ errors.villa_id[0] }}</span>
                                </div>
                            </div>

                            <!-- Customer Name -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Customer Name</label>
                                <input type="text" class="form-control" v-model="customer_name" placeholder="Customer Name">
                                <div v-if="errors.customer_name" class="alert alert-danger mt-2">
                                    <span>{{ errors.customer_name[0] }}</span>
                                </div>
                            </div>

                            <!-- Check-in Date -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Check-in Date</label>
                                <input type="date" class="form-control" v-model="check_in">
                                <div v-if="errors.check_in" class="alert alert-danger mt-2">
                                    <span>{{ errors.check_in[0] }}</span>
                                </div>
                            </div>

                            <!-- Check-out Date -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Check-out Date</label>
                                <input type="date" class="form-control" v-model="check_out">
                                <div v-if="errors.check_out" class="alert alert-danger mt-2">
                                    <span>{{ errors.check_out[0] }}</span>
                                </div>
                            </div>

                            <!-- Number of Guests -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Number of Guests</label>
                                <input type="number" class="form-control" v-model="number_of_guests" placeholder="Number of Guests">
                                <div v-if="errors.number_of_guests" class="alert alert-danger mt-2">
                                    <span>{{ errors.number_of_guests[0] }}</span>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-md btn-primary rounded-sm shadow border-0">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
