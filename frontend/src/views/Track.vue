<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="card">
          <div class="card-header pb-0">
            <h6>Track Assessment Request</h6>
          </div>
          <div class="card-body">
            <!-- Search Form -->
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
</template>

<script>
import Swal from 'sweetalert2';

export default {
  name: 'Track',
  data() {
    return {
      form: {
        arpNo: '',
        ownerName: ''
      },
      request: null
    };
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
  methods: {
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
  }
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
    margin-right: 15px;
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