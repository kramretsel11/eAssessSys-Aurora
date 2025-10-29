<template>
  <div>
    <navbar btn-background="bg-gradient-primary" />
    <div
      class="pt-5 m-3 page-header align-items-start min-vh-50 pb-11 border-radius-lg"
      :style="{
        backgroundImage:
          'url(' + require('@/assets/img/curved-images/masthead5.jpg') + ')',
      }"
    >
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="mx-auto text-center col-lg-5">
            <h1 class="mt-5 mb-2 text-white">Welcome Property Owner!</h1>
            <p class="text-white text-lead">
              Use this form to track your request assessment of you land property.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="mx-auto col-xl-4 col-lg-5 col-md-7">
          <div class="card z-index-0">
            <div class="pt-4 text-center card-header">
              <h5>Track With</h5>
            </div>
            <div class="card-body">
              <form @submit.prevent="trackRequest" class="mb-4">
                <div class="form-group mb-3">
                  <label>ARP No.</label>
                  <input v-model="form.arpNo" type="text" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                  <label>Owner Name</label>
                  <input v-model="form.ownerName" type="text" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Track Request</button>
              </form>

              <!-- Result Card -->
              <div v-if="request" class="card">
                <div class="card-body">
                  <h6 class="mb-3">Request Details</h6>
                  <div class="row">
                    <div class="col-md-6">
                      <p><strong>ARP No:</strong> {{ request.arpNo }}</p>
                      <p><strong>PIN:</strong> {{ request.pin }}</p>
                      <p><strong>Owner Name:</strong> {{ request.ownerName }}</p>
                      <p><strong>Municipality:</strong> {{ request.municipality }}</p>
                    </div>
                    <div class="col-md-6">
                      <p><strong>Status:</strong> <span :class="getStatusClass">{{ getStatusText }}</span></p>
                      <p><strong>Submission Date:</strong> {{ formatDate(request.created_at) }}</p>
                      <p><strong>Last Updated:</strong> {{ formatDate(request.updated_at) }}</p>
                    </div>
                  </div>

                  <!-- Timeline -->
                  <div class="mt-4">
                    <h6>Request Timeline</h6>
                    <div class="timeline mt-3">
                      <div class="timeline-item" v-for="(status, index) in requestTimeline" :key="index">
                        <div class="timeline-marker" :class="status.done ? 'bg-success' : 'bg-secondary'"></div>
                        <div class="timeline-content">
                          <h3 class="timeline-title">{{ status.title }}</h3>
                          <p v-if="status.date" class="timeline-date">{{ formatDate(status.date) }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from 'sweetalert2';
import Navbar from "@/examples/PageLayout/Navbar.vue";
// import AppFooter from "@/examples/PageLayout/Footer.vue";
// import SoftInput from "@/components/SoftInput.vue";
// import SoftCheckbox from "@/components/SoftCheckbox.vue";
// import SoftButton from "@/components/SoftButton.vue";

import { mapMutations } from "vuex";

export default {
  name: "SignupBasic",
  data() {
    return {
      form: {
        arpNo: '',
        ownerName: ''
      },
      request: null
    };
  },
  components: {
    Navbar,
    // AppFooter,
    // SoftInput,
    // SoftCheckbox,
    // SoftButton,
  },
  computed: {
    getStatusText() {
      if (!this.request) return '';
      const status = this.tryParseStatus(this.request.requestStatus);
      return typeof status === 'string' ? status : 'Pending';
    },
    getStatusClass() {
      const status = this.getStatusText.toLowerCase();
      const classes = {
        pending: 'text-warning',
        approved: 'text-success',
        rejected: 'text-danger',
        'under review': 'text-info'
      };
      return classes[status] || 'text-secondary';
    },
    requestTimeline() {
      const timeline = [
        {
          title: 'Request Submitted',
          done: true,
          date: this.request?.created_at
        },
        {
          title: 'Under Review',
          done: this.getStatusText !== 'Pending',
          date: this.getStatusText !== 'Pending' ? this.request?.updated_at : null
        },
        {
          title: 'Final Decision',
          done: ['Approved', 'Rejected'].includes(this.getStatusText),
          date: ['Approved', 'Rejected'].includes(this.getStatusText) ? this.request?.updated_at : null
        }
      ];
      return timeline;
    }
  },
  created() {
    this.toggleEveryDisplay();
    this.toggleHideConfig();
  },
  beforeUnmount() {
    this.toggleEveryDisplay();
    this.toggleHideConfig();
  },
  methods: {
    ...mapMutations(["toggleEveryDisplay", "toggleHideConfig"]),
    formatDate(date) {
      if (!date) return 'N/A';
      return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
      });
    },
    tryParseStatus(status) {
      if (!status) return '';
      try {
        return JSON.parse(status);
      } catch (e) {
        return status;
      }
    },
    async trackRequest() {
      try {
        const response = await this.$api.post('/e_assessment/api/v1/misc/assessment-requests/track', this.form);
        this.request = response.data.data;
      } catch (error) {
        console.error('Track error:', error);
        const errorMessage = error.response?.data?.message || 'Request not found';
        Swal.fire('Error', errorMessage, 'error');
      }
    }
  },
};
</script>



<style scoped>
.timeline {
  position: relative;
  padding: 20px 0;
}

.timeline-item {
  display: flex;
  margin-bottom: 20px;
}

.timeline-marker {
  z-index: 999 !important;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  margin-right: -15px;
  margin-top: 5px;
}

.timeline-content {
  flex: 1;
}

.timeline-title {
  font-size: 1rem;
  margin: 0;
}

.timeline-date {
  font-size: 0.875rem;
  color: #666;
  margin: 5px 0 0;
}

.timeline::before {
  content: '';
  position: absolute;
  top: 0;
  left: 7px;
  height: 100%;
  width: 2px;
  background: #e9ecef;
}
</style>
