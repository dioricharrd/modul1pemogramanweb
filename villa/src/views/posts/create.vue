<script setup>
    // Import ref
    import { ref } from "vue";

    // Import router
    import { useRouter } from 'vue-router';

    // Import api
    import api from "../../api";

    // Init router
    const router = useRouter();

    // Define state
    const name = ref("");
    const description = ref("");
    const price = ref("");
    const capacity = ref("");
    const errors = ref([]);

    // Method "storeVilla"
    const storeVilla = async () => {
        // Init formData
        let formData = new FormData();

        // Assign state value to formData
        formData.append("name", name.value);
        formData.append("description", description.value);
        formData.append("price", price.value);
        formData.append("capacity", capacity.value);

        try {
            // Store data with API
            const response = await api.post('/villas', formData);

            // Check if response is successful
            if (response.status === 201) {
                // Redirect after success
                router.push({ path: "/villas" });
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
                        <form @submit.prevent="storeVilla()">
                            <!-- Name -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" class="form-control" v-model="name" placeholder="Villa Name">
                                <div v-if="errors.name" class="alert alert-danger mt-2">
                                    <span>{{ errors.name[0] }}</span>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea class="form-control" v-model="description" rows="5" placeholder="Villa Description"></textarea>
                                <div v-if="errors.description" class="alert alert-danger mt-2">
                                    <span>{{ errors.description[0] }}</span>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Price</label>
                                <input type="number" class="form-control" v-model="price" placeholder="Villa Price">
                                <div v-if="errors.price" class="alert alert-danger mt-2">
                                    <span>{{ errors.price[0] }}</span>
                                </div>
                            </div>

                            <!-- Capacity -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Capacity</label>
                                <input type="number" class="form-control" v-model="capacity" placeholder="Villa Capacity">
                                <div v-if="errors.capacity" class="alert alert-danger mt-2">
                                    <span>{{ errors.capacity[0] }}</span>
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
