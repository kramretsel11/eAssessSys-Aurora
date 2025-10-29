<template>
  <div>
    <div
      class="w-auto h-auto collapse navbar-collapse max-height-vh-100 h-100"
      id="sidenav-collapse-main"
    >
      <ul class="navbar-nav">
        <li class="nav-item">
          <sidenav-collapse navText="Dashboard" :to="{ name: 'Dashboard' }">
            <template #icon>
              <shop />
            </template>
          </sidenav-collapse>
        </li>
        <li class="nav-item">
          <sidenav-collapse navText="Requests" :to="{ name: 'Requests' }">
            <template #icon>
              <shop />
            </template>
          </sidenav-collapse>
        </li>
        <li class="nav-item">
          <sidenav-collapse navText="Settings" :to="{ name: 'Settings' }">
            <template #icon>
              <settings />
            </template>
          </sidenav-collapse>
        </li>
      </ul>
    </div>
    <div class="pt-3 mx-3 mt-3 sidenav-footer">
      <sidenav-card
        :class="cardBg"
        textPrimary="Need Help?"
        textSecondary="Please check our manual"
        route="https://www.creative-tim.com/learning-lab/vue/overview/soft-ui-dashboard/"
        label="E-ASSESSMENT"
        icon="ni ni-diamond"
      />
    </div>
  </div>
</template>
<script>
import SidenavCollapse from "./SidenavCollapse.vue";
import SidenavCard from "./SidenavCard.vue";
import Shop from "../../components/Icon/Shop.vue";
import Settings from "../../components/Icon/Settings.vue";

export default {
  name: "SidenavList",
  props: {
    cardBg: String,
  },
  data() {
    return {
      title: "Soft UI Dashboard PRO",
      controls: "dashboardsExamples",
      isActive: "active",
    };
  },
  components: {
    SidenavCollapse,
    SidenavCard,
    Shop,
    Settings
  },
  methods: {
    getRoute() {
      const routeArr = this.$route.path.split("/");
      return routeArr[1];
    },
  },
};
</script>
