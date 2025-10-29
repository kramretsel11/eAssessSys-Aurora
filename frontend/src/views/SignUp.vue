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
              <form role="form">
                <div class="mb-3">
                  <soft-input
                    id="name"
                    type="text"
                    placeholder="Name"
                    aria-label="Name"
                  />
                </div>
                <div class="mb-3">
                  <soft-input
                    id="referenceNumber"
                    placeholder="Reference Number"
                    aria-label="referenceNumber"
                  />
                </div>
                <soft-checkbox
                  id="flexCheckDefault"
                  name="flexCheckDefault"
                  class="font-weight-light"
                  checked
                >
                  I agree the
                  <a href="javascript:;" class="text-dark font-weight-bolder"
                    >Terms and Conditions</a
                  >
                </soft-checkbox>

                <div class="text-center">
                  <soft-button
                    color="dark"
                    full-width
                    variant="gradient"
                    class="my-4 mb-2"
                    >Get Status</soft-button
                  >
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from "@/examples/PageLayout/Navbar.vue";
// import AppFooter from "@/examples/PageLayout/Footer.vue";
import SoftInput from "@/components/SoftInput.vue";
import SoftCheckbox from "@/components/SoftCheckbox.vue";
import SoftButton from "@/components/SoftButton.vue";

import { mapMutations } from "vuex";

export default {
  name: "SignupBasic",
  components: {
    Navbar,
    // AppFooter,
    SoftInput,
    SoftCheckbox,
    SoftButton,
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
  },
};
</script>
