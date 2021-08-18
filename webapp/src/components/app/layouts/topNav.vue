<template>
    <div>
      <nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-dark bg-gradient-x-grey-blue">
        <div class="navbar-wrapper">
          <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
              <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
              <li class="nav-item"><a class="navbar-brand" href=""><img class="brand-logo" alt="robust admin logo" src="https://cdn.logo.com/hotlink-ok/logo-social.png">
                <h3 class="brand-text">P2P</h3></a></li>
              <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
            </ul>
          </div>
          <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
              <ul class="nav navbar-nav mr-auto float-left">
                <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu">         </i></a></li>
              </ul>
              <ul class="nav navbar-nav float-right">
                <li class="dropdown dropdown-user nav-item">
                  <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                    <span class="user-name">{{ user.name }}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="#" @click.prevent="signOut"><i class="ft-power"></i> Logout</a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';

    export default {
      name: "topNav",

      computed: {
        ...mapGetters({
          authenticated: 'auth/authenticated',
          user: 'auth/user'
        })
      },

      methods: {
        ...mapActions({
          signOutAction: 'auth/signOut'
        }),
        signOut() {
          this.signOutAction().then(()=> {
            this.$router.push('/login');
          })
        },
        loadImg(image) {
          return 'https://technometrics.sgp1.digitaloceanspaces.com/' + image;
        }
      },

    }
</script>

<style scoped>

</style>
