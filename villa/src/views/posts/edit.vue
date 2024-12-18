<script setup>
// Import ref dan lifecycle hooks
import { ref, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import api from "../../api";

// Inisialisasi router dan route
const router = useRouter();
const route = useRoute();

// State untuk form input dan error
const form = ref({
  name: "",
  description: "",
  price: "",
  capacity: "",
});

const errors = ref({}); // Default error object kosong

// Fetch data villa saat komponen dimount
onMounted(async () => {
  try {
    const { data } = await api.get(`/villas/${route.params.id}`);
    // Assign data ke form
    form.value = {
      name: data.data.name || "",
      description: data.data.description || "",
      price: data.data.price || "",
      capacity: data.data.capacity || "",
    };
  } catch (error) {
    console.error("Error fetching villa data:", error);
  }
});

// Fungsi untuk mengupdate villa
const updateVilla = async () => {
  try {
    // Kirim request update data
    await api.put(`/villas/${route.params.id}`, form.value);
    // Redirect ke halaman daftar villa setelah sukses
    router.push("/villas");
  } catch (error) {
    // Tangkap error validasi dan assign ke state errors
    if (error.response?.data?.errors) {
      errors.value = error.response.data.errors;
    } else {
      console.error("Unexpected error occurred:", error);
    }
  }
};
</script>

<template>
  <div class="container mt-5 mb-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card rounded shadow-lg">
          <!-- Header -->
          <div class="card-header text-white text-center fs-4 fw-bold" style="background-color: #808080;">
            <i class="bi bi-pencil-square me-2"></i> Edit Villa
          </div>
          <div class="card-body p-4" style="background-color: #FFFFFF; color: black;">
            <form @submit.prevent="updateVilla">
              <!-- Input Name -->
              <div class="mb-4">
                <label class="form-label fw-bold" style="color: #000000;">Name</label>
                <input
                  v-model="form.name"
                  type="text"
                  class="form-control"
                  style="border: 1px solid #005B96; background-color: #FFFFFF; color: black;"
                  placeholder="Enter villa name"
                />
                <div v-if="errors.name" class="text-danger mt-1">
                  <i class="bi bi-exclamation-circle-fill me-1"></i>{{ errors.name[0] }}
                </div>
              </div>

              <!-- Input Description -->
              <div class="mb-4">
                <label class="form-label fw-bold" style="color: #000000;">Description</label>
                <textarea
                  v-model="form.description"
                  class="form-control"
                  style="border: 1px solid #005B96; background-color: #FFFFFF; color: black;"
                  rows="4"
                  placeholder="Enter villa description"
                ></textarea>
                <div v-if="errors.description" class="text-danger mt-1">
                  <i class="bi bi-exclamation-circle-fill me-1"></i>{{ errors.description[0] }}
                </div>
              </div>

              <!-- Input Price -->
              <div class="mb-4">
                <label class="form-label fw-bold" style="color: #000000;">Price</label>
                <input
                  v-model="form.price"
                  type="number"
                  class="form-control"
                  style="border: 1px solid #005B96; background-color: #FFFFFF; color: black;"
                  placeholder="Enter villa price"
                />
                <div v-if="errors.price" class="text-danger mt-1">
                  <i class="bi bi-exclamation-circle-fill me-1"></i>{{ errors.price[0] }}
                </div>
              </div>

              <!-- Input Capacity -->
              <div class="mb-4">
                <label class="form-label fw-bold" style="color: #000000;">Capacity</label>
                <input
                  v-model="form.capacity"
                  type="number"
                  class="form-control"
                  style="border: 1px solid #005B96; background-color: #FFFFFF; color: black;"
                  placeholder="Enter villa capacity"
                />
                <div v-if="errors.capacity" class="text-danger mt-1">
                  <i class="bi bi-exclamation-circle-fill me-1"></i>{{ errors.capacity[0] }}
                </div>
              </div>

              <!-- Submit Button -->
              <div class="d-flex justify-content-end">
                <button
                  type="submit"
                  class="btn btn-lg rounded shadow-sm"
                  style="background-color:  #000000; color: white;"
                >
                  <i class="bi bi-save me-2"></i> Update Villa
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
