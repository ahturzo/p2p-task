<template>
    <div>
        <TopNav></TopNav>
        <LeftSideBar></LeftSideBar>

      <div class="app-content content">
        <div class="content-wrapper">
          <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-1">
              <h3 class="content-header-title">Company</h3>
            </div>
            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                  <li class="breadcrumb-item active">Company</li>
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
                  <h4 class="card-title">All Companies <button @click="openModal" class="pull-right btn btn-sm btn-primary text-white"><i class="fa fa-plus"></i> Add Company</button>
                  </h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <div class="table-responsive">
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                          <th>Sl No.</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Website</th>
                          <th>Logo</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(company,index) in getAllCompanies" :key="company.id">
                            <td>{{ index+1 }}</td>
                            <td>{{ company.name }}</td>
                            <td>{{ company.email }}</td>
                            <td><a :href="company.website">{{ company.website }}</a></td>
                            <td><img class="img-thumbnail" :src="'http://127.0.0.1:8000/storage/' + company.logo" height="100" width="100"></td>
                            <td>
                              <div class="btn-group float-md-right">
                                <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-settings mr-1"></i>Action</button>
                                <div class="dropdown-menu arrow" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
                                  <a class="dropdown-item" @click.prevent="editModal(company)"><i class="fa fa-pencil mr-1"></i> Edit</a>
                                  <a class="dropdown-item" @click.prevent="deleteCompany(company)"><i class="fa fa-trash mr-1"></i> Delete</a>
                                </div>
                              </div>
                            </td>
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

        <!-- Modal -->
        <div class="modal fade text-left" id="companyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title" v-show="!editMode">Add New Company</h3>
                <h3 class="modal-title" v-show="editMode">Edit Company</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="editMode ? updateCompany() : addCompany()" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
                <div class="modal-body">
                  <label class="text-danger"><b style="color:#00008B;">Name:</b> *</label>
                  <div class="form-group position-relative has-icon-left">
                    <input type="text" :class="{ 'is-invalid': form.errors.has('name') }" placeholder="Name" class="form-control" v-model="form.name">
                    <div class="form-control-position">
                      <i class="fa fa-plus font-medium-5 line-height-1 text-muted"></i>
                    </div>
                    <has-error :form="form" field="name"></has-error>
                  </div>

                  <label><b>Email:</b> </label>
                  <div class="form-group position-relative has-icon-left">
                    <input type="email" :class="{ 'is-invalid': form.errors.has('email') }" placeholder="Email" class="form-control" v-model="form.email">
                    <div class="form-control-position">
                      <i class="fa fa-plus font-medium-5 line-height-1 text-muted"></i>
                    </div>
                    <has-error :form="form" field="email"></has-error>
                  </div>

                  <label><b>Website:</b></label>
                  <div class="form-group position-relative has-icon-left">
                    <input type="text" :class="{ 'is-invalid': form.errors.has('website') }" placeholder="Website" class="form-control" v-model="form.website">
                    <div class="form-control-position">
                      <i class="fa fa-plus font-medium-5 line-height-1 text-muted"></i>
                    </div>
                    <has-error :form="form" field="website"></has-error>
                  </div>

                  <label class="text-danger"><b style="color:#00008B;">Logo:</b> *</label>
                  <div class="form-group position-relative has-icon-left">
                    <input type="file" name="logo" @change="uploadPP($event)" :class="{ 'is-invalid': form.errors.has('logo') }" class="dropify form-control" data-min-width="100" data-min-height="100" data-allowed-file-extensions="jpg png jpeg">
                    <has-error :form="form" field="logo"></has-error>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" :disabled="form.busy" v-show="!editMode" class="btn btn-success">Save</button>
                  <button type="submit" :disabled="form.busy" v-show="editMode" class="btn btn-success">Update</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <Footer></Footer>
    </div>
</template>

<script>
    import TopNav from "../layouts/topNav";
    import LeftSideBar from "../layouts/leftSideBar";
    import Footer from "../layouts/appfooter";
    import axios from 'axios'

    export default {
        name: "index",

        components: {Footer, LeftSideBar, TopNav},

        data(){
          return {
            editMode: true,
            form: new Form({
              id: '',
              name: '',
              email: '',
              website: '',
              logo: ''
            })
          }
        },

        created() {
          this.$store.dispatch('getAllCompanies');
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
          getAllCompanies() {
            return this.$store.getters.getAllCompanies;
          }
        },

        methods: {
          openModal() {
            this.editMode= false;
            this.form.name = null;
            this.form.email = null;
            this.form.logo = null;
            this.form.website = null;
            $('#companyModal').modal('show');
          },

          uploadPP(event) {
            let file = event.target.files[0];
            let reader = new FileReader();
            reader.onload = event => {
              this.form.logo= event.target.result;
            };
            reader.readAsDataURL(file);
          },

          addCompany() {
            this.form.post('company')
              .then(({data}) => {
                $('#companyModal').modal('hide');
                this.destroyDatatable();
                this.$store.dispatch('getAllCompanies');
                setTimeout(function (evt) {
                  this.jqueryFunction();
                }.bind(this), 3000);
                Toast.fire({
                  icon: 'success',
                  title: data.message,
                  timer: 3000
                });
              })
              .catch((e) => {
                Toast.fire({
                  icon: 'error',
                  title: e.response.data.message,
                  timer: 3000
                });
              })
          },

          editModal(company) {
            this.editMode= true;
            this.form.name = null;
            this.form.email = null;
            this.form.website = null;
            $('#companyModal').modal('show');
            this.form.fill(company);
            this.form.logo = null;
          },

          jqueryFunction: function () {
            $('#datatable').DataTable();
            $('.dropify').dropify();

          },
          destroyDatatable: function () {
            $('#datatable').DataTable().destroy();
          },



          updateCompany() {
            this.form.put('/company/'+this.form.id)
              .then(({data}) => {
                $('#companyModal').modal('hide');
                this.destroyDatatable();
                this.$store.dispatch('getAllCompanies');
                setTimeout(function (evt) {
                  this.jqueryFunction();
                }.bind(this), 1000);
                Toast.fire({
                  icon: 'success',
                  title: data.message,
                  timer: 3000
                });
              })
              .catch((e) => {
                Toast.fire({
                  icon: 'error',
                  title: e.response.data.message,
                  timer: 3000
                });
              })
          },

          deleteCompany(company) {
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                axios.delete('company/'+company.id,{_method: 'delete'});
                this.destroyDatatable();
                this.$store.dispatch('getAllCompanies');
                setTimeout(function (evt) {
                  this.jqueryFunction();
                }.bind(this), 1000);
                Toast.fire({
                  icon: 'success',
                  title: 'Company Deleted successfully',
                  timer: 3000
                });
              }
            })
          }
        },

    }
</script>

<style scoped>

</style>
