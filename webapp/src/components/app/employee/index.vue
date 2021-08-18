<template>
  <div>
    <TopNav></TopNav>
    <LeftSideBar></LeftSideBar>


    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-1">
            <h3 class="content-header-title">Employee</h3>
          </div>
          <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                <li class="breadcrumb-item active">Employee</li>
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
                  <h4 class="card-title">All Employees <button @click="openModal" class="pull-right btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Employee</button></h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                      <tr>
                        <th>Sl No.</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr v-for="(employee,index) in getAllEmployees" :key="employee.id">
                        <td>{{ index+1 }}</td>
                        <td>{{ employee.first_name }}</td>
                        <td>{{ employee.last_name }}</td>
                        <td>
                          <div v-if="employee.company">
                            {{ employee.company.name }}
                          </div>
                        </td>
                        <td>{{ employee.email }}</td>
                        <td>{{ employee.phone }}</td>
                        <td>
                          <div class="btn-group float-md-right">
                            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-settings mr-1"></i>Action</button>
                            <div class="dropdown-menu arrow" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
                              <a class="dropdown-item" @click.prevent="editModal(employee)"><i class="fa fa-pencil mr-1"></i> Edit</a>
                              <a class="dropdown-item" @click.prevent="deleteEmployee(employee)"><i class="fa fa-trash mr-1"></i> Delete</a>
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
        </section>
        <!--/ Default ordering table -->
      </div>
    </div>

    <!-- Modal-->
    <div class="modal fade text-left" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" v-show="!editMode">Add New Employee</h3>
            <h3 class="modal-title" v-show="editMode">Edit Employee</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editMode ? updateEmployee() : addEmployee()" @keydown="form.onKeydown($event)">
            <div class="modal-body">

              <label class="text-danger"><b style="color:#00008B;">First Name:</b> *</label>
              <div class="form-group position-relative has-icon-left">
                <input type="text" :class="{ 'is-invalid': form.errors.has('first_name') }" placeholder="First Name" class="form-control" v-model="form.first_name">
                <div class="form-control-position">
                  <i class="fa fa-plus font-medium-5 line-height-1 text-muted"></i>
                </div>
                <has-error :form="form" field="first_name"></has-error>
              </div>

              <label class="text-danger"><b style="color:#00008B;">Last Name:</b> *</label>
              <div class="form-group position-relative has-icon-left">
                <input type="text" :class="{ 'is-invalid': form.errors.has('last_name') }" placeholder="Last Name" class="form-control" v-model="form.last_name">
                <div class="form-control-position">
                  <i class="fa fa-plus font-medium-5 line-height-1 text-muted"></i>
                </div>
                <has-error :form="form" field="last_name"></has-error>
              </div>

              <label class="text-danger"><b style="color:#00008B;">Company</b> *</label>
              <div class="form-group">
                <select id="company_id" class="form-control" :class="{ 'is-invalid': form.errors.has('company_id') }" v-model="form.company_id" style="width: 100%;">
                  <option value="" disabled selected>Select Company...</option>
                  <option v-for="company in getAllCompanies" :value="company.id" >{{ company.name }}</option>
                </select>
                <has-error :form="form" field="company_id"></has-error>
              </div>

              <label><b>Email:</b> </label>
              <div class="form-group position-relative has-icon-left">
                <input type="email" :class="{ 'is-invalid': form.errors.has('email') }" placeholder="Email" class="form-control" v-model="form.email">
                <div class="form-control-position">
                  <i class="fa fa-plus font-medium-5 line-height-1 text-muted"></i>
                </div>
                <has-error :form="form" field="email"></has-error>
              </div>

              <label><b>Phone:</b></label>
              <div class="form-group position-relative has-icon-left">
                <input type="text" :class="{ 'is-invalid': form.errors.has('phone') }" placeholder="Phone" class="form-control" v-model="form.phone">
                <div class="form-control-position">
                  <i class="fa fa-plus font-medium-5 line-height-1 text-muted"></i>
                </div>
                <has-error :form="form" field="phone"></has-error>
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
import axios from "axios";
export default {
  name: "index",
  components: {Footer, LeftSideBar, TopNav},
  data(){
    return {
      editMode: true,
      form: new Form({
        id: '',
        first_name: '',
        last_name: '',
        company_id: '',
        email: '',
        phone: '',
      })
    }
  },
  created() {
    this.$store.dispatch('getAllEmployees');
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
    getAllEmployees() {
      return this.$store.getters.getAllEmployees;
    },
    getAllCompanies() {
      return this.$store.getters.getAllCompanies;
    }
  },
  methods: {
    openModal() {
      this.editMode= false;
      this.form.first_name = null;
      this.form.last_name = null;
      this.form.company_id = null;
      this.form.email = null;
      this.form.phone = null;
      $('#employeeModal').modal('show');
    },

    addEmployee() {
      this.form.post('employee')
        .then(({data}) => {
          $('#employeeModal').modal('hide');
          this.destroyDatatable();
          this.$store.dispatch('getAllEmployees');
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

    editModal(employee) {
      this.editMode= true;
      this.form.first_name = null;
      this.form.last_name = null;
      this.form.company_id = null;
      this.form.email = null;
      this.form.phone = null;
      $('#employeeModal').modal('show');
      this.form.fill(employee);
    },
    jqueryFunction: function () {
      $('#datatable').DataTable();
    },
    destroyDatatable: function () {
      $('#datatable').DataTable().destroy();
    },



    updateEmployee() {
      this.form.put('/employee/'+this.form.id)
        .then(({data}) => {
          $('#employeeModal').modal('hide');
          this.destroyDatatable();
          this.$store.dispatch('getAllEmployees');
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

    deleteEmployee(employee) {
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
          axios.delete('employee/'+employee.id,{_method: 'delete'});
          this.destroyDatatable();
          this.$store.dispatch('getAllEmployees');
          setTimeout(function (evt) {
            this.jqueryFunction();
          }.bind(this), 3000);
          Toast.fire({
            icon: 'success',
            title: 'Employee Deleted successfully',
            timer:3000
          });
        }
      })
    }
  },
}
</script>

<style scoped>
</style>
