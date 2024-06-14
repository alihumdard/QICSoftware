@extends('layouts.main')
@section('main-section')
@php
$temp_status = config('constants.TEMP_STATUS');
@endphp
<!-- partial -->
<div class="content-wrapper py-0 my-2">
  <div style="border: none;">
    <div class="bg-white" style="border-radius: 20px;">
      <div class="p-3">
        <h3 class="page-title pb-3">
          <span class="page-title-icon bg-gradient-primary text-white me-2 py-2">
            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M23.1783 16.5241L19.5521 3.01716C19.1579 1.54862 17.353 1.00759 16.2133 2.01629L13.9278 4.039C11.3845 6.28991 8.35111 7.91891 5.06775 8.79698C2.31938 9.53199 0.690561 12.3597 1.42698 15.1028C2.16341 17.8459 4.99058 19.4819 7.73896 18.7469C11.0223 17.8688 14.4654 17.7657 17.7956 18.4459L20.7882 19.0571C22.2806 19.3619 23.5725 17.9926 23.1783 16.5241Z" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M7.53931 8.09998L11.7001 23.5" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </span>
          <span>@lang('Create Quotation')</span>
        </h3>
        <form action="templateStore" id="savetemplate" method="post">
          <input type="hidden" name="id" value="{{$draft_template->id}}">
          <input type="hidden" name="user_id" value="{{$user->id}}">
          <input type="hidden" name="template_for" value="{{$template_for}}">
          <div class="row mb-4">
            <div class="col-lg-4 col-md-6 col-sm-12 mt-4 ">
              <label for="title"> Title</label>
              <input type="text" name="title" class="form-control" id="title">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-4 ">
              <label for="date">Date</label>
              <input type="date" name="date" class="form-control" id="date">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-4 ">
              <label for="title">Qoute Title</label>
              <input type="text" name="title" class="form-control" id="title">
            </div>

            <div class="col-lg-12 mt-4 mb-4">
              <h3 class="page-title pb-1"> Items: </h3>

              <div id="existing_row">
                @forelse( json_decode($data['service_data'] ?? '[]') as $key => $serv_data)
                <div class="row">
                  @if($key == '0')
                  <div class="col-lg-1 col-md-12 col-sm-12 order-lg-last">
                    <label class="d-none d-lg-block">Add</label>
                    <span class="fw-bold btn btn-success btn-block text-center" id="btn_addNewRow"> + </span>
                  </div>
                  @else
                  <div class="col-lg-1 col-md-12 col-sm-12 order-lg-last">
                    <label class="d-none d-lg-block">Remove</label>
                    <span class="fw-bold btn_removeRow btn btn-danger btn-block"> - </span>
                  </div>
                  @endif

                  <div class="col-lg-3 col-md-6  col-sm-12 ">
                    <label for="service_id">@lang('Service')</label>
                    <select required name="service_id[]" class="form-select service_id ">
                      <option disabled selected> Select @lang('quote service')</option>
                      @forelse($services ?? [] as $sid => $val)
                      <option value="{{$sid}}" {{ isset($serv_data->service_id) && $serv_data->service_id == $sid ? 'selected' : '' }}>
                        {{ $val }}
                      </option>
                      @empty
                      <!-- Code to handle the case when $driver_list is empty or null -->
                      @endforelse
                    </select>
                    <span class="error-message text-danger service_id_error"></span>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12">
                    <label for="q_amount">@lang('Service Amount')</label>
                    <input required type="number" min="1" name="s_amount[]" value="{{ $serv_data->s_amount ?? 1 }}" placeholder="@lang('serivce amount')" class="form-control s_amount">
                    <span class="error-message text-danger s_amount_error "></span>
                  </div>
                </div>
                @empty

                <div class="row">
                  <div class="col-lg-1 col-md-12 col-sm-12 order-lg-last">
                    <label class="d-none d-lg-block">Add</label>
                    <span class="fw-bold btn btn-success btn-block text-center" id="btn_addNewRow"> + </span>
                  </div>

                  <div class="col-lg-3 col-md-6  col-sm-12 ">
                    <label for="service_id">@lang('Service')</label>
                    <select required name="service_id[]" class="form-select service_id ">
                      <option disabled selected> Select @lang('quote service')</option>
                      @forelse($services ?? [] as $key => $value)
                      <option value="{{ $key}}" {{ isset($serv_data->service_id) && $serv_data->service_id == $key ? 'selected' : '' }}>
                        {{ $value }}
                      </option>
                      @empty
                      <!-- Code to handle the case when $driver_list is empty or null -->
                      @endforelse
                    </select>
                    <span class="error-message text-danger service_id_error"></span>
                  </div>

                  <div class="col-lg-3 col-md-6 col-sm-12">
                    <label for="q_amount">@lang('Service Amount')</label>
                    <input required type="number" min="1" name="s_amount[]" value="{{ $serv_data->s_amount ?? 1 }}" placeholder="@lang('serivce amount')" class="form-control s_amount">
                    <span class="error-message text-danger s_amount_error "></span>
                  </div>
                </div>
                <!-- Code to handle the case when $driver_list is empty or null -->
                @endforelse
              </div>
              <div id="new_rowdata">
                <!-- dynamic row added -->
              </div>
            </div>
            <div class="col-lg-12 mt-4 mb-4">
            <label for="create_quotation">Template Footer</label>
              <textarea name="template_body" id="create_quotation" class="form-control">
              {{ base64_decode($draft_template->template_body) }}
              </textarea>
            </div>
          </div>
          <div class="row">


            <div class="col-lg-3 col-md-6 col-sm-12 mt-4 pt-2 text-center">
              <button type="button" style="border-radius: 8px;" class="btn btn-secondary btn-sm px-4 py-2 text-white" id="btn_downloadPdf"><span>Download As PDF</span></button>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mt-4 pt-2 text-center ">
              <button type="button" style="border-radius: 8px;" class="btn btn-primary btn-sm px-4  py-2 text-white " id="btn_preview"><span>Preview</span></button>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
              <label for="tile">@lang('Save As')</label>
              <select required name="save_as" id="save_as" class="form-select">
                <option value="" selected> @lang('template save as')</option>
                @forelse($save_as as $key => $value)
                <option value="{{ $key}}" {{ isset($draft_template->save_as) && $draft_template->save_as == $key ? 'selected' : '' }}>
                  {{ $value }}
                </option>
                @empty
                <!-- Code to handle the case when $driver_list is empty or null -->
                @endforelse
              </select>
              <span id="save_as_error" class="error-message text-danger"></span>
            </div>

            <div class="mt-4">
              <div class="row justify-content-end mt-2  ">
                <div class="col-lg-2 col-md-6 col-sm-12 mb-3 mb-lg-4 ">
                  <a href="/quotations" id="btn_cancel_quotation" class="btn btn-block btn-warning text-white" style="border-radius: 8px;">
                    <span>@lang('Cancel')</span>
                  </a>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 mb-5 mb-md-5 mb-lg-4 text-right">
                  <button type="submit" id="btn_save_quotation" class="btn btn-block  text-white" style="background-color: #184A45FF; border-radius: 8px;">
                    <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                    <span id="text">@lang('Save Quotation')</span>
                  </button>
                </div>
              </div>
            </div>

          </div>
        </form>
        <hr>

        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-12 mb-3 rounded">
            <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-mdb-ripple-color="light" style="max-width: 22rem;">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk8spE7xKJJftyCC04t3l1nXl9wmaqdF0KMIO_9e3zP3X_AhZk9l3VCT-6Jy5t9IPYWsg&usqp=CAU" class="w-100" alt="Louvre" />
              <div class="mask text-light d-flex justify-content-center flex-column text-center" style="background-color: rgba(0, 0, 0, 0.5)">
                <button class=" btn btn-primary m-0"> Apply</button>
                <button class=" btn btn-secondary mt-1"> Deactive</button>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12 mb-3 rounded">
            <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-mdb-ripple-color="light" style="max-width: 22rem;">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk8spE7xKJJftyCC04t3l1nXl9wmaqdF0KMIO_9e3zP3X_AhZk9l3VCT-6Jy5t9IPYWsg&usqp=CAU" class="w-100" alt="Louvre" />
              <div class="mask text-light d-flex justify-content-center flex-column text-center" style="background-color: rgba(0, 0, 0, 0.5)">
                <button class=" btn btn-primary m-0"> Apply</button>
                <button class=" btn btn-secondary mt-1"> Deactive</button>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12 mb-3 rounded">
            <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-mdb-ripple-color="light" style="max-width: 22rem;">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk8spE7xKJJftyCC04t3l1nXl9wmaqdF0KMIO_9e3zP3X_AhZk9l3VCT-6Jy5t9IPYWsg&usqp=CAU" class="w-100" alt="Louvre" />
              <div class="mask text-light d-flex justify-content-center flex-column text-center" style="background-color: rgba(0, 0, 0, 0.5)">
                <button class=" btn btn-primary m-0"> Apply</button>
                <button class=" btn btn-secondary mt-1"> Deactive</button>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12 mb-3 rounded">
            <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-mdb-ripple-color="light" style="max-width: 22rem;">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk8spE7xKJJftyCC04t3l1nXl9wmaqdF0KMIO_9e3zP3X_AhZk9l3VCT-6Jy5t9IPYWsg&usqp=CAU" class="w-100" alt="Louvre" />
              <div class="mask text-light d-flex justify-content-center flex-column text-center" style="background-color: rgba(0, 0, 0, 0.5)">
                <button class=" btn btn-primary m-0"> Apply</button>
                <button class=" btn btn-secondary mt-1"> Deactive</button>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12 mb-3 rounded">
            <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-mdb-ripple-color="light" style="max-width: 22rem;">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk8spE7xKJJftyCC04t3l1nXl9wmaqdF0KMIO_9e3zP3X_AhZk9l3VCT-6Jy5t9IPYWsg&usqp=CAU" class="w-100" alt="Louvre" />
              <div class="mask text-light d-flex justify-content-center flex-column text-center" style="background-color: rgba(0, 0, 0, 0.5)">
                <button class=" btn btn-primary m-0"> Apply</button>
                <button class=" btn btn-secondary mt-1"> Deactive</button>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12 mb-3 rounded">
            <div class="bg-image hover-overlay ripple shadow-1-strong rounded" data-mdb-ripple-color="light" style="max-width: 22rem;">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk8spE7xKJJftyCC04t3l1nXl9wmaqdF0KMIO_9e3zP3X_AhZk9l3VCT-6Jy5t9IPYWsg&usqp=CAU" class="w-100" alt="Louvre" />
              <div class="mask text-light d-flex justify-content-center flex-column text-center" style="background-color: rgba(0, 0, 0, 0.5)">
                <button class=" btn btn-primary m-0"> Apply</button>
                <button class=" btn btn-secondary mt-1"> Deactive</button>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
  <!-- Include the necessary libraries -->

  <script>
    var newRow = `
            <div class="row mt-md-3 mt-sm-3 mt-3">
                <div class="col-lg-1 col-md-12 col-sm-12 order-lg-last">
                    <label class="d-none d-lg-block">Remove</label>
                    <span class="fw-bold btn_removeRow btn btn-danger btn-block" > - </span>
                </div>
                <div class="col-lg-3 col-md-6  col-sm-12">
                    <label for="service_id">@lang('Service')</label>
                    <select required name="service_id[]"  class="form-select service_id">
                        <option disabled selected> Select @lang('quote service')</option>
                        @forelse($services as $key => $value)
                        <option value="{{ $key}}" >
                            {{ $value }}
                        </option>
                        @empty
                        <!-- Code to handle the case when $driver_list is empty or null -->
                        @endforelse
                    </select>
                    <span  class="error-message text-danger service_id_error"></span>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <label for="q_amount">@lang('Service Aamount')</label>
                    <input required type="number" min="1" name="s_amount[]"  value="" placeholder="@lang('service amount')" class="form-control s_amount">
                    <span  class="error-message text-danger s_amount_error"></span>
                </div>

            </div>
            `;

    $('#create_quotation').summernote({
      placeholder: "",
      tabsize: 2,
      height: '50vh',
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video', 'hr', 'symbols']],
        ['view', ['fullscreen', 'codeview']],
        ['help', ['help']],
        ['misc', ['print']]
      ],
      callbacks: {
        onImageUpload: function(files) {
          // Handle image upload here
          // You can use AJAX to upload the image to your server and then insert it into the editor.
          console.log("Image upload callback triggered.");
        },
        onGetCode: function(code) {
          // 'code' contains the HTML content of the editor
          console.log(code);
        }
      }
    });


    $('#btn_downloadPdf').on('click', function() {
      var content = $('#create_quotation').val();
      console.log(content);
      // Define the PDF document definition
      const pdfDefinition = {
        content: [{
            text: 'PDF Document',
            style: 'header'
          },
          {
            text: content
          }
        ],
        styles: {
          header: {
            fontSize: 18,
            bold: true
          }
        }
      };

      // Generate the PDF
      pdfMake.createPdf(content).download('template.pdf');

      // You can optionally show an alert or perform other actions here
      alert('PDF downloaded!');
    });

    $('#btn_addNewRow').on('click', function() {
      $('#new_rowdata').append(newRow);
    });

    $(document).on('click', '.btn_removeRow', function() {
      $(this).closest('.row').fadeOut('slow', function() {
        $(this).remove();
      });
    });
  </script>



  @endsection