@foreach ($managements as $management)
    <div class="modal fade" id="viewImageManagement" tabindex="-1" role="dialog" aria-labelledby="viewImageManagementLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewImageManagementLabel">Photo Profile -
                        {{ $management->stakeholder_name }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="w-lg-50 w-sm-100">
                            <img id="photo-profile-preview" class="d-block mb-2 img-fluid"
                                src="{{ Storage::url($management->photo_profile_path) }}" alt="Preview" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-rounded"
                        data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@foreach ($infrastructures as $infrastructure)
    <div class="modal fade" id="viewImageInfra" tabindex="-1" role="dialog" aria-labelledby="viewImageInfraLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewImageInfraLabel">Photo Sarpras -
                        {{ $infrastructure->sarpras_name }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="w-lg-50 w-sm-100">
                            <img id="photo-sarpras-preview" class="d-block mb-2 img-fluid"
                                src="{{ Storage::url($infrastructure->photo_sarpras_path) }}" alt="Preview" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-rounded"
                        data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@foreach ($activities as $activity)
    <div class="modal fade" id="viewImageActivity" tabindex="-1" role="dialog"
        aria-labelledby="viewImageActivityLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewImageInfraLabel">Photo Activity -
                        {{ $activity->activity_name }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="w-lg-50 w-sm-100">
                            <img id="photo-sarpras-preview" class="d-block mb-2 img-fluid"
                                src="{{ Storage::url($activity->photo_activity_path) }}" alt="Preview" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-rounded"
                        data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@foreach ($achievements as $achievement)
    <div class="modal fade" id="viewImageAchievement" tabindex="-1" role="dialog"
        aria-labelledby="viewImageAchievementLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewImageInfraLabel">Photo Achievement -
                        {{ $achievement->championship_name }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="w-lg-50 w-sm-100">
                            <img id="photo-sarpras-preview" class="d-block mb-2 img-fluid"
                                src="{{ Storage::url($achievement->supporting_photos_path) }}" alt="Preview" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-rounded"
                        data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
