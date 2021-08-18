<template>
    <div>
      <TopNav></TopNav>
      <LeftSideBar></LeftSideBar>
      <div class="app-content content">
        <div class="content-wrapper">
          <div class="content-header row">
          </div>

          <div class="content">
            <div class="title m-b-md mt-4 mb-4">
              P2P - Assignment
            </div>
          </div>
          <div class="content-body"><!-- Sales stats -->

          </div>
        </div>
      </div>
      <Footer></Footer>
    </div>
</template>

<script>
    import TopNav from "./layouts/topNav";
    import LeftSideBar from "./layouts/leftSideBar";
    import Footer from "./layouts/appfooter";
    export default {
        name: "dashboard",
        components: {Footer, LeftSideBar, TopNav},
        mounted() {
          this.jqueryFunction();
        },
        methods: {
          jqueryFunction: function () {
            $(window).on("load",function(){
              $(".tweet-slider").unslider({autoplay:!0,arrows:!1,nav:!1,infinite:!0}),
                $(".fb-post-slider").unslider({autoplay:!0,delay:3500,arrows:!1,nav:!1,infinite:!0})
            });
          },
        }
    }
</script>

<style scoped>
  html, body {
    background-color: #fff;
    color: #636b6f;
    font-family: 'Nunito', sans-serif;
    font-weight: 200;
    height: 100vh;
    margin: 0;
  }
  .full-height {
    height: 100vh;
  }
  .flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
  }
  .position-ref {
    position: relative;
  }
  .top-right {
    position: absolute;
    right: 10px;
    top: 18px;
  }
  .content {
    text-align: center;
  }
  .title {
    font-size: 84px;
  }
  .links > a {
    color: #636b6f;
    padding: 0 25px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: .1rem;
    text-decoration: none;
    text-transform: uppercase;
  }
  .m-b-md {
    margin-bottom: 30px;
  }
</style>
