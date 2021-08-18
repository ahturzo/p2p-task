<template>
    <div>
      <div class="main-menu menu-fixed menu-dark menu-accordion    menu-shadow " data-scroll-to-active="false">
        <div class="main-menu-content">
          <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" navigation-header"><span data-i18n="nav.category.forms">Forms</span><i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Forms"></i>
            </li>
            <li><router-link class="menu-item" to="/"><i class="icon-home"></i> Home</router-link></li>
            <li><router-link class="menu-item" to="/users"><i class="icon-user"></i> User</router-link></li>
            <li><router-link class="menu-item" to="/companies"><i class="fa fa-briefcase"></i> Company</router-link></li>
            <li><router-link class="menu-item" to="/employees"><i class="fa fa-users"></i> Employee</router-link></li>
          </ul>
        </div>
      </div>
    </div>
</template>

<script>
    export default {
        name: "leftSideBar"
    }
</script>

<style scoped>

</style>
