<template>
  <div class="container-fluid">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Recommend Requests</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>ARP</th>
                <th>Owner</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="r in requests" :key="r.id">
                <td>{{ r.arpNo }}</td>
                <td>{{ r.ownerName }}</td>
                <td>{{ tryParse(r.requestStatus) }}</td>
                <td>
                  <button class="btn btn-sm btn-primary" @click="recommend(r)">Recommend</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
  name: 'Recommend',
  data() { return { requests: [] }; },
  created() { this.fetch(); },
  methods: {
    async fetch() {
      try { const res = await axios.get('/e_assessment/api/v1/misc/assessment-requests'); this.requests = res.data.data || []; } catch(e){console.error(e);}    
    },
    tryParse(txt){ if(!txt) return ''; try { const p = JSON.parse(txt); return typeof p === 'string' ? p : JSON.stringify(p); } catch(e){ return txt; } },
    async recommend(r){
      try{
        const payload = { id: r.id, requestStatus: { recommendedBy: (this.$store?.state?.auth?.user?.id || 0), status: 'recommended', date: new Date().toISOString() } };
        await axios.post('/e_assessment/api/v1/misc/assessment-requests/update-status', payload);
        Swal.fire('Recommended', 'Request marked as recommended', 'success');
        this.fetch();
      } catch(e){ console.error(e); Swal.fire('Error','Failed','error'); }
    }
  }
}
</script>
