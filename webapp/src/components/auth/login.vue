<template>
    <div>
      <div class="app-content content">
        <div class="content-wrapper">
          <div class="content-header row">
          </div>
          <div class="content-body"><section class="flexbox-container">
            <div class="col-12 d-flex align-items-center justify-content-center">
              <div class="col-md-4 col-10 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 m-0">
                  <div class="card-header border-0">
                    <div class="card-title text-center">
                      <!--                      <div class="p-1"><img src="../../../app-assets/images/logo/logo-dark.png" alt="branding logo"></div>-->
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Login</span></h6>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      <form class="form-horizontal form-simple" @submit.prevent="login"  @keydown="form.onKeydown($event)" enctype="multipart/form-data">
                        <fieldset class="form-group position-relative has-icon-left mb-0">
                          <input type="email" v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control form-control-lg input-lg" id="email" placeholder="Your Email">
                          <div class="form-control-position">
                            <i class="ft-user"></i>
                          </div>
                          <has-error :form="form" field="email"></has-error>
                        </fieldset>
                        <br>
                        <fieldset class="form-group position-relative has-icon-left">
                          <input type="password" v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control form-control-lg input-lg" id="password" placeholder="Enter Password">
                          <div class="form-control-position">
                            <i class="fa fa-key"></i>
                          </div>
                          <has-error :form="form" field="password"></has-error>
                        </fieldset>
                        <div class="form-group row">
                          <div class="col-md-6 col-12 text-center text-md-left">
                            <fieldset>
                              <input type="checkbox" id="remember-me" class="chk-remember">
                              <label for="remember-me"> Remember Me</label>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-12 text-center text-md-right"><a href="/" class="card-link">Forgot Password?</a></div>
                        </div>
                        <button type="submit" :disabled="form.busy" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
                      </form>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="">
                      <p class="float-sm-left text-center m-0"><a href="/" class="card-link">Recover password</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          </div>
        </div>
      </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex';
    import store from "../../store";

    export default {
      name: "Login",
      data() {
        return {
          form: new Form({
            email: '',
            password: '',
          })
        }
      },
      methods: {
        ...mapActions({
          signIn: 'auth/signIn'
        }),
        login() {
          this.signIn(this.form)
            .then(()=>{
              if(store.getters["auth/authenticated"] !== undefined ) {
                this.$router.push('/');
                Toast.fire({
                  icon: 'success',
                  title: 'Login successful'
                });
              } else {
                Toast.fire({
                  icon: 'error',
                  title: 'Please fill the form properly!'
                });
              }
            });
        }
      }
    }
</script>

<style scoped>

</style>
