<template>
  <div class="container-fluid">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Assessment Requests</h6>
      </div>
      <div class="card-body">
        <div class="mb-3 d-flex justify-content-end">
          <button class="btn btn-primary" @click="startNew">Add Request</button>
        </div>

        <div v-if="showForm" class="card mb-3">
          <div class="card-body">
            <h6>Step {{ step }} / 3</h6>

            <div v-show="step === 1">
              <h6 class="mt-3">Property & Owner Information</h6>
              <div class="row">
                <div class="col-md-6">
                  <label>ARP No</label>
                  <input v-model="form.arpNo" class="form-control" />
                </div>
                <div class="col-md-6">
                  <label>PIN</label>
                  <input v-model="form.pin" class="form-control" />
                </div>
                <div class="col-md-6 mt-2">
                  <label>Assessment Type</label>
                  <select v-model="form.categoryId" class="form-control">
                    <option value="">Select Assessment Type</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                  </select>
                </div>
                <div class="col-md-6 mt-2">
                  <label>Owner Name</label>
                  <input v-model="form.ownerName" class="form-control" />
                </div>
                <div class="col-md-6 mt-2">
                  <label>Married To</label>
                  <input v-model="form.marriedTo" class="form-control" />
                </div>
                <div class="col-md-6 mt-2">
                  <label>Owner Address</label>
                  <input v-model="form.ownerAddress" class="form-control" />
                </div>
                <div class="col-md-6 mt-2">
                  <label>Contact No</label>
                  <input v-model="form.contactNo" class="form-control" />
                </div>
                <div class="col-md-6 mt-2">
                  <label>TIN</label>
                  <input v-model="form.tin" class="form-control" />
                </div>
                <div class="col-12"><hr /></div>
                <div class="col-md-6 mt-2">
                  <label>Admin Name</label>
                  <input v-model="form.adminName" class="form-control" />
                </div>
                <div class="col-md-6 mt-2">
                  <label>Admin Married To</label>
                  <input v-model="form.adminMarriedTo" class="form-control" />
                </div>
                <!-- adminMarriedTo: '',
                    adminAddress: '',
                    adminTin: '',
                    street: '',
                    barangay: '',
                    municipality: '',
                    province: '',
                    octTctCloaNo: '',
                    surveyNo: '',
                    lotNo: '',
                    areaNo: '', -->
                <div class="col-md-6 mt-2">
                  <label>Admin Address</label>
                  <input v-model="form.adminAddress" class="form-control" />
                </div>
                <div class="col-md-6 mt-2">
                  <label>Admin Contact No</label>
                  <input v-model="form.contactNo" class="form-control" />
                </div>
                <div class="col-md-6 mt-2">
                  <label>Admin TIN</label>
                  <input v-model="form.adminTin" class="form-control" />
                </div>
                <div class="col-12"><hr /></div>
                <div class="col-md-6 mt-2">
                  <label>Street</label>
                  <input v-model="form.street" class="form-control" />
                </div>
                <div class="col-md-6 mt-2">
                  <label>Barangay</label>
                  <input v-model="form.barangay" class="form-control" />
                </div>
                <div class="col-md-6 mt-2">
                  <label>Municipality</label>
                  <input v-model="form.municipality" class="form-control" />
                </div>
                <div class="col-md-6 mt-2">
                  <label>Province</label>
                  <input v-model="form.province" class="form-control" />
                </div>
                <div class="col-md-6 mt-2">
                  <label>OCT/TCT/CLOA No.</label>
                  <input v-model="form.octTctCloaNo" class="form-control" />
                </div>
                <div class="col-md-6 mt-2">
                  <label>Survey No.</label>
                  <input v-model="form.surveyNo" class="form-control" />
                </div>
                <div class="col-md-6 mt-2">
                  <label>Lot No.</label>
                  <input v-model="form.lotNo" class="form-control" />
                </div>
                <div class="col-md-6 mt-2">
                  <label>Area</label>
                  <input v-model="form.areaNo" class="form-control" />
                </div>


              </div>
            </div>

            <div v-show="step === 2">
              <h6 class="mt-3">General Description</h6>
              <div class="row g-3">
                <!-- General Description -->
                <div class="col-md-4">
                  <label>Kind of Building</label>
                  <select v-model="form.generalDescription.kindOfBldg" class="form-control">
                    <option value="">Select Type</option>
                    <option value="Residential">Residential</option>
                    <option value="Agricultural">Agricultural</option>
                    <option value="Commercial">Commercial</option>
                    <option value="Industrial">Industrial</option>
                    <option value="Mineral">Mineral</option>
                    <option value="Timberland">Timberland</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label>Structural Type</label>
                  <input v-model="form.generalDescription.structuralType" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label>Building Permit</label>
                  <input v-model="form.generalDescription.bldgPermit" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label>Date Issued</label>
                  <input v-model="form.generalDescription.dateIssued" type="date" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label>CCT</label>
                  <input v-model="form.generalDescription.cct" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label>Certificate of Completion Issued On</label>
                  <input v-model="form.generalDescription.certificateCompletionIssuedOn" type="date" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label>Certificate of Occupancy Issued On</label>
                  <input v-model="form.generalDescription.certificateOccupancyIssuedOn" type="date" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label>Date Constructed</label>
                  <input v-model="form.generalDescription.dateConstructed" type="date" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label>Date Occupied</label>
                  <input v-model="form.generalDescription.dateOccupied" type="date" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label>Building Age</label>
                  <input v-model="form.generalDescription.bldgAge" type="number" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label>No. of Storeys</label>
                  <input v-model="form.generalDescription.noOfStoreys" type="number" class="form-control" />
                </div>
                <div class="col-md-4">
                  <label>1st Floor Area</label>
                  <input v-model="form.generalDescription.area1st" type="number" class="form-control" @input="calculateTotalFloorArea" />
                </div>
                <div class="col-md-4">
                  <label>2nd Floor Area</label>
                  <input v-model="form.generalDescription.area2nd" type="number" class="form-control" @input="calculateTotalFloorArea" />
                </div>
                <div class="col-md-4">
                  <label>3rd Floor Area</label>
                  <input v-model="form.generalDescription.area3rd" type="number" class="form-control" @input="calculateTotalFloorArea" />
                </div>
                <div class="col-md-4">
                  <label>4th Floor Area</label>
                  <input v-model="form.generalDescription.area4th" type="number" class="form-control" @input="calculateTotalFloorArea" />
                </div>
                <div class="col-md-4">
                  <label>Total Floor Area</label>
                  <input v-model="form.generalDescription.totalFloorArea" type="number" class="form-control" readonly />
                </div>

                <!-- Structural Checklist -->
                <div class="col-12 mb-3">
                  <h6>Structural Checklist</h6>
                  <div class="row g-3">
                    <div class="col-md-4">
                      <label>Roof</label>
                      <textarea v-model="form.structuralChecklist.Roof" class="form-control" rows="3" placeholder="Enter items, one per line"></textarea>
                    </div>
                    <div class="col-md-4">
                      <label>Flooring</label>
                      <textarea v-model="form.structuralChecklist.Flooring" class="form-control" rows="3" placeholder="Enter items, one per line"></textarea>
                    </div>
                    <div class="col-md-4">
                      <label>Walls & Partitions</label>
                      <textarea v-model="form.structuralChecklist.WallsPartions" class="form-control" rows="3" placeholder="Enter items, one per line"></textarea>
                    </div>
                  </div>
                </div>

                <!-- Additional Items -->
                <div class="col-12 mb-3">
                  <h6>Additional Items</h6>
                  <textarea v-model="form.additionalItems" class="form-control" rows="2" placeholder="Enter additional items, one per line"></textarea>
                </div>

                <!-- Property Appraisal -->
                <div class="col-12 mb-3">
                  <h6>Property Appraisal</h6>
                  <div class="row g-3">
                    <div class="col-md-3">
                      <label>Unit</label>
                      <input v-model="form.propertyAppraisal.unit" class="form-control" />
                    </div>
                    <div class="col-md-3">
                      <label>Unit Cost</label>
                      <input v-model="form.propertyAppraisal.unitCost" type="number" class="form-control" />
                    </div>
                    <div class="col-md-3">
                      <label>Computation</label>
                      <input v-model="form.propertyAppraisal.computation" class="form-control" />
                    </div>
                    <div class="col-md-3">
                      <label>Sub Total</label>
                      <input v-model="form.propertyAppraisal.subTotal" type="number" class="form-control" readonly />
                    </div>
                  </div>
                </div>

                <!-- Property Boundaries -->
                <div class="col-12 mb-3">
                  <h6>Property Boundaries</h6>
                  <div class="row g-3">
                    <div class="col-md-3">
                      <label>North</label>
                      <input v-model="form.propertyBounderies.north" class="form-control" />
                    </div>
                    <div class="col-md-3">
                      <label>East</label>
                      <input v-model="form.propertyBounderies.east" class="form-control" />
                    </div>
                    <div class="col-md-3">
                      <label>West</label>
                      <input v-model="form.propertyBounderies.west" class="form-control" />
                    </div>
                    <div class="col-md-3">
                      <label>South</label>
                      <input v-model="form.propertyBounderies.south" class="form-control" />
                    </div>
                  </div>
                </div>

                <!-- Property Assessment -->
                <div class="col-12">
                  <h6>Property Assessment</h6>
                  <div class="row g-3">
                    <div class="col-md-4">
                      <div class="form-check">
                        <input v-model="form.propertyAssessment.taxable" type="checkbox" class="form-check-input" id="taxable">
                        <label class="form-check-label" for="taxable">Taxable</label>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-check">
                        <input v-model="form.propertyAssessment.exempt" type="checkbox" class="form-check-input" id="exempt">
                        <label class="form-check-label" for="exempt">Exempt</label>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <label>Effectivity</label>
                      <input v-model="form.propertyAssessment.effectivity" type="date" class="form-control" />
                    </div>
                  </div>

                  <!-- Assessment Values -->
                  <div class="mt-3">
                    <h6>Property Assessment</h6>
                    <div v-for="(value, index) in form.propertyAssessment.values" :key="index" class="row g-3 mb-2">
                      <div class="col-md-3">
                        <label>Actual Use</label>
                        <input v-model="value.actualUse" class="form-control" />
                      </div>
                      <div class="col-md-3">
                        <label>Market Value</label>
                        <input v-model="value.marketValue" type="number" class="form-control" />
                      </div>
                      <div class="col-md-2">
                        <label>Assessment Level</label>
                        <input v-model="value.assessmentLevel" type="number" class="form-control" />
                      </div>
                      <div class="col-md-3">
                        <label>Assessed Value</label>
                        <input v-model="value.assessedValue" type="number" class="form-control" />
                      </div>
                      <div class="col-md-1 d-flex align-items-end ">
                        <button @click="removeAssessmentValue(index)" type="button" class="btn btn-sm btn-outline-danger">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <button @click="addAssessmentValue" type="button" class="btn btn-sm btn-outline-primary mt-2">
                      Add Assessment Value
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div v-show="step === 3">
              <h6 class="mt-3">Summary & Memoranda</h6>
              
              <!-- Step 1 Summary -->
              <div class="card mb-3">
                <div class="card-header">
                  <h6 class="mb-0">Property & Owner Information Summary</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <p><strong>ARP No:</strong> {{ form.arpNo }}</p>
                      <p><strong>PIN:</strong> {{ form.pin }}</p>
                      <p><strong>Owner Name:</strong> {{ form.ownerName }}</p>
                      <p><strong>Married To:</strong> {{ form.marriedTo }}</p>
                      <p><strong>Contact No:</strong> {{ form.contactNo }}</p>
                      <p><strong>TIN:</strong> {{ form.tin }}</p>
                    </div>
                    <div class="col-md-6">
                      <p><strong>Admin Name:</strong> {{ form.adminName }}</p>
                      <p><strong>Admin Contact:</strong> {{ form.adminContactNo }}</p>
                      <p><strong>Street:</strong> {{ form.street }}</p>
                      <p><strong>Barangay:</strong> {{ form.barangay }}</p>
                      <p><strong>Owner Address:</strong> {{ form.ownerAddress }}</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Step 2 Summary -->
              <div class="card mb-3">
                <div class="card-header">
                  <h6 class="mb-0">Building & Assessment Summary</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <!-- General Description Summary -->
                    <div class="col-12">
                      <h6>General Description</h6>
                      <div class="row">
                        <div class="col-md-4">
                          <p><strong>Kind of Building:</strong> {{ form.generalDescription.kindOfBldg }}</p>
                          <p><strong>Structural Type:</strong> {{ form.generalDescription.structuralType }}</p>
                          <p><strong>Building Permit:</strong> {{ form.generalDescription.bldgPermit }}</p>
                          <p><strong>Building Age:</strong> {{ form.generalDescription.bldgAge }} years</p>
                        </div>
                        <div class="col-md-4">
                          <p><strong>No. of Storeys:</strong> {{ form.generalDescription.noOfStoreys }}</p>
                          <p><strong>Total Floor Area:</strong> {{ form.generalDescription.totalFloorArea }} sq.m.</p>
                          <p><strong>Date Constructed:</strong> {{ form.generalDescription.dateConstructed }}</p>
                          <p><strong>Date Occupied:</strong> {{ form.generalDescription.dateOccupied }}</p>
                        </div>
                      </div>
                    </div>

                    <!-- Property Assessment Summary -->
                    <div class="col-12 mt-3">
                      <h6>Property Assessment</h6>
                      <div class="row">
                        <div class="col-md-6">
                          <p><strong>Status:</strong> {{ form.propertyAssessment.taxable ? 'Taxable' : 'Non-Taxable' }}</p>
                          <p><strong>Effectivity:</strong> {{ form.propertyAssessment.effectivity }}</p>
                        </div>
                        <div class="col-md-6">
                          <p><strong>Total Assessment Values:</strong> {{ form.propertyAssessment.values.length }}</p>
                          <p><strong>Property Appraisal Total:</strong> {{ form.propertyAppraisal.subTotal }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Memoranda -->
              <div>
                <label>Memoranda</label>
                <textarea v-model="form.memorada" class="form-control" rows="4" placeholder="Memoranda"></textarea>
              </div>
            </div>

            <div class="d-flex justify-content-between mt-3">
              <button class="btn btn-secondary" @click="prevStep" :disabled="step===1">Previous</button>
              <div>
                <button class="btn btn-light me-2" @click="cancelForm">Cancel</button>
                <button class="btn btn-primary" @click="nextStep">
                    {{ buttonText(step) }}
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- List -->
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>ARP No</th>
                <th>PIN</th>
                <th>Owner</th>
                <th>Municipality</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="r in requests" :key="r.id">
                <td>{{ r.arpNo }}</td>
                <td>{{ r.pin }}</td>
                <td>{{ r.ownerName }}</td>
                <td>{{ r.municipality }}</td>
                <td>{{ tryParseRequestStatus(r.requestStatus) }}</td>
                <td>
                  <button class="btn btn-sm btn-outline-primary me-2" @click="editRequest(r)">Edit</button>
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
import Swal from 'sweetalert2';

export default {
  name: 'Requests',
  data() {
    return {
      requests: [],
      assessmentLevels: [],
      categories: [],
      showForm: false,
      step: 1,
      editing: false,
      form: {
        id: null,
        arpNo: '',
        pin: '',
        categoryId: '',
        ownerName: '',
        marriedTo: '',
        ownerAddress: '',
        contactNo: '',
        tin: '',
        adminName: '',
        adminContactNo: '',
        adminMarriedTo: '',
        adminAddress: '',
        adminTin: '',
        street: '',
        barangay: '',
        municipality: '',
        province: '',
        octTctCloaNo: '',
        surveyNo: '',
        lotNo: '',
        areaNo: '',
        memorada: '',
        generalDescription: {
          kindOfBldg: '',
          structuralType: '',
          bldgPermit: '',
          dateIssued: '',
          cct: '',
          certificateCompletionIssuedOn: '',
          certificateOccupancyIssuedOn: '',
          dateConstructed: '',
          dateOccupied: '',
          bldgAge: 0,
          noOfStoreys: 0,
          area1st: 0,
          area2nd: 0,
          area3rd: 0,
          area4th: 0,
          totalFloorArea: 0
        },
        structuralChecklist: {
          Roof: [],
          Flooring: [],
          WallsPartions: []
        },
        additionalItems: [],
        propertyAppraisal: {
          unit: '',
          unitCost: 0,
          computation: '',
          subTotal: 0
        },
        propertyBounderies: {
          north: '',
          east: '',
          west: '',
          south: ''
        },
        landAppraisal: [],
        otherImprovements: [],
        propertyAssessment: {
          taxable: false,
          exempt: false,
          effectivity: '',
          values: []
        }
      },
      requestStatusText: '',
    };
  },
  created() {
    this.fetch();
    this.fetchAssessmentLevels();
    this.fetchCategories();
  },
  methods: {
    async fetch() {
      try {
        const res = await this.$api.get('/e_assessment/api/v1/misc/assessment-requests');
        this.requests = res.data.data || [];
      } catch (e) {
        console.error(e);
      }
    },
    async fetchAssessmentLevels() {
      try {
        const res = await this.$api.get('/e_assessment/api/v1/misc/assessment-levels');
        this.assessmentLevels = res.data.data || [];
      } catch (e) { console.error(e); }
    },
    async fetchCategories() {
      try {
        const res = await this.$api.get('/e_assessment/api/v1/misc/categories');
        // Filter only assessment type categories
        this.categories = (res.data.data || []).filter(cat => cat.type.toLowerCase() === 'assessment');
      } catch (e) { console.error(e); }
    },
    startNew() {
      this.resetForm();
      this.showForm = true;
      this.step = 1;
      this.editing = false;
    },
    resetForm() {
      this.form = {
        id: null,
        arpNo: '',
        pin: '',
        categoryId: '',
        ownerName: '',
        marriedTo: '',
        ownerAddress: '',
        contactNo: '',
        tin: '',
        adminName: '',
        adminContactNo: '',
        street: '',
        barangay: '',
        municipality: '',
        province: '',
        memorada: '',
        generalDescription: {
          kindOfBldg: '',
          structuralType: '',
          bldgPermit: '',
          dateIssued: '',
          cct: '',
          certificateCompletionIssuedOn: '',
          certificateOccupancyIssuedOn: '',
          dateConstructed: '',
          dateOccupied: '',
          bldgAge: 0,
          noOfStoreys: 0,
          area1st: 0,
          area2nd: 0,
          area3rd: 0,
          area4th: 0,
          totalFloorArea: 0
        },
        structuralChecklist: {
          Roof: [],
          Flooring: [],
          WallsPartions: []
        },
        additionalItems: [],
        propertyAppraisal: {
          unit: '',
          unitCost: 0,
          computation: '',
          subTotal: 0
        },
        propertyBounderies: {
          north: '',
          east: '',
          west: '',
          south: ''
        },
        landAppraisal: [],
        otherImprovements: [],
        propertyAssessment: {
          taxable: false,
          exempt: false,
          effectivity: '',
          values: []
        }
      };
      this.requestStatusText = '';
    },
    addAssessmentValue() {
      this.form.propertyAssessment.values.push({
        actualUse: '',
        marketValue: 0,
        assessmentLevel: 0,
        assessedValue: 0
      });
    },
    removeAssessmentValue(index) {
      this.form.propertyAssessment.values.splice(index, 1);
    },
    // Convert textarea input to array for structural checklist
    handleStructuralChecklistInput(field, value) {
      this.form.structuralChecklist[field] = value.split('\n').filter(item => item.trim());
    },
    // Calculate sub total when unit cost changes
    calculateSubTotal() {
      const { unit, unitCost } = this.form.propertyAppraisal;
      if (unit && unitCost) {
        this.form.propertyAppraisal.subTotal = parseFloat(unitCost);
      }
    },
    calculateTotalFloorArea() {
      const { area1st, area2nd, area3rd, area4th } = this.form.generalDescription;
      this.form.generalDescription.totalFloorArea = [area1st, area2nd, area3rd, area4th]
        .map(area => parseFloat(area) || 0)
        .reduce((sum, area) => sum + area, 0);
    },
    buttonText(step) {
      if (step < 3) return 'Next';
      return this.editing ? 'Update' : 'Submit';
    },
    prevStep() { if (this.step > 1) this.step--; },
    async nextStep() {
      if (this.step < 3) { this.step++; return; }

      // submit
      try {
        const payload = { ...this.form };
        // Ensure arrays are properly formatted
        payload.structuralChecklist = {
          Roof: Array.isArray(payload.structuralChecklist.Roof) ? payload.structuralChecklist.Roof : payload.structuralChecklist.Roof.split('\n').filter(item => item.trim()),
          Flooring: Array.isArray(payload.structuralChecklist.Flooring) ? payload.structuralChecklist.Flooring : payload.structuralChecklist.Flooring.split('\n').filter(item => item.trim()),
          WallsPartions: Array.isArray(payload.structuralChecklist.WallsPartions) ? payload.structuralChecklist.WallsPartions : payload.structuralChecklist.WallsPartions.split('\n').filter(item => item.trim())
        };
        payload.additionalItems = Array.isArray(payload.additionalItems) ? payload.additionalItems : payload.additionalItems.split('\n').filter(item => item.trim());
        payload.requestStatus = this.safeParse(this.requestStatusText);

        if (this.editing) {
          await this.$api.post('/e_assessment/api/v1/misc/assessment-requests/update', payload);
          Swal.fire('Updated', 'Request updated', 'success');
        } else {
          await this.$api.post('/e_assessment/api/v1/misc/assessment-requests/create', payload);
          Swal.fire('Created', 'Request created', 'success');
        }
        this.showForm = false;
        this.fetch();
      } catch (e) {
        console.error(e);
        Swal.fire('Error', 'Save failed', 'error');
      }
    },
    cancelForm() { this.showForm = false; },
    editRequest(r) {
      this.editing = true;
      this.showForm = true;
      this.step = 1;
      // populate
      this.form = { ...r };
      // parse JSON fields if present
      this.generalDescriptionText = this.safeStringify(r.generalDescription);
      this.structuralChecklistText = this.safeStringify(r.structuralChecklist);
      this.propertyAppraisalText = this.safeStringify(r.propertyAppraisal);
      this.requestStatusText = this.safeStringify(r.requestStatus);
    },
    safeParse(text) {
      if (!text) return null;
      try { return JSON.parse(text); } catch (e) {
        // if user entered JSON-like in textarea as string, attempt to parse
        try { return JSON.parse(text.replaceAll("'", '"')); } catch (_) { return text; }
      }
    },
    safeStringify(val) {
      if (!val) return '';
      try { return typeof val === 'string' ? val : JSON.stringify(JSON.parse(val), null, 2); } catch (e) {
        try { return JSON.stringify(val, null, 2); } catch (_) { return String(val); }
      }
    },
    tryParseRequestStatus(txt) {
      if (!txt) return '';
      try { const parsed = JSON.parse(txt); return typeof parsed === 'string' ? parsed : JSON.stringify(parsed); } catch (e) { return txt; }
    }
  }
}
</script>

<style scoped>
textarea.form-control { font-family: monospace; }
</style>
