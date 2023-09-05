@include('web_nav')
  <!-- ======================Hero-Section-start====================== -->
  <section id="home">

    <div class="container">
      <div class="row">

        <!-- ================header-text-start================ -->
        <div class="col-md-5 ">
          <div class="main-heading d-flex  align-items-center mx-1 h-100">
            <div class="p-5 mb-5">
              <h2 style="color: #452C88;">Your <span
                  style="color: #E45F00;">Easiest</span> way <br>
                to delivery</h2>
              <p class="fw-normal fs-6 mt-3" style="  color:#808191; text-align: justify; line-height: 1.5rem; ">
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

  <div class="container-fluid">
    <!-- ===============heading-start=============== -->
    <div>
      <h2 style="color: #452C88; " class="text-center">Selected Pakage</h2>
      <p class="text-center fw-medium" style="color:#999999;">Delivery offers on-demand
        delivery and courier services for <br>
        business and consumers</p>
    </div>
  </div>

  <!-- ==================payment-section-start================== -->
  <div class="container ">
    <div class="mt-5 d-flex align-items-center justify-content-center flex-column"
      style="box-shadow: 1px 4px 20px 2px #00000040;">
      <div class="container pt-5 pb-5 pe-4 ps-4">
        <div class="row">
          <div class="col-md-6 mx-auto" style="width: 40%; height: 100%;">

            <!-- ==================plan-1-Start========================= -->
            <div class="container">
              <div class="plan-boxss" style="box-shadow: 5px 4px 15px 0px #00000040;">
                <div class="p-1">
                  <h2 class=" text-center  pt-3 " style="color: #E45F00; font-weight: 700; font-size: 22px;  ">
                  {{$data->title}}
                  </h2>
                  <p class="text-center fw-medium mt-2">{{$data->desc}}</p>
                  <p class="fw-semibold mt-1 text-center">&#8364 {{$data->price}} <span class="fw-normal">/mon</span></p>
                </div>
                <!-- ==========list=========== -->
                <div class="px-3">
                  <ul class=" text-decoration-none list-unstyled ">
                    <li style=" font-size: 14px;" class="fw-medium ms-3">Client Panel <img style="width: 14px;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="lorem ipsum the true inpsum"  
                        class="float-end pt-1 me-3" src="assets/images/plan-icon.svg" alt=""></li>
                    <li style=" font-size: 14px; margin-top: 2rem;" class="fw-medium ms-3 ">{{$data->users}} Users <img data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="lorem ipsum the true inpsum"  
                        style="width: 14px;" class="float-end pt-1 me-3" src="assets/images/plan-icon.svg" alt=""></li>
                    <li style=" font-size: 14px; margin-top: 2rem;" class="fw-medium ms-3 ">{{$data->drivers}} Drivers <img data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="lorem ipsum the true inpsum"  
                        style="width: 14px;" class="float-end pt-1 me-3" src="assets/images/plan-icon.svg" alt=""></li>
                    <li style=" font-size: 14px; margin-top: 2rem;" class="fw-medium ms-3 ">{{$data->map_api_call}} Google Map API Call <img data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="lorem ipsum the true inpsum"  
                        style="width: 14px;" class="float-end pt-1 me-3" src="assets/images/plan-icon.svg" alt=""></li>
                  </ul>
                </div>
                <!-- ==========list-end=========== -->

                <!-- ===========border============= -->
                <div>
                  <img class="" style="width: 100%;" clas src="assets/images/plan-img.svg" alt="">
                </div>
                <!-- ===========border-end============= -->
              </div>
            </div>
            <!-- ==================plan-1-End=========================== -->
          </div>
          <div class="col-md-6">
            <div class="">
              <div class="d-flex flex-column align-items-center ">
                <button style="width:150px ; opacity: 65%; height:50px ; background: #452C88; box-shadow: 1px 4px 20px 2px #00000040;"
                  class="btn text-white" data-toggle="tooltip" data-placement="right" title="Not available Yet!">
                  <img src="assets/images/Pay Vaya.svg" style="width: 70%; height: 70%;" alt="">
                </button>

                <form id="paypalForm" action="{{route('paypal.pay')}}" method="post">
                @csrf
                <input type="hidden" name="amount" value="{{$data->price}}">
                <input type="hidden" name="package_id" value="{{$data->id}}">
                 <button  style="width:150px; height:50px; background: #FF9900; box-shadow: 1px 4px 20px 2px #00000040; margin-top: 2.5rem;" class="btn text-white">
                  <img src="assets/images/paypal.svg" style="width: 70%; height: 70%;" alt="">
                  </button>
                </form>

           

                <button
                  style="width:150px ; height:50px; opacity: 65%; background: #E6F6FF; box-shadow: 1px 4px 20px 2px #00000040;margin-top: 2.5rem;"
                  class="btn text-white"  data-toggle="tooltip" data-placement="right" title="Not available Yet!" >
                  <img src="assets/images/gpay.svg" style="width: 70%; height: 70%;" alt="">
                </button>

                <button
                  style="width:150px ; height:50px; opacity: 65%; background: #FFFFFF; box-shadow: 1px 4px 20px 2px #00000040;margin-top: 2.5rem;"
                  class="btn text-white" data-toggle="tooltip" data-placement="right" title="Not available Yet!" >
                  <img src="assets/images/visa.svg" style="width: 70%; height: 70%;" alt="">
                </button>

                <button
                  style="width:150px ; height:50px; opacity: 65%; background: #F8F8F8; box-shadow: 1px 4px 20px 2px #00000040;margin-top: 2.5rem;"
                  class="btn text-white" data-toggle="tooltip" data-placement="right" title="Not available Yet!" >
                  <img src="assets/images/mastercard.svg" style="width: 70%; height: 70%;" alt="">
                </button>

                <button
                  style="width:150px ; height:50px; opacity: 65%; background:#E45F00; box-shadow: 1px 4px 20px 2px #00000040;margin-top: 2.5rem;"
                  class="btn text-white" data-toggle="tooltip" data-placement="right" title="Not available Yet!" >
                  <img src="assets/images/Bank Transfer.svg" style="width: 70%; height: 70%;" alt="">
                </button>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ==================payment-section-End==================== -->


  <div><img class="mt-5" src="assets/images/line.svg" alt=""></div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
<script>
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
<script>
  function submitPaypalForm() {
    document.getElementById('paypalForm').submit();
  }

  $(function() {
  $('[data-toggle="tooltip"]').tooltip({
    placement: 'right'
  });
});
</script>
</html>