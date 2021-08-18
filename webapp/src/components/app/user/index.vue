<template>
    <div>
        <TopNav></TopNav>
        <LeftSideBar></LeftSideBar>

      <div class="app-content content">
        <div class="content-wrapper">
          <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-1">
              <h3 class="content-header-title">Users</h3>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                  <li class="breadcrumb-item active">Users</li>
                </ol>
              </div>
            </div>
          </div>

        <!-- Default ordering table -->
        <section id="ordering">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">All Users</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered" id="datatable">
                        <thead>
                        <tr>
                          <th width="10px">Sl No.</th>
                          <th>Name</th>
                          <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(users,index) in getAllUsers" :key="users.id">
                            <td>{{ index+1 }}</td>
                            <td>{{ users.name }}</td>
                            <td>{{ users.email }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!--/ Default ordering table -->

        </div>
      </div>
      <Footer></Footer>
    </div>
</template>

<script>
    import TopNav from "../layouts/topNav";
    import LeftSideBar from "../layouts/leftSideBar";
    import Footer from "../layouts/appfooter";

    export default {
      name: "index",
      components: {Footer, LeftSideBar, TopNav},

      created() {
        this.$store.dispatch('getAllUsers');
        var scripts = [
          "./src/assets/robust/app-assets/vendors/js/tables/datatable/datatables.min.js"
        ];
        scripts.forEach(script => {
          let tag = document.createElement("script");
          tag.setAttribute("src", script);
          document.head.appendChild(tag);
        });
      },

      mounted() {
        setTimeout(function (evt) {
          this.jqueryFunction();
        }.bind(this), 3000);
      },

      computed: {
        getAllUsers() {
          return this.$store.getters.getAllUsers;
        },
      },

      methods: {
        jqueryFunction: function () {
          $('#datatable').DataTable();
        },
      }
    }
</script>

<style scoped>

</style>
