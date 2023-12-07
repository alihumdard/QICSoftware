<!-- services Status Modal -->
<div class="modal fade" id="service_sts_modal" tabindex="-1" aria-labelledby="user_stsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-white" style="border-radius: 10px;">
            <div class="modal-header pb-0" style="border: none;">
                <h5 class="modal-title" id="user_stsLabel"></h5>
                <button type="button" class="close closeModalButton close_st_model" id="closeicon" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28 16L16 28M16 16L28 28" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <form id="formData" method="post" action="{{$status_api}}">
                <input type="hidden" id="sts_serv_id" name="id">
                <div class="modal-body pt-0">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="4" y="4" width="48" height="48" rx="24" fill="#D1FADF" />
                        <path d="M23.5 28L26.5 31L32.5 25M38 28C38 33.5228 33.5228 38 28 38C22.4772 38 18 33.5228 18 28C18 22.4772 22.4772 18 28 18C33.5228 18 38 22.4772 38 28Z" stroke="#039855" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <rect x="4" y="4" width="48" height="48" rx="24" stroke="#ECFDF3" stroke-width="8" />
                    </svg>
                    <label class="font-weight-semibold pl-1 mt-4"> Sure to change the status? </label>
                    <label class="font-weight-semibold pl-1 mt-2 text-danger status_change_error"> </label>
                    <select name="status" id="status" class="form-select mt-3">
                        <option disabled selected> select status </option>
                        @foreach($qouteStatus_trans as $key => $value)
                        <option value="{{$key}}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm text-white px-5" id="change_sts" name="change_sts" type="submit" style="background-color: #184A45; border-radius: 8px;">
                        <div class="spinner-border spinner-border-sm text-white d-none" id="spinner"></div>
                        <span id="add_btn">@lang('lang.ok')</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- services Status Modal End -->
<script>
    $(document).on('click', '.btn_status_change', function() {
        var id = $(this).find('span').attr('data-row_id');
        $('#sts_serv_id').val(id);
        $('#service_sts_modal').modal('show');
    });
</script>