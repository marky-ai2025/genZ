<div class="modal fade" id="editSchoolModal-{{ $school->id }}" tabindex="-1" aria-labelledby="editSchoolModalLabel-{{ $school->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center w-100" id="editSchoolModalLabel-{{ $school->id }}">Edit School</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Animated Loading Screen -->
                <div id="loadingOverlay-{{ $school->id }}" class="loading-overlay d-none">
                    <div class="loading-spinner">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <p>Saving changes...</p>
                </div>

                <form id="editSchoolForm-{{ $school->id }}" action="{{ route('school.update', $school->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="schoolName" class="form-label">Name of School</label>
                            <input type="text" class="form-control" id="schoolName" name="name" value="{{ $school->name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="schoolAbbr" class="form-label">School (Abbreviation)</label>
                            <input type="text" class="form-control" id="schoolAbbr" name="abbr" value="{{ $school->abbr }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="schoolbrgy" class="form-label">Barangay</label>
                            <input type="text" class="form-control" id="schoolbrgy" name="brgy" value="{{ $school->brgy }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="citymun" class="form-label">City/Municipality</label>
                            <input type="text" class="form-control" id="citymun" name="city" value="{{ $school->city }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="prov" class="form-label">Province</label>
                            <input type="text" class="form-control" id="prov" name="prov" value="{{ $school->prov }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="contactnumber" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="contactnumber" name="contact" value="{{ $school->contact }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="schooltype" class="form-label">Type of School</label>
                            <select class="form-select" id="schooltype" name="type" required>
                                <option value="">Select</option>
                                <option value="Private" {{ $school->type == 'Private' ? 'selected' : '' }}>Private</option>
                                <option value="Public" {{ $school->type == 'Public' ? 'selected' : '' }}>Public</option>
                                <option value="University" {{ $school->type == 'University' ? 'selected' : '' }}>University</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check"></i> Update
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i> Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Full-screen loading overlay */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 1050;
        text-align: center;
        font-weight: bold;
        font-size: 1.2rem;
        color: #007bff;
    }

    /* Animated spinner */
    .loading-spinner {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .loading-spinner div {
        position: absolute;
        width: 16px;
        height: 16px;
        background: #007bff;
        border-radius: 50%;
        animation: loadingAnim 1.2s linear infinite;
    }

    .loading-spinner div:nth-child(1) {
        top: 8px;
        left: 8px;
        animation-delay: -0.3s;
    }
    .loading-spinner div:nth-child(2) {
        top: 8px;
        right: 8px;
        animation-delay: -0.15s;
    }
    .loading-spinner div:nth-child(3) {
        bottom: 8px;
        left: 8px;
        animation-delay: 0s;
    }
    .loading-spinner div:nth-child(4) {
        bottom: 8px;
        right: 8px;
        animation-delay: 0.15s;
    }

    @keyframes loadingAnim {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.5);
            opacity: 0.5;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("editSchoolForm-{{ $school->id }}");
        const loadingOverlay = document.getElementById("loadingOverlay-{{ $school->id }}");

        form.addEventListener("submit", function () {
            // Show the animated loading overlay
            loadingOverlay.classList.remove("d-none");
        });
    });
</script>
