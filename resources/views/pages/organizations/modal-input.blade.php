<div class="modal fade" id="inputBiodata" tabindex="-1" role="dialog" aria-labelledby="inputBiodataLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputBiodataLabel">{{ __('Organization Biodata') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('update-biodata') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="sk_no"><strong>{{ __('SK No.') }}</strong></label>
                        <input type="number" class="form-control" id="sk_no" name="sk_no"
                            placeholder="{{ __('Enter SK No.') }}" value="{{ $biodata->sk_no }}">
                    </div>
                    <div class="form-group">
                        <label for="sk_date"><strong>{{ __('SK Date') }}</strong></label>
                        <input type="date" class="form-control" id="sk_date" name="sk_date"
                            placeholder="{{ __('Enter SK Date') }}" value="{{ $biodata->sk_date }}">
                    </div>
                    <div class="form-group">
                        <label for="sk_valid_period"><strong>{{ __('SK Valid Period') }}</strong></label>
                        <input type="date" class="form-control" id="sk_valid_period" name="sk_valid_period"
                            placeholder="{{ __('Enter SK Valid Period') }}" value="{{ $biodata->sk_valid_period }}">
                    </div>
                    <div class="form-group">
                        <label for="sk_file_path"><strong>{{ __('File SK') }}</strong></label>
                        <input type="file" name="sk_file_path" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled
                                placeholder="Upload File SK">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-success"
                                    type="button">{{ __('Upload') }}</button>
                            </span>
                        </div>
                        <small class="form-text text-muted">{{ __('Maximum file size: 2MB') }}</small>
                        <small class="form-text text-muted">{{ __('Format file: PDF') }}</small>
                    </div>
                    <div class="form-group">
                        <label for="name"><strong>{{ __('Account Name') }}</strong></label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="{{ __('Enter Name') }}" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="name"><strong>{{ __('Organization Name') }}</strong></label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="{{ __('Enter Name') }}" value="{{ $biodata->name }}">
                    </div>
                    <div class="form-group">
                        <label for="chairman"><strong>{{ __('Chairman') }}</strong></label>
                        <input type="text" class="form-control" id="chairman" name="chairman"
                            placeholder="{{ __('Enter Chairman') }}" value="{{ $biodata->chairman }}">
                    </div>
                    <div class="form-group">
                        <label for="contact_person_name"><strong>{{ __('Contact Person Name') }}</strong></label>
                        <input type="text" class="form-control" id="contact_person_name" name="contact_person_name"
                            placeholder="{{ __('Enter Contact Person Name') }}"
                            value="{{ $biodata->contact_person_name }}">
                    </div>
                    <div class="form-group">
                        <label for="contact_person_no"><strong>{{ __('Contact Person No.') }}</strong></label>
                        <input type="number" class="form-control" id="contact_person_no" name="contact_person_no"
                            placeholder="{{ __('Enter Contact Person No.') }}"
                            value="{{ $biodata->contact_person_no }}">
                    </div>
                    <div class="form-group">
                        <label for="address"><strong>{{ __('Address') }}</strong></label>
                        <textarea class="form-control" id="address" name="address" rows="4" placeholder="{{ __('Enter Address') }}">{!! $biodata->address !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="logo_path"><strong>{{ __('Logo') }}</strong></label>
                        <input type="file" id="logo_path" name="logo_path" onchange="previewImageBiodata()"
                            class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled
                                placeholder="Upload Logo">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-success"
                                    type="button">{{ __('Upload') }}</button>
                            </span>
                        </div>
                        <div class="w-lg-50 w-sm-100">
                            <img id="logo-preview" class="d-block mb-2 img-fluid"
                                src="{{ Storage::url($biodata->logo_path) }}" alt="Preview" />
                        </div>
                        <small class="form-text text-muted">{{ __('Maximum file size: 2MB') }}</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-rounded"
                        data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-outline-success btn-rounded">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="inputManagement" tabindex="-1" role="dialog" aria-labelledby="inputManagementLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputManagementLabel">{{ __('Management Data') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('store-management') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="position_name"><strong>{{ __('Position Name') }}</strong></label>
                        <input type="text" class="form-control" id="position_name" name="position_name"
                            placeholder="{{ __('Enter Position Name') }}">
                    </div>
                    <div class="form-group">
                        <label for="stakeholder_name"><strong>{{ __('Stakeholder Name') }}</strong></label>
                        <input type="text" class="form-control" id="stakeholder_name" name="stakeholder_name"
                            placeholder="{{ __('Enter Stakeholder Name') }}">
                    </div>
                    <div class="form-group">
                        <label for="phone_number"><strong>{{ __('Phone No.') }}</strong></label>
                        <input type="number" class="form-control" id="phone_number" name="phone_number"
                            placeholder="{{ __('Enter Phone Number') }}">
                    </div>
                    <div class="form-group">
                        <label for="photo_profile_path"><strong>{{ __('Photo Profile') }}</strong></label>
                        <input type="file" id="photo_profile_path" name="photo_profile_path"
                            onchange="previewImageManagement()" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled
                                placeholder="Upload Photo Profile">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-success"
                                    type="button">{{ __('Upload') }}</button>
                            </span>
                        </div>
                        <div class="w-lg-50 w-sm-100">
                            <img id="photo-profile-preview" class="d-block mb-2 img-fluid" src=""
                                alt="Preview" />
                        </div>
                        <small class="form-text text-muted">{{ __('Maximum file size: 2MB') }}</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-rounded"
                        data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-outline-success btn-rounded">{{ __('Add') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="inputInfrastructure" tabindex="-1" role="dialog"
    aria-labelledby="inputInfrastructureLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputInfrastructureLabel">{{ __('Infrastructure Data') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('store-infrastructure') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="sarpras_name"><strong>{{ __('Sarpras Name') }}</strong></label>
                        <input type="text" class="form-control" id="sarpras_name" name="sarpras_name"
                            placeholder="{{ __('Enter Sarpras Name') }}">
                    </div>
                    <div class="form-group">
                        <label for="total"><strong>{{ __('Total') }}</strong></label>
                        <input type="number" class="form-control" id="total" name="total"
                            placeholder="{{ __('Enter Total') }}">
                    </div>
                    <div class="form-group">
                        <label for="good_status"><strong>{{ __('Good Status') }}</strong></label>
                        <input type="number" class="form-control" id="good_status" name="good_status"
                            placeholder="{{ __('Enter Good Status') }}">
                    </div>
                    <div class="form-group">
                        <label for="damage_status"><strong>{{ __('Damage Status') }}</strong></label>
                        <input type="number" class="form-control" id="damage_status" name="damage_status"
                            placeholder="{{ __('Enter Damage Status') }}">
                    </div>
                    <div class="form-group">
                        <label for="procurement_date"><strong>{{ __('Procurement Date') }}</strong></label>
                        <input type="date" class="form-control" id="procurement_date" name="procurement_date"
                            placeholder="{{ __('Enter Procurement Date') }}">
                    </div>
                    <div class="form-group">
                        <label for="photo_sarpras_path"><strong>{{ __('Photo Sarpras') }}</strong></label>
                        <input type="file" id="photo_sarpras_path" name="photo_sarpras_path"
                            onchange="previewImageSarpras()" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled
                                placeholder="Upload Photo Sarpras">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-success"
                                    type="button">{{ __('Upload') }}</button>
                            </span>
                        </div>
                        <div class="w-lg-50 w-sm-100">
                            <img id="photo-sarpras-preview" class="d-block mb-2 img-fluid" src=""
                                alt="Preview" />
                        </div>
                        <small class="form-text text-muted">{{ __('Maximum file size: 2MB') }}</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-rounded"
                        data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-outline-success btn-rounded">{{ __('Add') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="inputActivity" tabindex="-1" role="dialog" aria-labelledby="inputActivityLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputActivityLabel">{{ __('Activity') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('store-activity') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="activity_name"><strong>{{ __('Activity Name') }}</strong></label>
                        <input type="text" class="form-control" id="activity_name" name="activity_name"
                            placeholder="{{ __('Enter Activity Name') }}">
                    </div>
                    <div class="form-group">
                        <label for="activity_date"><strong>{{ __('Activity Date') }}</strong></label>
                        <input type="date" class="form-control" id="activity_date" name="activity_date"
                            placeholder="{{ __('Enter Activity Date') }}">
                    </div>
                    <div class="form-group">
                        <label for="activity_desc"><strong>{{ __('Activity Description') }}</strong></label>
                        <textarea class="form-control" id="activity_desc" name="activity_desc" rows="2"
                            placeholder="{{ __('Enter Activity Description') }}"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="photo_activity_path"><strong>{{ __('Photo Activity') }}</strong></label>
                        <input type="file" id="photo_activity_path" name="photo_activity_path"
                            onchange="previewImageActivity()" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled
                                placeholder="Upload Photo Activity">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-success"
                                    type="button">{{ __('Upload') }}</button>
                            </span>
                        </div>
                        <div class="w-lg-50 w-sm-100">
                            <img id="photo-activity-preview" class="d-block mb-2 img-fluid" src=""
                                alt="Preview" />
                        </div>
                        <small class="form-text text-muted">{{ __('Maximum file size: 2MB') }}</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-rounded"
                        data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-outline-success btn-rounded">{{ __('Add') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="inputAchievement" tabindex="-1" role="dialog" aria-labelledby="inputAchievementLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputAchievementLabel">{{ __('Organization Achievement') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('store-achievement') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="championship_name"><strong>{{ __('Championship Name') }}</strong></label>
                        <input type="text" class="form-control" id="championship_name" name="championship_name"
                            placeholder="{{ __('Enter Championship Name') }}">
                    </div>
                    <div class="form-group">
                        <label for="championship_date"><strong>{{ __('Championship Date') }}</strong></label>
                        <input type="date" class="form-control" id="championship_date" name="championship_date"
                            placeholder="{{ __('Enter Championship Date') }}">
                    </div>
                    <div class="form-group">
                        <label for="championship_desc"><strong>{{ __('Description') }}</strong></label>
                        <textarea class="form-control" id="championship_desc" name="championship_desc" rows="2"
                            placeholder="{{ __('Enter Description') }}"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="selectMedal"><strong>{{ __('Medal') }}</strong></label>
                        <select class="form-control" id="selectMedal" name="medal">
                            <option disabled selected>{{ __('Select your Medal') }}</option>
                            <option value="gold">{{ __('Gold') }}</option>
                            <option value="silver">{{ __('Silver') }}</option>
                            <option value="bronze">{{ __('Bronze') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="selectCategory"><strong>{{ __('Category') }}</strong></label>
                        <select class="form-control" id="selectCategory" name="category">
                            <option disabled selected>{{ __('Select your Category') }}</option>
                            <option value="r4">{{ __('R4') }}</option>
                            <option value="r6">{{ __('R6') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="selectClass"><strong>{{ __('Class') }}</strong></label>
                        <select class="form-control" id="selectClass" name="class">
                            <option disabled selected>{{ __('Select your Class') }}</option>
                            <option value="sprint">{{ __('Sprint') }}</option>
                            <option value="hth">{{ __('Head to Head') }}</option>
                            <option value="slalom">{{ __('Slalom') }}</option>
                            <option value="drr">{{ __('DRR') }}</option>
                        </select>
                        <select class="form-control mt-2" id="selectClassGender" name="class_gender">
                            <option disabled selected>{{ __('Select your Class') }}</option>
                            <option value="men">{{ __('Men') }}</option>
                            <option value="women">{{ __('Women') }}</option>
                        </select>
                        <select class="form-control mt-2" id="selectClassLevel" name="class_level">
                            <option disabled selected>{{ __('Select your Class') }}</option>
                            <option value="open">{{ __('Open') }}</option>
                            <option value="youth">{{ __('Youth') }}</option>
                            <option value="junior">{{ __('Junior') }}</option>
                            <option value="master">{{ __('Master') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="supporting_photos_path"><strong>{{ __('Supporting Photos') }}</strong></label>
                        <input type="file" id="supporting_photos_path" name="supporting_photos_path"
                            onchange="previewImageAchievement()" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled
                                placeholder="Upload Photo Achievement">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-success"
                                    type="button">{{ __('Upload') }}</button>
                            </span>
                        </div>
                        <div class="w-lg-50 w-sm-100">
                            <img id="photo-achievement-preview" class="d-block mb-2 img-fluid" src=""
                                alt="Preview" />
                        </div>
                        <small class="form-text text-muted">{{ __('Maximum file size: 2MB') }}</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-rounded"
                        data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-outline-success btn-rounded">{{ __('Add') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="inputChangePassword" tabindex="-1" role="dialog"
    aria-labelledby="inputChangePasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputChangePasswordLabel">{{ __('Change Password') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('update-password') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="old_password"><strong>{{ __('Old Password') }}</strong></label>
                        <input type="password" class="form-control" id="old_password" name="old_password"
                            placeholder="{{ __('Enter Old Password') }}">
                    </div>
                    <div class="form-group">
                        <label for="password"><strong>{{ __('New Password') }}</strong></label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="{{ __('Enter New Password') }}">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password"><strong>{{ __('New Password Confirmation') }}</strong></label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                            placeholder="{{ __('Enter New Password Confirmation') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-rounded"
                        data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-outline-success btn-rounded">{{ __('Change') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
