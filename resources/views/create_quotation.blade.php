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
        @if($user->role == user_roles('1'))
        <div class="card shadow-lg border-0 mt-4">
          <div class="card-header text-center content-background text-white fw-bold">
            Company Details
          </div>
          <div class="card-body py-4">
            <form action="companyStore" class="apiform" id="companyStore" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" value="{{$company->id ?? ''}}">
              <div class="row">
                <div class="col-lg-6 mb-3">
                  <label for="title">Name</label>
                  <input type="text" name="name" class="form-control" id="name" value="{{$company->name ?? ''}}" required=''>
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="title">Logo</label>
                  <div class="row">
                    <div class="col-lg-10 col-10 col-sm-10 col-xl-10">
                      <input type="file" name="logo" id="logo" class="form-control">
                    </div>
                    <div class="col-lg-2 col-2 col-sm-2 col-xl-2">
                      <img src="{{ (isset($company->logo)) ? asset('storage/' . $company->logo) : 'assets/images/user.png'}}" width="45px" height="45px" style="border-radius: 50%;" id="com_logo" class="{{($company->logo ?? '') ? '' : 'd-none' }}">
                    </div>
                  </div>
                </div>
                <div class=" col-lg-6 mb-3 ">
                  <label for="date">Email</label>
                  <input type="email" name="email" class="form-control" id="email" value="{{$company->email ?? ''}}">
                </div>
                <div class="col-lg-6 mb-3">
                  <label for="quote_title">Address </label>
                  <input type="text" name="address" class="form-control" id="address" value="{{$company->address ?? ''}}">
                </div>
              </div>
              <div class="text-right">
                <button type="submit" id="btn_save_quotation" class="btn btn-primary text-white" style="border-radius: 8px;">
                  <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                  <span id="text">Update Details</span>
                </button>
              </div>
            </form>
          </div>
        </div>
        @endif

        <div class="card shadow-lg border-0 mt-4">
          <div class="card-header text-center content-background text-white fw-bold">
            Qoutation Details
          </div>
          <div class="card-body py-4">
            <form class="" action="{{route('generate_pdf_quote')}}" id="saveTemplateform" method="post">
              @csrf
              <input type="hidden" name="id" value="{{$draft_template->id ?? ''}}">
              <input type="hidden" name="user_id" value="{{$user->id}}">
              <input type="hidden" name="company_id" value="{{$company->id}}">
              <input type="hidden" name="template_for" value="{{$template_for}}">
              <div class="row mb-4">

                <div class="col-lg-4 col-md-6 col-sm-12 mt-4 ">
                  <label for="file_title">File Title</label>
                  <input type="text" name="file_title" class="form-control" id="file_title" required=''>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 mt-4 ">
                  <label for="qoute_title">Qoute Title</label>
                  <input type="text" name="qoute_title" class="form-control" id="qoute_title" required=''>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 mt-4 ">
                  <label for="client_name">Client Name</label>
                  <input type="text" name="client_name" class="form-control" id="client_name" required=''>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 mt-4 ">
                  <label for="client_email">Client Email</label>
                  <input type="text" name="client_email" class="form-control" id="client_email">
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 mt-4 ">
                  <label for="client_address">Client Address</label>
                  <input type="text" name="client_address" class="form-control" id="client_address">
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 mt-4 ">
                  <label for="discount">Discount %</label>
                  <input type="number" max="100" name="discount" class="form-control" id="discount">
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 mt-4 ">
                  <label for="inv_date">Date Of Invoice</label>
                  <input type="date" name="inv_date" class="form-control" id="inv_date" required=''>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 mt-4 ">
                  <label for="due_date">Due Date</label>
                  <input type="date" name="due_date" class="form-control" id="due_date" required=''>
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
                        <select required name="service_id[]" class="form-select service_id " required=''>
                          <option disabled selected> Select @lang('quote service')</option>
                          @forelse($services ?? [] as $sid => $val)
                          <option value="{{$val}}" {{ isset($serv_data->service_id) && $serv_data->service_id == $val ? 'selected' : '' }}>
                            {{ $val }}
                          </option>
                          @empty
                          @endforelse
                        </select>
                        <span class="error-message text-danger service_id_error"></span>
                      </div>

                      <div class="col-lg-3 col-md-6 col-sm-12">
                        <label for="s_desc">@lang('Service Desc')</label>
                        <input type="text" name="s_desc[]" value="" placeholder="@lang('service description')" class="form-control s_desc" required=''>
                        <span class="error-message text-danger s_desc_error"></span>
                      </div>

                      <div class="col-lg-3 col-md-6 col-sm-12">
                        <label for="q_amount">@lang('Service Amount')</label>
                        <input required type="number" min="1" name="s_amount[]" value="{{ $serv_data->s_amount ?? 1 }}" placeholder="@lang('serivce amount')" class="form-control s_amount" required=''>
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
                        <select required name="service_id[]" class="form-select service_id" required=''>
                          <option disabled selected> Select @lang('quote service')</option>
                          @forelse($services ?? [] as $key => $value)
                          <option value="{{ $value}}" {{ isset($serv_data->service_id) && $serv_data->service_id == $value ? 'selected' : '' }}>
                            {{ $value }}
                          </option>
                          @empty
                          <!-- Code to handle the case when $driver_list is empty or null -->
                          @endforelse
                        </select>
                        <span class="error-message text-danger service_id_error"></span>
                      </div>

                      <div class="col-lg-3 col-md-6 col-sm-12">
                        <label for="s_desc">@lang('Service Desc')</label>
                        <input type="text" name="s_desc[]" value="" placeholder="@lang('service description')" class="form-control s_desc" required=''>
                        <span class="error-message text-danger s_desc_error"></span>
                      </div>

                      <div class="col-lg-3 col-md-6 col-sm-12">
                        <label for="q_amount">@lang('Service Amount')</label>
                        <input required type="number" min="1" name="s_amount[]" value="{{ $serv_data->s_amount ?? 1 }}" placeholder="@lang('serivce amount')" class="form-control s_amount" required=''>
                        <span class="error-message text-danger s_amount_error "></span>
                      </div>

                    </div>
                    @endforelse
                  </div>
                  <div id="new_rowdata">
                  </div>
                </div>
                <div class="col-lg-12 mt-4">
                  <label for="create_quotation">Template Footer</label>
                  <textarea name="template_body" id="create_quotation" class="form-control">
                  {{ base64_decode($draft_template->template_body) }}
                  </textarea>
                </div>
              </div>
              <div class="row">
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
                  <div class="row justify-content-end ">
                    <!-- <div class="col-lg-2 col-md-4 col-sm-12 ">
                      <button type="button" style="border-radius: 8px;" class="btn btn-primary btn-sm px-4  py-2 text-white " id="btn_preview"><span>Preview</span></button>
                    </div> -->

                    <!-- <div class="col-lg-2 col-md-4 col-sm-12 text-right">
                      <button type="button" id="btn_save_quotation" class="btn btn-block  text-white" style="background-color: #184A45FF; border-radius: 8px;">
                        <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                        <span id="text">@lang('Save Quotation')</span>
                      </button> -->
                    <div class="col-lg-3 col-md-4 col-sm-12 ">
                      <button type="submit" style="background-color: #184A45FF; border-radius: 8px;" class="btn btn-block  text-white" id="btn_downloadPdf"><span>Download As PDF</span></button>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          </form>
        </div>
      </div>
      <hr>

      <!-- <div class="row">
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
        </div> -->

    </div>
  </div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
<!-- Include the necessary libraries -->

<script>
  $('#logo').on('change', function() {
    const [file] = this.files;
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        $('#com_logo').attr('src', e.target.result).removeClass('d-none');
      }
      reader.readAsDataURL(file);
    }
  });

  var newRow = `
            <div class="row mt-md-3 mt-sm-3 mt-3">
                <div class="col-lg-1 col-md-12 col-sm-12 order-lg-last">
                    <label class="d-none d-lg-block">Remove</label>
                    <span class="fw-bold btn_removeRow btn btn-danger btn-block" > - </span>
                </div>
                <div class="col-lg-3 col-md-6  col-sm-12">
                    <label for="service_id">@lang('Service')</label>
                    <select required name="service_id[]"  class="form-select service_id" required=''>
                        <option disabled selected> Select @lang('quote service')</option>
                        @forelse($services as $key => $value)
                        <option value="{{ $value}}" >
                            {{ $value }}
                        </option>
                        @empty
                        <!-- Code to handle the case when $driver_list is empty or null -->
                        @endforelse
                    </select>
                    <span  class="error-message text-danger service_id_error"></span>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <label for="s_desc">@lang('Service Desc')</label>
                    <input type="text" min="1" name="s_desc[]"  value="" placeholder="@lang('service description')" class="form-control s_desc" required=''>
                    <span  class="error-message text-danger s_desc_error"></span>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <label for="q_amount">@lang('Service Aamount')</label>
                    <input required type="number" min="1" name="s_amount[]"  value="" placeholder="@lang('service amount')" class="form-control s_amount" required=''>
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

  $('#btn_save_quotation').on('click', function(event) {
    event.preventDefault();

    $('#saveTemplateform').addClass('savetemplate');
    $('#saveTemplateform').attr('action', 'templateStore');
    $('#saveTemplateform').submit();
  });

  $('#btn_addNewRow').on('click', function() {
    $('#new_rowdata').append(newRow);
  });

  $(document).on('click', '.btn_removeRow', function() {
    $(this).closest('.row').fadeOut('slow', function() {
      $(this).remove();
    });

  });
  $('#discount').on('input', function() {
    var value = parseFloat($(this).val());
    if (value > 100) {
      $(this).val(100);
    }
  });
</script>



@endsection