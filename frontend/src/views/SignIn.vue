<template>
  <div>
    <div class="container top-0 position-sticky z-index-sticky">
      <div class="row">
        <div class="col-12">
          <navbar
            is-blur="blur blur-rounded my-3 py-2 start-0 end-0 mx-4 shadow"
            btn-background="bg-gradient-success"
            :dark-mode="true"
          />
        </div>
      </div>
    </div>
    <main class="mt-0 main-content main-content-bg">
      <section>
        <div class="page-header min-vh-75">
          <div class="container">
            <div class="row">
              <div class="mx-auto col-xl-4 col-lg-5 col-md-6 d-flex flex-column">
                <div class="mt-8 card card-plain">
                  <div class="pb-0 card-header text-start">
                    <h3 class="font-weight-bolder text-success text-gradient">
                      Welcome back
                    </h3>
                    <p class="mb-0">Enter your username and password to sign in</p>
                  </div>
                  <div class="card-body" style="background: white !important;">
                    <form role="form" class="text-start" @submit="handleSubmit">
                      <label>Username</label>
                      <soft-input
                        @input="form.username = $event.target.value"
                        id="username"
                        placeholder="Username"
                        name="username"
                      />
                      <label>Password</label>
                      <soft-input
                        @input="form.password = $event.target.value"
                        id="password"
                        type="password"
                        placeholder="Password"
                        name="password"
                      />
                      <soft-switch id="rememberMe" name="rememberMe" checked>
                        Remember me
                      </soft-switch>
                      <div class="text-center">
                        <soft-button
                          class="my-4 mb-2"
                          variant="gradient"
                          color="success"
                          full-width
                          >Login
                        </soft-button>
                      </div>
                    </form>
                  </div>
                  <div class="px-1 pt-0 card-footer px-lg-2" style="background: white !important; padding-left: 25px !important; ">
                    <p class="mx-auto mb-4 text-sm">
                      Do you have a assessment of you land property? <br/>
                      <router-link
                        :to="{ name: 'Track Reference' }"
                        class="text-success text-gradient font-weight-bold"
                        >Track Here</router-link
                      >
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div
                  class="top-0 oblique position-absolute h-100 d-md-block d-none me-n8"
                >
                  <div
                    class="bg-cover oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                    :style="{
                      backgroundImage:
                        'url(' +
                        require('@/assets/img/curved-images/masthead5.jpg') +
                        ')',
                    }"
                  ></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

<script>
import Navbar from "@/examples/PageLayout/Navbar.vue";
// import AppFooter from "@/examples/PageLayout/Footer.vue";
import SoftInput from "@/components/SoftInput.vue";
import SoftSwitch from "@/components/SoftSwitch.vue";
import SoftButton from "@/components/SoftButton.vue";
const body = document.getElementsByTagName("body")[0];
import { mapMutations } from "vuex";

export default {
  name: "SignIn",
  data() {
    return {
      form: {
        username: "",
        password: "",
      },
    };
  },
  components: {
    Navbar,
    // AppFooter,
    SoftInput,
    SoftSwitch,
    SoftButton,
  },
  created() {
    this.toggleEveryDisplay();
    this.toggleHideConfig();
    body.classList.remove("bg-gray-100");
  },
  beforeUnmount() {
    this.toggleEveryDisplay();
    this.toggleHideConfig();
    body.classList.add("bg-gray-100");
  },
  methods: {
    ...mapMutations(["toggleEveryDisplay", "toggleHideConfig"]),
    async handleSubmit(e) {
      e.preventDefault();
      console.log("Form data: ", this.form);
			this.$api.post("auth/login", this.form).then((res) => {
				let response = {...res.data}
        console.log("Login response: ", response)
				if(!response.error){
					
					localStorage.setItem("userToken", response.jwt)
          this.$router.push("/dashboard")
					// if(jwtData.aud === 'admin'){
					// 	this.$router.push("/dashboard")
					// } else if(jwtData.aud === 'user'){
          //   this.$router.push("/")
          // }
				} else {
				// show Error
					this.$message.error(response.message)
				}
			}).catch((err) => {
        console.log("Login error: ", err)
      });
		},
  },
};
</script>
