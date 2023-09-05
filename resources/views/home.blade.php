@include('web_nav')
  <!-- ======================Hero-Section-start====================== -->
  <section id="home">

    <div class="container">
      <div class="row">
      @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
    </div>
@endif
        <!-- ================header-text-start================ -->
        <div class="col-md-5 ">
          <div class="d-flex align-items-center mx-1  main-heading">
            <div class="p-5 mb-5 ">
              <h1 style="font-weight: 700; color: #452C88; ">Your <span style="color: #E45F00;">Easiest</span> way <span
                  class="main-heading-br"><br></span>
                to delivery</h1>
              <p class="fw-normal fs-6 mt-3">
                Lorem ipsum dolor sit amet, consectetur
                adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in </p>
            </div>

          </div>
        </div>
        <!-- ================header-text-End================== -->

        <!-- ================header-img-start================== -->
        <div class="col-md-7">
          <div class="img-div  d-flex align-items-center justify-content-center ">
            <img style="width: 60%;" class=" h-100 mb-5" src="assets/images/header-img.svg" alt="image">
          </div>
        </div>
        <!-- ================header-img-End==================== -->
      </div>
    </div>
  </section>
  <!-- ======================Hero-Section-End======================= -->

  <!-- ====================service-section-start=========================== -->
  <section id="services">
    <div class="container-fluid">
      <!-- ===============heading-start=============== -->
      <div>
        <h2 style="color: #452C88; " class="text-center">Services</h2>
        <p class="text-center fs-6 fw-medium" style="color:#999999; line-height:2.3125rem;">Delivery offers on-demand
          delivery and courier services <br> for
          business and consumers</p>
      </div>
      <!-- ===============heading-End================= -->
      <div class="container-fluid mt-5">
        <div class="row g-lg-5">

          <!-- =================service-box-1-Start================= -->
          <div class="col-md-4">
            <div>
              <div style="height: 200px;">
                <img class="h-100 w-100 " src="assets/images/services-img-1.svg" alt="image">
              </div>
              <div class="service-box">
                <h2 style="color:#452C88;"
                  class="text-center fs-3">Documents And <br> Packages</h2>
                <p style="color:#ABABAB;" class="fw-normal text-center mt-3">Lorem ipsum dolor sit amet, consectetur
                  adipiscing elit,
                  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim </p>
              </div>
            </div>
          </div>
          <!-- =================service-box-1-End=================== -->

          <!-- =================service-box-2-Start================= -->
          <div class="col-md-4">
            <div>
              <div style="height: 200px;">
                <img class="h-100 w-100" src="assets/images/services-img-2.svg" alt="image">
              </div>
              <div class="service-box">
                <h1 style="color:#452C88;"
                  class="text-center fs-3">Heavy And Bulky <br> Goods</h1>
                <p style="color:#ABABAB;" class="fw-normal text-center mt-3">Lorem ipsum dolor sit amet, consectetur
                  adipiscing elit,
                  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim </p>
              </div>
            </div>
          </div>
          <!-- =================service-box-2-End=================== -->
          <!-- =================service-box-3-Start================= -->
          <div class="col-md-4">
            <div>
              <div style="height: 200px;">
                <img class="h-100 w-100" src="assets/images/services-img-3.svg" alt="image">
              </div>
              <div class="service-box">
                <h1 style="color:#452C88;"
                  class="text-center fs-3">Warehouse/ <br> Fulfillment</h1>
                <p style="color:#ABABAB;" class="fw-normal text-center mt-3">Lorem ipsum dolor sit amet, consectetur
                  adipiscing elit,
                  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim </p>
              </div>
            </div>
          </div>
          <!-- =================service-box-3-End=================== -->

        </div>
      </div>
    </div>
  </section>
  <!-- ====================service-section-End============================= -->


  <!-- ====================Plan-section-Start============================= -->
  <section id="plans" style="margin-top:6rem">

    <div class="container-fluid ">
      <!-- ==================heading-start======================= -->
      <div>
        <h2 class="text-center fw-semibold" style="">Choose the plan that’s right for
          <br>
          your business
        </h2>
        <p class="text-center mt-4"><span class="fw-semibold">Start with free plan</span> to
          try our platform for anunlimited period of time.
          <a href="#" style="text-decoration: none; color: #4361EE;">Get Started</a>
        </p>
      </div>
      <!-- ==================heading-End========================= -->

      <div class="container mt-5">
        <div class="row g-lg-5">

          <!-- ==================plan-2-Start========================= -->
          @foreach($data as $key => $value)
          <div class="col-md-4 mt-5">
            <div class="plan-box  " style="box-shadow: 5px 4px 15px 0px #00000040;">
              <div class="py-1 px-3">
                <h2 class=" text-center  pt-2 " style="color: #E45F00; font-weight: 700; font-size: 22px;  ">{{$value['title']}}
                </h2>
                <p class="text-center fw-medium mt-2" style="font-size: 14px;">{{$value['desc']}}</p>
                <p class="fw-semibold mt-3 text-center" style="font-size: 15px;">&#8364 {{$value['price']}} <span
                    class="fw-normal">/mon</span></p>
              </div>
              <!-- ==========list=========== -->
              <div class="py-1 px-3">
                <ul class=" text-decoration-none list-unstyled ">
                  <li style=" font-size: 14px;" class="fw-medium ms-3">Client Panel <img style="width: 14px;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="lorem ipsum the true inpsum"  
                      class="float-end pt-1 me-3" src="assets/images/plan-icon.svg" alt=""></li>
                  <li style=" font-size: 14px; margin-top: 1.5rem;" class="fw-medium ms-3 ">  {{$value['users']}} Users <img data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="lorem ipsum the true inpsum"  
                      style="width: 14px;" class="float-end pt-1 me-3" src="assets/images/plan-icon.svg" alt=""></li>
                  <li style=" font-size: 14px; margin-top: 1.5rem;" class="fw-medium ms-3 ">{{$value['drivers']}} Drivers <img data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="lorem ipsum the true inpsum"  
                      style="width: 14px;" class="float-end pt-1 me-3" src="assets/images/plan-icon.svg" alt=""></li>
                  <li style=" font-size: 14px; margin-top: 1.5rem;" class="fw-medium ms-3 ">{{$value['map_api_call']}} Google Map API Call <img data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="lorem ipsum the true inpsum"  
                      style="width: 14px;" class="float-end pt-1 me-3" src="assets/images/plan-icon.svg" alt=""></li>
                </ul>
              </div>
              <!-- ==========list-end=========== -->
              <div class="buttons justify-content-center h-100 w-100 d-flex mt-5">
              <form method="POST" action="/home" >
                      @csrf
                  <input type="hidden" name="id" value="{{$value['id']}}">
                  <button class="btn btn-md fw-semibold text-white  "
                    style="box-shadow: 4px 2px 7px 0px #00000033;box-shadow: -3px -1px 7px 0px #00000040; background-color: #E45F00;">
                    SUBSCRIBE NOW</button>
                </form>
              </div>
              <!-- ===========border============= -->
              <div>
                <img class="w-100" clas src="assets/images/plan-img.svg" alt="">
              </div>
              <!-- ===========border-end============= -->
            </div>
          </div>
          @endforeach
    
        </div>
      </div>

    </div>
  </section>
  <!-- ====================Plan-section-End=============================== -->
  <div class="mt-5"><img class="mt-5" src="assets/images/line.svg" alt=""></div>
  <!-- ====================Footer-start=============================== -->
  <footer class="mt-5">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6">
          <div class="contaner-fluid">
            <div class="row">
              <div class="col-md-6 mt-3">
                <div class="ms-5">
                  <h3 class="fw-bolder" style="color: #452C88;">Company</h3>
                  <p style="color:#ACADAE ; line-height: 33px;" class="mt-4">Best delivery services
                    inGermany. Using bymore
                    than
                    3,000,00people in the world</p>
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="ms-5">
                  <h3 class="fw-bolder" style="color: #452C88;">Quick Links</h3>
                  <ul class="list-unstyled">
                    <a href="#" class="text-decoration-none">
                      <li style="color:#ACADAE ;" class="mt-4">Pricing</li>
                    </a>
                    <a href="#" class="text-decoration-none">
                      <li style="color:#ACADAE ;" class="mt-4">Customer</li>
                    </a>
                    <a href="#" class="text-decoration-none">
                      <li style="color:#ACADAE ;" class="mt-4">User Guide</li>
                    </a>
                    <a href="#" class="text-decoration-none">
                      <li style="color:#ACADAE ;" class="mt-4">Agent User</li>
                    </a>
                    <a href="#" class="text-decoration-none">
                      <li style="color:#ACADAE ;" class="mt-4">Blog</li>
                    </a>

                  </ul>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-5 mt-3">
                <div class="ms-4">
                  <h3 class="fw-bolder" style="color: #452C88;">Quick Links</h3>
                  <ul class="list-unstyled">
                    <a href="#" class="text-decoration-none">
                      <li style="color:#ACADAE ;" class="mt-4">Privacy Policy</li>
                    </a>
                    <a href="#" class="text-decoration-none">
                      <li style="color:#ACADAE ;" class="mt-4">Terms & Conditions</li>
                    </a>
                    <a href="#" class="text-decoration-none">
                      <li style="color:#ACADAE ;" class="mt-4">Disclaimer</li>
                    </a>

                  </ul>
                </div>
              </div>
              <div class="col-md-7">
                <img class="w-100" src="assets/images/footer.svg" alt="">
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </footer>
  <!-- ====================Footer-End================================-->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>
<script>
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>

</html>